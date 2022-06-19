<?php include 'head.php'; ?>
<?php include 'side.php'; ?>
<div class="card card-warning">
  <div class="card-header">
    <h3 class="card-title">Kategori Ekle</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <form action="../system.php" method="POST">
      <div class="row">
        <div class="col-sm-12">
          <!-- text input -->
          <div class="form-group">
            <label>Kategori Adı</label>
            <input type="text" class="form-control" name="adi" placeholder="Adı">
          </div>
        </div>
        <div class="col-sm-12">
          <!-- textarea -->
          <div class="form-group text-right">
            <a href="kategori-listele.php" class="btn btn-warning"> <i class="fa fa-arrow-left"></i> Geri Dön</a>
            <button type="submit" class="btn btn-success" name="kategoriekle"><i class="fa fa-plus"></i> Ekle</button>
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- /.card-body -->
</div>
<?php include 'foot.php'; ?>
