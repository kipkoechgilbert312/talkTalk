<?php 
include_once('config.php');
include_once('header.php');
include_once('model.php');
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$contID = $_GET['id'];

if(isset($_POST['submit'])){
    $phone = $_POST['phone'];
    $email = $_POST['contmail'];
    $name = $_POST['contName'];
    updatecontact($contID, $phone, $name, $email);
}



$getcontact = connectdb()->prepare("SELECT * FROM  contacts WHERE ContID= '$contID'");
$getcontact->execute();
$contact = $getcontact->fetchAll();
foreach($contact as $contacts){
   $phone = $contacts['ContPhone'];
   $name = $contacts['ContName'];
   $email = $contacts['ContEmail'];
}
?>

<form action="" method="post">
    <div class="form-group">
    <label for="country">Select Country: </label>
    <select name="country" id="" class="selectpicker" >
            <option value="+254">Kenya</option>
            <option value="+252">Uganda</option>
            <option value="+255">Tanzania</option>
    </select>
    
    </div>
            <div class="form-group">
                <label for="OrgName">Contact Name:</label> <input type="text" name="contName" id="OrgName" class="form-control form-control-sm" value="<?php echo $name ;?>">
            </div>
            <div class="form-group">
                <label for="Phone">Phone:</label>  <input type="text" name="phone" id="contPhone" class="form-control form-control-sm" value="<?php echo $phone ;?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label> <input type="email" name="contmail" id="mail" value="<?php echo $email;?>" class="form-control form-control-sm">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form> 