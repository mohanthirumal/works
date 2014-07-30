		
				<div class="index-second">
					<!----------------------------------Promotions--------------------------------->
					<div class="index-promotions">
						<div id="wowslider-container1">
							<div class="ws_images">
								<ul>									
									<li><img src="{$base_dir}images/slider/screenshot_1.jpg" alt="screenshot 1" title="" id="wows1_1"/></li>
									<li><img src="{$base_dir}images/slider/screenshot_2.jpg" alt="screenshot 2" title="" id="wows1_2"/></li>
									<li><img src="{$base_dir}images/slider/rocking.jpg" alt="screenshot 3" title="" id="wows1_3"/></li>
									<li><img src="{$base_dir}images/slider/screenshot_4.jpg" alt="screenshot 4" title="" id="wows1_4"/></li>
									<li><img src="{$base_dir}images/slider/tri-nation-tournament2.jpg" alt="screenshot 5" title="" id="wows1_0"/></li>
									<li><img src="{$base_dir}images/slider/screenshot_6.jpg" alt="screenshot 6" title="" id="wows1_5"/></li>
								</ul>
							</div>
							<div class="ws_bullets">
								<div>									
									<a href="#" title=""><img src="{$base_dir}images/slider/tooltips/screenshot_1.jpg" alt="screenshot 1"/>1</a>
									<a href="#" title=""><img src="{$base_dir}images/slider/tooltips/screenshot_2.jpg" alt="screenshot 2"/>2</a>
									<a href="#" title=""><img src="{$base_dir}images/slider/tooltips/rocking.jpg" alt="screenshot 3"/>3</a>
									<a href="#" title=""><img src="{$base_dir}images/slider/tooltips/screenshot_4.jpg" alt="screenshot 4"/>4</a>
									<a href="#" title=""><img src="{$base_dir}images/slider/tooltips/tri-nation-tournament2.jpg" alt="screenshot 5"/>5</a>
									<a href="#" title=""><img src="{$base_dir}images/slider/tooltips/screenshot_6.jpg" alt="screenshot 6"/>6</a>
								</div>
							</div>
						</div>
						<script type="text/javascript" src="js/wowslider.js"></script>
						<script type="text/javascript" src="js/slider.js"></script>
					</div>
					<!----------------------------------Promotions--------------------------------->
					<div class="index-right1">
						<!--<div class="jackpot-ads"></div>
						<a href="#" onclick="zeal.user.showSignin();">
						<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="351px" height="66px">
							<param name="movie" value="{$base_dir}images/deposit_ad.swf" />
							<param name="quality" value="high" />
							<param name="scale" value="noScale" />
							<param name="wmode" value="transparent">
							<param name="bgcolor" value="#000" />
							<embed src="{$base_dir}images/deposit_ad.swf" quality="high" bgcolor="#000" width="351px" height="66px" wmode="transparent" align="middle" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
						</object>
						</a>-->
						<div class="clear"></div>
                      	<div id="livescore-sidebar">{$LIVESCORESIDEBAR}</div>
					 </div>
					{if isset($tournaments)}
					<div class="index-left2">
						<div class="tournament-lobby-head">
							<div class="tournament-lobby-title">Tournaments</div>
							<div class="next-starts-in">
								<div class="next-match-start-text">Next match starts in<div class="next-starts-in-counter" id="next-starts-in"></div></div>
							</div>
							<div class="championship-text"><div class="champion-icon-star-header"></div> - <a href="leaderboard">Championship</a><a target="_blank" href="championship-leaderboard.php"><img src="{$base_dir}images/question_icon.png" alt="" style="margin:13px 0 0 5px;"/></a></div>
						</div>
						<div class="tournament-lobby-body">
							<div class="tournament-lobby-inner all-tournament" style="height:275px">
								<div class="tournament-lobby-inner-head">
									<div class="live-score-menu">
										<ul>
											<li class="active" onclick="zeal.tournament.showTournament('all-tournament', 'index-lobby-room', 'index-lobby-room', this)">All</li>
											<li onclick="zeal.tournament.showTournament('all-tournament', 'index-lobby-room', 'cash-tournament', this)">Cash</li>
											<li onclick="zeal.tournament.showTournament('all-tournament', 'index-lobby-room', 'free-tournament', this)">Free</li>
										</ul>
									</div>
								</div>
								<div class="tournament-lobby-inner-head-title">
									<ul>
										<li class="large">Date</li>
										<li class="extra-large">Match</li>
										<li class="medium">Type</li>
										<li class="large">End Time</li>
										<li class="medium">Players</li>
										<li class="medium">Entry</li>
										<li class="large">Prize</li>
									</ul>
								</div>
                                <img src="{$base_dir}images/tri-series.jpg" alt="" width="593px" height="215px" />
								{foreach from=$tournaments item=tournament name=tournaments}							
								<div class="index-lobby-room{if $smarty.foreach.tournaments.last} border{/if}{if $tournament.amount == 0} free-tournament{else} cash-tournament{/if}">
									<div class="divider"></div>
									<div class="large">{$tournament.endtime|date_format:'%d-%m-%Y'}</div>
									<div class="divider"></div>
									<div class="extra-large teamflag">
										<img src="{$tourimageurl}teamsflags/{$tournament.team1flag}" alt=""/>
										<img src="{$tourimageurl}teamsflags/{$tournament.team2flag}" alt=""/><br/>
										{$tournament.team1} Vs {$tournament.team2}
									</div>
									<div class="divider"></div>
									<div class="medium">{$tournament.type}</div>
									<div class="divider"></div>
									<div class="large">{$tournament.endtime|date_format:'%T'}</div>
									<div class="divider"></div>
									<div class="medium">{$tournament.reg_player}/{$tournament.player}</div>
									<div class="divider"></div>
									<div class="medium"><span class="WebRupee">Rs.</span>{$tournament.amount}</div>
									<div class="divider"></div>
									<div class="large prize-money"><span class="WebRupee">Rs.</span>{$tournament.tour_detail->prize_pool->prize[1]}</div>
									<div class="divider"></div>
									<div class="medium">
										{if $tournament.tournament_type_id == 5}
											<div class="champion-icon-star"></div>
										{/if}
										{if $tournament.status == 'Closed'}
										<a href="#" class="lobby-join-closed">Closed</a>
										{else}
										<a href="#" onclick="zeal.tournament.selectTournament({$tournament.id})" class="lobby-join" >Join</a>
										{/if}
									</div>
								</div>
								{/foreach}
							</div>
							<div class="view-all-tour-btn"><a href="tournament.php">View All Tournaments</a></div>
						</div>
					</div>
					{/if}
					<div class="index-right">
						<div class="index-intro-video">
							<a class="twitter-timeline"  href="https://twitter.com/zealcity" width="350" height="346" data-widget-id="329560804443693056">Tweets by @zealcity</a>
							<script>{literal}!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");{/literal}</script>
						</div>
					</div>
					<div class="index-left">
						{$INDEXCONTENT}
					</div>
					<div class="index-right">
					{$LATESTWINNER}						
					</div>
					<!--<div class="index-left">
						<div class="star-player-purchase">
							<div class="star-player-title">Stars</div>
							<div class="star-player-indi">
								<div class="star-player-indi-image"><img src="images/photo_2.jpg" alt=""/></div>
								<div class="star-player-name">Sachin Tendulkar</div>
								<div class="star-player-points">Points: 7500</div>
								<div class="star-player-purchase-money">50000</div>
								<div class="star-player-purchase-desc">Loren ipdum upsdtar karatre tareyr parehota apne hoda hoom Loren ipdum upsdtar karatre tareyr</div>
							</div>
							<div class="star-player-indi">
								<div class="star-player-indi-image"><img src="images/photo_2.jpg" alt=""/></div>
								<div class="star-player-name">Sachin Tendulkar</div>
								<div class="star-player-points">Points: 7500</div>
								<div class="star-player-purchase-money">50000</div>
								<div class="star-player-purchase-desc">Loren ipdum upsdtar karatre tareyr parehota apne hoda hoom Loren ipdum upsdtar karatre tareyr</div>
							</div>
							<div class="star-player-indi">
								<div class="star-player-indi-image"><img src="images/photo_2.jpg" alt=""/></div>
								<div class="star-player-name">Sachin Tendulkar</div>
								<div class="star-player-points">Points: 7500</div>
								<div class="star-player-purchase-money">50000</div>
								<div class="star-player-purchase-desc">Loren ipdum upsdtar karatre tareyr parehota apne hoda hoom Loren ipdum upsdtar karatre tareyr</div>
							</div>
							<div class="star-player-indi last">
								<div class="star-player-indi-image"><img src="images/photo_2.jpg" alt=""/></div>
								<div class="star-player-name">Sachin Tendulkar</div>
								<div class="star-player-points">Points: 7500</div>
								<div class="star-player-purchase-money">50000</div>
								<div class="star-player-purchase-desc">Loren ipdum upsdtar karatre tareyr parehota apne hoda hoom Loren ipdum upsdtar karatre tareyr</div>
							</div>
						</div>
					</div>
					<div class="index-right">
						<div class="poll-container"></div>
					</div>-->
				</div>
				<script>setTimeout("zeal.index.getSidebarScore();", refreshInterval);</script>
				<script type="text/javascript">
				var matchservertime = new Date({$now|date_format:'%Y'}, {$now|date_format:'%m'}, {$now|date_format:'%d'}, {$now|date_format:'%H'}, {$now|date_format:'%M'}, {$now|date_format:'%S'});
				zeal.tournament.nextMatchTime({$nextMatch|date_format:'%Y'}, {$nextMatch|date_format:'%m'}, {$nextMatch|date_format:'%d'}, {$nextMatch|date_format:'%H'}, {$nextMatch|date_format:'%M'}, {$nextMatch|date_format:'%S'});
				</script>