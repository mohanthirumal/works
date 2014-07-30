<?php
class Venue extends ObjectModel
{
	public 		$id;
	public 		$venue;
	public 		$city;
	public 		$history;
	protected 	$table = 'venue_details';
	protected 	$identifier = 'id';
	
	public function __construct($id = NULL)
	{
		parent::__construct($id);		
	}	
}