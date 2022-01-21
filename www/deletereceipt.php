<?php

require_once'connection.php';

if(ISSET($_REQUEST['id'])){
		$id=$_REQUEST['id'];
 
		$conn->query("DELETE FROM `receipt` WHERE `itemid`='$id'") or die("Failed to delete a row!");

		$conn->query("DELETE FROM `stockOut` WHERE `itemid`='$id'") or die("Failed to delete a row!");

		echo "<script>alert(' informational deleted successfully!')</script>";
				echo "<script>window.location='dashboard.php'</script>";
	
	}
    ?>