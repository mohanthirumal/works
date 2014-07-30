<?php
class Players extends ObjectModel
{
	public $id;
	public $player;
	public $user_type;
	public $display_name;
	public $prize_id;
	protected 	$table = 'coc_players';
	protected 	$identifier = 'id';
	
	public function __construct($id = NULL)
	{
		parent::__construct($id);
	}
	
	public function getPlayers()
	{
		$sql = 'SELECT * FROM coc_players WHERE `user_type` = 1 ORDER BY player ASC';
		return Db::getInstance()->ExecuteS($sql);
	}
}