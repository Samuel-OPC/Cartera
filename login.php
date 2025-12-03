<?php
session_start();
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    // Credenciales demo
    $validUser = 'admin';
    $validPass = '1234';
    if ($username === $validUser && $password === $validPass) {
        $_SESSION['logged_in'] = true;
        header('Location: index.php');
        exit;
    } else {
        $message = 'Credenciales inválidas. Intente de nuevo.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Acceso Administrativo - InvWest</title>
<link rel="stylesheet" href="style.css">
</head>
<body class="login-body">
<div class="login-container">
  <!-- ...existing code... -->
  <form method="post" id="login-form" class="login-form">
    <div class="form-group">
      <label for="username">Usuario</label>
      <input type="text" id="username" name="username" value="admin" required>
    </div>
    <div class="form-group">
      <label for="password">Contraseña</label>
      <input type="password" id="password" name="password" value="1234" required>
    </div>
    <button type="submit" class="login-btn">Iniciar Sesión</button>
    <?php if ($message): ?>
      <div class="message error"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
  </form>
  <!-- ...existing code... -->
</div>
</body>
</html>