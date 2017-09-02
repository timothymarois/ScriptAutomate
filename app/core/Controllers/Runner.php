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
	public function index( $scriptLocation = 'manual' )
	{
        $outputHidden = (bool) (is_cli() ? false : $this->request->getGet('output'));

        if ($scriptLocation!='manual')
        {
            $this->scriptLocation = '\\Script\\'.$scriptLocation;
        }
        else
        {
            if ($this->request->getGet('s'))
            {
                $this->scriptLocation = '\\Script\\'.$this->request->getGet('s');
            }
        }

        if ($this->scriptLocation)
        {
            $this->execute( $outputHidden );
        }
	}



    /**
    * execute()
    *
    *
    */
    protected function execute( $outputHidden = false )
    {
        $this->timeStart = $this->timer();

        View::$timeStart = time();
        View::start();

        if ($outputHidden === true)
        {
            View::add('Output hidden.');
            View::$output = false;
        }

        $script = new $this->scriptLocation();
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
