<?php
session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location:signin.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Adshare</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="assets/css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="assets/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/css/startmin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="assets/css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Adshare</a>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Top Navigation: Left Menu -->
        <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="dashboard.php"><i class="fa fa-home fa-fw"></i> Home</a></li>
        </ul>

        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">
        	
            
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['username'];?> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="profile.php"><i class="fa fa-user fa-fw"></i> Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="../../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">

                <ul class="nav" id="side-menu">
                    
                    <?php $active = isset($_GET['active']) ? $_GET['active'] : "";?>

                <li><a href="dashboard.php" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
                <li><a href="?active=users"><i class="fa fa-user fa-fw"></i> Users</a></li>
		        <li><a href="?active=posts">Manage Posts</a></li>
		        <li><a href="?active=add_admin">Add Admin</a></li>
		        <li><a href="?active=get_category">Add Category</a></li>
            
                    
                </ul>

            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-9">
                    <h1 class="page-header">
                    	<?php if ($active === 'users' ) {
                    		echo 'Users';
                    	}?>
                    	<?php if ($active === 'posts' ) {
                    		echo 'Ads';
                    	}?>
                    	<?php if ($active === 'add_admin' ) {
                    		echo 'Add dmin';
                    	}?>
                    	<?php if ($active === 'get_category' ) {
                    		echo 'Add Category';
                    	}?>
                    </h1>
                
                    </div>
                    <div class=" col-lg-3">
                        <form action="" method="post">
                            <div class="input-group page-header custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                            
                     </div>
            </div>

            <!-- ... Your content goes here ... -->
            <?php if ($active === 'users' ) { ?>
    <?php include_once("manage_users.php") ;?>
<?php } ?>

<?php if ($active === 'posts' ) { ?>
    <?php include_once("manage_posts.php") ;?>
<?php } ?>


<?php if ($active === 'add_admin' ) { ?>
   <?php  include_once("create_admin.php");?>
<?php } ?>


<?php if ($active === 'get_category' ) { ?>
    <?php include_once("create_category.php");?>
<?php } ?>

        </div>
    </div>

</div>

<!-- jQuery -->
<script src="assets/js/jquery-3.3.1.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="assets/js/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="assetsjs/startmin.js"></script>

</body>
</html>