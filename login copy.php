<?php
// ==========================================================
// SECCIÓN 1: LÓGICA DE PROCESAMIENTO PHP (Backend)
// ==========================================================

// 1. INICIO DE SESIÓN
session_start(); 
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

// 2. INICIALIZACIÓN DE VARIABLES
$mensaje = ''; // Para mostrar mensajes de error/éxito
$email = ''; // Para mantener el valor del campo si hay error
$password = '';

// 3. PROCESAMIENTO DEL FORMULARIO
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // --- Recolección y Limpieza de Datos ---
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // --- Validación de Campos Vacíos ---
    if (empty($email) || empty($password)) {
        $mensaje = "<p class='error'>Todos los campos son obligatorios.</p>";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "<p class='error'>Por favor introduce un email válido.</p>";

    } else {
        // --- VALIDACIÓN REAL CONTRA LA BASE DE DATOS (BD) ---
        try {
            $pdo = getDB();
            // Asegúrate de seleccionar el 'email' en tu consulta SQL. (Ya lo estás haciendo ✅)
            $stmt = $pdo->prepare('SELECT id, nombre, email, password FROM users WHERE email = ? LIMIT 1');
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                // Credenciales correctas: iniciar sesión
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['nombre'];
                
                // 💡 CORRECCIÓN CLAVE: Guardar el email en la sesión
                $_SESSION['email'] = $user['email']; 
                
                header('Location: dashboard.php');
                exit;
            } else {
                $mensaje = "<p class='error'>Email o contraseña incorrectos.</p>";
            }
        } catch (Exception $e) {
            if (defined('APP_DEBUG') && APP_DEBUG) {
                $mensaje = "<p class='error'>Error BD: " . htmlspecialchars($e->getMessage()) . "</p>";
            } else {
                $mensaje = "<p class='error'>Error al verificar credenciales.</p>";
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
    <title>Iniciar Sesión - Gestión de Proyectos</title>
    <link rel="stylesheet" href="styles/main.css">
    <script src="js/scripts.js" defer></script>
</head>
<body>
    <link rel="stylesheet" href="styles/login.css">

    <main class="auth-container">
        <h2>Iniciar Sesión</h2>
        
        <?php echo $mensaje; ?>
        
        <form action="login.php" method="POST" id="loginForm">
            <div class="form-group">
                <label for="email">Email:</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="<?php echo htmlspecialchars($email); ?>" 
                    required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="button primary">Entrar</button>
        </form>
        
        <p class="switch-link">
            ¿No tienes cuenta? <a href="register.php">Regístrate aquí</a>
        </p>
    </main>
</body>
</html>