<?php 
require_once('includes/config.php');
include_once('includes/model.php');


$CON = connectdb();

$userid =  $_SESSION["id"];

    $stmt = "SELECT *, accounts.OrganisationName from users INNER JOIN accounts on users.accountId =accounts.ID where userId =$userid";
            
    $getaccountid = $CON->prepare($stmt);
    $getaccountid->execute();
    $accountsid = $getaccountid->fetchAll();

    foreach($accountsid as $accountid){
        $catorgid = $accountid['accountId'];
    }

if(isset($_POST['submit'])){

    $contCatId =$_POST['type'];
    $contPhone =$_POST['phone'];
    $contName =$_POST['contName'];
    $contCreator = $_SESSION["id"];
    $contEmail=$_POST['contmail'];
    $country =$_POST['country'];
   
    contacts($contCatId,$country, $contPhone,$contName, $contCreator,$contEmail);
}
?>

<div class="row">
    <div class="col-sm-9"></div>
    <div class="col-sm-3">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Contact
</button>

</div>
</div>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Country Code</th>
      <th scope="col">Name</th>
      <th scope="col">Phone</th>
      <th scope="col">Email</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    
      <?php 
       $sql = "SELECT contacts.*, categories.CatOrgId FROM `contacts` INNER JOIN categories ON contacts.ContCatID = categories.CatID WHERE categories.CatOrgId = $catorgid";
        $getcontacts = connectdb()->prepare($sql);
        $getcontacts->execute();
        $contacts = $getcontacts->fetchAll();
        
        foreach ($contacts as $contact) {
            
        ?><tr>
          <td><?php echo $contact['CountryCode'] ;?></td>
            <td><?php echo $contact['ContName'] ?></td>
            <td><?php echo $contact['ContPhone'] ?></td>
            <td><?php echo $contact['ContEmail'] ?></td>
            <td><button type="button" class="btn btn-warning"><a href="includes\editcontact.php?id=<?php echo $contact['ContID'] ?>"><i class="fas fa-edit"></i></a></button></td>
            <td><button type="button" class="btn btn-danger"><a href="includes\deletecontact.php?id=<?php echo $contact['ContID'] ?>"><i class="fas fa-trash-alt"></i></a></button></td>
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
            <div class="form-group">
            <label for="category">Select Category: </label>
        <select name="type" id="" class="selectpicker">
           
        <?php 
        $getcategory = connectdb()->prepare("SELECT * FROM  categories WHERE CatOrgId = $catorgid");
        $getcategory->execute();
        $categories = $getcategory->fetchAll();
        
        foreach ($categories as $category) {
            
        ?>
            <option value="<?php echo $category['CatID'] ?> "><?php echo $category['Name'] ?></option>
<?php }
        ?>
        </select>
    </div>
    <div class="form-group">
    <label for="country">Select Country: </label>
    <select name="country" id="" class="selectpicker" >
   
            <option value="+254">Kenya</option>
            <option value="+252">Uganda</option>
            <option value="+255">Tanzania</option>
    </select>
    
    </div>
            <div class="form-group">
                <label for="OrgName">Contact Name:</label> <input type="text" name="contName" id="OrgName" class="form-control form-control-sm" placeholder="QQ software ltd">
            </div>
            <div class="form-group">
                <label for="Phone">Phone:</label>  <input type="text" name="phone" id="contPhone" class="form-control form-control-sm" placeholder="0727143163">
            </div>
            <div class="form-group">
                <label for="email">Email:</label> <input type="email" name="contmail" id="mail" placeholder="example@gmail.com" class="form-control form-control-sm">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>