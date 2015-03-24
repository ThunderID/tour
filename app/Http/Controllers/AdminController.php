<?php namespace App\Http\Controllers;

use Auth; 
use \ThunderID\Menu\MaterialAdminSideMenu;

abstract class AdminController extends Controller {

	protected $layout;

	function __construct() 
	{
		if (Auth::user())
		{
			$this->layout = view('admin.template');
			$this->layout->html_title = 'TOUR.id';
			
			// leftmenu
			$nav = new MaterialAdminSideMenu();

			$nav->add('dashboard', 'Dashboard', 'javascript:;', 'md md-home');
			$nav->add('overview', 'Overview', route('admin.dashboard.overview'), null, 'dashboard');

			$nav->add('tours', 'Tour', 'javascript:;', 'md md-place');
			$nav->add('vendor', 'Vendor', route('admin.vendor.index'), null, 'tours');
			$nav->add('destination', 'Destination', route('admin.destination.index'), null, 'tours');
			$nav->add('tour', 'Tour', route('admin.tour.index'), null, 'tours');

			$nav->add('ecommerce', 'Ecommerce', 'javascript:;', 'md md-credit-card');
			$nav->add('order', 'Order', route('admin.order.index'), null, 'ecommerce');
			$nav->add('customer', 'Customers', route('admin.customer.index'), null, 'ecommerce');

			$nav->add('backend', 'Backend', 'javascript:;', 'md md-people');
			$nav->add('team', 'Team', route('admin.team.index'), null, 'backend');
			// $nav->add('team', 'Role', route('admin.team_role.index'), null, 'backend');
			$nav->add('log', 'Log', 'javascript:;', null, 'backend');


			$this->layout->nav = $nav;
		}
		else
		{
			$this->layout = view('admin.template_login');
			$this->layout->html_title = 'Tour.id';
		}

		// html 
	}
}
