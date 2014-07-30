<?php
/**
 * Template Name: Dashboard Page Template
 *
 * Description: Course page contains chapters of that course
 */
 get_header();
 global $current_user;
 $id_course = 1;
 $course = new Course($id_course);
 $course2 = new Course(4);
 $course3 = new Course(5);
 ?>
<?php if ( is_user_logged_in() ):?>
<h1>Here you can see your overall leaderboard :</h1>
 <div class="dashboard-container" style="margin-top:20px;">
	<div class="dashboard-title" style="background-color:<?php echo $course->color;?>" onclick="showDashboardTable(1)"><?php echo $course->name;?></div>
	<div class="dashboard-title" style="background-color:<?php echo $course2->color;?>" onclick="showDashboardTable(2)"><?php echo $course2->name;?></div>
	<div class="dashboard-title" style="background-color:<?php echo $course3->color;?>" onclick="showDashboardTable(3)"><?php echo $course3->name;?></div>
	<div class="clear"></div>
	<div class="dashboard-table dashboard-table-all" id="dashboard-table-1" style="border-color:<?php echo $course->color;?>">
		<div style="height:450px; overflow:auto">
			<table cellspacing="0" border="0" cellpadding="5px" width="100%">
				<tr class="dashboard-table-head" style="color:<?php echo $course->color;?>">
					<td class="dashboard-table-row">Level</td>
					<td class="dashboard-table-row">Unit</td>
					<td class="dashboard-table-row">Right</td>
					<td class="dashboard-table-row-bot">Wrong</td>
				</tr>
			<?php
			$rightCount = 0;
			$wrongCount = 0;
			$sql = 'SELECT ch.name AS unit, l.name AS lesson, sum(s.correct) AS correct, sum(s.wrong) AS wrong, 
					ch.id AS chapter_id, cr.name AS course_name FROM courses c
					INNER JOIN chapters ch ON ch.course_id = c.id
					INNER JOIN lessons l ON l.chapter_id = ch.id
					INNER JOIN courses cr ON cr.id = ch.course_id
					LEFT OUTER JOIN lesson_activity la ON la.lesson_id = l.id
					LEFT OUTER JOIN scoreboard s ON s.activity_id = la.activity_id AND s.user_id = '.$current_user->ID.'
					WHERE c.id = '.$course->id.' GROUP BY ch.id ORDER BY ch.id, l.id';
			$resultResource = mysql_query($sql);
			while($result = mysql_fetch_array($resultResource))
			{
				echo '
				<tr class="body" onclick="showScorecard('.$course->id.', '.$result['chapter_id'].')" id="table-row-'.$result['chapter_id'].'">
					<td class="dashboard-table-row">
					<img src="'.get_bloginfo('template_url').'/images/right-tick.png" id="row-right-'.$result['chapter_id'].'" class="row-right"/>
					<img src="'.get_bloginfo('template_url').'/images/wrong-tick.png" id="row-wrong-'.$result['chapter_id'].'"/>
					'.$result['course_name'].'
					</td>
					<td class="dashboard-table-row">'.$result['unit'].'</td>';
				echo '
				<td class="dashboard-table-row">'.(isset($result['correct'])?$result['correct']:'0').'</td>
				<td class="dashboard-table-row-bot">'.(isset($result['wrong'])?$result['wrong']:'0').'</td>
				</tr>
				';
				$rightCount += isset($result['correct'])?$result['correct']:0;
				$wrongCount += isset($result['wrong'])?$result['wrong']:0;
			}
			$marks = (($rightCount>0)?number_format(($rightCount * 100)/($rightCount + $wrongCount), 2):'0');
			?>
			</table>
			<div class="scorecard-total">Total : <?php echo $marks;?>%</div>
			<img src="<?php echo get_template_directory_uri(); ?>/images/loader.gif" alt="" class="certificate-loader"/>
			<?php
			$sql = 'SELECT * FROM certificates WHERE id_user = '.$current_user->ID.' AND id_course = '.$course->id;
			$resultResource = mysql_query($sql);
			if(mysql_num_rows($resultResource) == 0)
				echo '<input type="button" value="Get your certificate" onclick="getYourCertificate('.$course->id.', '.$marks.')" class="btn-get-certificate trebuchet newsletter-btn"/>';
			else
			{
				$result = mysql_fetch_array($resultResource);
				echo '<a href="'.get_bloginfo('url').'/certificate/'.$result['file_path'].'" class="btn-get-certificate trebuchet newsletter-btn" target="_blank">Download your certificate</a>';
			}
			?>
		</div>
	</div>
</div>
<div class="clear"></div>
<div class="dashboard-container dashboard-table-all" id="dashboard-table-2" style="display:none;">
	<div class="clear"></div>
	<div class="dashboard-table" style="border-color:<?php echo $course2->color;?>">
		<div style="height:450px; overflow:auto">
			<table cellspacing="0" border="0" cellpadding="5px" width="100%">
				<tr class="dashboard-table-head" style="color:<?php echo $course2->color;?>">
					<td class="dashboard-table-row">Level</td>
					<td class="dashboard-table-row">Unit</td>
					<td class="dashboard-table-row">Right</td>
					<td class="dashboard-table-row-bot">Wrong</td>
				</tr>
			<?php
			$rightCount = 0;
			$wrongCount = 0;
			$sql = 'SELECT ch.name AS unit, l.name AS lesson, sum(s.correct) AS correct, sum(s.wrong) AS wrong, 
					ch.id AS chapter_id, cr.name AS course_name FROM courses c
					INNER JOIN chapters ch ON ch.course_id = c.id
					INNER JOIN lessons l ON l.chapter_id = ch.id
					INNER JOIN courses cr ON cr.id = ch.course_id
					LEFT OUTER JOIN lesson_activity la ON la.lesson_id = l.id
					LEFT OUTER JOIN scoreboard s ON s.activity_id = la.activity_id AND s.user_id = '.$current_user->ID.'
					WHERE c.id = '.$course2->id.' GROUP BY ch.id ORDER BY ch.id, l.id';
			$resultResource = mysql_query($sql);
			while($result = mysql_fetch_array($resultResource))
			{
				echo '
				<tr class="body" onclick="showScorecard('.$course2->id.', '.$result['chapter_id'].')" id="table-row-'.$result['chapter_id'].'">
					<td class="dashboard-table-row">
						<img src="'.get_bloginfo('template_url').'/images/right-tick.png" id="row-right-'.$result['chapter_id'].'" class="row-right"/>
						<img src="'.get_bloginfo('template_url').'/images/wrong-tick.png" id="row-wrong-'.$result['chapter_id'].'"/>
						'.$result['course_name'].'
					</td>
					<td class="dashboard-table-row">'.$result['unit'].'</td>';
				echo '
				<td class="dashboard-table-row">'.(isset($result['correct'])?$result['correct']:'0').'</td>
				<td class="dashboard-table-row-bot">'.(isset($result['wrong'])?$result['wrong']:'0').'</td>
				</tr>
				';
				$rightCount += isset($result['correct'])?$result['correct']:0;
				$wrongCount += isset($result['wrong'])?$result['wrong']:0;
			}
			$marks = (($rightCount>0)?number_format(($rightCount * 100)/($rightCount + $wrongCount), 2):'0');
			?>
			</table>
			<div class="scorecard-total">Total : <?php echo $marks;?>%</div>
			<img src="<?php echo get_template_directory_uri(); ?>/images/loader.gif" alt="" class="certificate-loader"/>
			<?php
			$sql = 'SELECT * FROM certificates WHERE id_user = '.$current_user->ID.' AND id_course = '.$course2->id;
			$resultResource = mysql_query($sql);
			if(mysql_num_rows($resultResource) == 0)
				echo '<input type="button" value="Get your certificate" onclick="getYourCertificate('.$course2->id.','.$marks.')" class="btn-get-certificate trebuchet newsletter-btn"/>';
			else
			{
				$result = mysql_fetch_array($resultResource);
				echo '<a href="'.get_bloginfo('url').'/certificate/'.$result['file_path'].'" class="btn-get-certificate trebuchet newsletter-btn" target="_blank">Download your certificate</a>';
			}
			?>
		</div>
	</div>
</div>
<div class="clear"></div>
<div class="dashboard-container dashboard-table-all" id="dashboard-table-3" style="display:none;">
	<div class="clear"></div>
	<div class="dashboard-table" style="border-color:<?php echo $course3->color;?>">
		<div style="height:450px; overflow:auto">
			<table cellspacing="0" border="0" cellpadding="5px" width="100%">
				<tr class="dashboard-table-head" style="color:<?php echo $course3->color;?>">
					<td class="dashboard-table-row">Level</td>
					<td class="dashboard-table-row">Unit</td>
					<td class="dashboard-table-row">Right</td>
					<td class="dashboard-table-row-bot">Wrong</td>
				</tr>
			<?php
			$rightCount = 0;
			$wrongCount = 0;
			$sql = 'SELECT ch.name AS unit, l.name AS lesson, sum(s.correct) AS correct, sum(s.wrong) AS wrong, 
					ch.id AS chapter_id, cr.name AS course_name FROM courses c
					INNER JOIN chapters ch ON ch.course_id = c.id
					INNER JOIN lessons l ON l.chapter_id = ch.id
					INNER JOIN courses cr ON cr.id = ch.course_id
					LEFT OUTER JOIN lesson_activity la ON la.lesson_id = l.id
					LEFT OUTER JOIN scoreboard s ON s.activity_id = la.activity_id AND s.user_id = '.$current_user->ID.'
					WHERE c.id = '.$course3->id.' GROUP BY ch.id ORDER BY ch.id, l.id';
			$resultResource = mysql_query($sql);
			while($result = mysql_fetch_array($resultResource))
			{
				echo '
				<tr class="body" onclick="showScorecard('.$course3->id.', '.$result['chapter_id'].')" id="table-row-'.$result['chapter_id'].'">
					<td class="dashboard-table-row">
						<img src="'.get_bloginfo('template_url').'/images/right-tick.png" id="row-right-'.$result['chapter_id'].'" class="row-right"/>
						<img src="'.get_bloginfo('template_url').'/images/wrong-tick.png" id="row-wrong-'.$result['chapter_id'].'"/>
						'.$result['course_name'].'
					</td>
					<td class="dashboard-table-row">'.$result['unit'].'</td>';
				echo '
				<td class="dashboard-table-row">'.(isset($result['correct'])?$result['correct']:'0').'</td>
				<td class="dashboard-table-row-bot">'.(isset($result['wrong'])?$result['wrong']:'0').'</td>
				</tr>
				';
				$rightCount += isset($result['correct'])?$result['correct']:0;
				$wrongCount += isset($result['wrong'])?$result['wrong']:0;
			}
			$marks = (($rightCount>0)?number_format(($rightCount * 100)/($rightCount + $wrongCount), 2):'0');
			?>
			</table>
			<div class="scorecard-total">Total : <?php echo $marks;?>%</div>
			<img src="<?php echo get_template_directory_uri(); ?>/images/loader.gif" alt="" class="certificate-loader"/>
			<?php
			$sql = 'SELECT * FROM certificates WHERE id_user = '.$current_user->ID.' AND id_course = '.$course3->id;
			$resultResource = mysql_query($sql);
			if(mysql_num_rows($resultResource) == 0)
				echo '<input type="button" value="Get your certificate" onclick="getYourCertificate('.$course3->id.','.$marks.')" class="btn-get-certificate trebuchet newsletter-btn"/>';
			else
			{
				$result = mysql_fetch_array($resultResource);
				echo '<a href="'.get_bloginfo('url').'/certificate/'.$result['file_path'].'" class="btn-get-certificate trebuchet newsletter-btn" target="_blank">Download your certificate</a>';
			}
			?>
		</div>
	</div>
</div>
<div class="transparent-payment-container">
	<div class="scorecard-unit">
		<div class="scorecard-unit-inner" id="dynamic-scorecard">
		</div>
	</div>
</div>
<style>
.transparent-payment-container{background:url(<?php bloginfo('template_url');?>/images/trans-black.png) repeat;}
</style>
<?php else:?>
<h1>You must login to see your scores</h1>
<?php endif;?>
<?php
 get_footer();