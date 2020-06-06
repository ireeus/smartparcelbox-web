<!DOCTYPE html>
<html lang="en">
<head>
  <title>History</title>
<?php
include('lib1/php/style.php');
include('config.php');

$active_user = $_COOKIE['username'];
if(isset($_COOKIE['username'])){$loginStatus = '<li ><a href="login.php"><font color="white">User: </font><font color="green">'.$active_user.'</font> - Logout</a></li>';}
elseif(!isset($_COOKIE['username'])){
    header('Location: login.php');
     exit();}
if($_COOKIE['username']!=$admin){ header('Location: login.php');}

////////Delete
if(isset($_POST['delete_dev'])){

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
                $sql ='DELETE from DEVICES where DEVICE="'.$delete_dev.'"';

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
    }

?>

<style>/* Bordered form */
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
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">

    <ul class="nav navbar-nav">
        <li ><a href="index.php">Home</a></li>
          <li class="active"><a href="add.php">Add Device</a></li>
		  		  <?php
					if($_COOKIE['username']==$admin){
						echo'<li class="active"><a href="admin.php">Register Device</a></li>';
					}
						echo $loginStatus;
					?>
    </ul>
  </div>
</nav>
</div>
<DIV>
<BR>
   <table class="table">
    <thead>
      <tr>
        <th>TIMESTAMP</th>
        <th>BOX ID</th>
		<th>SIGNAL</th>
		<th>STATUS</th>
		<th></th>
      </tr>
    </thead>
    <tbody>
<?php

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
$smartbox=$_GET['id'];

  $sql ='SELECT * from HISTORY WHERE DEVICE ="'.$smartbox.'"';
  $ret = $db->query($sql);
   echo '

   ';
   while($row = $ret->fetchArray(SQLITE3_ASSOC)){
     $date=$row['DATE'];
    $device=$row['DEVICE'];
	$signal=$row['SIGNAL'];
    $status=$row['STATUS'];
   // $date= explode('::',$date);

//$date['0'] = strtotime('-1 hour',$date['0']);
//$date['0'] = date( 'Y/m/d - h:i:sa' ,  );

echo '
      <tr>
        <td>';
echo $date;

echo'
</td>
<td>
<font color="green"> ';
echo $device.'</font>
</td>
<td>';


if($signal>=-50){echo'<img src="lib1/img/100.png" width="35">';}
if($signal<=-51 and $signal>=-60){echo'<img src="lib1/img/75.png" width="35">';}
if($signal<=-61 and $signal>=-70){echo'<img src="lib1/img/50.png" width="35">';}
if($signal<=-71){echo'<img src="lib1/img/25.png" width="35">';}
echo'
</td>
<td>'.$status.'</td>
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



?>
<!-- end -->

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
