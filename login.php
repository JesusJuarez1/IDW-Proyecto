<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
  }
  require 'database.php';

  if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, usuario, contrasena FROM usuario WHERE usuario = :usuario');
    $records->bindParam(':usuario', $_POST['usuario']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && contrasena_verify($_POST['contrasena'], $results['contrasena'])) {
      $_SESSION['user_id'] = $results['id'];
      header("index.php");/*aqui va a donde se redirecciona despues de enviar los datos correctamente*/
    } else {
      $message = 'Los datos no coinsiden';
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Igresar</h1>
    <span>or <a href="signup.php">Crear cuenta</a></span>

    <form action="index.php" method="POST"><!--se pone la pagina a la que ingresa despues de entrar -->
      <input name="usuario" type="text" placeholder="Ingresa tu nombre de usuario">
      <input name="contrasena" type="password" placeholder="Ingresa tu contraseña">
      <input type="submit" value="Aceptar">
    </form>
  </body>
</html>
