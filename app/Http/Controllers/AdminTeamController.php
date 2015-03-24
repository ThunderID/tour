<?php namespace App\Http\Controllers;

use \App\User, \App\Commands\UploadFile;
use Input, Session;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminTeamController extends AdminController {

	protected $controller_name = 'team';

	function __construct(User $model) 
	{
		parent::__construct();

		$this->model = $model;
	}
	
	function getIndex()
	{
		// ---------------------- LOAD DATA ----------------------
		$data = $this->model->name('*'. Input::get('q') . '*')->orderBy('name')->paginate(25);


		// ---------------------- GENERATE CONTENT ----------------------
		$this->layout->page_title = strtoupper(str_plural($this->controller_name));

		$this->layout->content = view('admin.'.$this->controller_name.'.index');
		$this->layout->content->controller_name = $this->controller_name;
		$this->layout->content->data = $data;

		return $this->layout;
	}

	function getCreate($id = null)
	{
		// ---------------------- LOAD DATA ----------------------
		if (!is_null($id))
		{
			$data = $this->model->findorfail($id);
		}
		else
		{
			$data = $this->model->newInstance();
		}

		// Load country list
		$filename = base_path('/resources/data/countries.json');
		$fd = fopen($filename, 'r');
		$json = json_decode(fread($fd, filesize($filename)));
		fclose($fd);

		$country_list = [];
		foreach ($json as $country)
		{
			$tmp = json_decode($country);
			$country_list[$country] = $country;
		}
	
		// ---------------------- GENERATE CONTENT ----------------------
		$this->layout->page_title = strtoupper($this->controller_name);

		$this->layout->content = view('admin.'.$this->controller_name.'.create');
		$this->layout->content->controller_name = $this->controller_name;
		$this->layout->content->data = $data;
		$this->layout->content->country_list = $country_list;

		return $this->layout;
	}

	function postStore($id = null)
	{
		// ---------------------- LOAD DATA ----------------------
		if (!is_null($id))
		{
			$data = $this->model->findorfail($id);
		}
		else
		{
			$data = $this->model->newInstance();
		}

		// ---------------------- HANDLE INPUT ----------------------
		$input = Input::all();
		$input['contact_person']['name'] = Input::get('contact_person_name');
		$input['contact_person']['phone'] = Input::get('contact_person_phone');
		$input['contact_person']['email'] = Input::get('contact_person_email');

		$input['address']['street'] = Input::get('address_street');
		$input['address']['city'] = Input::get('address_city');
		$input['address']['province'] = Input::get('address_province');
		$input['address']['country'] = Input::get('address_country');

		if ($logo_path = $this->dispatch(new UploadFile('logo', 'uploaded/vendors/logo/'.date('Y/m/d/H'))))
		{
			$input['logo'] = $logo_path;
		}
		$data->fill($input);

		if ($data->save())
		{
			return redirect()->route('admin.' . $this->controller_name . '.index')->with('alert_success', ucwords($this->controller_name) . ' "' . $data->name . '" has been saved');
		}
		else
		{
			return redirect()->back()->withInput()->withErrors($data->getErrors());
		}
	}

	function getShow($id)
	{
		// ---------------------- LOAD DATA ----------------------
		if (!is_null($id))
		{
			$data = $this->model->findorfail($id);
		}
		else
		{
			$data = $this->model->newInstance();
		}

		// ---------------------- GENERATE CONTENT ----------------------
		$this->layout->page_title = strtoupper($this->controller_name);

		$this->layout->content = view('admin.'.$this->controller_name.'.show');
		$this->layout->content->controller_name = $this->controller_name;
		$this->layout->content->data = $data;

		return $this->layout;
	}

	function getDelete($id)
	{
		// ---------------------- LOAD DATA ----------------------
		if (!is_null($id))
		{
			$data = $this->model->findorfail($id);
		}
		else
		{
			App::abort(404);
		}
		
		if (str_is('Delete', Input::get('type2confirm')))
		{
			if ($data->delete())
			{
				return redirect()->route('admin.'.$this->controller_name.'.index')->with('alert_success', 'Data "' . $data->name . '" has been deleted');
			}
			else
			{
				return redirect()->back()->withErrors($data->getErrors());
			}
		}
		else
		{
			return redirect()->back()->with('alert_danger', 'Invalid delete confirmation text');
		}
	}
}
