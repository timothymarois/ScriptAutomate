<?php namespace App\Controllers;


class AuthController extends \CodeIgniter\Controller
{

    /**
    * __construct()
    *
    *
    */
	public function __construct(...$params)
	{
        parent::__construct(...$params);

		if (is_cli()) return true;

        $access = \Config\Services::settings()->get('access');
        $key    = $this->request->getGet('key');

        if ($key==$access->key)
        {
            setcookie('access', $key, time()+(6*30*24*3600),"/");
        }
        else
        {
            if(isset($_COOKIE['access']) && $_COOKIE['access']==$access->key)
            {

            }
            else
            {
                die('No Access');
            }
        }

	}

}
