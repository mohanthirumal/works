<?php
class TournamentType extends ObjectModel
{
	public $id;
	public $name;
	public $nickname;
	protected 	$table = 'coc_tournament_type';
	protected 	$identifier = 'id';
	
	public function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}