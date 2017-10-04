<?php namespace App\Emails;

/**
 * Sender Class
 *
 */
class Sender extends Provider
{

    /**
    * __construct
    *
    *
    */
    public function __construct(array $config)
    {
        parent::__construct($config);
    }


    //--------------------------------------------------------------------


    /**
    * __call
    *
    * @param string $method
    * @param mixed $params
    *
    * @return provider method returned
    */
    public function __call($method, $args)
    {
        if (!$this->provider) return false;

        return call_user_func_array(array($this->provider,$method),$args);

        // cant do this because it turns $args into arrays
        // return $this->provider->{$method}($args);
    }


    //--------------------------------------------------------------------

}
