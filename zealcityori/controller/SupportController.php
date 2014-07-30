<?php
class SupportController extends FrontController
{
	protected $title = 'Support';
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		global $smarty;
		parent::preProcess();
		$smarty->assign('rand', rand());
		if(Tools::isSubmit('submitSupport'))
		{
			$name = Tools::getValue('txtname');
			$email = Tools::getValue('txtemail');
			$body = Tools::getValue('body');
			$body = $body.'<br/><br/><br/>Name : '.$name.'<br/>Email : '.$email;
			$captcha = $_SESSION['6_letters_code'];
			$captchaValue = Tools::getValue('txtverification');
			if($captcha != $captchaValue)
				$this->errors[] = 'Invalid verification code';
			else
			{
				$support = new Support();
				$support->name = $name;
				$support->email = $email;
				$support->content = $body;
				$support->add();
				$mail = new Mail();
				if($mail->supportMail($name, $email, $body))
					$this->errors[] = 'Thank you for your support. Will contact you soon!';
			}
		}
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('support.tpl');
	}
}
