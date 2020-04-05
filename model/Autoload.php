<?php

namespace genfors;

require_once(__DIR__ . '/../config.php');

if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);

spl_autoload_register(function($class) {
    if (strpos($class, __NAMESPACE__ . '\\') !== 0) {
        return;
    }
    $navn = substr($class, strlen(__NAMESPACE__) + 1);
    foreach (array('model', 'view', 'controller') as $folder) {
        $path = PATH . DS . $folder . DS . $navn . '.php';
        if (file_exists($path)) {
            require_once($path);
            return;
        }
    }
    throw new \Exception('Could not load ' . $navn);
});