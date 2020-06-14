<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add your smart parcel box</title>
<?php include('lib1/php/style.php');
include('config.php');


$active_user = $_COOKIE['username'];
if(isset($_COOKIE['username'])){$loginStatus = '<li ><a href="login.php"><font color="white">User: </font><font color="green">'.$active_user.'</font> - Logout</a></li>';}
elseif(!isset($_COOKIE['username'])){header('Location: login.php');
exit();}

?>

<style>
@-webkit-keyframes blink {
    0% {
        opacity: 1;
    }
    49% {
        opacity: 1;
    }
    50% {
        opacity: 0;
    }
    100% {
        opacity: 0;
    }
}
@-moz-keyframes blink {
    0% {
        opacity: 1;
    }
    49% {
        opacity: 1;
    }
    50% {
        opacity: 0;
    }
    100% {
        opacity: 0;
    }
}
@-o-keyframes blink {
    0% {
        opacity: 1;
    }
    49% {
        opacity: 1;
    }
    50% {
        opacity: 0;
    }
    100% {
        opacity: 0;
    }
}
span {
    -webkit-animation: blink 1s;
    -webkit-animation-iteration-count: infinite;
    -moz-animation: blink 1s;
    -moz-animation-iteration-count: infinite;
    -o-animation: blink 1s;
    -o-animation-iteration-count: infinite;
}

/* Bordered form */
form {
  border: 3px solid #f1f1f1;
}

/* Full-width inputs */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}



/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
}
/* Extra style for the cancel button (red) */
.accept {
  width: auto;
  padding: 10px 18px;
  background-color: #69C97A;
}
/* Center the avatar image inside this container */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

/* Avatar image */
img.avatar {
  width: 40%;
  border-radius: 50%;
}

/* Add padding to containers */
.container {
  padding: 16px;
}

/* The "Forgot password" text */
span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }
  .cancelbtn {
    width: 100%;
  }
}</style>
</head>
<body>


<div class="container-fluid">
  <div class="row content">

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <div class="icon-bar"></div>
        <div class="icon-bar"></div>
        <div class="icon-bar"></div>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">

    <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
          <li ><a href="add.php">Add Device</a></li>
		  		  <li><a href="settings.php">Settings</a></li>

		  		  <?php
					include('config.php');
					if($_COOKIE['username']==$admin){
						echo'<li><a href="admin.php">Register Device</a></li>';
					}
						echo $loginStatus;
					?>
    </ul>
  </div>
</nav>
</div>

<?php
////////delete///////////


    $error=2;
    if($error!=1){

        class MyDB1 extends SQLite3
        {
            function __construct()
            {
                $this->open('database.db');

            }

        }
        $db = new MyDB1();
        if(!$db){
            echo $db->lastErrorMsg();

        } else {

            $sql ='SELECT * from DEVICES;';
            $ret = $db->query($sql);
            while($row = $ret->fetchArray(SQLITE3_ASSOC)){
            $existing_device=$row["DEVICE"];
            $existing_user=$row["USERNAME"];
            $activation_code=$row["ACTIVATION_CODE"];
			if(isset($_POST['delete_dev'])){
			$delete_dev = $_POST['delete_dev'];
			$username = $_COOKIE['username'];
                    $sql ='UPDATE DEVICES SET USERNAME="", MAIL="", DESCRIPTION="" WHERE USERNAME="'.$username.'" AND DEVICE="'.$delete_dev.'"';

					}
				}
			}

        }
        $ret = $db->exec($sql);
        if(!$ret){
            echo $db->lastErrorMsg();
             echo'error1';
        } else {

        }
        $db->close();

            chmod("database.db", 0600);



///////////EDIT//////////////
if(isset($_POST['edit_description'])){
    if($error!=1){

        class MyDB2 extends SQLite3
        {
            function __construct()
            {
                $this->open('database.db');

            }

        }
    $db = new MyDB2();
	$username = $_COOKIE['username'];
	$edit_device = $_POST['edit_device'];
	$edit_mail = $_POST['edit_mail'];
	$edit_description = $_POST['edit_description'];
	$edit_message = $_POST['edit_message'];
$sql ='UPDATE DEVICES SET MAIL="'.$edit_mail.'", DESCRIPTION="'.$edit_description .'", MESSAGE="'.$edit_message.'" WHERE USERNAME="'.$username.'" AND DEVICE="'.$edit_device.'"';
$ret = $db->exec($sql);
        if(!$ret){
            echo $db->lastErrorMsg();
             echo'error1';
		$db->close();
        chmod("database.db", 0600);
}
}
}

if(isset($_POST['edit_dev'])){
$edit_dev=$_POST['edit_dev'];
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

  $sql ='SELECT * from DEVICES where DEVICE="'.$edit_dev.'";';
  $ret = $db->query($sql);
   echo '<form action="index.php" method="POST"> <br><br><br><b>Editing <font color="red">'. $edit_dev.'</font></b>
   <a href="http://cloudapps.zapto.org/spb/mail.php?smartbox='. $edit_dev.'&SIGNAL=';
   echo "-".rand(49,100);
   echo'" target="blank">test</a><br><br>
   <table class="table">
    <thead>
      <tr>

        <th>Description</th>
        <th>Notifications e-mail address</th>
		<th>Notifications message</th>
<th></th>

      </tr>
    </thead>
    <tbody>

   ';
   while($row = $ret->fetchArray(SQLITE3_ASSOC)){
    $existing_mail=$row["MAIL"];
    $existing_device=$row['DEVICE'];
    $existing_user=$row['USERNAME'];
	$description=$row['DESCRIPTION'];
	$message=$row['MESSAGE'];

if($active_user=$existing_user){

echo '
      <tr>
';

echo '

<td><input type="hidden" value="'. $existing_device.'" name="edit_device">
<input type="text" value="'.$description.'" name="edit_description">
</td>
<td>
<font color="green"> ';

echo '<input type="text" value="'.$existing_mail.'" name="edit_mail">';
echo'</font>
</td>
<td>';
echo '<input type="text" value="'.$message.'" name="edit_message">';
echo'
</td>
</tr>
	  <input type="submit" class="btn btn-primary btn-xl" value="Save">

	  </form>';
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








}else{

//////////////////Preview/////////////////////
$today_date= date("Y/m/d", time()-3600);

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
   echo '<br><br>
<br><br><b>Your Smart Parcel Boxes</b><br>
   <br>
   <table class="table">
    <thead>
      <tr>
        <th>Details</th>
		<th>Last Event</th>
		<th>WiFi</th>
		<th>Manage</th>
      </tr>
    </thead>
    <tbody>

   ';
   while($row = $ret->fetchArray(SQLITE3_ASSOC)){
    $existing_mail=$row["MAIL"];
$existing_mail=str_replace(",","<br>",$existing_mail);
    $existing_device=$row['DEVICE'];
    $existing_user=$row['USERNAME'];
	$description=$row['DESCRIPTION'];
	$signal=$row['SIGNAL'];
    $date=$row['DATE'];
    $read=$row['READ'];

   // $date= explode('::',$date);

//$date['0'] = strtotime('-1 hour',$date['0']);
//$date['0'] = date( 'Y/m/d - h:i:sa' ,  );
if($active_user=$existing_user){

echo '
      <tr>
        <td>';
echo $description;
echo'	<br>
<font color="blue" size="1"> ID:';
echo $existing_device;
echo '</font> ';
echo'
<br>
<font color="green" size="1"> ';
echo $existing_mail.'</font>
</td>
<td>';
$day = explode(' - ', $date);
if($read=='1'){echo
'<b><a href="history.php?id='.$existing_device.'">'.$date.'</a><b/><span><img width="25" src="lib1/img/box.png"></span></td>
<td>';}
else{
echo'<a href="history.php?id='.$existing_device.'">'.$date.'</a>
</td>
<td>';
}

if($signal>=-50){echo'<img src="lib1/img/100.png" width="20">';}
if($signal<=-51 and $signal>=-60){echo'<img src="lib1/img/75.png" width="20">';}
if($signal<=-61 and $signal>=-70){echo'<img src="lib1/img/50.png" width="20">';}
if($signal<=-71){echo'<img src="lib1/img/25.png" width="20">';}
echo'
</td>
<td><form action="index.php" method="POST">
<input type="hidden" name="username">
  <input type="hidden" value="'.$existing_device.'" name="edit_dev">
  <input  type="submit" class="btn btn-success btn-xs" value="Edit"></form>



  <form action="index.php" method="POST">
<input type="hidden" name="username">
  <input type="hidden" value="'.$existing_device.'"name="delete_dev">
  <input type="submit" class="btn btn-danger btn-xs" value="Delete"></form></td>
      </tr>';
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
}

?>
    </tbody>
  </table>




<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<div>
<br><br>
<footer class="container-fluid">
  <p>SmartParcelBox</p>
</footer>

</body>
</html>
<?php

////////setting the read value
if(isset($_COOKIE['username'])){
  $db->close();

  $username=$_COOKIE['username'];


    $db = new MyDB1();
    $sql ='UPDATE DEVICES SET READ="0" WHERE USERNAME="'.$username.'"';

  $ret = $db->exec($sql);
    if(!$db){
        echo $db->lastErrorMsg();

    }

  $ret = $db->exec($sql);
  if(!$ret){
      echo $db->lastErrorMsg();
       echo'error1';
  } else {

  }
  $db->close();

      chmod("database.db", 0600);
    }



?>
