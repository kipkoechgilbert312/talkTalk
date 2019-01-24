<?php 
require_once('includes\config.php');
include_once('includes\model.php');


if(isset($_POST['account'])){

    $location =$_POST['location'];
    $orgPhone =$_POST['phone'];
    $orgName =$_POST['OrgName'];
    $type=$_POST['type'];
    $email=$_POST['email'];

    accounts($location,$orgPhone,$orgName,$email,$type);
}
?>
            <form action="" method="post">  
                    <div class="form-group">
                    <label for="OrgName">Organization Name:</label> <input type="text" name="OrgName" id="OrgName" class="form-control form-control-sm" placeholder="QQ software ltd">
                    </div>
                    <div class="form-group">
                    <label for="location">Location:</label> <input type="text" name="location" id="location" class="form-control form-control-sm" placeholder="Nairobi">
                    </div>
                    <div class="form-group">
                        <label for="">Email:</label><input type="email" name="email" id="email" class="form-control form-control-sm" placeholder="email">
                    </div>
                    <div class="form-group">Phone Number:<label for="Phone"></label><input type="tel" name="phone" id="phone" class="form-control form-control-sm" placeholder="0727143163"></div>
                    <div class="form-group"><label for="type">Type:</label>
                        <select name="type" id="" class="form-control form-control-sm">
                            <option value="#">Select One</option>
                            <option value="company" >Company</option>
                            <option value="church" >Church</option>
                            <option value="school" >School</option>
                            <option value="university" >University</option>
                            <option value="college" >College</option>
                            <option value="ngo" >NGO</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" name="account">Submit</button>
            </form>


<?php include_once('includes\footer.php') ?>