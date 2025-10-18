<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <script>
    const base_url = '<?php echo BASE_URL; ?>';
    const base_url_server = '<?php echo BASE_URL_SERVER; ?>';
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #7c3aed 0%, #6366f1 50%, #3b82f6 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        .container {
            position: relative;
            z-index: 10;
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: white;
            padding: 48px 40px;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 420px;
        }

        .login-box h1 {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 32px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            font-size: 14px;
            background: #f9fafb;
            transition: all 0.3s ease;
            color: #1f2937;
        }

        .form-group input::placeholder {
            color: #9ca3af;
        }

        .form-group input:focus {
            outline: none;
            border-color: #7c3aed;
            background: white;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #7c3aed 0%, #6366f1 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(124, 58, 237, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Olas animadas */
        .waves {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 120px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"><path d="M0,60 Q300,0 600,60 T1200,60 L1200,120 L0,120 Z" fill="%23rgba(99,102,241,0.3)" opacity="0.7"/></svg>');
            background-repeat: repeat-x;
            background-size: 600px 120px;
            animation: wave 15s linear infinite;
            z-index: 1;
        }

        .waves:nth-child(2) {
            bottom: 10px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"><path d="M0,60 Q300,30 600,60 T1200,60 L1200,120 L0,120 Z" fill="%23rgba(99,102,241,0.5)" opacity="0.5"/></svg>');
            background-size: 600px 120px;
            animation: wave2 10s linear infinite reverse;
        }

        .waves:nth-child(3) {
            bottom: 20px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"><path d="M0,60 Q300,40 600,60 T1200,60 L1200,120 L0,120 Z" fill="%23rgba(99,102,241,0.3)" opacity="0.3"/></svg>');
            background-size: 600px 120px;
            animation: wave 20s linear infinite;
        }

        @keyframes wave {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 600px 0;
            }
        }

        @keyframes wave2 {
            0% {
                background-position: 600px 0;
            }
            100% {
                background-position: 0 0;
            }
        }

        @media (max-width: 480px) {
            .login-box {
                margin: 16px;
                padding: 32px 24px;
            }

            .login-box h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h1>Iniciar sesión</h1>
            <form id="frm_login">
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario" placeholder="Ingrese usuario" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Ingrese contraseña" required>
                </div>
                <button type="submit" class="btn-login">Entrar</button>
            </form>
        </div>
    </div>

    <div class="waves"></div>
    <div class="waves"></div>
    <div class="waves"></div>
</body>
<script src="<?php echo BASE_URL; ?>src/view/js/sesion.js"></script>
<!-- Sweet Alerts Js-->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>