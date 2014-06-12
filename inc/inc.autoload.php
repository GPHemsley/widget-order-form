<?php

if (!defined('ROOT')) {
	throw new Exception('ROOT undefined!');
}

function __autoload($class_name)
{
	$class_name = ltrim($class_name, '\\');
	$file_name  = '';
	$namespace = '';

	if ($last_ns_pos = strrpos($class_name, '\\')) {
		$namespace = substr($class_name, 0, $last_ns_pos);
		$class_name = substr($class_name, $last_ns_pos + 1);
		$file_name = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
	}

	$file_name .= str_replace('_', DIRECTORY_SEPARATOR, $class_name) . '.php';

	$file_name = ROOT . 'lib/' . $file_name;

	if (file_exists($file_name)) {
		require $file_name;
	}
}

