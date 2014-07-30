<?php
class ReferafriendController extends FrontController
{
	protected $title = 'Refer a friend program';
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		parent::preProcess();
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('refer-a-friend-program.tpl');
	}
}
