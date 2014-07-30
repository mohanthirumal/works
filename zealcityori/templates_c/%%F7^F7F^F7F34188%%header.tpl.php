<?php /* Smarty version 2.6.27, created on 2014-06-09 10:16:50
         compiled from header.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 5.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="<?php echo $this->_tpl_vars['base_dir']; ?>
zealcity.ico"/>
<meta name="description" content="Zelacity.com is India's first daily cash based cricket fantasy league portal that offers the popular cricket fantasy game Captain of captains. Zealcity.com offers daily cricket fantasy leagues on all formats of cricket games played across the globe. Zealcity.com host’s the popular cricket fantasy game – Captain of Captains which allows players to set up their own fantasy leagues or compete against each other in cash or fun tournaments. Captain of captains has several unique features such as the most innovative points system, cash tournaments and daily fantasy league tournaments. Zealcity.com also offers a variety of content such as live cricket scores, cricket statistics of all international cricket players, blogs from a group of experts as well as loyalty programs and refer a friend program.">
<meta name="keywords" content="Cricket fantasy league, cricket games, cash games, cash based fantasy leagues, live scores, live cricket scores, captain of captains, refer a friend, daily fantasy leagues, cricket entertainment, cricket predictions, cricket blogs, cricket match previews, kris Srikkanth, Ashwin ravichandran  , Indian cricket team, Indian premier league, Ipl fantasy league, Zealcity, Player of the week, cricket fantasy tournaments, cricket fantasy winners, skill based tournaments.">
<title id="headerTitle"><?php if ($this->_tpl_vars['pagetitle'] == 'home' || $this->_tpl_vars['pagetitle'] == 'dummyhome'): ?>Daily cricket fantasy league, real cash tournaments, live cricket scores | Zealcity<?php else: ?><?php echo $this->_tpl_vars['pagetitle']; ?>
 - Zealcity.com<?php endif; ?></title>
<?php if (isset ( $this->_tpl_vars['css_files'] )): ?>
	<?php $_from = $this->_tpl_vars['css_files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['css_uri'] => $this->_tpl_vars['media']):
?>
	<link href="<?php echo $this->_tpl_vars['css_uri']; ?>
" rel="stylesheet" type="text/css" media="<?php echo $this->_tpl_vars['media']; ?>
" />
	<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php if (isset ( $this->_tpl_vars['js_files'] )): ?>
	<?php $_from = $this->_tpl_vars['js_files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['js_uri']):
?>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['js_uri']; ?>
"></script>
	<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<script>
var refreshInterval = 30000;
var base_url = '<?php echo $this->_tpl_vars['base_dir']; ?>
';
var fb_app_id = <?php echo $this->_tpl_vars['fb_app_id']; ?>
;
<?php if ($this->_tpl_vars['user']): ?>
var loggedIn = true;
var loggedId = <?php echo $this->_tpl_vars['user']->id; ?>
;
<?php else: ?>
var loggedIn = false;
<?php endif; ?>
</script>
</head>
<body>
	<div class="content-loader"></div>
	<div id="fb-root" ></div>
	<?php if (isset ( $this->_tpl_vars['usermessage'] )): ?>
	<div class="custom-msg"><?php echo $this->_tpl_vars['usermessage']; ?>
</div>
	<?php endif; ?>
	<div class="errors">
		<div class="center-container">
		<div class="error-popup">
			<button type="button" onclick="zeal.errors.closeError()" class="popclose-btn">x</button>
			<div class="error-body">
			<?php if (isset ( $this->_tpl_vars['errors'] )): ?>
				<ul>
				<?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['errors'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['errors']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['error']):
        $this->_foreach['errors']['iteration']++;
?>
					<li><?php echo $this->_tpl_vars['error']; ?>
</li>
				<?php endforeach; endif; unset($_from); ?>
				</ul>
			<?php endif; ?>
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
						<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
"><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/logo.png" alt="Logo" title=""/></a>
					</div>	
					<div class="social-buttons">
						<iframe src="http://www.facebook.com/plugins/like.php?href=http://www.facebook.com/pages/zealcitycom/190533467632448&amp;send=false&amp;layout=button_count&amp;width=250&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px; float:left;" allowTransparency="true"></iframe>
						<a href="https://twitter.com/share" class="twitter-share-button" data-via="zealcity" data-url="http://www.zealcity.com" data-lang="en">Tweet</a>
						<script><?php echo '!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");'; ?>
</script>
					</div>
                <?php if (! $this->_tpl_vars['user']): ?>
				<div style="float:right; height:57px; margin-bottom:29px;">
					<input type="button" value="Login" class="addFundClass" style="cursor:pointer; border:0" onclick="zeal.user.showSignin();"/>
					<!--<input type="button" value="Sign up" class="button" style="cursor:pointer;" onclick="zeal.user.showSignUp();"/>-->
				</div>
				<?php else: ?>
					<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
deposit"><div class="addFundClass">Add Funds</div></a>
					<div class="myAccount-profile-stractures" >
						<div class="leftContentClass">
							<div class="avatherContent">
								<?php if ($this->_tpl_vars['user']->connect['facebook']): ?>
								<img src="https://graph.facebook.com/<?php echo $this->_tpl_vars['user']->connect['facebook']; ?>
/picture" alt=""/>
								<?php else: ?>
								<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/avatar.jpg" alt="" style="width:50px; height:50px; cursor:default;" />
								<?php endif; ?>
							</div>
							<div class="nameContentClass"><?php echo $this->_tpl_vars['user']->username; ?>
</div>
							<div class="ruppesContent">&nbsp;<span class="WebRupee">Rs.</span><?php echo $this->_tpl_vars['user']->cash; ?>
</div>
						</div>
						<div class="upperContent-Class">
							<div class="first-content-class-set">
								<div class="main-content-class2">
									<div class="header-user-level-icon"<?php if ($this->_tpl_vars['level'][0]['icon']): ?> style="background-image:url(<?php echo $this->_tpl_vars['base_dir']; ?>
images/icons/<?php echo $this->_tpl_vars['level'][0]['icon']; ?>
);"<?php endif; ?>></div><?php if ($this->_tpl_vars['level'][0]['coin']): ?><?php echo $this->_tpl_vars['level'][0]['coin']; ?>
<?php else: ?>0<?php endif; ?>
								</div>
								<!--<div class="right-content2">
									<div class="questionmark"></div>
								</div>-->
							</div>
							<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-account"><div class="upperContent-Class2"><div class="my-account-Icon"></div>My Account</div></a>
							<div class="divdedClassContent"></div>
							<!--<div class="upperContent-Class2"><div class="friend-Icon"></div>Friends</div>
							<div class="divdedClassContent"></div>-->
							<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-account"><div class="upperContent-Class2"><div class="withdraw-Icon"></div>Withdrawal</div></a>
							<div class="divdedClassContent"></div>
							<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-account"><div class="upperContent-Class2"><div class="transaction-histroy-Icon"></div>Transaction Histroy</div></a>
							<div class="divdedClassContent"></div>
							<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-account"><div class="upperContent-Class2"><div class="bonus-Icon"></div>My Bonus</div></a>
							<div class="divdedClassContent"></div>
							<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
support"><div class="upperContent-Class2"><div class="support-Icon-menu"></div>Support</div></a>
							<div class="divdedClassContent"></div>
							<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
tournament-invites.php"><div class="upperContent-Class2"><div class="invite-Icon"></div>Tournament Invites</div></a>
						</div>
						<div class="rightContentClass" >
							<div class="rightClassContent"></div>
							<div class="logoutContent">
								<div class="classLogout"></div>
								<div class="logoutText"><a href="?mylogout" class="mylogout">Logout</a></div>
							</div>
						</div>
					</div>
					
								
				<?php endif; ?>
				
				<!-----------------------------------Menu------------------------------>
				<div class="menu">
					
					
						<ul>
							<li><a<?php if ($this->_tpl_vars['pagetitle'] == 'home'): ?> class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['base_dir']; ?>
"><div class="home-icon"></div></a></li>
							<li class="divider"></li>
							<li><a<?php if ($this->_tpl_vars['pagetitle'] == 'How it works'): ?> class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['base_dir']; ?>
how-it-works"><div class="how-it-works-icon"></div>How to Play</a></li>
							<li class="divider"></li>
							<li><a<?php if ($this->_tpl_vars['pagetitle'] == 'Rules'): ?> class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['base_dir']; ?>
rules"><div class="rules-icon"></div>Rules</a></li>
							<li class="divider"></li>
							<li><a<?php if ($this->_tpl_vars['pagetitle'] == 'Tournaments'): ?> class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['base_dir']; ?>
tournament"><div class="tournament-icon"></div>Tournaments</a></li>
							<li class="divider"></li>
							<li><a<?php if ($this->_tpl_vars['pagetitle'] == 'Rules'): ?> class="Research"<?php endif; ?> href="<?php echo $this->_tpl_vars['base_dir']; ?>
research-details.php"><div class="research-icon"></div>Research</a></li>
							<li class="divider"></li>
							<li><a<?php if ($this->_tpl_vars['pagetitle'] == 'Leaderboard'): ?> class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['base_dir']; ?>
leaderboard"><div class="leaderboard-icon"></div>Leaderboards</a></li>
							<li class="divider"></li>
							<li><a<?php if ($this->_tpl_vars['pagetitle'] == 'Support'): ?> class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['base_dir']; ?>
support"><div class="support-icon"></div>Support</a></li>
						</ul>
					
					
				</div>
				<!-----------------------------------Menu : Right------------------------------>
				
				<div id="livescore-header"><?php echo $this->_tpl_vars['LIVESCOREHEADER']; ?>
</div>
				<?php if (isset ( $this->_tpl_vars['errors'] )): ?>
				<script>zeal.errors.showError();</script>
				<?php endif; ?>