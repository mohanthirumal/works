<?php
class MyAccountController extends FrontController
{
	protected $title = 'My Account';
	protected $tournament;
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		global $cookie;
		if(!$cookie->isLogged())
			Tools::redirect('index.php');
		parent::preProcess();
		if(Tools::isSubmit('submitPersonal'))
		{
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', Tools::getValue('txtfirstname')))
				$this->errors[] = 'Special characters are not allowed in first name';
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', Tools::getValue('txtlastname')))
				$this->errors[] = 'Special characters are not allowed in last name';
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', Tools::getValue('country')))
				$this->errors[] = 'Special characters are not allowed in country';
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', Tools::getValue('state')))
				$this->errors[] = 'Special characters are not allowed in state';
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', Tools::getValue('city')))
				$this->errors[] = 'Special characters are not allowed in city';
			if(preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬]/', Tools::getValue('address')))
				$this->errors[] = 'Special characters are not allowed in address';
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', Tools::getValue('pincode')))
				$this->errors[] = 'Special characters are not allowed in pincode';
			$user = new User($cookie->user_id);
			$user->firstname = Tools::getValue('txtfirstname');
			$user->lastname = Tools::getValue('txtlastname');	
			$dob = Tools::getValue('years').'-'.Tools::getValue('months').'-'.Tools::getValue('days');
			$user->dob = $dob;
			$user->sex = Tools::getValue('sex');
			$user->country = Tools::getValue('country');
			$user->state = Tools::getValue('state');
			$user->city = Tools::getValue('city');
			$user->address = Tools::getValue('address');
			$user->pincode = Tools::getValue('pincode');
			$user->mobno = Tools::getValue('mobno');
			$oldPassword = md5(Tools::getValue('oldpassword'));
			$newPassword = Tools::getValue('newpassword');
			$confirmPassword = Tools::getValue('confirmpassword');
			if(!empty($newPassword))
			{
				if($cookie->password != $oldPassword)
					$this->errors[] = 'Invalid old password';
				if(empty($newPassword) && empty($confirmPassword) && trim($newPassword) != trim($confirmPassword))
					$this->errors[] = 'Password does not match';
				$user->password = md5($newPassword);
			}
			if (count($this->errors) > 0)
				return false;
			if (Tools::getValue('newpassword'))
					$cookie->password = $user->password;
			$user->update();
			$this->errors[] = 'Your account has been updated successfully';
		}
		else if(Tools::isSubmit('submitWithdraw'))
		{
			$user = new User($cookie->user_id);
			
			$amount = (int)Tools::getValue('amount');
			$pan_no = Tools::getValue('panno');
			
			if(strlen($pan_no) == 0)
				$this->errors[] = 'ID proof is required for withdrawal';
			if($amount < 500)
				$this->errors[] = 'You are not allowed to withdraw below 500 Rupees';
			else if($amount > $user->cash)
				$this->errors[] = 'You dont have sufficient cash';
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', Tools::getValue('panno')))
				$this->errors[] = 'Special characters are not allowed in PAN Number';
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', Tools::getValue('country')))
				$this->errors[] = 'Special characters are not allowed in country';
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', Tools::getValue('state')))
				$this->errors[] = 'Special characters are not allowed in state';
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', Tools::getValue('city')))
				$this->errors[] = 'Special characters are not allowed in city';
			if(preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬]/', Tools::getValue('address')))
				$this->errors[] = 'Special characters are not allowed in address';
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', Tools::getValue('pincode')))
				$this->errors[] = 'Special characters are not allowed in pincode';
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', Tools::getValue('mobno')))
				$this->errors[] = 'Special characters are not allowed in mobile number';
			if(count($this->errors) > 0)
				return false;
			$pan_no .= '---'.$_POST['chqproof-select'];			
			$withdraw = new Withdraw();
			$withdraw->user_id = $user->id;			
			$address = Tools::getValue('address').',';
			$address .= Tools::getValue('city').',';
			$address .= Tools::getValue('state').',';
			$address .= Tools::getValue('country').',';
			$address .= Tools::getValue('pincode').',';
			$address .= Tools::getValue('mobno');
			$withdraw->address = $address;
			$withdraw->status = 'pending';
			$withdraw->amount = $amount;
			$withdraw->pan_no = $pan_no;
			$withdraw->timestamp = date('Y-m-d H:i:s');
			$withdraw->type = 'Cheque';
			if($withdraw->add())
				if($user->reduceCash($amount))
				{
					$this->errors[] = 'You have successfully withdrawn your amount. It will be processed shortly. Your withdrawal id is W'.$withdraw->id;
					$mail = new Mail();
					if(!$mail->withdrawMail((int)($user->id), 'withdraw', $amount))
						$this->errors[] = 'Error sending mail';
				}
		}
		else if(Tools::isSubmit('submitOnlineWithdraw'))
		{
			$user = new User($cookie->user_id);

			$amount = (int)Tools::getValue('amount');
			$pan_no = Tools::getValue('panno');
			$accname = Tools::getValue('accname');
			$bank = Tools::getValue('bankname');
			$accno = Tools::getValue('accno');
			$ifsccode = Tools::getValue('ifsccode');
			$mobile = Tools::getValue('mobile');
			
			if($amount < 500)
				$this->errors[] = 'You are not allowed to withdraw below 500 Rupees';
			if(strlen($pan_no) == 0)
				$this->errors[] = 'ID proof is required for withdrawal';
			else if($amount > $user->cash)
				$this->errors[] = 'You dont have sufficient cash';
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', Tools::getValue('panno')))
				$this->errors[] = 'Special characters are not allowed in PAN Number';
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', Tools::getValue('accname')))
				$this->errors[] = 'Special characters are not allowed in Name';
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', Tools::getValue('bankname')))
				$this->errors[] = 'Special characters are not allowed in Bank Name';
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', Tools::getValue('accno')))
				$this->errors[] = 'Special characters are not allowed in Account Number';
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', Tools::getValue('ifsccode')))
				$this->errors[] = 'Special characters are not allowed in IFSC code';
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', Tools::getValue('mobile')))
				$this->errors[] = 'Special characters are not allowed in mobile number';
			
			if(count($this->errors) > 0)
				return false;
			$pan_no .= '---'.$_POST['proof-select'];
			$withdraw = new Withdraw();
			$withdraw->user_id = $user->id;		
			$withdraw->status = 'pending';
			$withdraw->amount = $amount;
			$withdraw->pan_no = $pan_no;
			$withdraw->timestamp = date('Y-m-d H:i:s');
			$withdraw->type = 'Online Transfer';
			if($withdraw->add())
			{
				$onlineWith = $withdraw->onlineWithdraw($accname, $accno, $bank, $ifsccode, $mobile);
				if($user->reduceCash($amount))
				{
					$this->errors[] = 'You have successfully withdrawn your amount. It will be processed shortly. Your withdrawal ID is W'.$withdraw->id;
					$mail = new Mail();
					if(!$mail->withdrawMail((int)($user->id), 'withdraw', $amount))
						$this->errors[] = 'Error sending mail';
				}
						
			}
		}
		else if(Tools::isSubmit('submitBonus'))
		{
			$id = Tools::getValue('id');
			$bonus = new Bonus($id);
			if($bonus->current_bonus != $bonus->bonus)
				$this->errors[] = 'Sorry, You not allowed to collect the bonus';
			$currentTime = strtotime(date('Y-m-d H:i:s'));
			if($currentTime > strtotime($bonus->expiry))
			{
				$this->errors[] = 'Sorry, Your bonus has been Expired';
				$bonus->updateStatus('expired');
			}
			if(count($this->errors) > 0)
				return false;
			$bonus->collectBonus();
			$this->errors[] = 'Bonus Collected Successfully';
		}
	}
	
	public function process()
	{
		parent::process();
		global $cookie;
		$user = new user($cookie->user_id);
		$withdraws = $user->getWithdrawals();
		$deposits = $user->getDeposits();
		$inprogressCash = $user->getInprogressCash();
		$trans = $user->getTransHistory();
		self::$smarty->assign('user', $user);
		self::$smarty->assign('inprogressCash', $inprogressCash);
		self::$smarty->assign('withdraws', $withdraws);
		self::$smarty->assign('deposits', $deposits);
		self::$smarty->assign('trans', $trans);
		
		$birthday = array(0,0,0);
		if ($user->dob)
			$birthday = explode('-', $user->dob);
		self::$smarty->assign(array(
			'years' => Tools::dateYears(),
			'sl_year' => $birthday[0],
			'months' => Tools::dateMonths(),
			'sl_month' => $birthday[1],
			'days' => Tools::dateDays(),
			'sl_day' => $birthday[2]
		));
		$bonus = $user->getBonus();
		self::$smarty->assign('bonuses', $bonus);
	}
	
	public function setMedia()
	{
		parent::setMedia();
		Tools::addCSS('css/my-account.css', 'all');
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('my-account.tpl');
	}
}
