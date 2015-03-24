<?php namespace App\Http\Controllers;

use Input, Auth, \Illuminate\Support\MessageBag;

class AdminLoginController extends AdminController {

	/**
	 * login form
	 *
	 * @return void
	 * @author 
	 **/
	function getLogin()
	{
		$this->layout->content = view('admin.login.form');
		return $this->layout;
	}

	/**
	 * handle login
	 *
	 * @return void
	 * @author 
	 **/
	function postLogin()
	{
		$credential = Input::only('username', 'password');
		if (Auth::attempt($credential, Input::get('remember')))
		{
			return redirect()->route('admin.dashboard.overview');
		}
		else
		{
			return redirect()->back()->withErrors(new MessageBag(['Invalid Username & Password']));
		}
	}

	public function getLogout()
	{
		Auth::logout();
		return redirect()->route('admin.login');
	}
}
