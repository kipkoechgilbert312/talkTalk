<?php 
require_once('config.php');

if(isset($_POST['cat'])){
    $catName =$_POST['catName'];
    $catDesc =$_POST['catDesc'];
    $catorgid =$_POST['type'];

    function category($catName, $catDesc, $catorgid){
        
        $sql = "INSERT INTO categories(CatOrgId, Name, Description) VALUES('$catorgid','$catName','$catDesc')";
        
       connectdb()->exec($sql);
       echo "<script type= 'text/javascript'>alert('Data successfully sent');</script>";
       
    }
    category($catName, $catDesc, $catorgid);

}
?>
<form action="" method="post">
<div class="form-group"><label for="type">Type:</label>
        <select name="type" id="" class="selectpicker">
        <?php 
        $getaccount = connectdb()->prepare("SELECT * FROM  accounts");
        $getaccount->execute();
        $accounts = $getaccount->fetchAll();
        
        foreach ($accounts as $account) {
            
        ?>
            <option value="<?php echo $account['ID'] ?> "><?php echo $account['OrganisationName'] ?></option>
<?php }
        ?>
        </select>
    </div>
    <div class="form-group"><label for="Name">Category Name:</label><input type="text" name="catName" id="catName" class="form-control form-control-sm" placeholder="Enter Category Name"></label></div>
    <div class="form-group">
    <label for="Category Description">Description:</label><textarea name="catDesc" id="" cols="20" rows="5" class="form-control">   
    </textarea></div>
    <button type="submit" class="btn btn-sm btn-primary" name="cat">Submit</button>
    
</form>


<?php include_once('includes\footer.php') ?>