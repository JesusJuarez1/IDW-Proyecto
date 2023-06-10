<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['usuario']) && !empty($_POST['contrasena'])) {
    $sql = "INSERT INTO users (usuario, contrasena) VALUES (:usuario, :contrasena)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $_POST['usuario']);
    $password = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
    $stmt->bindParam(':contrasena', $password);

    if ($stmt->execute()) {
      $message = 'Usuario creado con exito';
    } else {
      $message = 'Lo sentimos, no se pudo crear la cuenta';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Crear cuenta</h1>
    <span>or <a href="login.php">Ingresar</a></span>

    <form action="signup.php" method="POST">
      <input name="usuario" type="text" placeholder="Ingresa tu nombre de usuario">
      <input name="contrasena" type="password" placeholder="Ingresa tu contraseña">
      <input type="submit" value="Submit">
    </form>

  </body>
</html>
