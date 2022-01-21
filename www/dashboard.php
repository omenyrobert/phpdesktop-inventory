<?php
 session_start();

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


$role=$_SESSION['user'];
$uid = $_SESSION['co'];


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
	<input type="hidden" name="uid" value="<?php echo $uid; ?>" required="required">
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
	  <?php if($role == 'admin'){ ?>
		     <a href="servicesales.php" style="color: white;" >Sales from Serives</a><br/>
		     <a href="stocksales.php" style="color: white;" >Sales from stock</a><br/>
		      <a href="stockedit.php" style="color: white;" >Edit sales</a>
			  <?php } ?>
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
	<?php if($role == 'admin'){ ?>
	<a href="daily.php">
	<div class="col-md-3" style="background-color: gold; height: 150px; color: white; text-align: center; width: 200px; margin: 5px; " >
		<br/>
		<h4>All Sales</h4>
		<h4>Daily</h4>
		<h4>Weekly</h4>
		<h4>Monthly</h4>
       <h1></h1>
	</div></a>
	<?php } ?>
</div>

<div class="row">
	<br/><br/>
	 <div>
	</div>
	 	<div class="row">
		      	<?php
include_once('connection.php');



   $query=$conn->query("SELECT * FROM  `stockIn`   WHERE status='1' AND ttype='stock'") or die("Failed to fetch row!");
						while($fetch=$query->fetchArray()){
							{
	?>
        
        	<div class="col-md-1" style="background-color: green; border-radius: 15%; text-align: center; padding: 5px; border: 5px white solid;  color: white;">
        		<?php $dqty=$fetch['dqty'];
				      $warnn =$fetch['warnn'];
                          if ($dqty < $warnn) {
                          echo "<div style='background-color: red; color:white; font-size: 10px;' >Order needed</div>";
                          }
        				 ?>
        		<div style="border: 2px white solid; border-radius: 9%; ">        			
        		<p style="font-size: 10px;"><?php echo  $fetch['item'];?></p>
        		<div style="display: flex; justify-content: center;">
        		<p style="color: black;"><?php echo $fetch['qty'];?></p>&nbsp;&nbsp;&nbsp;
        		<p><?php echo $fetch['dqty'];?></p> </div> 
        		</div> 		
	   		
	   	
	   	</div>
	   		
     <?php
   }
}


?>
</div>
		      </div>
	<br/><br/>
	<h4>Add Stock and Services</h4>
	<br/>
	<form method="post" action="savestock.php" style="margin-bottom: 100px;">
	<div class="col-md-2">
		<label>Item</label><br/>
		<input type="text" name="item" class="form-control" required="required">
	</div>

	<div class="col-md-2">
		<label>Quantity</label><br/>
		<input type="number" name="qty" class="form-control" required="required">
	</div>

	<div class="col-md-2">
		<label>Unit Buying Price</label><br/>
		<input type="number" name="bprice" class="form-control" required="required">
	</div>

	<div class="col-md-2">
		<label>Unit Selling Price</label><br/>
		<input type="number" name="sprice" class="form-control" required="required">
	</div>

	<div class="col-md-2">
		<label>Type</label><br/>
		<select name="ttype" class="form-control" required="required" >
			<option value="stock">stock</option>
			<option value="service">service</option>
		</select>		
	</div>
	<div class="col-md-2">
		<label>Warning at</label><br/>
		<input type="number" name="warnn" class="form-control" value="10">
	</div>
	<div class="col-md-2"><br/>
		<button type="submit" name="savestock" class="btn btn-primary" >Save</button>
		
	</div>
	</form>
<br/><br/>
</div>

<br/>
<div id="stock" style="margin:1px;" class="row" >
<div class="col-md-7">
<table id="myTable" style=" color: black; background-color: white;" class="table table-bordered">
<thead>
					<tr><th>Date</th>
						<th>Item</th>
						<th>Quantity</th>
						<th>Unit Buying Price</th>
						<th>Unit Selling Price</th>
						<th>Action</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');




   $query=$conn->query("SELECT * FROM  `stockIn` WHERE status='1'") or die("Failed to fetch row!");
						while($fetch=$query->fetchArray()){
							{
	?>
        <tr><td><?php echo $fetch['date']; ?></td>
	   		<td><?php echo  $fetch['item'];?></td>
	   		<td><?php echo number_format((float)$fetch['dqty']);?></td>
	   		<td><?php echo number_format((float)$fetch['bprice']);?></td>
	   		<td><?php echo number_format((float)$fetch['sprice']);?></td>
	   	
<td>
<?php if($fetch['dqty'] >'0' || $fetch['ttype']=='service' ){ ?>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#sale<?php echo $fetch['id']; ?>">S</button> 
<?php } ?>

<?php if($fetch['dqty'] == '0'  && $fetch['ttype']=='stock'){ ?>
	<button type="button" class="btn btn-default" style="background-color: black; color: white;" data-toggle="modal" data-target="#stock<?php echo $fetch['id']; ?>">Enter New</button> 
<?php } ?>

<?php if($role == 'admin'){ ?>
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?php echo $fetch['id']; ?>">Ed</button> 
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>"><span class="glyphicon glyphicon-trash"></span></button>
<?php } ?>
</td>				
	   	</tr>



<div class="modal fade" style="color: black;" id="delete_<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Delete Record</h4></center>
            </div>
            <div class="modal-body">	
            	<p class="text-center">Are you sure you want to Delete</p>
				<p class="text-center">Item<br/>&nbsp;&nbsp;<?php echo $fetch['item'].'<br/><br/>Quantity<br/> '.$fetch['qty'].'<br/><br/>Unit Selling Price<br/>'.$fetch['sprice']; ?></p>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="dashboard.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" style="color: black;" id="edit<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">edit</h4></center>
            </div>
            <div class="modal-body">	
            	<form method="post" action="edit.php">
            		
            		<input type="hidden" name="id" value="<?php echo  $fetch['id'];?>" class="form-control" >

                    <label>Item</label><br/>
                     <input type="text" name="item" value="<?php echo  $fetch['item'];?>" class="form-control" ><br/><br/>

                     <label>Quantity</label><br/>
                     <input type="number" name="qty" value="<?php echo  $fetch['qty'];?>" class="form-control" ><br/><br/>

                     <label>Unit Buying Price</label><br/>
            		<input type="number" name="bprice" value="<?php echo  $fetch['bprice'];?>" class="form-control" ><br/><br/>
                    <label>Unit Selling Price</label>
            		<input type="number" name="sprice" value="<?php echo  $fetch['sprice'];?>" class="form-control" ><br/>
					<label>Warning at</label>
					<input type="number" name="warnn" value="<?php echo  $fetch['warnn'];?>" class="form-control" >
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="edititem" class="btn btn-primary">Update</button>
            </div>
        </form>

        </div>
    </div>
</div>



<div class="modal fade" style="color: black;" id="sale<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Enter Sale</h4></center>
            </div>
            <div class="modal-body">	
            	<form method="post" action="sale.php">
            		
            		<input type="hidden" name="id" value="<?php echo  $fetch['id'];?>" class="form-control" >
                     <input type="text" name="sitem" value="<?php echo  $fetch['item'];?>" class="form-control" readOnly ><br/><br/>

                     <label>Quantity</label><br/>
                     <input type="number" name="sqty" class="form-control" >
					 <input type="hidden" name="dqty" value="<?php echo  $fetch['dqty'];?>" class="form-control" >
            		<input type="hidden" name="sbprice" value="<?php echo  $fetch['bprice'];?>" class="form-control" >
					<input type="hidden" name="ttype" value="<?php echo  $fetch['ttype'];?>" class="form-control" >
            		<input type="hidden" name="ssprice" value="<?php echo  $fetch['sprice'];?>" class="form-control" >
				
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="savesale" class="btn btn-primary">Save</button>
            </div>
        </form>

        </div>
    </div>
</div>





<div class="modal fade" style="color: black;" id="stock<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Enter New Stock</h4></center>
            </div>
            <div class="modal-body">	
            	<form method="post" action="newstock.php">
            		
            		<input type="hidden" name="id" value="<?php echo  $fetch['id'];?>" class="form-control" >
					<input type="hidden" name="ttype" value="<?php echo  $fetch['ttype'];?>" class="form-control" >
                                   
                     <input type="text" name="item" value="<?php echo  $fetch['item'];?>" class="form-control" readOnly ><br/>

                     <label>Quantity</label><br/>
                     <input type="number" name="qty" class="form-control" ><br/>
					 <label>Buying price</label><br/>
            		<input type="number" name="bprice" value="<?php echo  $fetch['bprice'];?>" class="form-control" ><br/>
                    <label>Selling Price</label><br/>
            		<input type="number" name="sprice" value="<?php echo  $fetch['sprice'];?>" class="form-control" >
					<label>Warning at</label><br/>
            		<input type="number" name="warnn" value="<?php echo  $fetch['warnn'];?>" class="form-control" >
				
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="newstock" class="btn btn-primary">Save</button>
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
<div class="col-md-5">
	<form action="addtoreceipt.php" method="POST">
		<h4>Add Customers details</h4>
		<div style="display:flex;">
		<input type="text" name="fullname" class="form-control" placeholder="enter full name">
		<input type="text" name="addresss" class="form-control" placeholder="Address">
		<input type="text" name="phone" class="form-control" placeholder="phone number">

		</div>
		<br/>
		<button class="btn btn-primary" type="submit" name="addtoreceipt">Add to receipt</button>
	</form>
	<br/>
<table  style=" color: black; background-color: white;" class="table table-bordered">
<thead>
					<tr><th>Item</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Total</th>
						<th>Action</th>
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
	   		<td><?php echo number_format((float)$fetch['total']);?></td>
	   	
<td>
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?php echo $fetch['id']; ?>">Ed</button> 
|<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>">Del</button>
</td>				
	   	</tr>



<div class="modal fade" style="color: black;" id="delete_<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Delete Record</h4></center>
            </div>
            <div class="modal-body">	
            	<p class="text-center">Are you sure you want to Delete</p>
				<p class="text-center">Item<br/>&nbsp;&nbsp;<?php echo $fetch['sitem'].'Quantity<br/> '.$fetch['sqty'].'<br/>Unit Selling Price<br/>'.$fetch['ssprice']; ?></p>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="deletereceipt.php?id=<?php echo $fetch['itemid']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" style="color: black;" id="edit<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">edit</h4></center>
            </div>
            <div class="modal-body">	
            	<form method="post" action="editreceipt.php">
            		
            		<input type="hidden" name="id" value="<?php echo  $fetch['itemid'];?>" class="form-control" >
                    <input type="hidden" name="ssprice" value="<?php echo  $fetch['ssprice'];?>" class="form-control" >
                    <label>Item</label><br/>
                     <input type="text" name="item" value="<?php echo  $fetch['sitem'];?>" class="form-control" readOnly><br/><br/>

                     <label>Quantity</label><br/>
                     <input type="number" name="qty" value="<?php echo  $fetch['sqty'];?>" class="form-control" ><br/><br/>
                 
				
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="editreceipt" class="btn btn-primary">Update</button>
            </div>
        </form>

        </div>
    </div>
</div>



     <?php
   }
}


?>

<?php
include_once('connection.php');




   $query=$conn->query("SELECT * FROM  `receipt` LIMIT 1") or die("Failed to fetch row!");
						while($fetch=$query->fetchArray()){
							{
	?>
    <div style="display: flex; justify-content: space-between;">
	<p><b><?php echo $fetch['fullname'];?> </b></p>
	   		<p><b><?php echo $fetch['phone'];?></b></p>
	   		<p><b><?php echo $fetch['addresss'];?></b></p>
	</div>
	   		
			   <?php   
   }
}


?>
	   	
</tbody>
<tr><td colspan="3"><h4>Total</h4></td> <td><h4><?php echo number_format((float)(float)$gtotal); ?></h4></td></tr>
</table>




</div>
</div>

</div>

<!-- <div id="profit" style="margin-left: 100px; margin-right: 100px; margin-top:100px; margin-bottom: 100px;">


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

$ddate=date('Y-m-d');


   $query=$conn->query("SELECT *,  SUM(sqty) FROM  `stockIn` INNER JOIN `stockOut` ON `stockOut`.sitem = `stockIn`.item WHERE ddate='$ddate' GROUP BY sitem") or die("Failed to fetch row!");
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


?>
 
  <?php
include_once('connection.php');


$ddate=date('Y-m-d');

   $query=$conn->query("SELECT *, SUM(sqty) FROM  `stockIn`  INNER JOIN `stockOut` ON `stockOut`.sitem = `stockIn`.item WHERE ddate='$ddate' GROUP BY sitem") or die("Failed to fetch row!");
   $pro=0;
   $cost=0;
   $sale=0;
						while($fetch=$query->fetchArray()){
							{

								$pro+=$fetch['SUM(sqty)']*($fetch['ssprice']-$fetch['sbprice']);
								$cost+=$fetch['bprice']*$fetch['SUM(sqty)'];
								$sale+=$fetch['sprice']*$fetch['SUM(sqty)'];

								
	?>
	
	   
  <?php
   }
}


?>
     
</tbody>
<tr><td colspan="5"><h3>Total</h3></td> <td><h3><?php echo number_format((float)$cost); ?></h3></td> <td> <h3><?php echo number_format((float)$sale); ?>	</h3></td>  <td><h3><?php echo number_format((float)$pro); ?>	</h3></td></tr>
</table>
 
</div>

 -->


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


$(document).ready(function(){
	//inialize datatable
    $('#myTable2').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});


$(document).ready(function(){
	//inialize datatable
    $('#myTable3').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});


</script>
</body>

</html>