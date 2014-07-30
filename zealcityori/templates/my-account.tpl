
<div class="my-account-maincontainer">
	<div class="myprfile-container">
    	<div class="container-header">
	      	<ul>
				<li class="active" style=" cursor:default;">My Profile</li>
            </ul>
        </div>
        <div class="divi-line"></div>
        <form action="" method="post">
	        <div class="lablename">First Name</div><div class="labletbox"><input type="text" class="bigtxt" name="txtfirstname" value="{$user->firstname}"/></div>
            <div class="lablename">Last Name</div><div class="labletbox"><input type="text" class="bigtxt" name="txtlastname" value="{$user->lastname}"/></div>
			<div class="lablename">Old Pwd</div><div class="labletbox"><input type="password" class="bigtxt" name="oldpassword" class="largetxt" value=""/></div>
			<div class="lablename">New Pwd</div><div class="labletbox"><input type="password" class="bigtxt" name="newpassword" class="largetxt" value=""/></div>
			<div class="lablename">Conf Pwd</div><div class="labletbox"><input name="confirmpassword" type="password" class="bigtxt" value=""/></div>
            <div class="lablename">DOB</div><div class="labletbox">
				<!--<input type="text" class="smalltxt" name="dob" value="{$user->dob}"/>-->
				<select name="days" id="days" class="smalltxt" style="width:40px;">
					<option value="">-</option>
					{foreach from=$days item=v}
						<option value="{$v|escape:'htmlall':'UTF-8'}" {if ($sl_day == $v)}selected="selected"{/if}>{$v|escape:'htmlall':'UTF-8'}&nbsp;&nbsp;</option>
					{/foreach}
				</select>
				<select id="months" name="months" class="smalltxt" style="width:70px;">
					<option value="">-</option>
					{foreach from=$months key=k item=v}
						<option value="{$k|escape:'htmlall':'UTF-8'}" {if ($sl_month == $k)}selected="selected"{/if}>{$v}&nbsp;</option>
					{/foreach}
				</select>
				<select id="years" name="years" class="smalltxt" style="width:60px;">
					<option value="">-</option>
					{foreach from=$years item=v}
						<option value="{$v|escape:'htmlall':'UTF-8'}" {if ($sl_year == $v)}selected="selected"{/if}>{$v|escape:'htmlall':'UTF-8'}&nbsp;&nbsp;</option>
					{/foreach}
				</select>
			</div>
            <div class="lablename">Sex</div><div class="labletbox">
				<select name="sex" class="smalltxt">
					<option value="male"{if $user->sex == 'male'} selected{/if}>Male</option>
					<option value="female"{if $user->sex == 'female'} selected{/if}>Female</option>
				</select>
			</div>
            <div class="lablename">Country</div><div class="labletbox"><input type="text" value="{$user->country}" class="bigtxt" name="country"/></div>
            <div class="lablename">State</div><div class="labletbox"><input type="text" value="{$user->state}" class="bigtxt" name="state"/></div>
            <div class="lablename">City</div><div class="labletbox"><input type="text" value="{$user->city}" class="bigtxt" name="city"/></div>
            <div class="lablename">Address</div><div class="labletbox1"><textarea name="address" class="bigtxt" style="height:65px;">{$user->address}</textarea></div>
            <div class="lablename">Pincode</div><div class="labletbox"><input type="text" name="pincode" class="smalltxt" value="{$user->pincode}"/></div>
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
      	<div class="captions">User Name</div><div class="tbox"><input type="text" class="largetxt" value="{$user->username}" disabled="disabled"/></div>
		<div class="captions">Email</div><div class="tbox"><input type="text" class="largetxt" value="{$user->email}" disabled="disabled"/></div>
        <div class="dotted-line"></div>
        <div class="fb-icon-area">
        	<img src="images/f_icon.png" class="fb-icon"/>
            <div class="fb-ac-text">FacebookAccounts</div>
			{if $user->connect.facebook}
			<div style="padding:10px; background-color:#fff; float:right; margin:0 0 0 10px;">Connected</div>
			{else}
			<a href="#" onclick="zeal.facebook.sync({$user->id});"><img src="images/sync_btn.png" class="ac-sign-button"/></a>
			{/if}            
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
                    <div class="cash-value">{$user->cash}</div>
                </div>
                <div class="d-line"></div>        	 
  				<div class="avail-area">
                	<div class="cash-name">Inplay</div>
                    <div class="cash-value">{$inprogressCash}</div>
	            </div>            	
                <div class="d-line"></div>
   				<div class="avail-area">
                   	<div class="cash-name">Total</div>
                    <div class="cash-value">{$user->cash+$inprogressCash}</div>
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
            <div class="with-captions">Available Balance</div><div class="with-colon">:</div><div class="with-tbox txtwithdraw"><span class="WebRupee">Rs</span>{$user->cash}</div>
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
            <!--<div class="with-captions">Name</div><div class="with-colon">:</div><div class="with-tbox">{$user->username}</div>-->
            <div class="with-captions">Processing time</div><div class="with-colon">:</div><div class="with-tbox" style="margin-left: 10px;">2 weeks</div>
            <div class="with-captions">Available Balance</div><div class="with-colon">:</div><div class="with-tbox txtwithdraw" ><span class="WebRupee">Rs</span>{$user->cash}</div>
            <div class="with-captions">Name</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" class="bigtxt bigtxt-in-withdrawls" name="cheqname" id="cheqname" style="margin: 0 0 0 10px;"/></div>
            <div class="with-captions">Amount to be withdrawn*</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" class="with-smalltxtbox" name="amount" id="wamount"/></div>
            <div class="with-captions">Shipping Address*</div><div class="with-colon">:</div><div class="with-tbox1"><textarea name="address" class="bigtxt" id="address" style="height:65px; width:150px;">{$user->address}</textarea></div>
            <div class="with-captions">Mobile No*</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" name="mobno" id="txtmobile" class="bigtxt bigtxt-in-withdrawls" value="{$user->mobno}"/></div>
            <div class="with-captions">Country*</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" value="{$user->country}" id="txtCountry" class="bigtxt bigtxt-in-withdrawls" name="country"/></div>
            <div class="with-captions">State*</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" value="{$user->state}" id="txtstate" class="bigtxt bigtxt-in-withdrawls" name="state"/></div>
            <div class="with-captions">City*</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" value="{$user->city}" id="txtcity" class="bigtxt bigtxt-in-withdrawls" name="city"/></div>
            <div class="with-captions">Pincode*</div><div class="with-colon">:</div><div class="with-tbox"><input type="text" name="pincode" id="txtpincode" class="bigtxt bigtxt-in-withdrawls" value="{$user->pincode}"/></div>
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
					{if $trans}
					{foreach from=$trans item=tran name=trans}
					<div class="my-trans-values">
						<div class="my-trans-sno heit">{$smarty.foreach.trans.iteration}</div>
						<div class="my-trans-date heit">{$tran.timestamp}</div>
						<div class="my-trans-amount heit" style="width:100px;"><span class="WebRupee">Rs</span>{$tran.current_cash}</div>
						<div class="my-trans-status heit" style="width:316px;">{$tran.reason}</div>
					</div>
					{/foreach}
					{else}
						<div class="bonus-empty" style="min-height:200px; margin-top:20px;">No Transactions</div>
					{/if}
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
					{if $withdraws}
					{foreach from=$withdraws item=withdraw name=withdraws}
					<div class="my-trans-values">
						<div class="my-trans-sno heit">{$smarty.foreach.withdraws.iteration}</div>
						<div class="my-trans-date heit">{$withdraw.timestamp}</div>
						<div class="my-trans-amount heit"><span class="WebRupee">Rs</span>{$withdraw.amount}</div>
						<div class="my-trans-status heit">{$withdraw.status}</div>
					</div>
					{/foreach}
					{else}
						<div class="bonus-empty" style="min-height:200px; margin-top:20px;">No Withdrawals</div>
					{/if}
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
				{if $deposits}
				{foreach from=$deposits item=deposit name=deposits}
				<div class="my-trans-values">
					<div class="my-dep-sno">{$smarty.foreach.deposits.iteration}</div>
					<div class="my-trans-date">{$deposit.timestamp}</div>
					<div class="my-dep-amount"><span class="WebRupee">Rs</span>{$deposit.amount}</div>
					<div class="my-dep-paymentid">{$deposit.payment_id}</div>
					<div class="my-dep-status">{$deposit.status}</div>
				</div>
				{/foreach}
				{else}
					<div class="bonus-empty" style="min-height:200px; margin-top:20px;">No Deposits</div>
				{/if}
				</div>
			</div>
        </div>
		
		<div class="mybounus-container">
			<div class="container-header">
				<ul>
					<li class="active" style=" cursor:default;">Xtra Cash</li>
				</ul>
			</div>
			{if $bonuses}
			<div class="myaccount-bonus-overflow">			
			{foreach from=$bonuses item=bonus name=bonuses}
			<div class="bonus-area">
				<div class="bonus-expiry-cont"><b>Expire</b> : {$bonus.expiry|date_format}</div>
				<div class="bonustext">Bonus</div>
				<div class="bonus-level">
					<div style="width:{math equation="( x / y ) * z" x=$bonus.current_bonus y=$bonus.bonus z=100 format='%.2f'}%"></div>
				</div>
				<div class="bonus-level-count">{$bonus.current_bonus}/{$bonus.bonus}</div>
				{if $bonus.current_bonus == $bonus.bonus}
				<form method="post">
					<input type="submit" value="Collect" name="submitBonus" class="collect-but"/>
					<input type="hidden" name="id" value="{$bonus.id}"/>
				</form>
				{else}
				<input type="button" value="Collect" class="collect-but"/>
				{/if}
			</div>
			<div class="divi-line"></div>
			{/foreach}			
			</div>
			{else}
				<div class="bonus-empty">No Bonuses</div>
			{/if}
		</div>
    </div>
</div>

