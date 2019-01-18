<?php 
require_once('config.php');
include_once('includes\header.php');
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}



if(isset($_POST['cat'])){
    $catName =$_POST['catName'];
    $catDesc =$_POST['catDesc'];
    $catorgid =$_POST['type'];

    function category($catName, $catDesc, $catorgid){
        
        $sql = "INSERT INTO categories(CatOrgId, Name, Description) VALUES('$catorgid','$catName','$catDesc')";
        
       connectdb()->exec($sql);
       echo "<script type= 'text/javascript'>alert('Data successfully sent');</script>";
       
    }
    category($catName, $catDesc, $catorgid);

}


?>

    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <a class="navbar-brand" href="#">talkTalk</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Send Message</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Notifications</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo htmlspecialchars($_SESSION["email"]); ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="account.php">Add Account</a>
          <a class="dropdown-item" href="contacts.php">Contacts</a>
          <a class="dropdown-item" href="category.php">Category</a>
          <a class="dropdown-item" href="reset-password.php">Reset Password</a>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<div class="row">
    <div class="col-6" id="body-adjust">
    
<form action="" method="post">
<div class="form-group"><label for="type">Type:</label>
        <select name="type" id="" class="form-control form-control-sm">
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
    
</div>

<?php include_once('includes\footer.php') ?>