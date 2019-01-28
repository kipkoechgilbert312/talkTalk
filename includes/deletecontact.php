<?php 
include_once('config.php');
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$contID = $_GET['id'];

$sql = ("DELETE FROM  contacts WHERE ContID = $contID");
if(connectdb()->exec($sql)){
    echo "<script type= 'text/javascript'>alert('Data successfully sent');</script>";
    header("Location:../index.php?active=get_contacts");
}else{
    echo "There was an error deleting the contact";
}

?>