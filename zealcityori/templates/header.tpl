<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 5.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="{$base_dir}zealcity.ico"/>
<meta name="description" content="Zelacity.com is India's first daily cash based cricket fantasy league portal that offers the popular cricket fantasy game Captain of captains. Zealcity.com offers daily cricket fantasy leagues on all formats of cricket games played across the globe. Zealcity.com host’s the popular cricket fantasy game – Captain of Captains which allows players to set up their own fantasy leagues or compete against each other in cash or fun tournaments. Captain of captains has several unique features such as the most innovative points system, cash tournaments and daily fantasy league tournaments. Zealcity.com also offers a variety of content such as live cricket scores, cricket statistics of all international cricket players, blogs from a group of experts as well as loyalty programs and refer a friend program.">
<meta name="keywords" content="Cricket fantasy league, cricket games, cash games, cash based fantasy leagues, live scores, live cricket scores, captain of captains, refer a friend, daily fantasy leagues, cricket entertainment, cricket predictions, cricket blogs, cricket match previews, kris Srikkanth, Ashwin ravichandran  , Indian cricket team, Indian premier league, Ipl fantasy league, Zealcity, Player of the week, cricket fantasy tournaments, cricket fantasy winners, skill based tournaments.">
<title id="headerTitle">{if $pagetitle == 'home' || $pagetitle == 'dummyhome'}Daily cricket fantasy league, real cash tournaments, live cricket scores | Zealcity{else}{$pagetitle} - Zealcity.com{/if}</title>
{if isset($css_files)}
	{foreach from=$css_files key=css_uri item=media}
	<link href="{$css_uri}" rel="stylesheet" type="text/css" media="{$media}" />
	{/foreach}
{/if}
{if isset($js_files)}
	{foreach from=$js_files item=js_uri}
	<script type="text/javascript" src="{$js_uri}"></script>
	{/foreach}
{/if}
<script>
var refreshInterval = 30000;
var base_url = '{$base_dir}';
var fb_app_id = {$fb_app_id};
{if $user }
var loggedIn = true;
var loggedId = {$user->id};
{else}
var loggedIn = false;
{/if}
</script>
</head>
<body>
	<div class="content-loader"></div>
	<div id="fb-root" ></div>
	{if isset($usermessage)}
	<div class="custom-msg">{$usermessage}</div>
	{/if}
	<div class="errors">
		<div class="center-container">
		<div class="error-popup">
			<button type="button" onclick="zeal.errors.closeError()" class="popclose-btn">x</button>
			<div class="error-body">
			{if isset($errors)}
				<ul>
				{foreach from=$errors item=error name=errors}
					<li>{$error}</li>
				{/foreach}
				</ul>
			{/if}
			</div>
			<div class="error-footer">
				<button type="button" class="btn btn-success" onclick="zeal.errors.closeError()">OK</button>
			</div>
			</div>
		</div>
	</div>
	<div class="full-container">
		<div class="content">
			<div class="center-container">
							
                <div class="top-buttons">
					<div class="logo">
						<a href="{$base_dir}"><img src="{$base_dir}images/logo.png" alt="Logo" title=""/></a>
					</div>	
					<div class="social-buttons">
						<iframe src="http://www.facebook.com/plugins/like.php?href=http://www.facebook.com/pages/zealcitycom/190533467632448&amp;send=false&amp;layout=button_count&amp;width=250&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px; float:left;" allowTransparency="true"></iframe>
						<a href="https://twitter.com/share" class="twitter-share-button" data-via="zealcity" data-url="http://www.zealcity.com" data-lang="en">Tweet</a>
						<script>{literal}!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");{/literal}</script>
					</div>
                {if !$user }
				<div style="float:right; height:57px; margin-bottom:29px;">
					<input type="button" value="Login" class="addFundClass" style="cursor:pointer; border:0" onclick="zeal.user.showSignin();"/>
					<!--<input type="button" value="Sign up" class="button" style="cursor:pointer;" onclick="zeal.user.showSignUp();"/>-->
				</div>
				{else}
					<a href="{$base_dir}deposit"><div class="addFundClass">Add Funds</div></a>
					<div class="myAccount-profile-stractures" >
						<div class="leftContentClass">
							<div class="avatherContent">
								{if $user->connect.facebook}
								<img src="https://graph.facebook.com/{$user->connect.facebook}/picture" alt=""/>
								{else}
								<img src="{$base_dir}images/avatar.jpg" alt="" style="width:50px; height:50px; cursor:default;" />
								{/if}
							</div>
							<div class="nameContentClass">{$user->username}</div>
							<div class="ruppesContent">&nbsp;<span class="WebRupee">Rs.</span>{$user->cash}</div>
						</div>
						<div class="upperContent-Class">
							<div class="first-content-class-set">
								<div class="main-content-class2">
									<div class="header-user-level-icon"{if $level[0].icon} style="background-image:url({$base_dir}images/icons/{$level[0].icon});"{/if}></div>{if $level[0].coin}{$level[0].coin}{else}0{/if}
								</div>
								<!--<div class="right-content2">
									<div class="questionmark"></div>
								</div>-->
							</div>
							<a href="{$base_dir}my-account"><div class="upperContent-Class2"><div class="my-account-Icon"></div>My Account</div></a>
							<div class="divdedClassContent"></div>
							<!--<div class="upperContent-Class2"><div class="friend-Icon"></div>Friends</div>
							<div class="divdedClassContent"></div>-->
							<a href="{$base_dir}my-account"><div class="upperContent-Class2"><div class="withdraw-Icon"></div>Withdrawal</div></a>
							<div class="divdedClassContent"></div>
							<a href="{$base_dir}my-account"><div class="upperContent-Class2"><div class="transaction-histroy-Icon"></div>Transaction Histroy</div></a>
							<div class="divdedClassContent"></div>
							<a href="{$base_dir}my-account"><div class="upperContent-Class2"><div class="bonus-Icon"></div>My Bonus</div></a>
							<div class="divdedClassContent"></div>
							<a href="{$base_dir}support"><div class="upperContent-Class2"><div class="support-Icon-menu"></div>Support</div></a>
							<div class="divdedClassContent"></div>
							<a href="{$base_dir}tournament-invites.php"><div class="upperContent-Class2"><div class="invite-Icon"></div>Tournament Invites</div></a>
						</div>
						<div class="rightContentClass" >
							<div class="rightClassContent"></div>
							<div class="logoutContent">
								<div class="classLogout"></div>
								<div class="logoutText"><a href="?mylogout" class="mylogout">Logout</a></div>
							</div>
						</div>
					</div>
					
								
				{/if}
				
				<!-----------------------------------Menu------------------------------>
				<div class="menu">
					
					
						<ul>
							<li><a{if $pagetitle == 'home'} class="active"{/if} href="{$base_dir}"><div class="home-icon"></div></a></li>
							<li class="divider"></li>
							<li><a{if $pagetitle == 'How it works'} class="active"{/if} href="{$base_dir}how-it-works"><div class="how-it-works-icon"></div>How to Play</a></li>
							<li class="divider"></li>
							<li><a{if $pagetitle == 'Rules'} class="active"{/if} href="{$base_dir}rules"><div class="rules-icon"></div>Rules</a></li>
							<li class="divider"></li>
							<li><a{if $pagetitle == 'Tournaments'} class="active"{/if} href="{$base_dir}tournament"><div class="tournament-icon"></div>Tournaments</a></li>
							<li class="divider"></li>
							<li><a{if $pagetitle == 'Rules'} class="Research"{/if} href="{$base_dir}research-details.php"><div class="research-icon"></div>Research</a></li>
							<li class="divider"></li>
							<li><a{if $pagetitle == 'Leaderboard'} class="active"{/if} href="{$base_dir}leaderboard"><div class="leaderboard-icon"></div>Leaderboards</a></li>
							<li class="divider"></li>
							<li><a{if $pagetitle == 'Support'} class="active"{/if} href="{$base_dir}support"><div class="support-icon"></div>Support</a></li>
						</ul>
					
					
				</div>
				<!-----------------------------------Menu : Right------------------------------>
				
				<div id="livescore-header">{$LIVESCOREHEADER}</div>
				{if isset($errors)}
				<script>zeal.errors.showError();</script>
				{/if}