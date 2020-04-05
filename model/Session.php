<?php


namespace genfors;


class Session
{
    public static function start()
    {
        session_start();
    }

    public static function destroy()
    {
        session_destroy();
    }

    public static function loginUser(User $user)
    {
        self::destroy();
        self::start();
        self::setUser($user);
        self::set('logged_in', time());
        self::set('last_active', time());
    }

    public static function setUser(User $user)
    {
        self::set("id", $user->getID());
        self::set("username", $user->getUsername());
        self::set("is_active", $user->isActive() ? 'yes' : 'no');
        self::set("is_admin", $user->isAdmin() ? 'yes' : 'no');
    }

    public static function updatePrivileges()
    {
        $user = User::withID(self::get('id'));
        self::setUser($user);
    }

    public static function refresh()
    {
        $user = self::getActiveUser();
        if (is_null($user) || !$user->isActive()) {
            self::destroy();
            return;
        }

        // 7 days without activity AND every 6th month. Shouldn't really matter for normal use cases anyways.
        if (time() - self::get('last_active') > 604800 || time() - self::get('logged_in') > 15778463) {
            self::destroy();
            self::start();
            self::redirect();
            return;
        }

        self::updatePrivileges();
        self::set('last_active', time());
    }

    public static function set(string $key, string $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key): ?string
    {
        return $_SESSION[$key];
    }

    public static function getActiveUser(): ?User
    {
        if (empty(self::get('id'))) {

            if (empty(self::get('token'))) {
                self::destroy();
            }
            return null;
        }

        return User::withID(self::get('id'));
    }

    public static function redirect()
    {
        header("Refresh:0");
        exit();
    }

}