<?php 
require_once('includes\config.php');
include_once('includes\model.php');
include_once('sendSMS.php');

$CON =connectdb();
$userid =$_SESSION['id'];
    $stmt = "SELECT *, accounts.OrganisationName from users INNER JOIN accounts on users.accountId =accounts.ID where userId =$userid";
            
    $getaccountid = $CON->prepare($stmt);
    $getaccountid->execute();
    $accountsid = $getaccountid->fetchAll();

    foreach($accountsid as $accountid){
        $catorgid = $accountid['accountId'];
    }

if(isset($_POST['tuma'])){

  $recipient =implode(',', $_POST['contact']);
  $recipients = rtrim($recipient, ',');
  $message = $_POST['ujumbe'];

  sendSMS($recipients, $message);
}
if(isset($_POST['submit'])){
  $message =$_POST['ujumbe'];
  $query = "SELECT DISTINCT(ContPhone) from contacts";
      $i = 0;
      $selectedOptionCount = count($_POST['cat_id']);
      $selectedOption = implode(',', $_POST['cat_id']);
      $query = $query . " WHERE ContCatID in (" . $selectedOption . ")";
      
      $result = connectdb()->Query($query);
  }
  if (! empty($result)) {
      $recipient = "";
      foreach ($result as  $value) {
  //   var_dump($value);
          $recipient .= $value['ContPhone'].",";
  
      }
  
      $recipien = rtrim($recipient, ",");
      $recipients = 0 . $recipien;

      sendSMS($recipients, $message);
}
?>
<div class="row">
    <div class="col-sm-9">
    
    </div>
    <div class="col-sm-3">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1">Individual
</button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Group
</button>

</div>
</div>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Message Contact</th>
      <th scope="col">Message Text</th>
      <th scope="col">Resend</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
      <?php 
        $getmessage = connectdb()->prepare("SELECT * FROM `messages` WHERE MsgSender =$userid");
        $getmessage->execute();
        $categories = $getmessage->fetchAll();
        foreach ($categories as $message) {   
        ?><tr>
            <td><?php echo $message['MsgPhone'] ?></td>
            <td><?php echo $message['MsgText'] ?></td>
            <td><button type="button" class="btn btn-warning"><a href="includes\resendSMS.php.php?id=<?php echo $message['MsgID']; ?> "><i class="far fa-share-square"></i></a></button></td>
            <td><button type="button" class="btn btn-danger"><a href="includes\deletemessage.php?id=<?php echo $message['MsgID']; ?>"><i class="fas fa-trash-alt"></i></a></button></td>
          </tr>
<?php }
        ?>
  </tbody>
</table>


<div class="modal" id="myModal1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">New Contact</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
     
      <form action="" method="post"> 
    <div class="form-group"><label for="type">Type:</label>
    <select name="contact[]" class="selectpicker" data-live-search="true" multiple >
        <?php 
        $getcategory = connectdb()->prepare("SELECT *  FROM  contacts");
        $getcategory->execute();
        $categories = $getcategory->fetchAll();
        
        foreach ($categories as $category) {
            
        ?>
            <option value="<?php echo  $category['CountryCode'] . $category['ContPhone'] ?> "><?php echo $category['ContPhone']; echo $category['ContName'] ?></option>
<?php }
        ?>
        </select>
    </div>
    <div class="form-group">
       <label for="Message">Message:</label> <textarea name="ujumbe" id="msg" cols="20" rows="5" class="form-control">
        </textarea>
    </div>
    <button type="submit" class="btn btn-sm btn-primary" name="tuma"> Send </button>
</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>






<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">New Contact</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
     
      <form action="" method="post">

<div class="form-group">
      <select name="cat_id[]" id="" class="selectpicker" multiple >    
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
    </div>
<div class="form-group">

<textarea name="ujumbe" id="" cols="30" rows="10" class="form-control">

</textarea>


</div>
    <button type="submit" name="submit" class="btn btn-default">Submit</button>
</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>






