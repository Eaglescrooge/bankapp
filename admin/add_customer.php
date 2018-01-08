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
	
		echo"<h3>You are Administrator $admin_name with ID $admin_id</h3>";
	
	?>
    <h3>Customer Registration Page</h3>
    
    <hr/>
    
    <a href="admin_home.php">Home</a>
    <a href="add_customer.php">Add Customer</a>
    <a href="view_customer.php">View Customers</a>
    <a href="update_customer.php">Update Customers</a>
    <a href="logout.php">Click to Logout</a>
    
    <hr/>
    
    <h3>Customer Registration Form</h3>
    
    <p>Please Fill in the details below</p>
    
    <?php
	
		if(isset($_POST['reg'])){
			
			$error = array();
			
			if(empty($_POST['fname'])){
				$error[] = "Enter Customer Firstname";				
			} else{
				$fname = mysqli_real_escape_string($db,$_POST['fname']);
				}
			if(empty($_POST['lname'])){
				$error[] = "Enter Customer Lastname";				
			} else{
				$lname = mysqli_real_escape_string($db,$_POST['lname']);
				}
			if(empty($_POST['mail'])){
				$error[] = "Enter Customer Email";				
			} else{
				$mail = mysqli_real_escape_string($db,$_POST['mail']);
				}
			if(empty($_POST['p_number'])){
				$error[] = "Enter Customer Phone Number";				
			} else{
				$p_number = mysqli_real_escape_string($db,$_POST['p_number']);
				}
			if(empty($_POST['acc_type'])){
				$error[] = "Enter Customer Account Type";				
			} else{
				$acc_type = mysqli_real_escape_string($db,$_POST['acc_type']);
				}
			if(empty($_POST['o_bal'])){
				$error[] = "Enter Customer Opening Balance";
			} elseif (!is_numeric($_POST['o_bal'])){
				$error[] = "Enter a Valid Amount For Opening Balance";				
			} else{
				$o_balance = mysqli_real_escape_string($db,$_POST['o_bal']);
				}
			if(empty($_POST['pword'])){
				$error[] = "Enter Customer Password";				
			} else{
				$password = md5(mysqli_real_escape_string($db,$_POST['pword']));
				}
				
			if(empty($error)){
				$insert = mysqli_query($db, "INSERT INTO customer
											VALUES(NULL,
												   '".$fname."',
												   '".$lname."',
												   '".$mail."',
												   '".$p_number."',
												   '".$acc_type."',
												   '".$o_balance."',
												   '".$o_balance."',
												   '".rand(0000000000, 9999999999)."',
												   '".$password."',
												   '".$admin_id."')
										") or die(mysqli_error($db));
									
						$success = "Customer Successfully Added";
					header("location:add_customer.php?success=$success"); 
				} else {
					foreach ($error as $error){
						echo "<p>$error</p>";
					}
				}
			
		}
	
	
		if(isset($_GET['success'])){
			echo '<p><strong>'.$_GET['success'].'</strong></p>';
		}
	?>
    
    <form action="" method="post">
    
    	<p>Firstname: <input type="text" name="fname" /></p>
        <p>Lastname: <input type="text" name="lname" /></p>
        <p>Email: <input type="email" name="mail" /></p>
        <p>Phone Number: <input type="text" name="p_number" /></p>
        <p>Account Type: Savings
        <input type="radio" name="acc_type" value="savings" />
        
        Current
        <input type="radio" name="acc_type" value="Current" />
        
        Domicillary
        <input type="radio" name="acc_type" value="domicillary" /></p>
        
        <p>Opening Balance: <input type="text" name="o_bal" /></p>
        <p>Password: <input type="password" name="pword" /></p>
        
        <input type="submit" name="reg" value="Click to Register" />
    

</body>
</html>