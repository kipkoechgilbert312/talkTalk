<?php

session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
require_once "config.php";
include_once('includes\header.php');
$email = $password = "";
$email_err = $password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($email_err) && empty($password_err)){
        
        $sql = "SELECT userId, Email, Password FROM users WHERE Email = :email";
        
        if($stmt = connectdb()->prepare($sql)){
            
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            
            $param_email = trim($_POST["email"]);
            
            if($stmt->execute()){
                
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["userId"];
                        $email = $row["Email"];
                        $hashed_password = $row["Password"];
                        if(password_verify($password, $hashed_password)){
                            
                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;                            
                            
                            header("location: index.php");
                        } else{
                           
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                
                    $email_err = "No account found with that email.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        unset($stmt);
    }

    unset($pdo);
}
?>
<div class="wrap">
 
<h2>Login</h2> 
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
            <span><i class="fas fa-envelope-square"></i></span><label>Email</label>
                <input type="text" name="email" class="form-control form-control-sm" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
               <span><i class="fas fa-unlock-alt"></i></span> <label>Password</label>
                <input type="password" name="password" class="form-control form-control-sm">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-sm btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>

</div>
        <?php include_once('includes\footer.php') ?>