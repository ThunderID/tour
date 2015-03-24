var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.styles(['theme-default/bootstrap.css',
				'theme-default/materialadmin.css',
				'theme-default/font-awesome.min.css',
				'theme-default/material-design-iconic-font.min.css',
				'theme-default/libs/bootstrap-tagsinput/bootstrap-tagsinput.css',
				"theme-default/libs/select2/select2.css"
				], 'public/css/admin.css')
   		.scripts(['libs/jquery/jquery-1.11.2.min.js',
					'libs/jquery/jquery-migrate-1.2.1.min.js',
					'libs/bootstrap/bootstrap.min.js',
					'libs/spin.js/spin.min.js',
					'libs/autosize/jquery.autosize.min.js',
					'libs/nanoscroller/jquery.nanoscroller.min.js',
					'libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js',
					'libs/select2/select2.min.js',
					'core/source/App.min.js',
					'core/source/AppNavigation.js',
					'core/source/AppCard.js',
					'core/source/AppForm.js',
					'core/source/AppNavSearch.js',
					'core/source/AppVendor.js',
					'resources/js/thunder/thumbnail_image_upload/thumbnail-image-upload.jquery.js',
					'resources/js/thunder/bootstrap.type2confirm/bootstrap.type2confirm.jquery.js'
   				], 'public/js/admin.js')
    	.version(['public/css/admin.css', 'public/js/admin.js', 'public/js/html5shiv.js', 'public/js/respond.min.js'])
   		.copy('resources/css/theme-default/libs/summernote/summernote.css','public/css/summernote.css')
   		.copy('resources/js/libs/summernote/summernote.min.js', 'public/js/summernote.min.js')
   		.copy('resources/css/theme-default/libs/dropzone/dropzone-theme.css','public/css/dropzone-theme.css')
   		.copy('resources/js/libs/dropzone/dropzone.min.js', 'public/js/dropzone.min.js')
   		.copy('resources/js/libs/utils/html5shiv.js', 'public/js/html5shiv.js')
   		.copy('resources/js/libs/utils/respond.min.js', 'public/js/respond.min.js')
   		.copy('resources/js/libs/gmaps/gmaps.js', 'public/js/gmaps.js')
   		.copy('resources/fonts/', 'public/build/fonts/')
   		.copy('resources/images/', 'public/images/');
});
