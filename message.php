<?php 
require_once('includes\config.php');
include_once('includes\model.php');
$userid =$_SESSION['id'];

if(isset($_POST['cat'])){
    $catName =$_POST['catName'];
    $catDesc =$_POST['catDesc'];
    $catorgid =$_POST['type'];
    message($catName, $catDesc, $catorgid);
}
?>
<div class="row">
    <div class="col-sm-9"></div>
    <div class="col-sm-3">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add message
</button>

</div>
</div>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Message Contact</th>
      <th scope="col">Message Text</th>
      <th scope="col">Edit</th>
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
            <td><?php echo $message['Name'] ?></td>
            <td><?php echo $message['Description'] ?></td>
            <td><button type="button" class="btn btn-warning"><a href="includes\editmessage.php?id=<?php echo $message['CatID']; ?> "><i class="fas fa-edit"></i></a></button></td>
            <td><button type="button" class="btn btn-warning"><a href="includes\resendSMS.php.php?id=<?php echo $message['CatID']; ?> "><i class="far fa-share-square"></i></a></button></td>
            <td><button type="button" class="btn btn-danger"><a href="includes\deletemessage.php?id=<?php echo $message['CatID']; ?>"><i class="fas fa-trash-alt"></i></a></button></td>
          </tr>
<?php }
        ?>
  </tbody>
</table>
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">New Contact</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
     
      <form action="" method="post"> 
    <div class="form-group"><label for="type">Type:</label>
        <select name="type[]" class="selectpicker" multiple title="Please select Contacts that you want to send Message">
        <?php 
        $getcategory = connectdb()->prepare("SELECT * FROM  contacts ");
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

<?php

// $cats = implode(',', $_POST['cat_id']);
// $query = "SELECT ContactPhone FROM contacts WHERE ContactCatID IN ($cats)";
// $RECS = "";
// while( $row = mysqli_fetch_array(mysqli_query($con, $query))){
//   $RECS .= $row['ContactPhone'].',';
// }
        




