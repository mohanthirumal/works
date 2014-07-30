<?php
class Withdraw extends ObjectModel
{
	public 		$id;
	public 		$user_id;
	public 		$amount;
	public 		$status;
	public 		$address;
	public 		$pan_no;
	public 		$type;
	public 		$timestamp;
	protected 	$table = 'coc_withdraw';
	protected 	$identifier = 'id';
	
	public function __construct($id = NULL)
	{
		parent::__construct($id);
	}
	
	public function getFields()
	{
		if (isset($this->id))
			$fields['id'] = (int)($this->id);
		$fields['user_id'] = pSQL($this->user_id);
		$fields['amount'] = pSQL($this->amount);
		$fields['status'] = pSQL($this->status);
		$fields['address'] = pSQL($this->address);
		$fields['pan_no'] = pSQL($this->pan_no);
		$fields['timestamp'] = pSQL($this->timestamp);
		$fields['type'] = pSQL($this->type);
		return $fields;
	}
	
	public function add($autodate = true, $nullValues = true)
	{
	 	if (!parent::add($autodate, $nullValues))
			return false;
		return true;
	}
	
	public function onlineWithdraw($accname, $accno, $bank, $ifsc, $mob)
	{
		$id = $this->id;
		$sql = 'INSERT INTO coc_online_withdraw(withdraw_id, acc_no, acc_name, bank_name, ifsc_code, mobile) VALUES('.$this->id.', \''.$accno.'\', \''.$accname.'\', \''.$bank.'\', \''.$ifsc.'\', '.$mob.')';
		return Db::getInstance()->Execute($sql);
	}
}