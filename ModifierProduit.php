<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Modifier Produit</title>
</head>
<body>
    <?php 
    include 'include/nav.php';
    require_once 'include/DB.php';
    $ID = $_GET['id'];
    $Categ = $pdo->prepare('SELECT * FROM pro WHERE id = ?');
    $Categ->execute([$ID]); 
    $CAT = $Categ->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="container py-2">
        <?php 
        if (isset($_POST['ADD'])){
            $Libelle = $_POST['Libelle'];
            $prix = $_POST['prix'];
            $dicount = $_POST['dicount'];
            $select = $_POST['selec'];
            $descrip = $_POST['descrip'];
            $filename = $CAT['img']; 

            if (!empty($_FILES['img']['name'])){
                $img = $_FILES['img']['name'];
                $filename = uniqid() . $img;
                move_uploaded_file($_FILES['img']['tmp_name'], 'Upload/Produit/' . $filename);
            }

            if (!empty($Libelle) && !empty($prix)  && !empty($select) && !empty($descrip)){
                $sql = $pdo->prepare('UPDATE pro SET libelle = ?, prix = ?, discount = ?, id_categorie = ?, descrip = ?, img = ? WHERE id = ?');
                $sql->execute([$Libelle, $prix, $dicount, $select, $descrip, $filename, $ID]);
                header("Location: Listspro.php");
            } else { ?>
                <div class="alert alert-danger" role="alert">
                    Tous les champs sont obligatoires.
                </div>
            <?php 
            }
        }
        ?>

        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Libelle</label>
                <input type="text" class="form-control" name="Libelle" value="<?php echo $CAT['libelle']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Prix</label>
                <input type="number" name="prix" class="form-control" min="0" value="<?php echo $CAT['prix']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Dicount</label>
                <input type="number" name="dicount" class="form-control" min="0" max="100" value="<?php echo $CAT['discount']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="descrip" class="form-control"><?php echo $CAT['descrip']; ?></textarea>
            </div>
            <div class="mb-3">
                <img src="Upload/Produit/<?php echo $CAT['img']; ?>" width="200px" height="100px">
                <label class="form-label">Image</label>
                <input type="file" name="img" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Categorie</label>
                <select name="selec" class="form-control">
                    <?php 
                    $Categ = $pdo->query('SELECT * FROM categ')->fetchAll(PDO::FETCH_ASSOC);
                    foreach($Categ as $A){ 
                        $selected = $CAT['id_categorie'] == $A['id'] ? 'selected' : '';
                        echo "<option $selected value='".$A['id']."'>".$A['libelle']."</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="ADD">Modifier produit</button>
        </form>
    </div>
</body>
</html>
