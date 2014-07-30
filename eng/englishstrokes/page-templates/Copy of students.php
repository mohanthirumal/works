<?
/**
 * Template Name: Students Page Template
 *
 * Description: Course page contains chapters of that course
 */
get_header();
$id_course = 1;
if(isset($_REQUEST['id_lesson']))
	$id_lesson = $_REQUEST['id_lesson'];
?>
<img src="<?php bloginfo('template_url');?>/images/student-banner.jpg" alt="" class="teachers-banner"/>
<div class="left-container" style="width:250px;">
	<?php
	$course = new Course($id_course);
	$courses = $course->getAllCourses();
	foreach($courses as $cours):
	$chapters = $course->getCourseChapters($cours['id']);
	?>
	<div class="sidebar-container">
		<div class="sidebar-title trebuchet"><?php echo $cours['name'];?></div>
		<div class="sidebar-body">
			<div class="sidebar-top"></div>
			<div class="sidebar-content">
				<div class="sidebar-inner">					
					<?php
					$count = 1;
                    foreach($chapters as $chapter)
                    {
                        $lesson = new Chapter($chapter['id']);
                        $lessons = $lesson->getChapterLessons($chapter['id']);
                        echo '<div class="sidebar-inner-title">'.$chapter['name'].'</div>';
	                    echo '<ul'.($count!=1?' style=""':'').'>';
                        foreach($lessons as $lesson)
                        {
							if($id_lesson == $lesson['id'])
								echo '<li class="current"><a href="?id_course='.$id_course.'&id_lesson='.$lesson['id'].'">'.$lesson['name'].'</a></li>';
							else
                            	echo '<li><a href="?id_course='.$id_course.'&id_lesson='.$lesson['id'].'">'.$lesson['name'].'</a></li>';
                        }
                        echo '</ul>';
						//echo '<div class="divider"></div>';
						$count++;
                    }
                    ?>
				</div>
			</div>
			<div class="sidebar-bottom"></div>
		</div>
	</div>
	<?php endforeach;?>
</div>
<div class="right-container" style="float:left; width:740px; margin:20px 0 0 5px;">	
	<?php
	if(isset($id_lesson))
	{
		$lesson = new Lesson($id_lesson);
		$chapter = new Chapter($lesson->chapter_id);
		?>	
	<div class="tab-container">
		<div class="course-title-text trebuchet"><?php echo $chapter->name;?></div>
		<div class="btn-tab" onclick="showContent('test', this)">Activity</div>
		<?php if(count($lesson->audios) > 0):?>
		<div class="btn-tab" onclick="showContent('audios', this)">Audio</div>
		<?php endif;?>
		<div class="btn-tab" onclick="showContent('videos', this)">Video</div>
		<div class="btn-tab btn-tab-large active" onclick="showContent('text', this)"><?php echo $lesson->name;?></div>
	</div>
	<div class="tab-content">
		<div id="text" class="item-content">
			<div class="tab-content-text">
			<?php echo $lesson->text;?>
			</div>
		</div>
	<?php		
		$count = 1;
		echo '<div id="videos" class="item-content" style="display:none">';
		if(count($lesson->videos) > 0):
			echo '<div class="item-content-left"><input type="button" value="Prev" onclick="showPrev()" class="video-pag-left-btn"/></div>';
			foreach($lesson->videos as $video)
			{
				$videos = new Video($video);
				?>
				<div id="video<?php echo $count; ?>" class="video hide">
					<h2 style="text-align:center;"><?php echo $videos->name; ?></h2>
					<div id="bg_player_location<?php echo $videos->id; ?>">
					<a href="http://www.adobe.com/go/getflashplayer">
					<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
					</a>
					</div>
					<script type="text/javascript" src="http://bitcast-b.bitgravity.com/player/6/functions.js"></script>
					<script type="text/javascript">
					var flashvars = {};
					flashvars.File = "<?php bloginfo('home');?>/administrator/uploads/videos/<?php echo $videos->url; ?>";
					flashvars.Mode = "ondemand";
					flashvars.AutoPlay = "false";
					var params = {};
					params.allowFullScreen = "true";
					params.allowScriptAccess = "always";
					var attributes = {};
					attributes.id = "bitgravity_player_6";
					swfobject.embedSWF(stablerelease, "bg_player_location<?php echo $videos->id; ?>", "600", "400", "9.0.115", "http://bitcast-b.bitgravity.com/player/expressInstall.swf", flashvars, params, attributes);
					</script>
					<div class="description"><?php echo $videos->description; ?></div>
				</div>
				<?php
				$count++;
			}
			echo '<div class="item-content-right"><input type="button" value="Next" onclick="showNext()" class="video-pag-right-btn"/></div>';
		else:
			echo '<div style="clear:both; text-align:center;">NO Videos</div>';
		endif;
		echo '</div>';		
		echo '<div id="audios" style="display:none" class="item-content">';
		$count = 1;
		if(count($lesson->audios) > 0):
			foreach($lesson->audios as $audio)
			{
				$audios = new Audio($audio);
				?>
				<div id="audio<?php echo $count; ?>" class="audio hide">
					<h2 style="text-align:center;"><?php echo $audios->name; ?></h2>
					<object type="application/x-shockwave-flash" data="<?php bloginfo('home');?>/zplayer.swf?mp3=<?php bloginfo('home');?>/administrator/uploads/audios/<?php echo $audios->url; ?>"   width="300" height="40" style="margin-left:150px"/>
					<param name="movie" value="<?php bloginfo('home');?>/zplayer.swf?mp3=<?php bloginfo('home');?>/administrator/uploads/audios/<?php echo $audios->url; ?>"/>
				</object>
				</div>
				<?php
				$count++;
			}
		else:
			echo '<div style="clear:both; text-align:center;">NO Audios</div>';
		endif;
		echo '</div>';
		
		echo '<div id="test" style="display:none;clear:both" class="item-content"><div class="tab-content-text">';
		$questions = new Question();
		$lessonQues = $questions->getQuestions($id_lesson);
		if(count($lessonQues) > 0)
		{
			echo '<form action="" method="post">';
			$count = 1;
			$count1 = 1;
			foreach($lessonQues as $lessonQue)
			{
				$question = new Question($lessonQue['id']);
				echo $count.'). '.$question->question;				
				foreach($question->answers as $answerid)
				{
					$answer = new Answer($answerid);
					echo '<div><input type="radio" value="'.$answerid.'" name="answer'.$count.'[]" id="answer'.$count1.'" checked/><label for="answer'.$count1.'">'.$answer->answer.'</label></div>';
					$count1++;
				}
				$count++;
			}
			echo '<input type="submit" value="submit"/>';
			echo '</form>';
		}
		else
			echo 'Test not available';
		echo '</div></div></div>';
	}
	else
	{
	?>
	<div class="title1 trebuchet">Why English is Important</div>
	<div class="clear"></div>
	<div class="sub-title1">Whatever be your professional aspirations, English is a key factor to your success!</div>
	<div class="clear"></div>
	<p>It opens up opportunities:</p>
	<p> - Do you want to Google something?<br/>
		- Do you want to travel?<br/>
		- Do you want to study?<br/>
		- Do you want to progress in your career?</p>
	<p>Wherever you want to go, or whatever you want to do, English proficiency is going to make it easier. Let your love of Cricket help you to learn more of the world's most useful language.</p>
	<div class="title1 trebuchet">Areas in English</div>
	<div class="clear"></div>
	<p>Englishstrokes will help you with all your English skills. You will have a learning experience built around animations, and you will have a chance to actively use your listening, reading, writing and pronunciation skills. You will be able to follow the characters through three levels of difficulty, and you will be supported by Kris Srikkanth all the way. </p>
	<div class="student-column column1">
		<img src="<?php bloginfo('template_url');?>/images/student-img1.jpg" alt=""/>
		<div class="sub-title1" style="margin:5px 0 0 0;">Grammar and Conversations</div>
		<div class="clear"></div>
		<p>Learn Grammar through interesting movies , conversations and  activities. Take the quizzes and even learn vocabulary.</p>
	</div>
	<div class="student-column column1">
		<img src="<?php bloginfo('template_url');?>/images/student-img2.jpg" alt=""/>
		<div class="sub-title1" style="margin:5px 0 0 0;">Anecdotes</div>
		<div class="clear"></div>
		<p>Listen to some interesting anecdotes from cricketers, answer a few questions and continue the journey  of learning English</p>
	</div>
	<div class="student-column column1">
		<img src="<?php bloginfo('template_url');?>/images/student-img3.jpg" alt=""/>
		<div class="sub-title1" style="margin:5px 0 0 0;">Infographics</div>
		<div class="clear"></div>
		<p>Interesting Infographics help you know more about countries, places, sports related activities and more...</p>
	</div>
	<div class="student-column column1">
		<img src="<?php bloginfo('template_url');?>/images/student-img4.jpg" alt=""/>
		<div class="sub-title1" style="margin:5px 0 0 0;">Cricketing Tips</div>
		<div class="clear"></div>
		<p>Learn phrases and terms used in cricket, while also getting to know the sport.</p>
	</div>
	<?php
	}?>
</div>
<style>
#video1,#audio1{display:block;}
.hide{display:none;}
</style>
<script>
function showContent(ele, ite)
{
	$('.tab-container .btn-tab').removeClass('active');
	$(ite).addClass('active');
	$('.item-content').hide();
	$('#'+ele).show();
}
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

jQuery(document).ready(function($)
{	
	$('.sidebar-inner-title').each(function() {
		$(this).click(function() {			
			$(this).addClass('active').next("ul").slideToggle("slow").siblings("ul:visible").slideUp("slow");			
		});
	});

});
</script>
<?php
get_footer();
