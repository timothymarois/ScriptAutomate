<?php namespace Config;

/**
 * Holds the paths that are used by the system to
 * locate the main directories, application, system, etc.
 * Modifying these allows you to re-structure your application,
 * share a system folder between multiple applications, and more.
 *
 * All paths are relative to the application's front controller, index.php
 */
class Paths
{
	/*
	 *---------------------------------------------------------------
	 * CodeIgniter System Directory NAME
	 *---------------------------------------------------------------
	 *
	 * This variable must contain the name of your "system" folder.
	 * Include the path if the folder is not in the same directory
	 * as this file.
	 */
	public $systemDirectory = 'vendor/codeigniter4/framework/system';


	/*
	 *---------------------------------------------------------------
	 * "Core" Directory NAME
	 *---------------------------------------------------------------
	 *
	 * If you want this front controller to use a different "cms/application"
	 * folder than the default one you can set its name here.
	 *
	 * NO TRAILING SLASH!
	 */
	public $appDirectory;


	/*
	 * ---------------------------------------------------------------
	 * WRITABLE DIRECTORY NAME
	 * ---------------------------------------------------------------
	 *
	 * This variable must contain the name of your "writable" directory.
	 * The writable directory allows you to group all directories that
	 * need write permission to a single place that can be tucked away
	 * for maximum security, keeping it out of the application and/or
	 * writeable directories.
	 */
	public $writableDirectory;


	/*
	 * ---------------------------------------------------------------
	 * TESTS DIRECTORY NAME
	 * ---------------------------------------------------------------
	 *
	 * This variable must contain the name of your "tests" directory.
	 * The writable directory allows you to group all directories that
	 * need write permission to a single place that can be tucked away
	 * for maximum security, keeping it out of the application and/or
	 * system directories.
	 */
	public $testsDirectory;


	/*
	 * ---------------------------------------------------------------
	 * PUBLIC DIRECTORY NAME
	 * ---------------------------------------------------------------
	 *
	 * This variable must contain the name of the directory that
	 * contains the main index.php front-controller. By default,
	 * this is the `public` directory, but some hosts may not
	 * be able to map a primary domain to a sub-directory so you
	 * can change this to `public_html`, for example, to comply
	 * with your host's needs.
	 */
	public $publicDirectory;
}
