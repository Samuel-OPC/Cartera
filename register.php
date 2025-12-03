<?php
// Lógica de PHP para procesar el Registro
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

/**
 * Función para validar que el nombre completo no contenga números.
 *
 * @param string $nombre El nombre a validar.
 * @return bool Retorna true si el nombre es válido (sin números), false si contiene números.
 */
function validarNombreSinNumeros($nombre) {
    // Expresión regular que permite letras (mayúsculas/minúsculas), espacios,
    // y caracteres especiales comunes en nombres (ñ, acentos).
    // Si encuentra cualquier dígito (0-9), la validación falla.
    // El patrón '/[0-9]/' busca cualquier dígito.
    return !preg_match('/[0-9]/', $nombre);
}

$mensaje = '';
$nombre = '';
$email = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Recoger los datos y sanearlos (htmlspecialchars en el HTML es opcional)
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? ''; 
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // 2. 🛡️ Validaciones estrictas
    
    if (empty($nombre) || empty($email) || empty($password) || empty($confirm_password)) {
        $mensaje = "<p class='error'>Todos los campos son obligatorios.</p>";

    } elseif ($password !== $confirm_password) {
        $mensaje = "<p class='error'>Las contraseñas no coinciden.</p>";

    } elseif (strlen($password) < 6) { 
        // 💡 Validación de longitud de contraseña (Recomendado)
        $mensaje = "<p class='error'>La contraseña debe tener al menos 6 caracteres.</p>";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        // 💡 Validación de formato de email (Subida aquí para orden)
        $mensaje = "<p class='error'>Por favor introduce un email válido.</p>";

    } elseif (!validarNombreSinNumeros($nombre)) { 
        $mensaje = "<p class='error'>El nombre completo no debe contener números.</p>";
        
    } else {
        // 3. Guardado real en BD con hashing
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        try {
            $pdo = getDB();

            // Comprobar si el email ya existe
            $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
            $stmt->execute([$email]);

            if ($stmt->fetch()) {
                $mensaje = "<p class='error'>El email ya está registrado.</p>";
            } else {
                // Insertar el nuevo usuario
                $stmt = $pdo->prepare('INSERT INTO users (nombre, email, password) VALUES (?, ?, ?)');
                $stmt->execute([$nombre, $email, $password_hashed]);

                // 🚀 Éxito:
                $mensaje = "<p class='success'>¡Registro exitoso! Ya puedes <a href='login.php'>iniciar sesión</a>.</p>";
            }
        } catch (Exception $e) {
            if (defined('APP_DEBUG') && APP_DEBUG) {
                $mensaje = "<p class='error'>Error BD: " . htmlspecialchars($e->getMessage()) . "</p>";
            } else {
                $mensaje = "<p class='error'>Error al procesar el registro.</p>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/register.css">
    <script src="js/scripts.js" defer></script>
</head>
<body>
    <div class="auth-page">
        <main class="auth-container">
            <h2>Crear una Cuenta</h2>
            <?php echo $mensaje; // Mostrar mensajes ?>

        <form action="register.php" method="POST" id="registerForm" class="auth-form">
            
            <div class="form-group">
                <label for="nombre">Nombre Completo:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirmar Contraseña:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            
            <button type="submit" class="btn-primary">Registrarme</button>
        </form>

        <p class="switch-link">
            ¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a>
        </p>
    </main>
    </div>
</body>
</html>