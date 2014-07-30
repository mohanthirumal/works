<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 5.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="{$base_dir}zealcity.ico"/>
<meta name="description" content="Zelacity.com is India's first daily cash based cricket fantasy league portal that offers the popular cricket fantasy game Captain of captains. Zealcity.com offers daily cricket fantasy leagues on all formats of cricket games played across the globe. Zealcity.com host’s the popular cricket fantasy game – Captain of Captains which allows players to set up their own fantasy leagues or compete against each other in cash or fun tournaments. Captain of captains has several unique features such as the most innovative points system, cash tournaments and daily fantasy league tournaments. Zealcity.com also offers a variety of content such as live cricket scores, cricket statistics of all international cricket players, blogs from a group of experts as well as loyalty programs and refer a friend program.">
<meta name="keywords" content="Cricket fantasy league, cricket games, cash games, cash based fantasy leagues, live scores, live cricket scores, captain of captains, refer a friend, daily fantasy leagues, cricket entertainment, cricket predictions, cricket blogs, cricket match previews, kris Srikkanth, Ashwin ravichandran  , Indian cricket team, Indian premier league, Ipl fantasy league, Zealcity, Player of the week, cricket fantasy tournaments, cricket fantasy winners, skill based tournaments.">
<title id="headerTitle">{$pagetitle}</title>
<link href='https://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
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
	<div class="errors">
		<div class="center-container">
		{if isset($errors)}
		<ul>
		{foreach from=$errors item=error name=errors}
			<li>{$error}</li>
		{/foreach}
		</ul>
		{/if}
		</div>
	</div>
	<div class="full-container">
		<!--<div class="top-container">
			<div class="center-container">
				 <img src="{$base_dir}images/header-ads.png" alt="" style="float:right;"/>
			</div>
		</div>-->
		<div class="content">
			<div class="center-container">
				<div class="logo">
					<a href="{$base_dir}"><img src="{$base_dir}images/logo.png" alt="Logo" title=""/></a>
				</div>				
                <div class="top-buttons">
					<div class="social-buttons">
						<iframe src="http://www.facebook.com/plugins/like.php?href=http://www.facebook.com/pages/zealcitycom/190533467632448&amp;send=false&amp;layout=button_count&amp;width=250&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px; float:left;" allowTransparency="true"></iframe>
						<a href="https://twitter.com/share" class="twitter-share-button" data-via="zealcity" data-url="http://www.zealcity.com" data-lang="en">Tweet</a>
						<script>{literal}!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");{/literal}</script>
						<!--<input type="button" class="addfunds" value="Recommend" style="margin:0;" onclick="zeal.index.facebookShare()"/>-->
					</div>
                {if !$user }
				<div style="float:right; height:57px; margin-top:28px;">
					<input type="button" value="Sign in" class="button" style="cursor:pointer;" onclick="zeal.user.showSignin();"/>
					<input type="button" value="Sign up" class="button" style="cursor:pointer;" onclick="zeal.user.showSignUp();"/>
				</div>
				{else}			
				
					
					<div class="accbut">		
						<div class="user">
							<!--<a href="{$base_dir}refer-a-friend"><input type="button" class="addfunds btn-refer-a-friend" value="Refer a friend"/></a>-->
							<a href="{$base_dir}my-account"><input type="button" class="addfunds" value="My Account"/></a>
							<div class="cash" style="cursor:default;"><span class="WebRupee">Rs.</span> {$user->cash}</div>						
							<div class="loginname" style="cursor:default;">{$user->username}</div>						
						</div>
						
						<div class="loggingout">                        
							<div class="logout"><a href="?mylogout" class="mylogout">Logout</a></div>
							<a href="{$base_dir}tournament"><input type="button" class="addfunds" value="My Tournaments"/></a>
							<div class="coins" style="cursor:default;">{$user->coin}</div>
							<!--<a href="{$base_dir}my-account"><input type="button" class="addfunds" value="My Account"/></a>-->
						</div>
					</div>	
					<div class="userimg">
						{if $user->connect.facebook}
						<img src="https://graph.facebook.com/{$user->connect.facebook}/picture" alt=""/>
						{else}
						<img src="{$base_dir}images/avatar.jpg" alt="" style="width:50px; height:50px; cursor:default;" />
						{/if}
					</div>					
				{/if}
				<div class="clear"></div>
				<!-----------------------------------Menu------------------------------>
				<div class="menu">
					<div class="menu-left"></div>
					<div class="menu-center">
						<ul>
							<li><a href="{$base_dir}">Home</a></li>
							<li class="divider"></li>
							<li><a href="{$base_dir}how-it-works">How it Works</a></li>
							<li class="divider"></li>
							<li><a href="{$base_dir}rules">Rules</a></li>
							<li class="divider"></li>
							<li><a href="{$base_dir}tournament">Tournaments</a></li>
							<li class="divider"></li>
							<li><a href="{$base_dir}research-details.php">Research</a></li>
							<li class="divider"></li>
							<li><a href="{$base_dir}leaderboard">Leaderboards</a></li>
							<li class="divider"></li>
							<li><a href="{$base_dir}support">Support</a></li>
						</ul>
					</div>
					<div class="menu-right"></div>
				</div>
				<!-----------------------------------Menu : Right------------------------------>
				<div id="livescore-header">{$LIVESCOREHEADER}</div>
				{if isset($errors)}
				<script>zeal.errors.showError();</script>
				{/if}