				<div class="index-second">					
					{if isset($tournaments)}
					<div class="index-left2" style="margin:0;">
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
								{if $cookie->user_id}
								<a href="{$base_dir}create-tournament"><input type="button" class="common-btn create-tournament-btn" value="Create Tournament"/></a>
								{/if}
								<!--<div class="championship-text"><div class="champion-icon-star-header"></div> - <a href="leaderboard">Championship</a><a target="_blank" href="championship-leaderboard.php"><img src="{$base_dir}images/question_icon.png" alt="" style="margin:13px 0 0 5px;"/></a></div>-->
							</div>
							<div class="tournament-lobby-body">
								<div class="tournament-lobby-inner all-tournament">
									<div class="tournament-lobby-inner-head">
										<div class="tournament-loby-left-menu">
											<ul>
												<li class="tour-lobby-room-li" class="active" onclick="zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', 'tour-lobby-room', this)">All Tournaments</li>
												<li class="daily-tournament-li" onclick="zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', 'daily-tournament', this)">Daily</li>
												<li class="weekly-tournament-li" onclick="zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', 'weekly-tournament', this)">Weekly</li>
												<li class="series-tournament-li" onclick="zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', 'series-tournament', this)">Series</li>
												<li class="invited-li" onclick="zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', 'invited', this)">Invited</li>
												<li class="free-tournament-li" onclick="zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', 'free-tournament', this)">Free</li>
												<li class="cash-tournament-li" onclick="zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', 'cash-tournament', this)">Cash</li>
											</ul>
										</div>
									</div>
									<div class="tournament-lobby-inner-right">
									<div id="tournament">
										{foreach from=$tournaments item=match name=matches}
											{foreach from=$match item=tournament name=tournaments}
											<div class="tounament-row-cont tour-lobby-room daily-tournament{if $tournament.entryfee == 0} free-tournament{else} cash-tournament{/if}">
												<div class="tournament-row-type">
													<div class="tournament-row-type-flag">
														<div class="flag"><img src="{$tourimageurl}teamsflags/{$tournament.flag1}" alt=""></div>
														<div class="v-image-area"></div>
														<div class="flag flag-op"><img src="{$tourimageurl}teamsflags/{$tournament.flag2}" alt=""></div>
													</div>
													<div class="tour-row-type-win-text">{$tournament.prizetype}</div>
													<div class="tour-row-type-win-cash"><span class="WebRupee">Rs.</span> {$tournament.prize}</div>
												</div>
												{foreach from=$tournament.tour item=tour name=tours}
												<div class="tour-row-player-entry">
													<div class="tour-row-player-count"><span>{$tour.player}</span> Players</div>
													<div class="tour-row-player-joined">Players {$tour.reg_player}/{$tour.player}</div>
													<div class="tour-row-enrty-fee">{if $tour.amount == 0}<b>Free</b>{else}Enrty Fee <span class="WebRupee">Rs.</span>{$tour.amount}{/if}</div>
													{if $tour.tournament_id}
													{if $tour.tournament_type_id == 1}
													<a href="{$base_dir}my-team/{$tour.tournament_type_id}-type/{$tour.id}/0" class="tour-row-join-btn" >Enter</a>
													{else}
													<a href="{$base_dir}my-period-tournament-details/{$tour.tournament_type_id}-type/{$tour.id}" class="tour-row-join-btn" >Enter</a>
													{/if}
													{else}
													<div class="tour-row-join-btn tour-join-btn" rel="{$tour.id},{$tour.tournament_type_id}">Join</div>
													{/if}
												</div>
												{/foreach}
											</div>
											<div class="clear"></div>
											{/foreach}
										{/foreach}
										<div class="clear"></div>
										{foreach from=$weeklyTournaments item=match name=matches}
											{foreach from=$match item=tournament name=tournaments}
											<div class="tounament-row-cont tour-lobby-room {if $tournament.type == 5 || $tournament.type == 7} weekly-tournament{else} series-tournament{/if}{if $tournament.entryfee == 0} free-tournament{else} cash-tournament{/if}">
												<div class="tournament-row-type">
													<div class="tour-period-type-txt">{if $tournament.type == 5 || $tournament.type == 7}Weekly{elseif  $tournament.type == 6 || $tournament.type == 8}Series{/if}</div>
													<div class="tour-row-type-win-text">{$tournament.prizetype}</div>
													<div class="tour-row-type-win-cash"><span class="WebRupee">Rs.</span> {$tournament.prize}</div>
												</div>
												{foreach from=$tournament.tour item=tour name=tours}
												<div class="tour-row-player-entry">
													<div class="tour-row-player-count"><span>{$tour.player}</span> Players</div>
													<div class="tour-row-player-joined">Players {$tour.reg_player}/{$tour.player}</div>
													<div class="tour-row-enrty-fee">{if $tour.amount == 0}<b>Free</b>{else}Entry Fee <span class="WebRupee">Rs.</span>{$tour.amount}{/if}</div>
													{if $tour.pt_id}
													<a href="{$base_dir}my-period-tournament-details/{$tour.tournament_type_id}-type/{$tour.id}" class="tour-row-join-btn" >Enter</a>
													{else}
													<div class="tour-row-join-btn tour-join-btn" rel="{$tour.id},{$tour.tournament_type_id}">Join</div>
													{/if}
												</div>
												{/foreach}
											</div>
											<div class="clear"></div>
											{/foreach}
										{/foreach}
									</div>
									<div id="usertournament">
										{foreach from=$usertournaments item=match name=matches}
											{foreach from=$match item=tournament name=tournaments}
											<div class="tounament-row-cont tour-lobby-room daily-tournament{if $tournament.entryfee == 0} free-tournament{else} cash-tournament{/if} invited">
												<div class="tournament-row-type">
													<div class="tournament-row-type-flag">
														<div class="flag"><img src="{$tourimageurl}teamsflags/{$tournament.flag1}" alt=""></div>
														<div class="v-image-area"></div>
														<div class="flag flag-op"><img src="{$tourimageurl}teamsflags/{$tournament.flag2}" alt=""></div>
													</div>
													<div class="tour-row-type-win-text">{$tournament.prizetype}</div>
													<div class="tour-row-type-win-cash"><span class="WebRupee">Rs.</span> {$tournament.prize}</div>
												</div>
												{foreach from=$tournament.tour item=tour name=tours}
												<div class="tour-row-player-entry">
													<div class="tour-row-player-count"><span>{$tour.player}</span> Players</div>
													<div class="tour-row-player-joined">Players {$tour.reg_player}/{$tour.player}</div>
													<div class="tour-row-enrty-fee">Entry Fee <span class="WebRupee">Rs.</span>{$tour.amount}</div>
													{if $tour.tournament_id}
													{if $tour.tournament_type_id == 1}
													<a href="{$base_dir}my-team/{$tour.tournament_type_id}-type/{$tour.id}/0" class="tour-row-join-btn" >Enter</a>
													{else}
													<a href="{$base_dir}my-period-tournament-details/{$tour.tournament_type_id}-type/{$tour.id}" class="tour-row-join-btn" >Enter</a>
													{/if}
													{else}
													<div class="tour-row-join-btn tour-join-btn" rel="{$tour.id},{$tour.tournament_type_id}">Join</div>
													{/if}
												</div>
												{/foreach}
											</div>
											<div class="clear"></div>
											{/foreach}
										{/foreach}
										<div class="clear"></div>
										{foreach from=$userweeklytournaments item=match name=matches}
											{foreach from=$match item=tournament name=tournaments}
											<div class="tounament-row-cont tour-lobby-room {if $tournament.type == 5 || $tournament.type == 7} weekly-tournament{else} series-tournament{/if} invited">
												<div class="tournament-row-type">
													<div class="tour-period-type-txt">{if $tournament.type == 5 || $tournament.type == 7}Weekly{elseif  $tournament.type == 6 || $tournament.type == 8}Series{/if}</div>
													<div class="tour-row-type-win-text">{$tournament.prizetype}</div>
													<div class="tour-row-type-win-cash"><span class="WebRupee">Rs.</span> {$tournament.prize}</div>
												</div>
												{foreach from=$tournament.tour item=tour name=tours}
												<div class="tour-row-player-entry">
													<div class="tour-row-player-count"><span>{$tour.player}</span> Players</div>
													<div class="tour-row-player-joined">Players {$tour.reg_player}/{$tour.player}</div>
													<div class="tour-row-enrty-fee">Entry Fee <span class="WebRupee">Rs.</span>{$tour.amount}</div>
													{if $tour.pt_id}
													<a href="{$base_dir}my-period-tournament-details/{$tour.tournament_type_id}-type/{$tour.id}" class="tour-row-join-btn" >Enter</a>
													{else}
													<div class="tour-row-join-btn tour-join-btn" rel="{$tour.id},{$tour.tournament_type_id}">Join</div>
													{/if}
												</div>
												{/foreach}
											</div>
											<div class="clear"></div>
											{/foreach}
										{/foreach}
										</div>
										</div>
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
											<div class="tournament-loby-left-menu">
												<ul>
													<li class="active" onclick="zeal.tournament.showTournament('my-tournament', 'index-lobby-room', 'index-lobby-room', this)">All Tournaments</li>
													<li onclick="zeal.tournament.showTournament('my-tournament', 'index-lobby-room', 'daily-tournament', this)">Daily</li>
													<li onclick="zeal.tournament.showTournament('my-tournament', 'index-lobby-room', 'weekly-tournament', this)">Weekly</li>
													<li onclick="zeal.tournament.showTournament('my-tournament', 'index-lobby-room', 'series-tournament', this)">Series</li>
												</ul>
											</div>
										</div>
										<div class="tournament-lobby-inner-right">
											<div class="tournament-lobby-inner-head-title">
												<ul>
													<li class="extra-large">Tournament Name</li>
													<li class="large">Type</li>
													<li class="large">Entry fee</li>
													<li class="large">Players</li>
													<li class="large">Prizes</li>
													<li class="small">Rank</li>
													<li class="extra-large">Start time ( IST )</li>
												</ul>
											</div>
											<div id="my-tournament">
												{foreach from=$mytournaments item=tournament name=weeklyTournaments}
												<div class="index-lobby-room my-tour-indi{if $tournament.status == 'Completed'} compl-tour{/if}{if $tournament.status == 'Destroyed'} destr-tour{/if}{if $tournament.tournament_type_id == 1 || $tournament.tournament_type_id == 3} daily-tournament{elseif $tournament.tournament_type_id == 5 || $tournament.tournament_type_id == 7} weekly-tournament{else} series-tournament{/if}">
													<div class="divider"></div>
													<div class="extra-large"{if $tournament.name|count_characters:true > 23} style="line-height:25px;"{/if}>{$tournament.name}</div>
													<div class="divider"></div>
													<div class="large">{if $tournament.tournament_type_id == 1 || $tournament.tournament_type_id == 3} Daily{elseif $tournament.tournament_type_id == 5 || $tournament.tournament_type_id == 7} Weekly{else} Series{/if}</div>
													<div class="divider"></div>
													<div class="large"><span class="WebRupee">Rs.</span>{$tournament.amount}</div>
													<div class="divider"></div>
													<div class="large">{$tournament.reg_player}/{$tournament.player}</div>
													<div class="divider"></div>
													<div class="large"><span class="WebRupee">Rs.</span>{$tournament.prize}</div>
													<div class="divider"></div>
													<div class="small">{if $tournament.position == 0}NA{else}{$tournament.position}{/if}</div>
													<div class="divider"></div>
													<div class="extra-large">{$tournament.endtime|date_format:'%a %R %b %e'}</div>
													<div class="divider"></div>
													<div class="medium">
													{if $tournament.status == 'Destroyed'}
														<b>{$tournament.status}</b>
													{else}
														{if $tournament.tournament_type_id == 1}
														<a href="{$base_dir}my-team/{$tournament.tournament_type_id}-type/{$tournament.id}/0" class="lobby-join" >Enter</a>
														{else}
														<a href="{$base_dir}my-period-tournament-details/{$tournament.tournament_type_id}-type/{$tournament.id}" class="lobby-join" >Enter</a>
														{/if}
													{/if}
													</div>
												</div>
												{/foreach}
											</div>
											<div class="loading hide tournament-loader"></div>
											<a class="my-tournament-more-link" href="javascript:zeal.tournament.getOlderTournaments()">More....</a>
										</div>
									</div>
							
								<div class="view-all-tour-btn"></div>
							</div>
						</div>
						<!----------------------------------------------- Tournament : Ends ------------------------------------------------>
						{/if}
					</div>
					{/if}
				</div>
				<script type="text/javascript">
				var matchservertime = new Date({$now|date_format:'%Y'}, {$now|date_format:'%m'}-1, {$now|date_format:'%d'}, {$now|date_format:'%H'}, {$now|date_format:'%M'}, {$now|date_format:'%S'});
				{if $nextMatch.match_date}
				zeal.tournament.nextMatchTime({$nextMatch.match_date|date_format:'%Y'}, {$nextMatch.match_date|date_format:'%m'}, {$nextMatch.match_date|date_format:'%d'}, {$nextMatch.match_date|date_format:'%H'}, {$nextMatch.match_date|date_format:'%M'}, {$nextMatch.match_date|date_format:'%S'});
				{/if}
				{literal}
				if(typeof(EventSource) != "undefined")
				{
					var source = new EventSource("dynamic-tournament.php");
					source.onmessage = function(event)
					{
						document.getElementById("tournament").innerHTML = JSON.parse(event.data);
						zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', zeal.tournament.activeTournament);
					};
				}
				{/literal}
				</script>
<!-- Facebook Conversion Code for tournament page views -->
<script type="text/javascript">
{literal}
var fb_param = {};
fb_param.pixel_id = '6013414704510';
fb_param.value = '0.00';
fb_param.currency = 'USD';
(function(){
  var fpw = document.createElement('script');
  fpw.async = true;
  fpw.src = '//connect.facebook.net/en_US/fp.js';
  var ref = document.getElementsByTagName('script')[0];
  ref.parentNode.insertBefore(fpw, ref);
})();
{/literal}
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/offsite_event.php?id=6013414704510&amp;value=0&amp;currency=USD" /></noscript>
