<?php
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

   // $date= explode('::',$date);

//$date['0'] = strtotime('-1 hour',$date['0']);
//$date['0'] = date( 'Y/m/d - h:i:sa' ,  );
if($active_user=$existing_user){
  $day = explode(' - ', $date);
  echo'{"title":"Delivery at '.$description.'","text":"'.$message.' - '.$date.'","cookie":"'.$active_user.'"}';

/*

if($read=='1'){echo
'<a href="history.php?id='.$existing_device.'">'.$date.'</a>';}
else{
echo'<a href="history.php?id='.$existing_device.'">'.$date.'</a>';
}
echo',';
*/
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
if(!isset($_COOKIE['username'])){echo'{"title":"Logged out","text":"Please login to recive notifications - '.$time.'","cookie":"'.$active_user.'"}'; }
?>
