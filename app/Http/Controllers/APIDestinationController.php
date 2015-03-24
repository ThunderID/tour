<?php namespace App\Http\Controllers;

use Auth, App\Destination, Input, Response, Validator;

class APIDestinationController extends APIController {

	/**
	 * search by name
	 *
	 * @return Response
	 */
	function getSearch()
	{
		// validate query
		$rules['q'] 	= 'required|min:3';
		$rules['skip']	= 'numeric|min:0';
		$rules['take']	= 'numeric|min:0|max:30';

		$validator = Validator::make(Input::only('q','skip','take'), $rules);
		if ($validator->fails())
		{
			return Response::json($validator->messages(), 403);
		}
		else
		{
			$results = Destination::name(Input::get('q') . '*')
												->skip(Input::has('skip') ? Input::get('skip') : 0)
												->take(Input::has('take') ? Input::get('take') : 10)
												->orderBy('name')
												->get();
			return Response::json($results, 200);
		}
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	function getFind()
	{
		// validate query
		$rules['id'] 	= 'required';

		$validator = Validator::make(Input::only('id'), $rules);
		if ($validator->fails())
		{
			return Response::json($validator->messages(), 403);
		}
		else
		{
			$results = Destination::whereIn('_id', explode(',', Input::get('id')))
												->orderBy('name')
												->get();
			return Response::json($results, 200);
		}
	}

}
