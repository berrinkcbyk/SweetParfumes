<?php

ob_start();
session_start();
include 'connection.php';
include 'function.php';

$uyeler =$db->prepare("SELECT * FROM uyeler WHERE kullaniciadi=:ad");
$uyeler->execute(array(
  'ad' => $_SESSION['kullaniciadi']
));
$uye=$uyeler->fetch(PDO::FETCH_ASSOC);

if (!isset($_SESSION['kullaniciadi'])) {

  header('location:login.php?yetki=yetkisiz');

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>SweetParfume</title>
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
      <a class="navbar-brand" href="index.php">SweetParfume</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ms-auto py-4 py-lg-0">
          <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="uyeler.php?id=<?=$uye['id']?>"> Profilim <i class="fa fa-user"></i></a></li>
          <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="panel/login.php"> Panele Giriş Yap <i class="fa fa-sign-in"></i></a></li>
          <?php if (!empty($uye['kullaniciadi'])) {?>
            <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="system.php?logout=userok"> Çıkış Yap <i class="fa fa-arrow-right"></i></a></li>
          <?php  }?>
        </div>
      </div>
    </nav>
