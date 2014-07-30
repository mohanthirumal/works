<?php
class friendReferralController extends FrontController
{
	protected $title = 'Refer a Friend';
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		global $cookie;
		parent::preProcess();
		if(Tools::isSubmit('submitEmailInvite'))
		{
			$user = new User($cookie->user_id);
			$to = Tools::getValue('to');
			$body = Tools::getValue('body');
			$random = substr(md5(rand()),0,25);
			$subject = 'Invite from '.$user->username;						
			$message = '
				<html>
				<head>
				  <title>Zealcity Invitation</title>
				</head>
				<body>
					<div>'.$body.'</div>
					<div><a href="'.SITE_URL.'"?request_ids='.$random.'>Click here</a> to join in the zealcity tournament</div>
				</body>
				</html>
			';
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			if(mail($to, $subject, $message, $headers))
			{
				$this->errors[] = 'Invite has been sent successfully';
				$user->updateReferral($random);
			}
			else
				$this->errors[] = 'Error sending invite';
			// Additional headers
			//$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
//			$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
//			$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
//			$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";			
		}
	}
	
	public function setMedia()
	{
		parent::setMedia();
		Tools::addCSS('css/refer-a-friend.css', 'all');
	}
	
	public function process()
	{
		global $cookie;
		$user = new User($cookie->user_id);
		if(isset($user->connect['facebook']))
		{
			$facebook = $this->facebookConnect();
			self::$smarty->assign('facebook', $facebook);
		}
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('refer-a-friend.tpl');
	}
}
