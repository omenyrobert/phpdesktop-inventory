

<?php
require_once'connection.php';



 if(ISSET($_REQUEST['id'])){
		$id=$_REQUEST['id'];
 
		$conn->query("DELETE FROM `stockIn` WHERE `id`='$id'") or die("Failed to delete a row!");
		echo "<script>alert(' informational deleted successfully!')</script>";
				echo "<script>window.location='dashboard.php'</script>";
	
	}


	$sql=$conn->query("SELECT COUNT(*) AS cou FROM `stockIn`") or die("Failed to fetch row!");
						while($fetch=$sql->fetchArray())
   {
                         	$output = ""." ".$fetch['cou'];
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
<body class="bod">
<div class="container-fluid">

   	<div  style="background-color: #c210e8; color: white; height: 200px;" class="container-fluid">
	<h1 class="page-header text-center" style="font-size: 50px;">INVENTORY SOFTWARE</h1>
	<a href="dashboard.php" style="color: white;"><h4>Dashboard</h4>
		  <form action="" method="GET" >
            	<div class="row">
            		<div class="col-md-4">
            			<input type="date" name="from_date" class="form-control" >
            		</div>

            		<div class="col-md-4">
            			<input type="date" name="to_date" class="form-control" >
            		</div>

            		<div class="col-md-4">
            			<button class="form-control btn-primary " type="submit" >Generate</button>
            		</div>
            		
            	</div>

            </form>
            <p onclick="window.print();" >PDF</p>
		
	<br/><br/>
</div><br/><br/>

      



<br/>
 
<div id="profit">



<br/><br/>
<a href="#stock">Stock</a>
<h4>Profits From Services</h4>

<table id="myTable2" style=" color: black; background-color: white;" class="table table-bordered">
<thead>
					<tr>
						<th>Date</th>
						<th>Item</th>
						<th>Quantity</th>
						<th>Quantity Sold</th>
						<th>Quantity Remaining</th>
						<th>Costs</th>
						<th>Sales</th>
						<th>Profits</th>
					</tr>
				</thead>
<tbody>



 	<?php
include_once('connection.php');

if(isset($_GET['from_date'])&&isset($_GET['to_date']))
{
	$from_date=$_GET['from_date'];
	$to_date=$_GET['to_date'];


   $query=$conn->query("SELECT *,  SUM(sqty) FROM  `stockIn` INNER JOIN `stockOut` ON `stockOut`.sitem = `stockIn`.item WHERE ddate BETWEEN '$from_date' AND '$to_date' AND ttype='service' GROUP BY sitem") or die("Failed to fetch row!");
						while($fetch=$query->fetchArray()){
							{
	?>
        
        	<tr>
        		<td><?php echo  $fetch['ddate'];?></td>
        		<td><?php echo  $fetch['sitem'];?></td>
        		<td><?php echo $fetch['qty'];?></td>
        		<td><?php echo $fetch['SUM(sqty)'];?></td>
        		<td><?php echo $fetch['qty']-$fetch['SUM(sqty)'];?></td>
        		<td><?php echo number_format((float)$fetch['bprice']*$fetch['SUM(sqty)']);?></td>
        		<td><?php echo number_format((float)$fetch['sprice']*$fetch['SUM(sqty)']);?></td>
        		<td><?php echo number_format((float) $fetch['SUM(sqty)']*($fetch['ssprice']-$fetch['sbprice']));?></td>
        		
	   	
	   	</tr>
	  
	   		
     <?php
   }
}
}


?>
 
  <?php
include_once('connection.php');

 $pro=0;
   $cost=0;
   $sale=0;
if(isset($_GET['from_date'])&&isset($_GET['to_date']))
{
	$from_date=$_GET['from_date'];
	$to_date=$_GET['to_date'];

   $query=$conn->query("SELECT *, SUM(sqty) FROM  `stockIn`  INNER JOIN `stockOut` ON `stockOut`.sitem = `stockIn`.item WHERE ddate BETWEEN '$from_date' AND '$to_date' AND ttype='service' GROUP BY sitem") or die("Failed to fetch row!");
  
						while($fetch=$query->fetchArray()){
							{

								$pro+=$fetch['SUM(sqty)']*($fetch['ssprice']-$fetch['sbprice']);
								$cost+=$fetch['bprice']*$fetch['SUM(sqty)'];
								$sale+=$fetch['sprice']*$fetch['SUM(sqty)'];

								
	?>
	
	   
  <?php
   }
}
}


?>
     
</tbody>
<tr><td colspan="5"><h3>Total</h3></td> <td><h3><?php echo number_format((float)$cost); ?></h3></td> <td> <h3><?php echo number_format((float)$sale); ?>	</h3></td>  <td><h3><?php echo number_format((float)$pro); ?>	</h3></td></tr>
</table>
 
</div>




  </div>
</div>




			
</div>
</div>
</div>









	


<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="datatable/jquery.dataTables.min.js"></script>
<script src="datatable/dataTable.bootstrap.min.js"></script>
<!-- generate datatable on our table -->
<script>


$(document).ready(function(){
	//inialize datatable
    $('#myTable2').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});
</script>
</body>

</html>