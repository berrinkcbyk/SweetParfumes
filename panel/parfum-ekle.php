<?php include 'head.php'; ?>
<?php include 'side.php';
$getkategori=$db->prepare("SELECT * FROM kategoriler");
$getkategori->execute(array());
?>
<div class="card card-warning">
  <div class="card-header">
    <h3 class="card-title">Parfüm Ekle</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <form action="../system.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="uye" value="<?=$uyecek['id']?>">
      <div class="row">
        <div class="col-sm-12">
          <!-- text input -->
          <div class="form-group">
            <label>Parfüm fotoğfarı</label>
            <input type="file" class="form-control" name="fotograf">
          </div>
        </div>
        <div class="col-sm-12">
          <!-- text input -->
          <div class="form-group">
            <label>Parfüm Adı</label>
            <input type="text" class="form-control" placeholder="Adı" name="adi">
          </div>
        </div>
        <div class="col-sm-12">
          <!-- text input -->
          <div class="form-group">
            <label>Parfüm Açıklaması</label>
            <textarea class="form-control" rows="3" placeholder="Açıklama" name="aciklama"></textarea>
          </div>
        </div>
        <div class="col-sm-12">
          <!-- text input -->
          <div class="form-group">
            <label>Parfüm Kategorisi</label>
            <select class="form-control" name="kategori">
              <?php foreach ($getkategori as $kategori) {?>
                <option value="<?php echo $kategori['id'] ?>"><?php echo $kategori['adi'] ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-sm-12">
          <!-- textarea -->
          <div class="form-group">
            <label>Parfüm Notaları</label>
            <textarea id="summernote" name="notalari"></textarea>
          </div>
        </div>
        <div class="col-sm-12">
          <!-- text input -->
          <div class="form-group">
            <label>Parfüm Fiyatı</label>
            <input type="text" class="form-control" placeholder="Fiyatı" name="fiyati">
          </div>
        </div>
        <div class="col-sm-12">
          <!-- textarea -->
          <div class="form-group text-right">
            <a href="parfum-listele.php" class="btn btn-warning"> <i class="fa fa-arrow-left"></i> Geri Dön</a>
            <button type="submit" class="btn btn-success" name="parfumekle"><i class="fa fa-plus"></i> Ekle</button>
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- /.card-body -->
</div>
<?php include 'foot.php'; ?>
