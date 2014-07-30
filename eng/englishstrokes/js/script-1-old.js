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
		},
	},
	signup: {
		
	},
	
	students: {
		c : 1,
		showContent: function (ele, ite, id){
			//alert(ele);
			
			if(eng.jQuery(ite).hasClass('disabled'))
				return false;
			//eng.jQuery('#frame'+id).contentWindow.location.reload();
			var elementInner = eng.jQuery('#'+ele+id).children().children('object');
			eng.jQuery('.tab-container .btn-tab').removeClass('active');
			eng.jQuery(ite).addClass('active');
			eng.jQuery('.item-content').hide();
			eng.jQuery('#'+ele).show();
			eng.jQuery('.hide').hide();
			eng.jQuery('#'+ele+id).show();
			if(eng.jQuery('#'+ele+id).hasClass('flash'))
				mainFlashUrl = flasUrl[id];
			if(elementInner.length == 1)
				return false;
			//document.getElementById('frame'+id).contentWindow.location.reload(true);
			var activityId = ite.id.split("activity-tab-");
			
			if(document.getElementById('video'))
				document.getElementById('video').pause();
			
			var iframe = document.getElementById('frame'+eng.students.c);
			var innerDoc = (iframe.contentDocument) ? iframe.contentDocument : iframe.contentWindow.document;
			if(innerDoc.getElementById('Audio'))
			{
				//alert("qqqq");
				innerDoc.getElementById('Audio').pause();
			}
			if(ele == 'activity' && iframeRefresh.indexOf(parseInt(activityId[1])) >= 0)
			{
				document.getElementById('frame'+id).contentWindow.location.reload(true);
				//document.getElementById('frame'+id).contentWindow.show();
				eng.jQuery('.activity-load').show();
				iframeRefresh.splice( iframeRefresh.indexOf(parseInt(activityId[1])), 1 );
			}
			
			//alert(eng.students.c);
			eng.students.c = id;
		},
		showContent1: function(){
			alert("qwerty");
			var iframe = document.getElementById('frame'+id);
			//	alert(id);
			var innerDoc = (iframe.contentDocument) ? iframe.contentDocument : iframe.contentWindow.document;
			if(innerDoc.getElementById('Audio'))
			{
				//alert("qqqq");
				innerDoc.getElementById('Audio').pause();
			}
		}
	},
	games: {
		showGame: function (id){
			eng.jQuery('.transparent-black-container').show();
			eng.jQuery('.game-play').show();
			eng.jQuery('.game-play-inner').hide();
			eng.jQuery('#game'+id).show();
		}
	},
	pages: {
		showSyllabus: function (){
			eng.jQuery('.get-started-syllabus').show();
			eng.jQuery('.game-play').show();
		},
		validateContactForm: function(){
			var name = eng.jQuery('#txtname').val();
			var email = eng.jQuery('#txtemail').val();
			var message = eng.jQuery('#message').val();
			if(name.length == 0)
			{
				alert('Name should not be empty');
				return false;
			}
			if(email.length == 0)
			{
				alert('Email should not be empty');
				return false;
			}
			if(message.length == 0)
			{
				alert('Comment should not be empty');
				return false;
			}
		}
	},
	payment: {
		validatePayment: function (){
			if(!logged)
			{
				eng.login.showLoginBox();
				return false;
			}
		}
	}
});
eng.jQuery(document).ready(function($)
{
	if(document.getElementById("frame1"))
		document.getElementById("frame1").onload = function() {
		  eng.jQuery('.activity-load').hide();
		};
	if(document.getElementById("frame2"))
		document.getElementById("frame2").onload = function() {
		  eng.jQuery('.activity-load').hide();
		};
	if(document.getElementById("frame3"))
		document.getElementById("frame3").onload = function() {
		  eng.jQuery('.activity-load').hide();
		};
	if(document.getElementById("frame4"))
		document.getElementById("frame4").onload = function() {
		  eng.jQuery('.activity-load').hide();
		};
	if(document.getElementById("frame5"))
		document.getElementById("frame5").onload = function() {
		  eng.jQuery('.activity-load').hide();
		};
	eng.jQuery('.transparent-container').click(function(){
		eng.login.closeLogin();
		eng.jQuery('.alertContainnorClass').hide();
	});
	eng.jQuery('.transparent-black-container').click(function(){
		eng.jQuery('.transparent-black-container').hide();
		eng.jQuery('.game-play').hide();
		var video1 = document.getElementById('gram2');
		var video2 = document.getElementById('conv1');
		var video3 = document.getElementById('talking_cricket');
		video1.pause();
		video2.pause();
		video3.pause();
	});
	//eng.jQuery('.game-play-inner').click(function(){
//		return false;
//	});
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
					  pwd: password
				  },  
				  success: function(data, textStatus, XMLHttpRequest){
					eng.jQuery('.signin-loading').hide();
					if(data == 1)
						window.location.href = domainUrl;
					else
						$('#login_error').show();
					eng.login.loginSize(350);
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
					  user_login: username
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
		if(userName == 'Username' || userName.length < 5 || userName.length > 15)
		{
			eng.jQuery('#user_login').css('border', 'solid 2px #CB3536');
			error = true;
		}
		else
			eng.jQuery('#user_login').css('border', 'solid 1px #ccc');
		if(password == 'Password' || password.length < 7)
		{
			eng.jQuery('#user_pass').css('border', 'solid 2px #CB3536');
			error = true;
		}
		else
			eng.jQuery('#user_pass').css('border', 'solid 1px #ccc');
		if(email == 'Email' || !isEmailAddress(email))
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
			if(!$('#termscondition').is(':checked'))
			{
				alert('You must accept the terms and conditions');
				return false;
			}
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
					  role: role
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
				  user_login: user_login
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
				  user_email: user_email
			  },  
			  success: function(data, textStatus, XMLHttpRequest){
				if(data == 1)
					eng.jQuery('#user_email').css('border', 'solid 2px #CB3536');
				else
					eng.jQuery('#user_email').css('border', 'solid 1px #ccc');
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
			if($(this).children('div').html() == '<div class="plus"></div>')
			{
				
				$('.sidebar-inner-title div').each(function() {
					if($(this).html() == '<div class="minus"></div>')
						$(this).html('<div class="plus"></div>');
				});
				$(this).children('div').html('<div class="minus"></div>');
			}
			else if($(this).children('div').html() == '<div class="minus"></div>')
			{
				$(this).children('div').html('<div class="plus"></div>');
			}			
		});
	});
	
	eng.jQuery('#btn-fb-signup').unbind('submit').click(function(){
		var username = eng.jQuery('#user_login').val();
		var password = eng.jQuery('#user_pass').val();
		var userId = eng.jQuery('#userId').val();
		var role = eng.jQuery('#role').val();
		var error = false;
		if(username == 'Username' || username.length < 5 || username.length > 15)
		{
			eng.jQuery('#user_login').css('border', 'solid 2px #CB3536');
			error = true;
		}
		else
			eng.jQuery('#user_login').css('border', 'solid 1px #ccc');
		if(password == 'Password' || password.length < 7)
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
					  role: role
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
function isEmailAddress(str) {
	var pattern =/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if(!pattern.test(str))
		return false;
	return true;
}
eng.jQuery(document).keyup(function(e) {
    if(e.keyCode== 27) {
       eng.login.closeLogin();
    } 
});
function updateActivityStatus(id)
{
	eng.jQuery('#activity-tab-'+id).append('<div class="finished"></div>');
	eng.jQuery('#activity-tab-'+id).next().removeClass('disabled');
	eng.jQuery('.sidebar-body');
	if(eng.jQuery('#activity-tab-'+id).next().length == 1)
		eng.jQuery('#activity-tab-'+id).next().click();
	else
	{
		if(eng.jQuery('.sidebar-body ul li.current').next().length == 1)
		{
			var nextlink = eng.jQuery('.sidebar-body ul li.current').next().children('a').attr('href');
		}
		else
		{
			var nextlink = eng.jQuery('.sidebar-body ul li.current').parent().next().next().children().children().attr('href');
		}
		
		var currentLink = window.location.href;
		var linkArray = currentLink.split("?");
		top.location.href = linkArray[0] + nextlink;
	}
}

function checkLastActivity(id)
{
	//if(eng.jQuery('#activity-tab-'+id).next().length == 1)
		return true;
	//return false;
}

function SubmitScore(id)
{
	if(logged == false)
	{
		parent.updateActivityStatus(id);
		return false;
	}
	var xmlhttp;
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			parent.updateActivityStatus(id);
		}
	}
	var data = 'action=updateScore&activity_id='+id+'&correct=0&wrong=0';
	xmlhttp.open("GET", domainUrl+'wp-admin/admin-ajax.php?'+data,true);
	xmlhttp.send();
}

function checkUserLoggedIn()
{
	if(logged == true)
	{
		return 1;
	}
	else
	{
		eng.jQuery('.transparent-black-container').hide();
		eng.jQuery('.game-play').hide();
		eng.login.showLoginBox();
		//return 0;
	}
}
function getUsername()
{
	return 	username;
}

var iframeRefresh = Array();

function updateFrameLoad(id)
{
	iframeRefresh.push(id);
}

function videoLoaded()
{
	eng.jQuery('.video-loader').hide();
}

function updateIframeHeight(id, height)
{
	$('#frame'+id).css('height', height);
}

function updateFrameHeight(id)
{
	document.getElementById('frame'+id).height= (830) + "px";
}
var mainFlashUrl;
var flasUrl = Array();
function getgameurl()
{
	return mainFlashUrl;
}