<?php


namespace genfors;


class User
{
    private int $id;
    private string $username;
    private string $pwhash;
    private bool $is_active;
    private bool $is_admin;

    private static function init(\PDOStatement $st): ?User
    {
        $row = $st->fetch();
        if ($row == null) {
            return null;
        }

        $instance = new self;
        $instance->id = intval($row['id']);
        $instance->username = $row['username'];
        $instance->pwhash = $row['pwhash'];
        $instance->is_active = (intval($row['is_active']) == 1) ? true : false;
        $instance->is_admin = (intval($row['is_admin']) == 1) ? true : false;

        return $instance;
    }

    public static function withID(int $id): ?User
    {
        $st = DB::getDB()->prepare('SELECT * FROM users WHERE id = :id');
        $st->execute(['id' => $id]);
        return self::init($st);
    }

    public static function withUsername(string $username): ?User
    {
        $st = DB::getDB()->prepare('SELECT * FROM users WHERE username = :username');
        $st->execute(['username' => $username]);
        return self::init($st);
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function verifyPassword($raw_pw): bool
    {
        return password_verify($raw_pw, $this->pwhash);
    }

    public static function new(string $username, string $password, bool $isAdmin, bool $isActive): ?User
    {
        $pw_hash = password_hash($password, PASSWORD_ARGON2ID);
        $st = DB::getDB()->prepare('INSERT INTO users(username, pwhash, is_admin, is_active) VALUES(:username, :password, :isadm, :isactive)');
        $st->execute([
            'username' => $username,
            'password' => $pw_hash,
            'isadm' => ($isAdmin) ? '1' : '0',
            'isactive' => ($isActive) ? '1' : '0'
        ]);

        return self::withUsername($username);
    }

    public function activate()
    {
        $st = DB::getDB()->prepare('UPDATE users SET is_active = 1 WHERE id = :id');
        $st->execute(['id' => $this->id]);
    }

    public function deactivate()
    {
        $st = DB::getDB()->prepare('UPDATE users SET is_active = 0 WHERE id = :id');
        $st->execute(['id' => $this->id]);
    }

    public static function all()
    {
        $st = DB::getDB()->prepare('SELECT * FROM users');
        $st->execute();

        $users = array();

        for ($i = 0; $i < $st->rowCount(); $i++) {
            $users[] = self::init($st);
        }

        return $users;
    }

    public static function deactivateAll()
    {
        DB::getDB()->query('UPDATE users SET is_active = 0');
    }

    public static function activateAll()
    {
        DB::getDB()->query('UPDATE users SET is_active = 1');
    }

    public static function exists(string $username) : bool {
        $st = DB::getDB()->prepare('SELECT * FROM users WHERE username = :username');
        $st->execute(['username' => $username]);

        return $st->rowCount() > 0;
    }

    public static function createUserAndEmailCreds(string $email)
    {

        $raw_pw = bin2hex(random_bytes(12));

        $username = explode('@', $email)[0];
        while(User::exists($username)) {
            $username .= bin2hex(random_bytes(2));
        }
        self::new($username, $raw_pw, 0, 0);

        $email_content = MAIL_USER_CONTENT_START;
        $email_content .= "Brukernavn: $username<br/>Passord: $raw_pw";
        $email_content .= MAIL_USER_CONTENT_END;

        Email::sendEmail(MAIL_USER_TITLE, $email_content, $email);
    }
}