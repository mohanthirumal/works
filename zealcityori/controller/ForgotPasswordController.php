<?php
class ForgotPasswordController extends FrontController
{
	protected $title = 'Forgot Password';
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		parent::preProcess();
		if(Tools::isSubmit('submitForgotPassword'))
		{
			if (!($email = Tools::getValue('email')) OR !Validate::isEmail($email))
				$this->errors[] = 'Invalid e-mail address';
			else
			{
				$user = new User();
				$user->getByEmail($email);
				if (!Validate::isLoadedObject($user))
					$this->errors[] = 'There is no account registered to this e-mail address.';
				else
				{
					$mail = new Mail();
					$url = SITE_URL.'forgot-password?token='.$user->secure_key.'&user_id='.$user->id;
					if($mail->passwordRequest((int)($user->id), 'password_query', $url))
						self::$smarty->assign(array('confirmation' => 2, 'email' => $user->email));
					else
						$this->errors[] = 'Error occurred when sending the e-mail.';
				}
			}
		}
		elseif (($token = Tools::getValue('token')) && ($user_id = (int)(Tools::getValue('user_id'))))
		{
			$email = Db::getInstance()->getValue('SELECT `email` FROM coc_users c WHERE c.`secure_key` = \''.pSQL($token).'\' AND c.id = '.(int)$user_id);
			if ($email)
			{
				$user = new User();
				$user->getByemail($email);
				$user->password = Tools::encrypt($password = Tools::passwdGen(8));
				$user->secure_key = md5(uniqid(rand(), true));
				if ($user->update())
				{
					$mail = new Mail();
					if($mail->sendPassword((int)($user->id), 'password', $password))
						self::$smarty->assign(array('confirmation' => 1, 'email' => $user->email));
					else
						$this->errors[] = 'Error occurred when sending the e-mail.';
				}
				else
					$this->errors[] = 'An error occurred with your account and your new password cannot be sent to your e-mail. Please report your problem using the contact form.';
			}
			else
				$this->errors[] = 'We cannot regenerate your password with the data you submitted';
		}
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('forgot-password.tpl');
	}
}
