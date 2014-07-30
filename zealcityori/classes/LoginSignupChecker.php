<?php
if (Tools::getValue('action'))
{
	if(Tools::getValue('action') == "signup")
	{
		$username = Tools::getValue('username');
		if(preg_match('/[\'^£$%&*()}{#~?><>,|=+¬-]/', Tools::getValue('username')))
			$this->errors[] = 'Special characters are not allowed in username';
		$email = Tools::getValue('email');
		$password = Tools::getValue('password');
		$captcha = $_SESSION['6_letters_code'];
		$captchaValue = Tools::getValue('verifycode');
		if($captcha != $captchaValue)
			$this->errors[] = 'Invalid verification code';
		if (count($this->errors))
			die(Tools::jsonEncode(array('hasErrors' => true, 'errors' => $this->errors)));
		if(!Validate::isEmail($email))
			$this->errors[] = 'Invalid Email';
		$user = new User();				
		if($user->checkUsernameExist($username) > 0)
			$this->errors[] = 'Username already exist';
		if($user->checkEmailExist($email) > 0)
			$this->errors[] = 'Email id already exist';
		$user->username = $username;
		$user->password = md5($password);
		$user->email = $email;
		$user->ip = Tools::getRemoteAddr();
		if (count($this->errors))
			die(Tools::jsonEncode(array('hasErrors' => true, 'errors' => $this->errors)));
		if($user->add())
		{
			$mail = new Mail();
			$mail->signupMail((int)($user->id), 'signup');
			self::$cookie->user_id = (int)($user->id);
			self::$cookie->logged = 1;
			self::$cookie->password = $user->password;
			self::$cookie->email = $user->email;
			if(Tools::getValue('connect') == 'true')
			{
				$userInfo = $this->facebookConnect();
				$user->updateConnect($userInfo['user']['id'], 'facebook');
			}
			die(Tools::jsonEncode(array('success' => true)));
		}
	}
	else if(Tools::getValue('action') == "signin")
	{
		$email = trim(Tools::getValue('email'));
		$password = trim(Tools::getValue('password'));
		$remember = trim(Tools::getValue('remember'));
		$captchaValue = Tools::getValue('verifycode');
		$user = new User();
		if($user->loginFailureAttempt() && strlen($captchaValue) == 0)
			die(Tools::jsonEncode(array('hasErrors' => true, 'errors' => 'Enter verification code', 'type' => 'captcha')));
		if(strlen($captchaValue) > 0)
		{
			$captcha = $_SESSION['6_letters_code'];
			if($captcha != $captchaValue)
			{
				$this->errors[] = 'Invalid verification code';
				die(Tools::jsonEncode(array('hasErrors' => true, 'errors' => $this->errors, 'type' => 'code')));
			}
		}
		if(preg_match('/[\'^£$%&*()}{#~?><>,|=+¬-]/', Tools::getValue('email')))
			$this->errors[] = 'Special characters are not allowed in username';
		$authentication = $user->getByEmail(trim($email), trim($password));
		if (!$authentication OR !$user->id)
		{
			
			/* Handle brute force attacks */
			sleep(1);
			$this->errors[] = 'Username or password invalid. Try again';
			$user->loginFailure(trim($email));
			die(Tools::jsonEncode(array('hasErrors' => true, 'errors' => $this->errors, 'type' => 'auth')));
		}
		else
		{
			if($remember == 'true')
				self::$cookie->setExpire(time() + (60*60*24));
			self::$cookie->user_id = (int)($user->id);
			self::$cookie->logged = 1;
			self::$cookie->password = $user->password;
			self::$cookie->email = $user->email;
			$user->date_upd = date('Y-m-d H:i:s');
			$user->ip = Tools::getRemoteAddr();
			$user->update();
//			if(strlen($captchaValue) > 0)
//				$user->removeLoginAttempt(); //Clear the login attempt
			die(Tools::jsonEncode(array('success' => true)));
			//Tools::redirect(__BASE_URI__.'index.php');
		}
	}
}