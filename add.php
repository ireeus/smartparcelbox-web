<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add your smart parcel box</title>
<?php include('lib1/php/style.php');
include('config.php');
$active_user = $_COOKIE['username'];
if(isset($_COOKIE['username'])){$loginStatus = '<li ><a href="login.php"><font color="white">User: </font><font color="green">'.$active_user.'</font> - Logout</a></li>';}
elseif(!isset($_COOKIE['username'])){
    header('Location: login.php');
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
        <li ><a href="index.php">Home</a></li>
          <li class="active"><a href="add.php">Add Device</a></li>
		  		  <?php 
					include('config.php');
					if($_COOKIE['username']==$admin){
						echo'<li class="active"><a href="admin.php">Register New Device</a></li>';
					}
						echo $loginStatus;
					?>
    </ul>
  </div>
</nav>
</div>
<br><br><br><br>

<form action="add.php"  method="post" role="form">
Device ID:<br>
<input type="text" required name="devid"><br>
 Activation Code:<br>
<input type="text" required name="activation">
<button> Register</button>
</form>

<?php

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
            while($row = $ret->fetchArray(SQLITE3_ASSOC)){
                $existing_mail=$row["MAIL"];
                $existing_user=$row["USERNAME"];

            }
        }
        $ret = $db->exec($sql);
        if(!$ret){
            echo $db->lastErrorMsg();
        } else {
        }
        $db->close();
   









if(isset($_POST['devid']) and isset($_POST['activation']))
{
    
    $devid = $_POST['devid'];
    //$mail = $_POST['mail'];
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
            $activation=$_POST['activation'];
                if($existing_device==$_POST['devid'] and $existing_user=="" and  $activation_code==$_POST['activation']) {
                    $sql ='UPDATE DEVICES SET USERNAME="'.$active_user.'" WHERE ACTIVATION_CODE="'.$activation.'" AND DEVICE="'.$devid.'"';}
                }    
               
               
                
          
            
        }
        $ret = $db->exec($sql);
        if(!$ret){
            echo $db->lastErrorMsg();
             echo'error1';
        } else {
                  echo'<script>window.location = "https://spb.5v.pl"</script>;
';
        }
        $db->close();
        
    }
    
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















