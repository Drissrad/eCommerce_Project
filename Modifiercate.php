<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title> Modifier Categorie</title>
</head>
<body>
  
  
<?php   include 'include/nav.php';
  require_once 'include/DB.php';
  $ID=$_GET['id'];
  $Categ = $pdo->prepare('SELECT * FROM categ where id=?');
  $Categ->execute([$ID]); 
  $CAT=$Categ->fetch(PDO::FETCH_ASSOC);
  if (isset($_POST['ADD'])){
    $Libelle=$_POST['Libelle'];
    $descri=$_POST['des'];
    $icon=$_POST['icon'];
  if(!empty( $Libelle) &&!empty($descri)){
  $sql=$pdo->prepare('UPDATE  categ SET libelle=?,descri=?,icon=? where id=?');
  $sql->execute([$Libelle,$descri,$icon,$ID]); 
  header("Location: Lists.php");
 } 
  }
?>
<div class="container">


<h2>Modifier Categories</h2>

     <form  method="post">
  <div class="mb-3">
    <label  class="form-label">Libelle</label>
    <input type="text" class="form-control"  name='Libelle' value="<?php echo $CAT['libelle'] ?>">
  </div>
  <div class="mb-3">
    <label  class="form-label">Description</label>
    <textarea name="des" id="" class="form-control"  value=""><?php echo $CAT['descri'] ?></textarea>
  </div>
  <div class="mb-3">
    <label  class="form-label">Icon</label>
    <input type="text" class="form-control"  name='icon' value="<?php echo $CAT['icon'] ?>" >
  </div>

 
 
  <button type="submit" class="btn btn-primary" name='ADD'>Modifier Categoires</button>
</form>

     </div>

</body>
</html>
