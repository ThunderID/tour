<?php namespace App;

use Validator, Illuminate\Support\MessageBag;

class HasTagsObserver {
	
	public function saving($model)
	{
		if ($model->tags)
		{
			foreach ($model->tags as $k => $v)
			{
				$tags[] = strtolower($v);
			}
			$model->tags = $tags;
		}
	}
}