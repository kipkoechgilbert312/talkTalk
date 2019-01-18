<?php 
require_once('config.php');
include_once('includes\header.php');
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include_once('includes\navbar.php');

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

<?php include_once('includes\footer.php') ?>