<?php
/**
 * Template Name: Aboutus Page Template
 *
 */
get_header();
?>
<div class="page-content teachers">
	<img src="<?php bloginfo('template_url'); ?>/images/aboutus-banner.jpg" alt="" class="teachers-banner"/>
	<div class="left-container">
		<div class="title1 trebuchet">About EnglishStrokes</div>
		<div class="clear"></div>
		<div class="sub-title1">Turn your love of Cricket into success with English! Learn English online with the help of this course brought to you by the British Council and Kris Srikkanth.</div>
		<p>English<b>Strokes</b> is designed to let you have lots of fun and learn along the way. You will find a variety of listening activities, video content, games, conversations, cricketing facts, fun tasks and language exercises. You can also listen to anecdotes from some of your favourite cricket players, learn more about their profiles and watch them in action!</p>
		<!--<img src="<?php bloginfo('template_url'); ?>/images/abouts-img1.jpg" alt="" style="float:left; margin:0 10px 0 0;"/>-->
		<p>Available at 3 levels of difficulty, English<b>Strokes</b> will help you to:</p>
		<div class="aboutus-helping-tips-cont">			
			<div class="aboutus-helping-tips">
				<img src="<?php bloginfo('template_url'); ?>/images/about-vocabulary.jpg" alt=""/>
			</div>
			Learn useful vocabulary
		</div>
		<div class="aboutus-helping-tips-cont">			
			<div class="aboutus-helping-tips">
				<img src="<?php bloginfo('template_url'); ?>/images/about-grammar.jpg" alt=""/>
			</div>
			Improve your grammar
		</div>
		<div class="aboutus-helping-tips-cont">
			<div class="aboutus-helping-tips">
				<img src="<?php bloginfo('template_url'); ?>/images/about-spoken.jpg" alt=""/>
			</div>
			Improve your spoken English
		</div>
		<div class="aboutus-helping-tips-cont">
			<div class="aboutus-helping-tips">
				<img src="<?php bloginfo('template_url'); ?>/images/about-listening.jpg" alt=""/>
			</div>
			Develop your listening skills
		</div>
		<div class="clear"></div>
		<p>English<b>Strokes</b> will help you with all your English skills. You will have a learning experience built around interesting animations, and you will have a chance to actively use and improve your listening, reading, writing and speaking skills.</p>
		
		<div class="title1 trebuchet">Meet the Gang!</div>
		<div class="clear"></div>
		You will learn English through realistic dialogues between a group of friends who are united by their love of cricket. Play the video to know more about them!
		<p></p>
		<div class="clear"></div>		
		<!--<video controls="controls" poster="<?php bloginfo('template_url');?>/images/Intro_of_Characters.jpg" width="450" height="300" title="Intro of Characters">
			<source src="<?php bloginfo('template_url');?>/images/Intro_of_Characters.m4v" type="video/mp4" />
			<source src="<?php bloginfo('template_url');?>/images/Intro_of_Characters.webm" type="video/webm" />
			<source src="<?php bloginfo('template_url');?>/images/Intro_of_Characters.ogv" type="video/ogg" />
			<source src="<?php bloginfo('template_url');?>/images/Intro_of_Characters.mp4" />
			<object type="application/x-shockwave-flash" data="<?php bloginfo('template_url');?>/images/flashfox.swf" width="450" height="300" style="position:relative;">
			<param name="movie" value="<?php bloginfo('template_url');?>/images/flashfox.swf" />
			<param name="allowFullScreen" value="true" />
			<param name="flashVars" value="controls=true&amp;fullScreenEnabled=true&amp;posterOnEnd=true&amp;loop=false&amp;poster=<?php bloginfo('template_url');?>/images/Intro_of_Characters.jpg&amp;src=Intro_of_Characters.m4v" />
			 <embed src="<?php bloginfo('template_url');?>/images/flashfox.swf" width="450" height="300" style="position:relative;"  flashVars="controls=true&amp;fullScreenEnabled=true&amp;posterOnEnd=true&amp;loop=false&amp;poster=<?php bloginfo('template_url');?>/images/Intro_of_Characters.jpg&amp;src=Intro_of_Characters.m4v"	allowFullScreen="true" wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer_en" />
			<img alt="Intro of Characters" src="<?php bloginfo('template_url');?>/images/Intro_of_Characters.jpg" style="position:absolute;left:0;" width="450" height="300" title="Video playback is not supported by your browser" />
			</object>
		</video>-->
		<div class="width-changer" style="float:left; width:450px;">
		<div id="meet-the-gang">Loading the player...</div>
		<script type="text/javascript">
			jwplayer("meet-the-gang").setup({
				width: '100%',
				height: '300',
				skin: "beelden",
				abouttext: 'EnglishStrokes.com',
				aboutlink: 'http://www.englishstrokes.com',
				logo: {
					file: '<?php bloginfo('template_url');?>/images/player-logo.png',
					link: 'http://www.englishstrokes.com',
					position: 'bottom-left'
				},
				playlist: [{
					image: "<?php bloginfo('template_url');?>/images/Intro_of_Characters.jpg",
					
					sources: [{
	
					file: "<?php bloginfo('template_url');?>/images/Intro_of_Characters.webm",
file: "<?php bloginfo('template_url');?>/images/Intro_of_Characters.mp4",
					  label: "360p SD"
					}],
					tracks: [{ 
					  file: "<?php bloginfo('url'); ?>/uploads/captions/L1U1C1.vtt",
					  kind: "captions",
					  label: "On"  
					}]
				}],
				captions: {
					back: false,
					color: 'ffffff',
					fontfamily: 'kruti',
					fontsize: 25
				}
			});
		</script>
		</div>
		<img src="<?php bloginfo('template_url'); ?>/images/meet-the-gang-img.jpg" alt="" style="margin-left:20px;"/>
		<p>You will be able to follow the characters through three levels of difficulty, and you will be supported by Kris Srikkanth all the way. This site gives you the confidence and skills you need to communicate effectively in English and help you achieve your goals and dreams!</p>
		<a href="<?php bloginfo('url'); ?>/payment" style="text-decoration:none; color:#000;">
			<div class="mastering-english-btn sanspro">I want to learn English</div>
		</a>
	</div>
	<div class="right-container">
		<div class="sidebar1 column2" style="padding-bottom:20px;">
			<div class="sidebar1-title trebuchet title">PRODUCT FEATURES</div>
			<div class="sidebar1-content">				
				English<b>Strokes</b> speeds up your learning by.
				<div class="aboutus-gang">			
			<p>1. Making you an active learner, with games, quizzes and interactive exercises.</p>
			<img src="<?php bloginfo('template_url'); ?>/images/product-featurres-1.jpg" alt=""/>
		</div>
		<div class="aboutus-gang">			
			<p>2. Keeping you entertained, with videos, animations and interviews with players.</p>
			<img src="<?php bloginfo('template_url'); ?>/images/product-featurres-2.jpg" alt=""/>
		</div>
		<div class="aboutus-gang">			
			<p>3. Finding the best exercises for you, with our &quot;At the Wicket&quot; level testing game.</p>
			<img src="<?php bloginfo('template_url'); ?>/images/product-featurres-3.jpg" alt=""/>
		</div>
		<div class="aboutus-gang">			
			<p>4. Keeping track of your progress for you, across all devices.</p>
			<img src="<?php bloginfo('template_url'); ?>/images/product-featurres-4.jpg" alt=""/>
		</div>
		<div class="aboutus-gang">
			<p>We have a wealth of online resources that can cater to your needs and make studying more accessible, allowing you to study at times that suit you and that meet the demands of your lifestyle.</p>
		</div>				
			</div>
		</div>		
	</div>
</div>
<?php
get_footer();