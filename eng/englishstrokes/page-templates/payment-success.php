<?php
/**
 * Template Name: Payment Success Page Template
 *
 * Description: Course page contains chapters of that course
 */
get_header();


if(is_user_logged_in()):

 $sql = 'SELECT * FROM payment_details pd 
		INNER JOIN payment p ON p.id_payment = pd.PaymentID
		WHERE pd.payment_id = '.(int)($_REQUEST['id']).' ' ;
	$result = mysql_fetch_array(mysql_query($sql));
	$userId = $result['id_user'];
if ($userId == $current_user->ID):
?>
<div class="title1 trebuchet">Payment Success</div>
<div class="clear"></div>
<div class="payment-success-container">
	<?php
	
	echo 'Payment Id : '.$result['PaymentID'].'<br/><br/>';
	echo 'TransactionID : '.$result['TransactionID'].'<br/><br/>';
	echo 'Amount : Rs.'.$result['Amount'].'<br/><br/>';
	echo 'Date : '.$result['DateCreated'].'<br/><br/>';
	?>
	Thank you for your payment. Your payment have been processed successfully. Now you can enjoy the content.
</div>
<?php
else:
	echo '<h2>Unauthorised Access</h2>';
endif;
else:
	echo '<h2>Unauthorised Access</h2>';
endif;
get_footer();