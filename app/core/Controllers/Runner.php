<?php namespace App\Controllers;

use \App\Library\View as View;
use \App\Library\Schedule;

class Runner extends AuthController
{

    protected $scriptLocation = '';

    protected $timeStart;
    protected $timeEnd;
    protected $timeTotal;


	/**
    * index()
    *
    *
    */
	public function index( $scriptLocation )
	{
        $outputHidden = (bool) (is_cli() ? false : $this->request->getGet('output'));
        $this->withErrors = (bool) (is_cli() ? false : $this->request->getGet('errors'));

        if ($this->withErrors)
        {
            View::$withErrors = true;
        }

        if (is_cli())
        {
            Schedule::update($scriptLocation,['last_start'=>date("Y-m-d H:i:s")]);
        }

        $scriptDb = \Config\Services::settings()->get('scripts');
        $scripts  = $scriptDb->field('active');

        if (isset($scripts[$scriptLocation],$scripts[$scriptLocation]['namespace']))
        {
            if (!isset($scripts[$scriptLocation]['parameters'])) $scripts[$scriptLocation]['parameters'] = [];

            if (!is_cli() && !empty($this->request->getGet()))
            {
                $scripts[$scriptLocation]['parameters'] = array_merge($scripts[$scriptLocation]['parameters'], $this->request->getGet());
                $scripts[$scriptLocation]['parameters'] = array_merge($scripts[$scriptLocation]['parameters'], $this->request->getPost());
            }

            foreach($scripts[$scriptLocation]['namespace'] as $scriptNamespace)
            {
                $this->execute( '\\Script\\'.$scriptNamespace, $scripts[$scriptLocation]['parameters'], $outputHidden );
            }
        }
        else
        {
            View::start();
            View::add('Failed to locate script');
            View::end();
        }

        if (is_cli())
        {
            Schedule::update($scriptLocation,['last_end'=>date("Y-m-d H:i:s")]);
        }
	}



    /**
    * execute()
    *
    *
    */
    protected function execute( $scriptNamespace, $parameters = [], $outputHidden = false )
    {
        $this->timeStart = $this->timer();
        $memoryStart     = memory_get_usage();

        View::$timeStart   = time();
        View::$memoryStart = $memoryStart;
        View::start();

        if (is_cli())
        {
            if (!empty($parameters))
            {
                View::add('Running Script: '.$scriptNamespace.' with '.http_build_query($parameters));
            }
            else
            {
                View::add('Running Script: '.$scriptNamespace);
            }
        }
        else
        {
            if (!empty($parameters))
            {
                View::add('Running Script: <span style="color:#ffb85b">'.$scriptNamespace.'</span> with <span style="color:#ffb85b">'.http_build_query($parameters).'<span>');
            }
            else
            {
                View::add('Running Script: <span style="color:#ffb85b">'.$scriptNamespace.'</span>');
            }
        }

        if ($outputHidden === true)
        {
            View::add('Output hidden.');
            View::$output = false;
        }

        $script = new $scriptNamespace( $parameters );
        $script->run();

        $this->timeEnd   = $this->timer();
        $this->timeTotal = round(($this->timeEnd - $this->timeStart),2);

        $currentMemory = memory_get_usage();
        $usedMemory    = ($currentMemory-$memoryStart);

        View::$timeEnd   = time();
        View::$memoryEnd = $currentMemory;
        View::end($this->timeTotal, $usedMemory);

    }


    /**
    * timer()
    *
    *
    */
    protected function timer()
    {
        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        return $time;
    }

}
