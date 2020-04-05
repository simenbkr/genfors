<?php

setlocale(LC_ALL, 'nb_NO.utf-8');
date_default_timezone_set('Europe/Oslo');
ini_set('memory_limit', '512M');
ini_set('session.use_trans_sid', 0);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_httponly',1);
ini_set('session.use_only_cookies',1);
ini_set('session.gc_maxlifetime', 36000000);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1000);
session_save_path('../sessions');
session_set_cookie_params(3600*24*100*100, '/');

header('Content-Type: text/html; charset=utf-8');

session_start();

require_once '../model/Autoload.php';

$arg = isset($_GET['a']) ? explode('/', $_GET['a']) : array();
$cd = new genfors\CtrlData($arg);
$ctrl = new genfors\MainCtrl($cd);

$ctrl->do();