<?php namespace App;

use Validator, Hash, Illuminate\Support\MessageBag;

class UserObserver {
	
	public function saving($model)
	{
		$rules = [
					'name'					=> 'required|min:3',
					'email'					=> 'required|email|unique:' . $model->getTable() . ',username,' . ($model->id ? $model->id : "NULL") . ",id",
					'username'				=> 'required|unique:' . $model->getTable() . ',username,' . ($model->id ? $model->id : "NULL") . ",id",
					'role' 					=> 'required|in:members,writers,editors,administrators',
					'avatar' 				=> 'url',
					'password'				=> 'required|min:6'
				 ];

		$validator = Validator::make($model->toArray(), $rules);
		if ($validator->fails())
		{
			$model->setErrors($validator->errors());
			return false;
		}

		if (Hash::needsRehash($model->password))
		{
			$model->password = Hash::make($model->password);
		}
	}

	function deleting($model)
	{
		$model->setErrors(new MessageBag(['delete' => 'User is not deletable']));
		return false;
	}
}