<?php

define('ROOT_URL', getRootUrl());

$routerURL = ROOT_URL . "index.php?";

define('ACTION_CREATE_POST', "create");
define('ACTION_EDIT_POST', "edit");
define('ACTION_DELETE_POST', "delete");

define('URL_CREATE_BLOGPOST', $routerURL . 'action=' . ACTION_CREATE_POST);
define('URL_EDIT_BLOGPOST', $routerURL . 'action=' . ACTION_EDIT_POST);
define('URL_DELETE_BLOGPOST', $routerURL . 'action=' . ACTION_DELETE_POST);


function getRootUrl() {
    // Determine the protocol
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    
    // Get the host name
    $host = $_SERVER['HTTP_HOST'];
    
    // Get the path to the current script, and remove the script filename (index.php)
    $scriptPath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
    
    // Combine to get the full root URL
    return $protocol . $host . $scriptPath;
}
?>