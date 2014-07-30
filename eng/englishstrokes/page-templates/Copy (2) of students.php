<?php
/**
 * Template Name: Students Page Template
 *
 * Description: Course page contains chapters of that course
 */
get_header();
global $current_user;
if(isset($_REQUEST['id_course']))
	$id_course = (int)$_REQUEST['id_course'];
if(isset($_REQUEST['id_chapter']))
	$id_chapter = (int)$_REQUEST['id_chapter'];
if(isset($_REQUEST['id_lesson']))
	$id_lesson = (int)$_REQUEST['id_lesson'];
$loggedIn = is_user_logged_in();
?>
<img src="<?php bloginfo('template_url');?>/images/student-banner.jpg" alt="" class="teachers-banner"/>

<div class="left-container" style="width:310px;">	
	<div class="sidebar-container" style="min-height:860px;">
	<?php
	$course = new Course($id_course);
	$courses = $course->getAllCourses();
	foreach($courses as $cours):
	$chapters = $course->getCourseChapters($cours['id']);
	$payment = new Payment();
	$lesson1 = new Lesson();
	if($loggedIn)
		$finishedLesson = $lesson1->getFinishedLesson($current_user->ID);
	elseif(isset($_COOKIE['score']))
	{
		$score = json_decode(urldecode($_COOKIE['score']));
		$finishedLesson = $score->lesson;
	}
	?>	
		<div class="sidebar1-title trebuchet<?php echo (($cours['id'] == $id_course)?' colr':''); ?>">
			<a style="color:<?php echo $cours['color'];?>" href="?id_course=<?php echo $cours['id']?>"><?php echo $cours['name'];?>
			<div class="siderbar-level-arrow" style=" background:url(<?php bloginfo('template_url');?>/images/<?php echo (($cours['id'] == $id_course)?$cours['arrow_down']:$cours['arrow_up']); ?>) no-repeat; background-position:center;"></div>
            </a>
		</div>
		<div class="sidebar-body"<?php echo ((($cours['id'] == $id_course) || (!isset($id_course)))?' style="display:block"':''); ?>>
			<div class="sidebar-content">
				<div class="sidebar-inner">					
					<?php
					$count = 1;
					$getNextLes = 1;
					$premiumUser = false;
					if($payment->checkUserStatus($current_user->ID, $id_course))
						$premiumUser = true;
                    foreach($chapters as $chapter)
                    {
						if(!isset($id_course) && $chapter['paid'] == '1')
							continue;
                        $lesson = new Chapter($chapter['id']);
                        $lessons = $lesson->getChapterLessons($chapter['id']);
						if($chapter['paid'] == '0' || $premiumUser)
	                        echo '<div class="sidebar-inner-title">'.$chapter['name'].'<div><div class="plus"></div></div></div>';
						else
						{
							echo '<a href="'.get_bloginfo('home').'/payment" class="cancel-underline"><div class="sidebar-inner-title disabled">'.$chapter['name'].'<div class="lock-unit"></div></div></a>';
							continue;
						}
	                    echo '<ul'.(($chapter['id'] == $id_chapter)?' style="display:block"':'').'>';
                        foreach($lessons as $lesson)
						{
							echo '
							<li'.(($id_lesson == $lesson['id'])?' class="current"':'').'>
								<a href="?id_course='.$lesson['course_id'].'&id_chapter='.$lesson['chapter_id'].'&id_lesson='.$lesson['id'].'">'.$lesson['name'].'</a>';
							if(isset($finishedLesson) && in_array($lesson['id'], $finishedLesson))
							{
								echo '<div class="finished-lesson"></div>';
								$getNextLes = 1;
							}
							else if($getNextLes == 1)
								$getNextLes = 0;
							//else if(isset($finishedLesson))
								//echo '<div class="lesson-disabler"></div><img src="'.get_bloginfo('template_url').'/images/lock.png" alt="" class="lock-img"/>';
							
							echo '
							</li>';
						}
                        echo '</ul>';
						//echo '<div class="divider"></div>';
						$count++;
                    }
                    ?>
				</div>
			</div>
		</div>	
	<?php endforeach;?>
	</div>
</div>
<div class="right-container">	
	<?php
	if(isset($id_lesson) && isset($id_course) && isset($id_chapter))
	{
		$lesson = new Lesson($id_lesson);
		$chapter = new Chapter($lesson->chapter_id);
		if ( is_user_logged_in() )
			$finished = $lesson->getFinishedActivity($current_user->ID);
		elseif(isset($_COOKIE['score']))
		{
			$score = json_decode(urldecode($_COOKIE['score']));
			$finished = $score->activity;
		}
		if($chapter->paid == '0' || $payment->checkUserStatus($current_user->ID, $course->id)):
		$getNextAct = 0;
		//if(true):
		?>	
			<div class="tab-container" style="border-color:<?php echo $course->color;?>">
				<!--<div class="course-title-text trebuchet"><?php echo $chapter->name;?></div>-->
				<div style="float:right;">
					<?php if(strlen($lesson->text) > 0):?>
					<div class="btn-tab btn-tab-large active" onclick="eng.students.showContent('text', this, 1)"><?php echo $lesson->name;?></div>
					<?php endif;?>	
					<?php for($i = 1; $i <= count($lesson->videos); $i++):?>
					<?php if($i == 1 && strlen($lesson->text) == 0):?>
						<div class="btn-tab btn-tab<?php echo $course->id;?> active" onclick="eng.students.showContent('videos', this, <?php echo $i;?>)">
						<?php 
						if(strlen($lesson->video_title[$i-1]) > 0)
							echo $lesson->video_title[$i-1];
						else
							echo 'Video';
                        ?>
						</div>
					<?php else: ?>
						<div class="btn-tab btn-tab<?php echo $course->id;?>" onclick="eng.students.showContent('videos', this, <?php echo $i;?>)">
                        <?php 
						if(strlen($lesson->video_title[$i-1]) > 0)
							echo $lesson->video_title[$i-1];
						else
							echo 'Video';
						?>
                        </div>
					<?php endif;?>
					<?php endfor;?>
					<?php if(count($lesson->audios) > 0):?>
					<div class="btn-tab btn-tab<?php echo $course->id;?>" onclick="eng.students.showContent('audios', this, <?php echo $i;?>)">Audio</div>
					<?php endif;?>
					<?php for($i = 1; $i <= count($lesson->activity); $i++):
						//if(($i != 1 && isset($finished) && !in_array($lesson->activity[$i-1], $finished)) && $getNextAct == 0)						
							//$classesInc = 'disabled ';
						$classesInc .= 'btn-tab btn-tab'.$course->id;
						if(count($lesson->videos) == 0 && $i == 1)
							$classesInc .= ' active';
						$getNextAct = 0;
						?>
					<div id="activity-tab-<?php echo $lesson->activity[$i-1];?>" class="<?php echo $classesInc;?>" onclick="eng.students.showContent('activity', this, <?php echo $i;?>)">
					<?php 
						if(strlen($lesson->title[$i-1]) > 0)
							echo $lesson->title[$i-1];
						else
							echo "Activity".$i;
						?>
						<?php
						if(isset($finished) && in_array($lesson->activity[$i-1], $finished))
						{
							echo '<div class="finished finished'.$id_course.'"></div>';
							$getNextAct = 1;
						}
						?>
					</div>
					<?php endfor;?>
				</div>
			</div>
			<div class="tab-content" style="border-color:<?php echo $course->color;?>">
				<div id="text" class="item-content" style="display:none;">
					<div class="tab-content-text">
					<?php echo $lesson->text;?>
					</div>
				</div>
			<?php		
			$count = 1;
			if($count == 1 && strlen($lesson->text) == 0 && count($lesson->videos) > 0)
				echo '<div id="videos" class="item-content">';
			else
				echo '<div id="videos" class="item-content" style="display:none">';
			if(count($lesson->videos) > 0):
				//echo '<div class="item-content-left"><input type="button" value="Prev" onclick="showPrev()" class="video-pag-left-btn"/></div>';
				foreach($lesson->videos as $video)
				{
			
					$videos = new Video($video);
					
					?>
					<div id="videos<?php echo $count; ?>" class="video hide">
						<!--<video controls="controls" class="video-js" poster="<?php bloginfo('home');?>/uploads/posters/<?php echo $videos->poster;?>"  title="" id="video" onloadeddata="videoLoaded()" width="100%" height="100%">
							<source src="<?php bloginfo('home');?>/uploads/videos/<?php echo $videos->m4v;?>" type="video/mp4" />
							<source src="<?php bloginfo('home');?>/uploads/videos/<?php echo $videos->webm;?>" type="video/webm" />
							<source src="<?php bloginfo('home');?>/uploads/videos/<?php echo $videos->ogv;?>" type="video/ogg" />
							<source src="<?php bloginfo('home');?>/uploads/videos/<?php echo $videos->mp4;?>" />
							<object type="application/x-shockwave-flash" data="<?php bloginfo('template_url');?>/images/flashfox.swf" width="600" height="400" style="position:relative;">
								<param name="movie" value="<?php bloginfo('template_url');?>/images/flashfox.swf" />
								<param name="allowFullScreen" value="true" />
								<param name="flashVars" value="autoplay=false&amp;controls=true&amp;fullScreenEnabled=true&amp;posterOnEnd=true&amp;loop=false&amp;poster=<?php bloginfo('home');?>/uploads/posters/<?php echo $videos->poster;?>&amp;src=<?php bloginfo('home');?>/uploads/videos/<?php echo $videos->mp4;?>" />
								<embed src="<?php bloginfo('template_url');?>/images/flashfox.swf" width="100%" height="100%" style="position:relative;"  flashVars="autoplay=false&amp;controls=true&amp;fullScreenEnabled=true&amp;posterOnEnd=true&amp;loop=false&amp;poster=<?php bloginfo('home');?>/uploads/posters/<?php echo $videos->poster;?>&amp;src=<?php bloginfo('home');?>/uploads/videos/<?php echo $videos->m4v;?>" allowFullScreen="true" wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer_en" />
								<img alt="" src="<?php bloginfo('home');?>/uploads/posters/<?php echo $videos->poster;?>" style="position:absolute;left:0;" width="100%" height="100%" title="Video playback is not supported by your browser" />
							</object>
						</video>
						<div class="video-loader"></div>-->
						<div id="beginner-intro">Loading the player...</div>
						<script type="text/javascript">
							jwplayer("beginner-intro").setup({
								width: "100%",
								height: '400',
								skin: "beelden",
								abouttext: 'EnglishStrokes.com',
								aboutlink: 'http://www.englishstrokes.com',
								logo: {
									file: '<?php bloginfo('template_url');?>/images/player-logo.png',
									link: 'http://www.englishstrokes.com',
									position: 'bottom-right'
								},
								playlist: [{
									image: "<?php bloginfo('home');?>/uploads/posters/<?php echo $videos->poster;?>",
									
									sources: [{
									  file: "<?php bloginfo('home');?>/uploads/videos/<?php echo $videos->mp4;?>",
									  label: "360p SD"
									},{
									  file: "<?php bloginfo('home');?>/uploads/videos/<?php echo $videos->mp4;?>",
									  label: "720p HD"
									}]
								 }]
							});
						</script>
					</div>
					<?php
					$count++;
				}
				//echo '<div class="item-content-right"><input type="button" value="Next" onclick="showNext()" class="video-pag-right-btn"/></div>';		
			endif;
			echo '</div>';
			echo '<div id="audios" style="display:none" class="item-content">';
			$count = 1;
			if(count($lesson->audios) > 0):
				foreach($lesson->audios as $audio)
				{
					$audios = new Audio($audio);
					?>
					<div id="audios<?php echo $count; ?>" class="audio hide">
						<h2 style="text-align:center;"><?php echo $audios->name; ?></h2>
						<object type="application/x-shockwave-flash" data="<?php bloginfo('home');?>/zplayer.swf?mp3=<?php bloginfo('home');?>/uploads/audios/<?php echo $audios->url; ?>"   width="300" height="40" style="margin-left:150px"/>
							<param name="movie" value="<?php bloginfo('home');?>/zplayer.swf?mp3=<?php bloginfo('home');?>/uploads/audios/<?php echo $audios->url; ?>"/>
						</object>
					</div>
					<?php
					$count++;
				}		
			endif;
			echo '</div>';
			if(count($lesson->videos) == 0)
				echo '<div id="activity" class="item-content">';
			else
				echo '<div id="activity" style="display:none;" class="item-content">';
			$count = 1;
			if(count($lesson->activity) > 0):
				foreach($lesson->activity as $audio)
				{
					$audios = new Activity($audio);
					if($audios->type == 6):
					?>
					<div id="activity<?php echo $count; ?>" class="activity hide flash">
						<div style="margin:30px auto; width:600px; margin-top:30px;">
							<object type="application/x-shockwave-flash" data="<?php bloginfo('url');?>/games/trivia-quiz-loader.swf" width="600px" height="400px" id="flashgame"/>
								<param name="movie" value="<?php bloginfo('url');?>/games/trivia-quiz-loader.swf"/>
                                <param name="allowFullScreen" value="true" />
                                <param name="flashVars" value="loadXml=<?php echo urlencode( $audios->url.'&id='.$audios->id);?>"/>
                                <embed src="<?php bloginfo('url');?>/games/trivia-quiz-loader.swf" width="600" height="400" style="position:relative;"  flashVars="loadXml=<?php echo urlencode( $audios->url.'&id='.$audios->id);?>" allowFullScreen="true" wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer_en" />
                                <img alt="" src="" style="position:absolute;left:0;" width="600" height="400" title="Video playback is not supported by your browser" />
							</object>
						</div>
					</div>
				<?php else:?>
					<div id="activity<?php echo $count; ?>" class="activity hide">
						<div class="activity-centre">
							<iframe class="frame" id="frame<?php echo $count; ?>" src="<?php bloginfo('home');?>/activity/<?php echo $audios->url;?>?id=<?php echo $audios->id;?>&course=<?php echo $course->id;?>&count=<?php echo $count;?>" width="100%" height="400" scrolling="no" frameborder="0" ></iframe>
						</div>
					</div>
				<?php endif;?>
					<?php
					$count++;
				}		
			endif;
			echo '</div></div><div class="activity-load" style="border-color:'.$course->color.'"></div>';
		else:
			echo '<h1>You are not authorized to view this content</h1>';
		endif;
	}
	else if(isset($id_course))
	{?>		
		<div class="tab-container" style="border-color:<?php echo $course->color;?>">
			<div class="title1 trebuchet" style="margin:0; font-size:20px; color:<?php echo $course->color;?>"><?php echo $course->name;?></div>
			<div style="float:right;">
				<div class="btn-tab-color" style="background-color:<?php echo $course->color;?>">Introduction</div>						
			</div>
		</div>
		<div class="tab-content" style="border-color:<?php echo $course->color;?>; margin-bottom:20px;">
			<div id="text" class="item-content">
				<div class="tab-content-text">
				<?php 
				//if($id_course == 1):
				
				$courseDesc = str_replace("// <![CDATA[","",$course->description);
				$courseDesc = str_replace("// ]]>","",$courseDesc);
				echo $courseDesc;
				?>
				</div>
			</div>
		</div>
		<?php if ( is_user_logged_in() ):?>
		<div class="dashboard-container">
			<div class="dashboard-title" style="background-color:<?php echo $course->color;?>">Your scoreboard</div>
			<div class="clear"></div>
			<div class="dashboard-table" style="border-color:<?php echo $course->color;?>">
				<div style="height:380px; overflow:auto">
					<table cellspacing="0" border="0" cellpadding="5px" width="100%">
						<tr class="dashboard-table-head" style="color:<?php echo $course->color;?>">
							<td class="dashboard-table-row">Level</td>
							<td class="dashboard-table-row">Unit</td>
							<td class="dashboard-table-row">Right</td>
							<td class="dashboard-table-row-bot">Wrong</td>
							
						</tr>
					<?php
					$sql = 'SELECT ch.name AS unit, l.name AS lesson, sum(s.correct) AS correct, sum(s.wrong) AS wrong, 
							ch.id AS chapter_id, cr.name AS course_name FROM courses c
							INNER JOIN chapters ch ON ch.course_id = c.id
							INNER JOIN lessons l ON l.chapter_id = ch.id
							INNER JOIN courses cr ON cr.id = ch.course_id
							LEFT OUTER JOIN lesson_activity la ON la.lesson_id = l.id
							LEFT OUTER JOIN scoreboard s ON s.activity_id = la.activity_id AND s.user_id = '.$current_user->ID.'
							WHERE c.id = '.$id_course.' GROUP BY ch.id ORDER BY ch.id, l.id';
					$resultResource = mysql_query($sql);
					$rightCount = 0;
					$wrongCount = 0;
					while($result = mysql_fetch_array($resultResource))
					{
						echo '
						<tr class="body" onclick="showScorecard('.$id_course.', '.$result['chapter_id'].')">
							<td class="dashboard-table-row">'.$result['course_name'].'</td>
							<td class="dashboard-table-row">'.$result['unit'].'</td>';
						echo '
						<td class="dashboard-table-row">'.(isset($result['correct'])?$result['correct']:'0').'</td>
						<td class="dashboard-table-row-bot">'.(isset($result['wrong'])?$result['wrong']:'0').'</td>
						</tr>
						';
						$rightCount += isset($result['correct'])?$result['correct']:0;
						$wrongCount += isset($result['wrong'])?$result['wrong']:0;
					}
					?>
					</table>
					<div class="scorecard-total">Total : <?php echo (($rightCount>0)?number_format(($rightCount * 100)/($rightCount + $wrongCount), 2):'0');?>%</div>
				</div>
			</div>
		</div>
		<?php endif;?>
	<?php }
	else
	{
	?>
	<script>eng.jQuery(document).ready(function($){eng.jQuery('.sidebar-inner-title').click();})</script>
	<script src="<?php bloginfo('template_url');?>/js/html5ext.js" type="text/javascript"></script>

<div class="title1 trebuchet">Why English is Important</div>
<div class="clear"></div>
<?php if ( !is_user_logged_in() ):?>
<div class="sub-title1">Already Registered user<a href="#" onclick="eng.login.showLoginBox();"> Login here </a></div>
<a href="<?php bloginfo('url');?>/payment"><img src="<?php bloginfo('template_url');?>/images/registernow.jpg" alt="Register Now!" class="content-image" style="float:right; margin-right:120px; margin-top:-50px;"/></a>
<?php elseif(!$payment->checkUserStatus($current_user->ID, 1)):?>
<a href="<?php bloginfo('url');?>/payment"><img src="<?php bloginfo('template_url');?>/images/Paynow.jpg" alt="Register Now!" class="content-image" style="float:right; margin-right:120px; margin-top:-50px;"/></a>
<?php endif;?>
	<div class="clear"></div>
	<div class="clear"></div>
	<div class="sub-title1">Whatever be your professional aspirations, English is a key factor to your success!</div>
	<div class="clear"></div>
		<img src="<?php bloginfo('template_url');?>/images/student-img-2.jpg" alt="" class="content-image" style="float:right; margin-right:120px;"/>
	<div style="float:left;">
		<div class="clear"></div>
		<div class="student-imp-points-cont">
			<div class="student-imp-points"><span class="sidebar-edit-search"></span> Do you want to Google something?</div>
			<div class="student-imp-points"><span class="sidebar-edit-book"></span> Do you want to travel?</div>
			<div class="student-imp-points"><span class="sidebar-edit-icon"></span> Do you want to study?</div>
			<div class="student-imp-points"><span class="sidebar-edit-clock"></span> Do you want to progress in your career?</div>
		</div>
	</div>
	<div class="clear"></div>
	<p>Wherever you want to go, or whatever you want to do, English proficiency is going to make it easier. Let your love of Cricket help you to learn more of the world's most useful language.</p>
	<div class="title1 trebuchet" style="margin-top:20px;">Areas in English</div>
	<div class="clear"></div>
	English<b>Strokes</b> will help you with all your English skills. You will have a learning experience built around animations, and you will have a chance to actively use your listening, reading, writing and pronunciation skills. You will be able to follow the characters through three levels of difficulty, and you will be supported by Kris Srikkanth all the way.
	<p></p>
	<div class="student-column">
		<img src="<?php bloginfo('template_url');?>/images/student-img1.jpg" alt=""/>
		<div class="sub-title1" style="margin:5px 0 7px 0;">Grammar and Conversations</div>
		<div class="clear"></div>
		Learn Grammar through interesting movies , conversations and  activities. Take the quizzes and even learn vocabulary.
	</div>
	<div class="student-column">
		<img src="<?php bloginfo('template_url');?>/images/student-img2.jpg" alt=""/>
		<div class="sub-title1" style="margin:5px 0 7px 0;">Anecdotes</div>
		<div class="clear"></div>
		Listen to some interesting anecdotes from cricketers, answer a few questions and continue the journey  of learning English
	</div>
	<div class="student-column">
		<img src="<?php bloginfo('template_url');?>/images/student-img3.jpg" alt=""/>
		<div class="sub-title1" style="margin:5px 0 7px 0;">Infographics</div>
		<div class="clear"></div>
		Interesting Infographics help you know more about countries, places, sports related activities and more...
	</div>
	<div class="student-column">
		<img src="<?php bloginfo('template_url');?>/images/student-img4.jpg" alt=""/>
		<div class="sub-title1" style="margin:5px 0 7px 0;">Cricketing Tips</div>
		<div class="clear"></div>
		Learn phrases and terms used in cricket, while also getting to know the sport.
	</div>
	<?php
	}?>
</div>
<style>
#videos1,#audios1,#activity1{display:block;}
.hide{display:none;}
.transparent-payment-container{background:url(<?php bloginfo('template_url');?>/images/trans-black.png) repeat;}
</style>
<script>
var video = 1;
function showNext()
{
	if($('#video'+(video+1)).length > 0)
	{
		video++;
		$('.hide').hide();
		$('#video'+video).show();		
	}
}
function showPrev()
{
	if($('#video'+(video-1)).length > 0)
	{
		video--;
		$('.hide').hide();
		$('#video'+video).show();
	}
}
</script>
<div class="transparent-payment-container">
	<div class="scorecard-unit">
		<div class="scorecard-unit-inner" id="dynamic-scorecard">
		</div>
	</div>
</div>
<?php
get_footer();