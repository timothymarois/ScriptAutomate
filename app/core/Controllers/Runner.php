<?php namespace App\Controllers;


class Runner extends AuthController
{

    protected $scriptLocation = '';



	/**
    * index()
    *
    *
    */
	public function index( $scriptLocation = 'manual' )
	{
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
            $this->execute();
        }
	}



    /**
    * execute()
    *
    *
    */
    protected function execute()
    {
        $script = new $this->scriptLocation();
        $script->run();
    }

}
