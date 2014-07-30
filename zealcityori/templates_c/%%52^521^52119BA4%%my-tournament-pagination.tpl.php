<?php /* Smarty version 2.6.27, created on 2014-04-19 12:57:08
         compiled from my-tournament-pagination.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count_characters', 'my-tournament-pagination.tpl', 4, false),array('modifier', 'date_format', 'my-tournament-pagination.tpl', 14, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['mytournaments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mytournaments'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mytournaments']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tournament']):
        $this->_foreach['mytournaments']['iteration']++;
?>
<div class="index-lobby-room<?php if ($this->_tpl_vars['tournament']['status'] == 'Completed'): ?> compl-tour<?php endif; ?><?php if ($this->_tpl_vars['tournament']['tournament_type_id'] == 1 || $this->_tpl_vars['tournament']['tournament_type_id'] == 3): ?> daily-tournament<?php elseif ($this->_tpl_vars['tournament']['tournament_type_id'] == 5 || $this->_tpl_vars['tournament']['tournament_type_id'] == 7): ?> weekly-tournament<?php else: ?> series-tournament<?php endif; ?>">
	<div class="divider"></div>
	<div class="extra-large"<?php if (((is_array($_tmp=$this->_tpl_vars['tournament']['name'])) ? $this->_run_mod_handler('count_characters', true, $_tmp, true) : smarty_modifier_count_characters($_tmp, true)) > 23): ?> style="line-height:25px;"<?php endif; ?>><?php echo $this->_tpl_vars['tournament']['name']; ?>
</div>
	<div class="divider"></div>
	<div class="large"><?php if ($this->_tpl_vars['tournament']['tournament_type_id'] == 1 || $this->_tpl_vars['tournament']['tournament_type_id'] == 3): ?> Daily<?php elseif ($this->_tpl_vars['tournament']['tournament_type_id'] == 5 || $this->_tpl_vars['tournament']['tournament_type_id'] == 7): ?> Weekly<?php else: ?> Series<?php endif; ?></div>
	<div class="divider"></div>
	<div class="large"><span class="WebRupee">Rs.</span><?php echo $this->_tpl_vars['tournament']['amount']; ?>
</div>
	<div class="divider"></div>
	<div class="large"><?php echo $this->_tpl_vars['tournament']['reg_player']; ?>
/<?php echo $this->_tpl_vars['tournament']['player']; ?>
</div>
	<div class="divider"></div>
	<div class="large"><span class="WebRupee">Rs.</span><?php echo $this->_tpl_vars['tournament']['prize']; ?>
</div>
	<div class="divider"></div>
	<div class="extra-large"><?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']['endtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%a %R %b %e') : smarty_modifier_date_format($_tmp, '%a %R %b %e')); ?>
</div>
	<div class="divider"></div>
	<div class="medium">
	<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-period-tournament-details/<?php echo $this->_tpl_vars['tournament']['tournament_type_id']; ?>
-type/<?php echo $this->_tpl_vars['tournament']['id']; ?>
" class="lobby-join" >Enter</a>
	</div>
</div>
<?php endforeach; endif; unset($_from); ?>