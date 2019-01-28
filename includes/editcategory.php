<?php 
include_once('config.php');
include_once('header.php');
include_once('model.php');
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$catID = $_GET['id'];

if(isset($_POST['cat'])){
    $catDesc =$_POST['catDesc'];
    $catName =$_POST['catName'];
    updatecategory($catID, $catDesc, $catName);
}
$getcategory = connectdb()->prepare("SELECT * FROM  categories WHERE Name= '$catID'");
$getcategory->execute();
$category = $getcategory->fetchAll();
foreach($category as $categories){

    $cat = $categories['Name'];
    $catdesc= $categories['Description'];
}
?>

<form action="" method="post">
    <div class="form-group"><label for="Name">Category Name:</label><input type="text" name="catName" id="catName" class="form-control form-control-sm" value= "<?php echo $cat; ?>"></label></div>
    <div class="form-group">
    <label for="Category Description">Description:</label><textarea name="catDesc" id="" cols="20" rows="5" class="form-control">   
    <?php echo $catdesc; ?>

</textarea></div>
    <button type="submit" class="btn btn-sm btn-primary" name="cat">Submit</button>
    
</form>