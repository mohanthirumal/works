if (typeof(zeal1)=='undefined')
{
	// We will recreate our joms namespace
	// with joms.jQuery pointing to their jQuery.
	zeal1 = {
		jQuery: window.jQuery,
		extend: function(obj){
			this.jQuery.extend(this, obj);
		}
	}
}
zeal1.extend({
	tournament: {
		destroyTournament: function(id, type, uid, key){
			var cancelCheck = confirm("Are you sure, you want to cancel the tournament");
			if(cancelCheck == true)
			{
				$.ajax({
					type: 'POST',
					url: base_url+'ajax.php',
					data: {
						action: 'canceltournament',
						id: id,
						type: type,
						uid: uid,
						key: key
					},
					success: function(data)
					{
						alert('Tournament Cancelled successfully');
						window.location.href = '/';
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						// in front-office, do not display technical error
						//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
					}
				});
			}
		},
		showEmailInvite: function(){
			zeal1.jQuery('.tour-info-invite-list-cont').show();
			zeal1.jQuery('.tournament-info-fb-invite').hide();
			zeal1.jQuery('.tournament-info-email-invite').show();
		},
		changeType: function(){
			var type = zeal1.jQuery('#type').val();
			if(type == 7){
				zeal1.jQuery('.week-series').show();
				zeal1.jQuery('.daily-match').hide();
				zeal1.jQuery('.series-list').hide();
			}
			else if(type == 3){
				zeal1.jQuery('.daily-match').show();
				zeal1.jQuery('.week-series').hide();
				zeal1.jQuery('.series-list').hide();
			}
			else if(type == 8){	
				zeal1.jQuery('.series-list').show();
				zeal1.jQuery('.week-series').hide();
				zeal1.jQuery('.daily-match').hide();
			}
			zeal1.jQuery('.week-match').hide();
			
		},
		flagUrl : '',
		changeWeek: function(){
			var week = zeal1.jQuery('#weekly').val();
			$.ajax({
				type: 'POST',
				url: base_url+'ajax.php',
				data: 'action=getweekmatch&id=' + week,
				success: function(data)
				{
					var data = JSON.parse(data);
					var html = '';
					if(data.length)
					{
						for(i = 0;i < data.length;i++)
						{
							var date = new Date(parseInt(data[i].match_date)*1000);
							if(i < 3)
								html += '<div class="main-class-cotant"><div style="float:left; width:28%;"><img style="width:100%;" src="'+zeal1.tournament.flagUrl+data[i].t1flag+'"></div><div class="vsClass"></div><div style="float:left;width:28%;"><img style="width:100%;" src="'+zeal1.tournament.flagUrl+data[i].t2flag+'"></div><div style="clear:both">'+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear()+'</div></div>'; 
							else
								html += '<div class="main-class-cotant hide"><div style="float:left; width:28%;"><img style="width:100%;" src="'+zeal1.tournament.flagUrl+data[i].t1flag+'"></div><div class="vsClass"></div><div style="float:left;width:28%;"><img style="width:100%;" src="'+zeal1.tournament.flagUrl+data[i].t2flag+'"></div><div style="clear:both">'+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear()+'</div></div>'; 
							//html += '<img src="images/'+data[i].t1flag+'"> <div class="vsClass"></div><img src="images/'+data[i].t2flag+'">'
						}
						if(i > 3)
							zeal1.jQuery('.more-class-content').show();
					}
					else
						html += 'No Match in this schedule';
					zeal1.jQuery('.week-shedule').html(html);
					zeal1.jQuery('#matchCount').show();
					zeal1.jQuery('#matchCount').html(data.length);					
					zeal1.jQuery('.week-match').show();
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		},
		seriesMatch: function(){
			var tourId = zeal1.jQuery('#series').val();
			$.ajax({
				type: 'POST',
				url: base_url+'ajax.php',
				data: 'action=getseriesmatch&id=' + tourId,
				success: function(data)
				{
					var data = JSON.parse(data);
					var html = '';
					if(data.length)
					{
						for(i = 0;i < data.length;i++)
						{
							html += '<div class="main-class-cotant"><div style="float:left; width:28%;"><img style="width:100%;" alt="New Zealand" src="images/teamsflags/'+data[i].t1flag+'"></div><div class="vsClass"></div><div style="float:left;width:28%;"><img style="width:100%;" alt="New Zealand" src="images/teamsflags/'+data[i].t1flag+'"></div></div>'; 
							//html += '<img src="images/'+data[i].t1flag+'"> <div class="vsClass"></div><img src="images/'+data[i].t2flag+'">'
						}
						if(i>3)
							zeal1.jQuery('.more-class-content').show();
					}
					else
						html += 'No Match in this schedule';
					zeal1.jQuery('.week-shedule').html(html);
					zeal1.jQuery('.week-match').css('display','block');
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		},
		validate: function(){
			var fee = document.getElementById('entryfee1');
			var feeAmount = parseInt(fee.options[fee.selectedIndex].text);
			var userCash = zeal1.jQuery('#userCash').val();
			if(!loggedIn){
				zeal.user.showSignin();
				return false;
			}
			if(feeAmount < userCash){
				
				zeal1.jQuery('.transparent-container').fadeIn('slow');
				zeal1.jQuery('#invite-dialog').show();
				return false;
			}
			else
			{
				zeal1.jQuery('.transparent-container').fadeIn('slow');
				zeal1.jQuery('#deposit-dialog').show();
				return false;
			}
		},
		confirmCreate: function(){
			document.getElementById('createtournament').submit();
		},
		cancelCreate: function(){
			zeal1.jQuery('.transparent-container').hide();
			zeal1.jQuery('.success-dialog').hide();
			zeal.jQuery('#createtournament').show();
		},
		createTournament: function(){
			zeal1.jQuery('#join-tournament').html('<div class="loading"></div>');
			zeal1.jQuery('.transparent-container').fadeIn('slow');
			zeal1.jQuery('#join-tournament').fadeIn('slow');
			var	url = base_url+'create-tournament.php';
			$.get(
				url,
				({}),
				function(data)
				{
					zeal1.jQuery('#join-tournament').html(data);
				});
			return false;
		},
		
		updatePrize: function(ele){
			var id = zeal1.jQuery(ele).val();
			$.ajax({
				type: 'POST',
				url: base_url+'ajax.php',
				data: 'action=getUserPrize&id='+id,
				success: function(data)
				{
					var data = JSON.parse(data);
					var select = document.getElementById("players");
					document.getElementById("player-container").style.display = 'block';
					for(i = select.options.length - 1; i >= 0; i--)
					{
						select.remove(i);
					}
					var option = document.createElement('option');
					option.text = '-----select-----';
					option.value = i;
					select.add(option, 0);
					for(i = data.min;i <= data.max;i++)
					{
						var option = document.createElement('option');
						option.text = option.value = i;
						select.add(option, 0);
					}
					zeal1.jQuery('.prize-box').hide();
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		},
		updatePrizeList: function(ele){
			var id = zeal1.jQuery(ele).val();
			var fee = zeal1.jQuery('#entryfee1').val();
			$.ajax({
				type: 'POST',
				url: base_url+'ajax.php',
				data: 'action=getUserPrizeList&id='+id+'&fee='+fee,
				success: function(data)
				{
					var data = JSON.parse(data);
					var prizes = '';
					var priclass = '';
					for(i = 0;i < data.prize.length; i++)
					{
						if(i<1)
							priclass = 'first';
						else if(i==1)
							priclass = 'second';
						else if(i == 2)
							priclass = 'third';
						else if(i == 3)
							priclass = 'fourth';
						else if(i == 4)
							priclass = 'fifth';
						prizes += '<div class="fix-content-border"><div class="first-class-content '+priclass+'">'+(i+1)+'</div><div class="price-content"><span class="WebRupee">Rs.</span> '+data.prize[i]+'</div></div>';
						//prizes += (i+1)+': '+data.prize[i]+'<br/>';
					}
					zeal1.jQuery('.prize-box').show();
					zeal1.jQuery('.prize-list-container').html(prizes);
					
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		},
		completeTournament: function(id, type){
			var noplayers = document.getElementById("players");
			if(noplayers)
			{
				var playerselect = noplayers.options[noplayers.selectedIndex].text;	
				var selectplayer = playerselect	- 1;
			}
			else
				var selectplayer = 1;
			var cboxes = document.getElementsByName('selected-friends[]');
			var len = cboxes.length;
			var selectedFriends = '';
			var c = 0;
			for (var i = 0; i < len; i++)
			{
				if(cboxes[i].checked)
				{
					selectedFriends += cboxes[i].value+',';
					c += 1;
				}
			}
			var friends = selectedFriends.substr(0, selectedFriends.length-1);
			zeal1.tournament.inviteFriends(friends);
			zeal1.tournament.addPlayers(id, type, friends);
		},
		addPlayers: function(id, type, friends){
			$.ajax({
				type: 'POST',
				url: base_url+'ajax.php',
				data: 'action=addTourPlayer&friends='+friends+'&id='+id+'&type='+type,
				success: function(data)
				{
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		},
		inviteFriends: function(id){
			FB.ui({
			  method: 'send',
			  link: 'http://www.zealcity.com',
			  to: id
			}, zeal1.tournament.inviteResponse);
			return false;
			FB.ui({method: 'apprequests',
				message: 'I have started playing captain of captains at Zealcity.com. I want to add you as a friend and challenge you to a game of fantasy cricket.',
				to: id
			}, zeal1.tournament.inviteResponse);
		},
		inviteResponse: function(response){
			zeal.errors.showError('Invitation successfully sent.');
			zeal1.jQuery('.tour-info-invite-list-cont').hide();
			zeal1.jQuery('.tournament-info-fb-invite').hide();
			zeal1.jQuery('.tournament-info-email-invite').hide();
		},
		cancelTournament: function(response){
			zeal1.jQuery('.transparent-container').hide();
			zeal1.jQuery('.innercontainer').hide();
		},
		sendEmailInvite: function(id, type, ele, key){
			var input_data = $("#emailinvite").serialize();
			zeal.jQuery(ele).hide();
			$.ajax({
				type: 'POST',
				url: base_url+'ajax.php',
				data: {
					userId: loggedId,
					tourId: id,
					action: 'emailinvite',  
					input_data: input_data,
					type: type,
					key: key
				},
				success: function(data)
				{
					zeal.jQuery(ele).show();
					if(data == '0')
						zeal.errors.showError('Invitation not sent.');
					else
						zeal.errors.showError('Invitation successfully sent.');
					zeal1.jQuery('#emailinvite')[0].reset();
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		},
		addEmailInvite: function(){
			zeal1.jQuery('#add-email-invite').append('<input type="text" name="name[]" placeholder="Name"/><input type="text" name="email[]" placeholder="Email"/><br/>');
		}
	},
	facebook: {
		count: 0,
		chk1: 0,
		facebookConnect: function(id){	
			zeal.jQuery('.loadingimg').show();	
			FB.login(function(response) {			
				if (response.authResponse) {
					var userID = response.authResponse.userID;					
					$.ajax({
						type: 'GET',
						url: base_url+'ajax.php',
						data: 'action=fbsync&id=' + userID + '&userid=' + id,
						success: function(data)
						{
							zeal1.facebook.getFriendsList();
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {
							// in front-office, do not display technical error
							//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
						}
					});
				}
			}, { scope:'email, publish_stream, publish_actions'});
		},
		getFriendsList: function(){
			zeal1.jQuery('.tournament-info-email-invite').hide();
			zeal1.jQuery('.tour-info-invite-list-cont').show();
			zeal1.jQuery('.tournament-info-fb-invite').show();
			$.ajax({
				type: 'POST',
				url: base_url+'ajax.php',
				data: 'action=fbfriends',
				success: function(data)
				{
					zeal1.jQuery('#friendsList').html('');
					zeal1.jQuery('.searFri').show();
					zeal1.jQuery('.tournament-info-trans-full').show();
					var friends = JSON.parse(data);
					for(i = 0; i <= friends.length; i++)
					{
						zeal1.facebook.friendsArray[i] = friends[i].name;
						zeal1.jQuery('#friendsList').append('<div class="friend" id="friend-'+i+'"><input type="checkbox" name="selected-friends[]" id="selected-friends-'+friends[i].id+'" value="'+friends[i].id+'"/><label for="selected-friends-'+friends[i].id+'"><img src="https://graph.facebook.com/'+friends[i].id+'/picture" alt="" title="'+friends[i].name+'"/></label><div class="user-name">'+friends[i].name.substr(0,15)+'</div></div>');
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});	
		},
		checkselect: function(element)
		{
			var noplayers = document.getElementById("players");
			if(noplayers)
			{
				var playerselect = noplayers.options[noplayers.selectedIndex].text;
				var selectplayer = playerselect - 1;
				//alert(selectplayer);
			}
			else
				var selectplayer = 1;
			if(zeal1.facebook.count < selectplayer && zeal1.facebook.chk1 == 0)
			{
				if(element.checked == true )
				{
					zeal1.facebook.count++;
					zeal1.jQuery('#selectteamplayers1').html("Players - " + (zeal1.facebook.count) + "/" + (selectplayer-(zeal1.facebook.count)));
					if((zeal1.facebook.count) == selectplayer)
					{
						zeal1.facebook.chk1 = 1;
					}					
				}
				else if(element.checked == false )
				{
					zeal1.facebook.count--;
					zeal1.jQuery('#selectteamplayers1').html("Players - " + (zeal1.facebook.count) + "/" + (selectplayer-(zeal1.facebook.count)));
				}
			}
			else if(zeal1.facebook.chk1 == 1 )
			{
				//alert(zeal1.facebook.chk1);
				if(element.checked == true)
				{
					element.checked = false;
					alert("Max no of players selected");
				}
				else
				{
					zeal1.facebook.count--;
					zeal1.jQuery('#selectteamplayers1').html("Players - " + (zeal1.facebook.count) + "/" + (selectplayer-(zeal1.facebook.count)));
					zeal1.facebook.chk1 = 0;
				}
			}
		},
		searchFriend: function(){
			//document.getElementById('facebook-connect').html('<div class="loading"></div>');
			var searchText = document.getElementById('search').value;
			for(j = 0; j <= zeal1.facebook.friendsArray.length; j++)
			{
				if(zeal1.facebook.friendsArray[j] && zeal1.facebook.friendsArray[j].toLowerCase().indexOf(searchText) > -1)
					zeal1.jQuery('#friend-'+j).show();
				else
					zeal1.jQuery('#friend-'+j).hide();
					//alert(zeal1.facebook.friendsArray[j]);
			}
		},
		friendsArray: Array(),
		multipleInvite: function(){
			FB.ui({
				method: 'apprequests',
				message: 'Invite My Gang',
				max_recipients: '5',
			}, function (response) {
				if (response) {
					zeal1.facebook.inviteResponse = response;
					zeal1.jQuery('.friends-list').show();
					zeal1.jQuery('.facebook-connect').hide();
					var friends = response.to.split(',');
					alert(friends);
					for(i = 0; i <= friends.length; i++)
						zeal1.jQuery('#friendsList').append('<div class="friend"><img src="https://graph.facebook.com/'+friends[i].id+'/picture" alt="" title="'+friends[i].name+'"/>');
				}
			});
		}
	}
});