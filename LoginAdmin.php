<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Login</title>
    <link rel="stylesheet" href="login.css">
    <style>
        .center-link {
            text-align: center;
            margin-top: 45px;
        }
    </style>
</head>
<body>
    <form action="#" method="post">
        <h2>Connexion au compte</h2>
        <?php
        if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <p>E-mail</p>
        <input type="text" name="email" placeholder="E-mail"><br>
        <p>Mot de passe</p>
        <input type="password" name="password" placeholder="Mot de passe"><br>
        <button type="submit" name="login">Connexion</button><br>
        
        <div class="center-link">
            <a href="InscrireParticipant.php">Créer un compte</a>
        </div>
    </form>

    <?php
    include('adminBase.php');
    $conn = OpenBase();
    if (isset($_POST['login'])) {
        $user = $_POST['email'];
        $pass = $_POST['password'];
        $sql = "SELECT * FROM login WHERE email='$user' AND password='$pass'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_num_rows($res);

        if ($row == 1) {
            $_SESSION['user_name'] = $user;
            header('Location: HomeAdmin.html');
        } else {
            echo "Échec de la connexion";
        }
    }
    ?>
</body>
</html>
