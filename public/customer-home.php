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
	$query = mysqli_query($db, "SELECT account_balance FROM customer WHERE account_number = '".$account_number."' ");
	$select = mysqli_fetch_array($query);
	

?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Customer Home</title>
</head>

<body>

	<?php

		echo "<h3>Welcome, $customer_name with Account Number: $account_number</h3>";
		echo "<h3>Your Account Balance is $" .number_format($select['account_balance'])."</h3>";
		

	?>

	<p>Welcome to Morgan Felix Bank. Enjoy our services</p>

	<hr />

	<a href="customer-home.php">Home</a>
    <a href ="funds_transfer.php">Funds Transfer</a>
    <a href="view_transaction.php">View Transactions</a>
	<a href="view-profile.php">View Your Profile</a>
	<a href="logout.php">Logout</a>

</body>
</html>