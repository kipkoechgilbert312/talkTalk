<?php

include_once('includes\config.php');
include_once('includes\header.php');
include_once('includes\model.php');
$email = $password = $confirm_password =$country =$type= "";
$email_err = $password_err = $confirm_password_err =$country_err =$type_error= "";
 

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

    
    $location = $_POST['location'];
    $orgPhone =$_POST['phone'];
    $orgName =$_POST['OrgName'];
   
    // $country = $_POST['country'];

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
    
    if(empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        accounts($country, $location,$orgPhone,$orgName,$type, $email, $password);
    //         $sql = "INSERT INTO users (accountId, email, password) VALUES (:accountid, :email, :password)";
    
    //         if($stmt = connectdb()->prepare($sql)){
    //             $stmt->bindParam(":accountid", $accountid, PDO::PARAM_STR);
    //             $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
    //             $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
                
    //             $param_email = $email;
    //             $param_password = password_hash($password, PASSWORD_DEFAULT);
                
    //             if($stmt->execute()){
                    
    //                 header("location: login.php");
    //             } else{
    //                 echo "Something went wrong. Please try again later.";
    //             }
            
             
    //     }else{
    //         echo "There was an error inserting the data";
    //     }



    //     unset($stmt);
    }

    // unset();
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
                            </select>

                            </div>

                            <div class="form-group">
                            <label for="OrgName">Organization Name:</label> <input type="text" name="OrgName" id="OrgName" class="form-control form-control-sm" placeholder="QQ software ltd">
                            </div>
                            <div class="form-group">
                            <label for="location">Location:</label> <input type="text" name="location" id="location" class="form-control form-control-sm" placeholder="Nairobi">
                            </div>
                            <div class="form-group">Phone Number:<label for="Phone"></label><input type="tel" name="phone" id="phone" class="form-control form-control-sm" placeholder="0727143163"></div>
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