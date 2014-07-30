<?php /* Smarty version 2.6.27, created on 2014-06-04 12:05:45
         compiled from dynamictournament.tpl */ ?>
<?php if ($this->_tpl_vars['tournaments']): ?>
<?php $_from = $this->_tpl_vars['tournaments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['matches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['matches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['match']):
        $this->_foreach['matches']['iteration']++;
?>
	<?php $_from = $this->_tpl_vars['match']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tournaments'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tournaments']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tournament']):
        $this->_foreach['tournaments']['iteration']++;
?>
	<div class="tounament-row-cont tour-lobby-room daily-tournament<?php if ($this->_tpl_vars['tournament']['entryfee'] == 0): ?> free-tournament<?php else: ?> cash-tournament<?php endif; ?>">
		<div class="tournament-row-type">
			<div class="tournament-row-type-flag">
				<div class="flag"><img src="<?php echo $this->_tpl_vars['tourimageurl']; ?>
teamsflags/<?php echo $this->_tpl_vars['tournament']['flag1']; ?>
" alt=""></div>
				<div class="v-image-area"></div>
				<div class="flag flag-op"><img src="<?php echo $this->_tpl_vars['tourimageurl']; ?>
teamsflags/<?php echo $this->_tpl_vars['tournament']['flag2']; ?>
" alt=""></div>
			</div>
			<div class="tour-row-type-win-text"><?php echo $this->_tpl_vars['tournament']['prizetype']; ?>
</div>
			<div class="tour-row-type-win-cash"><span class="WebRupee">Rs.</span> <?php echo $this->_tpl_vars['tournament']['prize']; ?>
</div>
		</div>
		<?php $_from = $this->_tpl_vars['tournament']['tour']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tours'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tours']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tour']):
        $this->_foreach['tours']['iteration']++;
?>
		<div class="tour-row-player-entry">
			<div class="tour-row-player-count"><span><?php echo $this->_tpl_vars['tour']['player']; ?>
</span> Players</div>
			<div class="tour-row-player-joined">Players <?php echo $this->_tpl_vars['tour']['reg_player']; ?>
/<?php echo $this->_tpl_vars['tour']['player']; ?>
</div>
			<div class="tour-row-enrty-fee"><?php if ($this->_tpl_vars['tour']['amount'] == 0): ?><b>Free</b><?php else: ?>Entry Fee <span class="WebRupee">Rs.</span><?php echo $this->_tpl_vars['tour']['amount']; ?>
<?php endif; ?></div>
			<?php if (in_array ( $this->_tpl_vars['tour']['id'] , $this->_tpl_vars['dailyJoined'] )): ?>
			<?php if ($this->_tpl_vars['tour']['tournament_type_id'] == 1): ?>
			<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-team/<?php echo $this->_tpl_vars['tour']['tournament_type_id']; ?>
-type/<?php echo $this->_tpl_vars['tour']['id']; ?>
/0" class="tour-row-join-btn" >Enter</a>
			<?php else: ?>
			<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-period-tournament-details/<?php echo $this->_tpl_vars['tour']['tournament_type_id']; ?>
-type/<?php echo $this->_tpl_vars['tour']['id']; ?>
" class="tour-row-join-btn" >Enter</a>
			<?php endif; ?>
			<?php else: ?>
			<div class="tour-row-join-btn tour-join-btn" rel="<?php echo $this->_tpl_vars['tour']['id']; ?>
,<?php echo $this->_tpl_vars['tour']['tournament_type_id']; ?>
">Join</div>
			<?php endif; ?>
		</div>
		<?php endforeach; endif; unset($_from); ?>
	</div>
	<div class="clear"></div>
	<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>
<div class="clear"></div>
<?php $_from = $this->_tpl_vars['weeklyTournaments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['matches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['matches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['match']):
        $this->_foreach['matches']['iteration']++;
?>
	<?php $_from = $this->_tpl_vars['match']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tournaments'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tournaments']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tournament']):
        $this->_foreach['tournaments']['iteration']++;
?>
	<div class="tounament-row-cont tour-lobby-room <?php if ($this->_tpl_vars['tournament']['type'] == 5 || $this->_tpl_vars['tournament']['type'] == 7): ?> weekly-tournament<?php else: ?> series-tournament<?php endif; ?><?php if ($this->_tpl_vars['tournament']['entryfee'] == 0): ?> free-tournament<?php else: ?> cash-tournament<?php endif; ?>">
		<div class="tournament-row-type">
			<div class="tour-period-type-txt"><?php if ($this->_tpl_vars['tournament']['type'] == 5 || $this->_tpl_vars['tournament']['type'] == 7): ?>Weekly<?php elseif ($this->_tpl_vars['tournament']['type'] == 6 || $this->_tpl_vars['tournament']['type'] == 8): ?>Series<?php endif; ?></div>
			<div class="tour-row-type-win-text"><?php echo $this->_tpl_vars['tournament']['prizetype']; ?>
</div>
			<div class="tour-row-type-win-cash"><span class="WebRupee">Rs.</span> <?php echo $this->_tpl_vars['tournament']['prize']; ?>
</div>
		</div>
		<?php $_from = $this->_tpl_vars['tournament']['tour']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tours'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tours']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tour']):
        $this->_foreach['tours']['iteration']++;
?>
		<div class="tour-row-player-entry">
			<div class="tour-row-player-count"><span><?php echo $this->_tpl_vars['tour']['player']; ?>
</span> Players</div>
			<div class="tour-row-player-joined">Players <?php echo $this->_tpl_vars['tour']['reg_player']; ?>
/<?php echo $this->_tpl_vars['tour']['player']; ?>
</div>
			<div class="tour-row-enrty-fee"><?php if ($this->_tpl_vars['tour']['amount'] == 0): ?><b>Free</b><?php else: ?>Entry Fee <span class="WebRupee">Rs.</span><?php echo $this->_tpl_vars['tour']['amount']; ?>
<?php endif; ?></div>
			<?php if (in_array ( $this->_tpl_vars['tour']['id'] , $this->_tpl_vars['dailyJoined'] )): ?>
			<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-period-tournament-details/<?php echo $this->_tpl_vars['tour']['tournament_type_id']; ?>
-type/<?php echo $this->_tpl_vars['tour']['id']; ?>
" class="tour-row-join-btn" >Enter</a>
			<?php else: ?>
			<div class="tour-row-join-btn tour-join-btn" rel="<?php echo $this->_tpl_vars['tour']['id']; ?>
,<?php echo $this->_tpl_vars['tour']['tournament_type_id']; ?>
">Join</div>
			<?php endif; ?>
		</div>
		<?php endforeach; endif; unset($_from); ?>
	</div>
	<div class="clear"></div>
	<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>
<?php else: ?>
<div style="padding-top:5px;">
	<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/opening-soon-match.png" alt=""/>
</div>
<?php endif; ?>