<?php namespace App;

use Validator, Illuminate\Support\MessageBag;

class VendorTourObserver {
	
	public function deleting($model)
	{
		if ($model->tours->count())
		{
			$model->setErrors(new MessageBag(['delete' => 'Vendor has some tour(s)']));
			return false;
		}
	}
}