<?php
session_start();

// Logique de vidage du panier avant tout contenu HTML
if (isset($_POST['vider'])) {
    $id_client = $_SESSION['user']['id'];
    $_SESSION['Panier'][$id_client] = [];
    header("Location: " . $_SERVER['PHP_SELF']);
    if(isset($_SESSION['Panier'][$id_client])) {
        $X = '( '. count($_SESSION['Panier'][$id_client]).' ) ';
    }

    exit();
}
$id_client = $_SESSION['user']['id'];
$Panier = $_SESSION['Panier'][$id_client];

require_once '../include/DB.php';
if(!empty($Panier)){
$idproduit = array_keys($Panier);
$placeholders = implode(',', array_fill(0, count($idproduit), '?'));
$sqlsate = $pdo->prepare("SELECT * FROM pro WHERE id IN ($placeholders)");
$sqlsate->execute(array_values($idproduit));
$produit = $sqlsate->fetchAll(PDO::FETCH_ASSOC);

}
?>


<?php// Logique de suppression d'un produit du panier avant tout contenu HTML
if (isset($_POST['SupprimerPP'])) {
    $id_client = $_SESSION['user']['id'];
    $id_produit = $_POST['id_produit'];
    unset($_SESSION['Panier'][$id_client][$id_produit]);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Panier</title>
</head>
<body>
<?php include 'navfront.php'; require_once '../include/DB.php'; ?>
<div class="container">
    <h4>Panier(<?php echo   $X; ?>)</h4>
    <div class="container">
        <div class="row">
        <?php
if(isset($_POST['valider'])){
    $id_client = $_SESSION['user']['id'];
    $Panier_utilisateur= $_SESSION['Panier'][$id_client] ;
    
    $total=0;
    foreach($produit as $P ){
        $Qte=$Panier[$P['id']];
        $prix=$P['prix'];
        $total+=$prix*$Qte;
    }
    $sql=$pdo->prepare('INSERT INTO commande(idclient,total) VALUES (?,?)');
    $sql->execute([$id_client,$total]); 
    $idcommande = $pdo->lastInsertId();
    foreach($Panier as $item=>$Qte){
$stmt = $pdo->prepare('SELECT * FROM pro WHERE id = ?');
$stmt->execute([$item]);
$PP = $stmt->fetch(PDO::FETCH_ASSOC);
$sqlligne=$pdo->prepare('INSERT INTO ligne_commande(id_produit,prix,Qauntite,total,id_commande) VALUES (?,?,?,?,?)');
$sqlligne->execute([$item,$PP['prix'],$Qte,$PP['prix']*$Qte,$idcommande]); 

    }
    ?>
    <div class="alert alert-primary" role="alert">
 your xommande was added suceessfully
</div>

<?php
$_SESSION['Panier'][$id_client] =[];

                                    
} ?>
            <?php
          

            if (empty($Panier)) { ?>
                <div class="alert alert-warning" role="alert">
                    Votre panier est vide
                </div>
            <?php } else {
           
                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Libelle</th>
                            <th scope="col">Img</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Action</th>
                            <th scope="col">PRIX</th>
                            <th scope="col">Total</th>
                           
                        </tr>
                    </thead>
                    <?php $Total = 0; ?>
                    <?php foreach ($produit as $A) {
                        $qte = $_SESSION['Panier'][$id_client][$A['id']] ?? 0;
                        $Button = $qte == 0 ? 'Ajouter' : 'Modifier';
                        ?>
                        <tr>
                            <td><?php echo $A['id']; ?></td>
                            <td><?php echo $A['libelle']; ?></td>
                            <td><img src="../Upload/Produit/<?php echo $A['img']; ?>" alt="" width="100"></td>
                            <td>
                                <form action="Ajouter_panier.php" method="post" class="counter d-flex align-items-center">
                                    <button type="button" class="btn btn-primary mx-1" onclick="moin(event, this)">-</button>
                                    <input type="hidden" value="<?php echo $A['id']; ?>" name="id">
                                    <input type="number" id="qty" name="qty" max="99" value="<?php echo $qte; ?>" class="form-control mx-1">
                                    <button type="button" class="btn btn-primary mx-1" onclick="plus(event, this)">+</button>
                                    <button type="submit" name="Ajouter" class="btn btn-success mx-1">
  <i class="fa-solid fa-pen-to-square fa-beat"></i> 
</button>


                                </form>
                            </td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="id_produit" value="<?php echo $A['id']; ?>">
                                    <button type="submit" class="btn btn-danger" name="SupprimerPP" onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?');">
                   <i class="fa-solid fa-trash fa-beat"></i>
                                    </button>




                                </form>
                            </td>
                            <td><?php echo $A['prix']; ?> MAD</td>
                            <td><?php echo $A['prix'] * $Panier[$A['id']]; ?> MAD</td>
                           
                        </tr>
                        <?php $Total += $A['prix'] * $Panier[$A['id']]; ?>
                    <?php } ?>
                    <tfoot>
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><?php echo $Total; ?> MAD</td>
                        </tr>
                        <tr>
                            <td colspan="6">
                            
                               
                            
                                <form method="post">
                                    <input type="submit" class="btn btn-success" name="valider" value="Valider la commande">
                                    <input type="submit" class="btn btn-danger" name="vider" value="Vider la commande" onclick="return confirm('Voulez-vous vraiment vider votre panier ?');">
                                </form>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            <?php } ?>
        </div>
    </div>
</div>

<script src="../JS/counter.js"></script>
</body>
</html>
