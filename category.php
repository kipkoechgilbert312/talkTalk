<?php 
require_once('includes\config.php');
include_once('includes\model.php');
if(isset($_POST['cat'])){
    $catName =$_POST['catName'];
    $catDesc =$_POST['catDesc'];
    $catorgid =$_POST['type'];
    category($catName, $catDesc, $catorgid);
}
?>
<div class="row">
    <div class="col-sm-9"></div>
    <div class="col-sm-3">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Category
</button>

</div>
</div>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    
      <?php 
        $getcategory = connectdb()->prepare("SELECT Name, Description, accounts.OrganisationName FROM `categories` INNER JOIN accounts ON categories.CatOrgId = accounts.ID");
        $getcategory->execute();
        $categories = $getcategory->fetchAll();
        
        foreach ($categories as $category) {
            
        ?><tr>
            <td><?php echo $category['Name'] ?></td>
            <td><?php echo $category['Description'] ?></td>
            <td><button type="button" class="btn btn-warning"><i class="fas fa-edit"></i></button></td>
      <td><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
    </tr>
<?php }
        ?>

  </tbody>
</table>
     
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">New Contact</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
     
<form action="" method="post">
<div class="form-group"><label for="type">Type:</label>
        <select name="type" id="" class="selectpicker">
        <?php 
        $getaccount = connectdb()->prepare("SELECT * FROM  accounts");
        $getaccount->execute();
        $accounts = $getaccount->fetchAll();
        
        foreach ($accounts as $account) {
            
        ?>
            <option value="<?php echo $account['ID'] ?> "><?php echo $account['OrganisationName'] ?></option>
<?php }
        ?>
        </select>
    </div>
    <div class="form-group"><label for="Name">Category Name:</label><input type="text" name="catName" id="catName" class="form-control form-control-sm" placeholder="Enter Category Name"></label></div>
    <div class="form-group">
    <label for="Category Description">Description:</label><textarea name="catDesc" id="" cols="20" rows="5" class="form-control">   
    </textarea></div>
    <button type="submit" class="btn btn-sm btn-primary" name="cat">Submit</button>
    
</form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>