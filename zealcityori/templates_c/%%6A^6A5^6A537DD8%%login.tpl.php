<?php /* Smarty version 2.6.27, created on 2014-04-29 15:07:12
         compiled from login.tpl */ ?>
<div class="login-show-container" style="display:block;">
<div class="loading" style="display:none; position:absolute;"></div>
<div class="login-box-container">
	<div class="login-box-title trebuchet">Login<div class="login-box-close-btn" onclick="zeal.user.closeSignin();"></div></div>
	<div class="login-box-body" id="login-form">
		<div class="login-box-body-left">
			<div class="login-box-fb-title">Login via Facebook (Recommended)</div>
			<a href="#" onclick="return zeal.facebook.login('signin');"><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/fbbutton.png" alt=""/></a>
			<div class="login-box-left-already">
				Don't have an account?
				<input type="button" value="Sign Up" class="login-signup-btn" onclick="zeal.user.showSignUp();"/>
			</div>
		</div>
		<div class="login-box-body-divider"></div>
		<div class="login-box-body-right">
			<form class="login-content" id="login" method="post" name="loginform">
			<div class="signin-loading"></div>
			<div id="login_error"></div>
			<div class="txt-login-input" style="margin-top:40px;">
				<span class="full-email-icon"></span>
				<input type="text" value="" autocomplete="off" placeholder="Username or E-mail" name="email" id="username"/>
			</div>
			<div class="clear"></div>
			<div class="txt-login-input">
				<span class="full-pwd-icon"></span>
				<input type="password" value="" autocomplete="off" placeholder="Password" name="password" id="password"/>
			</div>
			<div class="clear"></div>
            <div class="remeber" style="margin: 0 0 10px 0;">
				<input type="checkbox" name="remember" class="remember-me" id="remember-me" style="float:left;"/>
                <div>Remember Me</div>
			</div>
			<div class="clear"></div>
			<div id="captcha-veri-container"<?php if (! $this->_tpl_vars['showcaptcha']): ?> style="display:none;"<?php endif; ?>>
				<input type="text" name="txtCaptcha" value="" style="width:100px; height: 28px;" onblur="zeal.user.validateCode(this);" id="verify-txt"/>
				<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
captcha_code_file.php?rand=1055013809" alt="" style="margin:0 0 0 10px;" id="captchaimg"/>
				<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/refresh.jpg" id="refresh-image" onclick="zeal.user.refreshCaptcha();" alt=""/>
				<input type="hidden" name="capchaChecked" id="capchaChecked" value="false" />
			</div>
			<div class="txt-login-signup">
				<input type="submit" class="login-signup-btn" value="Login" id="btn-login"/> Or <a href="<?php echo $this->_tpl_vars['base_dir']; ?>
forgot-password" id="forgot-password-txt">Forgot Password?</a>
			</div>
			<div class="clear"></div>
			</form>
		</div>
	</div>
	<div class="login-box-body" id="forgot-form" style="display:none;">
		<form class="login-content" id="forgot-pass-form">
			<div class="login-box-body-right" style="margin-left:250px;">
				<div id="signup_error" style="margin:0;"></div>
				<div class="signin-loading"></div>
				<div class="clear"></div>
				<h2 style="text-align:left;">Forgot Password</h2>
				<div class="txt-login-input">
					<span class="full-name-icon"></span>
					<input type="text" value="" autocomplete="off" placeholder="Enter your email" id="user_login" name="email"/>
				</div>
				<div class="clear"></div>
				<div class="txt-login-signup">
					<input type="submit" class="login-signup-btn" value="Submit" id="btn-forgot-password"/>
					<input type="hidden" name="tg_pwd_nonce" value="<?php echo '<?php'; ?>
 echo wp_create_nonce("tg_pwd_nonce"); <?php echo '?>'; ?>
" />
				</div>
			</div>
		</form>
	</div>
	<div class="login-box-body" id="forgot-form-confirm" style="display:none;">
		<div class="signup-success-inner">We have sent you a mail with password reset instructions.</div>
	</div>
</div>
</div>