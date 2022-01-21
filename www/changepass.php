<?php
	require_once 'conn.php';
 
if(ISSET($_POST['changep'])){
	    $uid = $_POST['uid'];
		$username = $_POST['username'];
		$password=$_POST['password'];		

$sql = "UPDATE member SET username='$username',password='$password' WHERE mem_id='$uid'";

		$conn->exec($sql);

 				echo "<script>alert('password and username updated successfully!')</script>";
				echo "<script>window.location='index.php'</script>";
		}else{
			echo "<script>alert('there was an error!')</script>";
			echo "<script>window.location='dashboard.php'</script>";
		}
?>
