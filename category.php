<?php 
require_once('includes\config.php');
include_once('includes\model.php');
$CON = connectdb();
$userid =  $_SESSION["id"];

$sql = "SELECT *, accounts.OrganisationName from users INNER JOIN accounts on users.accountId =accounts.ID where userId =$userid";
            
$getaccount = $CON->prepare($sql);
$getaccount->execute();
$accounts = $getaccount->fetchAll();

// var_dump($accounts);

foreach($accounts as $account){
    $catorgid = $account['accountId'];

}

$catDesc =$catName ="";
$catDesc_err =$catName_err ="";


if(isset($_POST['cat'])){
  $CON = connectdb();
  if(empty(trim($_POST["catName"]))){
    $catName_err = "Please enter a Contact.";
  } else{
  
    $sql = "SELECT CatID FROM categories WHERE Name = :catName";
    
    if($stmt = $CON->prepare($sql)){
        
        $stmt->bindParam(":catName", $param_catName, PDO::PARAM_STR);
        
        $param_catName= trim($_POST["catName"]);
        
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                $catName_err = "This Category Name is already taken.";
            } else{
                $catName = trim($_POST["catName"]);
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    unset($stmt);
}

if(empty($_POST['catDesc'])){
  $catDesc_err = "Please Enter Description";
}else{
  $catDesc = $_POST['catDesc'];
}   

    if(empty($catDesc_err) && empty($catName_err)){
      category($catName, $catDesc, $catorgid);
    }
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
        $CON = connectdb();
        $getcategory = $CON->prepare("SELECT CatID, Name, Description, accounts.OrganisationName FROM `categories` INNER JOIN accounts ON categories.CatOrgId = accounts.ID WHERE CatOrgId = $catorgid");
        $getcategory->execute();
        $categories = $getcategory->fetchAll();
        
        foreach ($categories as $category) {
            
        ?><tr>
            <td><?php echo $category['Name'] ?></td>
            <td><?php echo $category['Description'] ?></td>
            <td><button type="button" class="btn btn-warning"><a href="includes\editcategory.php?id=<?php echo $category['CatID']; ?> "><i class="fas fa-edit"></i></a></button></td>
            <td><button type="button" class="btn btn-danger"><a href="includes\deletecategory.php?id=<?php echo $category['CatID']; ?>"><i class="fas fa-trash-alt"></i></a></button></td>
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

    <div class="form-group"><label for="Name">Category Name:</label><input type="text" name="catName" id="catName" class="form-control form-control-sm" placeholder="Enter Category Name">
    <span class="help-block"><?php echo $catName_err; ?></span>
    </div>
    <div class="form-group">
    <label for="Category Description">Description:</label><textarea name="catDesc" id="" cols="20" rows="5" class="form-control">   
    </textarea>
    <span class="help-block"><?php echo $catDesc_err; ?></span>
    </div>
    <button type="submit" class="btn btn-sm btn-primary" name="cat">Submit</button>
    
</form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>