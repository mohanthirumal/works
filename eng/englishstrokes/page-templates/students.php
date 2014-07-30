<?php
/**
 * Template Name: Students Page Template
 *
 * Description: Course page contains chapters of that course
 */
//get_header();

function sanitize_output($buffer)
{
	$search = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s');
	$replace = array('>','<','\\1');
	$buffer = preg_replace($search, $replace, $buffer);
	return $buffer;
}
//ob_start("sanitize_output");
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
global $current_user, $invalidFbLogin, $avatar;
get_currentuserinfo();
$invalidFbLogin = false;
if(is_numeric($current_user->user_login))
	$invalidFbLogin = true;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('url'); ?>/favicon.ico"/>
<?php wp_head(); ?>
<link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo get_template_directory_uri(); ?>/css/course.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo get_template_directory_uri(); ?>/css/sizing.css" rel="stylesheet" type="text/css" media="all" />
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300italic,400italic,600' rel='stylesheet' type='text/css' />
<link rel='stylesheet' id='Oswald-css'  href='http://fonts.googleapis.com/css?family=Oswald%3A400%2C700&#038;ver=3.5.2' type='text/css' media='all' />
<!--<link href='http://fonts.googleapis.com/css?family=Josefin+Slab:700' rel='stylesheet' type='text/css'>-->
<link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/slider.css" />
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/script-1.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/swfobject.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/course.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jwplayer/jwplayer.js"></script>
<script type="text/javascript">jwplayer.key="gKHyBuWb/9rWoQ5nzmFQ2pXpun3Guzd88iZrPWuCOsg=";</script>
<script>
var domainUrl = '<?php echo DOMAIN_URL;?>';
</script>
</head>
<body>
	<div class="course-page">
		<div class="course-left">
			<div class="course-left-content">
				<div class="course-left-list">
					<div class="course-left-head">
						<div class="course-left-tab-list-bg active">
							<div class="course-left-tab-list"></div>
						</div>
						<div class="course-left-tab-list-bg">
							<div class="course-left-tab-chat"></div>
						</div>
						<div class="course-left-tab-list-bg" style="margin:0;">
							<div class="course-left-tab-notes"></div>
						</div>
					</div>
					<div class="course-left-body">
					<?php
					global $current_user;
					$premiumUser = false;
					if(isset($_REQUEST['id_course']))
						$id_course = (int)$_REQUEST['id_course'];
					$course = new Course($id_course);
					$payment = new Payment();
					if($payment->checkUserStatus($current_user->ID, $id_course))
						$premiumUser = true;
					$chapters = $course->getCourseChapters($id_course);
					$loggedIn = is_user_logged_in();
					$count = 0;
					$lesson1 = new Lesson();
					$finishedLesson = $lesson1->getFinishedActivity($current_user->ID);
					foreach($chapters as $chapter)
					{
						$chaptersClass = new Chapter($chapter['id']);
						$lessons = $chaptersClass->getChapterLessons($chapter['id']);
						echo '<div class="course-unit">'.$chapter['name'].'</div>';
						foreach($lessons as $lesson)
						{
							$finishedCount = 0;
							$videoCount = 0;
							$activityCount = 0;
							$lesson = new Lesson($lesson['id']);
							echo '<div class="course-lesson" id="lesson'.$lesson->id.'link"><a class="course-lesson-link" href="#" rel="'.$count.'" lessonid="'.$lesson->id.'">'.$lesson->name.'</a>';
							if($chapter['paid'] == '0' || $premiumUser)
								echo '<div class="course-start-lecture">Play</div>';
							echo '<div class="course-activities">';
							//$count++;
							foreach($lesson->videos as $video)
							{
								echo '<div class="course-lesson1" id="video'.$video.'link"><a href="#" rel="'.$count.'" lessonid="'.$lesson->id.'" videoid="'.$video.'">Video</a></div>';
								$count++;
								$videoCount++;
							}
							foreach($lesson->activity as $activity)
							{
								if(isset($finishedLesson) && in_array($activity, $finishedLesson))
									$finishedCount++;
								echo '<div class="course-lesson1" id="activity'.$activity.'link"><a href="#" rel="'.$count.'" lessonid="'.$lesson->id.'" activityid="'.$activity.'">Activity'.($activityCount + 1).'</a></div>';
								$count++;
								$activityCount++;
							}
							echo '</div>';
							$completedPercent = 0;
							if($activityCount > 0)
								$completedPercent = (($finishedCount/$activityCount)*100);
							echo '<div class="course-progress-bar"><div class="course-progress-bar-status" style="width:'.$completedPercent.'%"></div></div>';
							if($chapter['paid'] != '0' && !$premiumUser)
								echo '<div class="course-locker"><div class="course-locker-icon"></div></div>';
							echo '</div>';
						}
					}
					?>
					</div>
				</div>
			</div>
			<div class="course-left-closer" onclick="closeLeftContainer()"></div>
		</div>
		<div class="course-right">
			<div class="course-right-list">
				<?php
				$count = 0;
				foreach($chapters as $chapter)
				{
					$lessonCount = 1;
					$lesson = new Chapter($chapter['id']);
					$lessons = $lesson->getChapterLessons($chapter['id']);
					foreach($lessons as $lesson)
					{
						$lesson = new Lesson($lesson['id']);
						foreach($lesson->videos as $video)
						{
							?>
							<div class="course-right-indi lesson<?php echo $lesson->id; ?> <?php echo $count; ?>">
								<div class="course-unit-display">
									<div class="course-unit-name"><?php echo $chapter['name'];?></div>
									<div class="course-unit-lesson-name">Lesson<span><?php echo $lessonCount;?></span></div>
								</div>
								<div class="course-lesson-name"><?php echo $lesson->name;?></div>
								<div class="course-video-cont" id="video<?php echo $lesson->id.$video; ?>"></div>
								<div class="course-prev-lesson">Previous</div>
								<div class="course-prev-line"></div>
								<div class="course-left-back-to-btn">Back to course</div>
								<div class="course-next-line"></div>
								<div class="course-next-lesson">Next</div>
							</div>						
							<?php
							$count++;
						}
						foreach($lesson->activity as $activity)
						{
							?>
							<div class="course-right-indi lesson<?php echo $lesson->id; ?> <?php echo $count; ?>">
								<div class="course-unit-display">
									<div class="course-unit-name"><?php echo $chapter['name'];?></div>
									<div class="course-unit-lesson-name">Lesson<span><?php echo $lessonCount;?></span></div>
								</div>
								<div class="course-lesson-name"><?php echo $lesson->name;?></div>
								<div class="course-video-cont" id="activity<?php echo $lesson->id.$activity; ?>"></div>
								<div class="course-prev-lesson">Previous</div>
								<div class="course-prev-line"></div>
								<div class="course-left-back-to-btn">Back to course</div>
								<div class="course-next-line"></div>
								<div class="course-next-lesson">Next</div>
							</div>						
							<?php
							$count++;
						}
						echo '
						<div class="course-right-indi">
							<span class="percent completion-ratio">46%</span>
							<div class="note">
								<span>You have completed <b class="completion-ratio">46%</b> of this course</span>
							</div>
						</div>
						';
						$lessonCount++;
					}
				}
				?>
				
			</div>
		</div>
	</div>