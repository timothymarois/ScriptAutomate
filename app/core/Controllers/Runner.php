<?php namespace App\Controllers;

use \App\Library\View as View;

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

        $scriptDb = \Config\Services::settings()->get('scripts');
        $scripts  = $scriptDb->field('active');

        if (isset($scripts[$scriptLocation],$scripts[$scriptLocation]['namespace']))
        {
            if (!isset($scripts[$scriptLocation]['parameters'])) $scripts[$scriptLocation]['parameters'] = [];

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
	}



    /**
    * execute()
    *
    *
    */
    protected function execute( $scriptNamespace, $parameters = [], $outputHidden = false )
    {
        $this->timeStart = $this->timer();

        View::$timeStart = time();
        View::start();

        if (!empty($parameters))
        {
            View::add('Running Script: <span style="color:#ffb85b">'.$scriptNamespace.'</span> with <span style="color:#ffb85b">'.http_build_query($parameters).'<span>');
        }
        else
        {
            View::add('Running Script: <span style="color:#ffb85b">'.$scriptNamespace.'</span>');
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

        View::$timeEnd = time();
        View::end($this->timeTotal);
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
