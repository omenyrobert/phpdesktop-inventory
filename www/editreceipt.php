<?php
	require_once'connection.php';
 
if(ISSET($_POST['editreceipt'])){
	   $id=$_POST['id'];
       $price =$_POST['ssprice'];
		$qty = $_POST['qty'];
        $sprice = $price*$qty;
				

$sql2 = "UPDATE receipt SET sqty='$qty', total='$sprice' WHERE itemid='$id'";
$conn->exec($sql2);

$sql = "UPDATE stockOut SET sqty='$qty', total='$sprice' WHERE itemid='$id'";

		$conn->exec($sql);

 				echo "<script>alert('Information updated successfully!')</script>";
				echo "<script>window.location='dashboard.php'</script>";
		}else{
			echo "<script>alert('there was an error!')</script>";
			echo "<script>window.location='dashboard.php'</script>";
		}
?>
