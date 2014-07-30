$(document).ready(function () {
	$('#loader').hide();
	$('#progress').hide();
	var myUpload = $('#upload_link').upload({
	   name: 'image',
	   action: domainUrl+'/image-upload-handler.php',
	   enctype: 'multipart/form-data',
	   params: {upload:'Upload'},
	   autoSubmit: true,
	   onSubmit: function() {
			$('#loader').show();
			//loadingmessage('Please wait, uploading file...', 'show');
	   },
	   onComplete: function(response) {
			//loadingmessage('', 'hide');
			$('#loader').hide();
			response = unescape(response);
			var response = response.split("|");
			var responseType = response[0];
			var responseMsg = response[1];
			if(responseType=="success"){
				var current_width = response[2];
				var current_height = response[3];
				$('#uploaded_image').html('<img src="'+domainUrl+responseMsg+'" style="float: left; margin-right: 10px; max-width:200px;" id="thumbnail" alt="Create Thumbnail" /><div style="float:left; position:relative; overflow:hidden; width:50px; height:50px; border:solid 5px #000;"><img src="'+domainUrl+responseMsg+'" style="position: relative;" id="thumbnail_preview" alt="Thumbnail Preview" /></div>')
				$('#uploaded_image').find('#thumbnail').imgAreaSelect({ aspectRatio: '1:50/50', onSelectChange: preview, maxWidth: 50, maxHeight: 50, minWidth: 50, minHeight: 50, x1: 0, y1: 0, x2: 50, y2: 50 });

				//display the hidden form
				$('#thumbnail_form').show();
			}else if(responseType=="error"){
				$('#upload_status').show().html('<h1>Error</h1><p>'+responseMsg+'</p>');
				$('#uploaded_image').html('');
				$('#thumbnail_form').hide();
			}else{
				$('#upload_status').show().html('<h1>Unexpected Error</h1><p>Please try again</p>'+response);
				$('#uploaded_image').html('');
				$('#thumbnail_form').hide();
			}
		}
	});
	
	//create the thumbnail
	$('#save_thumb').click(function() {
		$('#loader').show();
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#w').val();
		var h = $('#h').val();
		if(x1.length == 0 || y1.length == 0 || x2.length == 0 || y2.length == 0 || w.length == 0 || h.length == 0 )
		{
			alert("You must make a selection first");
			return false;
		}
		else
		{
			//hide the selection and disable the imgareaselect plugin
			$('#uploaded_image').find('#thumbnail').imgAreaSelect({ disable: true, hide: true }); 
			$.ajax({
				type: 'POST',
				url: domainUrl+'/image-upload-handler.php',
				data: 'save_thumb=Save Thumbnail&x1='+x1+'&y1='+y1+'&x2='+x2+'&y2='+y2+'&w='+w+'&h='+h,
				cache: false,
				success: function(response){
					response = unescape(response);
					var response = response.split("|");
					var responseType = response[0];
					var responseLargeImage = response[1];
					var responseThumbImage = response[2];
					if(responseType=="success")
					{
						updateAvatar(responseThumbImage);
						$('#thumbnail_form').hide();
					}
					else
					{
						$('#thumbnail_form').show();
					}
				}
			});
			
			return false;
		}
	});
});
function preview(img, selection)
{ 
	//get width and height of the uploaded image.
	var current_width = $('#uploaded_image').find('#thumbnail').width();
	var current_height = $('#uploaded_image').find('#thumbnail').height();

	var scaleX = 50/selection.width; 
	var scaleY = 50/selection.height; 
	
	$('#uploaded_image').find('#thumbnail_preview').css({ 
		width: Math.round(scaleX * current_width) + 'px', 
		height: Math.round(scaleY * current_height) + 'px',
		marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
		marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
	});
	$('#x1').val(selection.x1);
	$('#y1').val(selection.y1);
	$('#x2').val(selection.x2);
	$('#y2').val(selection.y2);
	$('#w').val(selection.width);
	$('#h').val(selection.height);
}

function updateAvatar(url)
{
	var avatar = url;
	eng.jQuery.ajax({
		  type: 'POST',  
		  url: domainUrl+'wp-admin/admin-ajax.php',  
		  data: {  
			  action: 'updateAvatar',
			  avatar: avatar
		  },  
		  success: function(data, textStatus, XMLHttpRequest){
			eng.jQuery('#loader').hide();
			eng.jQuery('#current-avatar').attr('src', domainUrl+'avatars/'+url);
		  },  
		  error: function(MLHttpRequest, textStatus, errorThrown){  
			  alert(errorThrown);
		  }  
	});
}

function validatePersonalInfoForm()
{
	var firstname = $('#firstname').val();
	var lastname = $('#lastname').val();
	var year = $('#txtyear').val();
	var mobile = $('#phone').val();
	var address1 = $('#address1').val();
	var address2 = $('#address2').val();
	var country = $('#country').val();
	var state = $('#state').val();
	var city = $('#city').val();
	var postal = $('#postal').val();
	var msg = '';
	 if (/[^a-zA-Z0-9\-\/]/.test(firstname))
	 	msg = 'Special characters not allowed in First name !';
	else if (/[^a-zA-Z0-9\-\/]/.test(lastname))
	 	msg = 'Special characters not allowed in Last name !';
	 else if(mobile.length > 0 && isNaN(mobile))
		msg = 'Special characters not allowed in mobile number!';
	else if(postal.length > 0 && isNaN(postal))
		msg = 'Special characters not allowed in Postal code number!';
	else if(/^[a-zA-Z0-9-\n ]*$/.test(address1) == false)
		msg = 'Special characters not allowed in address1!';
	else if(/^[a-zA-Z0-9-\n ]*$/.test(address2) == false)
		msg = 'Special characters not allowed in address2!';
	else if(/^[a-zA-Z0-9-\n ]*$/.test(country) == false)
		msg = 'Special characters not allowed in Country!';
	else if(/^[a-zA-Z0-9-\n ]*$/.test(state) == false)
		msg = 'Special characters not allowed in State!';
	else if(/^[a-zA-Z0-9-\n ]*$/.test(city) == false)
		msg = 'Special characters not allowed in City!';
	
	if(msg.length > 0)
	{
		alert(msg);
		return false;
	}
}
function validatePersonalInfoPassword()
{
	msg='';
	var password = $('#newpassword').val();
	var confirmPassword = $('#verifynewpassword').val();
	if(password.length > 0 && password != confirmPassword)
		msg = 'Password and verify new  password should match!';
	else if(password.length > 0 && password.length < 6)
		msg = 'Password should be minimum of 6 characters!';
		
	if(msg.length > 0)
	{
		alert(msg);
		return false;
	}
}