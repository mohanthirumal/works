<?php
/**
 * Template Name: Teachers Page Template
 *
 * Description: Course page contains chapters of that course
 */
 get_header();
 ?>
 <div class="page-content teachers">
 	<img src="<?php bloginfo('template_url');?>/images/teachers-banner.jpg" alt="" class="teachers-banner"/>
	<div class="left-container">
		<div class="title1 trebuchet">How we can help you</div>
		<div class="clear"></div>
		<div class="sub-title1">"Sport is an ideal medium to use in pedagogy. Students are hooked on to sports such as cricket that involve phrases, terms, commentary and grammar which increase ones reading and listening skills. "</div>
		<img src="<?php bloginfo('template_url');?>/images/teacher-img3.jpg" alt="" class="content-image"/>
		<p>Don&apos;t you wish that your students were as enthusiastic about their English lesson as they are about Cricket? Well, we might just have the answer for you.</p>
		<p>Whether you are new to English language teaching, or taking the next steps in your career and development, you will find time-saving help and support here.</p>
		<p>EnglishStrokes online has lesson plans, teaching tips and materials to bring the excitement of learning English through cricket into the classroom. The materials are linked to specific units of the course and cover key lexical and grammatical areas as well as listening, speaking, pronunciation, reading and writing.</p>
		<div class="title1 trebuchet">More free resources</div>
		<div class="clear"></div>
		<div class="sub-title1">Lesson plans, activities, articles and worksheets for your classroom !</div>
		<div class="clear"></div>
		<img src="<?php bloginfo('template_url');?>/images/teacher-img1.jpg" alt="" class="content-image"/>
		<p style="margin-top:0;">To access additional resources and advice on English Language Teaching visit the Teaching<b>English</b> website <a href="http://www.teachingenglish.org.uk/" target="_blank">www.teachingenglish.org.uk</a></p>
		<p>Across the site you can find free classroom materials to download, from short activities to full lesson plans, for teaching kids and adults. There are also articles on aspects of teaching, and free teacher development and teacher training materials.</p>
		<div class="clear"></div>		
		<p></p>
		<p>&nbsp;</p>
		<?php if ( !is_user_logged_in() ):?>
		<div class="page-signup-cont">Get an account for your students</div><input type="button" value="Signup" class="btn-signup" onclick="eng.login.showSignupBox('student')">
		<?php endif;?>
	</div>
	<div class="right-container">
		<div class="sidebar1 column2">
			<div class="sidebar1-title trebuchet title">PREMIUM RESOURCES</div>
			<div class="sidebar1-content">
				<img src="<?php bloginfo('template_url');?>/images/teacher-side-img.jpg" alt=""/>
				<p><b>Why do I need a Premium Account?</b></p>
				<p>With a Premium Account, you can:</p>
				<p>1. Build your own network in an international online community.</p>			
				<p>2. Use our Learning Management System and track your students' progress and prepare materials specific to their needs.</p>			
				<p>3. Access and download further teaching materials.</p>			
				<!--<p>4. It's quick and simple - register now and you will have your own account in just a few seconds.</p>-->
			</div>
			<div class="sidebar1-title title">Coming Soon</div>

		</div>
	</div>
 </div>
 <?php
 get_footer();