	<?php
	require_once 'connection.php';
	if(ISSET($_POST['savesale'])){
		$id= $_POST['id'];
		$itemid=$_POST['id'];
		$sitem = $_POST['sitem'];
		$sqty = $_POST['sqty'];
		$dqty = $_POST['dqty'];
		$sbprice = $_POST['sbprice'];
		$ssprice=$_POST['ssprice'];
		$ttype=$_POST['ttype'];
		$ddate=date('Y-m-d');
		$quant =$dqty-$sqty;
		$total = $sqty * $ssprice; 
		 if($quant<0 && $ttype=='stock'){
			echo "<script>alert('You don't have enough')</script>";
			echo "<script>window.location='dashboard.php'</script>";
		 }else{
		
$sql1="UPDATE stockIn set dqty='$quant' WHERE id='$id'";
$conn->exec($sql1);

$sql = "INSERT INTO `stockOut` (itemid,ddate,sitem, sqty, sbprice, ssprice)
 VALUES ('$itemid','$ddate','$sitem', '$sqty', '$sbprice', '$ssprice')";
		$conn->exec($sql);

		$sql2 = "INSERT INTO `receipt` (itemid,ddate,sitem, sqty, sbprice, ssprice, total, fullname, addresss, phone)
		VALUES ('$itemid','$ddate','$sitem', '$sqty','$sbprice','$ssprice','$total','0','0','0')";
			   $conn->exec($sql2);

				echo "<script>alert('Sale saved very well!')</script>";
				echo "<script>window.location='dashboard.php'</script>";
		 }

	}
			?>