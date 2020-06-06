<?php $comment = $_POST['comment'];?><!DOCTYPE html>
<html lang="en">
<head>
  <title>Publish your addon</title>
<?php include('../../lib/php/style.php');


?>

<style>
#myInput {
  background-image: url('../lib/img/searchicon.png'); /* Add a search icon to input */
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 100%; /* Full-width */
  font-size: 18px; /* Increase font-size */
  padding: 12px 20px 12px 40px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 1px; /* Add some space below the input */
}

#myUL {
  /* Remove default list styling */
  list-style-type: none;
  padding: 0;
  margin: 0;
}

#myUL li a {
  border: 1px solid #ddd; /* Add a border to all links */
  margin-top: -2px; /* Prevent double borders */
  background-color: #f6f6f6; /* Grey background color */
  padding: 8px; /* Add some padding */
  text-decoration: none; /* Remove default text underline */
  font-size: 14px; /* Increase the font-size */
  color: black; /* Add a black text color */
  display: block; /* Make it into a block element to fill the whole list */
}
.recent {
  border: 1px solid #ddd; /* Add a border to all links */
  margin-top: -2px; /* Prevent double borders */
  background-color: #f6f6f6; /* Grey background color */
  padding: 8px; /* Add some padding */
  text-decoration: none; /* Remove default text underline */
  font-size: 14px; /* Increase the font-size */
  color: black; /* Add a black text color */
  display: block; /* Make it into a block element to fill the whole list */
}

#myUL li a:hover:not(.header) {
  background-color: #eee; /* Add a hover effect to all links, except for headers */
}
.checkmark {


  height: 10px;
  width: 10px;
  background-color: #eee;
  border-radius: 50%;
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
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      
    <ul class="nav navbar-nav">
        <li ><a href="../../index.php">Home</a></li>
          <li ><a href="../../addons.php">Addons</a></li>
          <li ><a href="../../add.php">Publish addon</a></li>
            <?php echo $loginStatus;?>
    </ul>
  </div>
</nav>
</div>
<div style="margin-left: 10px" >


<?php 

$todayDate = date('Y-m-d H:i:s');

$comment = $_POST['comment'];

if (isset($_POST['comment']) and $_POST['comment']!=''){
//zapisuje dane do bazy
echo'<br><br><br><br>';


$plik = "db.php";
  
if (is_writeable($plik)) {  /* sprawdzam czy plik jest do zapisu */    

if (!$handle = fopen($plik, "a")) echo "";

    if (fwrite($handle, $todayDate.' || '. $comment." || 
	") === FALSE) echo "There was an error. the message could not be saved";

 //else echo "saving data";

    fclose($handle);   

       } else echo "Unable to save the comment - Report it to the administrator(E655)";};

echo'<br><br><br><ul id="myUL"><li><a>';


                    // pobieranie zawartosci pliku                                        
                    $status = file_get_contents('/status.php');
                    $status=explode('||',$status);
                    $assignedUser=$status[0];
                    $blocked=$status[1];
                    
                    $string = file_get_contents('info.html');

                    // kalkulacja statystyk
                    $file = file_get_contents('vote.txt');

                    $a1=substr_count($file, '1'); 
                    $a2=substr_count($file, '2');
                    $a3=substr_count($file, '3');
                    $a4=substr_count($file, '4');
                    $a5=substr_count($file, '5');

                    $total=$a1+$a2+$a3+$a4+$a5;

                    $score=($a1*1+$a2*2+$a3*3+$a4*4+$a5*5)/$total;
                    if($score=='NAN'){$score='0';}

                    if ($file=='') {
                          $score='0';
                        }
                    if($a1>0){$a1=$a1/$total*10;}
                    if($a2>0){$a2=$a2/$total*10;}
                    if($a3>0){$a3=$a3/$total*10;}
                    if($a4>0){$a4=$a4/$total*10;}
                    if($a5>0){$a5=$a5/$total*10;}

                    $a1=round($a1, '0'); 
                    $a2=round($a2, '0');
                    $a3=round($a3, '0');
                    $a4=round($a4, '0');
                    $a5=round($a5, '0');
                    $score=round($score, '1');
                    if($score=='0'){$score='<font color="#000000"><b>'.$score.'</b></font>';}
                    if($score<='1'){$score='<font color="#f4424b"><b>'.$score.'</b></font>';}
                    if($score<='2'){$score='<font color="#f442e8"><b>'.$score.'</b></font>';}
                    if($score<='3'){$score='<font color="#8f42f4"><b>'.$score.'</b></font>';}
                    if($score<='4'){$score='<font color="#42a7f4"><b>'.$score.'</b></font>';}
                    if($score<='5'){$score='<font color="green"><b>'.$score.'</b></font>';}
                    //searching for icon file
                    $icon = 'resources/icon.png';
                    include('ver.php');
                    $foldername=dirname('');

                    if (!file_exists($icon)) {
                        $icon='icon.png';
                        $fanart = 'fanart.jpg';
                    } elseif(file_exists($icon)) {
                        $icon='resources/icon.png';

                        $fanart = 'resources/fanart.jpg';}
                    //jesli folder nie zawiera blocked.php to wyswietlam liste aplikacji

//$icon = 'icon.png'; 
//$iconr = 'resources/icon.png'; 
//szukanie ikony
if((!file_exists($icon)) and (!file_exists($iconr))){ $icon='../../lib/img/missing.jpg';} 



                    //////Content///////
                    echo'
                    <table>
                      <tr>
                        <th>                <table style="margin: 20px">'; 
 
echo'


<tr>
                                      <tr>
                                        <td><center><img src="../../lib/img/bar/'.$a1.'.png" width="5"></center></td>
                                        <td><center><img src="../../lib/img/bar/'.$a2.'.png" width="5"></center></td>
                                        <td><center><img src="../../lib/img/bar/'.$a3.'.png" width="5"></center></td>
                                        <td><center><img src="../../lib/img/bar/'.$a4.'.png" width="5"></center></td>
                                        <td><center><img src="../../lib/img/bar/'.$a5.'.png" width="5"></center></td>
                                      </tr>
                                      </tr>

                                      <tr >
                                    <form action="vote.php" method="post">
                                        <td><input type="radio" class="checkmark" name="score" required value="1"> </td>
                                        <td><input type="radio" class="checkmark" name="score" required value="2"> </td>
                                        <td><input type="radio" class="checkmark" name="score" required value="3"> </td>
                                        <td><input type="radio" class="checkmark" name="score" required value="4"> </td>
                                        <td><input type="radio" class="checkmark" name="score" required value="5"> </td>

                                      </tr>  
                                         <tr   >
                                        <td ><small>1<small></td>
                                        <td><small>2<small></td>
                                        <td><small>3<small></td>
                                        <td><small>4<small></td>
                                        <td><small>5<small></td>
                                      </tr>
                                      <tr>
                                        <td colspan="5"><center><button class="button1">Vote ('.$total.')</button><br>
                                  
                                    <center><font color="grey" size="1">Score:</font><font size="2">

                                    '.$score.'</font>
                                    
                                    </center></td>
                                      </tr>
                                    </form>
                                    </table></th>
                        <th>
                        <center>
            <img   style="margin-right: 30px; margin-left: 10px; margin-top: 5px; margin-bottom: 2px" src="'.$icon.'" width="120"><br>
                <font color="grey"  size="1">Ver:</font><font  color="orange" size="1"> '.$currentVersion.'</font>

                   </a>
                        <center></th>
                        <th  >'.$string.'';


            $string = file_get_contents('addon.xml'); 
            //wyciaganie opisu z pliku xml
                $enter="
";
            $br='<br><font size="1">'; 
            $resultString1=explode('<news>',$string);
            $resultString2=explode('</news>',$resultString1[1]);
            $description=$resultString2[0];
            $description = str_replace($enter,$br,$description);
            $description = mb_strimwidth($description, 0, 350, '...');
            //wyciaganie opisu z pliku xml

            $resultString1=explode('<summary lang="en_GB">',$string);
            $resultString2=explode('</summary>',$resultString1[1]);
            $description2=$resultString2[0];
            $description2 = str_replace($enter,$br,$description2);
echo $description2;
echo'<br>';

echo $description;
echo '</font></th>
                      </tr>
                    </table
<br><form action=""  method="post">
Comment the addon:
 <input type="text" cols="50" maxlength="160" name="comment" >
  <br><input type="submit">
</form></a></li>

<li><a> 

                    '; 
            

?>

<table  border="0">

<?php $plik = "db.php";
$dane = file($plik); /* pobieram dane z pliku i zapisuje do tablicy (linia = rekord) */
for($i=0;$i<count($dane);$i++) { /* przeszukuje tablice */
 list($dane1[$i],$dane2[$i]) = explode(" || ", $dane[$i]);
  /* dziele linie na tablice i zapisuje dane do odpowiednich zmienncyh */

}if($i!=''){echo '<b>Your comments:</b>';
for($i=0;$i<count($dane1);$i++) /* przeszukuje tablice */
if($dane1[$i]!=='' or $dane2[$i]!=='' ){echo '<tr>
<p><font  size="2" color="red">' .$dane1[$i].'</font> <br> '.$dane2[$i].'</li></p>';}
   
}?>
</table>
</a></li></ul>
       </div>
        </div>
      </div>
    </div>
  </div>
<div>
<br><br>
<footer class="container-fluid">
  <p>CloudRepo</p>
</footer>

</body>
</html>
