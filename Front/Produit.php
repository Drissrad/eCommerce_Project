<?php 
  require_once '../include/DB.php';
  session_start();
  $id_client=$_SESSION['user']['id'];
  $ID=$_GET['id'];
  $CategB = $pdo->prepare('SELECT * FROM pro where id=?');
  $CategB->execute([$ID]); 
  $CATB=$CategB->fetch(PDO::FETCH_ASSOC);
  if($CATB['discount'] !=0 ){ 
    $total= $CATB['prix'] -( $CATB['prix'] * $CATB['discount']/100 );
  }else{
    $total=$CATB['prix'] ;
  }
     
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title> Details Produit <?php  echo  $CATB['libelle'] ?></title>
    <style>
        .glow {
            font-size: 1em;
            color: #fff;
            text-align: center;
            animation: glow 1s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 10px #0f0, 0 0 20px #0f0, 0 0 30px #0f0, 0 0 40px #0f0, 0 0 50px #0f0, 0 0 60px #0f0, 0 0 70px #0f0;
            }
            to {
                text-shadow: 0 0 20px #0ff, 0 0 30px #0ff, 0 0 40px #0ff, 0 0 50px #0ff, 0 0 60px #0ff, 0 0 70px #0ff, 0 0 80px #0ff;
            }
        }
    </style>
</head>
<body>
<?php include 'navfront.php'?>
<div class="container">
<h4><?php echo $CATB['libelle'] ?> </h4>
    <div class="row">
  <div class="col-md-6">
    <img class="img img-fluid w-75"src="../Upload/Produit/<?php echo $CATB['img'] ?>" alt="">
  </div>
  <div class="col-md-6">
    <h1><?php  echo  $CATB['libelle'] ?></h1>
    <hr>
    <p><?php  echo  $CATB['descrip'] ?></p>
    <hr>
    <?php
    if($CATB['discount'] !=0 ){ 
      
       ?>
  
  Profiter de  <p class="badge text-bg-success glow">- <?php  echo  $CATB['discount'] ?> %</p>
      <?php 
  
      
       } ;
      ?>
    <h5 >
    <?php 
    if($CATB['discount'] !=0 ){ ?>
     <span class="badge text-bg-danger"> <del><?php  echo $CATB['prix']; ?>MAD</del></span>

<?php 
 }
    ?>
      
      
    <span class="badge text-bg-success"> <?php  echo $total; ?>MAD</span>
  </h5>
    <hr>
    <?php
    
      $qte= $_SESSION['Panier'][$id_client][ $CATB['id']] ?? 0 ;
    
 
    $Button= $qte==0 ?'Ajouter':'Modifier';
     ?>
    <form action="Ajouter_panier.php" method="post" class="counter d-flex">
    <button type="button" class="btn btn-primary mx-1" onclick="moin(event, this)">-</button> 
    <input type="hidden" value="<?php echo $CATB['id']?>" name="id">
    <input type="number" id="qty" name="qty" max="99" value="<?php echo $qte;  ?>">
    <button type="button" class="btn btn-primary mx-1" onclick="plus(event, this)">+</button>
     <input type="submit" name="Ajouter" class="btn btn-success" value="<?php echo $Button ;  ?>">
    </form>
    <hr>

 
    
  </div>
    </div>
</div>
<script src="../JS/counter.js"></script>
</body>
</html>
