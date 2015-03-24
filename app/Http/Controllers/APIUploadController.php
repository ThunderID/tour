<?php namespace App\Http\Controllers;

use Auth, Destination, Input, Response, Request, \App\Commands\UploadFile;

class APIUploadController extends APIController {

	function postImage()
	{
		if ($image = $this->dispatch(new UploadFile('file', 'uploaded/contents/'.date('Y/m/d/H'))))
		{
			return $image;
		}

	}

}
