	<?php
	require_once 'connection.php';
	if(ISSET($_POST['savestock'])){
		$warnn = $_POST['warnn'];
		$item = $_POST['item'];
		$qty = $_POST['qty'];
		$bprice = $_POST['bprice'];
		$sprice=$_POST['sprice'];
		$ddate=date('Y-m-d');
		$ttpe=$_POST['ttype'];  

$sql = "INSERT INTO `stockIn` (date,item, qty, bprice, sprice,dqty, status, ttype,warnn)
 VALUES ('$ddate','$item', '$qty', '$bprice', '$sprice','$qty','1','$ttpe','$warnn')";
		$conn->exec($sql);

	

				echo "<script>alert(' informational saved very well!')</script>";
				echo "<script>window.location='dashboard.php'</script>";
		}else{
			echo "<script>alert('there was an error!')</script>";
			echo "<script>window.location='dashboard.php'</script>";
		}


			?>