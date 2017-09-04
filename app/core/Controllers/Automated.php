<?php namespace App\Controllers;

use \Jobby\Jobby;
use \App\Library\Schedule;

class Automated extends AuthController
{

	/**
    * index()
    *
    *
    */
	public function index()
	{
        $jobby = new Jobby();
        $tasks = Schedule::get();

        foreach($tasks as $name => $options)
		{
			$jobby->add($name,[
				'enabled'    => true,
				'command'    => $options['command'],
				'schedule'   => $options['schedule'],
				'output'     => $options['output'],
				'maxRuntime' => $options['runtime']
			]);
		}

		$jobby->run();
	}

}
