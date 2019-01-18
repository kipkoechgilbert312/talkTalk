<?php

require_once "config.php";
include_once('includes\header.php');

$email = $password = $confirm_password = "";
$email_err = $password_err = $confirm_password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
   
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } else{
      
        $sql = "SELECT UserID FROM users WHERE email = :email";
        
        if($stmt = connectdb()->prepare($sql)){
            
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
        
        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
         
        var_dump($sql);
        if($stmt = connectdb()->prepare($sql)){
  
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            
            if($stmt->execute()){
                
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        unset($stmt);
    }

    // unset();
}
?>
    <div class="wrap">
        
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
            <div class="form-group">
                <input type="submit" class="btn btn-sm btn-primary" value="Submit">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
        <?php include_once('includes\footer.php') ?>