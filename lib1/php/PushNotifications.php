<?php

define( 'API_ACCESS_KEY', 'AIzaSyDh9j_AH19CRKkYzcFy75WlndzsU31Qer0' ); // get API access 
//key from Google/Firebase API's Console

$registrationIds = array( 'AIzaSyDh9j_AH19CRKkYzcFy75WlndzsU31Qer0' ); //Replace this with your device token


// Modify custom payload here
$msg = array
(
        'mesgTitle'     => 'SMART TESTING',
        'alert'         => 'This is sample notification'

);
$fields = array
(
    'registration_ids'      => $registrationIds,
    'data'                  => $msg
);

$headers = array
(
    'Authorization: key=' . API_ACCESS_KEY,
    'Content-Type: application/json'
);

$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' ); //For firebase, use https://fcm.googleapis.com/fcm/send

curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
echo $result;

?>