<?php

include_once('includes\config.php');
include_once('includes\header.php');
include_once('includes\model.php');
$email = $password = $confirm_password =$country =$type=$location=$orgPhone=$orgName= "";
$email_err = $password_err = $confirm_password_err =$country_err =$type_error=$location_err = $orgPhone_err = $orgName_err="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
$CON= connectdb();
    if(empty($_POST['new'])){
        $type_error = "Please enter the value";
    }else{
        $type=$_POST['new'];
    }
    if(empty($_POST['country'])){
        $country_err= "Please enter the value";
    }else{
        $type=$_POST['country'];
        echo $country;
    }

    
// Verify Location 

if(empty($_POST['location'])){
    $location_err ="Please Enter Location";
}else{
    $location =$_POST['location'];
}

// Verify if Type has been selected

if(empty($_POST['type'])){
    $type_err = "Please Select Type";
}else{
    $location =$_POST['type'];
}


// Verify Phone if already taken 
if(empty(trim($_POST["phone"]))){
    $orgPhone_err = "Please enter a Contact.";
} else{
  
    $sql = "SELECT ID FROM accounts WHERE phone = :phone";
    
    if($stmt = $CON->prepare($sql)){
        
        $stmt->bindParam(":phone", $param_phone, PDO::PARAM_INT);
        
        $param_phone= trim($_POST["phone"]);
        
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                $phone_err = "This Contact is already taken.";
            } else{
                $phone = trim($_POST["phone"]);
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    unset($stmt);
}


// Verify Organization Name if already Taken 
if(empty(trim($_POST["orgName"]))){
    $orgName_err = "Please enter a Organization Name.";
} else{
  
    $sql = "SELECT ID FROM accounts WHERE OrganisationName = :orgName";
    
    if($stmt = $CON->prepare($sql)){
        
        $stmt->bindParam(":orgName", $param_orgName, PDO::PARAM_STR);
        
        $param_orgName = trim($_POST["orgName"]);
        
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                $orgName_err = "This Organisation Name is already taken.";
            } else{
                $orgName = trim($_POST["orgName"]);
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    unset($stmt);
}


    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } else{
      
        $sql = "SELECT UserID FROM users WHERE email = :email";
        
        if($stmt = $CON->prepare($sql)){
            
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            
            $param_email = trim($_POST["email"]);
            
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        unset($stmt);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    if(empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($location_err)&&empty($orgPhone_err)&&empty($orgName_err)&&empty($email_err)&&empty($type_err)){
        accounts($country, $location,$orgPhone,$orgName,$type, $email, $password);
    var_dump(accounts());
    }
}
?>
     <div class="row">
     <div class="col-sm-6">
            <h2>Sign Up</h2>
                <p>Please fill this form to create an account.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <span><i class="fas fa-envelope-square"></i></span><label>Email</label>
                        <input type="email" name="email" class="form-control form-control-sm" value="<?php echo $email; ?>">
                        <span class="help-block"><?php echo $email_err; ?></span>
                    </div>    
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <span><i class="fas fa-unlock-alt"></i></span><label>Password</label>
                        <input type="password" name="password" class="form-control form-control-sm" value="<?php echo $password; ?>">
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <span><i class="fas fa-unlock-alt"></i></span><label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control form-control-sm" value="<?php echo $confirm_password; ?>">
                        <span class="help-block"><?php echo $confirm_password_err; ?></span>
                    </div>

        
             </div>
                <div class="col-sm-6">
                            <div class="form-group">
                            <label for="country">Select Country: </label>
                            <select name="country" id="" class="selectpicker" >
                            <option value="+254">Kenya</option>
                            <option value="+252">Uganda</option>
                            <option value="+255">Tanzania</option>
                            <span class="help-block"><?php echo $country_err; ?></span>
                            </select>

                            </div>

                            <div class="form-group">
                    <label for="OrgName">Organization Name:</label> <input type="text" name="orgName" id="OrgName" class="form-control form-control-sm" placeholder="QQ software ltd">
                    <span class="help-block"><?php echo $orgName_err; ?></span>
                    </div>
                    <div class="form-group">
                    <label for="location">Location:</label> <input type="text" name="location" id="location" class="form-control form-control-sm" placeholder="Nairobi">
                   <span class="help-block"><?php echo $location_err; ?></span>
                    </div>
                    <div class="form-group">Phone Number:<label for="Phone"></label><input type="tel" name="phone" id="phone" class="form-control form-control-sm" placeholder="0727143163">
                    <span class="help-block"><?php echo $orgPhone_err; ?></span>
                    </div>
                            <p>Already have an account? <a href="login.php">Login here</a>.</p>
                                               <div class="form-group">
                                               <div class="form-group"><label for="type">Select Type of Account</label>
                                <select name="new" id=""  class="selectpicker">
                                    <option value="company" >Company</option>
                                    <option value="church" >Church</option>
                                    <option value="school" >School</option>
                                    <option value="university" >University</option>
                                    <option value="college" >College</option>
                                    <option value="ngo" >NGO</option>
                                </select>
                            </div>
                        <input type="submit" class="btn btn-sm btn-primary" value="Submit">
                    </div> 
                   
                 </form>
                    
                </div>
  
        <?php include_once('includes\footer.php') ?>