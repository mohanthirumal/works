<?php /* Smarty version 2.6.27, created on 2014-04-21 17:36:45
         compiled from footer.tpl */ ?>
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="center-container">
			<div class="footer-payment-icons">
				<div class="we-accept-txt">We Accept</div>
				<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/icons/visa.jpg" alt="Visa"/>
				<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/icons/mastercard.jpg" alt="Master Card"/>
				<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/icons/amex.jpg" alt="Amex"/>
				<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/icons/online banking.jpg" alt="Online Banking"/>
				<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/icons/maestro.jpg" alt="Maestro"/>
				<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/icons/visa_electron.jpg" alt="Visa Electron"/>
				<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/icons/18+.png" alt="18+ only" style="margin-left:200px;"/>
				<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/icons/100secure.png" alt="100% Secure"/>
				<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/icons/100-legal.png" alt="100% Legal"/>
				<div style="float:right; margin:10px 0 0 0;">
					<a href="http://www.facebook.com/pages/zealcitycom/190533467632448" target="_blank"><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/icons/fb_icon.png" alt="Facebook"/></a>
					<a href="https://twitter.com/zealcity" target="_blank"><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/icons/twitter_icon.png" alt="Twitter"/></a>
				</div>
			</div>
            <div class="footer-column">
                <div class="footer-menu">
                    <ul>
                        <li><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
about-us">About Us</a></li>
                        <li><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
faqs">Faqs</a></li>
                        <li><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
legal">Is it legal?</a></li>
						<li><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
xtra-cash">Xtra cash</a></li>
                        <li><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
zealcity-points">Zealcity Points</a></li>
                    </ul>
                </div>
                <div class="footer-menu">
                    <ul>
                        <li><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
terms-conditions">Terms of Use</a></li>
                        <li><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
privacy-policy">Privacy Policy</a></li>
						<!--<li><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
refer-a-friend-program">Refer a friend program</a></li>-->
						<li><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
tournament-and-how-it-works">Tournaments and how it works?</a></li>
                        <li><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
deposit-and-withdraw">Deposit and Withdraw</a></li>
                    </ul>
                </div>
                <div class="footer-menu">
                    <ul>
                        <li><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
how-it-works">How it Works</a></li>
                        <li><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
support">Support</a></li>
                        <li><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
rules">Rules</a></li>
						<li><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
whats-new-in-zealcity">What's new In Zealcity?</a></li>
                    </ul>
                </div>
			</div>
			<div class="copyright">Zealcity.com and Captain of Captains&#8482; is owned and operated by Zealcity Studio Entertainment Pvt Ltd</div>
		</div>
	</div>
	<div class="transparent-container"></div>
	<div id="join-tournament" class="join-tournament"></div>
<script>
<?php echo '
  window.fbAsyncInit = function() {
	FB.init({
	  appId: fb_app_id,
	  cookie: true,
	  xfbml: true,
	  oauth: true
	});
	FB.Event.subscribe("edge.create", function(targetUrl) {
		zeal.tournament.likeJoinTournament();
	});
  };
  (function() {
	var e = document.createElement(\'script\'); e.async = true;
	e.src = document.location.protocol +
	  \'//connect.facebook.net/en_US/all.js\';
	document.getElementById(\'fb-root\').appendChild(e);
  }());
    (function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');

  ga(\'create\', \'UA-40604259-1\', \'zealcity.com\');
  ga(\'send\', \'pageview\');
'; ?>

</script>
</body>
</html>