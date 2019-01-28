<?php



function accounts($country, $location,$orgPhone,$orgName,$type, $email, $password){
        
    $sql = "INSERT INTO accounts(OrganisationName,CountryCode,phone,AccountLocation,AccountType) VALUES('$orgName','$country','$orgPhone','$location','$type')";
    $CON = connectdb();
   $CON ->exec($sql);
   
   $accountid = $CON ->lastInsertId();

if($CON ->exec($sql)){
    $sql = "INSERT INTO users (accountId, email, password) VALUES ($accountid, :email, :password)";
    
    if($stmt = $CON ->prepare($sql)){
        // $stmt->bindParam(":accountid", $accountid, PDO::PARAM_STR);
        $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
        
        $param_email = $email;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        
        if($stmt->execute()){
            
            header("location: login.php");
        } else{
            echo "Something went wrong. Please try again later.";
        }
    
     
}else{
    echo "There was an error inserting the data";
}
}
   
}


function category($catName, $catDesc, $catorgid){
        
    $sql = "INSERT INTO categories(CatOrgId, Name, Description) VALUES('$catorgid','$catName','$catDesc')";
    
   $CON->exec($sql);
   echo "<script type= 'text/javascript'>alert('Data successfully sent');</script>";
   
}

function updatecategory($catID, $catDesc, $catName){
    $sql = " UPDATE categories SET Name = '$catName', Description= '$catDesc' WHERE Name = '$catID' ";
    if($CON->exec($sql)){
        header("location:../index.php?active=add_category");
    }else{
        echo "<script type= 'text/javascript'>alert('Record was not Updated');</script>";
    }
}

function contacts($contCatId,$country, $contPhone,$contName, $contCreator,$contEmail){
    $sql = "INSERT INTO contacts(ContCatID, CountryCode, ContPhone,ContName,ContCreator,ContEmail) VALUES('$contCatId',$country, '$contPhone','$contName', '$contCreator','$contEmail')";
    
   $CON->exec($sql);
   
   
}
function updatecontact($contID, $phone, $name, $email){
    $sql = "UPDATE contacts SET ContPhone = '$phone', ContName = '$name', ContEmail= '$email' WHERE ContID='$contID'";
    if($CON->exec($sql)){
        header("location:../index.php?active=get_contacts");
    }else{
        echo "<script type= 'text/javascript'>alert('Record was not Updated');</script>";
    }
    
}



?>