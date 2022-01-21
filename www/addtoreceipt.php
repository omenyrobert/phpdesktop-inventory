<?php
	require_once'connection.php';
 
if(ISSET($_POST['addtoreceipt'])){
	    $ddate=date('Y-m-d');
		$fullname = $_POST['fullname'];
		$addresss = $_POST['addresss'];
		$phone = $_POST['phone'];

$sql = "UPDATE receipt SET fullname='$fullname',addresss='$addresss', phone='$phone'";
		$conn->exec($sql);

		$sql2 = "INSERT INTO `stockOut` (itemid,sitem, sqty, sbprice, ssprice,ddate,fullname,addresss,phone)
		VALUES ('', '', '','','','$ddate','$fullname','$addresss','$phone')";
			   $conn->exec($sql2);	
	

 				echo "<script>alert('Information added successfully!')</script>";
				echo "<script>window.location='dashboard.php'</script>";
		}else{
			echo "<script>alert('there was an error!')</script>";
			echo "<script>window.location='dashboard.php'</script>";
		}
?>
