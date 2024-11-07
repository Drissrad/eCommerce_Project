<?php

require_once 'include/DB.php';
$id=$_GET['id'];
$Categ = $pdo->prepare('DELETE FROM pro Where id=?');
$Categ->execute([$id]);
 header("Location: Listspro.php");
?>