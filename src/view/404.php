<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página No Encontrada - 404</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            overflow: hidden;
        }

        .container {
            text-align: center;
            padding: 2rem;
            max-width: 600px;
        }

        .error-code {
            font-size: 12rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 1rem;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .error-message {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .error-description {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            line-height: 1.6;
            opacity: 0.9;
        }

        .home-button {
            display: inline-block;
            padding: 12px 32px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .home-button:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .home-button:active {
            transform: translateY(0);
        }

        .astronaut {
            position: absolute;
            top: 20%;
            left: 10%;
            font-size: 3rem;
            animation: float 6s ease-in-out infinite;
        }

        .rocket {
            position: absolute;
            bottom: 15%;
            right: 10%;
            font-size: 2.5rem;
            animation: float 8s ease-in-out infinite 1s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        @media (max-width: 768px) {
            .error-code {
                font-size: 8rem;
            }
            
            .error-message {
                font-size: 2rem;
            }
            
            .error-description {
                font-size: 1rem;
            }
            
            .astronaut, .rocket {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .error-code {
                font-size: 6rem;
            }
            
            .error-message {
                font-size: 1.5rem;
            }
            
            .astronaut {
                left: 5%;
                top: 15%;
            }
            
            .rocket {
                right: 5%;
                bottom: 10%;
            }
        }
    </style>
</head>
<body>
    <div class="astronaut">👨‍🚀</div>
    <div class="rocket">🚀</div>
    
    <div class="container">
        <div class="error-code">404</div>
        <h1 class="error-message">¡Ups! Página no encontrada</h1>
        <p class="error-description">
            Lo sentimos, pero la página que estás buscando no existe o ha sido movida. 
            No te preocupes, puedes regresar al inicio y explorar desde allí.
        </p>
        <a href="<?php echo BASE_URL;?>" class="home-button">Volver al Inicio</a>
    </div>
</body>
</html>

