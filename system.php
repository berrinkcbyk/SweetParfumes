<?php
ob_start();
session_start();
include 'connection.php';


//Kullanıcı giriş işlemi
if (isset($_POST['login'])) {

  $kullanici_ad=$_POST['kullanici_ad'];
  $kullanici_sifre=$_POST['kullanici_sifre'];

  if ($kullanici_ad && $kullanici_sifre) {

    $kullanicisor=$db->prepare("SELECT * FROM uyeler where kullaniciadi=:ad and sifre=:sifre");
    $kullanicisor->execute(array(
      'ad' => $kullanici_ad,
      'sifre' => $kullanici_sifre
    ));

    echo $say=$kullanicisor->rowCount();

    if ($say>0) {
      $_SESSION['kullaniciadi'] = $kullanici_ad;
      header('Location:index.php');
    } else {
      header('Location:login.php?giris=basarisiz');

    }
  }
}

//Kullanıcı kayıt işlemi
if (isset($_POST['kullanici-kayit'])) {

  $kullanicikaydet = $db->prepare("INSERT INTO uyeler SET
    kullaniciadi=:ad,
    sifre=:sifre,
    isim=:isim
    ");
    $insert = $kullanicikaydet->execute(array(
      'ad' => $_POST['kullaniciadi'],
      'sifre' => $_POST['sifre'],
      'isim' => $_POST['isim']
    ));

    if ($insert) {
      Header("Location:login.php?kayit=ok");
    } else {
      Header("Location:sign-in.php?durum=no");
    }
  }

  //kullanici çıkış yapma
  if (!empty($_GET['logout']=='userok')) {

    $cikis = session_destroy();

    if($cikis){
      header("Location:login.php?cikis=ok");
    }else{
      header("Location:index.php?cikis=no");
    }
  }

  //parfumekle
  if (isset($_POST['parfumekle'])) {

    $uploads_dir = 'assets/img/parfumes/';

    $random = Rand(1000, 9999);
    @$tmp_name = $_FILES['fotograf']["tmp_name"];
    @$name = $_FILES['fotograf']["name"];

    $refimgyol = 'assets/img/parfumes/' . $random . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$random$name");

    $parfumkaydet = $db->prepare("INSERT INTO parfumler SET
      adi=:adi,
      aciklama=:aciklama,
      kategorisi=:kategori,
      notalari=:notalari,
      fiyati=:fiyati,
      uye=:uye,
      fotograf=:foto
      ");
      $insert = $parfumkaydet->execute(array(
        'adi' => $_POST['adi'],
        'aciklama' => $_POST['aciklama'],
        'kategori' => $_POST['kategori'],
        'notalari' => $_POST['notalari'],
        'fiyati' => $_POST['fiyati'],
        'uye' => $_POST['uye'],
        'foto' => $refimgyol
      ));

      if ($insert) {
        Header("Location:panel/parfum-listele.php?kayit=ok");
      } else {
        Header("Location:panel/parfum-listele.php?durum=no");
      }
    }

    //parfum düzenleme
    if (isset($_POST['parfumduzenle'])) {

      $parfumsor=$db->prepare("SELECT * FROM parfumler where id=:id");
      $parfumsor->execute(array("id" => $_POST['id']));
      $parfumcek=$parfumsor->fetch(PDO::FETCH_ASSOC);

      if ($_FILES['fotograf']['size'] != 0) {

        unlink('../' . $parfumcek['fotograf']);

        $uploads_dir = 'assets/img/parfumes/';
        $random = Rand(1000,9999);
        @$tmp_name = $_FILES['fotograf']["tmp_name"];
        @$name = $_FILES['fotograf']["name"];
        $refimgyol = $uploads_dir.$random.$name;
        @move_uploaded_file($tmp_name, "$uploads_dir/$random$name");
      }else {
        $refimgyol = $parfumcek['fotograf'];
      }

      $parfumduzenle=$db->prepare("UPDATE parfumler SET
        adi=:adi,
        aciklama=:aciklama,
        kategorisi=:kategorisi,
        fiyati=:fiyati,
        notalari=:notalari,
        uye=:uye,
        fotograf=:foto
        WHERE id={$_POST['id']}
        ");
        $update=$parfumduzenle->execute(array(
          'adi' => $_POST['adi'],
          'aciklama' => $_POST['aciklama'],
          'kategorisi' => $_POST['kategorisi'],
          'fiyati' => $_POST['fiyati'],
          'notalari' => $_POST['notalari'],
          'uye' => $_POST['uye'],
          'foto' => $refimgyol
        ));

        if ($update) {
          Header("Location:panel/parfum-listele.php?durum=ok");
        }
        else{
          Header("Location:panel/parfum-listele.php?durum=no");
        }
      }

      //parfum silme işlemi
      if(!empty($_GET['parfumsil'])=="ok") {

        $select = $db->prepare("SELECT * FROM parfumler where id=:id");
        $select->execute(array('id' => $_GET['id']));
        $bul = $select->fetch(PDO::FETCH_ASSOC);

        unlink($bul['fotograf']);

        $sil=$db->prepare("DELETE FROM parfumler WHERE id=:id");
        $kontrol=$sil->execute(array('id' => $_GET['id']));

        if ($kontrol) {
          header("Location:panel/parfum-listele.php?durum=ok");

        } else{
          header("Location:panel/parfum-listele.php?durum=no");
        }
      }

      //parfum düzenleme
      if (isset($_POST['kategoriduzenle'])) {

        $kategorisor=$db->prepare("SELECT * FROM kategoriler where id=:id");
        $kategorisor->execute(array("id" => $_POST['id']));
        $kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC);

        $kategoriduzenle=$db->prepare("UPDATE kategoriler SET
          adi=:adi
          WHERE id={$_POST['id']}
          ");
          $update=$kategoriduzenle->execute(array(
            'adi' => $_POST['adi']
          ));

          if ($update) {
            Header("Location:panel/kategori-listele.php?durum=ok");
          }
          else{
            Header("Location:panel/kategori-listele.php?durum=no");
          }
        }

        //kategori Ekle
        if (isset($_POST['kategoriekle'])) {
          $ekle = $db->prepare("INSERT INTO kategoriler SET
            adi=:adi
            ");
            $insert = $ekle->execute(array(
              'adi' => $_POST['adi']
            ));

            if ($insert) {
              header("Location:panel/kategori-listele.php?durum=ok");
            }else{
              header("Location:panel/kategori-listele.php?durum=no");
            }
          }

          //kategori silme işlemi
          if(!empty($_GET['kategorisil'])=="ok") {

            $sil=$db->prepare("DELETE FROM kategoriler WHERE id=:id");
            $kontrol=$sil->execute(array('id' => $_GET['id']));

            if ($kontrol) {
              header("Location:panel/kategori-listele.php?durum=ok");

            } else{
              header("Location:panel/kategori-listele.php?durum=no");
            }
          }

          /***Admin işlemleri****/
          //admin giriş işlemi
          if (isset($_POST['adminlogin'])) {

            $kullanici_ad=$_POST['kullanici_ad'];
            $kullanici_sifre=$_POST['kullanici_sifre'];

            if ($kullanici_ad && $kullanici_sifre) {

              $kullanicisor=$db->prepare("SELECT * FROM uyeler where kullaniciadi=:ad and sifre=:sifre");
              $kullanicisor->execute(array(
                'ad' => $kullanici_ad,
                'sifre' => $kullanici_sifre
              ));

              echo $say=$kullanicisor->rowCount();

              if ($say>0) {
                $_SESSION['kullaniciadi'] = $kullanici_ad;
                header('Location:panel/index.php');
              } else {
                header('Location:panel/login.php?giris=basarisiz');

              }
            }
          }

          //admin çıkış yapma
          if (!empty($_GET['logout']=='ok')) {

            $cikis = session_destroy();

            if($cikis){
              header("Location:panel/login.php?cikis=ok");
            }else{
              header("Location:panel/index.php?cikis=no");
            }
          }


          ?>
