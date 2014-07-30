<?php
class Teams extends ObjectModel
{
	public $id;
	public $teamname;
	public $flag_url;
	public $team_nickname;
	public $team_color;
	public $captain;
	public $viceCaption;
	public $keeper;
	protected 	$table = 'team_details';
	protected 	$identifier = 'id';
	
	public function __construct($id = NULL)
	{
		parent::__construct($id);
	}
	
	public function getSquardPlayers($type)
	{
		$squard = $this->getSquard($type);
		$sql = "SELECT *, p.id AS id FROM players p
				LEFT OUTER JOIN players_type pt ON pt.id = p.player_type
				WHERE p.id IN (".$squard['players_id'].")";
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getSquard($type)
	{
		$sql = "SELECT * FROM squard_team
				WHERE team_id = '".$this->id."' AND squard_type = '".$type."'";
		return Db::getInstance()->getRow($sql);
	}
	
	public function getCoach($type)
	{
		$sql = 'SELECT coach_id, coach_name FROM squard_team st
				INNER JOIN coach c ON c.id = st.coach_id
				WHERE team_id = \''.$this->id.'\' AND squard_type = \''.$type.'\'';
		return Db::getInstance()->getRow($sql);
	}
	
	public function getThirdmanPlayers()
	{
		$sql = 'SELECT * FROM match_players_details WHERE ';
	}
}