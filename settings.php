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
        <li ><a href="index.php">Home</a></li>
          <li ><a href="add.php">Add Device</a></li>
		  <li class="active"><a href="settings.php">Settings</a></li>

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
<div > </div><div > </div>

      <div class="col-xl-4">

<br><br> <br>

    <form action="settings.php"  method="post" role="form">	  <br>
    <h3>Mark as read</h3><br>
      <p><h4>Please select when a new event will be mark as seen:</h4></p>
    <input type="radio" id="homepage" name="page" value="homepage">
    <label for="homepage">Home page (owned devices mark as read at once)</label><br>
    <input type="radio" id="history" name="page" value="history">
    <label for="history">History(each device will need to be open to mark as read)</label><br>
    <br>	  <input type="submit" class="btn btn-success btn-xs" value="Save changes">
<br> <br>

  </form>
<br>
    <form action="settings.php"  method="post" role="form">

<h3>Change Password</h3><br>
        <label for="ex3">Current Password</label>
		<input class="form-control" type="password" required name="currentpass">

  <br>

        <label for="ex3">New Password</label>
		<input class="form-control" type="password" required name="newpass">

 <br>
        <label for="ex3">Repeat Password</label>
		<input class="form-control" type="password" required name="repeatnewpass">
<br><button> Change Password</button><br><br>
</form>

<?php
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('database.db');
    }
}
if(isset($_POST['page'])){
  $page = $_POST['page'];

  $db = new MyDB();
  if(!$db){
      echo $db->lastErrorMsg();
  } else {
    $sql ='SELECT * from USERS where USERNAME="'.$active_user.'";';
    $ret = $db->query($sql);
    while($row = $ret->fetchArray(SQLITE3_ASSOC)){
  echo $page;  echo $active_user;
    $sql ='UPDATE USERS SET READPAGE="'.$page.'" WHERE USERNAME="'.$active_user.'" ';
    $ret = $db->exec($sql);
  }}
  if(!$ret){
      echo $db->lastErrorMsg();
  } else {
  }
  $db->close();
      chmod("database.db", 0600);
}

if((isset($_GET['error'])) and $_GET['error']=='1'){echo'Dont remember your password? Try again.';}
if((isset($_GET['error'])) and $_GET['error']=='2'){echo'Passwords do not match.';}
if((isset($_GET['error'])) and $_GET['error']=='3'){echo'Empty field.';}
if((isset($_GET['error'])) and $_GET['error']=='4'){echo'Password changed succcesfully.';}

///////////////DB connect//////////////////
$sql="";
if((isset($_POST['newpass'])) and (isset($_POST['repeatnewpass'])) and (isset($_POST['currentpass']))){

  $username = $_COOKIE['username'];
  $currentpass = $_POST['currentpass'];
  $newpass = $_POST['newpass'];
  $repeatnewpass = $_POST['repeatnewpass'];

if($_POST['newpass']!=$_POST['repeatnewpass']){ echo'<script>window.location = "settings.php?error=2"</script>';

die();}
if($_POST['newpass']=="" or $_POST['repeatnewpass']==""){ echo'<script>window.location = "settings.php?error=3"</script>';die();}

        $db = new MyDB();
        if(!$db){
            echo $db->lastErrorMsg();
        } else {
            $sql ='SELECT * from USERS where USERNAME="'.$active_user.'";';
            $ret = $db->query($sql);
            while($row = $ret->fetchArray(SQLITE3_ASSOC)){
                $currentpassword=$row["PASSWORD"];
                if($_POST['currentpass']!= $currentpassword){echo'<script>window.location = "settings.php?error=1"</script>';}
                if($_POST['currentpass']== $currentpassword){
                  $sql ='UPDATE USERS SET PASSWORD="'.$newpass.'" WHERE USERNAME="'.$username.'" ';


                  $ret = $db->exec($sql);
echo'<script>window.location = "settings.php?error=4"</script>';
                }

            }
        }
        $ret = $db->exec($sql);
        if(!$ret){
            echo $db->lastErrorMsg();
        } else {
        }
        $db->close();


            chmod("database.db", 0600);}
?>

 </div>




<br>


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
