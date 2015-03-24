<?php namespace App;

use \Validator;


class DestinationObserver {
	
	public function saving($model)
	{
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

		$rules = [
					'name'					=> 'required',
					'categories'			=> '',
					'tags'					=> '',
					'description'			=> 'required',
					'address.street' 		=> '',
					'address.city' 			=> 'required',
					'address.province' 		=> 'required',
					'address.country' 		=> 'required|in:' . implode(',',$country_list),
					'address.latitude' 		=> 'required|numeric',
					'address.longitude' 	=> 'required|numeric',
					'gallery' 				=> '',
				 ];

		$i = 0;
		if (is_array($model->categories))
		{
			foreach ($model->categories as $k => $v)
			{
				$rules['categories.' . $i] = 'required';
				$i++;
			}
		}

		if (is_array($model->tags))
		{
			foreach ($model->tags as $k => $v)
			{
				$rules['tags.' . $i] = 'min:3';
				$i++;
			}
		}

		$validator = Validator::make($model->toArray(), $rules);
		if ($validator->fails())
		{
			$model->setErrors($validator->errors());
			return false;
		}
	}
}