
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Commandes</title>
</head>
<body>

<?php 
    include 'include/nav.php';
    require_once 'include/DB.php';
    $Command = $pdo->query("
    SELECT commande.*, client.login AS login
    FROM commande
    INNER JOIN client ON client.id = commande.idclient ORDER BY commande.date
")->fetchAll(PDO::FETCH_ASSOC);

     ?>
     <div class="container">
     
        <h2>Lists des commandes</h2>
     <table class="table  table-hover">
        <tr>
        <th>#ID </th>
        <th>Client</th>
        <th>Total</th>
        <th>Date</th>
        <th>Opertaions</th>
        </tr>
        <?php 
        foreach($Command as $A ){  ?>
        <tr>
        <td><?php echo $A['id'] ?></td>
        <td><?php echo $A['login'] ?></td>
        <td><?php echo $A['total'] ?> MAD</td>
        <td> <?php echo $A['date'] ?></i></td>
        <td>
        <a href="Com_Detail.php ? id=<?php echo $A['id']  ?>" class="btn btn-primary btn-sm">Details</a>


        </td>
        </tr>

<?php   }
        ?>
    
     </table>

     </div>
     
   
    
</body>
</html>