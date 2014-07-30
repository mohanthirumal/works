<?php
class Kitty extends ObjectModel
{
	public $id;
	public $percentage;
	protected 	$table = 'coc_kitty';
	protected 	$identifier = 'id';
	
	public function __construct($id = NULL)
	{
		parent::__construct($id);
	}
	
}