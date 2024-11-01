jQuery(document).ready(function(){
	jQuery('ul.horz_tabs li a').click(function() {
		jQuery('ul.horz_tabs li').removeClass('active');
		 jQuery(this).parent().addClass('active');
		var id = jQuery(this).parent().attr('id');

		jQuery('.postbox').removeClass('active');
		jQuery('#tab_'+id).addClass('active');

		if(id == 'license' || id == 'options' || id == 'subscribe') {
			jQuery('#non_license').hide();
		} else {
			jQuery('#non_license').show();
		}

	});
});	


var support_form = function()
{
	var detail_problem = jQuery('#support_form #detail_problem').val();
	var name = jQuery('#support_form #name').val();
	var email = jQuery('#support_form #email').val();

	if(detail_problem == '' || name == '' || email == '')
	{
		alert('Please fill all Details of Problem, Name and Email');
		return false;
	}

	jQuery('#support_form').submit();
}