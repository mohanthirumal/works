<?php
class Tour extends ObjectModel
{
	public 		$id;
	public 		$tournament_name;
	public 		$type;
	public 		$country;
	public 		$start_date;
	public 		$end_date;
	public 		$total_match;
	protected 	$table = 'tournament_details';
	protected 	$identifier = 'id';
	
	public function __construct($id = NULL)
	{
		parent::__construct($id);		
	}
	
	public function getPointsTable()
	{
		$sql = 'SELECT * FROM `team_points` ORDER BY `orders`';
		return Db::getInstance()->ExecuteS($sql);
	}
}