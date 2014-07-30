<?php
/**
 * Template Name: Payment Return Page Template
 *
 * Description: Course page contains chapters of that course
 */
 get_header();

 	//$user_id = get_current_user_id();
	global $current_user;
	$user_id = $current_user->ID;
	$secret_key = "92f685f3a4af1de2afb4a1459a82f036";	 // Your Secret Key
	if(isset($_GET['DR']))
	{
		require('classes/Rc43.php');
		$DR = preg_replace("/\s/","+",$_GET['DR']);
		$rc4 = new Crypt_RC4($secret_key);
		$QueryString = base64_decode($DR);
		$rc4->decrypt($QueryString);
		$QueryString = split('&',$QueryString);
		$response = array();
		foreach($QueryString as $param)
		{
			$param = split('=',$param);
			$response[$param[0]] = urldecode($param[1]);
		}
		$course_id = $response['MerchantRefNo'];
		$payment_id = $response['PaymentID'];
		$amount = $response['Amount'];
		if($response['ResponseCode'] == '0')
			$status = 'success';
		else
			$status = 'failure';
		$duration = 3;
		$sql = 'SELECT * FROM courses WHERE id = '.$course_id;
		$course = mysql_fetch_array(mysql_query($sql));
		$duration = $course['duration'];
		$time = strtotime(date("Y-m-d H:i:s", strtotime($response['DateCreated'])) . " +".$duration." month");
		$timestamp = date('Y-m-d H:i:s', $time);
		$sql = 'SELECT * FROM payment WHERE id_payment = '.$payment_id;
		$num_rows = mysql_num_rows(mysql_query($sql));
		if($num_rows == 0 && $course['price'] == $amount)
		{
			$sql = 'INSERT INTO `payment`(`id_user`, `id_course`, `id_payment`, `amount`, `status`, `timestamp`, expiry) 
					VALUES('.$user_id.', '.$course_id.', '.$payment_id.', '.$amount.', \''.$status.'\', \''.$response['DateCreated'].'\', \''.$timestamp.'\')';
			mysql_query($sql);
			$payment_id = mysql_insert_id();
			$sql = 'INSERT INTO `payment_details`(`payment_id`, `ResponseCode`, `ResponseMessage`, `DateCreated`, `PaymentID`, `MerchantRefNo`, Amount, 
					`Mode`, `BillingName`, `BillingAddress`, `BillingCity`, `BillingState`, `BillingPostalCode`, `BillingCountry`, `BillingPhone`, `BillingEmail`, 
					`DeliveryName`, `DeliveryAddress`, `DeliveryCity`, `DeliveryState`, `DeliveryPostalCode`, `DeliveryCountry`, `DeliveryPhone`, `Description`, 
					`IsFlagged`, `TransactionID`, `PaymentMethod`)  
					VALUES('.$payment_id.', \''.$response['ResponseCode'].'\', \''.$response['ResponseMessage'].'\', \''.$response['DateCreated'].'\', \''.$response['PaymentID'].'\'
					, \''.$response['MerchantRefNo'].'\', \''.$response['Amount'].'\', \''.$response['Mode'].'\', \''.$response['BillingName'].'\', \''.$response['BillingAddress'].'\'
					, \''.$response['BillingCity'].'\', \''.$response['BillingState'].'\', \''.$response['BillingPostalCode'].'\', \''.$response['BillingCountry'].'\', \''.$response['BillingPhone'].'\'
					, \''.$response['BillingEmail'].'\', \''.$response['DeliveryName'].'\', \''.$response['DeliveryAddress'].'\', \''.$response['DeliveryCity'].'\', \''.$response['DeliveryState'].'\'
					, \''.$response['DeliveryPostalCode'].'\', \''.$response['DeliveryCountry'].'\', \''.$response['DeliveryPhone'].'\', \''.$response['Description'].'\', \''.$response['IsFlagged'].'\'
					, \''.$response['TransactionID'].'\', \''.$response['PaymentMethod'].'\')';
			mysql_query($sql);
			include 'classes/Mail.php';
			$mail = new Mail();
			$to = $current_user->user_email;
			//$to = 'mohan@zealcity.com';
			$name = $current_user->display_name;
			$deposit_money = $amount;
			$mail->depositMail($to, $name, $deposit_money);
			$to = 'mohan@zealcity.com,adit@zcstudio.com,sri@t20learning.com,surya@t20learning.com,ganesh@krishcricket.com';
			$mail->depositMailNotification($to, $name, $deposit_money);
		}
		else
			$status = 'failure';
	}
 ?>
 <?php if($status == 'success'):?>
 <script type="text/javascript">window.location.href = '<?php bloginfo('home');?>/payment-success/?id=<?php echo $payment_id;?>';</script>
 <?php else:?>
 <script type="text/javascript">window.location.href = '<?php bloginfo('home');?>/payment-failure';</script>
 <?php endif;?>
 <?php
 get_footer();