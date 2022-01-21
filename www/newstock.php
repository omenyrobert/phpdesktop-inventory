<?php
	require_once 'connection.php';
	if(ISSET($_POST['newstock'])){
		$warnn = $_POST['warnn'];
        $id = $_POST['id'];
		$item = $_POST['item'];
		$qty = $_POST['qty'];
		$dqty = $_POST['qty'];
		$bprice = $_POST['bprice'];
		$sprice=$_POST['sprice'];
		$ttype=$_POST['ttype'];
		$ddate=date('Y-m-d');
		

        $sql2 = "UPDATE `stockIn` SET status='0' WHERE id='$id'";
		$conn->exec($sql2);   

$sql = "INSERT INTO `stockIn` (date,item, qty, dqty, bprice, sprice,status,ttype,warnn)VALUES ('$ddate','$item', '$qty','$dqty', '$bprice', '$sprice','1','$ttype','$warnn')";
 
		$conn->exec($sql);

				echo "<script>alert(' informational saved very well!')</script>";
				echo "<script>window.location='dashboard.php'</script>";
		}else{
			echo "<script>alert('there was an error!')</script>";
			echo "<script>window.location='dashboard.php'</script>";
		}


			?>