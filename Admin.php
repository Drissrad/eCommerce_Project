<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Admin</title>
</head>
<body>
<?php 
    include 'include/nav.php';
 
    if(!isset($_SESSION['admin'])){
        header("Location: index.php");
    }
    
     ?>
     <h2>
        <?php 
        echo $_SESSION['admin']['login'];
        ?>
        </h2>
        <i class="fa-sharp fa-light fa-do-not-enter"></i>

</body>
</html>
