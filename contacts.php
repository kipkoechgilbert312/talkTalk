<?php 
require_once('config.php');
include_once('includes\header.php');

if(isset($_POST['submit'])){

    $contCatId =$_POST['type'];
    $contPhone =$_POST['phone'];
    $contName =$_POST['contName'];
    $contCreator = $_SESSION["id"];
    $contEmail=$_POST['contmail'];
    
    function contacts($contCatId,$contPhone,$contName, $contCreator,$contEmail){
        $sql = "INSERT INTO contacts(ContCatID, ContPhone,ContName,ContCreator,ContEmail) VALUES('$contCatId','$contPhone','$contName', '$contCreator','$contEmail')";
        
       connectdb()->exec($sql);
       echo "<script type= 'text/javascript'>alert('Data successfully sent');</script>";
       
    }
    contacts($contCatId,$contPhone,$contName, $contCreator,$contEmail);
}
?>

    <form action="" method="post">
            <h3>Contacts Form</h3>
            <div class="form-group"><label for="type">Type:</label>
        <select name="type" id="" class="form-control form-control-sm">
        <?php 
        $getcategory = connectdb()->prepare("SELECT * FROM  categories");
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
                <label for="OrgName">Contact Name:</label> <input type="text" name="contName" id="OrgName" class="form-control form-control-sm" placeholder="QQ software ltd">
            </div>
            <div class="form-group">
                <label for="Phone">Phone:</label>  <input type="tel" name="phone" id="contPhone" class="form-control form-control-sm" placeholder="0727143163">
            </div>
            <div class="form-group">
                <label for="email">Email:</label> <input type="email" name="contmail" id="mail" placeholder="example@gmail.com" class="form-control form-control-sm">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form> 

<?php include_once('includes\footer.php') ?>