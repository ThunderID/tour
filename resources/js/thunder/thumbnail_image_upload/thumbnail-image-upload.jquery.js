(function($){

	 $.fn.thumbnail_image_upload = function( options ) {
		var settings = $.extend({
							width:"100%",
							height:"100%",
							text: "Upload Image Here",
						}, options );
		settings.text = settings.text.replace(" ", "+");

		if (this.attr('data-img') === undefined || this.attr('data-img') == '')
		{
			settings.default = 'http://placehold.it/400&text='+settings.text;
		}
		else
		{
			settings.default = this.attr('data-img');
		}

		var obj = this;

		this.bind('change',function(){
			if (this.files && this.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					obj.siblings('.thumbnail').find('img').attr('src', e.target.result).attr('width', settings.width).attr('height', settings.height);
				}

				reader.readAsDataURL(this.files[0]);
			}
		});
		
		this.addClass('hidden');
		$('<a href="javascript:;" class="thumbnail"><img data-src="#" src="'+settings.default+'" alt="" width="100%"></a>').insertAfter(this).bind('click', function(){
			obj.click();
		});

	};

}(jQuery));
