<?php

// Copy example.settings.php to settings.php and
// configure your settings.

require_once dirname(__FILE__) . "/maintenance_mode.php";

$debug = false;

$env = "dev";
$env_dir = "/";
// $env_dir = "/test/";
$public_files_dir = "/home/lobbycontrol/public_html/files";
$private_files_dir = "/home/lobbycontrol/private_files/lobbycontrol_db_files";

$db_connection = array (
    'server' => 'localhost',
    'port' => '3306',
    'database' => '',
    'username' => '',
    'password' => '',
    'reader_username' => '',
    'reader_password' => '',
);

$users = array (
    'otto' => '',
    'roland' => '',
    'rebecca' => '',
    'thomas' => '',
    'bane' => '',
    'admin' => '',
    'demo' => '',
);

if (@$maintenance_mode === true && preg_match('/(auswertung|info.php$)/', $_SERVER['REQUEST_URI']) == 0) {
  include dirname(__FILE__) . "/../common/maintenance.php";
  exit(0);
}
