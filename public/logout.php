<?php

	unset($_SESSION['customer_id']);
	unset($_SESSION['customer_fname']);

	header("location:customer-login.php");

?>

</body>
</html>