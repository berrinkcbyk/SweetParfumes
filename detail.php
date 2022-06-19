<?php include 'head.php';

$parfumler = $db->prepare("SELECT * FROM parfumler WHERE id=:id");
$parfumler->execute(array('id' => $_GET['id']));
$parfum=$parfumler->fetch(PDO::FETCH_ASSOC);

$id = $parfum['uye'];
$parfumuye = $db->prepare("SELECT * FROM uyeler WHERE id=$id");
$parfumuye->execute(array());
$uyeadi = $parfumuye->fetch(PDO::FETCH_OBJ);

?>
<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/kapak.jpg')">
  <div class="container position-relative px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-7">
        <div class="post-heading">
          <h1><?php echo $parfum['adi']?></h1>
          <span class="meta">
            Ekleyen
            <a href="uyeler.php?id=<?=$uyeadi->isim?>"><?php echo $uyeadi->isim?></a>
          </span>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- Post Content-->
<article class="mb-4">
  <div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-7">
        <img src="<?php echo $parfum['fotograf']?>" alt="parfum" class="w-50">
        <h2 class="section-heading"><?php echo $parfum['adi']?></h2>
        <small class="text-muted"><?php echo $parfum['fiyati'] ?>₺</small>
        <p><?php echo $parfum['aciklama']?></p>
        <p><?php echo $parfum['notalari']?></p>
        <p>
          Yorumcu
          <a href="uyeler.php?id=<?php echo $uyeadi->id?>"><?php echo $uyeadi->isim ?></a>
        </p>
      </div>
    </div>
  </div>
</article>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h4>Kullanıcı Yorumları</h4><hr>
      <div class="yorumlar">
        <?php
        $yorumlar = $db->prepare("SELECT * FROM yorumlar WHERE parfum_id =:id");
        $yorumlar->execute(array('id' => $_GET['id']));
         foreach ($yorumlar as $yorum):
           $id = $yorum['uye_id'];
           $yorumuye = $db->prepare("SELECT * FROM uyeler WHERE id=$id");
           $yorumuye->execute(array());
           $uyeyorum = $yorumuye->fetch(PDO::FETCH_ASSOC);
           ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo $yorum['baslik'] ?></h5>
              <p class="card-text"><?php echo $yorum['yorum'] ?></p>
              <div class="m-2">
                <i class="fa fa-user text-primary"></i> <a href="uyeler.php?id=<?php echo $uyeyorum['id']?>" class="card-link text-primary"><?php echo $uyeyorum['isim'] ?></a>
              </div>
              <span class="card-link">Eklendiği Tarih : <?php echo $yorum['tarih'] ?></span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <hr>
      <h4 class="mt-3">Yorum Ekle</h4>

      <?php
      if (isset($_POST['yorumyap'])) {

        $yorumekle = $db->prepare("INSERT INTO yorumlar SET
          parfum_id=:parfum_id,
          uye_id=:uye_id,
          baslik=:baslik,
          yorum=:yorum,
          tarih=:tarih
          ");
          $insert = $yorumekle->execute(array(
            'parfum_id' => $_GET['id'],
            'uye_id' => $_POST['uye_id'],
            'baslik' => $_POST['baslik'],
            'yorum' => $_POST['yorum'],
            'tarih' => date('Y-m-d H:i:s')
          ));

          if ($insert) {
            Header("Location:detail.php?id=".$_GET['id']);
          } else {
            Header("Location:detail.php?id=".$_GET['id']);
          }
        }
        ?>
        <form class="form mb-3" action="" method="POST">
          <input type="hidden" name="uye_id" value="<?=$uye['id']?>">
          <div class="mb-3">
            <label class="form-label">Başlık</label>
            <input type="text" name="baslik" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Yorum</label>
            <div class="form-floating">
              <textarea class="form-control" name="yorum" required></textarea>
            </div>
          </div>
          <button type="submit" name="yorumyap" class="btn btn-primary">Yorum Yap</button>
        </form>
      </div>
    </div>
  </div>
  <?php include 'foot.php'; ?>
