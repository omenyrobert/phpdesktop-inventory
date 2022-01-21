<?php
	require_once'connection.php';
 
if(ISSET($_POST['edititem'])){
	   $id=$_POST['id'];
		$item = $_POST['item'];
		$qty = $_POST['qty'];
		$bprice = $_POST['bprice'];
		$sprice=$_POST['sprice'];
		$warnn = $_POST['warnn'];		

$sql = "UPDATE stockIn SET item='$item',qty='$qty', dqty='$qty', bprice='$bprice', sprice='$sprice',warnn='$warnn' WHERE id='$id'";

		$conn->exec($sql);

 				echo "<script>alert('Information updated successfully!')</script>";
				echo "<script>window.location='dashboard.php'</script>";
		}else{
			echo "<script>alert('there was an error!')</script>";
			echo "<script>window.location='dashboard.php'</script>";
		}
?>
