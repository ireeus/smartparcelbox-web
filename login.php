<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login to Smart Parcel Box</title>
 <?php include('lib1/php/style.php');


?>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


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
        <li class="active"><a href="">Smart Parcel Box</a></li>            
    </ul>
  </div>
</nav>
</div>

<div class="jumbotron">
<div class="container">



<div class="alert alert-success">
  
  
   <?php
//destroying existing session

setcookie("username", "", time() - 3600, "/");
if (isset($_SESSION['username'])){
session_destroy();
session_unset();
}
session_start();
$_SESSION['username'] = '';


     if (isset($_GET["login"])){
          class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('database.db');
      }
   }
   $db = new MyDB();
   $id='';
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      //echo "Opened database successfully\n";
   }

   $sql ='SELECT * from USERS where USERNAME="'.$_POST["usr_name"].'";';


   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
      $id=$row['ID'];
      $username=$row["USERNAME"];
      $password=$row['PASSWORD'];
  }
  
    if ($id!=""){
        if ($password==$_POST["pwd"]){
$time='36000';
          
setcookie("username", $username, time() + $time, '/');

          header('Location: index.php'); 
exit;
        }else{
          
          echo '
		  
		  
		  
		  
<div class="alert alert-danger">
  <strong>Wrong Password</strong> try again.
</div>';
        }
      }else{
       echo '
	   <div class="alert alert-danger">
  <strong>User doesn\'t exist</strong> please register to continue!.
</div>';
      }
   //echo "Operation done successfully\n";
   $db->close();
     }

?>
  
  
  <img src="lib1/img/smartbox.png"  style="width:30%">  <i><font size="4" color="black">Making sure your parcel will reach your box</font></i><br>
<br>
</div>




  <form role="form" action="login.php?login=true" method="post" role="form">
    <div class="form-group">
      <label for="usr_name">Username:</label>
      <input type="text" class="form-control" id="usr_name" name="usr_name" placeholder="Enter Username">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter password">
    </div>
    <div class="checkbox">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form><br>
<a href="registration.php">Register new account</a>
</div></div>
         </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br><br><br><br><br><br><br><br>
<footer class="container-fluid">
  <p>SmartParcelBox</p>
</footer>

</body>
</html>
