<?php namespace App;

use Validator, Illuminate\Support\MessageBag;

class DestinationFavedByObserver {
	
	public function deleting($model)
	{
		if ($model->faved_by->count())
		{
			$model->setErrors(new MessageBag(['delete' => 'unable to delete this destination as it has been faved by users']));
			return false;
		}
	}
}