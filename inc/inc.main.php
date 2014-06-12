<?php

if (!defined('ROOT')) {
	throw new Exception('ROOT undefined!');
}

// Load the autoload function.
require ROOT . 'inc/inc.autoload.php';

// Load the default configuration options.
require ROOT . 'cfg/cfg.default.php';

// Load the custom configuration options, if present.
if (file_exists(ROOT . 'cfg/cfg.custom.php')) {
	require ROOT . 'cfg/cfg.custom.php';
}

// Import constants.
require ROOT . 'inc/inc.constants.php';

// Set up the data source name.
$dsn = sprintf('%s:host=%s;port=%d;dbname=%s;charset=utf8mb4', $config['db']['type'], $config['db']['host'], $config['db']['port'], $config['db']['dbname']);

// Initialize the database connection.
$Database = new \PDO($dsn, $config['db']['username'], $config['db']['password'], $config['db']['options']);

// Prevent database information from being accessible in other parts of the application.
unset($config['db']);

$WidgetTypes = new \Core\WidgetTypes();
$WidgetColors = new \Core\WidgetColors();
$Orders = new \Core\Orders();

