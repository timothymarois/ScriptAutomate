<?php namespace App\Controllers;


class AuthController extends \CodeIgniter\Controller
{

    public $session;

    /**
    * __construct()
    *
    *
    */
	public function __construct(...$params)
	{
        parent::__construct(...$params);

        /*$this->session = new \App\Users\Session();

        if ($this->session->isLoggedIn() && $this->session->getUserId())
        {
            $this->account = \Config\Services::accounts()->get($this->session->getUserId());
        }
        else
        {
            // redirect('/client/login');
        }*/

	}

}
