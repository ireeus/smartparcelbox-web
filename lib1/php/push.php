<?php

define( 'API_ACCESS_KEY', 'AIza......Xhdsnkf' ); // get API access key from Google/Firebase API's Console

$registrationIds = array( 'cyMSGTKBzwU:APA.....gyfgdshjbfhsdgbhbhsdf' ); //Replace this with your device token
 
 
// Modify payload here
$msg = array
(
            'mesgType'      => 'ACTION', //Must be COM or MEM
            'action_id'     => '4664'
);

$notification = array  //refer payload notification here : https://firebase.google.com/docs/cloud-messaging/http-server-ref
(
            'title'      => 'New Action has created', //Must be COM or MEM
            'body'     => 'Come meet me at Bangsar South',
            'sound'         => 'default'
               
);

$fields = array
(
        'registration_ids'      => $registrationIds,
        'data'                  => $msg,
        'notification'          => $notification
);
 
$headers = array
(
        'Authorization: key=' . API_ACCESS_KEY,
        'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' ); //For firebase, use https://fcm.googleapis.com/fcm/send

curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
echo $result;
 
?>