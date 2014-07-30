if (typeof(eng)=='undefined')
{
	// We will recreate our joms namespace
	// with joms.jQuery pointing to their jQuery.
	eng = {
		jQuery: window.jQuery,
		extend: function(obj){
			this.jQuery.extend(this, obj);
		}
	}
}
eng.extend({
	login: {
		showLogin: function (){
			eng.jQuery('#signup').hide();
			eng.jQuery('#login').fadeIn();
			eng.login.loginSize(270);
		},
		showForgotPassword: function (){
			eng.jQuery('#login').hide();
			eng.jQuery('#forgot-password').fadeIn();
		},
		showSignup: function (){
			eng.jQuery('#login').hide();
			eng.jQuery('#signup').fadeIn();
			eng.login.loginSize(350);
		},
		showLoginBox: function (){
			eng.jQuery('#bitgravity_player').hide();
			eng.jQuery('.transparent-container').show();
			eng.jQuery('.login-container').fadeIn('slow');
			eng.login.showLogin();
		},
		showSignupBox: function (type){
			eng.jQuery('.transparent-container').show();
			eng.jQuery('.login-container').fadeIn('slow');			
			eng.login.showSignup();
			eng.jQuery('#role').val(type);
		},
		loginSize: function (size){
			eng.jQuery(".login-inner-container").animate({height: size+"px"}, 500 );
		},
		closeLogin: function (){
			eng.jQuery('#bitgravity_player').show();
			eng.jQuery('.transparent-container').hide();
			eng.jQuery('.login-container,.login-arrow1,.login-arrow2').hide();
		},
		closeForgotPassword: function (){
			eng.jQuery('#forgot-password').hide();
			eng.jQuery('#login').fadeIn();
		}
	},
	signup: {
		
	},
	students: {
		showContent: function (ele, ite, id){
			eng.jQuery('.tab-container .btn-tab').removeClass('active');
			eng.jQuery(ite).addClass('active');
			eng.jQuery('.item-content').hide();
			eng.jQuery('#'+ele).show();
			eng.jQuery('.hide').hide();
			eng.jQuery('#'+ele+id).show();
		}
	},
	games: {
		showGame: function (id){
			eng.jQuery('.transparent-black-container').show();
			eng.jQuery('.game-play-inner').hide();
			eng.jQuery('#game'+id).show();
		}
	},
	pages: {
		showSyllabus: function (){
			eng.jQuery('.get-started-syllabus').show();
		}
	}
});
eng.jQuery(document).ready(function($)
{
	eng.jQuery('.transparent-container').click(function(){
		eng.login.closeLogin();
	});
	eng.jQuery('.transparent-black-container').click(function(){
		eng.jQuery('.transparent-black-container').hide();
	});
	eng.jQuery('.game-play-inner').click(function(){
		return false;
	});
	eng.jQuery('.index-video').click(function(){
		eng.jQuery('.index-video-lightbox').show();
	});
	eng.jQuery('.index-video-lightbox').click(function(){
		eng.jQuery('.index-video-lightbox').hide();
		var videoHtml = eng.jQuery('#index-video-panel').html();
		eng.jQuery('#index-video-panel').html(videoHtml);
	});
	eng.jQuery('#btn-login').unbind('submit').click(function(){
		var username = eng.jQuery('#username').val();
		var password = eng.jQuery('#password').val();
		var error = false;
		if(username == 'Username')
		{
			eng.jQuery('#username').css('border', 'solid 2px #CB3536');
			error = true;
		}
		else
			eng.jQuery('#username').css('border', 'solid 1px #ccc');
		if(password == 'Password')
		{
			eng.jQuery('#password').css('border', 'solid 2px #CB3536');
			error = true;
		}
		else
			eng.jQuery('#password').css('border', 'solid 1px #ccc');
		if(!error)
		{
			eng.jQuery('.signin-loading').show();
			eng.jQuery.ajax({
				  type: 'POST',  
				  url: domainUrl+'wp-admin/admin-ajax.php',  
				  data: {  
					  action: 'MyAjaxFunction',  
					  log: username,
					  pwd: password,
				  },  
				  success: function(data, textStatus, XMLHttpRequest){
					eng.jQuery('.signin-loading').hide();
					if(data == 1)
						window.location.href = domainUrl;
					else
						$('#login_error').show();
					eng.login.loginSize(300);
					eng.jQuery('#login_error').html(data);
				  },  
				  error: function(MLHttpRequest, textStatus, errorThrown){  
				  alert(errorThrown);
				  }  
			});
		}
		return false;
	});
	eng.jQuery('#btn-password-reset').unbind('submit').click(function(){
		var username = eng.jQuery('#btn-password-reset').val();
		var error = false;		
		if(!error)
		{
			eng.jQuery('.signin-loading').show();
			eng.jQuery.ajax({
				  type: 'POST',  
				  url: domainUrl+'wp-admin/admin-ajax.php',  
				  data: {  
					  action: 'resetPassword',  
					  user_login: username,
				  },  
				  success: function(data, textStatus, XMLHttpRequest){
					eng.jQuery('.signin-loading').hide();alert(data);
					if(data == 1)
						window.location.href = domainUrl;
					else
						$('#login_error').show();
				  },  
				  error: function(MLHttpRequest, textStatus, errorThrown){  
				  alert(errorThrown);
				  }  
			});
		}
		return false;
	});
	eng.jQuery('#btn-signup').unbind('submit').click(function(){
		var firstName = eng.jQuery('#first_name').val();
		var userName = eng.jQuery('#user_login').val();
		var password = eng.jQuery('#user_pass').val();
		var email = eng.jQuery('#user_email').val();
		var role = eng.jQuery('#role').val();
		var error = false;
		if(firstName == 'Full Name')
		{
			eng.jQuery('#first_name').css('border', 'solid 2px #CB3536');
			error = true;
		}
		else
			eng.jQuery('#first_name').css('border', 'solid 1px #ccc');
		if(userName == 'Username')
		{
			eng.jQuery('#user_login').css('border', 'solid 2px #CB3536');
			error = true;
		}
		else
			eng.jQuery('#user_login').css('border', 'solid 1px #ccc');
		if(password == 'Password')
		{
			eng.jQuery('#user_pass').css('border', 'solid 2px #CB3536');
			error = true;
		}
		else
			eng.jQuery('#user_pass').css('border', 'solid 1px #ccc');
		if(email == 'Email')
		{
			eng.jQuery('#user_email').css('border', 'solid 2px #CB3536');
			error = true;
		}
		else
			eng.jQuery('#user_email').css('border', 'solid 1px #ccc');
		if(role == '0')
		{
			eng.jQuery('#role').css('border', 'solid 2px #CB3536');
			error = true;
		}
		else
			eng.jQuery('#role').css('border', 'solid 1px #ccc');			
		if(!error)
		{
			eng.jQuery('.signin-loading').show();
			eng.jQuery.ajax({
				  type: 'POST',  
				  url: domainUrl+'wp-admin/admin-ajax.php',  
				  data: {  
					  action: 'ajaxSignup',  
					  first_name: firstName,
					  user_login: userName,
					  user_pass: password,
					  user_email: email,
					  role: role,
				  },  
				  success: function(data, textStatus, XMLHttpRequest){
					eng.jQuery('.signin-loading').hide();
					if(data == 1)
					{						
						eng.jQuery('#signup').hide();
						eng.jQuery('.signup-success-container').show();
					}
					else
						eng.jQuery('#signup_error').html(data);
					$('#signup_error').show();
					eng.login.loginSize(400);					
				  },  
				  error: function(MLHttpRequest, textStatus, errorThrown){  
				  alert(errorThrown);
				  }  
			});
		}
		return false;
	});
	eng.jQuery('#user_login').blur(function() {
		var user_login = eng.jQuery('#user_login').val();		
		eng.jQuery.ajax({
			  type: 'POST',  
			  url: domainUrl+'wp-admin/admin-ajax.php',  
			  data: {  
				  action: 'checkUsername',  
				  user_login: user_login,
			  },  
			  success: function(data, textStatus, XMLHttpRequest){
				if(data == 1)
					eng.jQuery('#user_login').css('border', 'solid 2px #CB3536');
				else
					eng.jQuery('#user_login').css('border', 'solid 1px #ccc');
			  },  
			  error: function(MLHttpRequest, textStatus, errorThrown){  
			  alert(errorThrown);
			  }  
		  });
		return false;
	});
	eng.jQuery('#user_email').blur(function() {
		var user_email = eng.jQuery('#user_email').val();		
		eng.jQuery.ajax({
			  type: 'POST',  
			  url: domainUrl+'wp-admin/admin-ajax.php',  
			  data: {  
				  action: 'checkEmail',
				  user_email: user_email,
			  },  
			  success: function(data, textStatus, XMLHttpRequest){
				if(data == 1)
					eng.jQuery('#user_email').css('border', 'solid 2px #CB3536');
				else
					eng.jQuery('#user_login').css('border', 'solid 1px #ccc');
			  },  
			  error: function(MLHttpRequest, textStatus, errorThrown){  
			  alert(errorThrown);
			  }  
		  });
		return false;
	});
	eng.jQuery('.sidebar-inner-title').each(function() {
		eng.jQuery(this).click(function() {			
			eng.jQuery(this).addClass('active').next("ul").slideToggle("slow").siblings("ul:visible").slideUp("slow");			
		});
	});
	
	eng.jQuery('#btn-fb-signup').unbind('submit').click(function(){
		var username = eng.jQuery('#user_login').val();
		var password = eng.jQuery('#user_pass').val();
		var userId = eng.jQuery('#userId').val();
		var role = eng.jQuery('#role').val();
		var error = false;
		if(username == 'Username')
		{
			eng.jQuery('#user_login').css('border', 'solid 2px #CB3536');
			error = true;
		}
		else
			eng.jQuery('#user_login').css('border', 'solid 1px #ccc');
		if(password == 'Password')
		{
			eng.jQuery('#user_pass').css('border', 'solid 2px #CB3536');
			error = true;
		}
		else
			eng.jQuery('#user_pass').css('border', 'solid 1px #ccc');
		if(role == '0')
		{
			eng.jQuery('#role').css('border', 'solid 2px #CB3536');
			error = true;
		}
		else
			eng.jQuery('#role').css('border', 'solid 1px #ccc');
		if(!error)
		{
			eng.jQuery.ajax({
				  type: 'POST',  
				  url: domainUrl+'wp-admin/admin-ajax.php',  
				  data: {  
					  action: 'updateUsers',
					  user_id: userId,
					  user_login: username,
					  user_pass: password,
					  role: role,
				  },  
				  success: function(data, textStatus, XMLHttpRequest){
					if(data == 0)
						window.location.href = domainUrl;
					else
						eng.jQuery('#user_login').css('border', 'solid 2px #CB3536');
				  },  
				  error: function(MLHttpRequest, textStatus, errorThrown){  
				  alert(errorThrown);
				  }  
			});
		}
		return false;
	});
//	eng.jQuery('.sidebar1-title').each(function() {
//		eng.jQuery(this).click(function() {			
//			eng.jQuery('.siderbar-level-arrow').removeClass('active');
//			eng.jQuery(this).children('.siderbar-level-arrow').addClass('active');
//			eng.jQuery(this).next("div").slideToggle("slow").siblings("div.sidebar-body:visible").slideUp("slow");
//		});
//	});
});
eng.jQuery(document).keyup(function(e) {     
    if(e.keyCode== 27) {
       eng.login.closeLogin();
    } 
});