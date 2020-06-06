<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add your smart parcel box</title>
<?php include('lib1/php/style.php');

$active_user = $_COOKIE['username'];
if(isset($_COOKIE['username'])){$loginStatus = '<li ><a href="login.php"><font color="white">User: </font><font color="green">'.$active_user.'</font> - Logout</a></li>';}
elseif(!isset($_COOKIE['username'])){header('Location: login.php');
exit();}

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
        <li class="active"><a href="index.php">Home</a></li>
          <li ><a href="add.php">Add Device</a></li>
            <?php echo $loginStatus;?>
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
                    $sql ='UPDATE DEVICES SET USERNAME="", MAIL="", DESCRIPTION="" WHERE USERNAME="'.$username.'" AND DEVICE="'.$delete_dev.'"';}
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
        




///////////EDIT//////////////
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
   echo '<form action="index.php" method="POST"> <br><br><br><b>Editing <font color="red">'. $existing_device.'</font></b><br>
   <br>
   <table class="table">
    <thead>
      <tr>

        <th>Description</th>
        <th>Email</th>
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

if($active_user=$existing_user){
	
echo '
      <tr>
';   

echo ' 

<td><input type="text" value="'.$description.'" name="edit_descryption">
</td>  
<td>
<font color="green"> ';

echo '<input type="text" value="'.$existing_mail.'" name="edit_email">';
echo'</font> 
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
   echo '<br><br><br><b>Twoje skrzynki</b><br>
   <br>
   <table class="table">
    <thead>
      <tr>
        <th>ID number</th>
        <th>Description</th>
        <th>Email</th>
		<th>Recent</th>
		<th>Signal</th>
		<th></th>
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

if($active_user=$existing_user){
	
	
	

	
echo '
      <tr>
        <td>
<font color="red"> ';   
echo $existing_device;
echo '</font> 
</td>
<td>
'.$description.'
</td>  
<td>
<font color="green"> ';
echo $existing_mail;
echo'</font> 
</td>
<td></td>
<td>
</td>
<td><form action="index.php" method="POST">  
<input type="hidden" name="username">
  <input type="hidden" value="'.$existing_device.'" name="edit_dev">
  <input  type="submit" class="btn btn-success btn-xs" value="Edit"></form>
  
  </td>
<td>
  
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















