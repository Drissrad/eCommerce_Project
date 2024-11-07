<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title> ADD Categorie</title>
</head>
<body>
    <?php 
    include 'include/nav.php';
     ?>
     <div class="container py-2">
     <?php 
 if (isset($_POST['ADD'])){
    $Libelle=$_POST['Libelle'];
    $descri=$_POST['des'];
    $icon=$_POST['icon'];
  if(!empty( $Libelle) &&!empty($descri)&&!empty($icon)){
  require_once 'include/DB.php';
  $sql=$pdo->prepare('INSERT INTO categ(libelle,descri,icon) VALUES (?,?,?)');
  $sql->execute([$Libelle,$descri,$icon]); 
  header("Location: Lists.php");
 } 

  else{ ?>
  
  <div class="alert alert-danger" role="alert">
   chmps are required
</div>
  <?php 
  }
    
 }

     ?>


     <form  method="post">
  <div class="mb-3">
    <label  class="form-label">Libelle</label>
    <input type="text" class="form-control"  name='Libelle'>
  </div>
  <div class="mb-3">
    <label  class="form-label">Description</label>
    <textarea name="des" id="" class="form-control"></textarea>
  </div>
  <div class="mb-3">
    <label  class="form-label">Icon</label>
    <input type="text" class="form-control"  name='icon'>
  </div>
 
 
  <button type="submit" class="btn btn-primary" name='ADD'>ADD Categorie</button>
</form>

     </div>

</body>
</html>
