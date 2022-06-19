<?php
//admin çıkış yapma
  $cikis = session_destroy();

  if($cikis){
    header("Location:login.php?cikis=ok");
  }else{
    header("Location:index.php?cikis=no");
  }

 ?>
