<?php /* Smarty version 2.6.27, created on 2014-04-12 19:03:43
         compiled from forgot-password.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'forgot-password.tpl', 14, false),)), $this); ?>
<div class="center-container">
	<div class="live-score-menu">
    	<ul>
        	<li class="active">Forgot Password</li>
		</ul>
	</div>
	<div class="aboutus-container">
        <div class="inner-terms" >
			<div class="refer-a-friend-email">
				<div class="refer-a-friend-email-inner-center">
					<div class="refer-a-friend-email-inner">
						<div class="clear"></div>
						<?php if (isset ( $this->_tpl_vars['confirmation'] ) && $this->_tpl_vars['confirmation'] == 1): ?>
						<p class="success">Your password has been successfully reset and has been sent to your e-mail address: <?php echo ((is_array($_tmp=$this->_tpl_vars['email'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</p>
						<?php elseif (isset ( $this->_tpl_vars['confirmation'] ) && $this->_tpl_vars['confirmation'] == 2): ?>
						<p class="success">A confirmation e-mail has been sent to your address:<?php echo ((is_array($_tmp=$this->_tpl_vars['email'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</p>
						<?php else: ?>
						<form method="post" onsubmit="" >
							<div>Email :</div>
							<div>
								<input type="text" name="email" id="txtemail" value=""/>
							</div>
							<div><input type="submit" value="Submit" class="addfunds" name="submitForgotPassword"/></div>
						</form>
						<?php endif; ?>
					</div>				
				</div>
			</div>
		</div>
    </div>
</div>