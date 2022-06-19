<?php include 'head.php';

$uyegetir = $db->prepare("SELECT * FROM uyeler WHERE id= :id");
$uyegetir->execute(array('id' => $_GET['id']));
$uye = $uyegetir->fetch(PDO::FETCH_ASSOC);

$id = $uye['id'];
$parfumler = $db->prepare("SELECT * FROM parfumler WHERE uye=$id");
$parfumler->execute(array());
?>
<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/kapak.jpg')">
  <div class="container position-relative px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-7">
        <div class="site-heading">
          <h1><?=$uye['isim']?></h1>
          <span class="subheading"><?=$uye['aciklama']?></span>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- Main Content-->
<div class="container">
  <h2 class="post-title text-primary"><?php echo $uye['isim']; ?></h2>
  <h6 class="post-subtitle text-muted">Kullanıcısına ait eklenmiş parümler</h6>
  <hr>
  <div class="row">
    <?php foreach ($parfumler as $parfum): ?>
      <div class="col-md-4 col-4 col-xl-4">
        <div class="post-img">
          <img src="<?php echo $parfum['fotograf'];?>" width="300" alt="">
        </div>
        <div class="post-preview">
          <a href="detail.php?id=<?php echo $parfum['id']?>">
            <h2 class="post-title"><?php echo $parfum['adi']; ?></h2>
            <h6 class="post-subtitle"><?php echo $parfum['aciklama']?></h6>
          </a>
          <small><?php get_kategoriname($parfum['kategorisi']) ?></small>
        </div>
        <!-- Divider-->
        <hr class="my-4" />
      </div>
    <?php endforeach; ?>
  </div>

</div>
<?php include 'foot.php' ?>
