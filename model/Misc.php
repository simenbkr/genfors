<?php


namespace genfors;


class Misc
{
    public static function setSuccess($text)
    {
        $_SESSION['success'] = 1;
        $_SESSION['msg'] = $text;
    }

    public static function setError($text)
    {
        $_SESSION['error'] = 1;
        $_SESSION['msg'] = $text;
    }
}