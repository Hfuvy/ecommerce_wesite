<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
    exit(); // Ajoutez exit() après header pour arrêter l'exécution du script
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $pass = $_POST['pass'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = $_POST['cpass']; // Ajout de la récupération de la confirmation du mot de passe
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $pass = sha1($pass); 
    $cpass = sha1($cpass); 

    // Vérifiez si le nom d'utilisateur existe déjà
    $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ?");
    $select_admin->execute([$name]);

    if ($select_admin->rowCount() > 0) {
        $message[] = 'Username already exists!';
    } else {
        if ($pass != $cpass) {
            $message[] = 'Confirm password does not match'; 
        } else {
            // Insertion de l'administrateur
            $insert_admin = $conn->prepare("INSERT INTO `admins` (name, password) VALUES (?, ?)");
            $insert_admin->execute([$name, $pass]); // Utilisez $pass au lieu de $cpass
            $message[] = "New admin registered!";
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>



<section class="form-container">
    <form action="" method="post">
       <h3>register now</h3>
        <input type="text" name="name" class="box" placeholder="Enter your username" required maxlength="20" oninput="this.value = this.value.replace(/\s/g,'')">
        <input type="password" name="pass" class="box" placeholder="Enter your password" required maxlength="20" oninput="this.value = this.value.replace(/\s/g,'')">
        <input type="password" name="cpass" class="box" placeholder="Confirm your password" required maxlength="20" oninput="this.value = this.value.replace(/\s/g,'')">

        <input type="submit" value="register Now" name="submit" class="btn">
    </form>
</section>









<script src="../js/admin_script.js"></script>
   
</body>
</html>