<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add your smart parcel box</title>
<?php 
include('lib1/php/style.php');
include('config.php');

$active_user = $_COOKIE['username'];
if(isset($_COOKIE['username'])){$loginStatus = '<li ><a href="login.php"><font color="white">User: </font><font color="green">'.$active_user.'</font> - Logout</a></li>';}
elseif(!isset($_COOKIE['username'])){
    header('Location: login.php');
     exit();}
if($_COOKIE['username']!=$admin){ header('Location: login.php');}

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
						echo'<li class="active"><a href="admin.php">Register New Device</a></li>';
					}
						echo $loginStatus;
					?>
    </ul>
  </div>
</nav>
</div>

<br><br><br>
<?php
//session_start();

    
   if (isset($_POST["devid"])){
	   $error=0;
	  //die();
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
///////////////////////////////////////////////

  

////////////////////////////////////////

if($_POST["devid"]!=''){if($_POST['activation']!=''){

 $sql ="INSERT INTO DEVICES (ID,DEVICE,DESCRIPTION,MAIL,USERNAME,ACTIVATION_CODE,SIGNAL,DATE,MESSAGE)"."\n"."VALUES ('".$_GET["add"]."', '".$_POST["devid"]."', '', '', '', '".$_POST['activation']."', '', '', '');";
echo '<font color="green">'.$_POST["devid"].'</font> registered succesfully';
}else{echo 'Empty field';}
}
else{echo 'Empty field';}






//////////////////////////////////////////////////////


 }



   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
     
   
   $db->close();
   chmod("database.db", 0600);
   
			//licznik
			$adres='device_id.php';
			if (file_exists($adres)) $t=file($adres);
			else $t=array(0);
			$t[0]++;
			if ($plik=fopen($adres,'w'))
				{
				flock($plik,LOCK_EX);
				fputs($plik,$t[0]);
				flock($plik,LOCK_UN);
				fclose($plik);
				} 
	}
}
}
$repoversion = file_get_contents('device_id.php');
?>



<br><br><br><br>

<form action="admin.php?add=<?php echo $repoversion;?>"  method="post" role="form">
Device ID:<br>
<input type="text" required name="devid"><br>
 Activation Code:<br>
<input type="text" required name="activation">
<button> ADD NEW DEVICE ID <?php echo $repoversion;?></button>
</form>
<br>
   <br>
   <table class="table">
    <thead>
      <tr>
        <th>Description</th>
        <th>Notifications e-mail address</th>
		<th>Last Event</th>
		<th>WiFi Signal</th>
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


  $sql ='SELECT * from DEVICES ';
  $ret = $db->query($sql);
   echo '
   
   ';
   while($row = $ret->fetchArray(SQLITE3_ASSOC)){
    $existing_mail=$row["MAIL"];
$existing_mail=str_replace(",","<br>",$existing_mail);
    $existing_device=$row['DEVICE'];
    $existing_user=$row['USERNAME'];
    $activation_code=$row['ACTIVATION_CODE'];
	$description=$row['DESCRIPTION'];
	$signal=$row['SIGNAL'];
    $date=$row['DATE'];
   // $date= explode('::',$date);
	
//$date['0'] = strtotime('-1 hour',$date['0']);
//$date['0'] = date( 'Y/m/d - h:i:sa' ,  );
	
echo '
      <tr>
        <td>';
echo $description;
echo'	<br>	
<font color="blue" size="1"> ID:';   
echo $existing_device;
echo '</font> ';
echo'	<br>	
<font color="RED" size="1">';   
echo $activation_code;
echo '</font> ';

echo'
</td>  
<td>
<font color="green"> ';
echo $existing_mail.'</font> 
</td>
<td>';
$day = explode(' - ', $date);
if($day['0']==$today_date){
	echo
'<b>'.$date.'<b/><span><img width="25" src="lib1/img/box.png"></span></td>
<td>';
}
else{
echo
$date.'
</td>
<td>';
}

if($signal>=-50){echo'<img src="lib1/img/100.png" width="35">';}
if($signal<=-51 and $signal>=-60){echo'<img src="lib1/img/75.png" width="35">';}
if($signal<=-61 and $signal>=-70){echo'<img src="lib1/img/50.png" width="35">';}
if($signal<=-71){echo'<img src="lib1/img/25.png" width="35">';}
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
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
     
   }
   $db->close();
}


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







