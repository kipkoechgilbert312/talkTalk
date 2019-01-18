<?php 
require_once('config.php');
include_once('includes\header.php');
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
if(isset($_POST['submit'])){

    $contCatId =$_POST['type'];
    $contPhone =$_POST['phone'];
    $contName =$_POST['contName'];
    $contCreator = $_SESSION["id"];
    $contEmail=$_POST['contmail'];
    
    function contacts($contCatId,$contPhone,$contName, $contCreator,$contEmail){
        $sql = "INSERT INTO contacts(ContCatID, ContPhone,ContName,ContCreator,ContEmail) VALUES('$contCatId','$contPhone','$contName', '$contCreator','$contEmail')";
        
       connectdb()->exec($sql);
       echo "<script type= 'text/javascript'>alert('Data successfully sent');</script>";
       
    }
    contacts($contCatId,$contPhone,$contName, $contCreator,$contEmail);
}
?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
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

<div class="col-sm-4">
    <form action="" method="post">
            <h3>Contacts Form</h3>
            <div class="form-group"><label for="type">Type:</label>
        <select name="type" id="" class="form-control form-control-sm">
        <?php 
        $getcategory = connectdb()->prepare("SELECT * FROM  categories");
        $getcategory->execute();
        $categories = $getcategory->fetchAll();
        
        foreach ($categories as $category) {
            
        ?>
            <option value="<?php echo $category['CatID'] ?> "><?php echo $category['Name'] ?></option>
<?php }
        ?>
        </select>
    </div>
            <div class="form-group">
                <label for="OrgName">Contact Name:</label> <input type="text" name="contName" id="OrgName" class="form-control form-control-sm" placeholder="QQ software ltd">
            </div>
            <div class="form-group">
                <label for="Phone">Phone:</label>  <input type="tel" name="phone" id="contPhone" class="form-control form-control-sm" placeholder="0727143163">
            </div>
            <div class="form-group">
                <label for="email">Email:</label> <input type="email" name="contmail" id="mail" placeholder="example@gmail.com" class="form-control form-control-sm">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form> 
    </div>
    
</div>
<?php include_once('includes\footer.php') ?>