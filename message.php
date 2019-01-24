<!-- 
    <form action="" method="post"> 
    <div class="form-group">
       <label for="Phone Number">Phone Number:</label> <input type="tel" name="phone" id="phone" placeholder="0727143163" class="form-control form-control-sm">
    </div>
    <div class="form-group">
       <label for="Message">Message:</label> <textarea name="msg" id="msg" cols="20" rows="5" class="form-control">
        </textarea>
    </div>
    <button type="submit" class="btn btn-sm btn-primary" name="send"> Send </button>
</form> -->
<?php 

// if(isset($_POST['tuma'])){
//     $type =$_POST['type'];
//     $ujumbe = $_POST['ujumbe'];

//     print_r($type);

// }

?>
<h2>Send Message to Multiple People</h2>
<form action="" method="post"> 
    <div class="form-group">
    <div class="form-group"><label for="type">Type:</label>
        <select name="type[]" class="selectpicker" multiple title="Please select Contacts that you want to send Message">
        <?php 
        $getcategory = connectdb()->prepare("SELECT * FROM  contacts");
        $getcategory->execute();
        $categories = $getcategory->fetchAll();
        
        foreach ($categories as $category) {
            
        ?>
            <option value="<?php echo  $category['ContPhone'] ?> "><?php echo $category['ContPhone']; echo $category['ContName'] ?></option>
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
<?php include_once('includes\footer.php') ?>