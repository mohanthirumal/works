$(document).ready(function()
{
	/* Global variables declaration */
	var vpb_time_popup_is_allowed_to_stay = 800,
	vpb_info,
	vpb_uid,
	vpb_username,
	vpb_time_out = null,
	vpb_popup_box = $('<div id="vpb_load_user_details_main_wrapper"><div id="vpb_load_user_details_displayer"></div></div>').appendTo($( "body" ));
	
	$('.vpb_link_attribute').live('mouseover', function()
	{
		/* Format for 'vasplus_programming_blog_user_details' tag: user_id, user_name */
		vpb_info = $(this).attr('vasplus_programming_blog_user_details').split(',');
		vpb_uid = vpb_info[0];
		vpb_username = vpb_info[1];

		/* If there is no valid user info in the url vasplus_programming_blog_user_details tag, no need to popup blank field */
		if (vpb_uid == "" || vpb_username == "")
			return false;

		if (vpb_time_out)
			clearTimeout(vpb_time_out);
			
		/* Position the popup correctly beside the mouseover info */
		var vpb_popup_position = $(this).offset();
		var width = $(this).width();
		vpb_popup_box.css({
			left: (vpb_popup_position.left + width) - 300 + 'px',
			top: vpb_popup_position.top + 45 + 'px',
			position:'absolute'
		});
		
		/* Pass the User ID and Username to a variable dataString */
		var dataString = 'playerId=' + vpb_uid + '&matchId=' + vpb_username;

		$.ajax({
			type: "POST",
			url: "playersstatus.php",
			data: dataString,
			cache: false,
			beforeSend: function()
			{
				/* This shows loading the popup box */
				$('#vpb_load_user_details_displayer').show().html("");
				$("#vpb_load_user_details_displayer").html('<div style="padding-top:8px;padding-bottom:10px;font-family:Verdana, Geneva, sans-serif; font-size:16px;font-weight:bold;color:gray;">Loading <img src="./images/loadings.gif" align="absmiddle" /></div>');
			},
			success: function(response)
			{
				/* This displays the popup box */
				$("#vpb_load_user_details_displayer").html("");
				$("#vpb_load_user_details_displayer").append($(response).fadeIn());
			}
		});
		vpb_popup_box.css('display', 'block');

	});

	$('.vpb_link_attribute').live('mouseout', function()
	{
		if (vpb_time_out)
			clearTimeout(vpb_time_out);
			
		vpb_time_out = setTimeout(function()
		{
			vpb_popup_box.css('display', 'none');
		}, vpb_time_popup_is_allowed_to_stay);
	});

	/* This allows the mouse over event over i info without hiding the info */
	$('#vpb_load_user_details_main_wrapper').mouseover(function()
	{
		if (vpb_time_out)
			clearTimeout(vpb_time_out);
	});

	/* This hides the popup box when a user mouseout of the box */
	$('#vpb_load_user_details_main_wrapper').mouseout(function()
	{
		if (vpb_time_out)
			clearTimeout(vpb_time_out);
			
		vpb_time_out = setTimeout(function()
		{
			vpb_popup_box.css('display', 'none');
		}, vpb_time_popup_is_allowed_to_stay);
	});
});