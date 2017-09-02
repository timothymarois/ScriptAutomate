<?php


/*
 * ---------------------------------------------------------------
 * SETUP OUR PATH CONSTANTS
 * ---------------------------------------------------------------
 *
 * The path constants provide convenient access to the folders
 * throughout the application. We have to setup them up here
 * so they are available in the config files that are loaded.
 */

$public = trim($config_paths->publicDirectory, '/');

// Path to code root folder (just up from public)
$pos = strrpos(FCPATH, $public.DIRECTORY_SEPARATOR);
define('ROOTPATH', substr_replace(FCPATH, '', $pos, strlen($public.DIRECTORY_SEPARATOR)));

// Path to the system folder
define('PARENTPATH', realpath($config_paths->appDirectory).DIRECTORY_SEPARATOR);

// Path to the APPPATH folder
define('APPPATH', realpath(PARENTPATH . '/core').DIRECTORY_SEPARATOR);

// Path to the SCRIPTPATH folder
define('SCRIPTPATH', realpath(PARENTPATH . '/scripts').DIRECTORY_SEPARATOR);

// Path to the system folder
define('BASEPATH', realpath(PARENTPATH . $config_paths->systemDirectory).DIRECTORY_SEPARATOR);

// Path to the writable directory.
define('WRITEPATH', realpath(PARENTPATH . '/storage').DIRECTORY_SEPARATOR);

// The path to the "tests" directory
define('TESTPATH', realpath($config_paths->testsDirectory).DIRECTORY_SEPARATOR);


if (!is_writable(WRITEPATH))
{
	if (!is_dir(WRITEPATH))
    {
        mkdir(WRITEPATH, 0775, true);
    }
	else
	{
		die('Error: Directory is not writable '.WRITEPATH);
	}	
}


/*
 * ---------------------------------------------------------------
 * GRAB OUR CONSTANTS & COMMON
 * ---------------------------------------------------------------
 */

require APPPATH.'Config/Constants.php';
require BASEPATH.'Common.php';


/*
 * ---------------------------------------------------------------
 * LOAD OUR AUTOLOADER
 * ---------------------------------------------------------------
 *
 * The autoloader allows all of the pieces to work together
 * in the framework. We have to load it here, though, so
 * that the config files can use the path constants.
 */

require BASEPATH.'Autoloader/Autoloader.php';
require APPPATH .'Config/Autoload.php';
require APPPATH .'Config/Services.php';

// Use Config\Services as CodeIgniter\Services
class_alias('Config\Services', 'CodeIgniter\Services');

$loader = CodeIgniter\Services::autoloader();
$loader->initialize(new Config\Autoload());
$loader->register();


/*
 * ---------------------------------------------------------------
 * Load in composer if avail
 * ---------------------------------------------------------------
 */

if (file_exists(COMPOSER_PATH))
{
	require COMPOSER_PATH;
}


/*
 * ---------------------------------------------------------------
 * Load our Helper Files (global)
 * ---------------------------------------------------------------
 * url
 * module
 */

helper('url');
helper('filesystem');


/*
 * ---------------------------------------------------------------
 * GRAB OUR CODEIGNITER INSTANCE
 * ---------------------------------------------------------------
 *
 * The CodeIgniter class contains the core functionality to make
 * the application run, and does all of the dirty work to get
 * the pieces all working together.
 */

$app = new \CodeIgniter\CodeIgniter(new \Config\App());
$app->initialize();

return $app;
