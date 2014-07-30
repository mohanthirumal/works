<div class="center-container">
	<div class="login-show-container" style="display:block; height: 434px;">
	<form action="index.php" method="post">
        <div class="login-box-container" style="height: 434px;">
            <div class="login-box-title trebuchet">
                Sign Up
                <div class="login-box-close-btn" onclick="zeal.user.closeSignUp();"></div>
            </div>
            <div class="login-box-body" id="signup-body">
                <div class="login-box-body-left">
                    <div class="facebook-photo" style="margin:130px 0 0 100px;"><img src="https://graph.facebook.com/{$id}/picture?type=large" alt=""/></div>
                </div>
                <div class="login-box-body-divider"></div> 
                <div class="login-box-body-right">
                    <div id="signup_error" style="margin:0;"></div>
                    <div class="signin-loading"></div>
                    <div class="clear"></div>
                    <div class="txt-login-input">
                        <span class="full-name-icon"></span>
                        <input type="text" name="txtusername" id="txtusernamesignup" value="" placeholder="Username" onblur="zeal.user.validateUsername(this);"/>
                        <div class="err_msg">
                        	<div class="exist-image"><img src="{$base_dir}images/question_icon.png" class="q-mark-img"/></div>
                            <div class="exist-image"><img src="{$base_dir}images/ok.png" class="uname-ok-image"/><img src="{$base_dir}images/no.png" class="uname-no-image"/></div>
                            <div class="user-message">Minimum 5 to 15 Characters</div>
                            <div class="special-message">Underscore only Allowed</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="txt-login-input">
                        <span class="full-pwd-icon"></span>
                        <input type="password" name="txtpassword" id="txtpassword"  placeholder="Password" value=""/>
                        <div class="err_msg">
                        	<div class="exist-image"><img src="{$base_dir}images/question_icon.png" class="q-mark-img"/></div>
                            <div class="exist-image"><img src="{$base_dir}images/ok.png" class="pass-ok-image"/><img src="{$base_dir}images/no.png" class="pass-no-image"/></div>
                            <div class="pass-message">Minimum 8 Characters</div>
						</div>
                    </div>
                    <div class="txt-login-input">
                        <span class="full-pwd-icon"></span>
                        <input type="password" name="txtpassword2" id="txtpassword2" value="" placeholder="Confirm Password" onblur="zeal.user.signupconfirmPass();"/>
                        <div class="err_msg">
                        	<div class="exist-image"><img src="{$base_dir}images/question_icon.png" class="q-mark-img"/></div>
                            <div class="exist-image"><img src="{$base_dir}images/ok.png" class="pass-ok-image"/><img src="{$base_dir}images/no.png" class="pass-no-image"/></div>
                            <div class="pass-message">Minimum 8 Characters</div>
						</div>
                    </div>
                    <div class="uname">
                        <!--<div class="uniquename">Verification Code</div>-->
                        <input type="text" name="txtCaptcha" value="" style="width:100px; height:30px;" onblur="zeal.user.validateCode(this);" id="verify-txt"/>
                        <img src="{$base_dir}captcha_code_file.php?rand=1055013809" alt="" style="margin:0 0 0 10px;" id="captchaimg"/>
                        <img src="{$base_dir}images/refresh.jpg" id="refresh-image" onclick="zeal.user.refreshCaptcha();" alt=""/>
                        <input type="hidden" name="capchaChecked" id="capchaChecked" value="false" />
                        <img src="{$base_dir}images/ok.png" class="code-ok-image"/><img src="{$base_dir}images/no.png" class="code-no-image"/>
                    </div>
                    <div class="termsandcond">
                        <input type="checkbox" name="chkbox" class="chkbox" id="signuptc"/>
                        <div class="terms">I am atleast 18 years of age and accept <a href="{$base_dir}terms-conditions">terms and conditions</a></div>
                    </div>
                    <div class="txt-login-signup">
                        <input type="button" class="login-signup-btn" value="Sign up" style="margin:10px 0 0 0; cursor:pointer;" onclick="zeal.facebook.signup();"/>
						<div class="loading hide"></div>
                    </div>
                    <div class="clear"></div>
                    <div class="login-agree-text">By signing up, you agree to our Terms of Use and<br/> Privacy Policy.</div>
                </div>
                
            </div>
        </div>
	</form> 
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

