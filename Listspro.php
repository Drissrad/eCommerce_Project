
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>List Produtis</title>
</head>
<body>

<?php 
    include 'include/nav.php';
    require_once 'include/DB.php';
    $Categ = $pdo->query("
    SELECT pro.*, categ.libelle AS cate_go 
    FROM pro 
    INNER JOIN categ ON pro.id_categorie = categ.id
")->fetchAll(PDO::FETCH_ASSOC);


     ?>
     <div class="container">
     <a  href="ADDpro.php" class="btn btn-primary">ADD Produit</a>
        <h2>Lists de Produit</h2>
     <table class="table  table-hover">
        <tr>
      
        <th> prix</th>
        <th> dicount</th>
        <th> prix finale</th>
        <th>Libeel </th>
        <th>Caegoire</th>
        <th>image</th>
        <th>date</th>
        <th>Opertaions</th>
        </tr>
        <?php 
        foreach($Categ as $A ){  ?>
        <tr>
    
        <td><?php echo $A['prix']." Dh" ?></td>
        <td><?php echo $A['discount']." %" ?></td>
        <td><?php echo $A['prix']-($A['discount']*$A['prix'])/100 ?></td>
        <td><?php echo $A['libelle'] ?></td>
        <td><?php echo $A['cate_go'] ?></td>
        <td><img src="Upload/Produit/<?php echo $A['img'] ?>" alt="" class="img-fluid" width="100px"></td>
        <td><?php echo $A['date creation'] ?></td>
        <td>
           <a href="ModifierProduit.php ? id=<?php echo $A['id']  ?> " class="btn btn-primary">Modifier Produit</a>
           <a href="Supprimerproduit.php ? id=<?php echo $A['id']  ?>" class="btn btn-danger" onclick="return confirm('Do you want to delete <?php  echo $A['libelle']?>');">Supprimer Produit</a>
        </td>
        </tr>

<?php   }
        ?>
    
     </table>

     </div>
     
   
    
</body>
</html>