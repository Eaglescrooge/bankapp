<?php 


	session_start(); //START A SESSION
	
	include('../admin/db/db_config.php'); //WE INCLUDE OUR CONNECTION FILE

?>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Morgan Felix - Customer Login</title>
</head>

<body>

	<h1>Morgan Felix Bank</h1>
    <h2><marquee>Dear Customer, Welcome to Morgan Felix Bank</marquee></h2>
    
    <hr />
    
    
    <h3>Please enter your Account Number and Password</h3>

    <?php
        $error = [];
        if (array_key_exists('login', $_POST)) {            

           if (empty($_POST['acc_num'])) {
               $error['acc_num'] = "Please enter your Account Number";
                
           } else {
			   
			   $acc_num = mysqli_real_escape_string($db, $_POST['acc_num']);
           }

           if (empty($_POST['password'])) {
               $error['password'] = "Please enter a password";
           } else {
                $password = md5(mysqli_real_escape_string($db, $_POST['password']));
           }

           if (empty($error)) {
               $query = mysqli_query($db, "SELECT * FROM customer 
                                            WHERE account_number = '".$acc_num."' AND 
                                            password = '".$password."'

                                     ") or die(mysqli_error($db));
									 
						//echo mysqli_num_rows($query);

                if (mysqli_num_rows($query) == 1) {
                    $result = mysqli_fetch_array($query);

          $_SESSION['customer_id'] = $result['customer_id'];
          $_SESSION['account_number'] = $result['account_number'];
					$_SESSION['account_balance'] = $result['account_balance'];
					$_SESSION['firstname'] = $result['firstname'];
					$_SESSION['customer_name'] = $result['firstname'].' '.$result['lastname'];

                    header("location:customer-home.php");
                } else {
                    $err_msg = "Invalid email and/or password";

                    header("location:customer-login.php?error_message=$err_msg");
                } 
           } else {
                foreach ($error as $error) {
                    echo "<p>" .$error. "</p>";
                }
           }
        }


    ?>
    
    <form action="" method="post">
    
    	<p>Account Number: <input type="text" name="acc_num" /></p>
      <p>Password: <input type="password" name="password" /></p>

        <input type="submit" name="login" value="Login" />
    
    </form>

</body>
</html>