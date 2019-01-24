<?php

function accounts($location,$orgPhone,$orgName,$email,$type){
        
    $sql = "INSERT INTO accounts(OrganisationName,phone,Email,AccountLocation,AccountType) VALUES('$$orgName','$orgPhone','$email','$location','$type')";
    
   connectdb()->exec($sql);
   echo "<script type= 'text/javascript'>alert('Data successfully sent');</script>";
   header("location:index.php");
   
}


function category($catName, $catDesc, $catorgid){
        
    $sql = "INSERT INTO categories(CatOrgId, Name, Description) VALUES('$catorgid','$catName','$catDesc')";
    
   connectdb()->exec($sql);
   echo "<script type= 'text/javascript'>alert('Data successfully sent');</script>";
   
}

function contacts($contCatId,$contPhone,$contName, $contCreator,$contEmail){
    $sql = "INSERT INTO contacts(ContCatID, ContPhone,ContName,ContCreator,ContEmail) VALUES('$contCatId','$contPhone','$contName', '$contCreator','$contEmail')";
    
   connectdb()->exec($sql);
   echo "<script type= 'text/javascript'>alert('Data successfully sent');</script>";
   
}



?>