
<?php
require_once'connection.php';



	$sql=$conn->query("SELECT SUM(total) AS cou FROM `receipt`") or die("Failed to fetch row!");
						while($fetch=$sql->fetchArray())
   {
                         	$gtotal = ""." ".$fetch['cou'];
                         }


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>System</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="datatable/dataTable.bootstrap.min.css">
	<style>
		.bod{
	background-color: white;
	color: black;
}
		.height10{
			height:10px;
		}
		.mtop10{
			margin-top:10px;
		}
		.modal-label{
			position:relative;
			top:7px
		}
	</style>
</head>
<body>
<p onclick="window.print();">Print</p>
<a href="dashboard.php">back</a>
<div style="margin:100px; width: 480px;">
<h3 style="text-align: center;"><b> My Friends Family Clinic</b> </h3>
<div style="display:flex; justify-content: space-between;">
<h5>location: Misindye, seeta Road</h5>
    <h5>Contacts: +256 703521773</h5>
</div>
<div style="display:flex; justify-content: space-between;">
    <h5><?php echo date('d-m-Y h:i:sa');?></h5>
    
    </div>
<table  style=" color: black; background-color: white; width: 450px;" class="table">
<thead>
   
					<tr><th>Item</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Total</th>
						
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');




   $query=$conn->query("SELECT * FROM  `receipt`") or die("Failed to fetch row!");
						while($fetch=$query->fetchArray()){
							{
	?>
        <tr>
	   		<td><?php echo  $fetch['sitem'];?></td>
	   		<td><?php echo number_format((float)$fetch['sqty']);?></td>
	   		<td><?php echo number_format((float)$fetch['ssprice']);?></td>
	   		<td><b> <?php echo number_format((float)$fetch['total']);?></b></td>
				
	   	</tr>


     <?php
   }
}


?>
<tr><td colspan="3"><h4>Total</h4></td> <td><h4><?php echo number_format((float)$gtotal); ?></h4></td></tr>

<?php
include_once('connection.php');




   $query=$conn->query("SELECT * FROM  `receipt` LIMIT 1") or die("Failed to fetch row!");
						while($fetch=$query->fetchArray()){
							{
	?>
    <tr>
	<td><b><?php echo $fetch['fullname'];?> </b></td>
	   		<td><b><?php echo $fetch['phone'];?></b></td>
	   		<td><b><?php echo $fetch['addresss'];?></b></td>
                            </tr>
	   		
			   <?php   
   }
}


?>
	   	
</tbody>

</table>
</div>
<a href="transfer.php?clear=all" onclick="return confirm('Are you sure u want to clear the receipt?')">Clear</a>
</body>

</html>
