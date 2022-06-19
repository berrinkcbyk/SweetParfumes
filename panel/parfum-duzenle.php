<?php include 'head.php'; ?>
<?php include 'side.php';

$getparfum = $db->prepare("SELECT * FROM parfumler WHERE id=:id");
$getparfum->execute(array('id' => $_GET['id']));
$getitem = $getparfum->fetch(PDO::FETCH_ASSOC);

$getkategori=$db->prepare("SELECT * FROM kategoriler");
$getkategori->execute(array());

?>
<div class="card card-warning">
  <div class="card-header">
    <h3 class="card-title">Parfüm Düzenle</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <form action="../system.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="uye" value="<?=$uyecek['id']?>">
      <input type="hidden" name="id" value="<?=$getitem['id']?>">
      <div class="row">
        <div class="col-sm-12">
          <!-- text input -->
          <div class="form-group">
            <img src="../<?=$getitem['fotograf']?>" width="400" alt=""><br>
            <label>Parfüm fotoğfarı</label>
            <input type="file" class="form-control" name="fotograf">
          </div>
        </div>
        <div class="col-sm-12">
          <!-- text input -->
          <div class="form-group">
            <label>Parfüm Adı</label>
            <input type="text" class="form-control" placeholder="Adı" name="adi" value="<?=$getitem['adi']?>">
          </div>
        </div>
        <div class="col-sm-12">
          <!-- text input -->
          <div class="form-group">
            <label>Parfüm Açıklaması</label>
            <textarea class="form-control" rows="3" placeholder="Açıklama" name="aciklama"><?=$getitem['aciklama']?></textarea>
          </div>
        </div>
        <div class="col-sm-12">
          <!-- text input -->
          <div class="form-group">
            <label>Parfüm Kategorisi</label>
            <select class="form-control" name="kategorisi">
              <?php foreach ($getkategori as $kategori) {?>
                <option value="<?php echo $kategori['id'] ?>" <?php echo ($getitem['kategorisi']==$kategori['id']) ? 'selected' : '' ?> ><?php echo $kategori['adi'] ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-sm-12">
          <!-- textarea -->
          <div class="form-group">
            <label>Parfüm Notaları</label>
            <textarea id="summernote" name="notalari"><?=$getitem['notalari']?></textarea>
          </div>
        </div>
        <div class="col-sm-12">
          <!-- text input -->
          <div class="form-group">
            <label>Parfüm Fiyatı</label>
            <input type="text" class="form-control" placeholder="Fiyatı" name="fiyati" value="<?=$getitem['fiyati']?>">
          </div>
        </div>
        <div class="col-sm-12">
          <!-- textarea -->
          <div class="form-group text-right">
            <a href="parfum-listele.php" class="btn btn-warning"> <i class="fa fa-arrow-left"></i> Geri Dön</a>
            <button type="submit" class="btn btn-success" name="parfumduzenle"><i class="fa fa-plus"></i> Düzenle</button>
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- /.card-body -->
</div>
<?php include 'foot.php'; ?>
