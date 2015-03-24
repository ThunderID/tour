<?php

Route::group(['prefix' => 'api'], function(){

	Route::controller('destination', 'APIDestinationController', [
				'getSearch'	=> 'api.destination.search',
				'getFind'	=> 'api.destination.find'
		]);

	Route::controller('upload', 'APIUploadController', [
				'postImage'	=> 'api.upload.image'
		]);
});