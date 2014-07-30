<?php
class Coach extends ObjectModel
{
	public $id;
	public $coach_name;
	protected 	$table = 'coach';
	protected 	$identifier = 'id';
	
	public function __construct($id = NULL)
	{
		if($id)
			parent::__construct($id);
	}
}