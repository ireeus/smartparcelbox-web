<?php include('lib1/php/style.php');
include('config.php');
$active_user = $_COOKIE['username'];
if(isset($_COOKIE['username'])){
  $loginStatus = '<li ><a href="login.php"><font color="white">User: </font><font color="green">'.$active_user.'</font> - Logout</a></li>';
}elseif(!isset($_COOKIE['username'])){
  header('Location: login.php'); exit();}
// deleting shared items
if(isset($_POST['delete_shared_dev'])){
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
    $sql ='DELETE from SHARED where DEVICE="'.$_POST['delete_shared_dev'].'";';
    $ret = $db->query($sql);
    echo'<script>window.location = "index.php"</script>';
    if(isset($_GET['SHARED'])){echo'<script>window.location = "index.php"</script>';
    }
    if(!isset($_GET['SHARED'])){echo'<script>window.location = "index.php?X='.$_GET['XDEV'].'"</script>';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add your smart parcel box</title>
  <style>
    <?php include('lib1/style/style.php');?>
  </style>
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
///////////////////////////////////////////////////////////////////////////
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
//////// DELETE the device assigned to the user///////////
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
} else {}
  $db->close();
  chmod("database.db", 0600);

///////////EDIT the device email, description and message/////////////
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
///////////EDIT shared//////////////
if(isset($_POST['edit_shared_description'])){
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
  	$edit_device = $_POST['edit_shared_device'];
  	$edit_mail = $_POST['edit_shared_mail'];
  	$edit_description = $_POST['edit_shared_description'];
  	$edit_message = $_POST['edit_shared_message'];
    $sql ='UPDATE SHARED SET MAIL="'.$edit_mail.'", DESCRIPTION="'.$edit_description .'", MESSAGE="'.$edit_message.'" WHERE USERNAME="'.$username.'" AND DEVICE="'.$edit_device.'"';
    $ret = $db->exec($sql);
    if(!$ret){
      echo $db->lastErrorMsg();
      echo'error1';
      $db->close();
      chmod("database.db", 0600);
    }
  }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
        $mail=$row1["MAIL"];
      }
      $sql ='SELECT * from DEVICES where DEVICE="'.$edit_dev.'";';
      $ret = $db->query($sql);
      echo '<form action="index.php" method="POST"> <br><br><br><b>Editing <font color="red">'. $edit_dev.'</font></b>
      <a href="http://cloudapps.zapto.org/spb/mail.php?smartbox='. $edit_dev.'&SIGNAL=';
      echo "-".rand(49,100);
      echo'" target="blank">test</a> <br><br>
      <table class="table">
      <thead>
      <tr>
        <th>Description</th>
          <th>Notifications e-mail</th>
  		    <th> message</th>
          <th></th>
        </tr>
        </thead>
        <tbody>';
      while($row = $ret->fetchArray(SQLITE3_ASSOC)){
        $existing_mail=$row["MAIL"];
        $existing_device=$row['DEVICE'];
        $existing_user=$row['USERNAME'];
      	$description=$row['DESCRIPTION'];
      	$message=$row['MESSAGE'];
        if($active_user=$existing_user){
          echo '<tr>';
          echo '
            <td><input type="hidden" value="'. $existing_device.'" name="edit_device">
              <input type="text" value="'.$description.'" name="edit_description">
            </td>
            <td>
            <font color="green"> ';
            echo '<input type="text" value="'.$existing_mail.'" name="edit_mail">';
            echo'</font></td><td>';
            echo '<input type="text" value="'.$message.'" name="edit_message">';
            echo'
</td>
</tr>

	  <input type="submit" class="btn btn-success btn-xl" value="Save changes">

	  </form>
<br>  <br>  <form action="index.php" method="POST">
  <input type="hidden" value="'.$existing_device.'"name="sharing">
  <input type="submit" class="btn btn-default btn-xs" value="Sharing '.$existing_device.'"></form>
  <br>

<br>
      <form action="index.php" method="POST">
      <input type="hidden" name="username">
      <input type="hidden" value="'.$existing_device.'"name="delete_dev">
      <input type="submit" class="btn btn-danger btn-xs" value="Delete '.$existing_device.'"></form>';
      }
    }
  }
  $ret = $db->exec($sql);
  if(!$ret){
    echo $db->lastErrorMsg();
  } else {}
    $db->close();
  }
}
elseif(isset($_POST['edit_shared_dev'])){
  $edit_dev=$_POST['edit_shared_dev'];
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
        $mail=$row1["MAIL"];
      }
      $sql ='SELECT * from SHARED where DEVICE="'.$edit_dev.'";';
      $ret = $db->query($sql);
      echo '<form action="index.php" method="POST"> <br><br><br><b>Editing <font color="red">'. $edit_dev.'</font></b>
   <a href="http://cloudapps.zapto.org/spb/mail.php?smartbox='. $edit_dev.'&SIGNAL=';
      echo "-".rand(49,100);
      echo'" target="blank">test</a> <br><br>
   <table class="table">
    <thead>
      <tr>
        <th>Description</th>
      
<th></th>
      </tr>
    </thead>
    <tbody>';
      while($row = $ret->fetchArray(SQLITE3_ASSOC)){
        $existing_mail=$row["MAIL"];
        $existing_device=$row['DEVICE'];
        $existing_user=$row['USERNAME'];
    	  $description=$row['DESCRIPTION'];
    	  $message=$row['MESSAGE'];
        if($active_user=$existing_user){
          echo '<tr>';
          echo '
      <td><input type="hidden" value="'. $existing_device.'" name="edit_shared_device">
      <input type="text" value="'.$description.'" name="edit_shared_description">
      </td>

      </tr>

      	  <input type="submit" class="btn btn-success btn-xl" value="Save changes">

      	  </form>

        <br>

      <br>
            <form action="index.php" method="POST">
          <input type="hidden" name="username">
            <input type="hidden" value="'.$existing_device.'"name="delete_shared_dev">
            <input type="submit" class="btn btn-danger btn-xs" value="Delete '.$existing_device.'"></form>
          ';
      }
    }
 }
 $ret = $db->exec($sql);
 if(!$ret){
   echo $db->lastErrorMsg();
 } else {}
   $db->close();
 }
}
///SHARING
elseif((isset($_POST['sharing'])) or  (isset($_GET['X']))){
  if(isset($_POST['sharing'])){$sharing_device=$_POST['sharing'];
}
if(isset($_GET['X'])){$sharing_device=$_GET['X'];
}
  echo'
<div>
<br><br><br><br>Enter the email of the user that you want to share the device with.
  <form action="index.php" method="POST">
  <input type="text" value=""name="sharing_email">
  <input type="hidden" value="'.$sharing_device.'" name="sharing_device">
    <input type="submit" class="btn btn-default btn-xs" value="Share '.$sharing_device.' device"></form><br>
  <br> </div>
';
///////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////
//List of users shared the device below
echo'
   <table class="table">
    <thead>
      <tr>
        <th><center><font size="1">EMAIL</center></th>
        <th><center><font size="1">DEVICE</center></th>
		<th><center><font size="1">USER</center></th>
		<th><center><font size="1">DELETE</center></th>
      </tr>
    </thead>
    <tbody>
';


//////////////////Preview sharing_email/////////////////////

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
  $sql ='SELECT * from SHARED WHERE DEVICE ="'.$sharing_device.'"';
  $ret = $db->query($sql);
  //
   while($row = $ret->fetchArray(SQLITE3_ASSOC)){
     $id=$row['ID'];
     $email=$row['MAIL'];
     $device=$row['DEVICE'];
	   $username=$row['USERNAME'];
echo '
      <tr>
        <td><center><font size="1"> ';
echo $email;

echo'
</font></center></td>
<td><center>
<font color="green" size="1"> ';
echo $device.'</font>
</center></td>
<td><center><font size="1">';
//Accessing SHARED to find the device to print out
echo $username;
echo'</font></center></td>
<td><center><a href="index.php?X='.$id.'&XDEV='.$sharing_device.'">X</a></center></td>
      </tr>';
}

  }

   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {

   }
   $db->close();


/////////////////////////////END OF SHARING LIST///////////////////////////////////////////

}
//SHARING EXECUTION
elseif((isset($_POST['sharing_email'])) and (isset($_POST['sharing_device']))) {

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
       $sql ='SELECT * from USERS WHERE MAIL ="'.$_POST["sharing_email"].'"';
       $ret = $db->query($sql);
       //

      echo'<script>window.location = "index.php?X='.$_POST["sharing_device"].'"</script>';

        while($row = $ret->fetchArray(SQLITE3_ASSOC)){
          $user_shared_with=$row['USERNAME'];
          if($_POST["sharing_email"]==$row['MAIL']){


            $sql ='SELECT * from SHARED WHERE DEVICE ="'.$_POST["sharing_device"].'"';
            $ret = $db->query($sql);
            while($row = $ret->fetchArray(SQLITE3_ASSOC)){

              die();
            }


              $sql ="INSERT INTO SHARED (DEVICE,DESCRIPTION,MAIL,USERNAME,SIGNAL,DATE,MESSAGE,READ)"."\n"."VALUES ('".$_POST["sharing_device"]."','','".$_POST["sharing_email"]."', '$user_shared_with','','','','');";
              $ret = $db->exec($sql);
              echo"<br><br><br><br><br>". $_POST["sharing_device"]." is now shared with ".$_POST["sharing_email"].". ";

        }

        }


  if(!$ret){
     echo $db->lastErrorMsg();
  } else {

  }
  $db->close();
  chmod("database.db", 0600);}

}

else{

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

if($active_user==$existing_user){

echo '
      <tr>
        <td>';
echo $description;
echo'	<br>
<font color="blue" size="1"> ID:';
echo $existing_device;
echo '</font> ';
if($existing_mail==''){
  $existing_mail='Edit the device to add the email. It will let you receive event messages.';
  $button='No email';
}
echo'
<br>
<p>
  <button class="btn btn-link btn-sm" type="button" data-toggle="collapse" data-target="#'.$existing_device.'" aria-expanded="false" aria-controls="'.$existing_device.'">
    '.$button.'
  </button>
</p>
<div class="collapse" id="'.$existing_device.'">
  <div class="card card-body"><font color="blue" size="1">
'.$existing_mail.'</div>
</div>



</td>
<td><font color="blue" size="2">';
$day = explode(' - ', $date);
if($read=='1'){echo
'<b><a href="history.php?id='.$existing_device.'">'.$date.'</a><b/><span><img width="25" src="lib1/img/box.png"></span></td>
<td><font color="blue" size="2">';}
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
  <input  type="submit" class="btn btn-primary btn-xs" value="Edit device"></form>


</td>
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


//// shared devices database ///////////////////////////////////////////////////////////////

//*

  //////////////////Preview shared/////////////////////
  $today_date= date("Y/m/d", time()-3600);


  $db = new MyDB();
  if(!$db){
     echo $db->lastErrorMsg();
  } else {
    $sql ='SELECT * from SHARED where USERNAME="'.$active_user.'";';
    $ret = $db->query($sql);
    //echo$sql;

     while($row = $ret->fetchArray(SQLITE3_ASSOC)){
      $sharing_mail=$row["MAIL"];
      $sharing_device=$row['DEVICE'];
      $sharing_user=$row['USERNAME'];
      $description=$row['DESCRIPTION'];
      $signal=$row['SIGNAL'];
      $date=$row['DATE'];
      $read=$row['READ'];
      $id=$row["ID"];
  if($sharing_user==$active_user){

	  $db1 = new MyDB();
      $sql1 ='SELECT * from SHARED where DEVICE="'.$sharing_device.'";';
      $ret1 = $db1->query($sql1);
	       while($row1 = $ret1->fetchArray(SQLITE3_ASSOC)){
           $sharing_mail=$row1["MAIL"];
           $sharing_mail=str_replace(",","<br>",$sharing_mail);
           $sharing_device=$row1['DEVICE'];
           $sharing_user=$row1['USERNAME'];
           $description=$row1['DESCRIPTION'];
           $signal=$row1['SIGNAL'];
           $date=$row1['DATE'];
           $read=$row1['READ'];

		   }

  echo '<tr>
          <td>';
  echo $description;
  echo'	<br>
  <font color="blue" size="1"> ID:';
  echo $sharing_device;
  echo '</font> ';
  if($sharing_mail==''){
    $sharing_mail='Edit the device to add the email. It will let you receive event messages.';
    $button='No email';
  }
  echo'
  <br>
  <p>
    <button class="btn btn-link btn-sm" type="button" data-toggle="collapse" data-target="#'.$sharing_device.'" aria-expanded="false" aria-controls="'.$sharing_device.'">
      '.$button.'
    </button>
  </p>
  <div class="collapse" id="'.$sharing_device.'">
    <div class="card card-body"><font color="blue" size="1">
  '.$sharing_mail.'</div>
  </div>



  </td>
  <td><font color="blue" size="2">';
  $day = explode(' - ', $date);
  if($read=='1'){echo
  '<b><a href="history.php?id='.$sharing_device.'">'.$date.'</a><b/><span><img width="25" src="lib1/img/box.png"></span></td>
  <td><font color="blue" size="2">';}
  else{
  echo'<a href="history.php?id='.$sharing_device.'">'.$date.'</a>
  </td>
  <td>';
  }

  if($signal>=-50){echo'<img src="lib1/img/100.png" width="20">';}
  if($signal<=-51 and $signal>=-60){echo'<img src="lib1/img/75.png" width="20">';}
  if($signal<=-61 and $signal>=-70){echo'<img src="lib1/img/50.png" width="20">';}
  if($signal<=-71){echo'<img src="lib1/img/25.png" width="20">';}
  echo'
  </td>
  <td>
  <form action="index.php" method="POST">
  <input type="hidden" name="username">
    <input type="hidden" value="'.$sharing_device.'" name="edit_shared_dev">
    <input  type="submit" class="btn btn-info btn-xs" value="Edit shared"></form>


  </td>
        </tr>';


  }


    }
  }}
     $ret = $db->exec($sql);
     if(!$ret){
        echo $db->lastErrorMsg();
     } else {


     $db->close();

  //// shared devices database
  echo'    </tbody>
    </table>';



//*/
}

?>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<div>
</body>
</html>
<?php

$expiry = $_COOKIE['expiry']/86400;
//echo$expiry;

/////////setting the read value
if(isset($_COOKIE['username'])){
  $db->close();

  $username=$_COOKIE['username'];
  $db = new MyDB();
  if(!$db){
      echo $db->lastErrorMsg();
  } else {
    $sql ='SELECT * from USERS where USERNAME="'.$active_user.'";';
    $ret = $db->query($sql);
    while($row = $ret->fetchArray(SQLITE3_ASSOC)){
      $readpage=$row['READPAGE'];
      if($readpage=='history'){}
      if($readpage=='homepage'){
        $db = new MyDB1();

        $sql ='UPDATE SHARED SET READ="0" WHERE USERNAME="'.$username.'"';
        $ret = $db->exec($sql);

        $sql1 ='UPDATE DEVICES SET READ="0" WHERE USERNAME="'.$username.'"';
        $ret = $db->exec($sql1);

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

            chmod("database.db", 0600);}
      }
    }

    }
?>
