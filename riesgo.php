<?php require_once __DIR__ . '/auth.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="styles.css">
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
                <a href="#" class="active">
                    <span class="material-icons-outlined">warning</span>
                    Análisis de Riesgo
                </a>
                <a href="derivados.html">
                    <span class="material-icons-outlined">functions</span>
                    Derivados (Opciones)
                </a>
                <a href="configuracion.html">
                    <span class="material-icons-outlined">settings</span>
                    Configuración
                </a>
                </a>
                <a href="#" id="logout-btn" style="margin-top: auto;">
                    <span class="material-icons-outlined">logout</span>
                    Cerrar Sesión
                </a>
            </nav>
        </aside>
        <main class="main-content">
            <header>
                <h1>Monitoreo y Métricas de Riesgo</h1>
                
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

            <section class="kpi-grid">
                <div class="card">
                    <h3>VaR (Value at Risk - 99%)</h3>
                    <p class="value danger">-$24,100.00</p>
                    <span class="subtitle">Pérdida máxima esperada (Horizonte 1 día)</span>
                </div>
                <div class="card">
                    <h3>Volatilidad Histórica (Anualizada)</h3>
                    <p class="value warning">18.5%</p>
                    <span class="subtitle">Medición del riesgo total de la cartera</span>
                </div>
                <div class="card">
                    <h3>Exposición Beta (Mercado)</h3>
                    <p class="value">1.15</p>
                    <span class="subtitle">Sensibilidad de la cartera vs. S&P 500</span>
                </div>
                <div class="card">
                    <h3>Expected Shortfall (ES)</h3>
                    <p class="value danger">-$31,800.00</p>
                    <span class="subtitle">Pérdida promedio en los peores casos (99%)</span>
                </div>
            </section>

            <section class="content-grid">
                <div class="card large">
                    <div class="card-header">
                        <h3>Análisis de Escenarios (Stress Tests)</h3>
                    </div>
                    <div class="chart-placeholder">
                        <ul class="risk-list">
                            <li>
                                <span>Crisis 2008 (Lehman Shock)</span>
                                <span class="risk-val negative">Pérdida Estimada: -$85,000.00</span>
                            </li>
                            <li>
                                <span>Subida Agresiva de Tipos de Interés (+1.5%)</span>
                                <span class="risk-val negative">Pérdida Estimada: -$22,500.00</span>
                            </li>
                            <li>
                                <span>Caída de Mercados Emergentes (-20%)</span>
                                <span class="risk-val negative">Pérdida Estimada: -$15,100.00</span>
                            </li>
                            <li>
                                <span>Burbuja Tecnológica (Crash NASDAQ)</span>
                                <span class="risk-val negative">Pérdida Estimada: -$55,000.00</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Límites de Riesgo Asignados</h3>
                    </div>
                    <div class="chart-placeholder">
                         <div class="bar-group">
                            <span>Límite de VaR Diario ($25k)</span>
                            <div class="progress-bar"><div class="fill" style="width: 96%; background: var(--danger);"></div></div>
                            <span class="percent danger">96.4% Utilizado</span>
                        </div>
                        <div class="bar-group">
                            <span>Límite de Volatilidad (20%)</span>
                            <div class="progress-bar"><div class="fill" style="width: 92%; background: var(--warning);"></div></div>
                            <span class="percent warning">92.5% Utilizado</span>
                        </div>
                        <div class="bar-group">
                            <span>Concentración Sectorial (Max 40%)</span>
                            <div class="progress-bar"><div class="fill" style="width: 35%; background: var(--success);"></div></div>
                            <span class="percent">35% Utilizado</span>
                        </div>
                    </div>
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
    });
</script>
</body>
</html>