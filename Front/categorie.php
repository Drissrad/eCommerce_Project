<?php 
  session_start();
  require_once '../include/DB.php';
  $id_client=$_SESSION['user']['id'];
  $ID=$_GET['id'];
  $CategB = $pdo->prepare('SELECT * FROM categ where id=?');
  $CategB->execute([$ID]); 
  $CATB=$CategB->fetch(PDO::FETCH_ASSOC);
 
  $Categ = $pdo->prepare('SELECT * FROM pro where id_categorie=?');
  $Categ->execute([$ID]); 
  $CAT=$Categ->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <link rel="stylesheet" href="../CSS/css.css">
    <title> Categorie <?php  echo  $CATB['libelle'] ?></title>
</head>
<body>
<?php include 'navfront.php';?>
<div class="container">
    <div class="container">
        <h4><i class="<?php echo $CATB['icon'] ?>"></i> <?php  echo $CATB['libelle'] ?></h4>
        <div class="row ">
            <?php foreach($CAT as $A)
            {?>
<div class="card mb-3 col-md-4 m-1">
  <img src="../Upload/Produit/<?php  echo $A['img']  ?>" class="card-img-top" alt="..." width="100%" height="200">
  <div class="card-body">
    <a href="Produit.php?id=<?php echo $A['id'] ?>" class="btn btn-primary stretched-link">Details</a>
    <h5 class="card-title"><?php  echo $A['libelle']  ?></h5>
    <p class="card-text"><?php  echo $A['descrip']  ?></p>
    <p class="card-text"><small class="text-body-secondary">ajouter le <?php echo date_format(date_create($A['date creation']),'Y/m/d' );  ?></small></p>
  </div>
  <?php
  
  
  $qte=$_SESSION['Panier'][$id_client][$A['id']] ?? 0 ;
  $Button= $qte ==0 ?'Ajouter':'Modifier';
     ?>
  <div class="card-footer" style="z-index :10">
  <form action="Ajouter_panier.php" method="post" class="counter d-flex">
                            <button type="button" class="btn btn-primary mx-1" onclick="moin(event, this)">-</button> 
                            <input type="hidden" value="<?php echo $A['id']?>" name="id">
                            <input type="number" id="qty" name="qty" max="99" value="<?php echo  $qte   ?>">
                            <button type="button" class="btn btn-primary mx-1" onclick="plus(event, this)">+</button>
                            <input type="submit" name="Ajouter" class="btn btn-success" value="<?php echo $Button ;  ?>">
                        </form>



  </div>
</div>
<?php 
}
if (empty($CAT)){
    echo "<h2  class='alert alert-info'>ther is no item</h2>";
} 
?>

        </div>
    </div>
</div>


    

<script src="../JS/counter.js"></script>

</body>
</html>
