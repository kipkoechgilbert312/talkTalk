<div class="form-group">
            <label for="category">Select Category: </label>
        <select name="type" id="" class="selectpicker">
           
        <?php 
        $getcategory = connectdb()->prepare("SELECT * FROM  categories WHERE CatOrgId = 26");
        $getcategory->execute($getcategory);
        $categories = $getcategory->fetchAll();

        foreach ($categories as $category) {
            
        ?>
            <option value="<?php echo $category['CatID'] ?> "><?php echo $category['Name'] ?></option>
<?php }
        ?>
        </select>
    </div>