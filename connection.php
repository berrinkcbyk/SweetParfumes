<?php

try {
	$db=new PDO("mysql:host=localhost;dbname=sweetparfum",'root','');
	$db->exec("set names utf8");
} catch(PDOException $e){
	echo $e->getMessage();
}

?>
