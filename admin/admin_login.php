<?php
include '../components/connect.php';

session_start();
$message = [];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $pass = $_POST['pass'];
    $pass = sha1($pass); // Utilisation de sha1 pour le mot de passe (non recommandé mais demandé)
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
    $select_admin->execute([$name, $pass]);

    if ($select_admin->rowCount() > 0) {
        $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
        $_SESSION['admin_id'] = $fetch_admin_id['id'];
        header('location:dashboard.php');
      //   $message[] = 'Login successful'; // Message modifié pour refléter le succès de la connexion
    } else {
        $message[] = 'Incorrect username or password'; // Message d'erreur pour les informations incorrectes
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- custom css file link -->
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php
if (!empty($message)) {
    foreach ($message as $msg) {
        echo '
        <div class="message">
            <span>'.$msg.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>

<!-- admin login form section start -->
<section class="form-container">
    <form action="" method="post">
        <h3>Login Now</h3>
        <p>Default username = <span>admin</span> & password = <span>111</span></p>
        <input type="text" name="name" class="box" placeholder="Enter your username" required maxlength="20" oninput="this.value = this.value.replace(/\s/g,'')">
        <input type="password" name="pass" class="box" placeholder="Enter your password" required maxlength="20" oninput="this.value = this.value.replace(/\s/g,'')">
        <input type="submit" value="Login Now" name="submit" class="btn">
    </form>
</section>

<script src="../js/admin_script.js"></script>
</body>
</html>
