<?php /* Smarty version 2.6.27, created on 2014-04-11 12:13:38
         compiled from success-payment.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'success-payment.tpl', 13, false),)), $this); ?>
<div class="refer-a-friend">
	<div class="live-score-menu rightscore">
		<ul>
			<li class="active">Success</li>
		</ul>
	</div>
	<div class="refer-a-friend-inner">
		<div>
			<h1 style="text-align:center; font-size:20px;">Your deposit was successful</h1>
			<div style="float:left; margin:30px 0 0 20px; height:200px;">
				<b>Deposit Amount : </b>Rs. <?php echo $this->_tpl_vars['deposit']->amount; ?>
<br/>
				<b>Transaction Id :</b><?php echo $this->_tpl_vars['payment_id']; ?>
<br/>
				<b>Date : </b><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
<br/><br/>
				An e-mail has been sent to you for reference<br/><br/>
				If you have any problems regarding this deposit , please send a mail to deposit@zealcity.com and include the above information.<br/><br/><br/>
				<input type="button" value="Continue" class="addfunds" onclick="window.location.href='tournament'"/>
			</div>			
		</div>
	</div>
</div>