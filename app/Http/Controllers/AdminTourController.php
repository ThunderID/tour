<?php namespace App\Http\Controllers;

use \App\Tour, \App\Vendor, \App\Commands\UploadFile;
use Input, Session;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminTourController extends AdminController {

	protected $controller_name = 'tour';

	function __construct(Tour $model) 
	{
		parent::__construct();

		$this->model = $model;
	}
	
	function getIndex()
	{
		// ---------------------- LOAD DATA ----------------------
		$data = $this->model->with(['vendor','destinations'])->name('*'. Input::get('q') . '*')->orderBy('name')->paginate(25);


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


		// vendor list
		$all_vendors = Vendor::orderBy('name')->get();
		foreach ($all_vendors as $vendor)
		{
			$vendors[$vendor->id] = $vendor->name;
		}
	
		// ---------------------- GENERATE CONTENT ----------------------
		$this->layout->page_title = strtoupper($this->controller_name);

		$this->layout->content = view('admin.'.$this->controller_name.'.create');
		$this->layout->content->controller_name = $this->controller_name;
		$this->layout->content->data = $data;
		$this->layout->content->vendor_list = $vendors;

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

		$data->fill($input);
		if ($input['vendor'])
		{
			$data->vendor()->associate(Vendor::find(Input::get('vendor')));
		}

		if ($input['destination'])
		{
			$data->destinations()->sync(explode(',', $input['destination']));
		}


		if ($data->save())
		{
			// vendor
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
