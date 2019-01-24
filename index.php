<?php
require_once('sendSMS.php');
include_once('includes/header.php');
include_once('includes/navbar.php');

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


if(isset($_POST['tuma'])){
    
    $recipients =$_POST['type'];
    $message = $_POST['ujumbe'];
    var_dump($recipients);


    sendSMS($recipients,$message);
}

?>

<div class="row">
<div class="col-sm-4">
                <ul>  
                <?php $active = isset($_GET['active']) ? $_GET['active'] : "";?>
                <li><a href="#"> <i class="fa fa-user fa-fw"></i> <?php echo htmlspecialchars($_SESSION["email"]); ?></a></li>
                <li><a href="#" class="active"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
                <li><a href="?active=message">SEND MESSAGE</a></li>
                <li><a href="?active=msg">BULK MESSAGE</a></li>
		        <li><a href="?active=account">ADD ACCOUNTS</a></li>
		        <li><a href="?active=add_category">ADD CATEGORY</a></li>
		        <li><a href="?active=get_contacts">ADD CONTACTS</a></li>  
                <li><a href="?active=notifications"><i class="fas fa-bell"></i>NOTIFICATIONS</a></li>                  
                </ul>
</div>

<div class="col-sm-8">
<h3 class="page-header">
                    	<?php if ($active === 'message' ) {
                    		echo 'SEND MESSAGE';
                    	}?>
                        <?php if ($active === 'msg' ) {
                    		echo 'SEND BULK MESSAGE';
                    	}?>
                    	<?php if ($active === 'account' ) {
                    		echo 'ADD ACCOUNTS';
                    	}?>
                    	<?php if ($active === 'add_category' ) {
                    		echo 'ADD CATEGORY';
                    	}?>
                        <?php if ($active === 'get_contacts' ) {
                    		echo 'ADD CONTACTS';
                    	}?>
                    	<?php if ($active === 'get_notifications' ) {
                    		echo 'NOTIFICATIONS:';
                    	}?>
                    </h3>


        <?php if ($active === 'message' ) { ?>
        <?php include_once("message.php") ;?>
        <?php } ?>
        
        <?php if ($active === 'MSG' ) { ?>
        <?php include_once("msgBulk.php") ;?>
        <?php } ?>

        <?php if ($active === 'account' ) { ?>
        <?php include_once("account.php") ;?>
        <?php } ?>


        <?php if ($active === 'add_category' ) { ?>
        <?php  include_once("category.php");?>
        <?php } ?>

        <?php if ($active === 'get_notifications' ) { ?>
        <?php  include_once("notifications.php");?>
        <?php } ?>

        <?php if ($active === 'get_contacts' ) { ?>
        <?php include_once("contacts.php");?>
        <?php } ?>
</div>

</div>
<?php include_once('includes\footer.php');