<?php
class User extends ObjectModel
{
	public $id;
	public $username;
	public $password;
	public $firstname;
	public $lastname;
	public $dob;
	public $sex;
	public $country;
	public $state;
	public $city;
	public $address;
	public $pincode;
	public $email;
	public $cash = 0;
	public $coin;
	public $secure_key;
	public $date_add;
	public $date_upd;
	public $connect = array();
	protected 	$table = 'coc_users';
	protected 	$identifier = 'id';
	
	public function __construct($id = NULL)
	{
		parent::__construct($id);
		$this->getConnect();
	}
	
	public function getFields()
	{
		if (isset($this->id))
			$fields['id'] = (int)($this->id);
		$fields['username'] = pSQL($this->username);
		$fields['password'] = pSQL($this->password);
		$fields['firstname'] = pSQL($this->firstname);
		$fields['lastname'] = pSQL($this->lastname);
		$fields['dob'] = pSQL($this->dob);
		$fields['sex'] = pSQL($this->sex);
		$fields['country'] = pSQL($this->country);
		$fields['state'] = pSQL($this->state);
		$fields['city'] = pSQL($this->city);
		$fields['address'] = pSQL($this->address);
		$fields['pincode'] = pSQL($this->pincode);
		$fields['email'] = pSQL($this->email);
		$fields['cash'] = pSQL($this->cash);
		$fields['secure_key'] = pSQL($this->secure_key);
		$fields['date_add'] = pSQL($this->date_add);
		$fields['date_upd'] = pSQL($this->date_upd);
		return $fields;
	}
	
	private function getConnect()
	{
		$sql = 'SELECT * FROM `coc_users_connect` WHERE `user_id` = \''.(int)$this->id.'\'';
		$results = Db::getInstance()->ExecuteS($sql);
		foreach($results as $result)
			$this->connect[$result['type']] = $result['connect_id'];
	}
	
	public function add($autodate = true, $nullValues = true)
	{
		$this->secure_key = md5(uniqid(rand(), true));
	 	if (!parent::add($autodate, $nullValues))
			return false;
		return true;
	}
	
	public function checkEmailExist($email)
	{
		$sql = "SELECT * FROM coc_users WHERE email = '".$email."'";
		$matchScore = Db::getInstance()->ExecuteS($sql);
		return Db::getInstance()->NumRows();
	}
	
	public function checkUsernameExist($username)
	{
		$sql = "SELECT * FROM coc_users WHERE username = '".$username."'";
		$matchScore = Db::getInstance()->ExecuteS($sql);
		return Db::getInstance()->NumRows();
	}
	
	public function getByEmail($email, $passwd = NULL)
	{
	 	if (($passwd AND !Validate::isPasswd($passwd)))
	 		return false;
		$result = Db::getInstance()->getRow('
		SELECT *
		FROM `coc_users`
		WHERE (`username` = \''.$email.'\' OR `email` = \''.$email.'\')
		'.(isset($passwd) ? 'AND `password` = \''.md5($passwd).'\'' : ''));
		if (!$result)
			return false;
		$this->id = $result['id'];
		foreach ($result AS $key => $value)
			if (key_exists($key, $this))
				$this->{$key} = $value;

		return $this;
	}
	
	public static function checkPassword($user_id, $passwd)
	{
	 	if (!Validate::isUnsignedId($user_id) OR !Validate::isMd5($passwd))
	 		die ();

		return (bool)Db::getInstance()->getValue('
		SELECT `id`
		FROM `coc_users`
		WHERE `id` = '.(int)($user_id).'
		AND `password` = \''.$passwd.'\'');
	}
	
	public function reduceCash($amount)
	{
		if(Db::getInstance()->Execute('UPDATE `coc_users` SET `cash` = `cash` - '.(int)($amount).' WHERE `id` = '.(int)($this->id)))
			return true;
	}
	
	public function addCash($amount)
	{
		if(Db::getInstance()->Execute('UPDATE `coc_users` SET `cash` = `cash` + '.(int)($amount).' WHERE `id` = '.(int)($this->id)))
			return true;
	}
	
	public function getUserFromConnect($connect_id, $type)
	{
		$sql = 'SELECT * FROM `coc_users_connect` uc
				INNER JOIN `coc_users` u ON uc.`user_id` = u.`id` 
				WHERE `connect_id` = '.$connect_id.' AND `type` = \''.$type.'\'';
		$result = Db::getInstance()->getRow($sql);
		$rowCount = Db::getInstance()->NumRows();
		if($rowCount == 0)
			return false;	
		$this->id = $result['id'];
		foreach ($result AS $key => $value)
			if (key_exists($key, $this))
				$this->{$key} = $value;
		return true;
	}
	
	public function updateConnect($id, $type)
	{
		if($this->checkConnectExist($id, $type) == 0)
			if(Db::getInstance()->Execute('INSERT INTO `coc_users_connect`(`user_id`, `connect_id`, `type`) VALUES
					('.(int)($this->id).', '.($id).', \''.$type.'\')'))
				return true;
		return false;
	}
	
	public function checkConnectExist($id, $type)
	{
		if(Db::getInstance()->ExecuteS('SELECT * FROM `coc_users_connect` WHERE `connect_id` = '.$id.' AND `type` = \''.$type.'\''))
			return Db::getInstance()->NumRows();
	}
	
	public function getInprogressCash()
	{
		$sql = 'SELECT sum(`amount`) AS `entryfee` FROM `coc_joined_tournament` jt
				INNER JOIN `coc_tournament` t ON t.`id` = jt.`tournament_id`
				INNER JOIN `coc_entry_fee` ef ON ef.`id` = t.`entry_fee_id` 
				WHERE `user_id` = '.(int)($this->id).' AND (`status` = \'Open\' OR `status` = \'Closed\') GROUP BY `user_id`';
		return (int)Db::getInstance()->getValue($sql);
	}
	
	public function getMyTeam($tour_id)
	{
		$sql = 'SELECT p.id AS id, player_name, ifnull(sum(pp.runs),0) AS runs, ifnull(sum(pp.balls),0) AS balls, ifnull(sum(fours),0) AS fours,
				ifnull(sum(sixs),0) AS sixs, ifnull(sum(wickets),0) AS wickets, ifnull(sum(maiden),0) AS maiden, ifnull(sum(bd.balls),0) AS overs, ifnull(sum(wide),0) AS wide, ifnull(sum(bd.no_balls),0) AS no_balls,
				ifnull(sum(bd.runs),0) AS rungiven,ifnull(sum(pd.caught),0) AS caught,ifnull(sum(pd.stumped),0) AS stumped, ifnull(sum(pd.runout),0) AS runout, photo_url FROM `coc_tournament_player` tp
				INNER JOIN `coc_joined_tournament` jt ON jt.id = tp.join_id
				INNER JOIN `coc_tournament` t ON t.id = jt.tournament_id
				INNER JOIN `players` p ON p.id = tp.player_id
				LEFT OUTER JOIN `match_players_performance` pp ON pp.match_id = t.match_id AND pp.player_id = tp.player_id
				LEFT OUTER JOIN `match_bowler_details` bd ON bd.match_id = t.match_id AND bd.player_id = tp.player_id
				LEFT OUTER JOIN `match_players_details` pd ON pd.match_id = t.match_id AND pd.player_id = tp.player_id
				WHERE t.id = '.(int)$tour_id.' AND jt.user_id = '.(int)($this->id).' GROUP BY p.id';
		return Db::getInstance()->ExecuteS($sql);
	}		
	
	public function update($nullValues = false)
	{
	 	return parent::update(true);
	}
	
	public function checkReferral()
	{
		global $cookie;
		if(isset($cookie->referral_id))
		{
			
		}
	}
	
	public function getLeaderboard($startDate = NULL, $endDate = NULL)
	{
		$sql = 'SELECT username, sum(runs) AS cash, connect_id FROM coc_user_runs ur
				INNER JOIN coc_users u ON u.id = ur.user_id
				INNER JOIN coc_tournament t ON t.id = ur.tournament_id
				LEFT OUTER JOIN coc_users_connect uc ON uc.user_id = u.id ';
		if($startDate)
			$sql .= 'WHERE t.endtime between \''.$startDate.'\' and \''.$endDate.'\' ';
		$sql .= 'GROUP BY ur.user_id ORDER BY cash DESC LIMIT 10';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getTourLeaderboard($id)
	{
		$sql = 'SELECT username, sum(runs) AS cash, connect_id FROM coc_user_runs ur
				INNER JOIN coc_users u ON u.id = ur.user_id
				INNER JOIN coc_tournament t ON t.id = ur.tournament_id
				LEFT OUTER JOIN coc_users_connect uc ON uc.user_id = u.id ';
		$sql .= 'WHERE t.tournament_type_id = '.$id;
		$sql .= ' GROUP BY ur.user_id ORDER BY cash DESC LIMIT 10';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getMyRank()
	{
		$sql = 'SELECT `rank` FROM (SELECT `id`, `username`, `cash`, CASE
					WHEN @prev_value = cash THEN @rank_count
					WHEN @prev_value := cash THEN @rank_count := @rank_count + 1
					WHEN cash = 0 THEN @rank_count := @rank_count + 1
				END AS `rank` FROM `coc_users`, (SELECT @prev_value := NULL, @rank_count := 0) t ORDER BY `cash` DESC) test WHERE id = '.(int)($this->id);
		return Db::getInstance()->getValue($sql);
	}
	
	public function withdrawCash($amount, $address)
	{
		if(Db::getInstance()->Execute('INSERT INTO `coc_withdraw`(`user_id`, `amount`, `status`, `address`) 
					VALUES('.(int)($this->id).', '.(int)$amount.', \'pending\',\''.$address.'\')'))
			return true;
		return false;		
	}
	
	public function getWithdrawals()
	{
		$sql = 'SELECT * FROM `coc_withdraw` WHERE `user_id` = '.(int)($this->id);
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getDeposits()
	{
		$sql = 'SELECT * FROM `coc_deposit` WHERE `user_id` = '.(int)($this->id);
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function checkPaymentExist($payment_id)
	{
		$sql = "SELECT * FROM coc_deposit WHERE payment_id = '".$payment_id."'";
		$matchScore = Db::getInstance()->ExecuteS($sql);
		return Db::getInstance()->NumRows();
	}
	
	public function updateDeposit($product_id, $amount, $payment_id, $status)
	{
		$time = date('Y-m-d H:i:s');
		if(Db::getInstance()->Execute('INSERT INTO `coc_deposit`(`user_id`, `product_id`, `amount`, `payment_id`, `status`, `timestamp`) VALUES
				('.(int)($this->id).', '.(int)$product_id.', '.(int)$amount.', \''.$payment_id.'\', \''.$status.'\', \''.$time.'\')'))
			return true;
		return false;	
				
	}
	
	public function updateReferral($inviteId)
	{
		$sql = 'INSERT INTO `coc_friend_referral`(`user_id`, `referral_id`) VALUES('.(int)($this->id).', \''.$inviteId.'\')';
		Db::getInstance()->Execute($sql);
		return true;
	}
	
	public function getBonus()
	{
		$sql = 'SELECT * FROM `coc_user_bonus` WHERE `user_id` = '.(int)($this->id).' AND status = \'inprogress\'';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function addZealCoin($coin)
	{
		if(Db::getInstance()->Execute('UPDATE `coc_users` SET `coin` = `coin` + '.(int)($coin).' WHERE `id` = '.(int)($this->id)))
			return true;
	}
	
	public function getCoach($id)
	{
		$sql = 'SELECT coach_name FROM coach WHERE id = '.(int)($id);
		return Db::getInstance()->getValue($sql);
	}
	
	
}