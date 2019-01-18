<?php
require_once('sendSMS.php');
include_once('includes/header.php');

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include_once('includes/navbar.php');
if(isset($_POST['send'])){
    $recipients = $_POST['phone'];
    $message = $_POST['msg'];

    sendSMS($recipients,$message);
}
?>
    <div class="col-sm-4">
    <form action="" method="post"> 
    <h3> Send Message</h3>
    <div class="form-group">
       <label for="Phone Number">Phone Number:</label> <input type="tel" name="phone" id="phone" placeholder="0727143163" class="form-control form-control-sm">
    </div>
    <div class="form-group">
       <label for="Message">Message:</label> <textarea name="msg" id="msg" cols="20" rows="5" class="form-control">
        </textarea>
    </div>
    <button type="submit" class="btn btn-sm btn-primary" name="send"> Send </button>
</form>
    </div>


<?php include_once('includes\footer.php');