
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESERVAS - Panel de Control</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <script>
        const base_url = '<?php echo BASE_URL; ?>';
        const base_url_server = '<?php echo BASE_URL_SERVER; ?>';
        const session_session = '<?php echo $_SESSION['sesion_id']; ?>';
        const token_token = '<?php echo $_SESSION['sesion_token']; ?>';
    </script>
    <style>
        /* ==================== HEADER Y SIDEBAR ==================== */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f5f7fa;
        }

        header {
            display: flex;
            flex-grow: 1;
        }

        .sidebar {
            width: 200px;
            background: #1a1f3a;
            padding: 24px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar-logo {
            padding: 0 20px 32px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
            font-weight: 700;
            font-size: 18px;
            border-bottom: 1px solid #2d3456;
            margin-bottom: 24px;
        }

        .logo-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #6366f1, #3b82f6);
            border-radius: 8px;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: #9ca3af;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            font-size: 14px;
        }

        .sidebar-nav a.active {
            background: rgba(99, 102, 241, 0.15);
            color: white;
            border-left-color: #6366f1;
        }

        .sidebar-nav a:hover {
            background: rgba(99, 102, 241, 0.1);
            color: white;
        }

        .top-bar {
            position: fixed;
            top: 0;
            left: 200px;
            right: 0;
            height: 70px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 32px;
            z-index: 999;
        }

        .top-bar-title {
            font-size: 16px;
            font-weight: 600;
            color: #6b7280;
            letter-spacing: 0.5px;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #1f2937;
            font-weight: 500;
        }

        .admin-icon {
            width: 24px;
            height: 24px;
            background: linear-gradient(135deg, #6366f1, #3b82f6);
            border-radius: 50%;
        }
        /* ==================== FOOTER ==================== */
        footer {
            background: #1a1f3a;
            color: #9ca3af;
            padding: 24px 32px;
            margin-left: 200px;
            border-top: 1px solid #2d3456;
            font-size: 13px;
            text-align: center;
        }

        footer a {
            color: #6366f1;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        footer a:hover {
            color: #818cf8;
        }

        /* ==================== MODAL PERSONALIZADO ==================== */
        .modal-header {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .form-label {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
        }

        .btn-primary-gradient {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border: none;
            font-weight: 600;
        }

        .btn-primary-gradient:hover {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
        }

        /* ==================== RESPONSIVE ==================== */
        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
                padding: 16px 0;
            }
            /* ==================== CONTENIDO PRINCIPAL ==================== */
.main-content {
    margin-left: 200px; /* deja espacio para el sidebar */
    padding: 90px 30px 30px; /* espacio para la barra superior y los lados */
    flex-grow: 1;
    background-color: #f9fafb;
    min-height: 100vh;
}


            .sidebar-logo {
                padding: 0;
                justify-content: center;
                margin-bottom: 16px;
                border-bottom: none;
                font-size: 0;
            }

            .logo-icon {
                width: 28px;
                height: 28px;
            }

            .sidebar-nav a span:last-child {
                display: none;
            }

            .top-bar {
                left: 60px;
            }

            section {
                margin-left: 60px;
            }

            footer {
                margin-left: 60px;
            }
        }
    </style>
    
</head>
<body>
    <!-- HEADER CON SIDEBAR Y TOP BAR -->
     <?php 
        $view = explode("/", $_GET['views'] ?? '')[0];

        switch ($view) {
            case 'reservas':
                $reserva = 'active';
                break;
            case 'usuarios':
                $usuario = 'active';
                break;
            case 'clients-api':
                $client = 'active';
                break;
/*             case 'tokens-api':
                $token = 'active';
                break; */
            case '': // El caso por defecto es la página de inicio
            default:
                $home = 'active';
                break;
        }
        ?>
    <header>
        <aside class="sidebar">
            <div class="sidebar-logo">
                <div class="logo-icon"></div>
                <span>RESERVAS</span>
            </div>
            <nav class="sidebar-nav">
                <a href="<?php echo BASE_URL;?>" class="<?php echo $home?>">
                    <span>📊</span>
                    <span>Dashboard</span>
                </a>
                <a href="<?php echo BASE_URL;?>reservas" class="<?php echo $reserva?>">
                    <span>📅</span>
                    <span>Reservas</span>
                </a>
                <a href="<?php echo BASE_URL;?>usuarios" class="<?php echo $usuario?>">
                    <span>👥</span>
                    <span>Usuarios</span>
                </a>
                <a href="<?php echo BASE_URL;?>clients-api" class="<?php echo $client?>">
                    <span>🔌</span>
                    <span>Clientes API</span>
                </a>
                 </a>
               <a href="<?php echo BASE_URL;?>token" class="<?php echo $client?>">
                 <i class="bi bi-key"></i>
                <span>Tokens API</span>
                </a>

<!--                 <a href="">
                    <span>🔑</span>
                    <span>Tokens API</span>
                </a> -->
                <a href="#">
                    <span>🚪</span>
                    <span onclick="cerrar_sesion();" >Salir</span>
                </a>
            </nav>
        </aside>

        <div class="top-bar">
            <h2 class="top-bar-title">RESERVAS DE HOTEL · Panel</h2>
            <div class="admin-profile">
                <div class="admin-icon"></div>
                <span><?php echo  $_SESSION['sesion_usuario_nom'] ?></span>
            </div>
        </div>
    </header>