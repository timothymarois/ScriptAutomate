<?php namespace App\Controllers;


class Main extends AuthController
{

	/**
    * index()
    *
    *
    */
	public function index( $page = '' )
	{
		if ($page == '') $page = 'manual';

		$page = view('template/page/'.$page);

		return view('template/frame',['page'=>$page]);
	}

}
