<?php 
include_once('config.php');
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$catID = $_GET['id'];

$sql = ("DELETE FROM  messages WHERE 	MsgID= '$catID'");
if(connectdb()->exec($sql)){
    echo "<script type= 'text/javascript'>alert('Data successfully sent');</script>";
}else{
    echo "There was an error deleting the contact";
}
header("Location:../index.php?active=message");
?>