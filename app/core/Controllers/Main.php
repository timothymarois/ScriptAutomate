<?php namespace App\Controllers;


class Main extends AuthController
{

	/**
    * index()
    *
    *
    */
	public function index()
	{
		/*$session = \Config\Services::settings()->get('access');
		$session->key = 1214;
		$session->save();*/

		return view('welcome_message');
	}

}
