<?php
/**
 * Template Name: Game Zone Page Template
 *
 * Description: Course page contains chapters of that course
 */
 get_header();
 ?>
 <div class="page-content aboutus">
 	<img src="<?php bloginfo('template_url');?>/images/gamezone-banner.jpg" alt="" class="teachers-banner"/>
	<div class="left-container">
		<div class="sidebar1 column2" style="height:515px;">
			<div class="sidebar1-title trebuchet title">GAME ZONE</div>
			<div class="sidebar1-content">
			Welcome to the Game Zone, the place to spend your time usefully and have fun as well! Here are a few games to get you started.
			<p></p>
			<ul>
				<li><a href="#" onclick="eng.games.showGame(1);" >Hangman</a></li>
				<li><a href="#" onclick="eng.games.showGame(2);" >Word Search</a></li>
				<li><a href="#" onclick="eng.games.showGame(4);" >Trivia Quiz</a></li>
				<!--<li><a href="#" onclick="eng.games.showGame(3);" >Pronunciation Tool</a></li>-->
			</ul>
			</div>
		</div>
	</div>
	<div class="right-container">
		<div class="title1 trebuchet">Game Zone</div>
		<div class="clear"></div>
		Welcome to the Game Zone, the place to spend your time usefully and have fun as well! Here are a few games to get you started.
		<p></p>
		<img src="<?php bloginfo('template_url');?>/images/hangman.jpg" alt="" class="content-image"/>
		<div class="column-right-container">
			<div class="sub-title1" style="margin:0;">Hangman</div>
			<div class="clear"></div>
			Guess the missing words with the given chances. You will be tested across levels on word meaning and usage.You get one over before it's game over!<br/><br/>
			<a href="#" onclick="eng.games.showGame(1);" class="play-now">Play Now</a>
		</div>
		<div class="game-zone-dotted"></div>
		<img src="<?php bloginfo('template_url');?>/images/wordsearch.jpg" alt="" class="content-image"/>
		<div class="column-right-container">
			<div class="sub-title1" style="margin:0;">Word Search</div>
			<div class="clear"></div>
			Find the hidden word in the alphabet grid. The words can be written in any direction, i.e. horizontally, vertically, diagonally, forwards or backwards. Happy hunting!<br/><br/>
			<a href="#" onclick="eng.games.showGame(2);" class="play-now">Play Now</a>
		</div>
		
		<div class="game-zone-dotted"></div>
		<img src="<?php bloginfo('template_url');?>/images/trivia.jpg" alt="" class="content-image"/>
		<div class="column-right-container">
			<div class="sub-title1" style="margin:0;">Trivia Quiz</div>
			<div class="clear"></div>
			Test your cricketing knowledge with our fun quiz. Enjoy!<br/><br/>
			<a href="#" onclick="eng.games.showGame(4);" class="play-now">Play Now</a>
		</div>
	</div>
	<div class="game-play game-play1">
		<div class="game-play-inner" id="game1" style="width:640px;">
        	<a href="<?php bloginfo('url'); ?>/game-zone"><img class="lightbox-close"/></a>
			<object type="application/x-shockwave-flash" data="<?php bloginfo('url');?>/games/hangman-loader.swf" width="640" height="480" style="position:relative;">
				<param name="movie" value="<?php bloginfo('url');?>/games/hangman-loader.swf" />
				<param name="allowFullScreen" value="true" />
				<param name="flashVars" value="loadXml=<?php echo urlencode(get_bloginfo('template_url').'/images/games/hangman.swf?gameXml='.get_bloginfo('url').'/uploads/qAns.xml');?>" />
				<embed src="<?php bloginfo('url');?>/games/hangman-loader.swf" width="640" height="480" style="position:relative;"  flashVars="loadXml=<?php echo urlencode(get_bloginfo('template_url').'/images/games/hangman.swf?gameXml='.get_bloginfo('url').'/uploads/qAns.xml');?>" allowFullScreen="true" wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer_en" />
				<img alt="" src="" style="position:absolute;left:0;" width="640" height="480" title="Video playback is not supported by your browser" />
			</object>
		</div>
		<div class="game-play-inner" id="game2" style="width:800px">
        	<a href="<?php bloginfo('url'); ?>/game-zone"><img class="lightbox-close"/></a>
			<object type="application/x-shockwave-flash" data="<?php bloginfo('url');?>/games/at-the-wicket-loader.swf" width="800" height="600">
				<param name="movie" value="<?php bloginfo('url');?>/games/at-the-wicket-loader.swf" />
				<param name="allowFullScreen" value="true" />
				<param name="flashVars" value="loadXml=<?php echo urlencode(get_bloginfo('template_url').'/images/games/wordsearch.swf?gameXml='.get_bloginfo('url').'/uploads/wordsearch.xml');?>" />
				<embed src="<?php bloginfo('url');?>/games/at-the-wicket-loader.swf" width="800" height="600" flashVars="loadXml=<?php echo urlencode(get_bloginfo('template_url').'/images/games/wordsearch.swf?gameXml='.get_bloginfo('url').'/uploads/wordsearch.xml');?>" allowFullScreen="true" wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer_en" />
				<img alt="" src="" width="800" height="600" title="Video playback is not supported by your browser" />
			</object>
		</div>
		<div class="game-play-inner" id="game3"></div>
		<div class="game-play-inner" id="game4" style="width:600px;">
        	<a href="<?php bloginfo('url'); ?>/game-zone"><img class="lightbox-close"/></a>
			<object type="application/x-shockwave-flash" data="<?php bloginfo('url');?>/games/trivia-quiz-loader.swf" width="600" height="400" style="position:relative;">
				<param name="movie" value="<?php bloginfo('url');?>/games/trivia-quiz-loader.swf" />
				<param name="allowFullScreen" value="true" />
				<param name="flashVars" value="loadXml=<?php bloginfo('template_url');?>/images/games/trivia-quiz.swf" />
				<embed src="<?php bloginfo('url');?>/games/trivia-quiz-loader.swf" width="600" height="400" style="position:relative;"  flashVars="loadXml=<?php bloginfo('template_url');?>/images/games/trivia-quiz.swf" allowFullScreen="true" wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer_en" />
				<img alt="" src="" style="position:absolute;left:0;" width="600" height="400" title="Video playback is not supported by your browser" />
			</object>
		</div>
	</div>
 </div>
 <div class="transparent-black-container"></div>
 <?php
 get_footer();