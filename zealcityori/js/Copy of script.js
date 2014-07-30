if (typeof(zeal)=='undefined')
{
	// We will recreate our joms namespace
	// with joms.jQuery pointing to their jQuery.
	zeal = {
		jQuery: window.jQuery,
		extend: function(obj){
			this.jQuery.extend(this, obj);
		}
	}
}
zeal.extend({
	sidebar: {
		scoreScroll : 0,
		scoreScrollCurrent : 3,		
		scrollLeft: function(length, element){
			if(zeal.sidebar.scoreScrollCurrent >= zeal.sidebar.scoreScroll)
				return false;
			var left = zeal.jQuery('.'+element).css('margin-left');
			$('.'+element).animate({marginLeft: '-='+length+'px'}, 0);
			zeal.sidebar.scoreScrollCurrent++;
			//zeal.jQuery('.live-match-center-inner').css('margin-left','-184px');
		},
		scrollRight: function(length, element){
			if(zeal.sidebar.scoreScrollCurrent < 4)
				return false;
			var left = zeal.jQuery('.'+element).css('margin-left');
			if(left != '0px')
				$('.'+element).animate({marginLeft: '+='+length+'px'}, 0);
			zeal.sidebar.scoreScrollCurrent--;
			//zeal.jQuery('.live-match-center-inner').css('margin-left','-184px');
		}
	},
	index: {
		scoreScroll : 0,
		scoreScrollCurrent : 5,
		scrollInverval : 0,
		facebookShare: function()
		{
			FB.ui({		 
				method: 'stream.publish',
				picture: 'images/share_home_image.jpg',
				link: '',
				name: 'Online Multiplayer Rummy',
				caption: 'I am ready to take on the world at zealcity.com!!! its awesome so Come and challenge me here in fun & cash tournaments.',
				description: ''
			});
		},
		showContent: function (classname, element, id, add, remove){
			zeal.jQuery('.'+classname).hide();
			zeal.jQuery('#'+element+id).fadeIn();
			zeal.jQuery('.'+remove+' ul li').removeClass('active');
			zeal.jQuery(add).addClass('active');
		},
		scrollLeft: function(length, element, type){
			if(zeal.index.scoreScrollCurrent >= zeal.index.scoreScroll)
				return false;
			var left = zeal.jQuery('.'+element).css('margin-left');
			$('.'+element).animate({marginLeft: '-='+length+'px'}, 1000);
			zeal.index.scoreScrollCurrent++;
			if(type == 1)
				zeal.index.scrollInverval = setInterval(function(){zeal.index.scrollLeft(186,'live-match-center-inner', 0)}, 1000);
		},
		scrollRight: function(length, element, type){
			if(zeal.index.scoreScrollCurrent < 6)
				return false;
			var left = zeal.jQuery('.'+element).css('margin-left');
			if(left != '0px')
				$('.'+element).animate({marginLeft: '+='+length+'px'}, 1000);
			zeal.index.scoreScrollCurrent--;
			if(type == 1)
				zeal.index.scrollInverval = setInterval(function(){zeal.index.scrollRight(186,'live-match-center-inner', 0)}, 1000);
		},
		scrollTopTimer: function(){
			clearInterval(zeal.index.scrollInverval);
		},
		getHeaderScore: function(){
			zeal.index.scoreScroll = 0;
			$.ajax({
				type: 'GET',
				url: base_url+'ajax.php',
				data: 'action=headerscore',
				success: function(data)
				{					
					zeal.jQuery('#livescore-header').html(data);
					setTimeout("zeal.index.getHeaderScore();", refreshInterval);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		},
		getSidebarScore: function(){
			zeal.sidebar.scoreScroll = 0;
			$.ajax({
				type: 'GET',
				url: base_url+'ajax.php',
				data: 'action=sidebarscore',
				success: function(data)
				{					
					zeal.jQuery('#livescore-sidebar').html(data);
					setTimeout("zeal.index.getSidebarScore();", refreshInterval);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		}
	},	
	userteam: {	
		selectTournament1: function (user_id,id){
			zeal.jQuery('#join-tournament').html('<div class="loading"></div>');
			zeal.jQuery('.transparent-container').fadeIn('slow');
			zeal.jQuery('#join-tournament').fadeIn('slow');
			var	url = base_url+'userteam.php';
			$.get(
			url,
			({'user_id': user_id,'tour_id':id}),
			function(data)
			{						
				zeal.jQuery('#join-tournament').html(data);
			});
			return false;
		},
		closeUserTeam: function(){
			zeal.jQuery('#join-tournament').hide();
			zeal.jQuery('.transparent-container').hide();
		},
		dynamicScore: function(id){
			var	url = base_url+'dynamic-score.php';		
			$.get(
			url,
			({'id': id}),
			function(data)
			{
				zeal.jQuery('#myteam1').html(data);
				setTimeout("zeal.userteam.dynamicScore("+id+");", refreshInterval);
			});			
		},
		dynamicResult: function(id){
			zeal.jQuery('#myteam-loading').show();
			var	url = base_url+'dynamic-results.php';		
			$.get(
			url,
			({'id': id}),
			function(data)
			{				
				zeal.jQuery('#myteam-loading').hide();
				if(data.length == 0)
					return false;
				zeal.jQuery('#dynamicresult').html(data);
				setTimeout("zeal.userteam.dynamicResult("+id+");", refreshInterval);
			});			
		}
	},
	tournament: {
		viewallPlayers: function (){
			zeal.jQuery('.view-all-container').show();
		},
		viewallplayerCancel: function (){
			zeal.jQuery('.view-all-container').hide();
		},
		selectTournament: function (tour_id){
			zeal.jQuery('#join-tournament').html('<div class="loading"></div>');
			zeal.jQuery('.transparent-container').fadeIn('slow');
			zeal.jQuery('#join-tournament').fadeIn('slow');
			var	url = 'join-tournament.php';		
			$.get(
				url,
				({'tour_id': tour_id}),
				function(data)
				{
					zeal.jQuery('#join-tournament').html(data);
				});	
			return false;
		},
		JointoConfirmWindow: function(){
			zeal.jQuery('.innercontainer').hide();			
			zeal.jQuery('.tournregis-innercontainer').fadeIn('slow');
		},
		inSufficientCashWindow: function(){
			zeal.jQuery('.innercontainer').hide();			
			zeal.jQuery('.tournregis-innercontainer').hide();
			zeal.jQuery('.insufficientcash').fadeIn('slow');
		},
		confirmJoin: function (tour_id){
			if(!loggedIn){
				zeal.jQuery('.join-tournament').hide();
				zeal.user.showSignin();
				return false;
			}
			zeal.tournament.joinTournament(tour_id);
		},
		closeTournament: function (){
			zeal.jQuery('.join-tournament').hide();
			zeal.jQuery('.transparent-container').hide();
		},
		showTeamPlayers: function (tour_id){
			var	url = 'select-players.php';
			$.get(
			url,
			({'tour_id': tour_id}),
			function(data)
			{
				zeal.jQuery('#join-tournament').html(data);
			});	
		},
		joinTournament: function (tour_id){
			zeal.jQuery('.tournament-join-loading').html('<div class="loading"></div>');
			zeal.jQuery('#confirmbutton').hide();
			zeal.jQuery('.cancelbutton').css('margin-left', '170px');
			var	url = 'join-tournament.php';
			$.ajax({
				type: 'GET',
				url: base_url+'join-tournament.php',
				async: true,
				cache: false,
				dataType : "json",
				data: 'action=join&tour_id=' + tour_id,
				success: function(jsonData)
				{
					if(jsonData.hasErrors)
					{
						if(jsonData.errors == 'cash')
						{
							zeal.tournament.inSufficientCashWindow();
							return false;
						}
						zeal.errors.showError(jsonData.errors);
						zeal.jQuery('.tournament-join-loading').hide();
					}
					else
						window.location.href = 'my-tournament/'+jsonData.id;
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		},
		calculateTime: function (year, month, day, hour, minute, second){
			var austDay = new Date(year, month - 1, day, hour, minute, second);
			$('#defaultCountdown').countdown({until: austDay, format: 'HMS',description: '', serverSync: zeal.tournament.serverTime});
		},
		nextMatchTime: function (year, month, day, hour, minute, second){
			var austDay = new Date(year, month - 1, day, hour, minute, second);
			$('#next-starts-in').countdown({until: austDay, format: 'HMS',description: '', serverSync: zeal.tournament.matchServerTime, compact: true});
		},
		activeTournament: 'index-lobby-room',
		showTournament: function (parent, common, active, tab){
			zeal.tournament.activeTournament = active;
			zeal.jQuery('.'+parent+' .'+common).hide();
			zeal.jQuery('.'+parent+' .'+active).show();
			zeal.jQuery('.'+parent+' ul li').removeClass('active');
			zeal.jQuery(tab).addClass('active');
		},
		serverTime: function (){
			servertime.setMonth(servertime.getMonth() - 1);
			return servertime;
		},
		matchServerTime: function (){
			matchservertime.setMonth(matchservertime.getMonth() - 1);
			return matchservertime;
		}
	},
	user: {
		unameerrorIndicate:true,
		passerrorIndicate:true,
		emailerrorIndiacate:true,
		verifycodeIndiacate:true,
		showSignUp: function (){
			zeal.jQuery('#join-tournament').html('<div class="loading"></div>');
			zeal.jQuery('.transparent-container').fadeIn('slow');
			zeal.jQuery('#join-tournament').fadeIn('slow');
			var	url = 'sign-up.php';		
			$.get(
				url,
				function(data)
				{
					zeal.jQuery('#join-tournament').html(data);
					zeal.jQuery('#signup').show();
				});	
			return false;
		},
		closeSignUp: function (){
			zeal.jQuery('.transparent-container').hide();		
			zeal.jQuery('#signup').hide();
		},
		showSignin: function (){
			zeal.jQuery('#join-tournament').html('<div class="loading"></div>');
			zeal.jQuery('.transparent-container').fadeIn('slow');
			zeal.jQuery('#join-tournament').fadeIn('slow');
			var	url = 'sign-in.php';		
			$.get(
				url,
				function(data)
				{
					zeal.jQuery('#join-tournament').html(data);
					zeal.jQuery('#signin').show();
				});	
			return false;
		},
		closeSignin: function (){
			zeal.jQuery('.transparent-container').hide();
			zeal.jQuery('#signin').hide();
		},
		signupconfirmPass: function(){
			var temp=true;
			var pass=zeal.jQuery('#txtpassword').val();
			var conpass=zeal.jQuery('#txtpassword2').val();
			if((pass.length==0) && (conpass.length==0)){
				zeal.jQuery('.pass-message').show();
				temp=false;
			}
			else if(pass.length<8 && conpass.length<8){
				zeal.jQuery('.pass-message').show();
				temp=false;
			}
			else if(pass!=conpass)
				temp=false;
			if(temp==false){
				zeal.jQuery('.pass-no-image').show();	
				zeal.jQuery('.pass-ok-image').hide();				
				zeal.user.passerrorIndicate=true;
			}
			else{
				zeal.jQuery('.pass-no-image').hide();	
				zeal.jQuery('.pass-ok-image').show();
				zeal.jQuery('.pass-message').hide();	
				zeal.user.passerrorIndicate=false;
			}
		},
		loginValidate: function()
		{
			var loginname=zeal.jQuery('#txtemaillogin').val();
			var loginpass=zeal.jQuery('#txtpasswordlogin').val();
			if(loginname.length == 0 || loginpass.length == 0)
			{
				alert("Fields cant be empty");
				return false;
			}		
		},
		confirmPass: function (){
			var pass=zeal.jQuery('#connecttxtpassword').val();
			var conpass=zeal.jQuery('#connecttxtpassword2').val();
			if((pass.length==0) && (conpass.length==0)){
				zeal.jQuery('.pass-ok-image').hide();
				zeal.jQuery('.pass-no-image').show();	
				return false;			
			}
			if (pass!=conpass){
				zeal.jQuery('.pass-ok-image').hide();
				zeal.jQuery('.pass-no-image').show();
				zeal.user.passerrorIndicate=true;	
			}
			else{
				zeal.jQuery('.pass-no-image').hide();	
				zeal.jQuery('.pass-ok-image').show()	
				zeal.user.passerrorIndicate=false;
			}
		},
		emailExist: function(email, callback){
			$.ajax({
				type: 'GET',
				url: base_url+'ajax.php',
				data: 'action=emailexist&email=' + email,
				success: function(data)
				{
					if(data == '1')
						callback(false);
					else
						callback(true);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		},
		usernameExist: function(username, callback){	
			$.ajax({
				type: 'GET',
				url: base_url+'ajax.php',
				data: 'action=usernameexist&username=' + username,
				success: function(data)
				{
					if(data == '1')
						callback(false);
					else
						callback(true);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				},				
			});
		},
		refreshCaptcha: function()
		{
			var img = document.images['captchaimg'];
			document.getElementById("capchaChecked").value = "false"
			img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
		},
		verifyCaptcha: function(value, callback){
			$.ajax({
				type: 'GET',
				url: base_url+'ajax.php',
				data: 'action=verifycaptch&value=' + value,
				success: function(data)
				{
					if(data == '1')
						callback(false);
					else
						callback(true);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				},				
			});
		},
		validateUsername: function(ele){
			var username_regex = /^[A-Za-z0-9._]+$/; 
			var usertemp=true;
			if(ele.value.length==0){
				usertemp=false;
				zeal.jQuery('.user-message').show();
			}
			else if((ele.value.length<5) || (ele.value.length>15)){
				zeal.jQuery('.user-message').show();
				zeal.jQuery('.special-message').hide();				
				usertemp=false;
			}
			else if(!ele.value.match(username_regex)){
				zeal.jQuery('.special-message').show();
				zeal.jQuery('.user-message').hide();
				usertemp=false;
			}
			if(usertemp==false){
			zeal.user.unameerrorIndicate=true;
				zeal.jQuery('.uname-ok-image').hide();
				zeal.jQuery('.uname-no-image').show();
				return false;
			}
			else{
				zeal.user.unameerrorIndicate=false;
				zeal.jQuery('.uname-ok-image').show();
				zeal.jQuery('.uname-no-image').hide();
				zeal.jQuery('.user-message').hide();
				zeal.jQuery('.special-message').hide();				
			}
			zeal.user.usernameExist(ele.value, function(returnValue) {				
				if(returnValue==false){
					zeal.user.unameerrorIndicate=true;
					zeal.jQuery('.uname-ok-image').hide();
					zeal.jQuery('.uname-no-image').show();
					return false;
				}
				else{
					zeal.user.unameerrorIndicate=false;							
					zeal.jQuery('.uname-ok-image').show();
					zeal.jQuery('.uname-no-image').hide();						
				}
			});	
		},
		validateCode: function(ele){	
			zeal.user.verifyCaptcha(ele.value, function(returnValue) {
				if(returnValue==false){
					zeal.user.verifycodeIndiacate=true;
					zeal.jQuery('.code-ok-image').hide();
					zeal.jQuery('.code-no-image').show();
				}
				else{
					zeal.user.verifycodeIndiacate=false;							
					zeal.jQuery('.code-ok-image').show();
					zeal.jQuery('.code-no-image').hide();						
				}				
			});
		},
		validateEmailaddress: function(ele){
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(ele.value.length==0){
				zeal.jQuery('.email-no-image').show();
				zeal.jQuery('.email-ok-image').hide();			
				return false;
			}
			else if(!filter.test(ele.value))
			{
				alert("Invalid Email");
				zeal.jQuery('.email-no-image').show();
				zeal.jQuery('.email-ok-image').hide();			
				return false;
			}
			zeal.user.emailExist(ele.value, function(returnValue) {
				if(returnValue==false){
					zeal.user.emailerrorIndiacate=true;
					zeal.jQuery('.email-ok-image').hide();
					zeal.jQuery('.email-no-image').show();
				}
				else{
					zeal.user.emailerrorIndiacate=false;							
					zeal.jQuery('.email-ok-image').show();
					zeal.jQuery('.email-no-image').hide();
				}
			});
		},
		showSignupSuccess: function(){
			zeal.jQuery('#signup form').remove();
			zeal.jQuery('.transparent-container').show();
			zeal.jQuery('.loading').hide();
			zeal.jQuery('#signupsuccess').show();
		},
		closeSignupSuccess: function(){
			zeal.jQuery('.transparent-container').hide();
			zeal.jQuery('#signupsuccess').hide();
		},
		showDeposit: function(){
			zeal.user.closeSignupSuccess();
			zeal.jQuery('.transparent-container').show();
			zeal.jQuery('#join-tournament').fadeIn('slow');
			zeal.jQuery('#join-tournament').html('<div class="loading"></div>');
			zeal.jQuery('#deposit-cont').show();
			var	url = 'quick-deposit.php';
			$.get(
			url,
			({'deposit': 1}),
			function(data)
			{
				zeal.jQuery('#join-tournament').html(data);
			});
		},
		closeDeposit: function(){
			window.location.href = window.location;
		}
	},
	players: {
		count: 0,
		team1: 0,
		team2: 0,
		budjet: 0,
		add: function (id){
			var rel = zeal.jQuery('#player'+id).attr('rel');
			var salary = zeal.jQuery('#salary'+id).val();
			var budjet = zeal.jQuery('#budjet').val();
			if(zeal.players.count == 11)
			{
				zeal.errors.showPopError('You can select only 11 players');
				return false;
			}
			if((parseInt(zeal.players.budjet) + parseInt(salary)) > budjet)
			{
				zeal.errors.showPopError('Exceeds Budget');
				return false;
			}			
			if(rel == "team1")
				if(zeal.players.team1 < 6)
					zeal.players.team1 ++;
				else
				{
					zeal.errors.showPopError('Maximum 6 players is allowed per team');
					return false;
				}
			if(rel == "team2")
				if(rel == "team2" && zeal.players.team2 < 6)
					zeal.players.team2 ++;
				else
				{
					zeal.errors.showPopError('Maximum 6 players is allowed per team');
					return false;
				}			
			zeal.players.budjet += parseInt(salary);
			zeal.players.updateBudjet(zeal.players.budjet);
			$element = zeal.jQuery('#player'+id);
			var $picture = $element.children('.playername').children("img").clone();			
			var myTeam = zeal.jQuery('#myteam').offset();
			var team1 = zeal.jQuery('.mytournament-playermenu').offset();
			$picture.appendTo('body');
			
			//Add Captain in drop down
			var opt = document.createElement("option");
			opt.text = $element.children('.playername').text();
			opt.value = id;
			document.getElementById("ddcaptain").options.add(opt);
			
			//$element.hide();
			zeal.jQuery('#selectteamplayers').html("Players - " + (zeal.players.count+1) + "/" + (11-(zeal.players.count+1)));
			$element.prependTo('#myteam');
			zeal.jQuery('#player'+id+' div input').attr('onclick','zeal.players.remove('+id+')');
			zeal.jQuery('#player'+id+' div input').attr('value','');
			zeal.jQuery('#player'+id+' div input').addClass('btn-remove-player');
			zeal.jQuery('#player'+id+' div input').removeClass('addfunds');
			$element.children('.run').hide();			
			zeal.players.count ++;
			$picture.css({ 'position': 'absolute', 'top': team1.top, 'left': team1.left, 'z-index': '11', 'opacity': 0.6, 'width': '100px'})
			.animate({'top': myTeam.top, 'left': myTeam.left}, 1000)
			.fadeOut(100, function() {
				//$element.show();
			});
		},
		remove: function (id){
			$element = zeal.jQuery('#player'+id);
			var $picture = $element.children('.playername').children("img").clone();			
			var myTeam = zeal.jQuery('.mytournament-playermenu').offset();
			var team1 = zeal.jQuery('#myteam').offset();
			var salary = zeal.jQuery('#salary'+id).val();
			$picture.appendTo('body');
			var rel = zeal.jQuery('#player'+id).attr('rel');
			zeal.jQuery('#player'+id).children('.run').show();
			if(zeal.jQuery('#player'+id).children('script'))
					zeal.jQuery('#player'+id).children('script').remove();
			//zeal.jQuery('#player'+id).hide();
			if(rel == "team1")
			{				
				zeal.jQuery('#player'+id).prependTo('#team1');
				zeal.players.team1 --;
			}
			else
			{
				zeal.jQuery('#player'+id).prependTo('#team2');
				zeal.players.team2 --;
			}
			
			var captainSelect = document.getElementById("ddcaptain");
            for (var i = 0; i < captainSelect.options.length; i++)
            {
                if (id == captainSelect.options[i].value)
                {
                    captainSelect.options[i] = null;
                    break;
                }
            }
			zeal.jQuery('#selectteamplayers').html("Players - " + (11-(zeal.players.count-1)) + "/" + ((zeal.players.count+1)-2));
			zeal.players.budjet -= parseInt(salary);
			zeal.players.updateBudjet(zeal.players.budjet);
			zeal.jQuery('#player'+id+' div input').attr('onclick','zeal.players.add('+id+')');
			zeal.jQuery('#player'+id+' div input').addClass('addfunds');
			zeal.jQuery('#player'+id+' div input').removeClass('btn-remove-player');
			zeal.jQuery('#player'+id+' div input').attr('value','Add');
			zeal.players.count --;
			$picture.css({ 'position': 'absolute', 'top': team1.top, 'left': team1.left, 'z-index': '11'})
			.animate({'top': myTeam.top, 'left': myTeam.left}, 1000)
			.fadeOut(100, function() {
				//zeal.jQuery('#player'+id).show();
			});
		},
		
		updateBudjet: function(budjet){
			var budjetTotal = zeal.jQuery('#budjet').val();
			budjetTotal -= budjet;
			zeal.jQuery('.budjet-text').text((budjetTotal).toLocaleString());
		},
		
		closewindow: function(){
			zeal.jQuery('.fund-fulls').hide();	
		},
		HiddedWindow: function(){
			zeal.jQuery('.left-hidden-container').fadeOut('slow');
			zeal.jQuery('.step2-hidden').fadeOut('slow');
			zeal.jQuery('.step3-hidden').fadeOut('slow');
		},
		
		filter: function(ele, filter){
			if(zeal.jQuery(ele).is(':checked') && filter == 'team1')
			{
				zeal.jQuery('.mytournament-players ul li.team2').hide();
				zeal.jQuery('.mytournament-players ul li.team1').show();
				$('#filterteam2').prop('checked', false);
			}
			else if(zeal.jQuery(ele).is(':checked') && filter == 'team2')
			{
				zeal.jQuery('.mytournament-players ul li.team1').hide();
				zeal.jQuery('.mytournament-players ul li.team2').show();
				$('#filterteam1').prop('checked', false);
			}
			else
			{
				zeal.jQuery('.mytournament-players ul li.team1').show();
				zeal.jQuery('.mytournament-players ul li.team2').show();
			}
		}
	},
	facebook:{
		email: '',
		login: function(id){
			zeal.jQuery('#'+id).html('<div class="loading"></div>');
			FB.login(function(response) {
				if (response.authResponse) {
					var userID = response.authResponse.userID;
					$.ajax({
						type: 'GET',
						url: base_url+'ajax.php',
						data: 'action=fblogin&id=' + userID,
						success: function(data)
						{
							if(data == '1')
								window.location.href = '?fblogin';
							else if(data == '0')
								zeal.facebook.showSignup(userID);
							else
								alert('error');
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {
							// in front-office, do not display technical error
							//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
						}
					});
				}
				else
					window.location.href = '';
			}, { scope:'email, publish_stream, publish_actions'});
		},
		sync: function(id){
			FB.login(function(response) {				
				if (response.authResponse) {
					var userID = response.authResponse.userID;
					$.ajax({
						type: 'GET',
						url: base_url+'ajax.php',
						data: 'action=fbsync&id=' + userID + '&userid=' + id,
						success: function(data)
						{
							if(data == '1')
								alert('Success')
							else
								alert('Error');
							window.location.href = '';
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {
							// in front-office, do not display technical error
							//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
						}
					});
				}
			}, { scope:'email, publish_stream, publish_actions'});
		},
		showSignup: function(id){			
			var	url = 'connect.php';
			$.get(
			url,
			({'id': id}),
			function(data)
			{
				zeal.jQuery('.signin-container').hide();
				zeal.user.closeSignUp();
				zeal.jQuery('.transparent-container').show();
				zeal.jQuery('#join-tournament').fadeIn('slow');
				zeal.jQuery('#join-tournament').html(data);
			});	
		},
		closeSignup: function(){
			window.location.href=window.location;
			zeal.jQuery('.signin-container').hide();
			zeal.jQuery('#join-tournament').hide();
			zeal.jQuery('.transparent-container').hide();
		},
		signup: function() {
			if(zeal.user.unameerrorIndicate==true || zeal.user.passerrorIndicate==true)
			{
				alert('Fields cant be empty');
				return false;
			}
			if(!zeal.jQuery("#fbsignuptc").is(':checked'))
			{
				alert('Please accept the terms and conditions');
				return false;
			}
			zeal.jQuery('#fbsignup').show();
			zeal.facebook.emailExist(function(returnValue) {
			 	if(returnValue)
				{					
					var username = zeal.jQuery('#txtusernameconnect').val();
					var password = zeal.jQuery('#txtpasswordconnect').val();
					zeal.jQuery.ajax({
						type: 'POST',  
						url: 'index.php',
						dataType : "json",
						data: {  
						  action: 'signup', 
						  username: username,
						  email: zeal.facebook.email,
						  password: password,
						  connect: 'true',
						},  
						success: function(jsonData, textStatus, XMLHttpRequest){
							if(jsonData.hasErrors)
									zeal.errors.showError(jsonData.errors);
							else
								window.location.href = '?fblogin';
						},  
						error: function(MLHttpRequest, textStatus, errorThrown){  
						alert(errorThrown);
						}
					});
				}
				else
				{
					alert('Sorry, this facebook account email id is already associated with other account');
					return false;
				}
			});			
		},
		emailExist: function(callback) {
			FB.api('/me', function (response) {
				zeal.facebook.email = response.email;
				zeal.user.emailExist(response.email, function(returnValue) {
					callback(returnValue);
				});
            });
		},
		inviteFriend: function(userId, inviteId) {
			$.ajax({
				type: 'GET',
				url: base_url+'ajax.php',
				data: 'action=fbinvite&inviteId=' + inviteId + '&userId=' + userId,
				success: function(data)
				{
					//alert(data);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		}
	},
	myteam: {
		//showMyteam: function (tour_id){
//			zeal.jQuery('#join-tournament').fadeIn('slow');
//			var	url = 'my-team.php';
//			$.get(
//				url,
//				({'tour_id': tour_id}),
//				function(data)
//				{
//					zeal.jQuery('#join-tournament').html(data);
//				});	
//			return false;
//		}
		
	},
	
	myaccount: {
		personaldetail: function(){
			//alert("Your account has been updated Successfully");
		},
		withdrawamt: function(){
			var amt=document.getElementById('wamount').value;
			if(amt.length == 0)
			{
				alert("please enter the amount to withdraw");
				return false;
			}
		}
	},
	mytournament: {
		validatemytourn: function()
		{
			if(document.getElementById('ddcaptain').selectedIndex == 0)
			{
				alert("Please select captain");
				return false;
			}
			else if(document.getElementById('ddcoach').selectedIndex == 0)
			{
				alert("Please select coach");
				return false;
			}
			if(zeal.players.count == 11)
				return true;
			else {
				alert('please select 11 players');
				return false;	
			}
		}
	},
	research: {
		pitchReport : function (id){
			zeal.jQuery('.research-table-pitch').hide();
			zeal.jQuery('.research-table-content-pitch').show();
			zeal.jQuery('#research-back-pitch').show();
			$.ajax({
				type: 'GET',
				url: base_url+'research-ajax.php',
				data: 'action=pitchreport&id=' + id,
				success: function(data)
				{
					if(data.length > 0)						
						zeal.jQuery('#pitch-report-post').html(data);
					else
						zeal.jQuery('#pitch-report-post').html('No Data');
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		},
		closePitchReport : function (){
			zeal.jQuery('.research-table-pitch').show();
			zeal.jQuery('.research-table-content-pitch').hide();
			zeal.jQuery('#research-back-pitch').hide();
		},
		upComingMatches : function (id){
			zeal.jQuery('.research-table-upcoming').hide();
			zeal.jQuery('.research-table-content-upcoming').show();
			zeal.jQuery('#research-back-upcoming').show();
			zeal.jQuery('#research-upcomingmatches').html('<div class="loading"></div>');
			$.ajax({
				type: 'GET',
				url: 'research-ajax.php',
				data: 'action=upcomingmatches&id=' + id,
				success: function(data)
				{
					if(data.length > 0)						
						zeal.jQuery('#research-upcomingmatches').html(data);
					else
						zeal.jQuery('#research-upcomingmatches').html('No Data');
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		},
		closeUpComingMatches : function (){
			zeal.jQuery('.research-table-upcoming').show();
			zeal.jQuery('.research-table-content-upcoming').hide();
			zeal.jQuery('#research-back-upcoming').hide();
		},
		weatherReport : function (id){
			zeal.jQuery('.research-table-weather').hide();
			zeal.jQuery('.research-table-content-weather').show();
			zeal.jQuery('#research-back-weather').show();
			$.ajax({
				type: 'GET',
				url: 'research-ajax.php',
				data: 'action=weatherreport&id=' + id,
				success: function(data)
				{
					if(data.length > 0)						
						zeal.jQuery('#research-weather-report').html(data);
					else
						zeal.jQuery('#research-weather-report').html('No Data');
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		},
		closeWeatherReport : function (){
			zeal.jQuery('.research-table-weather').show();
			zeal.jQuery('.research-table-content-weather').hide();
			zeal.jQuery('#research-back-weather').hide();
		},
		teams : function (id){
			zeal.jQuery('.research-table-teams').hide();
			zeal.jQuery('.research-table-content-teams').show();
			zeal.jQuery('#research-back-teams').show();
			$.ajax({
				type: 'GET',
				url: 'research-ajax.php',
				data: 'action=teams&id=' + id,
				success: function(data)
				{
					if(data.length > 0)						
						zeal.jQuery('#research-teams').html(data);
					else
						zeal.jQuery('#research-teams').html('No Data');
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		},
		closeTeams : function (){
			zeal.jQuery('.research-table-teams').show();
			zeal.jQuery('.research-table-content-teams').hide();
			zeal.jQuery('#research-back-teams').hide();
		},
		players : function (id){
			zeal.jQuery('.research-table-players').hide();
			zeal.jQuery('.research-table-content-players').show();
			zeal.jQuery('#research-back-players').show();
			$.ajax({
				type: 'GET',
				url: 'research-ajax.php',
				data: 'action=players&id=' + id,
				success: function(data)
				{
					if(data.length > 0)						
						zeal.jQuery('#research-players').html(data);
					else
						zeal.jQuery('#research-players').html('No Data');
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		},
		closePlayers : function (){
			zeal.jQuery('.research-table-players').show();
			zeal.jQuery('.research-table-content-players').hide();
			zeal.jQuery('#research-back-players').hide();
		},
		completedGames : function (id){
			zeal.jQuery('.research-table-comptd-games').hide();
			zeal.jQuery('.research-table-content-comptd-games').show();
			zeal.jQuery('#research-back-comptd-games').show();
			$.ajax({
				type: 'GET',
				url: 'research-ajax.php',
				data: 'action=complgames&id=' + id,
				success: function(data)
				{
					if(data.length > 0)						
						zeal.jQuery('#research-players').html(data);
					else
						zeal.jQuery('#research-players').html('No Data');
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		},
		closeCompletedGames : function (){
			zeal.jQuery('.research-table-comptd-games').show();
			zeal.jQuery('.research-table-content-comptd-games').hide();
			zeal.jQuery('#research-back-comptd-games').hide();
		},
		starPlayers : function (id){
			zeal.jQuery('.research-table-star-player').hide();
			zeal.jQuery('.research-table-content-star-player').show();
			zeal.jQuery('#research-back-star-player').show();
			$.ajax({
				type: 'GET',
				url: 'research-ajax.php',
				data: 'action=starplayers&id=' + id,
				success: function(data)
				{
					if(data.length > 0)
						zeal.jQuery('#research-star-player').html(data);
					else
						zeal.jQuery('#research-star-player').html('No Data');
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		},
		closeStarPlayers : function (){
			zeal.jQuery('.research-table-star-player').show();
			zeal.jQuery('.research-table-content-star-player').hide();
			zeal.jQuery('#research-back-star-player').hide();
		},
		prediction : function (id){
			zeal.jQuery('.research-table-prediction').hide();
			zeal.jQuery('.research-table-content-prediction').show();
			zeal.jQuery('#research-back-prediction').show();
			$.ajax({
				type: 'GET',
				url: 'research-ajax.php',
				data: 'action=prediction&id=' + id,
				success: function(data)
				{
					if(data.length > 0)
						zeal.jQuery('#research-prediction').html(data);
					else
						zeal.jQuery('#research-prediction').html('No Data');
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		},
		closePrediction : function (){
			zeal.jQuery('.research-table-prediction').show();
			zeal.jQuery('.research-table-content-prediction').hide();
			zeal.jQuery('#research-back-prediction').hide();
		}
	},
	indexPageContent : {
		indexResearch : function (){
			$.ajax({
				type: 'GET',
				url: base_url+'ajax.php',
				data: 'action=indexresearch',
				success: function(data)
				{
					zeal.jQuery('#index-research-aj').css('height','auto');
					zeal.jQuery('#index-research-aj').html(data);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		},
		indexLatestWinner : function (){
			$.ajax({
				type: 'GET',
				url: base_url+'ajax.php',
				data: 'action=indexlatestwinner',
				success: function(data)
				{
					zeal.jQuery('#index-latest-winner').html(data);
					zeal.indexPageContent.indexResearch();
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		},
		indexLivescore : function (){
			$.ajax({
				type: 'GET',
				url: base_url+'ajax.php',
				data: 'action=indexblocklivescore',
				success: function(data)
				{
					zeal.jQuery('#livescore-sidebar').html(data);
					zeal.indexPageContent.indexLatestWinner();
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		}
	},
	errors: {
		showError: function (error){
			zeal.jQuery('.errors div.error-body').text(error);
			zeal.jQuery('.errors').slideDown('slow');
			//setTimeout('zeal.errors.closeError()', 10000);
		},
		closeError: function(){
			zeal.jQuery('.errors').slideUp('up');
		},
		showPopError: function(data){
			zeal.jQuery('.transparent-container').show();
			zeal.jQuery('.error-msg').show();
			zeal.jQuery('#error-msg').text(data);
		},
		closePopError: function(){
			zeal.jQuery('.transparent-container').hide();
			zeal.jQuery('.error-msg').hide();
		}
	},
	support: {
		validate: function(){
			var nam=zeal.jQuery('#suptxtname').val();
			var supemail=zeal.jQuery('#supmail').val();
			var supcont=zeal.jQuery('#supcontent').val();
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(nam.length == 0 || supcont.length == 0)
			{
				alert("Fields cant be empty");	
				return false;
			}
			else if(supemail.length ==0 )
			{
				alert("Enter valid email");
				return false;
			}
			else if(!filter.test(supemail))
			{
				alert("email wrong");
				return false;
			}
			else
			{			
				//alert("success");
			}
		}
	},
	refer: {
		refermailvalidate: function(){
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var refermail=zeal.jQuery('#refertxt').val();
			var refcontent=zeal.jQuery('#refercontent').val();
			
			if(refermail.length == 0 || refcontent.length == 0 )
			{
				alert("Fields cant be empty");
				return false;
			}
			else if(!filter.test(refermail))
			{
				alert("Invalid Email");
				return false;
			}
			else
			{				
				//alert("ok");	
			}
		}
	}
});
zeal.jQuery(document).ready(function($)
{
	zeal.jQuery('.content-loader').fadeOut('slow');
	setTimeout("zeal.index.getHeaderScore();", refreshInterval);
	zeal.players.updateBudjet(zeal.players.budjet);
	
	zeal.jQuery('#signup form').live('submit', function(){
		if(zeal.user.emailerrorIndiacate == true)
			alert('Error with the email');
		else if(zeal.user.unameerrorIndicate == true)
			alert('Error with the username');
		else if(zeal.user.passerrorIndicate == true)
			alert('Error with the password');
		if(zeal.user.emailerrorIndiacate==true || zeal.user.unameerrorIndicate==true || zeal.user.passerrorIndicate==true)
			return false;
		if(!zeal.jQuery("#signuptc").is(':checked'))
		{
			alert('Please accept the terms and conditions');
			return false;
		}
		var username = zeal.jQuery('#txtusernamesignup').val();
		var email = zeal.jQuery('#email').val();
		var password = zeal.jQuery('#txtpassword').val();
		var verifyCode = zeal.jQuery('#verify-txt').val();
		zeal.jQuery('#signup form').hide();
		zeal.jQuery('.loading').show();
		zeal.jQuery.ajax({
			type: 'POST',  
			url: 'index.php',
			dataType : "json",
			data: {  
			  action: 'signup',  
			  username: username,
			  email: email,
			  password: password,
			  verifycode: verifyCode,
			  connect: 'false',
			},  
			success: function(jsonData, textStatus, XMLHttpRequest){
				if(jsonData.hasErrors)
				{
					zeal.errors.showError(jsonData.errors);
					zeal.jQuery('#signup form').show();
					zeal.jQuery('.loading').hide();
				}
				else
					zeal.user.showSignupSuccess();
			},  
			error: function(MLHttpRequest, textStatus, errorThrown){  
			alert(errorThrown);
			}
		});
		return false;
	});
	
	zeal.jQuery('#signin form').live('submit', function(){
		var loginname = zeal.jQuery('#txtemaillogin').val();
		var loginpass = zeal.jQuery('#txtpasswordlogin').val();
		var remember = zeal.jQuery('#remember').prop('checked');
		var verifycode = zeal.jQuery('#verify-txt').val();
		if(loginname.length == 0 || loginpass.length == 0)
		{
			alert("Fields can't be empty");
			return false;
		} 
		zeal.jQuery('#signin form').hide();
		zeal.jQuery('.loading').show();
		zeal.jQuery.ajax({
			type: 'POST',  
			url: 'index.php',
			dataType : "json",
			data: {  
			  action: 'signin',
			  email: loginname,
			  password: loginpass,
			  remember: remember,
			  verifycode: verifycode
			},  
			success: function(jsonData, textStatus, XMLHttpRequest){
				if(jsonData.hasErrors)
				{
					zeal.jQuery('#signin form').show();
					zeal.jQuery('.loading').hide();
					zeal.errors.showError(jsonData.errors);
					if(jsonData.type == 'captcha' || jsonData.type == 'code')
					{
						zeal.jQuery('#captcha-container').show();
						zeal.jQuery('#signin').css('height', '400px');
						zeal.jQuery('#verify-txt').val('').css('border', 'solid 2px #f00');
						zeal.user.refreshCaptcha();
						document.getElementById('verify-txt').focus();
						return false;
					}
					if(jsonData.type == 'auth')
					{
						zeal.jQuery('#txtemaillogin').val('').css('border', 'solid 2px #f00');
						zeal.jQuery('#txtpasswordlogin').val('').css('border', 'solid 2px #f00');
						zeal.user.refreshCaptcha();
						zeal.jQuery('#verify-txt').val('').css('border', 'solid 1px #ccc');
						document.getElementById('txtemaillogin').focus();
					}
				}
				else
					window.location.href = base_url;
			},  
			error: function(MLHttpRequest, textStatus, errorThrown){  
			alert(errorThrown);
			}
		});
		return false;
	});
});