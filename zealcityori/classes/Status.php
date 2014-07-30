<?php
class Status extends ObjectModel
{
	public $id;
	public $name;
	protected 	$table = 'coc_status';
	protected 	$identifier = 'id';
	
	public function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}