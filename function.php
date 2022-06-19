<?php
//kategori adını göstermek için fonksiyon
function get_kategoriname($id){
  include 'connection.php';
  $getkategori = $db->prepare("SELECT * FROM kategoriler WHERE id=:id");
  $getkategori->execute(array('id' => $id));
  $kategori = $getkategori->fetch(PDO::FETCH_ASSOC);

  echo $kategori['adi'];
}

?>
