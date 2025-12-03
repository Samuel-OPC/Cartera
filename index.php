<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inversiones & Riesgo</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body>

    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <span class="material-icons-outlined">show_chart</span>
                <h2>InvWest</h2>
            </div>
            <nav>
                <a href="#" class="active">
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
                <a href="configuracion.html">
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
                <h1>Resumen de Cartera de Inversión</h1>
                
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
                    <h3>Valor Total de Cartera</h3>
                    <p class="value">$1,250,400.00</p>
                    <span class="trend positive">+2.4% vs ayer</span>
                </div>
                <div class="card">
                    <h3>VaR (Value at Risk - 95%)</h3>
                    <p class="value danger">-$12,500.00</p>
                    <span class="subtitle">Exposición diaria máxima estimada</span>
                </div>
                <div class="card">
                    <h3>Ratio de Sharpe</h3>
                    <p class="value">1.85</p>
                    <span class="subtitle">Rendimiento ajustado al riesgo</span>
                </div>
                <div class="card">
                    <h3>Exposición en Derivados</h3>
                    <p class="value">$320,000.00</p>
                    <span class="trend neutral">25% de la cartera</span>
                </div>
            </section>

            <section class="content-grid">
                <div class="card large">
                    <div class="card-header">
                        <h3>Asignación de Activos</h3>
                    </div>
                    <div class="chart-placeholder">
                        <div class="bar-group">
                            <span>Renta Variable (Stocks)</span>
                            <div class="progress-bar"><div class="fill" style="width: 45%;"></div></div>
                            <span class="percent">45%</span>
                        </div>
                        <div class="bar-group">
                            <span>Bonos del Tesoro</span>
                            <div class="progress-bar"><div class="fill" style="width: 30%; background: #f1c40f;"></div></div>
                            <span class="percent">30%</span>
                        </div>
                        <div class="bar-group">
                            <span>Derivados (Futuros/Opciones)</span>
                            <div class="progress-bar"><div class="fill" style="width: 25%; background: #e74c3c;"></div></div>
                            <span class="percent">25%</span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Métricas de Sensibilidad (Griegas)</h3>
                    </div>
                    <ul class="risk-list">
                        <li>
                            <span>Delta (Sensibilidad Precio)</span>
                            <span class="risk-val">0.65</span>
                        </li>
                        <li>
                            <span>Gamma (Aceleración)</span>
                            <span class="risk-val">0.12</span>
                        </li>
                        <li>
                            <span>Vega (Volatilidad)</span>
                            <span class="risk-val">14.50</span>
                        </li>
                        <li>
                            <span>Theta (Tiempo)</span>
                            <span class="risk-val negative">-2.30</span>
                        </li>
                    </ul>
                </div>
            </section>

            <section class="positions-section">
                <h3>Posiciones Abiertas en Derivados</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Instrumento</th>
                                <th>Tipo</th>
                                <th>Vencimiento</th>
                                <th>Strike Price</th>
                                <th>Valor Mercado</th>
                                <th>P&L No realizado</th>
                                <th>Nivel de Riesgo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>SPX 500</td>
                                <td><span class="badge call">Call Option</span></td>
                                <td>15 Dic 2024</td>
                                <td>4500</td>
                                <td>$5,200</td>
                                <td class="positive">+$450.00</td>
                                <td><span class="dot yellow"></span> Medio</td>
                            </tr>
                            <tr>
                                <td>Crudo WTI</td>
                                <td><span class="badge future">Futuro</span></td>
                                <td>20 Ene 2025</td>
                                <td>--</td>
                                <td>$12,000</td>
                                <td class="negative">-$200.00</td>
                                <td><span class="dot red"></span> Alto</td>
                            </tr>
                            <tr>
                                <td>TSLA</td>
                                <td><span class="badge put">Put Option</span></td>
                                <td>01 Dic 2024</td>
                                <td>210</td>
                                <td>$1,800</td>
                                <td class="positive">+$120.00</td>
                                <td><span class="dot green"></span> Bajo</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

        </main>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleButton = document.getElementById('mode-toggle');
        const body = document.body;
        const icon = toggleButton.querySelector('span');
        const logoutButton = document.getElementById('logout-btn');

        // --- Lógica de Seguridad (Login Check) ---
        const isLoggedIn = localStorage.getItem('isLoggedIn');
        if (isLoggedIn !== 'true') {
            window.location.href = 'login.html';
            return; 
        }

        // --- Lógica de Modo Oscuro ---
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

        // Evento para el botón de Modo Oscuro
        toggleButton.addEventListener('click', toggleDarkMode);

        // --- Lógica de Cerrar Sesión ---
        logoutButton.addEventListener('click', (e) => {
            e.preventDefault();
            localStorage.removeItem('isLoggedIn'); // Eliminar estado de sesión
            window.location.href = 'login.html';
        });
    });
</script>
</body>
</html>