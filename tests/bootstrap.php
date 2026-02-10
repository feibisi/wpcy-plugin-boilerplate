<?php
/**
 * PHPUnit bootstrap file.
 *
 * Loads Composer autoloader and sets up the test environment.
 *
 * @package {{Plugin_Name}}
 */

// Composer autoloader.
$autoloader = dirname( __DIR__ ) . '/vendor/autoload.php';

if ( ! file_exists( $autoloader ) ) {
	echo 'Error: Run "composer install" before running tests.' . PHP_EOL;
	exit( 1 );
}

require_once $autoloader;

// WordPress test suite bootstrap (for integration tests).
// Uncomment and set the path when running integration tests.
// $_tests_dir = getenv( 'WP_TESTS_DIR' ) ?: '/tmp/wordpress-tests-lib';
// require_once $_tests_dir . '/includes/bootstrap.php';
