<div class="center-container">
<div class="signup-container" id="signup">
	<form action="index.php" method="post">
	<div class="live-score-menu rightscore">
    	<div class="signuptext">Sign Up</div>
    </div>
    <div class="logintype">
    	<!--<div class="flogin"></div>-->
        <img name="flogin" id="flogin" src="{$base_dir}images/f_connect.png" onclick="zeal.facebook.login('signup');"/>
        <div class="or">OR</div>
    </div>
	<div class="uname">
    	<div class="choseuruname">Choose a Username</div>
        <div class="line"></div>
        <div class="uniquename">A unique username</div>
        <input type="text" name="txtusername" id="txtusernamesignup" value="" onblur="zeal.user.validateUsername(this);"/>
        <div class="exist-image"><img src="{$base_dir}images/ok.png" class="uname-ok-image"/><img src="{$base_dir}images/no.png" class="uname-no-image"/></div>
        <div class="user-message">Minimum 5 to 15 Characters</div>
        <div class="special-message">Underscore only Allowed</div>
    </div>
    <div class="uname">
    	<div class="choseuruname">Choose Password</div>
        <div class="line"></div>
        <div class="uniquename">Password</div>
        <input type="password" name="txtpassword" id="txtpassword" value=""/>
        <div class="exist-image"><img src="{$base_dir}images/ok.png" class="pass-ok-image"/><img src="{$base_dir}images/no.png" class="pass-no-image"/></div>
        <div class="pass-message">Minimum 8 Characters</div>
    </div>
    <div class="uname">
    	<div class="choseuruname">Confirm Password</div>
        <div class="line"></div>
        <div class="uniquename">Confirm Password</div>
        <input type="password" name="txtpassword2" id="txtpassword2" value="" onblur="zeal.user.signupconfirmPass();"/>
        <div class="exist-image"><img src="{$base_dir}images/ok.png" class="pass-ok-image"/><img src="{$base_dir}images/no.png" class="pass-no-image"/></div>
        <div class="pass-message">Minimum 8 Characters</div>
    </div>
    <div class="uname">
    	<div class="choseuruname">E-Mail Address</div>
        <div class="line"></div>
        <div class="uniquename">E-mail Id</div>
        <input type="text" name="txtemail" id="email" onblur="zeal.user.validateEmailaddress(this);" />
        <div class="exist-image"><img src="{$base_dir}images/ok.png" class="email-ok-image"/><img src="{$base_dir}images/no.png" class="email-no-image"/></div>
    </div>
    <div class="uname">
    	<div class="choseuruname">Verify Yourself</div>
        <div class="line"></div>
		<div class="uniquename">Verification Code</div>
		<input type="text" name="txtCaptcha" value="" style="width:100px;" onblur="zeal.user.validateCode(this);" id="verify-txt"/>
		<img src="{$base_dir}captcha_code_file.php?rand=1055013809" alt="" style="margin:0 0 0 10px;" id="captchaimg"/>
        <img src="{$base_dir}images/refresh.jpg" id="refresh-image" onclick="zeal.user.refreshCaptcha();" alt=""/>
        <input type="hidden" name="capchaChecked" id="capchaChecked" value="false" />
        <img src="{$base_dir}images/ok.png" class="code-ok-image"/><img src="{$base_dir}images/no.png" class="code-no-image"/>
    </div>
    <div class="termsandcond">
    	<input type="checkbox" name="chkbox" class="chkbox" id="signuptc"/>
        <div class="terms"><span style="padding-left:8px;">I am atleast 18 years of age and accept <a href="{$base_dir}terms-conditions">terms and conditions</a></span></div>
    </div>
	<div class="clear"></div>
    <input type="submit" id="btn-signup" value="Sign up" style="margin-left:200px; cursor:pointer;"/>
	<input type="button" class="btn-signup" value="Cancel" style="cursor:pointer;" onclick="zeal.tournament.closeTournament();"/>
	</form>
	<div class="loading" style="display:none;"></div>
</div>
<div class="signin-container signup-container" id="signupsuccess">
	<div class="live-score-menu rightscore">
		<div class="signuptext">Signup Successful</div>
	</div>
	<div class="signup-success-msg">You have successfully signed up.<br/>You can earn money by referring friends.</div>
	<div class="clear"></div>
	<div style="width:95%; margin:20px 0 10px 20px;"><b>Note:</b> An e-mail has been sent to your mail address, Please check your spam folders if you do not receive it in the next few minutes.</div>
	<div class="signup-success-msg">Would you like to refer friends now.</div>
	<div class="signup-success-button">
		<input type="button" value="Invite friends and earn" class="addfunds" onclick="window.location.href='refer-a-friend'"/>
		<!--<input type="button" value="skip" class="addfunds" onclick="zeal.user.showDeposit()"/>-->
		<input type="button" value="skip" class="addfunds" onclick="zeal.user.closeDeposit()"/>		
	</div>
</div>
</div>