<?php 
require_once('includes\config.php');
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$userid = $_SESSION['id'];
$CON = connectdb();
$sql = "SELECT *, accounts.OrganisationName from users INNER JOIN accounts on users.accountId =accounts.ID where userId =$userid";
            
$getaccount = $CON->prepare($sql);
$getaccount->execute();
$accounts = $getaccount->fetchAll();

foreach($accounts as $account){
    $catorgid = $account['accountId'];
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajax</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/i18n/defaults-*.min.js"></script>
</head>
<body>
    <form action="test.php" method="post">
    
    <select name="catid" id="" class="selectpicker">
    
    <?php 
            $CON = connectdb();
            $getcategory = $CON->prepare("SELECT CatID, CatOrgId,Name, Description, accounts.OrganisationName FROM `categories` INNER JOIN accounts ON categories.CatOrgId = accounts.ID WHERE CatOrgId = $catorgid");
            $getcategory->execute();
            $categories = $getcategory->fetchAll();
            
            foreach ($categories as $category) {
            
?>
    <option value="<?php echo $category['CatID'];?>"><?php echo $category['Name'];?></option>
<?php 
}

?>

    </select>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>

