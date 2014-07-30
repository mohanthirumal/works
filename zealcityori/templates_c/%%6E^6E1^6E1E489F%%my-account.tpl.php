<?php /* Smarty version 2.6.27, created on 2014-05-03 16:08:21
         compiled from my-account.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'my-account.tpl', 21, false),array('modifier', 'date_format', 'my-account.tpl', 348, false),array('function', 'math', 'my-account.tpl', 351, false),)), $this); ?>

<div class="my-account-maincontainer">
	<div class="myprfile-container">
    	<div class="container-header">
	      	<ul>
				<li class="active" style=" cursor:default;">My Profile</li>
            </ul>
        </div>
        <div class="divi-line"></div>
        <form action="" method="post">
	        <div class="lablename">First Name</div><div class="labletbox"><input type="text" class="bigtxt" name="txtfirstname" value="<?php echo $this->_tpl_vars['user']->firstname; ?>
"/></div>
            <div class="lablename">Last Name</div><div class="labletbox"><input type="text" class="bigtxt" name="txtlastname" value="<?php echo $this->_tpl_vars['user']->lastname; ?>
"/></div>
			<div class="lablename">Old Pwd</div><div class="labletbox"><input type="password" class="bigtxt" name="oldpassword" class="largetxt" value=""/></div>
			<div class="lablename">New Pwd</div><div class="labletbox"><input type="password" class="bigtxt" name="newpassword" class="largetxt" value=""/></div>
			<div class="lablename">Conf Pwd</div><div class="labletbox"><input name="confirmpassword" type="password" class="bigtxt" value=""/></div>
            <div class="lablename">DOB</div><div class="labletbox">
				<!--<input type="text" class="smalltxt" name="dob" value="<?php echo $this->_tpl_vars['user']->dob; ?>
"/>-->
				<select name="days" id="days" class="smalltxt" style="width:40px;">
					<option value="">-</option>
					<?php $_from = $this->_tpl_vars['days']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
						<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['v'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" <?php if (( $this->_tpl_vars['sl_day'] == $this->_tpl_vars['v'] )): ?>selected="selected"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['v'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
&nbsp;&nbsp;</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
				<select id="months" name="months" class="smalltxt" style="width:70px;">
					<option value="">-</option>
					<?php $_from = $this->_tpl_vars['months']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
						<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" <?php if (( $this->_tpl_vars['sl_month'] == $this->_tpl_vars['k'] )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
&nbsp;</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
				<select id="years" name="years" class="smalltxt" style="width:60px;">
					<option value="">-</option>
					<?php $_from = $this->_tpl_vars['years']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
						<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['v'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" <?php if (( $this->_tpl_vars['sl_year'] == $this->_tpl_vars['v'] )): ?>selected="selected"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['v'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
&nbsp;&nbsp;</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
			</div>
            <div class="lablename">Sex</div><div class="labletbox">
				<select name="sex" class="smalltxt">
					<option value="male"<?php if ($this->_tpl_vars['user']->sex == 'male'): ?> selected<?php endif; ?>>Male</option>
					<option value="female"<?php if ($this->_tpl_vars['user']->sex == 'female'): ?> selected<?php endif; ?>>Female</option>
				</select>
			</div>
            <div class="lablename">Country</div><div class="labletbox"><input type="text" value="<?php echo $this->_tpl_vars['user']->country; ?>
" class="bigtxt" name="country"/></div>
            <div class="lablename">State</div><div class="labletbox"><input type="text" value="<?php echo $this->_tpl_vars['user']->state; ?>
" class="bigtxt" name="state"/></div>
            <div class="lablename">City</div><div class="labletbox"><input type="text" value="<?php echo $this->_tpl_vars['user']->city; ?>
" class="bigtxt" name="city"/></div>
            <div class="lablename">Address</div><div class="labletbox1"><textarea name="address" class="bigtxt" style="height:65px;"><?php echo $this->_tpl_vars['user']->address; ?>
</textarea></div>
            <div class="lablename">Pincode</div><div class="labletbox"><input type="text" name="pincode" class="smalltxt" value="<?php echo $this->_tpl_vars['user']->pincode; ?>
"/></div>
            <div class="divi-line"></div>
			<input type="submit" name="submitPersonal" value="Save" class="addfunds" style="margin:12px 1px 12px 140px; " />
        </form>
    </div>
   	<div class="myaccount-container">
    	<div class="container-header">
	      	<ul>
				<li class="active" style=" cursor:default;">My Account</li>
            </ul>
        </div>
      	<div class="captions">User Name</div><div class="tbox"><input type="text" class="largetxt" value="<?php echo $this->_tpl_vars['user']->username; ?>
" disabled="disabled"/></div>
		<div class="captions">Email</div><div class="tbox"><input type="text" class="largetxt" value="<?php echo $this->_tpl_vars['user']->email; ?>
" disabled="disabled"/></div>
        <div class="dotted-line"></div>
        <div class="fb-icon-area">
        	<img src="images/f_icon.png" class="fb-icon"/>
            <div class="fb-ac-text">FacebookAccounts</div>
			<?php if ($this->_tpl_vars['user']->connect['facebook']): ?>
			<div style="padding:10px; background-color:#fff; float:right; margin:0 0 0 10px;">Connected</div>
			<?php else: ?>
			<a href="#" onclick="zeal.facebook.sync(<?php echo $this->_tpl_vars['user']->id; ?>
);"><img src="images/sync_btn.png" class="ac-sign-button"/></a>
			<?php endif; ?>            
        </div>
		
        <!--<div class="dotted-line"></div>
	    <div class="fb-icon-area">
        	<img src="images/t_icon.png" class="fb-icon"/>
            <div class="fb-ac-text">TwitterAccounts</div>
            <img src="images/sync_btn.png" class="ac-sign-button"/>
        </div>  -->
        <div class="dotted-line"></div>
	    <div class="fb-icon-area">
        	<img src="images/cash_icon.png" class="cash-icon"/>
            <div class="realmoney-text">Real Money</div>
            <div class="cash-table">
				<div class="avail-area">
                	<div class="cash-name">Available</div>
                    <div class="cash-value"><?php echo $this->_tpl_vars['user']->cash; ?>
</div>
                </div>
                <div class="d-line"></div>        	 
  				<div class="avail-area">
                	<div class="cash-name">Inplay</div>
                    <div class="cash-value"><?php echo $this->_tpl_vars['inprogressCash']; ?>
</div>
	            </div>            	
                <div class="d-line"></div>
   				<div class="avail-area">
                   	<div class="cash-name">Total</div>
                    <div class="cash-value"><?php echo $this->_tpl_vars['user']->cash+$this->_tpl_vars['inprogressCash']; ?>
</div>
	            </div>            	                
			</div>
        </div>
        <div class="dotted-line"></div>
  	    <!--<div class="fb-icon-area">
        	<img src="images/zeal_icons.png" class="cash-icon"/>
            <div class="realmoney-text">Zeal Coins</div>
            <div class="cash-table">
    			<div class="avail-area">
	               	<div class="cash-name">Available</div>
                    <div class="cash-value">1000000</div>
                </div>
                <div class="d-line"></div>        	      	 
  				<div class="avail-area">
                	<div class="cash-name">Inplay</div>
                    <div class="cash-value">20000</div>
	            </div>            	
                <div class="d-line"></div>        	 
   				<div class="avail-area">
                   	<div class="cash-name">Total</div>
                    <div class="cash-value">10200000</div>
	            </div>            	                
			</div>
        </div>
        <div class="dotted-line"></div>
        <div class="frequent-player-points">Frequent Player Points</div>
        <div class="points-value">10,000</div>-->
    </div>
    
   <!--<div class="mybounus-container">
	   	<div class="container-header">
	      	<ul>
				<li class="active">My Bonus</li>
            </ul>
        </div>
        <div class="bonus-area">
        	<div class="bonustext">Bonus</div>
            <img src="images/bar.png" class="barimg"/>
            <div class="collect-but">Collect</div>
        </div>
        <div class="divi-line"></div>
        <div class="bonus-area">
        	<div class="bonustext">Bonus</div>
            <img src="images/bar.png" class="barimg"/>
            <div class="collect-but">Collect</div>
        </div>
    </div>-->
	<div class="withdrawl-container">
        <div class="container-header">
            <ul>
                <li class="active" style=" cursor:default;">Withdrawals</li>
            </ul>
        </div>
        <div class="withdra-type">
            <div class="with-captions">Transaction Type</div><div class="with-colon">:</div>
            <div class="with-tbox">
                <select name="withdraw-type" class="withdraw-type txtwithdraw" id="withdraw-type" onchange="zeal.myaccount.withdrawtype(this);">
                    <option value="0">---Select---</option>
                    <!--<option value="1">Online Transfer</option>-->
                    <option value="2">Cheque</option>
                </select>
            </div>
        </div>
        
        <form method="post" id="online-withdra" onsubmit="return zeal.myaccount.withdrawamt1(1);" style="display:none;"> 
            <div class="with-captions">Processing time</div><div class="with-colon">:</div><div class="with-tbox" style="margin-left: 10px;">3 days</div>
			<!--<div class="with-captions">Processing fee</div><div class="with-colon">:</div><div class="with-tbox" style="margin-left: 10px;">3%</div>-->
            <div class="with-captions">Available Balance</div><div class="with-colon">:</div><div class="with-tbox txtwithdraw"><span class="WebRupee">Rs</span><?php echo $this->_tpl_vars['user']->cash; ?>
</div>
            <div class="with-captions">Amount to be withdrawn*</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" class="with-smalltxtbox" id="txtonlineamt" name="amount"/></div>
            <div class="with-captions">Name*</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" class="bigtxt bigtxt-in-withdrawls" id="txtonlinename" name="accname" /></div>
            <div class="with-captions">A/C No*</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" class="bigtxt bigtxt-in-withdrawls" id="txtonlineaccno" name="accno"/></div>
            <div class="with-captions">Bank Name*</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" class="bigtxt bigtxt-in-withdrawls" id="txtonlinebankname" name="bankname" /></div>
            <div class="with-captions">IFSC code*</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" class="bigtxt bigtxt-in-withdrawls" id="txtonlineifsc" name="ifsccode" /></div>
            <div class="with-captions">Mobile*</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" class="bigtxt bigtxt-in-withdrawls" id="txtonlinemobile" name="mobile"  /></div>
            <div style="margin:10px 0 0 10px; float:left;"><b>Note</b>: Processing fee is 3% for Online Transfer</div>
             <!--<div style="margin:10px 0 0 10px; float:left;"><b>Note</b>: Enter valid PAN Number for successful withdrawal. Invalid PAN will reject your withdrawal.</div>-->
            <input type="button" class="addfunds" id="submitonlinedetails" value="Submit" onclick="zeal.myaccount.getDetails(1);" name="" style="border:0; margin:50px 0 0 150px; cursor:pointer;"/>
            
            <div class="online-iddet hide" id="online-iddet" >
                <div class="createTournamentTitleContent" style="margin-bottom: 30px;">
                    <div class="createTournamentTitle popup-title">Proof Details</div>
                    <div class="close-btn" onclick="zeal.myaccount.cancelCreate()"></div>
                </div>
                <div class="with-captions">ID Proof*</div><div class="with-colon">:</div>
                <div class="with-tbox">
                    <select class="bigtxt bigtxt-in-withdrawls" id="proof-select" name="proof-select" onchange="zeal.myaccount.prooftype(1);">
                        <option value="0">---Select---</option>
                        <option value="Pd">Pancard</option>
                        <option value="vd">Voter Id card</option>
                        <option value="dl">Driving Licence</option>
                        <option value="pp">Passport</option>
                    </select>
                </div>
                <div class="idvalue hide" id="idvalue">
                    <div class="with-captions proof-name" id="proof-name"></div><div class="with-colon">:</div>
                    <div class="with-tbox"><input type="text" class="bigtxt bigtxt-in-withdrawls" id="txtonlinepanno" name="panno"  /></div>
                </div>	                    
                <!--<input type="text" class="bigtxt bigtxt-in-withdrawls" id="txtonlinepanno" name="panno"  /></div>-->
                <input type="submit" class="addfunds" value="Submit" name="submitOnlineWithdraw" style="border:0; cursor:pointer;margin: 20px 0 0 150px;"/>
            </div>
        </form>
        
        <form method="post" id="cheq-withdra" onsubmit="return zeal.myaccount.withdrawamt1(2);" style="display:none;"> 
            <!--<div class="with-captions">Name</div><div class="with-colon">:</div><div class="with-tbox"><?php echo $this->_tpl_vars['user']->username; ?>
</div>-->
            <div class="with-captions">Processing time</div><div class="with-colon">:</div><div class="with-tbox" style="margin-left: 10px;">2 weeks</div>
            <div class="with-captions">Available Balance</div><div class="with-colon">:</div><div class="with-tbox txtwithdraw" ><span class="WebRupee">Rs</span><?php echo $this->_tpl_vars['user']->cash; ?>
</div>
            <div class="with-captions">Name</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" class="bigtxt bigtxt-in-withdrawls" name="cheqname" id="cheqname" style="margin: 0 0 0 10px;"/></div>
            <div class="with-captions">Amount to be withdrawn*</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" class="with-smalltxtbox" name="amount" id="wamount"/></div>
            <div class="with-captions">Shipping Address*</div><div class="with-colon">:</div><div class="with-tbox1"><textarea name="address" class="bigtxt" id="address" style="height:65px; width:150px;"><?php echo $this->_tpl_vars['user']->address; ?>
</textarea></div>
            <div class="with-captions">Mobile No*</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" name="mobno" id="txtmobile" class="bigtxt bigtxt-in-withdrawls" value="<?php echo $this->_tpl_vars['user']->mobno; ?>
"/></div>
            <div class="with-captions">Country*</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" value="<?php echo $this->_tpl_vars['user']->country; ?>
" id="txtCountry" class="bigtxt bigtxt-in-withdrawls" name="country"/></div>
            <div class="with-captions">State*</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" value="<?php echo $this->_tpl_vars['user']->state; ?>
" id="txtstate" class="bigtxt bigtxt-in-withdrawls" name="state"/></div>
            <div class="with-captions">City*</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" value="<?php echo $this->_tpl_vars['user']->city; ?>
" id="txtcity" class="bigtxt bigtxt-in-withdrawls" name="city"/></div>
            <div class="with-captions">Pincode*</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" name="pincode" id="txtpincode" class="bigtxt bigtxt-in-withdrawls" value="<?php echo $this->_tpl_vars['user']->pincode; ?>
"/></div>
            <input type="button" class="addfunds" id="submitonlinedetails" value="Submit" onclick="zeal.myaccount.getDetails(2);" name="" style="border:0; margin:50px 0 0 150px; cursor:pointer;"/>

            <!--<div class="with-captions">PAN No *</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" name="panno" class="bigtxt bigtxt-in-withdrawls" value=""/></div>
            <div style="margin:10px 0 0 10px; float:left;"><b>Note</b>: Enter valid PAN Number for successful withdrawal. Invalid PAN will reject your withdrawal.</div>-->
            
            <div class="online-iddet hide" id="cheque-iddet" >
                <div class="createTournamentTitleContent" style="margin-bottom: 30px;">
                    <div class="createTournamentTitle popup-title">Proof Details</div>
                    <div class="close-btn" onclick="zeal.myaccount.cancelCreate()"></div>
                </div>
                <div class="with-captions">ID Proof*</div><div class="with-colon">:</div>
                <div class="with-tbox">
                    <select class="bigtxt bigtxt-in-withdrawls" id="chqproof-select" name="chqproof-select" onchange="zeal.myaccount.prooftype(2);">
                        <option value="0">---Select---</option>
                        <option value="pd">Pancard</option>
                        <option value="vd">Voter Id card</option>
                        <option value="dl">Driving Licence</option>
                        <option value="pp">Passport</option>
                    </select>
                </div>
                <div class="idvalue hide" id="chqidvalue">
                    <div class="with-captions" id="chqproof-name"></div><div class="with-colon">:</div>
                    <div class="with-tbox"><input type="text" class="bigtxt bigtxt-in-withdrawls" id="txtonlinepanno1" name="panno"  /></div>
                </div>	                    
                <!--<input type="text" class="bigtxt bigtxt-in-withdrawls" id="txtonlinepanno" name="panno"  /></div>-->
                <input type="submit" class="addfunds" value="Submit" name="submitWithdraw" style="border:0; margin:20px 0 0 150px; cursor:pointer;"/>
            </div>
        </form>
	</div>
	<!--<div class="my-account-maincontainer">
	    <div class="myfriends-container">
   		   	<div class="container-header">
				<ul>
					<li class="active">My Friends</li>
				</ul>
        	</div>
            <div class="myfriend-menu">
            	<div class="invite-friends">Invite friends</div>
                <div class="invite-friends">My friends</div>
                <div class="invite-friends">Friend Referrals</div>
            </div>
            <div class="invitefriends-msg">Invite friends through your favorite social network Facebook Invite</div>
            <div class="fb-connect"></div>
        </div>       
    </div>-->
	<div class="my-account-maincontainer">
	    <div class="myfriends-container">
   		   	<div class="container-header">
				<ul>
					<li class="active" style=" cursor:default;">My Transaction</li>
				</ul>
        	</div>
            <div class="live-score-menu">
            	<ul>
                    <li class="active" onclick="zeal.index.showContent('myteam-list', 'myteam',1, this, 'live-score-menu')">Deposit</li>
					<li onclick="zeal.index.showContent('myteam-list', 'myteam', 2, this, 'live-score-menu')">Withdrawal</li>
					<li onclick="zeal.index.showContent('myteam-list', 'myteam', 3, this, 'live-score-menu')">Transaction</li>
				</ul>
            </div>
			<div class="myteam-list" id="myteam3" style="display:none;">
				<div class="my-trans-menu">
					<div class="my-trans-sno">SNo</div>
					<div class="my-trans-date">Date</div>
					<div class="my-trans-amount">Amount</div>
					<div class="my-trans-status">Reason</div>
				</div>
				<div class="my-trans-total-values">
					<?php if ($this->_tpl_vars['trans']): ?>
					<?php $_from = $this->_tpl_vars['trans']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['trans'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['trans']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tran']):
        $this->_foreach['trans']['iteration']++;
?>
					<div class="my-trans-values">
						<div class="my-trans-sno heit"><?php echo $this->_foreach['trans']['iteration']; ?>
</div>
						<div class="my-trans-date heit"><?php echo $this->_tpl_vars['tran']['timestamp']; ?>
</div>
						<div class="my-trans-amount heit" style="width:100px;"><span class="WebRupee">Rs</span><?php echo $this->_tpl_vars['tran']['current_cash']; ?>
</div>
						<div class="my-trans-status heit" style="width:316px;"><?php echo $this->_tpl_vars['tran']['reason']; ?>
</div>
					</div>
					<?php endforeach; endif; unset($_from); ?>
					<?php else: ?>
						<div class="bonus-empty" style="min-height:200px; margin-top:20px;">No Transactions</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="myteam-list" id="myteam2" style="display:none;">
				<div class="my-trans-menu">
					<div class="my-trans-sno">SNo</div>
					<div class="my-trans-date">Date</div>
					<div class="my-trans-amount">Amount</div>
					<div class="my-trans-status">Status</div>
				</div>
				<div class="my-trans-total-values">
					<?php if ($this->_tpl_vars['withdraws']): ?>
					<?php $_from = $this->_tpl_vars['withdraws']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['withdraws'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['withdraws']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['withdraw']):
        $this->_foreach['withdraws']['iteration']++;
?>
					<div class="my-trans-values">
						<div class="my-trans-sno heit"><?php echo $this->_foreach['withdraws']['iteration']; ?>
</div>
						<div class="my-trans-date heit"><?php echo $this->_tpl_vars['withdraw']['timestamp']; ?>
</div>
						<div class="my-trans-amount heit"><span class="WebRupee">Rs</span><?php echo $this->_tpl_vars['withdraw']['amount']; ?>
</div>
						<div class="my-trans-status heit"><?php echo $this->_tpl_vars['withdraw']['status']; ?>
</div>
					</div>
					<?php endforeach; endif; unset($_from); ?>
					<?php else: ?>
						<div class="bonus-empty" style="min-height:200px; margin-top:20px;">No Withdrawals</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="myteam-list" id="myteam1">
				<div class="my-trans-menu">
                	<div class="my-dep-sno">SNo</div>
                    <div class="my-trans-date">Date</div>
                    <div class="my-dep-amount">Amount</div>
                    <div class="my-dep-paymentid">Payment Id</div>
                    <div class="my-dep-status">Status</div>
	            </div>
				<div class="my-trans-total-values">
				<?php if ($this->_tpl_vars['deposits']): ?>
				<?php $_from = $this->_tpl_vars['deposits']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['deposits'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['deposits']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['deposit']):
        $this->_foreach['deposits']['iteration']++;
?>
				<div class="my-trans-values">
					<div class="my-dep-sno"><?php echo $this->_foreach['deposits']['iteration']; ?>
</div>
					<div class="my-trans-date"><?php echo $this->_tpl_vars['deposit']['timestamp']; ?>
</div>
					<div class="my-dep-amount"><span class="WebRupee">Rs</span><?php echo $this->_tpl_vars['deposit']['amount']; ?>
</div>
					<div class="my-dep-paymentid"><?php echo $this->_tpl_vars['deposit']['payment_id']; ?>
</div>
					<div class="my-dep-status"><?php echo $this->_tpl_vars['deposit']['status']; ?>
</div>
				</div>
				<?php endforeach; endif; unset($_from); ?>
				<?php else: ?>
					<div class="bonus-empty" style="min-height:200px; margin-top:20px;">No Deposits</div>
				<?php endif; ?>
				</div>
			</div>
        </div>
		
		<div class="mybounus-container">
			<div class="container-header">
				<ul>
					<li class="active" style=" cursor:default;">My Bonus</li>
				</ul>
			</div>
			<?php if ($this->_tpl_vars['bonuses']): ?>
			<div class="myaccount-bonus-overflow">			
			<?php $_from = $this->_tpl_vars['bonuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['bonuses'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['bonuses']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['bonus']):
        $this->_foreach['bonuses']['iteration']++;
?>
			<div class="bonus-area">
				<div class="bonus-expiry-cont"><b>Expire</b> : <?php echo ((is_array($_tmp=$this->_tpl_vars['bonus']['expiry'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</div>
				<div class="bonustext">Bonus</div>
				<div class="bonus-level">
					<div style="width:<?php echo smarty_function_math(array('equation' => "( x / y ) * z",'x' => $this->_tpl_vars['bonus']['current_bonus'],'y' => $this->_tpl_vars['bonus']['bonus'],'z' => 100,'format' => '%.2f'), $this);?>
%"></div>
				</div>
				<div class="bonus-level-count"><?php echo $this->_tpl_vars['bonus']['current_bonus']; ?>
/<?php echo $this->_tpl_vars['bonus']['bonus']; ?>
</div>
				<?php if ($this->_tpl_vars['bonus']['current_bonus'] == $this->_tpl_vars['bonus']['bonus']): ?>
				<form method="post">
					<input type="submit" value="Collect" name="submitBonus" class="collect-but"/>
					<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['bonus']['id']; ?>
"/>
				</form>
				<?php else: ?>
				<input type="button" value="Collect" class="collect-but"/>
				<?php endif; ?>
			</div>
			<div class="divi-line"></div>
			<?php endforeach; endif; unset($_from); ?>			
			</div>
			<?php else: ?>
				<div class="bonus-empty">No Bonuses</div>
			<?php endif; ?>
		</div>
    </div>
</div>
