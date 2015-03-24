(function($){
	
	$.fn.type2confirm = function(options) {
		
		var settings = $.extend({
			text		: 'Delete',
		}, options);

		$(this).each(function(){
			var id = Math.ceil(Math.random() * 10000);
			$(this).attr('data-toggle', 'modal');
			$(this).attr('data-target', '#type2confirmmodal-' + id);

			$('body').append('<div class="modal fade" id="type2confirmmodal-'+id+'">' +
									'<div class="modal-dialog">						  ' + 
										'<div class="modal-content">' + 
											'<div class="modal-header">' + 
											'	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' + 
											'	<h4 class="modal-title">Delete Confirmation</h4>' + 
											'</div>' + 
											'<form method="'+$(this).attr('data-form-method')+'" action="'+$(this).attr('data-form-action')+'">' + 
											'<div class="modal-body">' + 
											'	This data will be deleted permanently. To confirm please type down <strong>'+settings.text+'</strong> ' + 
											'	the form provided below' + 
											'	<br/>' + 
											'	<input type="text" name="type2confirm" class="form-control">' + 
											'</div>' + 
											'<div class="modal-footer">' + 
											'	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>' + 
											'	<button type="submit" class="btn btn-danger btn-confirm-delete" disabled>Yes, delete it!</button>' + 
											'</div>' + 
											'</form>' +
										'</div>' +	
									'</div>' + 
								'</div>');
			$('#type2confirmmodal-' + id).on('keyup', 'input[name=type2confirm]', function(){
				if ($(this).val() != settings.text)
				{
					$('#type2confirmmodal-' + id).find('.btn-confirm-delete').attr('disabled', 'disabled');
				}
				else
				{
					$('#type2confirmmodal-' + id).find('.btn-confirm-delete').removeAttr('disabled');
				}
			});
		});
	};

})(jQuery);