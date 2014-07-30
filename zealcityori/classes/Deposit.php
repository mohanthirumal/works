<?php
class Deposit extends ObjectModel
{
	public 		$id;
	public 		$user_id;
	public 		$product_id;
	public 		$amount;
	public 		$payment_id;
	public 		$status;
	public 		$timestamp;
	protected 	$table = 'coc_deposit';
	protected 	$identifier = 'id';
	
	public function __construct($id = NULL)
	{
		parent::__construct($id);
	}
	
	public function getFields()
	{
		$time = date('Y-m-d H:i:s');
		if (isset($this->id))
			$fields['id'] = (int)($this->id);
		$fields['user_id'] = pSQL($this->user_id);
		$fields['product_id'] = pSQL($this->product_id);
		$fields['amount'] = pSQL($this->amount);
		$fields['payment_id'] = pSQL($this->payment_id);
		$fields['status'] = pSQL($this->status);
		$fields['timestamp'] = $time;
		return $fields;
	}
	
	public function add($autodate = true, $nullValues = true)
	{
	 	if (!parent::add($autodate, $nullValues))
			return false;
		return true;
	}
}