<?php
/**
 * Template Name: My Account Page Template
 *
 * Description: Course page contains chapters of that course
 */
 get_header();
 global $current_user, $avatar;
 
 
  if($_POST)
 {
 	$errorMsg = '';
 	if(isset($_POST['action']) && strlen($_POST['action']) > 0 && strtoupper($_POST['action']) == 'USERINFOUPDATE')
	{
		 if( !preg_match('/^[0-9]*$/', $_POST['phone']))
			$errorMsg = 'Invalid mobile number!';
		else if(preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $_POST['firstname']))
			$errorMsg = 'Special characters are not allowed in firstname!';
		else if(preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $_POST['lastname']))
			$errorMsg = 'Special characters are not allowed in lastname!';
		else if(preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $_POST['address1']))
			$errorMsg = 'Special characters are not allowed in address1!';
		else if(preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $_POST['address2']))
			$errorMsg = 'Special characters are not allowed in address1!';
		else if(!preg_match('/^[0-9]*$/', $_POST['postal']))
			$errorMsg = 'Invalid Postal code  number!';
		else if(preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $_POST['country']))
			$errorMsg = 'Invalid Country name!';
		else if(preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $_POST['state']))
			$errorMsg = 'Invalid State name!';
		else if(preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $_POST['city']))
			$errorMsg = 'Invalid City name!';
			
		if(strlen($errorMsg) == 0)
		{
			$address = $_POST['address1'].','.$_POST['address2'].','.$_POST['country'].','.$_POST['state'].','.$_POST['city'].','.$_POST['postal'];
			$display = $_POST['firstname'].' '.$_POST['lastname'];
			
			$sql = 'UPDATE wp_users SET display_name = \''.$display.'\', mobile = \''.addslashes($_POST['phone']).'\', address = \''.addslashes($address).'\' 
					WHERE ID = '.$_POST['userId'];
			mysql_query($sql);
		}
		
	}
 	else if(isset($_POST['action']) && strlen($_POST['action']) > 0 && strtoupper($_POST['action']) == 'USERPASSWORD')
	{			
		require_once( ABSPATH . 'wp-includes/class-phpass.php');
		$wp_hasher = new PasswordHash(8, TRUE);
		
		$password_hashed =$current_user->user_pass;
		$plain_password = addslashes($_POST['oldpassword']);
		
		if($wp_hasher->CheckPassword($plain_password, $password_hashed)) 
		{
			
			wp_set_password(addslashes($_POST['newpassword']), $_POST['userId']);
			echo '<script>window.location.href=\''.get_bloginfo('url').'\';</script>';
		
		} 
		else 
			$errorMsg = 'Old Password is Wrong !';
		
	}
 }
 ?>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/my-accounts.js"></script>
 <div class="myAccountsideList">
 	<div class="avaterClassImages">
		<div class="avaterImage">
			<?php
			$avatar = get_user_meta($current_user->ID, 'avatar', true);
			$facebook_id = get_user_meta($current_user->ID, 'facebook_id', true);
			if(strlen($avatar) > 0)
				echo '<img src="'.get_bloginfo('url').'/avatars/'.$avatar.'" alt=""/>';
			else if(strlen($facebook_id) > 0)
				echo '<img src="https://graph.facebook.com/'.$facebook_id.'/picture" alt=""/>';
			else
				echo '<img src="'.get_bloginfo('template_url').'/images/avatar.jpg" alt=""/>';
			?>
		</div>
		<div class="avaterClassName"><?php echo $current_user->user_login; ?></div>
		<div class="avaterClassemail" ><?php echo $current_user->user_email; ?></div>
	</div>
	<div class="myAccountTiles">My Account</div>
	<div class="myAccountList" id="personal-info" onclick="personalInfo();">Personal Info</div>
	<!--<div class="myAccountList" id="my-friends" onclick="myFriends(<?php echo $current_user->ID; ?>);">My Friends</div>-->
	<div class="myAccountList" id="my-cerificates" onclick="myCerificates(1,<?php echo $current_user->ID; ?>);">My Certificates</div>
	<div class="myAccountList" id="course-history" onclick="courseHistroy();">Course History</div>
	<!--<div class="myAccountList">Activities</div>-->
	<!--<div class="myAccountList">Test</div>-->
	<div class="myAccountList" id="notes" onclick="note(1);">Notes</div>
	<!--<div class="myAccountList">Discussion</div>-->
 </div>
 
 <div class="rightContentClass">
 
	<div id="errorContentId">
		<?php
		
		if(isset($errorMsg) && strlen($errorMsg) > 0)
			echo '
			<div class="errorborder" style="display:block">
				<h4 id="errorId" style=" padding:10px 10px 0 10px; text-align:center;color:#f00; margin-top:0;">'.$errorMsg.'</h4>
			</div>';
		?>
	</div>
	<div class="loadingCourseHistory" style="width:100%;"></div>
	<div id="mainContentMyAccount">
		<div class="englishstrokeTitle">My English Strokes</div>
		<div class="englishstrokeList">
			<div class="englishstrokeListHeader">
				<div class="headerList" style="width:185px;">My Courses</div>
				<div class="headerList" style="width:121px">Subscription</div>
				<div class="headerList" style="width:141px">Start Date</div>
				<div class="headerList" style="width:141px">End Date</div>
				<div class="headerList" style="width:160px;">Courses Completed</div>
			</div>
			<?php
			$userId  = $current_user->ID; 
			$courses = new Course();
			$coursesDetailses =$courses->getAllCourses();
			$payment = new Payment();
			$chapter = new Chapter();
			$count=1;
			foreach($coursesDetailses as $coursesDetails )
			{
				 if($payment->checkUserStatus($userId,$coursesDetails['id']))
				{ 
					$dates = $payment->getUserPaymentDate($userId,$coursesDetails['id']);
					$count = $chapter->getChapterLessonsCount($coursesDetails['id']);
					$userLessionCount=$chapter->getUserLessionCount($coursesDetails['id'],$userId);
					$wide =($userLessionCount/$count)*100;
				
				?>	
				<div class="containnorClass">
					<div class="couresDetails" style="width:170px; text-align:left; padding:0 0 0 15px;font-size:13px;"><?php echo $coursesDetails['name']; ?></div>
					<div class="couresDetails" style="width:121px;"><div class="payThick"></div></label></div>
					<div class="couresDetails" style="width:141px; font-size:12px;"><?php echo date('Y-m-d',strtotime($dates['timestamp'])); ?></div>
					<div class="couresDetails" style="width:141px;font-size:12px;"><?php echo date('Y-m-d',strtotime($dates['expiry'])); ?></div>
					<div class="couresDetails" style="width:160px;"><div class="barclassLoding"><div class="loadingImg" style="width:<?php echo $wide.'%'; ?>"></div></div></div>
				</div>
				<?php
				}
				else
				{
				?>
				<div class="containnorClass">
					<div class="couresDetails" style="width:185px;"><?php echo $coursesDetails['name']; ?></div>
					<div class="couresDetails" style="width:121px;"><div class="notThick"></div></label></div>
					<div class="couresDetails" style="width:141px;">-</div>
					<div class="couresDetails" style="width:141px;">-</div>
					<div class="couresDetails" style="width:160px;"><div class="barclassLoding"></div></div>
				</div>	
				
				<?php
				}
				
			}
			?>
		</div>
		<div class="couresClass">
			<div class="headerText">Course Details</div>
		</div>
		<?php
			$lession = new Lesson();
			$totalLession = $lession->getTotalLession();
			$finishLession = $lession->getFinishedLesson($userId);
			
		?>
		<div  class="couresClass" style="height:100px; background-color:#F7F7F7;margin:25px 0 0 20px;">
			<div class="myaccuntImagesClass"></div>
			<div class="lessionContentClass">
				<div class="lineclassHeader">Lessons Completed</div>
				<div class="lineclassHeader" style="color:#000000; font-size:22px; margin:20px 0 0 0;"><?php echo $finishLession['count'].'/'.$totalLession; ?></div>
			</div>
			<?php
				$chapter = new Chapter();
				$id_chapter='NULL';
				$countChapter = $chapter->getChapterLessonsCount($id_chapter);
				$userChapter =	$chapter->getUserChapterCount($userId);									
				$notCompletedChapters =	$countChapter-$userChapter;
			?>
			<div class="lessionContentClass">
				<div class="lineclassHeader">Chapter Completed</div>
				<div class="lineclassHeader" style="color:#000000; font-size:22px; margin:20px 0 0 0;"><?php echo $notCompletedChapters.'/'.$countChapter; ?></div>
			</div>
			<div class="borders"></div>
		</div>
	
		<?php
			$activity = new Activity();
			$countActivity = $activity->getActivitiesCount();
			$userCountActivity = $activity->getUserActivitiesCount($userId);
			//$userChapter =  $countActivity -$userCountActivity;
		?>
		
		<div  class="couresClass" style="height:100px; background-color:#F7F7F7;margin:25px 0 0 20px;">
			<div class="myaccuntImagesClass2"></div>
			<div class="lessionContentClass">
				<div class="lineclassHeader">Activities Completed</div>
				<div class="lineclassHeader" style="color:#000000; font-size:22px; margin:20px 0 0 0;"><?php echo $userCountActivity.'/'.$countActivity; ?></div>
			</div>
			<div class="borders"></div>
		</div>
		
		<!--<div  class="couresClass" style="height:100px; background-color:#F7F7F7;margin:25px 0 0 20px;">
			<div class="myaccuntImagesClass3"></div>
			<div class="lessionContentClass">
				<div class="lineclassHeader">Tests token </div>
				<div class="lineclassHeader" style="color:#000000; font-size:22px; margin:20px 0 0 0;">0/0</div>
			</div>
			<div class="lessionContentClass">
				<div class="lineclassHeader">Tests Passed</div>
				<div class="lineclassHeader" style="color:#000000; font-size:22px; margin:20px 0 0 0;">0/0</div>
			</div>
			<div class="lessionContentClass">
				<div class="lineclassHeader">Tests Failed</div>
				<div class="lineclassHeader" style="color:#000000; font-size:22px; margin:20px 0 0 0;">0/0</div>
			</div>
			<div class="borders"></div>
		</div>-->
	</div>
</div>
 
 
<?php
if($_POST)
{
	echo '<script>
		personalInfo();
	</script>';
}
get_footer();
?>