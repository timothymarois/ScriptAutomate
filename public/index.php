<?php


/*
|--------------------------------------------------------------------------
| Path Locations (if changed)
|--------------------------------------------------------------------------
|
| Change these if you have moved their locations,
| Otherwise the website will crash and not load correctly.
|
| NO TRAILING SLASH!
|
*/

$paths = [

    'public'     => 'public',
    'app'        => '../app',
    'writable'   => '../storage',

];


/*
|--------------------------------------------------------------------------
| Application Start...
|--------------------------------------------------------------------------
|
| You SHOULD NOT change anything below this.
|
*/


// Ensure the current directory is pointing to the front controller's directory
chdir(__DIR__);

if (isset($paths['app']) && is_array($paths))
{
    $start_file = $paths['app'].'/core/start.php';

    // Path to the front controller (this file)
    define('FCPATH', __DIR__.DIRECTORY_SEPARATOR);

    if (file_exists($start_file))
    {
        // Start up our application.
        require $start_file;
    }
    else
    {
        die('Error: Can not find '.$start_file);
    }
}
else
{
    die('Error: Missing $paths app directory location.');
}
