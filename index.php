<?php
include "php/includes/config.php";
include "php/includes/DBController.php";
include "php/doctor.php";
include "php/donar.php";
include "php/recipient.php";
include "php/organ.php";
include "php/admin.php";

$DBObj=new DBController($con);
$doctorObj=new Doctor($DBObj);
$donarObj=new Donar($DBObj);
$recipientObj=new Recipient($DBObj);
$oragnObj=new Organ($DBObj);
$adminObj=new Admin($DBObj);
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css//all.css">
  <title>Organ Donation Center</title>
</head>

<body class="bg-light">
  <div class="container">
    <div class="shadow mt-5 border card">
      <nav class="bg-success tab-bar">
        <a href="index.php" class="tab">Home</a>
        <a href="?pageflag=donarapplication" class="tab">Donar</a>
        <a href="?pageflag=recipientapplication" class="tab">Recipient</a>
        <a href="?pageflag=organcheckavailibility" class="tab">Check Availability</a>
        <a href="?pageflag=admin" class="tab">Admin</a>
        <div class="dropdown show">
      </nav>
      <?php
          if (isset($_GET['pageflag'])) {
            $pageflag = $_GET['pageflag'];
          } else {
            $pageflag = "index";
          }
          switch ($pageflag) {
            case "index":
              include "template/index.php";
              break;
            case "donarapplication":
              include "template/donar_application.php";
              break;
            case "recipientapplication":
              include "template/recipient_application.php";
              break;
            case "organcheckavailibility":
              include "template/organ_check_availibility.php";
              break;
             case "admin":
              include "template/admin_login.php";
              break;
            default:
              echo "<h1 class='text-center text-danger'> Invalid URL</h1>";
          }
      ?>
      <p class="bg-light m-0 border-bottom border-success p-2 text-center">Contact No:- 1000000000 | E-Mail:- admin@gmail.com</p>
    </div>
  </div>
  <script src="assets/js/popper.min.js" ></script>
  <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>