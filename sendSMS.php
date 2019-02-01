<?php
require 'vendor/autoload.php';
// require 'includes\config.php';
use AfricasTalking\SDK\AfricasTalking;

$username   = "Quadrant";
$apikey     = "aaf850f4c1b3d5376f27ea5ad042368581fd450d0895c08ace5e5a98a681a9d0";

$AT         = new AfricasTalking($username, $apikey);

$sms        = $AT->sms();


function sendSMS($recipients, $message){
try {
    // echo $recipients;
    // echo $message;
      // $userid = $_SESSION["id"];
    $sms = $GLOBALS['sms'];

    $result = $sms->send([
        'to'      => $recipients,
        'message' => $message
    ]); 
    var_dump($result);
    
    
//     $status = $result['status'];
//     $data = $result['data'];
//     $messageData = $data->SMSMessageData;
//     $messageString = $messageData->Message;
//     // array fo stdClass so when looping access with $key->phone, $key->statusCode etc
//     $messageRecipients = $messageData->Recipients; 
    // $userid = $_SESSION["id"];
    // $recipient =explode(" " , $recipients);
// var_dump($recipient);
    // foreach($recipient as $recipien){
    //     var_dump($recipien) ."<br/>";
    //     // $sql = "INSERT INTO messages(MsgPhone, MsgText,MsgCreateTime, MsgSender) VALUES('$recipien','$message',now(),'$userid')";
    //     // connectdb()->exec($sql);
         
    //     // echo "<script type= 'text/javascript'>alert('Message successfully sent');</script>";
    // }
} catch (Exception $e) {
    echo "Error: ".$e->getMessage();
}
}

