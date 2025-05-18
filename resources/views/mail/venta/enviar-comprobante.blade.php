<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background: #007BFF;
            color: #fff;
            padding: 20px;
            text-align: center;
            font-size: 24px;
        }

        .email-body {
            padding: 20px;
        }

        .email-body p {
            margin: 10px 0;
        }

        .email-footer {
            background: #f4f4f4;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #777;
            border-top: 1px solid #ddd;
        }

        .email-footer a {
            color: #007BFF;
            text-decoration: none;
        }

        .email-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            ¡Hola {{$venta->cliente->persona->razon_social}}!
        </div>
        <div class="email-body">
            <p>Hacemos envío del comprobante de Venta.</p>
            <p>Que tenga un buen día.</p>
        </div>
        <div class="email-footer">
            <p>No responder a este correo</a></p>
            <p>&copy; 2025 SK DEV. Todos los derechos reservados.</p>
        </div>
    </div>
</body>

</html>