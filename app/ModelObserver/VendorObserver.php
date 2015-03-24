<?php namespace App;

use \Validator;


class VendorObserver {
	
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
					'logo'					=> '',
					'description'			=> 'required',
					'contact_person.name' 	=> 'required',
					'contact_person.phone' 	=> '',
					'contact_person.email' 	=> 'email',
					'address.street' 		=> '',
					'address.city' 			=> 'required',
					'address.province' 		=> 'required',
					'address.country' 		=> 'required|in:' . implode(',',$country_list),
				 ];

		$validator = Validator::make($model->toArray(), $rules);
		if ($validator->fails())
		{
			$model->setErrors($validator->errors());
			return false;
		}
	}
}