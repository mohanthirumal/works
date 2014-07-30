<?php
/**
 * Template Name: Reset password Page Template
 *
 */
if ( is_user_logged_in() || !isset($_GET['action'])):
	echo 'Access denied';
else:
if(isset($_GET['key']) && $_GET['action'] == "reset_pwd")
{
	$reset_key = $_GET['key'];
	$user_login = $_GET['login'];
	$user_data = $wpdb->get_row($wpdb->prepare("SELECT ID, user_login, user_email FROM $wpdb->users WHERE user_activation_key = %s AND user_login = %s", $reset_key, $user_login));
	$user_login = $user_data->user_login;
	$user_email = $user_data->user_email;
	if(!empty($reset_key) && !empty($user_data))
	{
		$new_password = wp_generate_password(7, false);
		wp_set_password( $new_password, $user_data->ID );
		$message = __('Your new password for the account at:') . "\r\n\r\n";
		$message .= get_option('siteurl') . "\r\n\r\n";
		$message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
		$message .= sprintf(__('Password: %s'), $new_password) . "\r\n\r\n";
		$message .= __('You can now login with your new password at: ') . get_option('siteurl')."/login" . "\r\n\r\n";
		if ( $message && !wp_mail($user_email, 'Password Reset Request', $message) )
		{
			echo "Email failed to send for some unknown reason";
			exit();
		}
		else
		{
			$redirect_to = get_bloginfo('url')."/reset-password/?action=reset_success";
			wp_safe_redirect($redirect_to);
			exit();
		}
	} 
	else
		exit('Not a Valid Key.');
}
get_header();
?>
<div class="facebook-signup-trans1"></div>
<div class="facebook-signup-trans" style="display:block;">
<form class="login-content" id="facebook-signup">
	<div class="login-box-container">
		<div class="login-box-title trebuchet">Reset Password<a href="<?php echo bloginfo('url');?>"><div class="login-box-close-btn"></div></a></div>
		<div class="login-box-body" id="signup-body">
			<div class="login-box-body-right" style="margin-left:135px; width:64%;">
				<div id="signup_error" style="margin:0;"></div>
				<div class="signin-loading"></div>
				<div class="clear"></div>
				<?php
				if(isset($_GET['action']) && $_GET['action'] == "reset_success")
				{
					echo '<div class="signup-success-inner">Your password has been successfully reset and send to your mail. You can reset your password in your myaccount section.</div>';
				}
				?>
			</div>
		</div>
	</div>
</form>
</div>
<?php
endif;
 get_footer();