<?php

	session_start();

    include('../admin/db/customer_authentication.php');

    authenticate();


	include('../admin/db/db_config.php');

	$select = mysqli_query($db, "SELECT * FROM transaction WHERE
	 customer_id = '".$_SESSION['customer_id']."'") or die(mysqli_error($db));
	
	
	$customer_id = $_SESSION['customer_id'];
	$firstname = $_SESSION['firstname'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Treansaction</title>
</head>

<body>
	
    <h3>Transaction Details</h3>
    
    <hr/>
    
    <a href="customer-home.php">Home</a>
    <a href ="funds_transfer.php">Funds Transfer</a>
    <a href="view_transaction.php">View Transactions</a>
	<a href="view-profile.php">View Your Profile</a>
	<a href="logout.php">Logout</a>

	<hr />
    
    <table border="1">
    		<tr>
            <th>Transaction ID</th>
            <th>Transaction Date</th>
            <th>Transaction Type</th>
            <th>Sender</th>
            <th>Recipient</th>
            <th>Transfer Amount</th>
            <th>Initial Balance</th>
            <th>Final Balance</th>
            <th>Customer ID</th>
            </tr>
            
            <tr>
            <?php while ($result = mysqli_fetch_array($select)) { ?>
            <td><?php echo $result['transaction_id'] ?></td>
            <td><?php echo $result['transaction_date'] ?></td>
            <td><?php echo $result['transaction_type'] ?></td>
            <td><?php echo $result['sender'] ?></td>
            <td><?php echo $result['recipient'] ?></td>
            <td><?php echo number_format($result['transfer_amount'])?></td>
            <td><?php echo number_format($result['initial_balance']) ?></td>
            <td><?php echo number_format($result['final_balance']) ?></td>
            <td><?php echo $result['customer_id'] ?></td>
            </tr>
            
            <?php } ?>
   	
    


</body>
</html>