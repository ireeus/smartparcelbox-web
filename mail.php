<?php
include('config.php');
//date_default_timezone_set('GMT');
if(isset($_GET['smartbox'])){
  $signal = $_GET['SIGNAL'];
  $smartbox = $_GET['smartbox'];
  $date = date("Y/m/d - H:i:s", time()-3600);
  $date=$date.'';
  class MyDB extends SQLite3
    { function __construct()
        { $this->open('database.db');
        }
    }
    $db = new MyDB();
    if(!$db){   echo $db->lastErrorMsg();
        } else {
            $sql ='SELECT * from DEVICES where DEVICE="'.$smartbox.'";';
            $ret = $db->query($sql);
            while($row = $ret->fetchArray(SQLITE3_ASSOC)){
                $existing_mail=$row["MAIL"];
                $existing_user=$row["USERNAME"];
                $existing_device=$row["DEVICE"];
				$email_message=$row["MESSAGE"];
				$description=$row["DESCRIPTION"];
            }
        }
        $ret = $db->exec($sql);
        if(!$ret){
            echo $db->lastErrorMsg();
        } else {
        }
		$sql ='UPDATE DEVICES SET SIGNAL="'.$signal.'", DATE="'.$date.'", READ="1" WHERE  DEVICE="'.$smartbox.'"';
    $ret = $db->exec($sql);

    $sql ="INSERT INTO HISTORY (DATE,DEVICE,SIGNAL,STATUS,USERNAME)"."\n"."VALUES ('".$date."', '".$smartbox."', '".$signal."','DELIVERY', '".$existing_user."');";
    $ret = $db->exec($sql);



        if(!$ret){
            echo $db->lastErrorMsg();
             echo'error1';
        $db->close();
               chmod("database.db", 0600);
}


  $db = new MyDB();
  if(!$db){   echo $db->lastErrorMsg();
      } else {
          $sql ='SELECT * from SHARED where DEVICE="'.$smartbox.'";';
          $ret = $db->query($sql);
          while($row = $ret->fetchArray(SQLITE3_ASSOC)){
          }
      }
      $ret = $db->exec($sql);
      if(!$ret){
          echo $db->lastErrorMsg();
      } else {
      }

      $sql ='UPDATE SHARED SET SIGNAL="'.$signal.'", DATE="'.$date.'", READ="1" WHERE  DEVICE="'.$smartbox.'"';
      $ret = $db->exec($sql);


      if(!$ret){
          echo $db->lastErrorMsg();
           echo'error1';
      $db->close();
             chmod("database.db", 0600);
}

  $db = new MyDB();
  if(!$db){   echo $db->lastErrorMsg();
      } else {
          $sql ='SELECT * from USERS where USERNAME="'.$existing_user.'";';
          $ret = $db->query($sql);
          while($row = $ret->fetchArray(SQLITE3_ASSOC)){
              $NMAIL=$row["NMAIL"];

          }
      }
      $ret = $db->exec($sql);
      if(!$ret){
          echo $db->lastErrorMsg();
          $db->close();
      }
if($NMAIL=='1'){
// Ten skrypt musi byc wykonany tylko wtedy kiedy w ustawieniach zostanie zaznaczona funkcja
$email_message_str = str_replace(" ", "%20", $email_message);
$string = $mailing_gate.'?ID='.$existing_device.'&DEVICE='.$description.'&SIGNAL='.$signal.'&EMAIL='.$existing_mail.'&MESSAGE='.$email_message_str.'';
$file = file_get_contents($string);
echo $file;


if($signal>=-50){$range='[l][l][l][l]';}
if($signal<=-51 and $signal>=-60){$range='[l][l][l][.]';}
if($signal<=-61 and $signal>=-70){$range='[l][l][.][.]';}
if($signal<=-71){$range='[l][.][.][.]';}


//Enable error reporting

    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );


     //Setup email addresses and change it to your own

    $from = "noreply@5v.pl";
    $to = $existing_mail;
    $subject = "Smart Parcel Box";
    $message = $email_message."

Message sent from: ".$description."
Box ID: ".$existing_device."

WiFi signal strenght: ".$signal."
".$range;
    $headers = "From:" . $from;


      // Test php mail function to see if it returns "true" or "false"
     //  Remember that if mail returns true does not guarantee
     // that you will also receive the email

    if(mail($to,$subject,$message, $headers))
    {
        echo "
Email send from a device: ".$smartbox."
Signal strenght: ".$signal."

";
if($signal>=-50){echo'[l][l][l][l]';}
if($signal<=-51 and $signal>=-60){echo'[l][l][l][.]';}
if($signal<=-61 and $signal>=-70){echo'[l][l][.][.]';}
if($signal<=-71){echo'[l][.][.][.]';}

    }
    else
    {
        echo "Test string request submited. <br>
Close this window and check the result or return to home page.
However if you return to the main page all notifications will be reset on page reload.
        <a href='index.php'>Return to home page</a>";
    }}
else{
//phpinfo();
}}
?>
