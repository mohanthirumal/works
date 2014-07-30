<?php
/**
 * Template Name: Courses Page Template
 *
 * Description: Course page contains chapters of that course
 */
get_header();
global $current_user;
$payment = new Payment();
$loggedIn = false;
if(is_user_logged_in())
	$loggedIn = true
?>
<link href="<?php echo get_template_directory_uri(); ?>/css/course.css" rel="stylesheet" type="text/css" media="all" />
<div class="page-content contactus">
	<img src="<?php bloginfo('template_url'); ?>/images/course-banner.jpg" alt=""/>
</div>
<div class="courses-container-bg">
	<div class="course-individual-cont-outer">
		<div class="course-individual-cont">
			<div class="course-indiv-head">
				<div class="course-indiv-title">Level 1<br/>
					<div class="course-indiv-image">
						<img src="<?php bloginfo('template_url'); ?>/images/course/level1-icon.png" class="inherit" alt=""/>
					</div>
					<span>Beginner</span>
				</div>
			</div>
			<div class="course-indiv-bottom">
				<?php if($payment->checkUserStatus($current_user->ID, 1)): ?>
				<a href="<?php bloginfo('url');?>/courses/level-1-beginner/">
				<div class="course-subscribed-btn">
					Subscribed
				</div>
				</a>
				<?php else: ?>
				<a href="<?php bloginfo('url');?>/payment/">
				<div class="course-buy-btn">
					<div class="course-shop-icon"></div>
					Buy Now
				</div>
				</a>
				<?php if($loggedIn): ?>
				<a href="<?php bloginfo('url');?>/courses/level-1-beginner/">
				<?php else: ?>
				<a href="#" onclick="eng.login.showLoginBox()">
				<?php endif; ?>
				<div class="course-buy-btn" style="text-align:center; text-indent:0;">Try for free</div>
				</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="course-individual-cont-outer">
		<div class="course-individual-cont">
			<div class="course-indiv-head">
				<div class="course-indiv-title">Level 2<br/>
				<div class="course-indiv-image">
					<img src="<?php bloginfo('template_url'); ?>/images/course/level2-icon.png" alt="" class="inherit"/>
				</div>
				<span>Intermediate</span></div>
			</div>
			<div class="course-indiv-bottom">
				<?php if($payment->checkUserStatus($current_user->ID, 4)): ?>
				<a href="<?php bloginfo('url');?>/courses/level-2-intermediate/">
				<div class="course-subscribed-btn">
					Subscribed
				</div>
				</a>
				<?php else: ?>
				<a href="<?php bloginfo('url');?>/payment/">
				<div class="course-buy-btn">
					<div class="course-shop-icon"></div>
					Buy Now
				</div>
				</a>
				<?php if($loggedIn): ?>
				<a href="<?php bloginfo('url');?>/courses/level-2-intermediate/">
				<?php else: ?>
				<a href="#" onclick="eng.login.showLoginBox()">
				<?php endif; ?>
				<div class="course-buy-btn" style="text-align:center; text-indent:0;">Try for free</div>
				</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="course-individual-cont-outer">
		<div class="course-individual-cont">
			<div class="course-indiv-head">
				<div class="course-indiv-title">Level 3<br/>
				<div class="course-indiv-image">
					<img src="<?php bloginfo('template_url'); ?>/images/course/level3-icon.png" alt="" class="inherit"/>
				</div>
				<span>Advanced</span></div>
			</div>
			<div class="course-indiv-bottom">
				<?php if($payment->checkUserStatus($current_user->ID, 5)): ?>
				<a href="<?php bloginfo('url');?>/courses/level-3-advanced/">
				<div class="course-subscribed-btn">
					Subscribed
				</div>
				</a>
				<?php else: ?>
				<a href="<?php bloginfo('url');?>/payment/">
				<div class="course-buy-btn">
					<div class="course-shop-icon"></div>
					Buy Now
				</div>
				</a>
				<?php if($loggedIn): ?>
				<a href="<?php bloginfo('url');?>/courses/level-3-advanced/">
				<?php else: ?>
				<a href="#" onclick="eng.login.showLoginBox()">
				<?php endif; ?>
				<div class="course-buy-btn" style="text-align:center; text-indent:0;">Try for free</div>
				</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();