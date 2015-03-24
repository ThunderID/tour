<?php namespace App\Http\Controllers;

class AdminDashboardController extends AdminController {

	/**
	 * login form
	 *
	 * @return void
	 * @author 
	 **/
	function getOverview()
	{
		// view
		$this->layout->content = view('admin.dashboard.overview');
		$this->layout->page_title = 'Dashboard: Overview';
		return $this->layout;
	}
}
