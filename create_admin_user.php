<?php

require_once 'model/Autoload.php';

$username = 'dgsadmin';
$password = 'testetest';

$st = \genfors\DB::getDB()->prepare('INSERT INTO users(username, pwhash, is_admin, is_active) VALUES(:username, :pw, 1, 1)');
$st->execute([
    'username' => $username,
    'pw' => password_hash($password, PASSWORD_ARGON2ID),
]);
