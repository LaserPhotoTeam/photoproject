<?php

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
         <div class="col-lg-6 col-xs-12 col-sm-12 col-md-12" style="height:100vh; background-color:#4d4d4d;color:#ffffff;">
         <br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
         <center>
            <h1><b>Well Done!</b></h1>
            <br>
            <h4><b>Your photo is successfully published.</b></h4>
            <br>
            <h4>You can now offer your friends to join you on this new collage art-work with their selfies.</h4>
         </center>
         </div>
         <div class="col-lg-3 col-xs-0"></div>
      </div>
   </div>
   
   <script src="assets/js/jquery.min.js" ></script>
   <script src="assets/js/popper.min.js"></script>
   <script src="assets/js/bootstrap.min.js"></script>
   <!-- MDB core JavaScript -->
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.1/js/mdb.min.js"></script>

</body>
</html>

