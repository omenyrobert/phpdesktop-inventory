<?php
	require_once'connection.php';
 
if(ISSET($_POST['edititem'])){
	   $id=$_POST['id'];
		$item = $_POST['sitem'];
		$qty = $_POST['sqty'];
		$bprice = $_POST['sbprice'];
		$sprice=$_POST['ssprice'];		

$sql = "UPDATE stockOut SET sitem='$item', sqty='$qty', sqty='$qty', sbprice='$bprice', ssprice='$sprice' WHERE id='$id'";
$conn->exec($sql);

 				echo "<script>alert('Information updated successfully!')</script>";
				echo "<script>window.location='stockedit.php'</script>";
		}else{
			echo "<script>alert('there was an error!')</script>";
			echo "<script>window.location='stockedit.php'</script>";
		}
?>
