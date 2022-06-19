<?php include 'head.php'; ?>
<?php include 'side.php';

if ($uyecek['yetki'] == 1) {
  $uye = $uyecek['id'];
  $getparfum = $db->prepare("SELECT * FROM parfumler WHERE uye=$uye");
  $getparfum->execute(array());
}else{
  $getparfum = $db->prepare("SELECT * FROM parfumler");
  $getparfum->execute(array());
}


?>

<div class="row p-4">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Responsive Hover Table</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <a class="btn btn-success" href="parfum-ekle.php">Yeni Ekle <i class="fa fa-plus"></i> </a>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>Fotoğraf</th>
              <th>Adı</th>
              <th>Kategorisi</th>
              <th>Ekleyen Üye</th>
              <th>Fiyat</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($getparfum as $parfum):
              $kategori_id = $parfum['kategorisi'];
              $uye_id = $parfum['uye'];
              $kategori = $db->prepare("SELECT * FROM kategoriler WHERE id=$kategori_id");
              $kategori->execute(array());
              $kategoricek = $kategori->fetch(PDO::FETCH_ASSOC);

              $uye = $db->prepare("SELECT * FROM uyeler WHERE id=$uye_id");
              $uye->execute(array());
              $uyecek = $uye->fetch(PDO::FETCH_ASSOC);
              ?>
              <tr>
                <td><?php echo $parfum['id']?></td>
                <td><img src="../<?php echo $parfum['fotograf'] ?>" width="50" alt="parfum"></td>
                <td><?php echo $parfum['adi']?></td>
                <td><?php echo $kategoricek['adi']?></td>
                <td><?php echo $uyecek['isim']?></td>
                <td><?php echo $parfum['fiyati']?></td>
                <td>
                  <a class="btn btn-info" href="parfum-duzenle.php?id=<?php echo $parfum['id']?>">Düzenle</a>
                  <a class="btn btn-danger" href="../system.php?parfumsil=ok&id=<?php echo $parfum['id']?>">Sil</a>
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
