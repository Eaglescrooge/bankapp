<?php
	session_start();
	
	//include('db/db_config.php');
	include('db/authentication.php');
	
	authenticate();
	
	$admin_id = $_SESSION['administrator_id'];
	$admin_name = $_SESSION['administrator_name']

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Home</title>
</head>

<body>
	
	<?php
	
		echo"<h3>Welcome, Administrator $admin_name with ID $admin_id</h3>";
	
	?>
    <p>Welcome to Morgan Felix Bank. Please perform your Administrative duties with Utmost Diligence</p>
    
    <hr/>
    
    <a href="admin_home.php">Home</a>
    <a href="add_customer.php">Add Customer</a>
    <a href="view_customer.php">View Customers</a>
    <a href="update_customer.php">Update Customers</a>
    <a href="logout.php">Click to Logout</a>
    

</body>
</html>