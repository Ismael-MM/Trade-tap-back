<!DOCTYPE html>
<html>
<head>
    <title>Registrado correctamente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .content {
            padding: 20px 0;
        }
        .message {
            margin-bottom: 20px;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.8em;
            color: #666;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Registrado correctamente</h1>
        </div>
        <div class="content">
            <p>Estimado usuario,</p>
            <p>Su cuenta ha sido creada exitosamente.</p>
            <p>A continuación, encontrará los detalles de su registro:</p>
            <ul>
                <li><strong>Nombre de usuario:</strong> {{ $username }}</li>
                <li><strong>Correo electrónico:</strong> {{ $email }}</li>
            </ul>
            <p>Ahora puede iniciar sesión en su cuenta para acceder a nuestros servicios.</p>
            <p>Gracias por registrarse con nosotros.</p>
        </div>
        <div class="footer">
            <p>Atentamente,</p>
            <p>El equipo de TradeTap</p>
        </div>
    </div>
</body>
</html>