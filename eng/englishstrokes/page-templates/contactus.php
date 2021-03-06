<?php
/**
 * Template Name: Contactus Page Template
 *
 * Description: Course page contains chapters of that course
 */
session_start();
get_header();
if($_POST)
{
	if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) > 0 && strtoupper($_REQUEST['action']) == 'CONTACTUS')
	{
		$captchaCode = $_SESSION['6_letters_code'];
		$verificationCode = mysql_escape_string($_REQUEST['txtverification']);
		require_once(ABSPATH.'classes/recaptchalib.php');
		$privatekey = "6Ldgge0SAAAAAJMuVScV5osUNvLaQrnsw_ir3zXs";
		$resp = recaptcha_check_answer ($privatekey,
								$_SERVER["REMOTE_ADDR"],
								$_POST["recaptcha_challenge_field"],
								$_POST["recaptcha_response_field"]);
  
		if($resp->is_valid)
		{
			$name = mysql_escape_string($_REQUEST['txtname']);
			$email = mysql_escape_string($_REQUEST['txtemail']);
			$fax = mysql_escape_string($_REQUEST['txtfax']);
			//$comment = mysql_escape_string($_REQUEST['message']);
			$mess = mysql_escape_string($_REQUEST['message']);
			$comment = html2txt($mess);
			
			
			if($comment != '' && strlen($comment) != strlen($mess))
				$commentMessage = 0;
			else if($name == '' || !preg_match("/^[a-zA-Z ]*$/",$name))
				$nameValid = 0;
			else if($email == '' || !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
				$mailValid = 0;
			else if($fax != '' && !preg_match('/^\d{10}$/',$fax)) // phone number is valid
				$faxValid = 0;
			else
			{
				$sql = 'INSERT INTO contact_us(`name`, `email`, `fax`, `comment`) VALUES
				(\''.$name.'\', \''.$email.'\', \''.$fax.'\', \''.$comment.'\')';
				$commentMessage = 1;
				$nameValid = 1;
				$mailValid = 1;
				$faxValid  = 1;
				$capchaCheck = 1;
				
				//$mail = new Mail();
				$to = 'mohan@zealcity.com';   //,adit@zcstudio.com,sri@t20learning.com,surya@t20learning.com,ganesh@krishcricket.com
				$subject = "Englishstrokes contact Us";
				$message = '
							Name : '.$name.'<br/>
							Email : '.$email.'<br/>
							Mobile : '.$fax.'<br/>
							Comment : '.$comment.'<br/>
				';
				wp_mail($to,$subject,$message);
				mysql_query($sql);
			
			}
		//	else
//				$commentMessage = 0;			
		}
		else
			$capchaCheck = 0;
	}
}

function html2txt($document){ 
$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript 
               '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly 
               '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags 
               '@<![\s\S]*?--[ \t\n\r]*>@'        // Strip multi-line comments including CDATA 
); 
$text = preg_replace($search, '', $document); 
return $text;
} 
 ?>
<div class="page-content contactus">
	<img src="<?php bloginfo('template_url'); ?>/images/contactus-banner.jpg" alt=""/>
	<div class="left-container">
		<div class="title1 trebuchet">About Englishstrokes</div>
		<div class="clear"></div>
		<div style="float:left;">
			<img src="<?php bloginfo('template_url');?>/images/contact-us-thumb.jpg" alt="" class="content-image"/>
		</div>
		<div style="float:right">
			<div class="sub-title1" style="clear:none;">Feel free to contact us for any information that you may<br/> need</div>		
			<p>AA Edutech Private Limited<br/>(formerly Sun Online Learning India (Pvt) Ltd).<br/>19, 5th Street<br/>Bhaktavachalam Nagar<br/>Adyar, Chennai 600 020</p></br>
			<p>British Council Division<br/>British Deputy High Commission<br/>737 Anna Salai<br/>Chennai 600 002</p>
		</div>
		<div class="clear"></div>
		<div class="academic-contact-queries">
			<div class="sub-title3 trebuchet" style="margin-bottom:10px">For Academic Queries:</div>
			<a href="mailto:britishcouncil@englishstrokes.com">britishcouncil@englishstrokes.com</a>
		</div>
		<div class="academic-contact-queries" style="border:0;">
			<div class="sub-title3 trebuchet" style="margin-bottom:10px">For Technical Queries:</div>
			<a href="mailto:tech@englishstrokes.com">tech@englishstrokes.com</a>
		</div>
		<div class="title1 trebuchet" style="margin-top:10px">Contact Form</div>
		<div class="clear"></div>
		<?php if(isset($capchaCheck) && $capchaCheck == 1 && $commentMessage == 1 && $nameValid = 1 && $mailValid = 1 && $faxValid = 1):?>
		<div style="color:#16C0E3;">Thank you for contacting us! We will get back to you soon.</div>
		<?php elseif(isset($capchaCheck) && $capchaCheck == 0):?>
		<div style="color:#F00;">Invalid Verification Code!</div>
        <?php elseif(isset($commentMessage) && $commentMessage == 0):?>
        <div style="color:#F00;">Invalid tags are used in comment!</div>
        <?php elseif(isset($nameValid) && $nameValid == 0):?>
        <div style="color:#F00;">Invalid Name!</div>
		<?php elseif(isset($mailValid) && $mailValid == 0):?>
        <div style="color:#F00;">Invalid Mail!</div>
        <?php elseif(isset($faxValid) && $faxValid == 0):?>
        <div style="color:#F00;">Invalid Mobile!</div>
		<?php endif;?>
		<form method="post" action="<?php bloginfo('url');?>/contactus#contactform" id="contactform" onsubmit="return eng.pages.validateContactForm()">
			<div class="contact-form-left">
				<div class="form-field">Enter your Name:*</div>
				<input type="text" name="txtname" id="txtname" value=""/>
				<div class="form-field">Enter your E-mail:*</div>
				<input type="text" name="txtemail" id="txtemail" value=""/>
				<div class="form-field">Enter your Mobile Number:</div>
				<input type="text" name="txtfax" id="txtmobile" value=""/>
                <div style="font-size:14px;">* Required fields</div>
			</div>
			<div class="contact-form-right">
				<div class="form-field">Enter your Comment:*</div>
				<textarea name="message" id="message" rows="5"></textarea>
				<div class="contact-form-verification">
					<div class="form-field">Verification:*</div>
					<div id="captcha">
						<script type="text/javascript">
						 Recaptcha.create("6Ldgge0SAAAAAGVPsvXZ542220RR1fFpAd7vA6nq",
							"recaptcha_image",
							{
							  theme: "custom"
							}
						  );
						 </script>
						<div id="recaptcha_widget">
							<div id="recaptcha_image"></div>
							<img src="<?php bloginfo('template_url');?>/images/refresh.jpg" id="refresh-image" class="refresh-image" onclick="javascript:Recaptcha.reload()">
							<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" class="recaptcha_response_field" value="" style="width:228px;" placeholder="  Enter code here"/>
						</div>

						<noscript>
							<iframe src="https://www.google.com/recaptcha/api/noscript?k=6Ldgge0SAAAAAGVPsvXZ542220RR1fFpAd7vA6nq" height="300" width="500" frameborder="0"></iframe><br>
							<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
							<input type="hidden" name="recaptcha_response_field" value="manual_challenge">
						</noscript>
						<style>#recaptcha1_image,#recaptcha1_image img{width:270px !important; float:left; margin-right:1px;}#recaptcha_widget{margin-top:5px; float:left;}</style>
					</div>
					<!--<input type="text" name="txtverification" id="txtcontactverif" class="txtcapchh" value=""/>
					<img src="<?php bloginfo('url');?>/captcha_code_file.php?rand=<?php echo rand();?>" alt="" id="captchacontactimg"/>
					<input type="button" src="<?php bloginfo('template_url');?>/images/refresh.jpg" alt="" onclick="refreshContactCaptcha();"/>-->
				</div>
				<input type="reset" value="RESET" class="btn-button1 trebuchet"/>
				<input type="submit" value="SUBMIT" id="contact-form-submit-btn" class="btn-button1 trebuchet"/>
			</div>
			<input type="hidden" name="action" value="contactus"/>
		</form>
	</div>
	<div class="right-container" style="width:300px;">
		<div class="sidebar1 column2" style="height:620px;">
			<div class="sidebar1-title trebuchet">OUR LOCATIONS</div>
			<div class="sidebar1-content">
				<h2>CHENNAI</h2>
				AA Edutech Private Limited<br/>(formerly Sun Online Learning India (Pvt) Ltd).<br/>19, 5th Street<br/>Bhaktavachalam Nagar<br/>Adyar, Chennai 600 020</br>
				<div class="dooted-separator"></div>
				British Council Division<br/>British Deputy High Commission<br/>737 Anna Salai<br/>Chennai 600 002
				<div class="dooted-separator"></div>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();