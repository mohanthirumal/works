<?php
/**
 * Template Name: Parents Page Template
 *
 * Description: Course page contains chapters of that course
 */
 get_header();
 ?>
 <div class="page-content teachers">
 	<img src="<?php bloginfo('template_url');?>/images/parents-banner.jpg" alt="" class="teachers-banner"/>
	<div class="left-container">
		<div class="title1 trebuchet">Why Learning English is Important for Your Child</div>
		<div class="clear"></div>
		<img src="<?php bloginfo('template_url');?>/images/learning-img.jpg" alt="" class="content-image"/>
		<div class="column-right-container">
			<div class="sub-title1" style="margin:0;">English is the key</div>
			<div class="clear"></div>
			<p>You want the best for your child. Open up a world of opportunity for them. Whether they want to use the internet, study abroad or work in a top company, English is the key.</p>
		</div>
		<div class="clear"></div>
		<img src="<?php bloginfo('template_url');?>/images/future-img.jpg" alt="" class="content-image"/>
		<div class="column-right-container">
			<div class="sub-title1" style="margin:0;">Invest in their future</div>
			<div class="clear"></div>
			<p>An investment in English is an investment in your child's future. You can help them to learn English by giving them access to top quality educational materials and engaging learning games that capture their imagination. Enjoy learning more about English and Cricket together.</p>
		</div>
		<div class="clear"></div>
		<div class="title1 trebuchet">How to teach your kids</div>
		<div class="clear"></div>
		<img src="<?php bloginfo('template_url');?>/images/parents-img3.jpg" alt="" class="content-image"/>
		<div class="column-right-container">
			<div class="sub-title1" style="margin:0;">When parents show an interest, kids thrive!</div>
			<div class="clear"></div>
			<p>These resources have been created and developed by teachers and professionals who work with children who are learning English. They have been designed to help kids and teenagers learn English while having fun and learning more about cricket! Take time out of your day to go through English<b>Strokes</b>, together.</p>		
		</div>
		<div class="clear"></div>		
		<p></p><p>&nbsp;</p>
		<?php if ( !is_user_logged_in() ):?>
		<div class="page-signup-cont">Get started with an account for your child</div><input type="button" value="Signup" class="btn-signup" onclick="eng.login.showSignupBox('student')">
		<?php endif;?>
	</div>
	<div class="right-container">
		<div class="sidebar1 column2">
			<div class="sidebar1-title trebuchet title">TEACHING TIPS !</div>
			<div class="sidebar1-content">
				<img src="<?php bloginfo('template_url');?>/images/teacher-img2.jpg" alt=""/>
				<p>Research shows that children do best when parents take an interest in their learning. We can give you tips and advice to help you support your child and make their study time more effective. Think of it as coaching your very own Cricket stars!</p>
				<p>You can:</p>
				<p><span class="sidebar-edit-icon"></span> note down new words and display them in a list</p>
				<p><span class="sidebar-edit-book"></span> practice English during your daily routines</p>
				<p><span class="sidebar-edit-chat"></span> go over new words at<br/> breakfast</p>
				<p><span class="sidebar-edit-clock"></span>work together on EnglishStrokes after school.</p>
				<p><span class="sidebar-edit-search"></span>use the search tool to find specific topics to work on with them.</p>
				<p>English<b>Strokes</b> can be fun for the whole family!</p>
			</div>
				

		</div>
	</div>
 </div>
 <?php
 get_footer();