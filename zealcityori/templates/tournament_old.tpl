				<div class="index-second">					
					{if isset($tournaments)}
					<div class="index-left2">
						<div class="tournament-tab tournament-tab">
							<ul>
								<li class="active" onclick="zeal.index.showContent('tournament', 'tournament', 1, this, 'tournament-tab')">Tournaments</li>
								{if isset($mytournaments)}
								<li onclick="zeal.index.showContent('tournament', 'tournament', 2, this, 'tournament-tab')">My Tournaments</li>
								{/if}
							</ul>
						</div>
						<!----------------------------------------------- Tournament : Start ------------------------------------------------>
						<div class="tournament" id="tournament1">
							<div class="tournament-lobby-head">
								<div class="tournament-lobby-title">Tournaments</div>
								<div class="next-starts-in">
									<div class="next-match-start-text">Next match starts in<div class="next-starts-in-counter" id="next-starts-in"></div></div>
								</div>
								<div class="championship-text"><div class="champion-icon-star-header"></div> - <a href="leaderboard">Championship</a><a target="_blank" href="championship-leaderboard.php"><img src="{$base_dir}images/question_icon.png" alt="" style="margin:13px 0 0 5px;"/></a></div>
							</div>
							<div class="tournament-lobby-body">
								<div class="tournament-lobby-inner all-tournament">
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
									<div id="tournament">
										{foreach from=$tournaments item=tournament name=tournaments}
										<div class="index-lobby-room{if $tournament.amount == 0} free-tournament{else} cash-tournament{/if}">
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
											{if $tournament.tournament_type_id == 4}
												<div class="champion-icon-star"></div>
											{/if}
											{if isset($mytournaments) && !empty($tournament.tournament_id)}
												<a class="lobby-join" href="my-team.php?id={$tournament.id}">Enter</a>
											{else}
												{if $tournament.status == 'Closed'}
												<a href="#" class="lobby-join-closed">Closed</a>
												{else}											
												<a href="#" onclick="zeal.tournament.selectTournament({$tournament.id})" class="lobby-join" >Join</a>
												{/if}
											{/if}										
											</div>
										</div>
										{/foreach}
									</div>
								</div>
								<div class="view-all-tour-btn"></div>
							</div>
						</div>
						<!----------------------------------------------- Tournament : Ends ------------------------------------------------>
						{if isset($mytournaments)}
						<!----------------------------------------------- Tournament : Start ------------------------------------------------>
						<div class="tournament" id="tournament2">
							<div class="tournament-lobby-head">
								<div class="tournament-lobby-title">My Tournaments</div>
								<div class="next-starts-in"></div>
							</div>
							<div class="tournament-lobby-body">
								<div class="tournament-lobby-inner my-tournament">
									<div class="tournament-lobby-inner-head">
										<div class="live-score-menu">
											<ul>
												<li class="active" onclick="zeal.tournament.showTournament('my-tournament', 'index-lobby-room', 'index-lobby-room', this)">All</li>												
												<li onclick="zeal.tournament.showTournament('my-tournament', 'index-lobby-room', 'cash-tournament', this)">Cash</li>
												<li onclick="zeal.tournament.showTournament('my-tournament', 'index-lobby-room', 'free-tournament', this)">Free</li>
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
											<li class="medium">Status</li>
										</ul>
									</div>
									{foreach from=$mytournaments item=tournament name=tournaments}
									<div class="index-lobby-room{if $tournament.amount == 0} free-tournament{else} cash-tournament{/if}">
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
										<div class="large">{$tournament.status}</div>
										<div class="divider"></div>
										<div class="medium"><a class="lobby-join" href="my-team/{$tournament.id}">Enter</a></div>
									</div>
									{/foreach}								
								</div>
								<div class="view-all-tour-btn"></div>
							</div>
						</div>
						<!----------------------------------------------- Tournament : Ends ------------------------------------------------>
						{/if}
					</div>
					{/if}					
					<div class="index-right1"> 						
						<div class="clear"></div>
   						<div class="live-score-widjet">
							<div class="live-score-menu">
								<ul>
									<li class="active">My Tournaments</li>
								</ul>
							</div>
                            <div class="inner-menu-bg">
                                 <div class="innermenu-name" style="width:80px;">Name</div>
                                 <div class="innermenu-myteampoints">Status</div>
                           </div>						   
						   <div class="mytournament-right-list" style="height:220px; float:left;">
						   {if isset($mytournaments)}
						   	{foreach from=$mytournaments5 item=tournament name=tournaments}
	                           <div class="table-body-valus">
                                    <div class="tour-name">{$tournament.name}</div>
                                    <div class="tour-points">{$tournament.reg_player}/{$tournament.player}</div>
                                    <div class="tour-rank">{$tournament.status}</div> 
                                    <div class="enter-but-bg">
										<a class="enter-but" href="my-team/{$tournament.id}">Enter</a>
									</div>
                               </div>	
							{/foreach}
							{else}
								<div class="match-score-indi" style="height:80px; line-height:80px; text-align:center;">
								<b>No Tournament</b>
								</div>
							{/if}
                           </div>
							<div class="match-score-indi even last">{if isset($mytournaments)}<input type="button" class="more score-more" value="MORE" onclick="zeal.index.showContent('tournament', 'tournament', 2, this, 'tournament-tab')"/>{/if}</div>
						</div>
                    </div>
                    <!-- My Tournmanet right new window End  -->				                        
                    <div class="index-right1">   
						<div id="livescore-sidebar">{$LIVESCORESIDEBAR}</div>
					</div>
					<!--<div class="index-left">
						<div class="index-discursion">
							<div class="live-score-menu">
								<ul>
									<li class="active">News</li>
									<li>Research</li>
									<li>Discussions</li>
									<li>Blogs</li>
								</ul>
							</div>
							<div class="index-discussion-tab">
								<div class="index-discussion-tab-inner">
									<div class="star-player"></div>
									<div>Star Players</div>
								</div>
								<div class="index-discursion-divider"></div>
								<div class="index-discussion-tab-inner pitch-condition-tab">
									<div class="pitch-condition"></div>
									<div>Pitch Condition</div>
								</div>
								<div class="index-discursion-divider"></div>
								<div class="index-discussion-tab-inner weather-report-tab">
									<div class="weather-report"></div>
									<div>Weather Report</div>
								</div>
								<div class="index-discursion-divider"></div>
								<div class="index-discussion-tab-inner head-to-head-tab">
									<div class="head-to-head"></div>
									<div>Weather Report</div>
								</div>
								<div class="index-discursion-divider"></div>
								<div class="index-discussion-tab-inner weather-report-tab">
									<div class="previous-matches"></div>
									<div>Previous Matches</div>
								</div>
							</div>
							<div class="row-divider"></div>
							<div class="star-player-container">
								<div class="star-player-image">
									<img src="images/photo_1.jpg" alt=""/>
								</div>
								<div class="star-player-desc">Clarke's decision to play in india</div>
							</div>
							<div class="row-divider"></div>
							<div class="star-player-container">
								<div class="star-player-image">
									<img src="images/photo_1.jpg" alt=""/>
								</div>
								<div class="star-player-desc">Clarke's decision to play in india</div>
							</div>
							<div class="row-divider"></div>
							<div class="star-player-container">
								<div class="star-player-image">
									<img src="images/photo_1.jpg" alt=""/>
								</div>
								<div class="star-player-desc">Clarke's decision to play in india</div>
							</div>
							<div class="row-divider"></div>
							<div class="star-player-container">
								<input type="button" class="more score-more" value="MORE"  style="margin-bottom:10px;"/>
							</div>
						</div>
					</div>-->
					<div class="index-right">
						{$LATESTWINNER}						
					</div>
				</div>
				<script>setTimeout("zeal.index.getSidebarScore();", refreshInterval);</script>
				<script type="text/javascript">
				var matchservertime = new Date({$now|date_format:'%Y'}, {$now|date_format:'%m'}, {$now|date_format:'%d'}, {$now|date_format:'%H'}, {$now|date_format:'%M'}, {$now|date_format:'%S'});
				zeal.tournament.nextMatchTime({$nextMatch|date_format:'%Y'}, {$nextMatch|date_format:'%m'}, {$nextMatch|date_format:'%d'}, {$nextMatch|date_format:'%H'}, {$nextMatch|date_format:'%M'}, {$nextMatch|date_format:'%S'});
				{literal}
				if(typeof(EventSource) != "undefined")
				{
					var source = new EventSource("dynamic-tournament.php");
					source.onmessage = function(event)
					{
						document.getElementById("tournament").innerHTML = JSON.parse(event.data);
						zeal.tournament.showTournament('all-tournament', 'index-lobby-room', zeal.tournament.activeTournament);
					};
				}
				{/literal}
				</script>