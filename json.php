<?php
header("Content-Type: application/json;charset=utf-8");
$active_user = $_COOKIE['username'];
//////////////////Preview/////////////////////
$today_date= date("Y/m/d", time()-3600);
$time= date("Y/m/d H:m:s");
$JSON_PREFIX='';
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
		//selecting the right user for the active cookie
     $sql ='SELECT * from DEVICES where USERNAME="'.$active_user.'";';
     $ret = $db->query($sql);
     $i = 0;
		 // Fetching all information about the user
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
				 // in order to print the beginning of the json  the $state=1 is required and as soon as it prints the begining and middle the state needs changing to 0
				 $state="1";
			 }
			 if($read==1){
				//// ACCESSING USERS
			 	$sql ='SELECT * from USERS where USERNAME="'.$active_user.'";';
			 	$ret = $db->query($sql);
				while($row = $ret->fetchArray(SQLITE3_ASSOC)){
					$NTITLE=$row['NTITLE'];
					$NMESSAGE=$row['NMESSAGE'];
				}
					////
					// beginning of the json structure
					// The title is pulled from the USERS database
				if($state=="1") {
				//	echo $JSON_PREFIX;
					$JSON_PREFIX='{"title":"'.$NTITLE.'","text":"';
					echo$JSON_PREFIX;
					$date = str_replace("<br>", '\n', $date);

					echo $NMESSAGE.' '.$date.' - '.$description.'\n';
					$state="0";
				}
			}
			$i++;
		}
		//////////////////////////////////////////////////////////////////////////////////////////////
		//Accessing SHARED to find the device to print out
		$sql ='SELECT * from SHARED where USERNAME="'.$active_user.'";';
		$ret = $db->query($sql);

		while($row = $ret->fetchArray(SQLITE3_ASSOC)){
				$DEVICE=$row['DEVICE'];
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
			 if($read==1){
			 //echo '>>>'.$JSON_PREFIX;
			 // json prefix needs to be printed only when there's no events on thebowned devices
			 if($JSON_PREFIX==''){
				 $JSON_PREFIX='{"title":"New Delivery","text":"';
			echo$JSON_PREFIX;	 }

			 	$date = str_replace("<br>", '\n', $date);

			 	echo $NMESSAGE.' '.$date.' - '.$description.' \n';
			 	$state="0";


}}
		//////////////////////////////////////////////////////////////////////////////////////////////

		echo'","cookie":"'.$active_user.'"}';
	}
}
if(!isset($_COOKIE['username'])){
	echo'{"title":"Logged out","text":"Please login to receive notifications - '.$time.'","cookie":"unknown"}';
}
$ret = $db->exec($sql);
if(!$ret){
	echo $db->lastErrorMsg();
} else {
}
$db->close();
?>
