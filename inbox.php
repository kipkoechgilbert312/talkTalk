<?php
require 'vendor/autoload.php';
use AfricasTalking\SDK\AfricasTalking;

// Set your app credentials
$username   = "Quadrant";
$apikey     = "aaf850f4c1b3d5376f27ea5ad042368581fd450d0895c08ace5e5a98a681a9d0";

// Initialize the SDK
$AT       = new AfricasTalking($username, $apikey);

// Get the sms service
$sms = $AT->sms();

// Our API will return 100 messages at a time back to you
// starting with what you currently believe is the lastReceivedId.
// Specify 0 for the first time you access the method
// and the ID of the last message we sent you on subsequent calls
$lastReceivedId = 0;

try {
    // Fetch all messages using a loop
    do {
        $messages = $sms->fetchMessages([
            'lastReceivedId' => $lastReceivedId
        ]);

        foreach($messages as $message) {
            print_r($message);

            // Reassign the lastReceivedId
            $lastReceivedId = $message->id;
        }
    } while(count($results) > 0);

    // NOTE: Be sure to save the lastReceivedId for next time
} catch (Exception $e) {
    echo "Error: ".$e->getMessage();
}