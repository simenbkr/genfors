<?php


namespace genfors;


class Election
{
    private int $id;
    private string $title;
    private string $description;
    private bool $is_active;
    private array $alternatives;

    private static function init(\PDOStatement $st): ?Election
    {
        $row = $st->fetch();
        if (is_null($row)) {
            return null;
        }

        $instance = new self();

        $instance->id = intval($row['id']);
        $instance->title = $row['title'];
        $instance->description = $row['description'];
        $instance->is_active = (intval($row['is_active']) == 1) ? true : false;
        $instance->alternatives = Alternatives::withElectionID($instance->id);

        return $instance;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function getAlternative()
    {
        return $this->alternatives;
    }

    public function activate()
    {
        $st = DB::getDB()->prepare('UPDATE election SET is_active = 1 WHERE id = :id');
        $st->execute(['id' => $this->id]);
    }

    public function deactivate()
    {
        $st = DB::getDB()->prepare('UPDATE election SET is_active = 0 WHERE id = :id');
        $st->execute(['id' => $this->id]);
    }

    public function generateElectionKey(User $user): string
    {
        $check_string = "{$user->getID()}-{$user->getUsername()}-{$this->title}";
        return hash_hmac('sha3-256', $check_string, SECRET);
    }

    public function hasVoted(User $user): bool
    {
        $check = $this->generateElectionKey($user);

        $st = DB::getDB()->prepare('SELECT COUNT(*) as cnt FROM votes WHERE val = :checkstr');
        $st->execute(['checkstr' => $check]);

        return $st->fetch()['cnt'] > 0;
    }
}