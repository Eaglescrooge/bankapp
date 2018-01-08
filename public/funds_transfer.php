<?php

	session_start();

	include('../admin/db/customer_authentication.php');

  	authenticate();

	include('../admin/db/db_config.php');

	$customer_id = $_SESSION['customer_id'];
	$firstname = $_SESSION['firstname'];
	$account_number = $_SESSION['account_number'];
	//$account_balance = $_SESSION['account_balance'];
	$customer_name = $_SESSION['customer_name'];
	/*$query = mysqli_query($db, "SELECT account_balance FROM customer WHERE account_number = '".$account_number."' ");
	$select = mysqli_fetch_array($query);*/
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Morgan Felix | Funds Transfer</title>
</head>

<body>
	
    <?php

		echo "<h3>Welcome, $customer_name with Account Number: $account_number</h3>";
		//echo "<h3>Your Account Balance is $" .$select['account_balance']."</h3>";
		

	?>
	
	<p><marquee>Welcome to Morgan Felix Bank. Enjoy our services</marquee></p>

	<hr />

	<a href="customer-home.php">Home</a>
    <a href ="funds_transfer.php">Funds Transfer</a>
    <a href="view_transaction.php">View Transactions</a>
	<a href="view-profile.php">View Your Profile</a>
	<a href="logout.php">Logout</a>
    
    <?php
	//HERE WE WRITE A QUERY TO SELECT THE SENDER'S ACCOUNT BALANCE
	$query = mysqli_query($db, " SELECT account_balance FROM customer 
	WHERE account_number = '".$account_number."' ") or die(mysqli_error($db));
	
		$result  = mysqli_fetch_array($query);
		
		$sender_acc_balance = $result['account_balance'];
			
	?>
    
    <h2>Funds Transfer Page</h2>
	
    <?php echo "<h3>Account balance: $".number_format($sender_acc_balance)."</h3>" ?>
    
    <?php
	
		if(array_key_exists('transfer', $_POST)){
			
			if(empty($_POST['rec_acc_num']) || empty($_POST['amount'])) {
				$msg = "Some Fields are missing";
				header("location:funds_transfer.php?msg=$msg");
			} elseif(!is_numeric($_POST['amount'])) {
				$msg = "Please Enter a Correct Value For Amount";
				header("location:funds_transfer.php?msg=$msg");
			} elseif($_POST['rec_acc_num'] == $account_number) {
				$msg = "Ogbeni be Careful ooo";
				header("location:funds_transfer.php?msg=$msg");
			} else {
				
				$recipient_acc_num = mysqli_real_escape_string($db, $_POST['rec_acc_num']);
				$transfer_amount = mysqli_real_escape_string($db, $_POST['amount']);
				
				//HERE, WE SELECT RECIPIENT'S DETAILS FROM CUSTOMER TABLE
				
			$query = mysqli_query($db, " SELECT customer_id, firstname, lastname, 
									account_balance FROM customer WHERE 
									account_number = '".$recipient_acc_num."' ") or 
									die(mysqli_error($db));
			
			if(mysqli_num_rows($query) == 1){
				
			$recipient = mysqli_fetch_array($query);
			
			$recipient_customer_id = $recipient['customer_id'];
			$recipient_name = $recipient['firstname'].' '.$recipient['lastname'];
			$recipient_current_balance = $recipient['account_balance'];
			
			//HERE WE PERFORM THE MATHEMATICAL TRANSACTION
			
				if(($sender_acc_balance -1000) < $transfer_amount) {
					
					$msg = "Insufficient Funds. Operations Failed";
					header("location:funds_transfer.php?msg=$msg");
				} else {
					
					$sender_new_balance = ($sender_acc_balance - $transfer_amount);
					$recipient_new_balance = ($transfer_amount + $recipient_current_balance);
					
				//WE UPDATE THE SENDER'S ACCOUNT BALANCE
				$sender_update = mysqli_query($db, " UPDATE customer SET 
												account_balance = '".$sender_new_balance."'
												WHERE account_number = '".$account_number."'")
												or die(mysqli_error());
												
				//WE UPDATE THE RECIEVER'S ACCOUNT BALANCE
				
				$recipient_update = mysqli_query($db, " UPDATE customer SET
												 account_balance = '".$recipient_new_balance."'
												 WHERE account_number = '".$recipient_acc_num."'")
												
												or die(mysqli_error($db));
				// WE INSERT FOR THE SENDER
				
				$sender_insert = mysqli_query($db, " INSERT INTO transaction
													VALUES(NULL,
													NOW(),
													'debit',
													'self',
													'".$recipient_name."',
													'".$transfer_amount."',
													'".$sender_acc_balance."',
													'".$sender_new_balance."',
													'".$customer_id."')") or die(mysqli_error($db));
											
				$recipient_insert = mysqli_query($db, " INSERT INTO transaction 
														VALUES(NULL,
														NOW(),
														'credit',
														'".$customer_name."',
														'self',
														'".$transfer_amount."',
														'".$recipient_current_balance."',
														'".$recipient_new_balance."',
														'".$recipient_customer_id."') ")
														
														or die(mysqli_error($db));
								
	 				$success = "Transaction Successful";
					header("location:funds_transfer.php?success=$success");
				}
			} else {
				$msg = "Operations Failed. Please Try Again";
				header("location:funds_transfer.php?msg=$msg");
			}
		}
	}
		
		if(isset($_GET['msg'])){
			echo'<h3>'.$_GET['msg'].'</h3>';
		}
		if(isset($_GET['success'])){
			echo '<h3><em>'.$_GET['success'].'</em></h3>';
		}
	
	?>
    
    
    <form action="" method="post">
    	<p>Enter Recipeint Account Number: <input type="text" name="rec_acc_num" /></p>
        <p>Enter Amount To Be Transfered: <input type="text" name="amount" /></p>
        
        <input type="submit" name="transfer" value="Click To Transfer" />
        </form>

</body>
</html>