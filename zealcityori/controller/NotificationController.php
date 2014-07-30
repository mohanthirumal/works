<?php
class NotificationController extends FrontController
{
	protected $title = 'Notification';
	protected $tournament;
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		global $cookie;
		parent::preProcess();
	}
	
	public function process()
	{
		global $cookie;
		$user = new User($cookie->user_id);
		$tournament = new Tournament();
		$notifications = $user->getNotifications();
		//$buddynotify = $user->getBudnotify();
		self::$smarty->assign('notifications', $notifications);
		//self::$smarty->assign('buddynotify', $buddynotify);
	}
	
	public function setMedia()
	{
		parent::setMedia();
		Tools::addCSS('css/notification.css', 'all');
		Tools::addJS(array(__BASE_URI__.'js/notification.js'));
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('notification.tpl');
	}
}
