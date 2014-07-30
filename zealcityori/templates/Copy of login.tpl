<div class="center-container">
<div class="signin-container signup-container" id="signin"{if isset($showcaptcha)} style="height:400px;"{/if}>
	<form action="" method="post">
		<div class="live-score-menu rightscore">
    		<div class="signuptext">Sign In</div>
    	</div>
        <div class="logintype">
            <!--<div class="flogin"></div>-->
            <img name="flogin" id="flogin" src="./images/f_connect.png" onclick="zeal.facebook.login('signin');" style="cursor:pointer;"/>
            <div class="or">OR</div>
        </div>
        <div class="uname">
            <div class="choseuruname">Username</div>
            <div class="line"></div>
            <div class="uniquename">Username or Email</div>
            <input type="text" name="email" id="txtemaillogin" value=""/></td>
        </div>
        <div class="uname">
            <div class="choseuruname">Password</div>
            <div class="line"></div>
            <div class="uniquename">Password</div>
            <input type="password" name="password" id="txtpasswordlogin" value=""/>
        </div>
		<div class="uname" id="captcha-container"{if !isset($showcaptcha)} style="display:none;"{/if}>
			<div class="choseuruname">Verify Yourself</div>
			<div class="line"></div>
			<div class="uniquename">Verification Code</div>
			<input type="text" name="txtCaptcha" value="" style="width:100px;" onblur="zeal.user.validateCode(this);" id="verify-txt"/>
			<img src="{$base_dir}captcha_code_file.php?rand=1055013809" alt="" style="margin:0 0 0 10px;" id="captchaimg"/>
			<img src="{$base_dir}images/refresh.jpg" id="refresh-image" onclick="zeal.user.refreshCaptcha();" alt=""/>
			<input type="hidden" name="capchaChecked" id="capchaChecked" value="false" />
			<img src="{$base_dir}images/ok.png" class="code-ok-image"/><img src="{$base_dir}images/no.png" class="code-no-image"/>
		</div>
		<div class="forgot-password-link"><input type="checkbox" name="remember" id="remember"/>&nbsp;Remember me </div>
		<div class="clear"></div>
        <input type="submit" value="Sign in" id="btn-signin" style="margin-left:230px; cursor:pointer;"/>
        <input type="button" value="Cancel" style="cursor:pointer;"  class="btn-signin" onclick="zeal.tournament.closeTournament();"/>
		<input type="hidden" name="action" value="signin"/><a href="forgot-password.php" class="forgot-password-text">Forgot Password</a>
	</form>
	<div class="loading" style="display:none;"></div>
</div>
</div>