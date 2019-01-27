<?php

require 'config.php';

$db = mysqli_connect(DATABASE_SERVER, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME) or die("Wrong config.php settings.");
mysqli_set_charset($db, 'utf8');

$recordID = "";
$socialID = "";
$userID1 = "";
$userID2 = "";
$userID3 = "";
$userID4 = "";
$userProfileLink1 = "";
$userProfileLink2 = "";
$userProfileLink3 = "";
$userProfileLink4 = "";
$imageLink = "";

if(isset($_POST["sid"])) $socialID = mysqli_real_escape_string($db, filter_var($_POST["sid"], FILTER_SANITIZE_STRING));
else if(isset($_GET["sid"])) $socialID = mysqli_real_escape_string($db, filter_var($_GET["sid"], FILTER_SANITIZE_STRING));

$userID = ""; // Auth user ID. May be facebook ID or any unique number for testing purposes.

if(isset($_POST["uid"])) $userID = mysqli_real_escape_string($db, filter_var($_POST["uid"], FILTER_SANITIZE_STRING));
else if(isset($_GET["uid"])) $userID = mysqli_real_escape_string($db, filter_var($_GET["uid"], FILTER_SANITIZE_STRING));

if($userID == "")
{
   errorExit("User ID not found.");
}

$spotNumber = 0;

if($socialID != "")
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
         errorExit("You already posted on this image.");
      }
      
      if($userID1 != "" && $userID2 != "" && $userID3 != "" && $userID4 != "")
      {
         errorExit("This image is full. You may start new image from scratch.");
      }
      
      if($userID1 == "") $spotNumber = 0;
      else if($userID2 == "") $spotNumber = 1;
      else if($userID3 == "") $spotNumber = 2;
      else if($userID4 == "") $spotNumber = 3;
   }
   else
   {
      errorExit("Social ID not found.");
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href=" ">
<title>PhotoFriends</title>

<!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">

<style>

@import url(https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css);
@import url(https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.3/css/mdb.min.css);

    .logo_main
    {
        position:relative;
        background: url(assets/images/logo_shine_normalres.png) no-repeat;
        background-size: 165px 40px;
        border: 0;
        padding: 0px;
        margin: 0px;
        border-spacing: 0px;
        width: 165px;
        height: 40px;
    }

    @media only screen and (min--moz-device-pixel-ratio: 2),
    only screen and (-o-min-device-pixel-ratio: 2/1),
    only screen and (-webkit-min-device-pixel-ratio: 2),
    only screen and (min-device-pixel-ratio: 2)
    {
        .logo_main
        {
            position:relative;
            background: url(assets/images/logo_shine_hires.png) no-repeat;
            background-size: 165px 40px;
            border: 0;
            padding: 0px;
            margin: 0px;
            border-spacing: 0px;
            width: 165px;
            height: 40px;
        }
    }

.navbar
{
   display: flex;
   justify-content: space-around;
}

.main-bg
{
    background-color: #3a3a3a;
}

.darken-grey-text
{
    color: #2E2E2E;
}

.navbar .dropdown-menu a:hover
{
    color: #616161 !important;
}

.indigo
{
   background-color: #8b25e9 !important;
}

.indigo-gradient
{
   background-image: linear-gradient(to top, #14419c 0%, #255fd3 99%, #255fd3 100%);
}

.nav-link
{
    padding-right: 1.4rem !important;
    padding-left: 1.4rem !important;
}

.navbar .nav-item.avatar
{
    padding: 0;
}

.navbar .nav-item.avatar img
{
    width: 30px;
    height: 30px;
}

.btn
{
   margin-left: 0px;
   margin-top: 3px;
   margin-bottom: 3px;
   border-radius: 0px;
}

.btn-lg
{
    font-size: 1.0rem !important;
    padding: .45rem 1.6rem !important;
    padding-top: 0.50rem !important;
    padding-right: 1.6rem !important;
    padding-bottom: 0.45rem !important;
    padding-left: 1.6rem !important;
}

/* .btn-success
{
    background-color: #ca9902;
}

.btn-success:hover
{
    background-color: #dbb02c !important;
} */

.button-color-1
{
    background-color: #d7469c !important;
}

.button-color-2
{
    background-color: #4e2f8a !important;
}

.text-color-1
{
   color: #d7469c !important;
}

.text-color-2
{
   color: #4e2f8a !important;
}

input, select, textarea
{
    color: #ffffff !important;
}

footer.page-footer .footer-copyright
{
    color: rgba(255,255,255,.6);
    background-color: rgba(40,40,40,1);
}

.upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
  cursor: pointer;
}

.btnx {
    margin-left: 0px;
    margin-top: 3px;
    margin-bottom: 3px;
    border-radius: 0px !important;
    font-size: .8rem;
    padding: .85rem 2.13rem;
    margin: 6px;
    border-radius: 2px;
    border: 0;
    -webkit-transition: .2s ease-out;
    transition: .2s ease-out;
    white-space: normal!important;
    cursor: pointer !important;
    color: #FFF!important;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
}

.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
  cursor: pointer;
}

</style>
</head>
<body class="main-bg">
   <header>
      <nav class="navbar fixed-top navbar-expand-lg navbar-dark indigo">
         <a class="navbar-brand" href="" style="margin-right: 40px; margin-top: 0px;"><div class="logo_main"></div></a>
      </nav>
   </header>

   <div class="container">
      <div class="row">
         <div class="col-lg-3"></div>
         <div class="col-lg-6 col-xs-12 col-sm-12 col-md-12" style="height:100vh; background-color:#4d4d4d;">
         <br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
         <center>
            <div style="width:530px; height:500px; background: #424242;">
               <div style="width:100%; height:500px; background: url('assets/images/no-image.png') no-repeat center center; background-size: 60%;">
		          <canvas id="canvas" width="530" height="500"></canvas>
		       </div>
		    </div>
            <br>
            <div style="display: inline-block">
               <div class="upload-btn-wrapper">
                  <button class="btnx btn-lg button-color-1">UPLOAD</button>
                  <input type="file" id='fileUpload' class='upload' name='userfile' />
               </div>
            </div>
            <div style="display: inline-block">
               <div class="upload-btn-wrapper">
                  <button type="button" class="btnx btn-lg button-color-1" onClick="publishPhoto(); return false;">PUBLISH</button>
               </div>
            </div>
            <br>
            <div id="status" style="color: #ffffff; margin-top: 10px;"></div>
         </center>
         </div>
         <div class="col-lg-3 col-xs-0"></div>
      </div>
   </div>
   
   <div style="display:none;">
   <?php
   if($spotNumber == 0) print '<img src="photo_placeholders.jpg" id="photobg">';
   else
   {
      $imageLink = str_replace($HOMEPAGE_URL, "", $imageLink);
      print "<img src='{$imageLink}' id='photobg'>";
   }
   ?>
   </div>
   
   <form method='post' name='redirect' action='done.php'>
   <input type='hidden' name='s' value='1'>
   </form>

   <script src="assets/js/jquery.min.js" ></script>
   <script src="assets/js/popper.min.js"></script>
   <script src="assets/js/bootstrap.min.js"></script>
   <!-- MDB core JavaScript -->
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.1/js/mdb.min.js"></script>

   <script src="assets/js/marvinj-0.9.js"></script>

<script>

var imageOriginal = new MarvinImage();
var imageProcessed = new MarvinImage();
var imageBlending = new MarvinImage();
var imageDisplay = new MarvinImage();
var imageCropped = new MarvinImage();

var name;
var reader;
var form;
var photoUploaded = 0;

$('#fileUpload').change(function(event) {
	name = event.target.files[0].name;
	reader = new FileReader();
	reader.readAsDataURL(event.target.files[0]);

    $("#status").html("Processing... Please wait.");

	reader.onload = function() {
		imageOriginal.load(reader.result, imageLoaded);
	};
});

function imageLoaded()
{   
	var img = document.getElementById('photobg');
	var canvas2 = document.createElement('canvas');
	canvas2.width = img.width;
	canvas2.height = img.height;
	canvas2.getContext('2d').drawImage(img, 0, 0, img.width, img.height);

	imageDisplay.setDimension(img.width, img.height);

	var pix;

	for(var x = 0; x < img.width; x++)
	{
   		for(var y = 0; y < img.height; y++)
   		{
      		pix = canvas2.getContext('2d').getImageData(x, y, 1, 1).data;

      		imageDisplay.setIntColor(x, y, 255, pix[0], pix[1], pix[2]);
   		}
	}

	imageProcessed = imageOriginal.clone();

	processPhoto();
}

function repaint()
{
	canvas.getContext("2d").fillStyle = "#424242";
	canvas.getContext("2d").fillRect(0, 0, canvas.width, canvas.height);
	imageDisplay.draw(canvas);
	imageDisplay.update();
}

function processBlackAndWhite()
{
	Marvin.blackAndWhite(imageOriginal, imageDisplay, 2);
	repaint();
}

function processColorChannel()
{
    Marvin.colorChannel(imageOriginal, imageDisplay, 14, 0, -8);
	repaint();
}

function processReset()
{
	imageDisplay = imageOriginal.clone();
	repaint();
}

function processPhoto()
{
   imageBlending = imageOriginal.clone();

   for(var x = 0; x < imageOriginal.getWidth(); x++)
   {
      for(var y = 0; y < imageOriginal.getHeight(); y++)
      {
         <?php
         
         if($spotNumber == 0) print "imageBlending.setIntColor(x, y, 255, 255, 120, 120);";
         else if($spotNumber == 1) print "imageBlending.setIntColor(x, y, 255, 160, 120, 255);";
         else if($spotNumber == 2) print "imageBlending.setIntColor(x, y, 255, 120, 255, 166);";
         else if($spotNumber == 3) print "imageBlending.setIntColor(x, y, 255, 240, 255, 120);";
         
         ?>
      }
   }

   for(var x = 0; x < imageOriginal.getWidth(); x++)
   {
      for(var y = 0; y < imageOriginal.getHeight(); y++)
      {
         var A = imageOriginal.getIntComponent0(x, y);
         var B = imageBlending.getIntComponent0(x, y);
         A = A/255;
         B = B/255;
         var blendedRed = (B <= 0.5) ? ((1-2*B)*(A*A)+2*B*A) : ((2*B-1)*Math.sqrt(A)+2*(1-B)*A); // Correct SoftLight Red
         blendedRed = blendedRed*255;
         var arr = new Uint8Array([blendedRed]);
         blendedRed = arr[0];

         var A = imageOriginal.getIntComponent1(x, y);
         var B = imageBlending.getIntComponent1(x, y);
         A = A/255;
         B = B/255;
         var blendedGreen = (B <= 0.5) ? ((1-2*B)*(A*A)+2*B*A) : ((2*B-1)*Math.sqrt(A)+2*(1-B)*A); // Correct SoftLight Green
         blendedGreen = blendedGreen*255;
         var arr = new Uint8Array([blendedGreen]);
         blendedGreen = arr[0];

         var A = imageOriginal.getIntComponent2(x, y);
         var B = imageBlending.getIntComponent2(x, y);
         A = A/255;
         B = B/255;
         var blendedBlue = (B <= 0.5) ? ((1-2*B)*(A*A)+2*B*A) : ((2*B-1)*Math.sqrt(A)+2*(1-B)*A); // Correct SoftLight Blue
         blendedBlue = blendedBlue*255;
         var arr = new Uint8Array([blendedBlue]);
         blendedBlue = arr[0];

         // outputRed = (foregroundRed * foregroundAlpha) + (backgroundRed * (1.0 - foregroundAlpha));

         <?php
         
         if($spotNumber == 0)
         {
         ?>
         var outputRed = (255 * 0.60) + (blendedRed * (1.0 - 0.60));
         var outputGreen = (120 * 0.60) + (blendedGreen * (1.0 - 0.60));
         var outputBlue = (120 * 0.60) + (blendedBlue * (1.0 - 0.60));
         <?php
         }
         else if($spotNumber == 1)
         {
         ?>
         var outputRed = (160 * 0.60) + (blendedRed * (1.0 - 0.60));
         var outputGreen = (120 * 0.60) + (blendedGreen * (1.0 - 0.60));
         var outputBlue = (255 * 0.60) + (blendedBlue * (1.0 - 0.60));
         <?php
         }
         else if($spotNumber == 2)
         {
         ?>
         var outputRed = (120 * 0.60) + (blendedRed * (1.0 - 0.60));
         var outputGreen = (255 * 0.60) + (blendedGreen * (1.0 - 0.60));
         var outputBlue = (1660 * 0.60) + (blendedBlue * (1.0 - 0.60));
         <?php
         }
         else if($spotNumber == 3)
         {
         ?>
         var outputRed = (240 * 0.60) + (blendedRed * (1.0 - 0.60));
         var outputGreen = (255 * 0.60) + (blendedGreen * (1.0 - 0.60));
         var outputBlue = (120 * 0.60) + (blendedBlue * (1.0 - 0.60));
         <?php
         }
         ?>

         imageProcessed.setIntColor4(x, y, 255, outputRed, outputGreen, outputBlue);
      }
   }

   var cropX = 0;
   var cropY = 0;
   var newWidth = 0;
   var newHeight = 0;

   if(imageOriginal.getWidth() < imageOriginal.getHeight())
   {
      newWidth = imageOriginal.getWidth();
      newHeight = imageOriginal.getWidth(); // square image
      cropX = 0;
      cropY = Math.floor((imageOriginal.getHeight()-newHeight)/2);
   }
   else
   {
      newWidth = imageOriginal.getHeight();
      newHeight = imageOriginal.getHeight(); // square image
      cropX = Math.floor((imageOriginal.getWidth()-newWidth)/2);
      cropY = 0;
   }

   imageCropped = imageProcessed.clone();
   Marvin.crop(imageProcessed, imageCropped, cropX, cropY, newWidth, newHeight);
   newWidth = newWidth/2;
   newHeight = newHeight/2;
   if(newWidth < 530/2) newWidth = 530/2;
   if(newHeight < 530/2) newHeight = 530/2;
   Marvin.scale(imageCropped, imageProcessed, newWidth, newHeight);

   <?php
   
   if($spotNumber == 0)
   {
      print "var xDest = 0;"."\n";
      print "var yDest = 0;"."\n";
   }

   if($spotNumber == 1)
   {
      print "var xDest = 265;"."\n";
      print "var yDest = 0;"."\n";
   }

   if($spotNumber == 2)
   {
      print "var xDest = 0;"."\n";
      print "var yDest = 265;"."\n";
   }

   if($spotNumber == 3)
   {
      print "var xDest = 265;"."\n";
      print "var yDest = 265;"."\n";
   }

   ?>

   for(var x = 0; x < imageProcessed.getWidth(); x++)
   {
      for(var y = 0; y < imageProcessed.getHeight(); y++)
      {
         var R = imageProcessed.getIntComponent0(x, y);
         var G = imageProcessed.getIntComponent1(x, y);
         var B = imageProcessed.getIntComponent2(x, y);

         imageDisplay.setIntColor4(xDest+x, yDest+y, 255, R, G, B);
      }
   }

   photoUploaded = 1;

   $("#status").html("Photo uploaded. Now publish it!");

   repaint();
}

function publishPhoto()
{
    if(photoUploaded == 0)
    {
       $("#status").html("Your photo is not uploaded yet.");
       return false;
    }
    
	form = new FormData();
	form.append("sid", "<?php print $socialID; ?>");
	form.append("uid", "<?php print $userID; ?>");
	form.append("blob", canvas.toDataURL());
	$("#status").html("Sending to server...");
	$.ajax({
		method: 'POST',
		url: 'image_upload.php',
		data: form,
		enctype: 'multipart/form-data',
		contentType: false,
		processData: false,
		cache: false,
	   
		success: function (resp) {
		   // console.log(resp);
		   // $("#status").html("Done!");
           document.redirect.submit();
		},
		error: function (data) {
			alert("error");
			$("#status").html(data);
		},
		
	});
};

</script>
</body>
</html>

<?php

function errorExit($errStr)
{
   print "<big>Error!</big><br>&nbsp;<br>";
   print $errStr;
   exit;
}

?>

