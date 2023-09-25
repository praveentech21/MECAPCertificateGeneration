<?php
error_reporting(E_ALL); 

$im = imagecreatefrompng("invitedtalk.png");
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

$rollno=($_POST['rollno']);
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
  $sname=ucwords($row['name']);
  $subject=$row['department'];
  $title=$row['title'];
  //$name=$sname." - ".$rollno;

//writing name and roll number
$text = $sname;
imagettftext($im, 30, 0, 570, 780, $black, $font, $text);

//writing rool number
$text = $subject; 
imagettftext($im, 30, 0, 320, 875, $black, $font, $text);
imagettftext($im, 30, 0, 1420, 870, $black, $font, $title);

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