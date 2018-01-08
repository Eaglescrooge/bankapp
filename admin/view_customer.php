<?php

	session_start();
	//include ('db/db_config.php');
	include('db/authentication.php');
	
	authenticate();
	
	$admin_id = $_SESSION['administrator_id'];
	$admin_name = $_SESSION['administrator_name'];
	
	$select = mysqli_query($db, "SELECT * FROM customer") or die(mysqli_error($db))


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	
		echo"<h3 align=\"center\">Welcome, $admin_name with ID $admin_id</h3>";
		echo "<h3 align=\"center\">You're Logged in as an Administrator</h3>"
	
	?>
    <h3>View Customer Page</h3>
    
    <hr/>
    
    <a href="admin_home.php">Home</a>
    <a href="add_customer.php">Add Customer</a>
    <a href="view_customer.php">View Customers</a>
    <a href="">Update Customers</a>
    <a href="logout.php">Click to Logout</a>
    
    <hr/>
    
    <table border="1">
    	<tr>
        <th>Customer Name</th><th>Customer Email</th><th>Customer Phone Number</th>
        <th>Account Type</th><th>Opening Balance</th><th>Account Balance</th><th>Account Number</th></tr>
        
        
        <?php $data = showcustomer($select);
				echo $data;
		 ?>
        
        
        
        
        
         

</body>
</html>