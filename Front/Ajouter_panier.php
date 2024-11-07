<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: ../connexion.php");

}
$id_client=$_SESSION['user']['id'];
$id_produit=$_POST['id'];
$Qauntie=$_POST['qty']
;

    if(!isset($_SESSION['Panier'][$id_client])){
        $_SESSION['Panier'][$id_client]=[];
    }
    if($Qauntie == 0){
  unset( $_SESSION['Panier'][$id_client][$id_produit]);
    }else{
        $_SESSION['Panier'][$id_client][$id_produit]=$Qauntie;
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);


?>