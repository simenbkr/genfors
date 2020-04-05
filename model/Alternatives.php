<?php


namespace genfors;


class Alternatives
{
    private int $id;
    private int $election_id;
    private string $name;
    private int $votes;

    private static function init(\PDOStatement $st)
    {
        $row = $st->fetch();

        if ($row == null) {
            return null;
        }

        $instance = new self();

        $instance->id = intval($row['id']);
        $instance->election_id = intval($row['election_id']);
        $instance->name = $row['name'];
        $instance->votes = $row['votes'];
    }

    public static function withElectionID(int $election_id)
    {
        $alternatives = array();

        $st = DB::getDB()->prepare('SELECT * FROM alternatives WHERE election_id = :election_id');
        $st->execute(['election_id' => $election_id]);

        for ($i = 0; $i < $st->rowCount(); $i++) {
            $alternatives[] = self::init($st);
        }

        return $alternatives;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getElectionId(): int
    {
        return $this->election_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getVotes(): int
    {
        return $this->votes;
    }

    public function incrementVotes()
    {
        $st = DB::getDB()->prepare('UPDATE alternatives SET votes = votes + 1 WHERE id = :id');
        $st->execute(['id' => $this->id]);
    }

}