<?php namespace App;

use Validator, Hash, Illuminate\Support\MessageBag;


class TourObserver {
	
	public function saving($model)
	{
		$rules = [
					'name'					=> 'required|min:3',
					'description'			=> 'required',
				 ];

		$validator = Validator::make($model->toArray(), $rules);
		if ($validator->fails())
		{
			$model->setErrors($validator->errors());
			return false;
		}
	}
}