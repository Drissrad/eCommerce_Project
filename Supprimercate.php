<?php 
   require_once 'include/DB.php';
   $id=$_GET['id'];
   $Categ = $pdo->prepare('DELETE FROM CATEG Where ID=?');
   $supprimer=$Categ->execute([$id]);
    header("Location: Lists.php");
  
?>