<?php
header("Content-Type: application/json;charset=utf-8");
$active_user = $_COOKIE['username'];
//////////////////Preview/////////////////////
$today_date= date("Y/m/d", time()-3600);
$time= date("Y/m/d H:m:s");
	if(isset($_COOKIE['username'])){
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
     $sql ='SELECT * from DEVICES where USERNAME="'.$active_user.'";';
     $ret = $db->query($sql);
     $i = 0;
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
  	   $day = explode(' - ', $date);
           if($i == 0){
                  echo'{"title":"New delivery","text":"';
                  }
       if($read==1){

           $date = str_replace("<br>", '\n', $date);

           echo ' '.$date.' - '.$description.'\n';

         }
         $i++;
       }
       echo'","cookie":"'.$active_user.'"}';
     }
   }
   if(!isset($_COOKIE['username'])){echo'{"title":"Logged out","text":"Please login to receive notifications - '.$time.'","cookie":"unknown"}'; }

   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {

   }
   $db->close();
?>
