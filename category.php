<?php 
require_once('config.php');

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sms API</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
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
    <div class="col-6" id="body-adjust">
<form action="" method="post">
<div class="form-group"><label for="type">Type:</label>
        <select name="type" id="" class="form-control form-control-sm">
            <option value="#">Select One</option>
            <option value="company" >Company</option>
            <option value="church" >Church</option>
            <option value="school" >School</option>
            <option value="university" >University</option>
            <option value="college" >College</option>
            <option value="ngo" >NGO</option>
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

    </div>
</body>
</html>