<?php
/**
 * Template Name: Features Page Template
 *
 */
get_header();
?>
<div class="page-content teachers get-started features-page" style="height:650px;">
	<div class="features-content-container">
		<div class="center-container">
		<div class="features-content-left">
			<div class="features-left-list">
				<div class="features-list-full active" onclick="changeFeatureContent(1, this);">
					<div class="note-icon"></div>
					<div class="features-left-text" style="line-height:48px;">Content is king</div>
				</div>
				<div class="features-list-full" onclick="changeFeatureContent(2, this);">
					<div class="hand-icon"></div>
					<div class="features-left-text">Interactive learning</div>
				</div>
				<div class="features-list-full" onclick="changeFeatureContent(3, this);">
					<div class="exercise-icon"></div>
					<div class="features-left-text">Unique activities and exercises</div>
				</div>
				<div class="features-list-full" onclick="changeFeatureContent(4, this);">
					<div class="learn-icon"></div>
					<div class="features-left-text">Learn with Kris Srikkanth</div>
				</div>
				<div class="features-list-full" onclick="changeFeatureContent(5, this);">
					<div class="own-place-icon"></div>
					<div class="features-left-text">Learn at your own pace</div>
				</div>
				<div class="features-list-full" onclick="changeFeatureContent(6, this);">
					<div class="best-icon"></div>
					<div class="features-left-text">Learn from the best</div>
				</div>
			</div>
		</div>
		<div class="features-content-right">
			<div class="features-content-changer" id="features-content1" style="display:block;">
				<div class="features-right-image"><img src="<?php bloginfo('template_url'); ?>/images/features-content-is-king.jpg" alt="" class="teachers-banner"/></div>
				<div class="features-right-title trebuchet">Content is "king"</div>
				<div class="features-right-content">
					Our motto is simple "content is king" and we are here to provide you with the best learning experience on the planet. Our course content is completely unique and easy to follow. We have combined years of research to bring to you the easiest way to learn English - through the medium of Cricket.
				</div>
			</div>
			<div class="features-content-changer" id="features-content2">
				<div class="features-right-image"><img src="<?php bloginfo('template_url'); ?>/images/features-interactive-learning.jpg" alt="" class="teachers-banner"/></div>
				<div class="features-right-title trebuchet">Interactive learning</div>
				<div class="features-right-content">
					English strokes focuses on making your learning experience interactive. We make your learning as interactive as possible by providing you with what it takes to learn and master English. It doesn't matter whether you are just beginning to learn English or you have already tried other English courses, when you start learning on English strokes  you will learn what it takes to become a master in spoken English.
				</div>
			</div>
			<div class="features-content-changer" id="features-content3">
				<div class="features-right-image"><img src="<?php bloginfo('template_url'); ?>/images/feature-unique-activities.jpg" alt="" class="teachers-banner"/></div>
				<div class="features-right-title trebuchet">Unique activities and exercises</div>
				<div class="features-right-content">
					When you learn on englishstrokes.com, it's not just learning; we also allow you to "play" so that you can master all aspects of the English language, especially the finer nuances. We provide hours of special activities and games that will help you get an all-round education, allowing you to evolve like complete cricketers who have been put through their paces.
				</div>
			</div>
			<div class="features-content-changer" id="features-content4">
				<div class="features-right-image"><img src="<?php bloginfo('template_url'); ?>/images/features-learn-with- krish.jpg" alt="" class="teachers-banner"/></div>
				<div class="features-right-title trebuchet">Learn with Kris Srikkanth</div>
				<div class="features-right-content">
					When you enrol on one of our courses, you automatically get the chance to learn with Kris Srikkanth - former Indian cricket captain and chairman of selectors of the world cup winning team. Kris will take you on a remarkable journey that will not only give you the skills to learn English, but also be a great experience which will leave you wanting more.
				</div>
			</div>
			<div class="features-content-changer" id="features-content5">
				<div class="features-right-image"><img src="<?php bloginfo('template_url'); ?>/images/features-learn-at-own-pace.jpg" alt="" class="teachers-banner"/></div>
				<div class="features-right-title trebuchet">Learn at your own pace</div>
				<div class="features-right-content">
					We, unlike our competitors, do not enforce any particular time frame within which you have to complete our courses. We are here to make sure you learn English the right way. And what better way to do that than making you comfortable with our courses. You can take your time to master English. And once you've done that, go out there and beat the competition in your field.
				</div>
			</div>
			<div class="features-content-changer" id="features-content6">
				<div class="features-right-image"><img src="<?php bloginfo('template_url'); ?>/images/features-learn-from-the-best.jpg" alt="" class="teachers-banner"/></div>
				<div class="features-right-title trebuchet">Learn from the best</div>
				<div class="features-right-content">
					The British Council is the world's largest and most reputable English training institution. They have over 70 years experience in English language training, so what better way to learn than having the best of the both world's - cricket and English!
				</div>
			</div>
		</div>
		</div>
	</div>
	
</div>
<div class="features-content-mastering-button">
	<a href="<?php bloginfo('url'); ?>/payment" style="text-decoration:none; color:#000;">
		<div class="mastering-english-btn sanspro" style="margin-top:-50px;">I want to learn English</div>
	</a>
	<div class="features-what-benefits">What are the benefits?</div>
</div>
<script>
function changeFeatureContent(id, ele)
{
	eng.jQuery('.features-list-full').removeClass('active');
	eng.jQuery(ele).addClass('active');
	eng.jQuery('.features-content-changer').hide();
	eng.jQuery('#features-content'+id).show();
}
</script>
<?php
get_footer();