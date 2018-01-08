<?php

	include('db_config.php');

	function authenticate() {

		if(!isset($_SESSION['customer_id']) && !isset($_SESSION['customer_name'])) {

			header("location:customer-login.php");
		}
	}