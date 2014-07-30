<?php
class Mail
{	
	public function signupMail($id, $template)
	{
		$user = new User($id);
		$to = $user->email;
		$subject = "Zealcity Signup Notification";
		$message = file_get_contents(SITE_URL.'mail/'.$template.'.html');
		return $this->send($to, $subject, $message);
	}
	
	public function depositMail($id, $template, $deposit_money)
	{
		$user = new User($id);
		$to = $user->email;
		$name = $user->firstname;
		$subject = "Zealcity Deposit Notification";
		$message = file_get_contents(SITE_URL.'mail/'.$template.'.html');
		$message = str_replace('{firstname}', $user->firstname, $message);
		$message = str_replace('{lastname}', $user->lastname, $message);
		$message = str_replace('{deposit_money}', $deposit_money, $message);
		$message = str_replace('{balance}', $user->cash, $message);
		return $this->send($to, $subject, $message);
	}
	
	public function withdrawMail($id, $template, $withdraw_money)
	{
		$user = new User($id);
		$to = $user->email;
		$name = $user->firstname;
		$subject = "Zealcity Withdraw Notification";
		$message = file_get_contents(SITE_URL.'mail/'.$template.'.html');
		$message = str_replace('{firstname}', $user->firstname, $message);
		$message = str_replace('{lastname}', $user->lastname, $message);
		$message = str_replace('{balance}', $user->cash, $message);
		$message = str_replace('{withdraw_money}', $withdraw_money, $message);
		return $this->send($to, $subject, $message);
	}
	
	public function send($to, $subject, $message)
	{
		$message = str_replace('{shop_name}', 'Zealcity.com', $message);
		$message = str_replace('{shop_url}', 'http://Zealcity.com', $message);
		$message = str_replace('{shop_logo}', 'http://Zealcity.com/images/logo.jpg', $message);
		
		$mail = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->Host       = "smtpmail.itspets.com"; // sets the SMTP server
		$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
		$mail->Username   = "customercare@itspets.com"; // SMTP account username
		$mail->Password   = "care@09321";        // SMTP account password
		
		$mail->SetFrom('admin@zealcity.com', 'Zealcity');
		$mail->Subject    = $subject;
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		$mail->MsgHTML($message);
		$mail->AddAddress($to);
		if(!$mail->Send())
			return false;
		return true;
	}
	
	public function supportMail($name, $email, $body)
	{
		$to = 'support@zealcity.com';
		$subject = "Zealcity Support";
		$message = file_get_contents(SITE_URL.'mail/support.html');
		$message = str_replace('{content}', $body, $message);

		return $this->send($to, $subject, $message);
	}
	
	public function passwordRequest($id, $template, $url)
	{
		$user = new User($id);
		$to = $user->email;
		$subject = "Forgot password";
		$message = file_get_contents(SITE_URL.'mail/'.$template.'.html');
		$message = str_replace('{firstname}', $user->firstname, $message);
		$message = str_replace('{lastname}', $user->lastname, $message);
		$message = str_replace('{url}', $url, $message);
		return $this->send($to, $subject, $message);
	}
	
	public function sendPassword($id, $template, $password)
	{
		$user = new User($id);
		$to = $user->email;
		$subject = "Your password has been reset";
		$message = file_get_contents(SITE_URL.'mail/'.$template.'.html');
		$message = str_replace('{firstname}', $user->firstname, $message);
		$message = str_replace('{lastname}', $user->lastname, $message);
		$message = str_replace('{passwd}', $password, $message);
		$message = str_replace('{email}', $user->email, $message);
		return $this->send($to, $subject, $message);
	}
}