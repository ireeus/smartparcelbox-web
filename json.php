<?php
echo'{"title":"Delivery at ';

header("Content-Type: application/json;charset=utf-8");
$active_user = $_COOKIE['username'];

//////////////////Preview/////////////////////
$today_date= date("Y/m/d", time()-3600);
$time= date("Y/m/d H:m:s");

$error=2;
      if($error!=1){
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
   $sql ='SELECT * from USERS where USERNAME="'.$active_user.'";';
   $ret = $db->query($sql);
    while($row1 = $ret->fetchArray(SQLITE3_ASSOC)){
      $mail=$row1["MAIL"];}

  $sql ='SELECT * from DEVICES where USERNAME="'.$active_user.'";';
  $ret = $db->query($sql);

   while($row = $ret->fetchArray(SQLITE3_ASSOC)){
    $existing_mail=$row["MAIL"];
$existing_mail=str_replace(",","<br>",$existing_mail);
$existing_device=$row['DEVICE'];
$message=$row['MESSAGE'];
    $existing_user=$row['USERNAME'];
	$description=$row['DESCRIPTION'];
	$signal=$row['SIGNAL'];
    $date=$row['DATE'];
    $read=$row['READ'];


	if($active_user=$existing_user){
	  $day = explode(' - ', $date);
	  echo $description;
	  
	  echo'","text":"'.$message.' - '.$date;  

	}
  }
 }
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {

   }
   $db->close();
}
  echo'","cookie":"'.$active_user.'"}';
if(!isset($_COOKIE['username'])){echo'{"title":"Logged out","text":"Please login to recive notifications - '.$time.'","cookie":"'.$active_user.'"}'; }
?>
