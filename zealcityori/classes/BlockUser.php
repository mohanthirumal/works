<?php
class BlockUser extends ObjectModel
{
	public $id;
	public $ip;
	protected 	$table = 'coc_block_users';
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
		$fields['ip'] = pSQL($this->ip);
		return $fields;
	}
	
	public function checkBlockedUsers()
	{
		$ip = Tools::getRemoteAddr();
		$sql = 'SELECT count(*) AS block FROM `coc_block_users` WHERE `ip` = \''.$ip.'\'';
		$results = Db::getInstance()->getValue($sql);
		if($results > 0)
			return true;
		return false;
	}
	
	public function add($autodate = true, $nullValues = true)
	{
		$this->secure_key = md5(uniqid(rand(), true));
	 	if (!parent::add($autodate, $nullValues))
			return false;
		return true;
	}
	
	public function update($nullValues = false)
	{
	 	return parent::update(true);
	}
}