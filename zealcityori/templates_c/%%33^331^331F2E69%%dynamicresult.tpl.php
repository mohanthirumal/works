<?php /* Smarty version 2.6.27, created on 2014-04-14 16:42:27
         compiled from dynamicresult.tpl */ ?>
<div class="myteam-result-head">
	<div class="small">Rank</div>
	<div class="large">Player Name</div>
	<div class="large">Team Name</div>
	<div class="small">Teams</div>
	<div class="small">Runs</div>
</div>
<?php $_from = $this->_tpl_vars['playerresult']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['playerresult'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['playerresult']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['player']):
        $this->_foreach['playerresult']['iteration']++;
?>
	<?php if ($this->_tpl_vars['player']['user_id'] == $this->_tpl_vars['user']->id): ?><script>zeal.jQuery('#myteam-rank').text(<?php echo $this->_foreach['playerresult']['iteration']; ?>
);</script><?php endif; ?>
	<div class="myteam-result-body<?php if ($this->_tpl_vars['player']['user_id'] == $this->_tpl_vars['user']->id): ?> highlight-user<?php endif; ?>">
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
		<div class="small"><a href="#"class="lobby-join" onclick="zeal.userteam.selectTournament1(<?php echo $this->_tpl_vars['player']['user_id']; ?>
,<?php echo $this->_tpl_vars['tournament']->id; ?>
, <?php echo $this->_tpl_vars['tournament']->tournament_type_id; ?>
, <?php echo $this->_tpl_vars['match']->id; ?>
)">View Team</a></div>
		<div class="small"><?php echo $this->_tpl_vars['player']['run']; ?>
</div>
	</div>                        
<?php endforeach; endif; unset($_from); ?>