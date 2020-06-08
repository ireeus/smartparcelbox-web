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

      <div class="col-xs-4">

	  <form action="settings.php"  method="post" role="form">
	  <br><br>
Change Password<br><br>
        <label for="ex3">Current Password</label>
		<input class="form-control" type="text" required name="currentpass">

  <br>

        <label for="ex3">New Password</label>
		<input class="form-control" type="text" required name="newpass">

 <br>
        <label for="ex3">Repeat Password</label>
		<input class="form-control" type="text" required name="repeatnewpass">
<br><button> Change Password</button><br>
</form>
 </div>




<br>


<?php
////////delete///////////


    $error=2;
    if($error!=1){
		
///////////////DB connect//////////////////
$sql="";
        class MyDB1 extends SQLite3
        {
            function __construct()
            {
                $this->open('database.db');
            }
        }
        $db = new MyDB1();
///////////////DB connect end//////////////////
///////////////DB connect error report/////////
        if(!$db){
			echo $db->lastErrorMsg();
			} 
		else {
///////////////query execute//////////////////

			if((isset($_POST['currentpass'])) and (isset($_POST['newpass'])) and (isset($_POST['repeatnewpass']))){
			
				$username = $_COOKIE['username'];
				$sql='SELECT FROM USERS where USERBAME="'.$username.'"';
				$ret = $db->exec($sql);
				while($row = $ret->fetchArray(SQLITE3_ASSOC)){
           				$currentpassword=$row["PASSWORD"];
				if($_POST['currentpass']!= $currentpassword){ ECHO"You've entered a wrong password.";}

            }


			// ERRORS
			if($_POST['newpass']!=$_POST['repeatnewpass']){ ECHO"Passwords don't match";}
			if($_POST['newpass']=="" or $_POST['repeatnewpass']==""){ ECHO"Empty field";}
				
			
			$currentpass = $_POST['currentpass'];
			$newpass = $_POST['newpass'];
			$repeatnewpass = $_POST['repeatnewpass'];
			$sql ='UPDATE USERS SET PASSWORD="'.$newpass.'" WHERE USERNAME="'.$username.'" ';

					}
					else{echo"Something is not right";}
				}
		$ret = $db->exec($sql);
        if(!$ret){
            echo $db->lastErrorMsg();
             echo'error1';
        } 
        $db->close();

            chmod("database.db", 0600);
				
				
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
