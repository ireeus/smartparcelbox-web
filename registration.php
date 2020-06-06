<!DOCTYPE html>
<html lang="en">
<head>
  <title>SmartParcelBox</title>
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
        <li class="active"><a href="index.php">Smart Parcel Box</a></li>
           
    </ul>
  </div>
</nav>
</div><br><br><br><br>
<div class="container">
<?php
session_start();

    
   if (isset($_GET["add"])){
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

   $sql ='SELECT * from USERS where USERNAME="'.$_POST["username"].'";';


   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
      $id=$row['ID'];
      $username=$row["USERNAME"];
      $password=$row['PASSWORD'];
      $email=$row['MAIL'];
  }




////////////////////////////////////////

if($username!=$_POST["username"]){if($_POST['email']!=$row['MAIL']){

 $sql ="INSERT INTO USERS (ID,NAME,USERNAME,MAIL,PASSWORD)"."\n"."VALUES ('".$_GET["add"]."', '".$_POST["name"]."', '".$_POST["username"]."', '".$_POST["email"]."', '".$_POST["pwd"]."');";
echo '<font color="green">'.$_POST["username"].'</font> registered succesfully';
}else{echo 'This email already exist';}
}
else{echo 'This username already exist';}






//////////////////////////////////////////////////////


 }

//licznik
$adres='user_id.php';
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

   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
     
   }
   $db->close();
               chmod("database.db", 0600);

}
}
$repoversion = file_get_contents('user_id.php');
?>


  <h2>Registration</h2>
<form action="registration.php?add=<?php echo $repoversion;?>"  method="post" role="form">
 
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter your Name">
    </div>
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter password">
    </div>
    <div class="checkbox">
      <label><input type="checkbox"> Remember me</label>
    </div>
    <button type="submit" class="btn btn-default">Submit</button> 
<a href="login.php">Login</a>
  </form>

  <br>
</div>
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
