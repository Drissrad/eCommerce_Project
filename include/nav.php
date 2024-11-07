<?php
   session_start();
   $connecte = false;
   if (isset($_SESSION['admin'])) {
       $connecte = true;
   }
   $currentpage = $_SERVER['PHP_SELF'];
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Ecommerce</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        
        <?php 
        if ($connecte) { 
            ?>
         <li class="nav-item">
          <a class="nav-link <?php if ($currentpage == '/SITEECOOMERCE/ADDpro.php') echo 'active'; ?>" href="ADDpro.php"><i class="fa-regular fa-window-restore"></i> ADD PRODUIT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($currentpage == '/SITEECOOMERCE/index.php') echo 'active'; ?>" aria-current="page" href="ADDuser.php"><i class="fa-solid fa-user"></i> ADD USER</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($currentpage == '/SITEECOOMERCE/ADDcate.php') echo 'active'; ?>" href="ADDcate.php"><i class="fa-sharp fa-solid fa-layer-group"></i> ADD CATEGPOIRE</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($currentpage == '/SITEECOOMERCE/Lists.php') echo 'active'; ?>" href="Lists.php"><i class="fa-sharp fa-solid fa-list"></i> Lists Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($currentpage == '/SITEECOOMERCE/Listspro.php') echo 'active'; ?>" href="Listspro.php"><i class="fa-duotone fa-solid fa-list"></i> Lists Pros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($currentpage == '/SITEECOOMERCE/commande.php') echo 'active'; ?>" href="commande.php"><i class="fa-thin fa-command"><i class="fa-solid fa-money-bill"></i></i> Commandes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Deconnexion.php"><i class="fa-solid fa-share-from-square"></i> Deconnexion</a>
        </li>
        <?php 
        } else { ?>
        <li class="nav-item">
          <a  class="nav-link <?php if ($currentpage == '/SITEECOOMERCE/connexion.php') echo 'active'; ?>" href="index.php">Admin</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link <?php if ($currentpage == '/SITEECOOMERCE/Client.php') echo 'active'; ?>"  href="Client.php">Client</a>
        </li>
        <?php
        } ?>
      </ul>
    </div>
  </div>
</nav>
