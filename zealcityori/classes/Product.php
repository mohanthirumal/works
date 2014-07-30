<?php
class Product extends ObjectModel
{
	public 		$id;
	public 		$cash;
	public 		$free_cash;
	protected 	$table = 'coc_products';
	protected 	$identifier = 'id';
	
	public function __construct($id = NULL)
	{
		if($id)
			parent::__construct($id);
	}
	
	public function getProducts()
	{
		$sql = 'SELECT * FROM coc_products WHERE status = \'active\'';
		return Db::getInstance()->ExecuteS($sql);
	}
}