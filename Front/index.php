<?php
  session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<title>Lists de categorie</title>
</head>
<?php 
  require_once '../include/DB.php';
  $Categ = $pdo->query('SELECT * FROM categ')->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
<?php include 'navfront.php';?>
<div class="container">
<h4>Hello MR <?php echo $_SESSION['user']['login'] ?></h4>
<h2><i class="fa-solid fa-list"></i> list de categorie</h2>
<ul class="list-group list-group-flush">
    <?php foreach($Categ as $B){?>
  <li class="list-group-item"><a href="categorie.php?id=<?php echo $B['id'] ?>" class="btn btn-light">
      <i class="<?php echo $B['icon'] ?>"> </i><?php echo " ". $B['libelle'] ?>
   </a>
</li>
  <?php } ?>
  

</ul>
</div>

     


</body>
</html>
