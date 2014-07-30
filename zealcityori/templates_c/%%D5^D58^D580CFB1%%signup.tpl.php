<?php /* Smarty version 2.6.27, created on 2014-04-22 13:56:57
         compiled from signup.tpl */ ?>
<div class="loading" style="display:none; position:absolute;top: 200px;z-index: 1000;"></div>
<div class="center-container">
	<div class="login-show-container" style="display:block; height: 434px;">
	<form id="signup" action="index.php" method="post">
        <div class="login-box-container" style="height: 434px;">
            <div class="login-box-title trebuchet">
                Sign Up
                <div class="login-box-close-btn" onclick="zeal.user.closeSignUp();"></div>
            </div>
            <div class="login-box-body" id="signup-body">
                <div class="login-box-body-left">
                    <div class="login-box-fb-title">Sign Up via Facebook (Recommended)</div>
                    <a href="#" onclick="return zeal.facebook.login('signup');"><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/fbbutton.png" alt=""/></a>
                   <!-- <img name="flogin" id="flogin" src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/f_connect.png" onclick="zeal.facebook.login('signup');" style="margin: 10px 1px 1px 91px;"/>-->
                    <div class="login-box-left-already">
                        Already have an account?
                    <input type="button" value="Login" class="login-signup-btn" onclick="zeal.user.showSignin();"/>
                    </div>
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
                        	 <div class="exist-image"><a href="#" alt="Minimum 5 to 15 alphanumeric characters" class="tooltip"><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/question_icon.png" class="q-mark-img"/></a></div>
                            <div class="exist-image"><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/ok.png" class="uname-ok-image"/><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/no.png" class="uname-no-image"/></div>
                            <div class="user-message">Minimum 5 to 15 Characters</div>
                            <div class="special-message">Underscore only Allowed</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="txt-login-input">
                        <span class="full-email-icon"></span>
                        <input type="text" name="txtemail" id="email" placeholder="Email" onblur="zeal.user.validateEmailaddress(this);" />
                        <div class="err_msg">
                        	 <!--<div class="exist-image" title=""><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/question_icon.png" class="q-mark-img"/></div>-->
                        	<div class="exist-image"><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/ok.png" class="email-ok-image"/><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/no.png" class="email-no-image"/></div>
						</div>
                    </div>
                    <div class="clear"></div>
                    <div class="txt-login-input">
                        <span class="full-pwd-icon"></span>
                        <input type="password" name="txtpassword" id="txtpassword"  placeholder="Password" value=""/>
                        <div class="err_msg">
                        	 <div class="exist-image"><a href="#" alt="Minimum 8 alphanumeric characters" class="tooltip"><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/question_icon.png" class="q-mark-img"/></a></div>
                            <div class="exist-image"><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/ok.png" class="pass-ok-image"/><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/no.png" class="pass-no-image"/></div>
                            <div class="pass-message">Minimum 8 Characters</div>
						</div>
                    </div>
                    <div class="txt-login-input">
                        <span class="full-pwd-icon"></span>
                        <input type="password" name="txtpassword2" id="txtpassword2" value="" placeholder="Confirm Password" onblur="zeal.user.signupconfirmPass();"/>
                        <div class="err_msg">
                        	 <!--<div class="exist-image"><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/question_icon.png" class="q-mark-img"/></div>-->
                            <div class="exist-image"><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/ok.png" class="pass-ok-image"/><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/no.png" class="pass-no-image"/></div>
                            <div class="pass-message">Minimum 8 Characters</div>
						</div>
                    </div>
                    <div class="uname">
                        <!--<div class="uniquename">Verification Code</div>-->
                        <input type="text" name="txtCaptcha" value="" style="width:100px; height:30px;" onblur="zeal.user.validateCode(this);" id="verify-txt"/>
                        <img src="<?php echo $this->_tpl_vars['base_dir']; ?>
captcha_code_file.php?rand=1055013809" alt="" style="margin:0 0 0 10px;" id="captchaimg"/>
                        <img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/refresh.jpg" id="refresh-image" onclick="zeal.user.refreshCaptcha();" alt=""/>
                        <input type="hidden" name="capchaChecked" id="capchaChecked" value="false" />
                        <img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/ok.png" class="code-ok-image"/><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/no.png" class="code-no-image"/>
                    </div>
                    <div class="termsandcond">
                        <input type="checkbox" name="chkbox" class="chkbox" id="signuptc"/>
                        <div class="terms">I am atleast 18 years of age and accept <a href="<?php echo $this->_tpl_vars['base_dir']; ?>
terms-conditions">terms and conditions</a></div>
                    </div>
                    <div class="txt-login-signup">
                        <input type="submit" class="login-signup-btn" id="btn-signup" value="Sign up" style="margin:10px 0 0 0; cursor:pointer;"/>
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
            <input type="button" value="Deposit Now" class="addfunds" onclick="window.location.href='deposit'"/>
            <input type="button" value="skip" class="addfunds" onclick="zeal.user.closeDeposit()"/>		
        </div>
    </div>
</div>
<!-- Facebook Conversion Code for sign up on zc -->
<script type="text/javascript">alert(1);
<?php echo '
var fb_param = {};
fb_param.pixel_id = \'6007046374110\';
fb_param.value = \'0.00\';
fb_param.currency = \'USD\';
(function(){
var fpw = document.createElement(\'script\');
fpw.async = true;
fpw.src = \'//connect.facebook.net/en_US/fp.js\';
var ref = document.getElementsByTagName(\'script\')[0];
ref.parentNode.insertBefore(fpw, ref);
})();
'; ?>

</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/offsite_event.php?id=6007046374110&amp;value=0&amp;currency=USD" /></noscript>