<?php namespace App\Emails;

/**
 * Provider
 *
 *
 */
class Provider
{
    public $provider;



    /**
    * __construct()
    *
    */
    public function __construct(array $config)
    {
        if (isset($config['provider']))
        {
            $provider = $config['provider'];
        }

        if ($provider!='')
        {
            $this->provider = $this->registerProvider(new $provider($config));
        }
    }


    //--------------------------------------------------------------------


    /**
    * registerProvider()
    *
    * Checks to be sure its an instance of our Email Interface
    *
    */
    private function registerProvider(InterfaceEmail $provider)
    {
        return $provider;
    }


    //--------------------------------------------------------------------

}
