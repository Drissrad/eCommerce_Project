<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title> ADD Produit</title>
</head>
<body>
    <?php 
    include 'include/nav.php';
    require_once 'include/DB.php';
     ?>
     <div class="container py-2">
     <?php 
 if (isset($_POST['ADD'])){
  $Libelle =$_POST['Libelle'];
  $prix=$_POST['prix'];
  $dicount=$_POST['dicount'];
  $select=$_POST['selec'];
  $descrip=$_POST['descrip'];
  $filename='';
  if(!empty($_FILES['img'])){
    $img=$_FILES['img']['name'];
    $filename=uniqid().$img;
    if (move_uploaded_file($_FILES['img']['tmp_name'], 'Upload/Produit/'. $filename)) {

    }
   
  }

  

  if(!empty( $Libelle) &&!empty($prix) &&!empty($select)&&!empty($descrip)&&!empty($img)){

    $sql=$pdo->prepare('INSERT INTO pro(libelle,prix,discount,id_categorie,descrip,img) VALUES (?,?,?,?,?,?)');
    $sql->execute([$Libelle,$prix, $dicount,$select, $descrip,$filename]); 
    
    header("Location: Listspro.php");
 } 

  else{ ?>
  
  <div class="alert alert-danger" role="alert">
   chmps are required
</div>
  <?php 
  }
    
}

     ?>


     <form  method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label  class="form-label">Libelle</label>
    <input type="text" class="form-control"  name='Libelle'>
  </div>
  <div class="mb-3">
    <label  class="form-label">Prix</label>
  <input type="number" name="prix" id=""  class="form-control" min="0">
  </div>
  <div class="mb-3">
    <label  class="form-label">dicount</label>
  <input type="number" name="dicount" id=""  class="form-control" min="0" max="100">
  </div>
  <div class="mb-3">
    <label  class="form-label">Description</label>
    <textarea name="descrip" id="" class="form-control" ></textarea>

  </div>
  <div class="mb-3">
    <label  class="form-label">Image</label>
  <input type="file" name="img" id=""  class="form-control" >
  </div>

  <div class="mb-3">
    <label  class="form-label"  >Categorie</label>
    <?php 
$Categ = $pdo->query('SELECT * FROM categ')->fetchAll(PDO::FETCH_ASSOC);




   
    ?>
    <select name="selec" id=""  class="form-control" >
    <option selected>Open this select menu</option>
   <?php  foreach($Categ as $A){ 
        echo "<option value=".$A['id'].">".$A['libelle']."</option>";
    } ?>
    </select>
  </div>
 
  
 
 
  <button type="submit" class="btn btn-primary" name='ADD'>ADD produit</button>
</form>

     </div>

</body>
</html>
