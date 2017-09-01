<?php

$paths_file = $paths['app'].'/core/Config/Paths.php';

if (file_exists($paths_file))
{
    require $paths_file;
    $config_paths = new Config\Paths();

    foreach($paths as $name=>$path)
    {
        $config_paths->{$name.'Directory'} = $path;
    }

    $app = require 'bootstrap.php';
    $app->run();
}
else
{
    die('Error: Can not find '.$paths_file);
}
