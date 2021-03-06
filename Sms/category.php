<?php 
include_once('includes\config.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Category</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="assets/css/crud.css">
<script type="text/javascript">
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});

	$('.trash').click(function(){
    //get cover id
    var id=$(this).data('id');
    //set href for cancel button
    $('#deleteContactModal').attr('href','delete-cover.php?id='+id);
})
});
</script>
</head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Category</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addContactModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Contact</span></a>
						<a href="#deleteContactModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
                        <th>Organization Name</th>
                        <th>Name</th>
						<th>Description</th>
						<th>Actions</th>
                    </tr>
                </thead>
                <tbody>
				<?php

if (isset($_GET['pageno'])) {
	$pageno = $_GET['pageno'];
} else {
	$pageno = 1;
}
$no_of_records_per_page = 5;
$offset = ($pageno-1) * $no_of_records_per_page;

$conn=mysqli_connect("localhost","root","","application");
// Check connection
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	die();
}

$total_pages_sql = "SELECT COUNT(*) FROM categories";
$result = mysqli_query($conn,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT *, accounts.OrganisationName FROM `categories` INNER JOIN accounts ON categories.CatOrgId =accounts.ID LIMIT $offset, $no_of_records_per_page";
$res_data = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($res_data)){
	?> 
	<tr>
		<td>
			<span class="custom-checkbox">
				<input type="checkbox" id="checkbox1" name="options[]" value="1">
				<label for="checkbox1"></label>
			</span>
			</td>
			<td><?php echo $row['OrganisationName'];?></td>
			<td><?php echo $row['Name'];?></td>
			<td><?php echo $row['Description']; ?></td>
			<td>
				<a href="#editContactModal" class="edit" data-id="<?php echo $row['CatID'];?>" data-toggle="modal"><i class="material-icons edit" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
				<a href="#deleteContactModal" class="delete" data-id="<?php echo $row['CatID'];?>" data-toggle="modal"><i class="material-icons trash" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
			</td>
                    </tr>
					<?php
        }
        mysqli_close($conn);
    ?>
                </tbody>
            </table>
			<div class="clearfix">
                <!-- <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div> -->
					<ul class="pagination">
						<li><a href="?pageno=1">First</a></li>
						<li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
						<a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a></li>
						<li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
						<a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a></li>
						<li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
					</ul>
            </div>
        </div>
    </div>
	<!-- Edit Modal HTML -->
	<div id="addContactModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Add Contact</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">		
					<div class="form-group">
						<label for="category">Select Category</label>
						<select name="type" id="" class="form-control">
							<option value="254">Kenya</option>
							<option value="255">Tanzania</option>
							<option value="253">Uganda</option>
							<option value="260">Rwanda</option>
						</select>
						</div>
						<div class="form-group">
							<label for="country">Select Country</label>
						<select name="type" id="" class="form-control">
							<option value="254">Kenya</option>
							<option value="255">Tanzania</option>
							<option value="253">Uganda</option>
							<option value="260">Rwanda</option>
						</select>
						</div>			
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editContactModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Edit Contact</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">	
					<div class="form-group">
						<label for="category">Select Category</label>
						<select name="type" id="" class="form-control">
							<option value="254">Kenya</option>
							<option value="255">Tanzania</option>
							<option value="253">Uganda</option>
							<option value="260">Rwanda</option>
						</select>
						</div>
						<div class="form-group">
							<label for="country">Select Country</label>
						<select name="type" id="" class="form-control">
							<option value="254">Kenya</option>
							<option value="255">Tanzania</option>
							<option value="253">Uganda</option>
							<option value="260">Rwanda</option>
						</select>
						</div>					
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-info" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteContactModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Contact</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>                                		                            