<?php

	session_start(); //WE START OUR SESSION
	
	include('db/db_config.php'); // WE INCLUDE OUR DB CONNECTION FILE

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Morgan Felix Bank - Admin Login</title>
</head>

<body>

	<h1>Morgan Felix Bank</h1>
    <h2><marquee>Welcome to Morgan Felix Bank</marquee></h2>
    
    <hr/>
    
    <h3>Please Enter Your Username and Password</h3>
    
    <?php
	
		if (array_key_exists('login', $_POST)){
			
			$error = array(); //WE INNITIALIZE THE ERROR ARRAY
			
			if(empty($_POST['uname'])){
				$error[] = "Please enter your Username";
			} else {
				$uname = mysqli_real_escape_string($db,$_POST['uname']);
			}
			
			if(empty($_POST['pword'])){
				$error[] = "Please enter your Password";
			} else {
				$password = md5(mysqli_real_escape_string($db,$_POST['pword']));
			}
			
			if(empty($error)){ // IF OUR ERROR ARRAY IS EMPTY
			
			$query = mysqli_query($db, "SELECT * FROM admin 
			                      WHERE admin_name = '".$uname."' AND
								  secured_password = '".$password."'					  
								  ") or die(mysqli_error($db));
								  
								  
				if(mysqli_num_rows($query) == 1){
					
					$result = mysqli_fetch_array($query);
					
					//WE ESTABLISH SESSIONS FOR THE ADMIN
					$_SESSION['administrator_id'] = $result['admin_id'];
					$_SESSION['administrator_name'] = $result['admin_name'];
					
					//WE NOW LOGIN THE ADMIN
					header("location:admin_home.php");
					
				} else {
					
										
					$err_msg = "Invalid Username and/or Password";
					
					header("location:admin_login.php?error_message=$err_msg");
					
					//echo "<b>Invalid Username and/or Password</b>";

					
				}
				  
								  
			} else { //MEANING ERROR IS NOT EMPTY
				
				foreach($error as $error){
					echo "<p>".$error."</p>";
				}
			}
		}
		
		if(isset($_GET['$error_message'])){
			echo '<p><b>'.$_GET['error_message'].'</b><p>';
		}
	?>
    
    
    
    <form action="" method="post">  
    	
        <p>Username: <input type="text" name="uname" /></p>
        <p>Password: <input type="password" name="pword" /></p>
        <input type="submit" name="login" value="Click to Login" />

</body>
</html>