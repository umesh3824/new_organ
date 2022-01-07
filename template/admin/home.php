<?php
//Include required PHPMailer files
require '../../php/phpmail/includes/PHPMailer.php';
require '../../php/phpmail/includes/SMTP.php';
require '../../php/phpmail/includes/Exception.php';
require '../../php/phpmail/send_mail.php';

include "../../php/includes/config.php";
include "../../php/includes/DBController.php";
include "../../php/doctor.php";
include "../../php/donar.php";
include "../../php/recipient.php";
include "../../php/organ.php";
include "../../php/admin.php";
include "../../php/donar_appointment.php";
include "../../php/recipient_appointment.php";
include "../../php/organ_transaction.php";

$DBObj=new DBController($con);
$doctorObj=new Doctor($DBObj);
$donarObj=new Donar($DBObj);
$recipientObj=new Recipient($DBObj);
$oragnObj=new Organ($DBObj);
$adminObj=new Admin($DBObj);
$DAppointmentObj=new DAppointment($DBObj);
$RAppointmentObj=new RAppointment($DBObj);
$organTransactionObj=new OrganTransaction($DBObj);

if(!isset($_SESSION['userid'])){
  header("location:../../");
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="../../assets/css/style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
  <title>Organ Donation Center</title>
</head>

<body class="bg-light">
  <div class="container">
    <div class="shadow mt-5 border card">
      <div class="text-dark d-flex justify-content-around p-2">
        <span class="badge bg-text">Name: <?php echo $_SESSION['name']; ?></span>
        <span class="badge bg-text">Email: <?php echo $_SESSION['email']; ?></span>
        <span class="badge bg-text">Contact No: <?php echo $_SESSION['contactno']; ?></span>
      </div>
      <nav class="bg-success tab-bar">
        <a href="home.php" class="tab">Dashboard</a>
        <a href="?pageflag=adonarlist" class="tab">Donar</a>
        <a href="?pageflag=arecipientlist" class="tab">Recipient</a>
        <a href="?pageflag=doctorlist" class="tab">Doctors</a>
        <a href="?pageflag=transactions" class="tab">Transactions</a>
        <a href="?pageflag=organcheckavailibility" class="tab">Check Availability</a>
        <a href="../logout.php" class="tab">Logout</a>
      </nav>
      <?php
          if (isset($_GET['pageflag'])) {
            $pageflag = $_GET['pageflag'];
          } else {
            $pageflag = "adashboard";
          }
          switch ($pageflag) {
            case "adashboard":
              include "dashboard.php";
              break;
            case "adonarlist":
              include "donar_list.php";
              break;
            case "adddonar":
              include "donar_add.php";
              break;
            case "updatedonar":
              include "donar_update.php";
              break;
            case "arecipientlist":
              include "recipient_list.php";
              break;
            case "addrecipient":
              include "recipient_add.php";
              break;
            case "updaterecipient":
              include "recipient_update.php";
              break;
            case "doctorlist":
              include "doctor_list.php";
              break;
            case "adddoctor":
              include "doctor_add.php";
              break;
            case "updatedoctor":
              include "doctor_update.php";
              break;
            case "transactions":
              include "transactions.php";
              break;
             case "organcheckavailibility":
              include "../organ_check_availibility.php";
              break;
            default:
              echo "<h class='text-center text-danger'> Invalid URL</h1>";
          }
      ?>
      <p class="bg-light m-0 border-bottom border-success p-2 text-center">Contact No:- 8855223366 | E-Mail:- admin@gmail.com</p>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>