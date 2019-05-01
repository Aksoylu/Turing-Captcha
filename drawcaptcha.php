<?Php
require "core.php";


 $cfont="fonts/".$_FONT.".otf";
 $_SESSION["XCAPTCHA_GUIDE"] = $_GUIDE;
 $_SESSION["XCAPTCHA_FONT"] = $_FONT;
 $_SESSION["XCAPTCHA_QUESTION"]=$_QUESTION;
 $_SESSION["XCAPTCHA_ANSWER"]=$_ANSWER;

 $pic=imagecreate(140,65);


 correction:

 $w1 = rand(0,255);
 $w2 = rand(0,255);
 $w3 = rand(0,255);

 $b1 = rand(0,255);
 $b2 = rand(0,255);
 $b3 = rand(0,255);

 $dif1 = abs($w1 - $b1);
 $dif2 = abs($w2 - $b2);
 $dif3 = abs($w3 - $b3);


 if($dif1 <= 10 || $dif2 <= 10 || $dif3 <= 10)
 	goto correction;
 

 $white=ImageColorAllocate($pic,$w1,$w2,$w3);
 $blue=ImageColorAllocate($pic,$b1,$b2,$b3);

 imagefill($pic,4,5,$blue);

 imagettftext($pic,$_FONTSIZE,$_ANGLE,$_TEXTSTART,40,$white,$cfont,$_QUESTION);

 header("Content-type: image/png");
 ImagePNG($pic);
 ImageDestroy($pic);

?>