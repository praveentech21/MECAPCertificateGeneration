<?php
error_reporting(E_ALL); 

$im = imagecreatefrompng("participate.png");
// if there's an error, stop processing the page:
if(!$im)
{
 die("ISSUE WITH GENERATING CERTIFICATE! CONTACT ADMIN!");
}


//Name
// define some colours to use with the image
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);
$font = './roboto.ttf'; // Provide the correct path to your font file

$rollno=($_GET['rollno']);
include "../connect.php";

$result=mysqli_query($conn, "SELECT * FROM `members` WHERE `mobile`='$rollno'");
$row=mysqli_fetch_assoc($result);

if(mysqli_num_rows($result) == 0)
  {
 	echo "<span style='color:red;font-family:Arial;'><b>SORRY! YOUR CREDENTIALS DID NOT MATCH THE RECORDS. CERTIFICATE WILL NOT BE GENERATED</b></span><br><a href='../certificate.php' style='color:blue;font-family:Arial;'>TRY AGAIN</a><br>";
  }  
else
  {
	//echo "<h2 style='color:#AA0055;font-family:Arial;'>CODE MASTER 2018 - LEVEL 1 CERTIFICATE</h2>";  
  $sname=ucwords(strtolower($row['player_name']));
  $subject=$row['department'];
  //$name=$sname." - ".$rollno;
  $name=strtoupper($sname);

//writing name and roll number
$text = $name;
imagettftext($im, 20, 0, 470, 353, $black, $font, $text);

//writing rool number
$text = $subject; 
imagettftext($im, 20, 0, 150, 413, $black, $font, $text);

$myfile = "tmp/".$rollno.".png";

// output the image as a png

imagepng($im, $myfile);
?>
<script>
  window.open("tmp/<?php echo $rollno; ?>.png");
</script>
<?php
imagedestroy($im);
	}		
?>