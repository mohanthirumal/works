<?php
require('include/config.php');
if(isset($_SERVER['HTTP_REFERER']))
{
	$parse_url = parse_url($_SERVER['HTTP_REFERER']);
	if($parse_url['host'] != $_SERVER['HTTP_HOST'])
		die('error');
}
else
	die('error');
if(isset($_GET['action']) && $_GET['action'] == 'headerscore')
{
	global $smarty;
	$smarty = new Smarty();
	echo Module::execHook('blocklivescore','headerHook');
	exit;
}
else if(isset($_GET['action']) && $_GET['action'] == 'sidebarscore')
{
	global $smarty;
	$smarty = new Smarty();
	echo Module::execHook('blocklivescore','sidebarHook');
	exit;
}
else if(isset($_GET['action']) && $_GET['action'] == 'fblogin')
{
	$user = new User();
	$id = Tools::getValue('id');
	if($user->getUserFromConnect($id, 'facebook'))
		die('1');
	die('0');
}
else if(isset($_GET['action']) && $_GET['action'] == 'emailexist')
{
	$user = new User();
	$email = Tools::getValue('email');
	if($user->checkEmailExist($email) > 0)
		die('1');
	die('0');
}
else if(isset($_GET['action']) && $_GET['action'] == 'usernameexist')
{
	$user = new User();
	$email = Tools::getValue('username');
	if($user->checkUsernameExist($email) > 0)
		die('1');
	die('0');
}
else if(isset($_GET['action']) && $_GET['action'] == 'verifycaptch')
{
	$captcha = $_SESSION['6_letters_code'];
	$value = Tools::getValue('value');
	if($captcha == $value)
		die('0');
	die('1');
}
else if(isset($_GET['action']) && $_GET['action'] == 'fbinvite')
{
	$inviteId = Tools::getValue('inviteId');
	$userid = Tools::getValue('userId');
	$sql = 'INSERT INTO `coc_friend_referral`(`user_id`, `referral_id`) VALUES('.(int)($userid).', \''.$inviteId.'\')';
	Db::getInstance()->Execute($sql);
	die('0');
}
else if(isset($_GET['action']) && $_GET['action'] == 'indexresearch')
{
	global $smarty;
	$smarty = new Smarty();
	echo Module::execHook('wordpress','homeResearch');
	exit;
}
else if(isset($_GET['action']) && $_GET['action'] == 'indexlatestwinner')
{
	global $smarty;
	$smarty = new Smarty();
	echo Module::execHook('latestwinner','indexHook');
	exit;
}
else if(isset($_GET['action']) && $_GET['action'] == 'indexblocklivescore')
{
	global $smarty;
	$smarty = new Smarty();
	ob_start("sanitize_output");
	echo Module::execHook('blocklivescore','sidebarHook');
	exit;
}
function canceltournament_Ajax()
{
	$id = (int)Tools::getValue('id');
	$type = (int)Tools::getValue('type');
	$uid = (int)Tools::getValue('uid');
	$key = Tools::getValue('key');
	if($type == 3)
		$tournament = new Tournament($id);
	else
		$tournament = new PTournament($id);
	if($tournament->status == 'Destroyed')
		exit;
	$user = new User($uid);
	if($user->secure_key = $key)
		$tournament->userDestroy($uid);
	exit;
}
function emailinvite_Ajax()
{
	$input_data = Tools::getValue('input_data');
	$id = (int)Tools::getValue('tourId');
	$userid = (int)Tools::getValue('userId');
	parse_str($input_data, $totalForm);
	$type = (int)Tools::getValue('type');
	$key = Tools::getValue('key');
	if($type == 3)
		$tournament = new Tournament($id);
	else
		$tournament = new PTournament($id);
	$user = new User($userid);
	if($user->secure_key = $key)
		echo $tournament->addEmailInvite($userid, $totalForm);
	echo '0';
	exit;
}

function getweekmatch_Ajax()
{
	$id = (int)Tools::getValue('id');
	$match = new Matches();
	$dates = Tools::getWeeksDate($id);
	$date = explode('-', $dates);
	$match = Matches::getMatchFromDate($date[0], $date[1]);
	echo json_encode($match);
	exit;
}

function getUserPrize_Ajax()
{
	$id = (int)Tools::getValue('id');
	$prizes = new PrizePool($id, NULL, NULL, NULL, true);
	echo json_encode($prizes);
}
function getUserPrizeList_Ajax()
{
	$playerId = (int)Tools::getValue('id');
	$fee = (int)Tools::getValue('fee');
	$players = new Players($playerId);
	$prizes = new PrizePool($players->prize_id, $players->id, $fee, 20, true);
	echo json_encode($prizes);
}
function fbsync_Ajax()
{
	$user_id = (int)($_REQUEST['userid']);
	$faceboob_id = $_REQUEST['id'];
	$user = new User($user_id);
	if($user->updateConnect($faceboob_id, 'facebook'))
		die('1');
	die('0');
}
function fbfriends_Ajax()
{
	$me = FrontController::facebookConnect();
	$friends = json_encode($me['friends']['data']);
	die($friends);
}
function addTourPlayer_Ajax()
{
	$invites = Tools::getValue('friends');
	$id = (int)Tools::getValue('id');
	$type = (int)Tools::getValue('type');
	if($type == 3)
		$tournament = new Tournament($id);
	else
		$tournament = new PTournament($id);
	$tournament->updateInvites($invites);
	//$tournament->updateInviteNotifications($invites, $user->id, $description, $tournament->endtime);
}
function sanitize_output($buffer)
{
	$search = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s');
	$replace = array('>','<','\\1');
	$buffer = preg_replace($search, $replace, $buffer);
	return $buffer;
}

if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['action']))
	$ajaxfunc = $_POST['action'];
else
	die('error');
call_user_func($ajaxfunc.'_Ajax');
exit;