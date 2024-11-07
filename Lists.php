
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>List caegorie</title>
</head>
<body>

<?php 
    include 'include/nav.php';
    require_once 'include/DB.php';
    $Categ = $pdo->query('SELECT * FROM categ')->fetchAll(PDO::FETCH_ASSOC);

     ?>
     <div class="container">
     <a  href="ADDcate.php" class="btn btn-primary">ADD CATEGPOIRE</a>
        <h2>Lists de catogirie</h2>
     <table class="table  table-hover">
        <tr>
        <th>Libeel </th>
        <th> description</th>
        <th>date</th>
        <th>icon</th>
        <th>Opertaions</th>
        </tr>
        <?php 
        foreach($Categ as $A ){  ?>
        <tr>
        <td><?php echo $A['libelle'] ?></td>
        <td><?php echo $A['descri'] ?></td>
        <td><?php echo $A['date'] ?></td>
        <td> <i class="<?php echo $A['icon'] ?>"></i></td>
        <td>
        <a href="Modifiercate.php ? id=<?php echo $A['id']  ?>" class="btn btn-primary">Modifier Categoire</a>
        <a href="Supprimercate.php?id=<?php echo $A['id']; ?>" class="btn btn-danger" onclick="return confirm('Do you want to delete <?php  echo $A['libelle']?>');">Supprimer Categoire</a>

        </td>
        </tr>

<?php   }
        ?>
    
     </table>

     </div>
     
   
    
</body>
</html>