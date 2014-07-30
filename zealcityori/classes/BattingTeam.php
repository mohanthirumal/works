<?php
class BattingTeam extends ObjectModel
{
	public $id;
	public $match_id;
	public $batting;
	public $inn_id;
	protected 	$table = 'battingteam';
	protected 	$identifier = 'match_id';
	
	public function __construct($id = NULL)
	{
		parent::__construct($id);
	}
	
	
}