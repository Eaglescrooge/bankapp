<?php

	session_start();

	include('../admin/db/customer_authentication.php');

	authenticate();

	include('../admin/db/db_config.php');

	$select = mysqli_query($db, "SELECT * FROM customer WHERE customer_id = '".$_SESSION['customer_id']."'") or die(mysqli_error($db));

	$customer_id = $_SESSION['customer_id'];
	$firstname = $_SESSION['firstname'];

?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Customer Page</title>
</head>

<body>

	<h3>Customer Details</h3>

	<hr />

	<a href="customer-home.php">Home</a>
    <a href ="funds_transfer.php">Funds Transfer</a>
    <a href="view_transaction.php">View Transactions</a>
	<a href="view-profile.php">View Your Profile</a>
	<a href="logout.php">Logout</a>

	<hr />

	<table border="1">
		<tr>
			<th>Customer ID</th>
			<th>Firstname</th>
			<th>lastname</th>
			<th>email</th>
			<th>Phone Number</th>
			<th>Account Type</th>
			<th>Opening Balance</th>
			<th>Account Balance</th>
			<th>Account Number</th>
		</tr>

		<tr>
			<?php while ($result = mysqli_fetch_array($select)) { ?>
				<td><?php echo $result['customer_id']?></td>
				<td><?php echo $result['firstname']?></td>
				<td><?php echo $result['lastname']?></td>
				<td><?php echo $result['email'] ?></td>
				<td><?php echo $result['phone_number']?></td>
				<td><?php echo $result['account_type']?></td>
				<td><?php echo number_format($result['opening_balance'])?></td>
				<td><?php echo number_format($result[7])?></td>
				<td><?php echo $result[8]?></td>
		</tr>
			<?php } ?>

</body>
</html>