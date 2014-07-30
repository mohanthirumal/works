<?php /* Smarty version 2.6.27, created on 2014-04-22 09:52:24
         compiled from home.tpl */ ?>
		
				<div class="index-second">
					<!----------------------------------Promotions--------------------------------->
					<div class="index-promotions">
						<div id="wowslider-container1">
							<div class="ws_images">
								<ul>									
									<li><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/slider/1.jpg" alt="" title="" id="wows1_1"/></li>
									<li><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/slider/2.jpg" alt="" title="" id="wows1_2"/></li>
									<li><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/slider/3.jpg" alt="" title="" id="wows1_3"/></li>
									<li><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/slider/4.jpg" alt="" title="" id="wows1_4"/></li>
									<li><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/slider/5.jpg" alt="" title="" id="wows1_5"/></li>
								</ul>
							</div>
							<div class="ws_bullets"></div>
						</div>
						<script type="text/javascript" src="js/wowslider.js"></script>
						<script type="text/javascript" src="js/slider.js"></script>
					</div>
					<!----------------------------------Promotions--------------------------------->
					<div class="index-right1">
						<div class="clear"></div>
                      	<div id="livescore-sidebar"><div class="loading"></div></div>
					 </div>
					<div class="index-banner-tour">
						<a href="#" onclick="zeal.user.showSignin();"><img src="<?php echo $this->_tpl_vars['base_url']; ?>
images/home-index-banner.jpg" alt=""/></a>
					</div>
					<div class="index-left" id="index-research-aj" style="height:525px;">
						<div class="live-score-menu tournament-tab"></div>
						<div class="star-player-container" style="height:468px;">
						<div class="loading"></div>
						</div>
					</div>
					<div class="index-right" id="index-latest-winner"><div class="loading"></div></div>
					<div class="index-left" style="width: 605px; margin-left: 5px;">
					</div>
				</div>
				<script type="text/javascript">
				<?php echo '
				zeal.jQuery(document).ready(function($){zeal.indexPageContent.indexLivescore();});
				'; ?>

				</script>