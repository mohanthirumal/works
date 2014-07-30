		
				<div class="index-second">
					<!----------------------------------Promotions--------------------------------->
					<div class="index-promotions">
						<div id="wowslider-container1">
							<div class="ws_images">
								<ul>									
									<li><img src="{$base_dir}images/slider/1.jpg" alt="" title="" id="wows1_1"/></li>
									<li><img src="{$base_dir}images/slider/2.jpg" alt="" title="" id="wows1_2"/></li>
									<li><img src="{$base_dir}images/slider/3.jpg" alt="" title="" id="wows1_3"/></li>
									<li><img src="{$base_dir}images/slider/4.jpg" alt="" title="" id="wows1_4"/></li>
									<li><img src="{$base_dir}images/slider/5.jpg" alt="" title="" id="wows1_5"/></li>
									<li><img src="{$base_dir}images/slider/6.jpg" alt="" title="" id="wows1_6"/></li>
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
					{if isset($tournaments)}
					<div class="index-left2">
						<div class="tournament-lobby-head">
							<div class="tournament-lobby-title">Tournaments</div>
							{if $nextMatch.match_date}
							<div class="next-starts-in">
								<div class="next-match-start-text">Next match starts in<div class="next-starts-in-counter" id="next-starts-in"></div></div>
							</div>
							<div class="tournament-match-flag">
								<div class="flag"><img src="{$tourimageurl}teamsflags/{$nextMatch.t1flag}" alt=""></div>
								<div class="v-image-area"></div>
								<div class="flag flag-op"><img src="{$tourimageurl}teamsflags/{$nextMatch.t2flag}" alt=""></div>
							</div>
							{/if}
							<!--<div class="championship-text"><div class="champion-icon-star-header"></div> - <a href="leaderboard">Championship</a><a target="_blank" href="championship-leaderboard.php"><img src="{$base_dir}images/question_icon.png" alt="" style="margin:13px 0 0 5px;"/></a></div>-->
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
					{/if}
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
							<script>{literal}!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");{/literal}</script>
						</div>
					</div>
					<div class="index-left" style="width: 605px; margin-left: 5px;">
					</div>
				</div>
				<script>setTimeout("zeal.index.getSidebarScore();", refreshInterval);</script>
				<script type="text/javascript">
				var matchservertime = new Date({$now|date_format:'%Y'}, {$now|date_format:'%m'}-1, {$now|date_format:'%d'}, {$now|date_format:'%H'}, {$now|date_format:'%M'}, {$now|date_format:'%S'});
				{if $nextMatch.match_date}
				zeal.tournament.nextMatchTime({$nextMatch.match_date|date_format:'%Y'}, {$nextMatch.match_date|date_format:'%m'}, {$nextMatch.match_date|date_format:'%d'}, {$nextMatch.match_date|date_format:'%H'}, {$nextMatch.match_date|date_format:'%M'}, {$nextMatch.match_date|date_format:'%S'});
				{/if}
				{literal}
				zeal.jQuery(document).ready(function($){zeal.indexPageContent.indexLivescore();});
				{/literal}
				{literal}
				if(typeof(EventSource) != "undefined")
				{
					var source = new EventSource("dynamic-tournament.php");
					source.onmessage = function(event)
					{
						document.getElementById("tournament").innerHTML = JSON.parse(event.data);
						zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', zeal.tournament.activeTournament);
						var counter = 1;
						$('.tounament-row-cont').each(function(){
							if(counter > 4)
								$(this).remove();
							counter++;
						});
					};
				}
				{/literal}
				</script>