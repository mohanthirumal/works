<?php
class FulllivescoreController extends FrontController
{
	
	protected $title = 'Fulllivescore';
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function displayContent()
	{
		global $smarty;
		parent::displayContent();
		$id=Tools::getValue('id');
		$smarty->assign('id', $id);
		$smarty->display('fulllivescore.tpl');
	}
	
}