<?php include 'head.php';

if (!empty($_GET['kategori'])) {
  $id = (int) $_GET['kategori'];
  $getparfum = $db->prepare("SELECT * FROM parfumler WHERE kategorisi=$id");
  $getparfum->execute(array());
}else{
  $getparfum = $db->prepare("SELECT * FROM parfumler");
  $getparfum->execute(array());
}


$kategoriler = $db->prepare("SELECT * FROM kategoriler");
$kategoriler->execute(array());
?>
<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/kapak.jpg')">
  <div class="container position-relative px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-7">
        <div class="site-heading">
          <h1>Sweet Parfume</h1>
          <span class="subheading">Parfüm Yorumları ve Nota Tespitleri Blogu</span>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- Main Content-->
<div class="container">
  <div class="row">
    <div class="col-md-2">
      <ul class="list-group">
        <h5 class="text-muted">KATEGORİLER</h5>
        <li class="list-group-item text-muted"><i class="fa fa-arrow-right"></i> <a href="index.php">Tüm Kategoriler</a></li>
        <?php foreach ($kategoriler as $kategori): ?>
          <li class="list-group-item text-muted"><i class="fa fa-arrow-right"></i> <a href="index.php?kategori=<?=$kategori['id']?>"><?=$kategori['adi']?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <!-- Post preview-->
    <?php
    foreach ($getparfum as $parfum) {
      $id = $parfum['uye'];
      $uye = $db->prepare("SELECT * FROM uyeler WHERE id=$id");
      $uye->execute(array());
      $uyeadi = $uye->fetch(PDO::FETCH_OBJ);
      ?>
      <div class="col-md-3 col-3 col-xl-3">
        <div class="post-img">
          <img src="<?php echo $parfum['fotograf'];?>" width="300" alt="">
        </div>
        <div class="post-preview">
          <a href="detail.php?id=<?php echo $parfum['id']?>">
            <h2 class="post-title"><?php echo $parfum['adi']; ?></h2>
            <h6 class="post-subtitle"><?php echo $parfum['aciklama']; ?></h6>
          </a>
          <small><?php get_kategoriname($parfum['kategorisi']) ?></small>
          <p class="post-meta">
            Ekleyen
            <a href="uyeler.php?id=<?=$uyeadi->id?>"><?php echo $uyeadi->isim; ?></a>
          </p>
        </div>
        <!-- Divider-->
        <hr class="my-4" />
      </div>
    <?php } ?>
    <!-- Pager-->
    <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Diğer Parfümler →</a></div>
  </div>
</div>
<?php include 'foot.php' ?>
