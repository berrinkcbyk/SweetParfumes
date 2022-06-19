<?php include 'head.php'; ?>
<?php include 'side.php';

$getkategori = $db->prepare("SELECT * FROM kategoriler");
$getkategori->execute(array());

?>

<div class="row p-4">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Responsive Hover Table</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <a class="btn btn-success" href="kategori-ekle.php">Yeni Ekle <i class="fa fa-plus"></i> </a>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>Adı</th>
              <th>İşlemler</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($getkategori as $kategori): ?>
              <tr>
                <td><?php echo $kategori['id']?></td>
                <td><?php echo $kategori['adi']?></td>
                <td>
                  <a class="btn btn-info" href="kategori-duzenle.php?id=<?php echo $kategori['id']?>">Düzenle</a>
                  <a class="btn btn-danger" href="../system.php?kategorisil=ok&id=<?php echo $kategori['id']?>">Sil</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
<?php include 'foot.php'; ?>
