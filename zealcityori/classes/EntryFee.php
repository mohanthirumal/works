<?php
class EntryFee extends ObjectModel
{
	public $id;
	public $amount;
	public $winner_coin;
	public $participent_coin;
	protected 	$table = 'coc_entry_fee';
	protected 	$identifier = 'id';
	
	public function __construct($id = NULL)
	{
		parent::__construct($id);
	}
	public function getEntryFee()
	{
		$sql = 'SELECT * FROM coc_entry_fee WHERE `user_type` = 1 ORDER BY amount ASC';	
		return Db::getInstance()->ExecuteS($sql);
	}
}