<?php /* Smarty version 2.6.27, created on 2014-07-10 11:58:57
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'index.tpl', 84, false),)), $this); ?>
		
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
									<li><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/slider/6.jpg" alt="" title="" id="wows1_6"/></li>
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
					<?php if (isset ( $this->_tpl_vars['tournaments'] )): ?>
					<div class="index-left2">
						<div class="tournament-lobby-head">
							<div class="tournament-lobby-title">Tournaments</div>
							<?php if ($this->_tpl_vars['nextMatch']['match_date']): ?>
							<div class="next-starts-in">
								<div class="next-match-start-text">Next match starts in<div class="next-starts-in-counter" id="next-starts-in"></div></div>
							</div>
							<div class="tournament-match-flag">
								<div class="flag"><img src="<?php echo $this->_tpl_vars['tourimageurl']; ?>
teamsflags/<?php echo $this->_tpl_vars['nextMatch']['t1flag']; ?>
" alt=""></div>
								<div class="v-image-area"></div>
								<div class="flag flag-op"><img src="<?php echo $this->_tpl_vars['tourimageurl']; ?>
teamsflags/<?php echo $this->_tpl_vars['nextMatch']['t2flag']; ?>
" alt=""></div>
							</div>
							<?php endif; ?>
							<!--<div class="championship-text"><div class="champion-icon-star-header"></div> - <a href="leaderboard">Championship</a><a target="_blank" href="championship-leaderboard.php"><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/question_icon.png" alt="" style="margin:13px 0 0 5px;"/></a></div>-->
						</div>
						<div class="tournament-lobby-body">
                        	<div class="tournament-lobby-inner all-tournament" style="height: auto;">
                                <div class="tournament-lobby-inner-head">
                                    <div class="tournament-loby-left-menu">
                                        <ul>
											<li class="tour-lobby-room-li" class="active" onclick="zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', 'tour-lobby-room', this)">All Tournaments</li>
											<li class="daily-tournament-li" onclick="zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', 'daily-tournament', this)">Daily</li>
											<li class="weekly-tournament-li" onclick="zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', 'weekly-tournament', this)">Weekly</li>
											<li class="series-tournament-li" onclick="zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', 'series-tournament', this)">Series</li>
											<li class="free-tournament-li" onclick="zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', 'free-tournament', this)">Free</li>
											<li class="cash-tournament-li" onclick="zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', 'cash-tournament', this)">Cash</li>
										</ul>
                                    </div>
                                </div>
                                <div class="tournament-lobby-inner-right">
									<div id="tournament">
									</div>
                                    
                                </div>
                            </div>
							<div class="view-all-tour-btn"><a href="tournament.php" style="color:#FFFFFF;">View All Tournaments</a></div>
						</div>
					</div>
					<?php endif; ?>
					<div class="index-left" id="index-research-aj" style="height:525px;">
						<div class="live-score-menu tournament-tab"></div>
						<div class="star-player-container" style="height:468px;">
						<div class="loading"></div>
						</div>
					</div>
					<div class="index-right" id="index-latest-winner"><div class="loading"></div></div>
                    <div class="index-right">
						<div class="index-intro-video">
							<a class="twitter-timeline"  href="https://twitter.com/zealcity" width="350" height="350" data-widget-id="329560804443693056">Tweets by @zealcity</a>
							<script><?php echo '!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");'; ?>
</script>
						</div>
					</div>
					<div class="index-left" style="width: 605px; margin-left: 5px;">
					</div>
				</div>
				<script>setTimeout("zeal.index.getSidebarScore();", refreshInterval);</script>
				<script type="text/javascript">
				var matchservertime = new Date(<?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y') : smarty_modifier_date_format($_tmp, '%Y')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%m') : smarty_modifier_date_format($_tmp, '%m')); ?>
-1, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d') : smarty_modifier_date_format($_tmp, '%d')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H') : smarty_modifier_date_format($_tmp, '%H')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%M') : smarty_modifier_date_format($_tmp, '%M')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%S') : smarty_modifier_date_format($_tmp, '%S')); ?>
);
				<?php if ($this->_tpl_vars['nextMatch']['match_date']): ?>
				zeal.tournament.nextMatchTime(<?php echo ((is_array($_tmp=$this->_tpl_vars['nextMatch']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y') : smarty_modifier_date_format($_tmp, '%Y')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['nextMatch']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%m') : smarty_modifier_date_format($_tmp, '%m')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['nextMatch']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d') : smarty_modifier_date_format($_tmp, '%d')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['nextMatch']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H') : smarty_modifier_date_format($_tmp, '%H')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['nextMatch']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%M') : smarty_modifier_date_format($_tmp, '%M')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['nextMatch']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%S') : smarty_modifier_date_format($_tmp, '%S')); ?>
);
				<?php endif; ?>
				<?php echo '
				zeal.jQuery(document).ready(function($){zeal.indexPageContent.indexLivescore();});
				'; ?>

				<?php echo '
				if(typeof(EventSource) != "undefined")
				{
					var source = new EventSource("dynamic-tournament.php");
					source.onmessage = function(event)
					{
						document.getElementById("tournament").innerHTML = JSON.parse(event.data);
						zeal.tournament.showTournament(\'all-tournament\', \'tour-lobby-room\', zeal.tournament.activeTournament);
						var counter = 1;
						$(\'.tounament-row-cont\').each(function(){
							if(counter > 4)
								$(this).remove();
							counter++;
						});
					};
				}
				'; ?>

				</script>