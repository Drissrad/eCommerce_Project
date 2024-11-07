<?php 
 require_once 'include/DB.php';
$id_commande=$_GET['id'];
$etat=$_GET['etat'];
$sql=$pdo->prepare('UPDATE  commande SET valid=? where id=?');
$sql->execute([$etat,$id_commande]); 
header("Location: Com_Detail.php?id=". $id_commande );
?>