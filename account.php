<?php 
require_once('config.php');

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
if(isset($_POST['account'])){

    $location =$_POST['location'];
    $orgPhone =$_POST['phone'];
    $orgName =$_POST['OrgName'];
    $type=$_POST['type'];
    $email=$_POST['email'];

    function accounts($location,$orgPhone,$orgName,$email,$type){
        
        $sql = "INSERT INTO accounts(OrganisationName,phone,Email,AccountLocation,AccountType) VALUES('$location','$orgPhone','$orgName','$email','$type')";
        
       connectdb()->exec($sql);
       echo "<script type= 'text/javascript'>alert('Data successfully sent');</script>";
       header("location:index.php");
       
    }
    accounts($location,$orgPhone,$orgName,$email,$type);
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
                    <h4>Fill all</h4>
                    <div class="form-group">
                    <label for="OrgName">Organization Name:</label> <input type="text" name="OrgName" id="OrgName" class="form-control form-control-sm" placeholder="QQ software ltd">
                    </div>
                    <div class="form-group">
                    <label for="location">Location:</label> <input type="text" name="location" id="location" class="form-control form-control-sm" placeholder="Nairobi">
                    </div>
                    <div class="form-group">
                        <label for="">Email:</label><input type="email" name="email" id="email" class="form-control form-control-sm" placeholder="email">
                    </div>
                    <div class="form-group">Phone Number:<label for="Phone"></label><input type="tel" name="phone" id="phone" class="form-control form-control-sm" placeholder="0727143163"></div>
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

                    <button type="submit" class="btn btn-sm btn-primary" name="account">Submit</button>
            </form>
        </div>
    
</div>

    </div>
</body>
</html>