			</div>
		</div>
	</div>
	<div class="footer">
		<div class="center-container">
			<div class="footer-payment-icons">
				<div class="we-accept-txt">We Accept</div>
				<img src="{$base_dir}images/icons/visa.jpg" alt="Visa"/>
				<img src="{$base_dir}images/icons/mastercard.jpg" alt="Master Card"/>
				<img src="{$base_dir}images/icons/amex.jpg" alt="Amex"/>
				<img src="{$base_dir}images/icons/online banking.jpg" alt="Online Banking"/>
				<img src="{$base_dir}images/icons/maestro.jpg" alt="Maestro"/>
				<img src="{$base_dir}images/icons/visa_electron.jpg" alt="Visa Electron"/>
				<img src="{$base_dir}images/icons/18+.png" alt="18+ only" style="margin-left:200px;"/>
				<img src="{$base_dir}images/icons/100secure.png" alt="100% Secure"/>
				<img src="{$base_dir}images/icons/100-legal.png" alt="100% Legal"/>
				<div style="float:right; margin:10px 0 0 0;">
					<a href="http://www.facebook.com/pages/zealcitycom/190533467632448" target="_blank"><img src="{$base_dir}images/icons/fb_icon.png" alt="Facebook"/></a>
					<a href="https://twitter.com/zealcity" target="_blank"><img src="{$base_dir}images/icons/twitter_icon.png" alt="Twitter"/></a>
				</div>
			</div>
            <div class="footer-column">
                <div class="footer-menu">
                    <ul>
                        <li><a href="{$base_dir}about-us">About Us</a></li>
                        <li><a href="{$base_dir}faqs">Faqs</a></li>
                        <li><a href="{$base_dir}legal">Is it legal?</a></li>
						<li><a href="{$base_dir}xtra-cash">Xtra cash</a></li>
                        <li><a href="{$base_dir}zealcity-points">Zealcity Points</a></li>
                    </ul>
                </div>
                <div class="footer-menu">
                    <ul>
                        <li><a href="{$base_dir}terms-conditions">Terms of Use</a></li>
                        <li><a href="{$base_dir}privacy-policy">Privacy Policy</a></li>
						<!--<li><a href="{$base_dir}refer-a-friend-program">Refer a friend program</a></li>-->
						<li><a href="{$base_dir}tournament-and-how-it-works">Tournaments and how it works?</a></li>
                        <li><a href="{$base_dir}deposit-and-withdraw">Deposit and Withdraw</a></li>
                    </ul>
                </div>
                <div class="footer-menu">
                    <ul>
                        <li><a href="{$base_dir}how-it-works">How it Works</a></li>
                        <li><a href="{$base_dir}support">Support</a></li>
                        <li><a href="{$base_dir}rules">Rules</a></li>
						<li><a href="{$base_dir}whats-new-in-zealcity">What's new In Zealcity?</a></li>
                    </ul>
                </div>
			</div>
			<div class="copyright">Zealcity.com and Captain of Captains&#8482; is owned and operated by Zealcity Studio Entertainment Pvt Ltd</div>
		</div>
	</div>
	<div class="transparent-container"></div>
	<div id="join-tournament" class="join-tournament"></div>
<script>
{literal}
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
	var e = document.createElement('script'); e.async = true;
	e.src = document.location.protocol +
	  '//connect.facebook.net/en_US/all.js';
	document.getElementById('fb-root').appendChild(e);
  }());
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40604259-1', 'zealcity.com');
  ga('send', 'pageview');
{/literal}
</script>
</body>
</html>