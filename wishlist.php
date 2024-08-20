<?php
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
} else{
    $user_id = '';
    header('location:home.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">
    <title>Wishlist</title>
</head>
<body>

<?php include 'components/user_header.php';?>























<?php include 'components/footer.php' ?>

<script src="js/script.js"></script>
</body>
</html>