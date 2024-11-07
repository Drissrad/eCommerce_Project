

   
    


<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Ecommerce</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php"> <i class="fa-duotone fa-solid fa-list"></i>List de categorie</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../Deconnexion.php"><i class="fa-solid fa-share-from-square"></i> Deconnexion</a>
        </li>
      </ul>
    <?php
      $id_client=$_SESSION['user']['id'];
      if (!isset($_SESSION['Panier'][$id_client])) {
        $X = 0;
    } else {
        $X = count($_SESSION['Panier'][$id_client]) ;
    }
     ?>
    </div>
    <a href="Painer.php" calss="btn float-end"><i class="fa-solid fa-cart-shopping">  panier(<?php echo  $X ?>)</i></a>
  </div>
</nav>