<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use Request;

class UploadFile extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($input_name, $save_dir, $new_filename = null)
	{
		//
		$this->input_name = $input_name;
		$this->save_dir = $save_dir;
		$this->new_filename = $new_filename;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		//
		if (Request::hasFile($this->input_name))
		{
			$save_dir = str_finish($this->save_dir, '/');

			// generate filename
			$i = 0;
			do {
				if (!$this->new_filename)
				{
					$filename = ($i ? str_random(6) . '_': '') . Request::file($this->input_name)->getClientOriginalName();
				}
				else
				{
					$filename = ($i ? str_random(6) . '_': '') . $this->new_filename;
				}	
				$i ++;
			} while(file_exists($this->save_dir . $filename));
		    //
		    @mkdir($save_dir);

		    Request::file($this->input_name)->move($save_dir, $filename);

		    return asset($save_dir . $filename);
		}
		else
		{
			return false;
		}
	}

}
