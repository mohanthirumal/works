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
			eng.login.loginSize(280);
			if(showCode)
			{
				$('#login_error').hide();
				eng.jQuery('#captcha-veri-container').show();
				eng.login.loginSize(350);
				logCount = 3;
				eng.jQuery('.login-container input.txtpassword').css('width',290);
			}
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
			//if(eng.jQuery('#'+ele+id).hasClass('flash'))
//				mainFlashUrl = flasUrl[id];
			if(elementInner.length == 1)
				return false;
			//document.getElementById('frame'+id).contentWindow.location.reload(true);
			var activityId = ite.id.split("activity-tab-");
			jwplayer().pause(true);
//			if(document.getElementById('video'))
//				document.getElementById('video').pause();
			
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
			mainFlashUrl = flasUrl[id];
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
			var commentBox = eng.jQuery('#message').val();
			var captcha = eng.jQuery('.contact-form-verification .recaptcha_response_field').val();
			//var captcha = eng.jQuery('.txtcapchh').val();
			var message = strip_tags(commentBox, "<b><i>");
			if(message.length < commentBox.length)
			{
				alert(" Invalid tags used in comment ");
				eng.jQuery('#message').css('border', 'solid 2px #CB3536');
				return false;
			}
			if(name.length == 0)
			{
				eng.jQuery('#txtname').css('border','solid 2px red');
				return false;
			}
			if(email.length == 0)
			{
				eng.jQuery('#txtemail').css('border','solid 2px red');
				return false;
			}
			if(message.length == 0)
			{
				eng.jQuery('#message').css('border','solid 2px red');
				return false;
			}
			if(captcha.length == 0)
			{
				eng.jQuery('.contact-form-verification .recaptcha_response_field').css('border','solid 2px red');
				return false;
			}
			eng.jQuery('#contact-form-submit-btn').hide();
		}
	},
	payment: {
		validatePayment: function (){
			if(!logged)
			{
				closePaymentPop();
				eng.login.showLoginBox();
				return false;
			}
		}
	}
});
var logCount = 0;
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
	eng.jQuery('.transparent-black-container,.game-play1').click(function(){
		eng.jQuery('.transparent-black-container').hide();
		eng.jQuery('.game-play').hide();
		jwplayer('gram2').pause(true);
		jwplayer('conv1').pause(true);
		jwplayer('talking_cricket').pause(true);
//		var video1 = document.getElementById('gram2');
//		var video2 = document.getElementById('conv1');
//		var video3 = document.getElementById('talking_cricket');
//		video1.pause();
//		video2.pause();
//		video3.pause();
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
		var verifyCode = eng.jQuery('#recaptcha_response_field').val();
		var totalform = $("#login").serialize();
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
		
		if(showCode)
			if(verifyCode.length == 0)
			{
				eng.jQuery('#recaptcha_response_field').css('border', 'solid 2px #CB3536');
				error = true;
			}
			else
				eng.jQuery('#recaptcha_response_field').css('border', 'solid 1px #ccc');

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
					  code: verifyCode,
					  coun: logCount,
					  form: totalform
				  },  
				  success: function(data, textStatus, XMLHttpRequest){
					eng.jQuery('.signin-loading').hide();
					data = JSON.parse(data);
					if(data.msg == 1)
					{
						$('#login_error').hide();
						eng.jQuery('#captcha-veri-container').css('display','none');
						window.location.href = domainUrl;
					}
					else
					{
						logCount = data.attempt;
						eng.login.loginSize(350);
						if(data.msg)
							$('#login_error').show();
//						if(logCount == 2)
//							updateLoginCheck();
						if(logCount > 1){
							eng.jQuery('#captcha-veri-container').css('display','block');
							eng.jQuery('.login-container input.txtpassword').css('width',300);
							eng.jQuery('#btn-login').css('margin-top','-29px');
							refreshCaptcha();
							eng.login.loginSize(450);
							showCode = 1;
						}
						eng.jQuery('#username').val('');
						eng.jQuery('#password').val('');
					}
					eng.jQuery('#login_error').html(data.msg);
					logCount++;
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
					eng.jQuery('.signin-loading').hide();
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
		var confirmPassword = eng.jQuery('#confirm_pass').val();
		var userId = eng.jQuery('#userId').val();
		var role = eng.jQuery('#role').val();
		var error = false;
		if(username.length == 0 || username.length < 5 || username.length > 15)
		{
			eng.jQuery('#user_login').css('border', 'solid 2px #CB3536');
			error = true;
		}
		else
			eng.jQuery('#user_login').css('border', 'solid 1px #ccc');
		if(password.length == 0 || confirmPassword != password || password.length < 7)
		{
			eng.jQuery('#user_pass').css('border', 'solid 2px #CB3536');
			eng.jQuery('#confirm_pass').css('border', 'solid 2px #CB3536');
			error = true;
		}
		else
		{
			eng.jQuery('#user_pass').css('border', 'solid 1px #ccc');
			eng.jQuery('#confirm_pass').css('border', 'solid 1px #ccc');
		}
		//if(role == '0')
//		{
//			eng.jQuery('#role').css('border', 'solid 2px #CB3536');
//			error = true;
//		}
//		else
//			eng.jQuery('#role').css('border', 'solid 1px #ccc');
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
	eng.jQuery('#newsletter-subscribe').unbind('submit').click(function(){
		var newsemail = eng.jQuery('#newsletter-txt').val();
		if(!isEmailAddress(newsemail))
		{
			eng.jQuery('#newsletter-txt').css('border', 'solid 2px #CB3536');
			return false;
		}
		eng.jQuery.ajax({
			  type: 'POST',  
			  url: domainUrl+'wp-admin/admin-ajax.php',  
			  data: {  
				  action: 'newsletterSubcription',
				  email: newsemail
			  },  
			  success: function(data, textStatus, XMLHttpRequest){
				if(data == '0')
					eng.jQuery('#newsletter-form').html('You are aleady subcribed for the newsletter.');
				else if(data == '1')
					eng.jQuery('#newsletter-form').html('Thank you for subcribing our newsltter.');
			  },  
			  error: function(MLHttpRequest, textStatus, errorThrown){  
			  alert(errorThrown);
			  }  
		});
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
//function updateActivityStatus(id)
//{
//	eng.jQuery('#activity-tab-'+id).append('<div class="finished"></div>');
//	eng.jQuery('#activity-tab-'+id).next().removeClass('disabled');
//	eng.jQuery('.sidebar-body');
//	if(eng.jQuery('#activity-tab-'+id).next().length == 1)
//		eng.jQuery('#activity-tab-'+id).next().click();
//	else
//	{
//		if(eng.jQuery('.sidebar-body ul li.current').next().length == 1)
//			var nextlink = eng.jQuery('.sidebar-body ul li.current').next().children('a').attr('href');
//		else if(eng.jQuery('.sidebar-body ul li.current').parent().next().length == 1)
//			var nextlink = eng.jQuery('.sidebar-body ul li.current').parent().next().next().children().children().attr('href');
//		else if(eng.jQuery('.sidebar-body ul li.current').parent().parent().parent().parent().next().children('a').length == 1)
//			var nextlink = '/overall-dashboard';
//			//var nextlink = eng.jQuery('.sidebar-body ul li.current').parent().parent().parent().parent().next().children('a').attr('href');
//		else
//			var nextlink = '/overall-dashboard';
//		if(typeof nextlink == 'undefined')
//			var nextlink = '/payment';
//		var currentLink = window.location.href;
//		var linkArray = currentLink.split("?");
//		top.location.href = linkArray[0] + nextlink;
//	}
//}

function checkLastActivity(id)
{
	//if(eng.jQuery('#activity-tab-'+id).next().length == 1)
		//return true;
	return true;
}

function SubmitScore(id, right, wrong)
{
//	if(logged == false)
//	{
//		parent.updateActivityStatus(id);
//		return false;
//	}
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
	var data = 'action=updateScore&activity_id='+id+'&correct='+right+'&wrong='+wrong;
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
//var mainFlashUrl;
//var flasUrl = Array();
//function getgameurl()
//{
//	return mainFlashUrl;
//}
function selectPayment(ele)
{
	$('.payment-column').removeClass('active');
	$(ele).addClass('active');
}
function selectPaymentOption(id)
{
	eng.jQuery('.transparent-payment-container').show();
	eng.jQuery('.billing-container').fadeIn('slow');
	eng.jQuery('.payment-title').hide();
	eng.jQuery('#payment-msg-'+id).show();
	//var price = eng.jQuery('#levelid'+id).val();
	//eng.jQuery('#amount').val(price);
	eng.jQuery('#reference_no').val(id);
}
function closePaymentPop()
{
	eng.jQuery('.transparent-payment-container').hide();
	eng.jQuery('.billing-container').hide();
}
function validateMyaccountForm()
{
	
}
function showScorecard(course_id, unit_id)
{
	eng.jQuery('.transparent-payment-container').show();
	eng.jQuery('#dynamic-scorecard').html('<div class="loading"></div>');
	eng.jQuery.ajax({
		  type: 'POST',  
		  url: domainUrl+'wp-admin/admin-ajax.php',  
		  data: {  
			  action: 'unitScorecard',
			  course_id: course_id,
			  unit_id: unit_id
		  },  
		  success: function(data, textStatus, XMLHttpRequest){
			eng.jQuery('#dynamic-scorecard').html(data)
		  },  
		  error: function(MLHttpRequest, textStatus, errorThrown){  
			  alert(errorThrown);
		  }  
	});
}
function closeScoreboard()
{
	eng.jQuery('.transparent-payment-container').hide();
}
function updateWritetous(id, comment)
{
	eng.jQuery.ajax({
		  type: 'POST',  
		  url: domainUrl+'wp-admin/admin-ajax.php',  
		  data: {  
			  action: 'writetous',
			  comment: comment,
			  activity_id: id
		  },  
		  success: function(data, textStatus, XMLHttpRequest){
			
		  },  
		  error: function(MLHttpRequest, textStatus, errorThrown){  
			  alert(errorThrown);
		  }  
	});
}
function showActivityLoad()
{
	eng.jQuery('.activity-load').show();
}
function hideActivityLoad()
{
	eng.jQuery('.activity-load').hide();
}

function showDashboardTable(id)
{
	eng.jQuery('.dashboard-table-all').hide();
	eng.jQuery('#dashboard-table-'+id).show();
}
function getYourCertificate(id, mark)
{
	if(mark < 60)
	{
		alert('Sorry, your marks are very low. You are not eligible to get the certificate!');
		return false;
	}
	eng.jQuery('.certificate-loader').show();
	eng.jQuery.ajax({
		  type: 'POST',  
		  url: domainUrl+'wp-admin/admin-ajax.php',  
		  data: {  
			  action: 'getYourCertificate',
			  id: id
		  },  
		  success: function(data, textStatus, XMLHttpRequest){
			  var course = JSON.parse(data);
			  for(i = 0; i < course.length; i++)
			  {
				  eng.jQuery('#row-right-'+course[i]).hide();
				  eng.jQuery('#row-wrong-'+course[i]).show();
			  }
			 eng.jQuery('.certificate-loader').hide();
		  },  
		  error: function(MLHttpRequest, textStatus, errorThrown){  
			  alert(errorThrown);
		  }  
	});
}
function emailCerificates(id,url)
{
		eng.jQuery.ajax({
		  type: 'POST',  
		  url: domainUrl+'wp-admin/admin-ajax.php',  
		  data: {  
			  action: 'getEmailCertificate',
			  id: id,
			  email_url:url,
		  },  
		  success: function(data, textStatus, XMLHttpRequest){
			  $('#EmailMycerificates').hide();
		  },  
		  error: function(MLHttpRequest, textStatus, errorThrown){  
			  alert(errorThrown);
		  }  
	});
	
}
function refreshCaptcha()
{
	//var img = document.images['captchaimg'];
	//img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
	Recaptcha.reload();
}
function contactusCaptcha()
{
	Recaptcha.reload();
	$('#captcha').html($('#captcha-veri-container').clone(true,true));
	$('.contact-form-verification #captcha-veri-container').css('display', 'block');
	$('.contact-form-verification .refresh-image').attr("onClick", "contactusCaptcha()");
}
function refreshContactCaptcha()
{
	var img = document.images['captchacontactimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
function updateLoginCheck()
{
	eng.jQuery.ajax({
		  type: 'POST',  
		  url: domainUrl+'wp-admin/admin-ajax.php',  
		  data: {  
			  action: 'LoginErrorCheck'
		  },  
		  success: function(data, textStatus, XMLHttpRequest){
		  },  
		  error: function(MLHttpRequest, textStatus, errorThrown){  
			  alert(errorThrown);
		  }  
	});
}
function mycouresLevelOne(id,courseId)
{
	eng.jQuery('#courseHistoryIdContent').html('');
	eng.jQuery('.loadingCourseHistory1').show();
	eng.jQuery('.contentClassContent').removeClass('contentClassContentActive');
	eng.jQuery('#contentClassContent'+courseId).addClass('contentClassContentActive');
	eng.jQuery.ajax({
			  type: 'POST',  
			  url: domainUrl+'wp-admin/admin-ajax.php',  
			  data: {  
				  action: 'getCourseLevel',
				  user_id: id,
				  course_id: courseId,
			  },  
			  success: function(data, textStatus, XMLHttpRequest){
				   eng.jQuery('.loadingCourseHistory1').hide();
				  eng.jQuery('#courseHistoryIdContent').html(data);
			  },  
			  error: function(MLHttpRequest, textStatus, errorThrown){  
			  alert(errorThrown);
			  }  
		});
}
function personalInfo()
{
	eng.jQuery('#mainContentMyAccount').html('');
	eng.jQuery('.loadingCourseHistory').show();

	eng.jQuery('.myAccountList').removeClass('onclass');
	eng.jQuery('#personal-info').addClass('onclass');
	
	
	eng.jQuery.ajax({
		  type: 'POST',  
		  url: domainUrl+'wp-admin/admin-ajax.php',  
		  data: {  
			  action: 'getPersonalInfo',
		  },  
		  success: function(data, textStatus, XMLHttpRequest){
			   eng.jQuery('.loadingCourseHistory').hide();
			  eng.jQuery('#mainContentMyAccount').html(data);
		  },  
		  error: function(MLHttpRequest, textStatus, errorThrown){  
		  alert(errorThrown);
		  }  
	});
	
}
function courseHistroy()
{
	eng.jQuery('#mainContentMyAccount').html('');
	eng.jQuery('.loadingCourseHistory').show();

	eng.jQuery('.myAccountList').removeClass('onclass');
	eng.jQuery('#course-history').addClass('onclass');
	
	
	eng.jQuery.ajax({
		  type: 'POST',  
		  url: domainUrl+'wp-admin/admin-ajax.php',  
		  data: {  
			  action: 'getCourseHistroy',
		  },  
		  success: function(data, textStatus, XMLHttpRequest){
			   eng.jQuery('.loadingCourseHistory').hide();
			  eng.jQuery('#mainContentMyAccount').html(data);
			   eng.jQuery('#contentClassContent1').click();
		  },  
		  error: function(MLHttpRequest, textStatus, errorThrown){  
		  alert(errorThrown);
		  }  
	});

}
function myCerificates(courseId,userId)
{
	
	eng.jQuery('#mainContentMyAccount').html('');
	eng.jQuery('.loadingCourseHistory').show();

	eng.jQuery('.myAccountList').removeClass('onclass');
	eng.jQuery('#my-cerificates').addClass('onclass');
	
	
	eng.jQuery.ajax({
		  type: 'POST',  
		  url: domainUrl+'wp-admin/admin-ajax.php',  
		  data: {  
			  action: 'getMyCerificates',
			  course:courseId,
			  user_id:userId,
		  },  
		  success: function(data, textStatus, XMLHttpRequest){
			   eng.jQuery('.loadingCourseHistory').hide();
			  eng.jQuery('#mainContentMyAccount').html(data);
			eng.jQuery('.tab-btn-my-cerificate').removeClass('ActiveHover-my-cerificate');
			eng.jQuery('#mycreificate'+courseId).addClass('ActiveHover-my-cerificate');
		  },  
		  error: function(MLHttpRequest, textStatus, errorThrown){  
		  alert(errorThrown);
		  }  
	});
	
	
}
function note(id)
{
	
	
		eng.jQuery('#mainContentMyAccount').html('');
	eng.jQuery('.loadingCourseHistory').show();

	eng.jQuery('.myAccountList').removeClass('onclass');
	eng.jQuery('#notes').addClass('onclass');
	
	
	eng.jQuery.ajax({
		  type: 'POST',  
		  url: domainUrl+'wp-admin/admin-ajax.php',  
		  data: {  
			  action: 'getMyNotes',
			  couresId:id
		  },  
		  success: function(data, textStatus, XMLHttpRequest){
			   eng.jQuery('.loadingCourseHistory').hide();
			  eng.jQuery('#mainContentMyAccount').html(data);
			  
				eng.jQuery('.firstClassContent').removeClass('levelId');
				eng.jQuery('#levelId-'+id).addClass('levelId');

		  },  
		  error: function(MLHttpRequest, textStatus, errorThrown){  
		  alert(errorThrown);
		  }  
	});
	
}


function strip_tags (input, allowed) {
	
  // http://kevin.vanzonneveld.net
  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Luke Godfrey
  // +      input by: Pul
  // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   bugfixed by: Onno Marsman
  // +      input by: Alex
  // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +      input by: Marc Palau
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +      input by: Brett Zamir (http://brett-zamir.me)
  // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   bugfixed by: Eric Nagel
  // +      input by: Bobby Drake
  // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   bugfixed by: Tomasz Wesolowski
  // +      input by: Evertjan Garretsen
  // +    revised by: Rafal Kukawski (http://blog.kukawski.pl/)
  // *     example 1: strip_tags('<p>Kevin</p> <br /><b>van</b> <i>Zonneveld</i>', '<i><b>');
  // *     returns 1: 'Kevin <b>van</b> <i>Zonneveld</i>'
  // *     example 2: strip_tags('<p>Kevin <img src="someimage.png" onmouseover="someFunction()">van <i>Zonneveld</i></p>', '<p>');
  // *     returns 2: '<p>Kevin van Zonneveld</p>'
  // *     example 3: strip_tags("<a href='http://kevin.vanzonneveld.net'>Kevin van Zonneveld</a>", "<a>");
  // *     returns 3: '<a href='http://kevin.vanzonneveld.net'>Kevin van Zonneveld</a>'
  // *     example 4: strip_tags('1 < 5 5 > 1');
  // *     returns 4: '1 < 5 5 > 1'
  // *     example 5: strip_tags('1 <br/> 1');
  // *     returns 5: '1  1'
  // *     example 6: strip_tags('1 <br/> 1', '<br>');
  // *     returns 6: '1  1'
  // *     example 7: strip_tags('1 <br/> 1', '<br><br/>');
  // *     returns 7: '1 <br/> 1'
  allowed = (((allowed || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join(''); // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
  var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
    commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
  return input.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
    return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
  });
}