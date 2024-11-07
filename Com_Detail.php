<?php 
$id_commande=$_GET['id'];
    include 'include/nav.php';
    require_once 'include/DB.php';
$sqlstate = $pdo->prepare("
    SELECT commande.*, client.login AS login
    FROM commande
    INNER JOIN client ON client.id = commande.idclient 
    where commande.id=?
    ORDER BY commande.date
");
$sqlstate ->execute([$id_commande]);
$Command=$sqlstate->fetch(PDO::FETCH_ASSOC);


$sqlligne = $pdo->prepare("
SELECT ligne_commande.*, pro.*
FROM  ligne_commande
INNER JOIN pro ON pro.id = ligne_commande.id_produit 
where id_commande=? 
");
$sqlligne->execute([$id_commande]);
$Lignedescommandes=$sqlligne->fetchAll(PDO::FETCH_ASSOC);
     ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Details COM <?php echo $Command['id']  ?></title>
</head>
<body>


     <div class="container">
     <br>
     
     <table class="table table-striped table-hover">
        <tr>
        <th>#ID </th>
        <th>Client</th>
        <th>Total</th>
        <th>Date</th>
        <th></th>
    
        </tr>
        
        <tr>
        <td><?php echo $Command['id'] ?></td>
        <td><?php echo $Command['login'] ?></td>
        <td><?php echo $Command['total'] ?> MAD</td>
        <td> <?php echo $Command['date'] ?></i></td>
        <td>
            <?php 
            if($Command['Valid']==0){ ?>
             <a href="ValiderCommande.php ? id=<?php echo $Command['id']?>&etat=1 " class="btn btn-success btn-sm">Valider la commande</a>
           <?php }else{   ?>
            <a href="ValiderCommande.php? id=<?php echo  $Command['id']?> &etat=0 " class="btn btn-danger btn-sm">Annuler la commande</a>
           <?php }
            ?>
       
        </td>
     
        </tr>

        
    
     </table>
     
     <h4>Details</h4>
     <table class="table table-striped table-hover">
        <tr>
        <th>#ID </th>
        <th>Produit</th>
        <th>img</th>
        <th>Prix unitaire</th>
        <th>Qauntite</th>
        <th>Totale</th>
    
        </tr>
    <?php
    foreach($Lignedescommandes as $Ligne ){ ?>
    
    <tr>
    <td><?php echo $Ligne['id-com'] ?></td>
    <td><?php echo $Ligne['libelle'] ?></td>
    <td><img src="Upload/Produit/<?php echo $Ligne['img'] ?>" alt="" class="img-fluid" width="100px"></td>
    <td><?php echo $Ligne['prix'] ?> MAD</td>
    <td> X <?php echo $Ligne['Qauntite'] ?></td>
    <td> <?php echo $Ligne['total'] ?> MAD </td>
    </tr>

<?php }
     ?>
        

        
    
     </table>
     

     </div>
     
   
    
</body>
</html>