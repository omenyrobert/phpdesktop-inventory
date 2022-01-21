

<?php
require_once'connection.php';



 if(ISSET($_REQUEST['id'])){
		$id=$_REQUEST['id'];
 
		$conn->query("DELETE FROM `stockIn` WHERE `id`='$id'") or die("Failed to delete a row!");
		echo "<script>alert(' informational deleted successfully!')</script>";
				echo "<script>window.location='dashboard.php'</script>";
	
	}

	$sql=$conn->query("SELECT SUM(total) AS cou FROM `receipt`") or die("Failed to fetch row!");
	while($fetch=$sql->fetchArray())
{
		 $gtotal = ""." ".$fetch['cou'];
	 }


	$sql=$conn->query("SELECT COUNT(*) AS cou FROM `stockIn` WHERE status='1'") or die("Failed to fetch row!");
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
	<a href="dashboard.php" style="color: white;"><h4>Dashboard</h4></a><a href="index.php" style="color: white;">logout</a>
	<form method="post" action="changepass.php" style="text-align: right; margin-top: -10px;">
		<input type="text" placeholder="username" style="color: black;" name="username" required="required">
		<input type="password" placeholder="password" style="color: black;" name="password" required="required">
		<button type="submit" name="changep" class="btn btn-primary">Change</button>
		<br/>
	</form>
	
	<br/><br/>
</div><br/><br/>
<div class="row">      
<div class="col-md-2" >
  <div style="background-color: #e810c7; padding: 5px; text-align: center;" >
      	<h3>CPanel</h3>
      </div>
      <div style="background-color: #6c676e; padding: 20px; ">
	  <a href="printreceipt.php" style="text-decoration: none; color:white;">print</a><br/>
		     <a href="servicesales.php" style="color: white;" >Sales from Serives</a><br/>
		     <a href="stocksales.php" style="color: white;" >Sales from stock</a><br/>
		      <a href="salesedit.php" style="color: white;" >Edit sales</a>
		 </div>

	
</div>   

       <div class="col-md-10">

       <div class="row" >
	<div class="col-md-3" style="background-color: #f2126c; height: 150px; color: white; width: 200px; text-align: center; margin: 5px; " >
       <h2>Total Items</h2>
       <h1><?php echo $output; ?></h1>
		
	</div>
	<div class="col-md-3" style="background-color: #0a9914; height: 150px; color: white; text-align: center; width: 200px; margin: 5px;" >
		<br/>
		<h2>Profits</h2>
       <h1></h1>
	</div>
	<div class="col-md-3" style="background-color: #066692; height: 150px; color: white; text-align: center; width: 200px; margin: 5px; " >
		<br/>
		<h2>Expenditure</h2>
       <h1></h1>
	</div>
	<a href="daily.php">
	<div class="col-md-3" style="background-color: gold; height: 150px; color: white; text-align: center; width: 200px; margin: 5px; " >
		<br/>
		<h4>All Sales</h4>
		<h4>Daily</h4>
		<h4>Weekly</h4>
		<h4>Monthly</h4>
       <h1></h1>
	</div></a>
</div>

<div class="row">
	<br/><br/>
	 <div>
	</div>
		      </div>
	
<div id="stock" style="margin:50px;" class="row" >
<div class="col-md-10">
<br/><br/>

<table id="myTable" style=" color: black; background-color: white;" class="table table-bordered">
<thead>
					<tr><th>Date</th>
						<th>Item</th>
						<th>Quantity</th>
						<th>Unit Buying Price</th>
						<th>Unit Selling Price</th>
						<th>Name</th>
						<th>Address</th>
						<th>Phone</th>
						<th>Action</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');


   $query=$conn->query("SELECT * FROM  `stockOut`") or die("Failed to fetch row!");
						while($fetch=$query->fetchArray()){
							{
	?>
        <tr><td><?php echo $fetch['ddate']; ?></td>
	   		<td><?php echo  $fetch['sitem'];?></td>
	   		<td><?php echo number_format((float)$fetch['sqty']);?></td>
	   		<td><?php echo number_format((float)$fetch['sbprice']);?></td>
	   		<td><?php echo number_format((float)$fetch['ssprice']);?></td>
			<td><?php echo $fetch['fullname']; ?></td>
	   		<td><?php echo  $fetch['addresss'];?></td>  
			<td><?php echo $fetch['phone']; ?></td>   
	   	
<td>
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?php echo $fetch['id']; ?>">Ed</button> </td>				
	   	</tr>
<div class="modal fade" style="color: black;" id="edit<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">edit</h4></center>
            </div>
            <div class="modal-body">	
            	<form method="post" action="editsales.php">
            		
            		<input type="hidden" name="id" value="<?php echo  $fetch['id'];?>" class="form-control" >

                    <label>Item</label><br/>
                     <input type="text" name="sitem" value="<?php echo  $fetch['sitem'];?>" class="form-control" ><br/><br/>

                     <label>Quantity</label><br/>
                     <input type="number" name="sqty" value="<?php echo  $fetch['sqty'];?>" class="form-control" ><br/><br/>

                     <label>Unit Buying Price</label><br/>
            		<input type="number" name="sbprice" value="<?php echo  $fetch['sbprice'];?>" class="form-control" ><br/><br/>
                    <label>Unit Selling Price</label>
            		<input type="number" name="ssprice" value="<?php echo  $fetch['ssprice'];?>" class="form-control" >
				
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="edititem" class="btn btn-primary">Update</button>
            </div>
        </form>

        </div>
    </div>
</div>


     <?php
   }
}


?>
</tbody>

</table>
</div>

</div>
</div>

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
    $('#myTable').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});


</script>
</body>

</html>