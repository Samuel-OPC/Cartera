<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Usuario - InvWest</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body>

    <div class="container">
        <aside class="sidebar">
            <button id="sidebar-toggle-desktop" class="sidebar-toggle-btn" aria-label="Colapsar menú">
                <span class="material-icons-outlined">chevron_left</span>
            </button>
            
            <div class="logo">
                <span class="material-icons-outlined">show_chart</span>
                <h2>InvWest</h2>
            </div>
            <nav>
                <a href="index.html">
                    <span class="material-icons-outlined">dashboard</span>
                    Panel General
                </a>
                <a href="cartera.html">
                    <span class="material-icons-outlined">pie_chart</span>
                    Cartera
                </a>
                <a href="riesgo.html">
                    <span class="material-icons-outlined">warning</span>
                    Análisis de Riesgo
                </a>
                <a href="derivados.html">
                    <span class="material-icons-outlined">functions</span>
                    Derivados (Opciones)
                </a>
                <a href="#" class="active">
                    <span class="material-icons-outlined">settings</span>
                    Configuración
                </a>
                <a href="#" id="logout-btn" style="margin-top: auto;">
                    <span class="material-icons-outlined">logout</span>
                    Cerrar Sesión
                </a>
            </nav>
        </aside>
        <main class="main-content">
            <header>
                <h1>Configuración y Preferencias de Usuario</h1>
                
                <div class="theme-switch">
                    <button id="mode-toggle" aria-label="Cambiar tema a oscuro/claro">
                        <span class="material-icons-outlined">dark_mode</span>
                    </button>
                </div>
                
                <div class="user-profile">
                    <span>Admin: Carlos R.</span>
                    <div class="avatar">CR</div>
                </div>
            </header>

            <section class="content-grid" style="grid-template-columns: 1fr;">
                
                <div class="card large">
                    <div class="card-header">
                        <h3>🔒 Seguridad de la Cuenta</h3>
                    </div>
                    <form class="config-form">
                        <div class="form-group">
                            <label for="old-password">Contraseña Actual:</label>
                            <input type="password" id="old-password" name="old-password" placeholder="Ingresa tu contraseña actual">
                        </div>
                        <div class="form-group">
                            <label for="new-password">Nueva Contraseña:</label>
                            <input type="password" id="new-password" name="new-password" placeholder="Ingresa nueva contraseña (mín. 8 caracteres)">
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirmar Nueva Contraseña:</label>
                            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirma la nueva contraseña">
                        </div>
                        <button type="submit" class="login-btn" style="width: auto; margin-top: 15px; background-color: var(--success);">Guardar Contraseña</button>
                    </form>
                </div>
                
                <div class="card large">
                    <div class="card-header">
                        <h3>🔔 Notificaciones y Alertas</h3>
                    </div>
                    <form class="config-form">
                        <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
                            <label for="risk-alerts">Alertas de Exceso de Riesgo (VaR):</label>
                            <input type="checkbox" id="risk-alerts" name="risk-alerts" checked style="width: auto; height: 20px;">
                        </div>
                        <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
                            <label for="trade-confirmation">Confirmación de Operaciones:</label>
                            <input type="checkbox" id="trade-confirmation" name="trade-confirmation" checked style="width: auto; height: 20px;">
                        </div>
                        <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
                            <label for="market-news">Noticias Relevantes del Mercado (Diario):</label>
                            <input type="checkbox" id="market-news" name="market-news" style="width: auto; height: 20px;">
                        </div>
                        <button type="submit" class="login-btn" style="width: auto; margin-top: 15px; background-color: var(--accent-color);">Guardar Preferencias</button>
                    </form>
                </div>
                
            </section>

        </main>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Conexiones de Elementos
        const toggleButton = document.getElementById('mode-toggle');
        const sidebarToggleButton = document.getElementById('sidebar-toggle-desktop'); 
        const container = document.querySelector('.container');
        const sidebar = document.querySelector('.sidebar');
        const body = document.body;
        const icon = toggleButton.querySelector('span');
        const logoutButton = document.getElementById('logout-btn');

        // --- 1. Lógica de Seguridad (Login Check) ---
        const isLoggedIn = localStorage.getItem('isLoggedIn');
        if (isLoggedIn !== 'true') {
            window.location.href = 'login.html';
            return; 
        }
        
        // --- 2. Lógica del Menú Colapsable/Retráctil ---
        function updateSidebarState() {
            const isCollapsed = container.classList.contains('collapsed');
            
            // Guarda el estado en localStorage (solo si es escritorio)
            if (window.innerWidth > 768) {
                localStorage.setItem('sidebarCollapsed', isCollapsed ? 'true' : 'false');
            }
            
            // Cambia el ícono del botón para indicar la acción contraria (si está colapsado, muestra 'expandir')
            if (isCollapsed) {
                sidebarToggleButton.querySelector('span').textContent = (window.innerWidth <= 768) ? 'close' : 'chevron_right';
            } else {
                sidebarToggleButton.querySelector('span').textContent = (window.innerWidth <= 768) ? 'menu' : 'chevron_left';
            }
        }

        // Manejar el clic del botón
        sidebarToggleButton.addEventListener('click', () => {
            container.classList.toggle('collapsed');
            updateSidebarState();
        });

        // Cargar estado al inicio y manejar el redimensionamiento
        function loadAndApplyState() {
            if (window.innerWidth > 768) {
                // Modo Escritorio: Cargar estado guardado (colapsado o expandido)
                const savedCollapsed = localStorage.getItem('sidebarCollapsed');
                if (savedCollapsed === 'true') {
                     container.classList.add('collapsed');
                } else {
                     container.classList.remove('collapsed');
                }
            } else {
                // Modo Móvil: Por defecto NO está colapsado (es decir, está oculto)
                container.classList.remove('collapsed');
            }
            updateSidebarState();
        }

        loadAndApplyState();
        window.addEventListener('resize', loadAndApplyState);


        // --- 3. Lógica de Modo Oscuro ---
        function applyDarkModeState() {
            if (body.classList.contains('dark-mode')) {
                icon.textContent = 'light_mode'; 
                toggleButton.setAttribute('aria-label', 'Cambiar tema a claro');
            } else {
                icon.textContent = 'dark_mode'; 
                toggleButton.setAttribute('aria-label', 'Cambiar tema a oscuro');
            }
        }

        function toggleDarkMode() {
            body.classList.toggle('dark-mode');
            applyDarkModeState();
            localStorage.setItem('darkMode', body.classList.contains('dark-mode') ? 'enabled' : 'disabled');
        }

        // Cargar Modo Oscuro al inicio
        const savedMode = localStorage.getItem('darkMode');
        if (savedMode === 'enabled') {
            body.classList.add('dark-mode');
        } else if (savedMode === null && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            body.classList.add('dark-mode');
        }
        applyDarkModeState(); 
        toggleButton.addEventListener('click', toggleDarkMode);

        // --- 4. Lógica de Cerrar Sesión ---
        logoutButton.addEventListener('click', (e) => {
            e.preventDefault();
            localStorage.removeItem('isLoggedIn'); 
            localStorage.removeItem('sidebarCollapsed'); 
            window.location.href = 'login.html';
        });

        // --- 5. Lógica Específica de Configuración (Ejemplo) ---
        // Este es solo un ejemplo para que los formularios no recarguen la página
        const configForms = document.querySelectorAll('.config-form');
        configForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Ajustes guardados correctamente (Simulación).');
                // Aquí se agregaría la lógica real de guardado de datos.
            });
        });
    });
</script>
</body>
</html>