<?php

ob_start();

require 'config.php';

$db = mysqli_connect(DATABASE_SERVER, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME) or die("Wrong config.php settings.");
mysqli_set_charset($db, 'utf8');

$socialID = mysqli_real_escape_string($db, $_POST["sid"]);
$userID = mysqli_real_escape_string($db, $_POST["uid"]);
$imageBLOB = $_POST["blob"];

$lt = localtime();
$startsecond = $lt[0];
$startminute = $lt[1];
$starthour = $lt[2];
$startday = $lt[3];
$startmonth = $lt[4] + 1;
$startyear = $lt[5] + 1900;
$file_prefix = round(rand(0, 99999999));
$file_un = $startsecond.$startyear.$starthour.$startmonth.$startminute.$startday;
$file_postfix = round(rand(0, 9999));

$pic_filename = $file_prefix.$file_un.$file_postfix.".jpg";

$dir_link = $HOMEPAGE_PATH."images";

$full_link = $HOMEPAGE_URL."images"."/".$pic_filename;

if(strlen($socialID) < 1)
{
$fh = fopen("raw.log", "a+");
fwrite($fh, "ok1"."\n");

   $socialID = 1;
   $sqlQuery = "INSERT INTO pf_phototrain (social_id,
               user_id_1,
               user_id_2,
               user_id_3,
               user_id_4,
               user_profile_link_1,
               user_profile_link_2,
               user_profile_link_3,
               user_profile_link_4,
               image_link,
               status) VALUES ('{$socialID}',
               '{$userID}',
               '',
               '',
               '',
               '',
               '',
               '',
               '',
               '{$full_link}',
               '1')";
   if(!($hQuery = @mysqli_query($db, $sqlQuery)))
   {
      print "MySQL Insert Error (pf_phototrain): ".mysqli_error($db);
      fwrite($fh, "MySQL Insert Error (pf_phototrain): ".mysqli_error($db)."\n");
      exit;
   }
}
else
{
   $hQuery = mysqli_query($db, "SELECT * FROM pf_phototrain WHERE social_id='{$socialID}' AND status='1'");
   if($datarow = mysqli_fetch_array($hQuery))
   {
      $recordID = $datarow["id"];
      $userID1 = $datarow["user_id_1"];
      $userID2 = $datarow["user_id_2"];
      $userID3 = $datarow["user_id_3"];
      $userID4 = $datarow["user_id_4"];
      $userProfileLink1 = $datarow["user_profile_link_1"];
      $userProfileLink2 = $datarow["user_profile_link_2"];
      $userProfileLink3 = $datarow["user_profile_link_3"];
      $userProfileLink4 = $datarow["user_profile_link_4"];
      $imageLink = $datarow["image_link"];
      
      if($userID == $userID1 || $userID == $userID2 || $userID == $userID3 || $userID == $userID4)
      {
         print "You already posted on this image.";
         exit;
      }
      
      if($userID1 != "" && $userID2 != "" && $userID3 != "" && $userID4 != "")
      {
         print "This image is full. You may start new image from scratch.";
         exit;
      }

      if($userID1 == "") $sqlQuery = "UPDATE pf_phototrain SET user_id_1='{$userID}',image_link='{$full_link}' WHERE id='{$recordID}'";
      else if($userID2 == "") $sqlQuery = "UPDATE pf_phototrain SET user_id_2='{$userID}',image_link='{$full_link}' WHERE id='{$recordID}'";
      else if($userID3 == "") $sqlQuery = "UPDATE pf_phototrain SET user_id_3='{$userID}',image_link='{$full_link}' WHERE id='{$recordID}'";
      else if($userID4 == "") $sqlQuery = "UPDATE pf_phototrain SET user_id_4='{$userID}',image_link='{$full_link}' WHERE id='{$recordID}'";

      if(!($xQuery = @mysqli_query($db, $sqlQuery)))
      {
         print "MySQL Update Error (pf_phototrain): ".mysqli_error($db);
         exit;
      }
   }
   else
   {
      print "No record with the specified social ID found.";
      exit;
   }
}

$image = imagecreatefrompng($imageBLOB);

if(is_file($dir_link.'/'.$pic_filename))
{
   unlink($dir_link.'/'.$pic_filename);
}
clearstatcache();

imagejpeg($image, $dir_link.'/'.$pic_filename, 90);

// $fh = fopen($dir_link.'/'.$pic_filename, "a+");
// fwrite($fh, $imageBLOB);
// fclose($fh);

ob_end_clean();

print "OK!";

exit;

?>
