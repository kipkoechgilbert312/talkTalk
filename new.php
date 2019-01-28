<?php 

if(isset($_POST['tuma'])){
    
    $recipients =$_POST['type'];
    $message = $_POST['ujumbe'];

    sendSMS($recipients,$message);
}


?>

<h2>Send Message to Multiple People</h2>
