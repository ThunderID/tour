<?php namespace App;

use Validator, Illuminate\Support\MessageBag;

class DestinationTourObserver {
	
	public function deleting($model)
	{
		if ($model->tours->count())
		{
			$model->setErrors(new MessageBag(['delete' => 'unable to delete this destination as it has been used in tour']));
			return false;
		}
	}
}