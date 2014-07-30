<?php /* Smarty version 2.6.27, created on 2014-05-02 11:15:50
         compiled from my-team-result.tpl */ ?>
<div class="myteam-body myteam-result">
	<?php if ($this->_tpl_vars['tournament']->tournament_type_id == 1 || $this->_tpl_vars['tournament']->tournament_type_id == 3): ?>
	<div class="myteam-prize">
		<div class="myteam-prize-title" style="float:left;">Prize Pool -</div>
		<div style="margin:0 0 0 3px; float:left;"><?php echo $this->_tpl_vars['tournament']->prize_pool->name; ?>
</div>
		<div class="clear"></div>
		<div class="myteam-prize-list">
		<?php $_from = $this->_tpl_vars['tournament']->prize_pool->prize; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['prizes'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['prizes']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['prize']):
        $this->_foreach['prizes']['iteration']++;
?>
			<div class="first-place"><div class="fst"><?php echo $this->_foreach['prizes']['iteration']; ?>
</div><div class="fst-amount"><span class="WebRupee">Rs.</span><?php echo $this->_tpl_vars['prize']; ?>
</div></div>
			<?php $this->assign('prizetot', $this->_foreach['prizes']['iteration']); ?>
		<?php endforeach; endif; unset($_from); ?>
		</div>
	</div>
	<?php endif; ?>
	<div class="myteam-prizebox">
		<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
rules" target="_blank" style="float:left; color:#000; text-decoration:underline; margin:15px 0 0 0; width:100%; text-align:center">Click here to know the rules</a>
		<?php if (empty ( $this->_tpl_vars['winners'] )): ?>
		<div style="float:left; clear:both; margin:15px 0 0 0; text-align:center; width:100%; font-weight:bold;">Results not yet announced</div>
		<?php endif; ?>
	</div>
	<div class="myteam-rank">Rank - <span id="myteam-rank">0</span></div>
	<div class="loading myteam-loading" id="myteam-loading"></div>
	<div class="myteam-result">
		<?php if (! empty ( $this->_tpl_vars['winners'] )): ?>
			<div class="myteam-result-head">
				<div class="small">Rank</div>
				<div class="large">Player Name</div>
				<div class="small">Run</div>
			</div>
			<?php $_from = $this->_tpl_vars['winners']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['winners'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['winners']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['winner']):
        $this->_foreach['winners']['iteration']++;
?>
				<?php if ($this->_tpl_vars['winner']['user_id'] == $this->_tpl_vars['user']->id): ?><script>zeal.jQuery('#myteam-rank').text(<?php echo $this->_foreach['winners']['iteration']; ?>
);</script><?php endif; ?>
				<div class="myteam-result-body<?php if ($this->_tpl_vars['winner']['user_id'] == $this->_tpl_vars['user']->id): ?> highlight-user<?php endif; ?>">
					<div class="small"><?php if ($this->_tpl_vars['winner']['rank']): ?><?php echo $this->_tpl_vars['winner']['rank']; ?>
<?php else: ?><?php echo $this->_foreach['winners']['iteration']; ?>
<?php endif; ?></div>
					<div class="large">
						<?php if ($this->_tpl_vars['winner']['connect_id']): ?>
							<img src="https://graph.facebook.com/<?php echo $this->_tpl_vars['winner']['connect_id']; ?>
/picture" alt=""/>
						<?php else: ?>
							<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/avatar.jpg" alt="" />
						<?php endif; ?>
						<?php echo $this->_tpl_vars['winner']['username']; ?>

					</div>
					<div class="small"><?php if ($this->_tpl_vars['winner']['run']): ?><?php echo $this->_tpl_vars['winner']['run']; ?>
<?php else: ?>0<?php endif; ?></div>
					 <div class="small"><a href="#"class="lobby-join" onclick="zeal.userteam.selectTournament1(<?php echo $this->_tpl_vars['winner']['user_id']; ?>
,<?php echo $this->_tpl_vars['tournament']->id; ?>
, <?php echo $this->_tpl_vars['tournament']->tournament_type_id; ?>
, <?php echo $this->_tpl_vars['match']->id; ?>
)">View Team</a></div>
					 <?php if (( $this->_tpl_vars['tournament']->tournament_type_id == 1 || $this->_tpl_vars['tournament']->tournament_type_id == 3 ) && $this->_tpl_vars['winner']['prize_money'] > 0): ?>
					 <div style="float:left">
					 	<!--<div class="medal" style="float:left; margin-top:8px;"><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/Social_gold.png" width="20" height="25"/></div>-->
						<div class="small"><b><span class="WebRupee">Rs.</span><?php echo $this->_tpl_vars['winner']['prize_money']; ?>
</b></div>
					 </div>
					 <?php endif; ?>
				</div>
			<?php endforeach; endif; unset($_from); ?>
		   
		<?php else: ?>
			<div id="dynamicresult">
				<div class="myteam-result-head">
					<div class="small">No</div>
					<div class="large">Player Name</div>
					<div class="large">Team Name</div>
					<div class="small"></div>
				</div>
				<?php $_from = $this->_tpl_vars['playerresult']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['playerresult'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['playerresult']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['player']):
        $this->_foreach['playerresult']['iteration']++;
?>
					<div class="myteam-result-body">
						<div class="small" ><?php echo $this->_foreach['playerresult']['iteration']; ?>
</div>
						<div class="large">
						<?php if ($this->_tpl_vars['player']['connect_id']): ?>
							<img src="https://graph.facebook.com/<?php echo $this->_tpl_vars['player']['connect_id']; ?>
/picture" alt=""/>
						<?php else: ?>
							<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/avatar.jpg" alt="" />
						<?php endif; ?>
						<?php echo $this->_tpl_vars['player']['username']; ?>

						</div>
						<div class="large"><?php echo $this->_tpl_vars['player']['teamname']; ?>
&nbsp;</div>
					</div>                        
				<?php endforeach; endif; unset($_from); ?>
			</div>
			<script>setTimeout("zeal.userteam.dynamicResult(<?php echo $this->_tpl_vars['tournament']->id; ?>
, <?php echo $this->_tpl_vars['tournament']->tournament_type_id; ?>
, <?php echo $this->_tpl_vars['match']->id; ?>
);", 1);</script>
		<?php endif; ?>
	</div>
</div>