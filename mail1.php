<?php
//date_default_timezone_set('GMT');
if(isset($_GET['smartbox'])){
$signal = $_GET['SIGNAL'];
$smartbox = $_GET['smartbox'];
$date = date("Y/m/d - H:i:s", time()-3600);
$date=$date.'<br>Lid open';

        class MyDB extends SQLite3
        {
            function __construct()
            {
                $this->open('database.db');
            }
        }
        $db = new MyDB();
        if(!$db){
            echo $db->lastErrorMsg();
        } else {
            $sql ='SELECT * from DEVICES where DEVICE="'.$smartbox.'";';
            $ret = $db->query($sql);
            while($row = $ret->fetchArray(SQLITE3_ASSOC)){
                $existing_mail=$row["MAIL"];
                $existing_user=$row["USERNAME"];
                $existing_device=$row["DEVICE"];
				$description=$row["DESCRIPTION"];
            }
        }
        $ret = $db->exec($sql);
        if(!$ret){
            echo $db->lastErrorMsg();
        } else {
        }
		$sql ='UPDATE DEVICES SET SIGNAL="'.$signal.'", DATE="'.$date.'" WHERE  DEVICE="'.$smartbox.'"';
    $ret = $db->exec($sql);
		$sql ='UPDATE DEVICES SET READ="1" WHERE  DEVICE="'.$smartbox.'"';
    $ret = $db->exec($sql);
    $sql ="INSERT INTO HISTORY (DATE,DEVICE,SIGNAL,STATUS)"."\n"."VALUES ('".$date."', '".$smartbox."', '".$signal."','LID ERROR');";
    $ret = $db->exec($sql);
        if(!$ret){
            echo $db->lastErrorMsg();
             echo'error1';
        $db->close();
                chmod("database.db", 0600);
}
/*
     * Enable error reporting
     */
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );

    /*
     * Setup email addresses and change it to your own
     */
    $from = "noreply@5v.pl";
    $to = $existing_mail;
    $subject = "Smart Parcel Box - ERROR";
    $message = "
Warning! The lid of the box wasn't close correctly

Message sent from: ".$description."
Box ID: ".$existing_device."

WiFi signal strenght: ".$signal."

";
    $headers = "From:" . $from;

    /*
     * Test php mail function to see if it returns "true" or "false"
     * Remember that if mail returns true does not guarantee
     * that you will also receive the email
     */
    if(mail($to,$subject,$message, $headers))
    {
        echo "
Email send from a device: ".$smartbox." <br>
Signal strenght: ".$signal."".$date."



";
    }
    else
    {
        echo "error sending email";
    }}
else{
//phpinfo();
}
?>
