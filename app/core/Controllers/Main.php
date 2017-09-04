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

		$scriptDb = \Config\Services::settings()->get('scripts');
        $scripts  = $scriptDb->field('active');

		$scriptGroup = [];
		foreach($scripts as $name => $script)
		{
			$scriptGroup[$script['group']][] = $name;
		}

		$page = view('template/page/'.$page);

		return view('template/frame',['page'=>$page,'scriptGroup'=>$scriptGroup]);
	}

}
