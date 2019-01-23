 <form action="" method="post"> 
    <div class="form-group">
    <div class="form-group"><label for="type">Type:</label>
        <select name="type" id="" class="mdb-select md-form colorful-select dropdown-primary" multiple searchable="Search here..">
            <option value="#">Select</option>
        <?php 
        $getcategory = connectdb()->prepare("SELECT * FROM  contacts");
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
       <label for="Message">Message:</label> <textarea name="msg" id="msg" cols="20" rows="5" class="form-control">
        </textarea>
    </div>
    <button type="submit" class="btn btn-sm btn-primary" name="send"> Send </button>
</form>
<?php include_once('includes\footer.php') ?>