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

<div class="row">
<div class="col-sm-4">
<nav class="nav-bar">
<div class="navbar-default sidebar" role="navigation">
    
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">  
                    <?php $active = isset($_GET['active']) ? $_GET['active'] : "";?>
                <!-- <li><a href="index.php" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li> -->
                <li><a href="?active=message"><i class="fa fa-user fa-fw"></i> Message</a></li>
		        <li><a href="?active=account">Add Account</a></li>
		        <li><a href="?active=add_category">Add Category</a></li>
		        <li><a href="?active=get_contacts">Add Contacts</a></li>                   
                </ul>
            </div>
        </div>
    </nav>
</div>

<div class="col-sm-8">
<h1 class="page-header">
                    	<?php if ($active === 'message' ) {
                    		echo 'Message';
                    	}?>
                    	<?php if ($active === 'account' ) {
                    		echo 'Accounts';
                    	}?>
                    	<?php if ($active === 'add_category' ) {
                    		echo 'Category';
                    	}?>
                    	<?php if ($active === 'get_contacts' ) {
                    		echo 'Add Contacts';
                    	}?>
                    </h1>


                    <?php if ($active === 'message' ) { ?>
    <?php include_once("message.php") ;?>
<?php } ?>

<?php if ($active === 'account' ) { ?>
    <?php include_once("account.php") ;?>
<?php } ?>


<?php if ($active === 'add_category' ) { ?>
   <?php  include_once("category.php");?>
<?php } ?>


<?php if ($active === 'get_contacts' ) { ?>
    <?php include_once("contacts.php");?>
<?php } ?>
</div>

</div>
<?php include_once('includes\footer.php');