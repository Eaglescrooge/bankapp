<?php

	include('db_config.php');
	
	function authenticate() {
		
		if(!isset($_SESSION['administrator_id']) && !isset($_SESSION['administrator_name'])){
			
			header("location:admin_login.php");
		}
	}
	
	function showcustomer($dummy){
		$result = "";
		
		while($select = mysqli_fetch_array($dummy)){
			$result .= "<tr><td>".$select['1'].' '.$select['2']."</td>";
			$result .= "<td>".$select['3']."</td>";
			$result .= "<td>".$select['4']."</td>";
			$result .= "<td>".$select['5']."</td>";
			$result .= "<td>".$select['6']."</td>";
			$result .= "<td>".$select['7']."</td>";
			$result .= "<td>".$select['8']."</td></tr>";
		}
		
		return $result;
	}
?>