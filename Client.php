<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Connexion</title>
</head>
<body>
<?php 
    include 'include/nav.php';
     ?>
     <div class="container py-2">
     <?php 
 if (isset($_POST['ADD'])){
    $login=$_POST['login'];
    $password=$_POST['password'];
    $date=date('Y-m-d');
  if(!empty($login) &&!empty($password)){
  require_once 'include/DB.php';
  $sql=$pdo->prepare('SELECT * FROM client where login=? and password=? ');
  $sql->execute([$login,$password]);
  if( $sql->rowCount() >=1){ 
   
    $_SESSION['user']=$sql->fetch();
    header("Location:Front/index.php ");

  }else{?>
<div class="alert alert-danger" role="alert">
    informations are not correct
</div>

<?php
  }
 


 

   } else{ ?>
  
  <div class="alert alert-danger" role="alert">
   Login and password are required
</div>
  <?php 
  }
    
 }

     ?>


     <form  method="post">
  <div class="mb-3">
    <label  class="form-label">Login</label>
    <input type="text" class="form-control"  name='login'>
  </div>
  <div class="mb-3">
    <label  class="form-label">Password</label>
    <input type="password" class="form-control" name='password' >
  </div>
 
  <button type="submit" class="btn btn-primary" name='ADD'>Connexion</button>
</form>

     </div>
     

</body>
</html>
