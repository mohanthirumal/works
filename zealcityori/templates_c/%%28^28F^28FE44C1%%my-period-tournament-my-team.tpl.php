<?php /* Smarty version 2.6.27, created on 2014-05-06 10:34:17
         compiled from my-period-tournament-my-team.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'my-period-tournament-my-team.tpl', 48, false),array('modifier', 'explode', 'my-period-tournament-my-team.tpl', 56, false),array('modifier', 'string_format', 'my-period-tournament-my-team.tpl', 56, false),array('modifier', 'date_format', 'my-period-tournament-my-team.tpl', 95, false),array('function', 'math', 'my-period-tournament-my-team.tpl', 53, false),)), $this); ?>
<div class="tournamentInfoContentClass">
	<div class="tournament-info-my-team">
	<?php if ($this->_tpl_vars['tournament']->tournament_type_id == 3): ?>
	<div style="float:right; margin:10px 10px 20px 0;">
		<div>No.of.Changes : <?php echo $this->_tpl_vars['myTournament']['no_of_changes']; ?>
/<?php echo $this->_tpl_vars['tournament']->no_of_changes; ?>

			<?php if ($this->_tpl_vars['enableedit']): ?>
			<?php if ($this->_tpl_vars['tournament']->tournament_type_id == 1 || $this->_tpl_vars['tournament']->tournament_type_id == 3): ?>
				<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-tournament/<?php echo $this->_tpl_vars['tournament']->tournament_type_id; ?>
-type/<?php echo $this->_tpl_vars['tournament']->id; ?>
/0">Edit</a>
			<?php else: ?>
				<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-tournament/<?php echo $this->_tpl_vars['tournament']->tournament_type_id; ?>
-type/<?php echo $this->_tpl_vars['tournament']->id; ?>
/<?php echo $this->_tpl_vars['match']->id; ?>
">Edit</a>
			<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
	<div id="myteam1" class="myteam-list">
		<div class="myteam-body">
			<div class="myteam-pointer-head">Batting</div>
			<div class="myteam-pointer-head" style="margin:0; width:280px;">Bowling</div>
			<div class="myteam-pointer-head" style="margin:0; width:208px;">Fielding</div>
			<div class="myteam-table-header">
				<div class="extra-large">Player Name</div>
				<div class="small">Runs</div>
				<div class="small">Balls</div>
				<div class="small">4's</div>
				<div class="small">6's</div>
				<div class="medium">S.R</div>
				<div class="medium bonus">Bonus</div>
				<div class="medium total">Total</div>
				<div class="small">O</div>
				<div class="small">M</div>
				<div class="small">R</div>
				<div class="small">WK</div>
				<div class="small">E.R</div>
				<div class="medium bonus">Bonus</div>
				<div class="medium total">Total</div>
				<div class="small">Cts</div>
				<div class="small">RO</div>
				<div class="small">St</div>
				<div class="medium bonus">Bonus</div>
				<div class="medium total">Total</div>
				<div class="large">Grand Total</div>
			</div>
			<ul class="myteam-table-body">
				<?php $this->assign('scoretotal', 0); ?>
				<?php if ($this->_tpl_vars['players']): ?>
				<?php $_from = $this->_tpl_vars['players']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['players'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['players']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['player']):
        $this->_foreach['players']['iteration']++;
?>
				<li class="myteam-table-row">
					<div class="extra-large left-align"><img src="<?php echo $this->_tpl_vars['imageurl1']; ?>
players/<?php echo $this->_tpl_vars['player']['photo_url']; ?>
" alt=""/><?php echo ((is_array($_tmp=$this->_tpl_vars['player']['player_name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 10) : smarty_modifier_truncate($_tmp, 10)); ?>
<?php if (isset ( $this->_tpl_vars['player']['captain'] )): ?>(c)<?php endif; ?></div>
					<div class="small"><?php if ($this->_tpl_vars['player']['runs']): ?><?php echo $this->_tpl_vars['player']['runs']; ?>
<?php else: ?>0<?php endif; ?></div>
					<div class="small"><?php if ($this->_tpl_vars['player']['balls']): ?><?php echo $this->_tpl_vars['player']['balls']; ?>
<?php else: ?>0<?php endif; ?></div>
					<div class="small"><?php if ($this->_tpl_vars['player']['fours']): ?><?php echo $this->_tpl_vars['player']['fours']; ?>
<?php else: ?>0<?php endif; ?></div>
					<div class="small"><?php if ($this->_tpl_vars['player']['sixs']): ?><?php echo $this->_tpl_vars['player']['sixs']; ?>
<?php else: ?>0<?php endif; ?></div>
					<div class="medium"><?php if ($this->_tpl_vars['player']['runs'] == 0): ?>0<?php else: ?><?php echo smarty_function_math(array('equation' => "(( x / y ) * z )",'x' => $this->_tpl_vars['player']['runs'],'y' => $this->_tpl_vars['player']['balls'],'z' => 100,'format' => "%.2f"), $this);?>
<?php endif; ?></div>
					<div class="medium bonus"><?php if ($this->_tpl_vars['player']['coc']['battingbonus']): ?><?php echo $this->_tpl_vars['player']['coc']['battingbonus']; ?>
<?php else: ?>0<?php endif; ?></div>
					<div class="medium total"><?php if ($this->_tpl_vars['player']['coc']['battingbonus']): ?><?php echo $this->_tpl_vars['player']['coc']['battingbonus']+$this->_tpl_vars['player']['coc']['batting']; ?>
<?php else: ?>0<?php endif; ?></div>
					<?php $this->assign('overnum', ((is_array($_tmp=((is_array($_tmp=".")) ? $this->_run_mod_handler('explode', true, $_tmp, $this->_tpl_vars['player']['overs']/6) : explode($_tmp, $this->_tpl_vars['player']['overs']/6)))) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.0f") : smarty_modifier_string_format($_tmp, "%.0f"))); ?>
					<div class="small"><?php if ($this->_tpl_vars['player']['overs']): ?><?php echo $this->_tpl_vars['overnum'][0]; ?>
.<?php echo $this->_tpl_vars['player']['overs']%6; ?>
<?php else: ?>0<?php endif; ?></div>
					<div class="small"><?php if ($this->_tpl_vars['player']['maiden']): ?><?php echo $this->_tpl_vars['player']['maiden']; ?>
<?php else: ?>0<?php endif; ?></div>
					<div class="small"><?php if ($this->_tpl_vars['player']['rungiven']): ?><?php echo $this->_tpl_vars['player']['rungiven']; ?>
<?php else: ?>0<?php endif; ?></div>
					<div class="small"><?php if ($this->_tpl_vars['player']['wickets']): ?><?php echo $this->_tpl_vars['player']['wickets']; ?>
<?php else: ?>0<?php endif; ?></div>
					<div class="small"><?php if ($this->_tpl_vars['player']['overs'] == 0): ?>0<?php else: ?><?php echo smarty_function_math(array('equation' => "(( x / y ) * z )",'x' => $this->_tpl_vars['player']['rungiven'],'y' => $this->_tpl_vars['player']['overs'],'z' => 6,'format' => "%.2f"), $this);?>
<?php endif; ?></div>
					<div class="medium bonus">0</div>
					<div class="medium total"><?php if ($this->_tpl_vars['player']['coc']['bowling']): ?><?php echo $this->_tpl_vars['player']['coc']['bowling']; ?>
<?php else: ?>0<?php endif; ?></div>
					<div class="small"><?php if ($this->_tpl_vars['player']['caught']): ?><?php echo $this->_tpl_vars['player']['caught']; ?>
<?php else: ?>0<?php endif; ?></div>
					<div class="small"><?php if ($this->_tpl_vars['player']['runout']): ?><?php echo $this->_tpl_vars['player']['runout']; ?>
<?php else: ?>0<?php endif; ?></div>
					<div class="small"><?php if ($this->_tpl_vars['player']['stumped']): ?><?php echo $this->_tpl_vars['player']['stumped']; ?>
<?php else: ?>0<?php endif; ?></div>
					<div class="medium bonus">0</div>
					<div class="medium total"><?php if ($this->_tpl_vars['player']['coc']['fielding']): ?><?php echo $this->_tpl_vars['player']['coc']['fielding']; ?>
<?php else: ?>0<?php endif; ?></div>
					<div class="large grandtotal"><?php echo $this->_tpl_vars['player']['coc']['battingbonus']+$this->_tpl_vars['player']['coc']['batting']+$this->_tpl_vars['player']['coc']['bowling']+$this->_tpl_vars['player']['coc']['fielding']; ?>
</div>
				</li>
				<?php $this->assign('scoretotal', $this->_tpl_vars['scoretotal']+$this->_tpl_vars['player']['coc']['battingbonus']+$this->_tpl_vars['player']['coc']['batting']+$this->_tpl_vars['player']['coc']['bowling']+$this->_tpl_vars['player']['coc']['fielding']); ?>
				<?php endforeach; endif; unset($_from); ?>
				<script>setTimeout("zeal.userteam.dynamicScore(<?php echo $this->_tpl_vars['tournament']->id; ?>
, <?php echo $this->_tpl_vars['tournament']->tournament_type_id; ?>
, 0);", refreshInterval);</script>
				<?php else: ?>
					<li class="myteam-table-row" style="height:250px; line-height:250px;"><b>No selection made. <a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-tournament/<?php echo $this->_tpl_vars['tournament']->tournament_type_id; ?>
-type/<?php echo $this->_tpl_vars['tournament']->id; ?>
/<?php echo $this->_tpl_vars['tournament']->match_id; ?>
">Click here</a> to select players</b></li>
				<?php endif; ?>
			</ul>
			<div class="clear"></div>
			<?php if ($this->_tpl_vars['players']): ?>
			<div class="my-team-coach">Coach: <?php echo $this->_tpl_vars['coach']; ?>
</div>
			<div class="my-team-total">Total: <?php echo $this->_tpl_vars['scoretotal']+$this->_tpl_vars['coach_run']; ?>
</div>
			<?php endif; ?>
		</div>
	</div>
	<?php else: ?>
		<div class="tournament-my-team-list">
			<?php $_from = $this->_tpl_vars['matches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['matches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['matches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['match']):
        $this->_foreach['matches']['iteration']++;
?>
				<div class="tournament-info-my-team-indi">
					<div class="flag-cont">
						<div class="flag"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t1flag']; ?>
" alt="<?php echo $this->_tpl_vars['match']['t1name']; ?>
" /></div>
						<div class="v-image-area"></div>
						<div class="flag"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t2flag']; ?>
" alt="<?php echo $this->_tpl_vars['match']['t2name']; ?>
" /></div>
					</div>
					<div class="flag-cont-date">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['match']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A, %B %e, %Y") : smarty_modifier_date_format($_tmp, "%A, %B %e, %Y")); ?>

					</div>
					<div class="flag-cont" style="width:100px;">
					<?php if ($this->_tpl_vars['match']['status'] == 'Completed'): ?>
					<?php echo $this->_tpl_vars['match']['status']; ?>

					<?php else: ?>
					<?php if ($this->_tpl_vars['match']['joined']): ?>
						Picked
					<?php else: ?>
						Not Picked
					<?php endif; ?>
					<?php endif; ?>
					</div>
					<?php if ($this->_tpl_vars['match']['opening_soon'] == 0): ?>
					<div class="tour-info-opening-shortly">Opening soon</div>
					<?php elseif ($this->_tpl_vars['match']['joined'] || $this->_tpl_vars['match']['status'] == 'Completed'): ?>
					<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-team/<?php echo $this->_tpl_vars['tournament']->tournament_type_id; ?>
-type/<?php echo $this->_tpl_vars['tournament']->id; ?>
/<?php echo $this->_tpl_vars['match']['id']; ?>
" class="overall-btn">Enter</a>
					<?php else: ?>
					<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-tournament/<?php echo $this->_tpl_vars['tournament']->tournament_type_id; ?>
-type/<?php echo $this->_tpl_vars['tournament']->id; ?>
/<?php echo $this->_tpl_vars['match']['id']; ?>
" class="overall-btn">Enter</a>
					<?php endif; ?>
				</div>
			<?php endforeach; endif; unset($_from); ?>
		</div>
	<?php endif; ?>
	</div>
</div>