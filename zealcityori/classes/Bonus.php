<?php
class Bonus extends ObjectModel
{
	public 		$id;
	public 		$user_id;
	public 		$bonus;
	public 		$current_bonus;
	public 		$status;
	public 		$expiry;
	protected 	$table = 'coc_user_bonus';
	protected 	$identifier = 'id';
	
	public function __construct($id = NULL)
	{
		if($id)
			parent::__construct($id);
	}
	
	public function updateStatus($status)
	{
		$sql = 'UPDATE `coc_user_bonus` SET `status` = \''.$status.'\' WHERE id = '.(int)$this->id;
		return Db::getInstance()->Execute($sql);
	}
	
	public function collectBonus()
	{
		global $cookie;
		$user = new User($cookie->user_id);
		$user->addCash($this->bonus);
		$this->updateStatus('collected');
	}
	
	public function updateBonus($bonus)
	{
		$id = $this->getCurrentBonus();
		if($id)
		{
			$currentBonus = new Bonus($id);
			if($currentBonus->bonus < ($currentBonus->current_bonus + $bonus))
			{
				$tempBonus = $currentBonus->bonus - $currentBonus->current_bonus;
				$this->updateBonus($tempBonus);
				$tempBonus2 = $bonus - $tempBonus;
				$this->updateBonus($tempBonus2);
			}
			else
			{
				$sql = 'UPDATE `'.$this->table.'` SET current_bonus = current_bonus + '.$bonus.' WHERE id = '.(int)$id;
				return Db::getInstance()->Execute($sql);
			}
		}
	}
	
	public function checkBonusExceed($bonus)
	{
		
	}
	
	private function getCurrentBonus()
	{
		global $cookie;
		$user_id = $cookie->user_id;
		$now = date('Y-m-d H:i:s');
		$sql = 'SELECT id FROM `'.$this->table.'` WHERE user_id = '.$user_id.' AND status = \'inprogress\' AND expiry > \''.$now.'\' AND bonus <> current_bonus ORDER BY id';
		return Db::getInstance()->getValue($sql);
	}
}