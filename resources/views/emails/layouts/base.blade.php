<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        body {
          font-family: Arial, sans-serif;
          line-height: 1.6;
          color: #333333;
          margin: 0;
          padding: 0;
        }
        .container {
          max-width: 600px;
          margin: 0 auto;
          padding: 20px;
        }
        .header {
          background-image: url('https://backsvp.sena.edu.co/images/header.jpg');
          color: #002d4d;
          padding: 8px;
          text-align: center;
          border-top-left-radius: 1px;
          border-top-right-radius: 1px;
          background-size: contain;
          background-repeat: no-repeat;
          min-height: 80px;
        }
        .header-logo {
          max-width: 150px;
          height: auto;
          margin-bottom: 15px;
        }
        .content {
          padding: 20px;
          background-color: #f9f9f9;
        }
        .ticket-info {
          background-color: white;
          border-left: 4px solid #3498db;
          padding: 15px;
          margin-bottom: 20px;
          box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .ticket-number {
          font-size: 18px;
          font-weight: bold;
          color: #002d4d;
        }
        .ticket-status {
          display: inline-block;
          background-color: #3498db;
          color: white;
          padding: 5px 10px;
          border-radius: 4px;
          font-weight: bold;
        }
        .ticket-detail {
          margin: 10px 0;
        }
        .footer {
          text-align: center;
          padding: 20px;
          font-size: 12px;
          color: #666666;
          border-top: 3px solid #39a900;
          background-color: #f2f2f2;
          border-bottom-left-radius: 5px;
          border-bottom-right-radius: 5px;
        }
        .footer-content {
          display: table;
          width: 100%;
          table-layout: fixed;
        }
        .footer-left {
          display: table-cell;
          vertical-align: middle;
          text-align: center;
          padding-right: 15px;
        }
        .footer-right {
          display: table-cell;
          vertical-align: middle;
          text-align: left;
        }
        .footer-logo {
          max-width: 60px;
          height: auto;
          margin-right: 30px;
        }
        .svp-logo {
          max-width: 100px;
          height: auto;
        }
        .highlight {
          color: #39a900;
          font-weight: bold;
        }
        .action-button {
          display: inline-block;
          background-color: #39a900;
          color: white;
          text-decoration: none;
          padding: 10px 20px;
          border-radius: 4px;
          margin: 20px 0;
          font-weight: bold;
          text-align: center;
        }
        .question-box {
          background-color: #e8f4fc;
          border: 1px solid #bde0f3;
          border-radius: 5px;
          padding: 15px;
          margin: 15px 0;
        }
        .question-title {
          font-weight: bold;
          color: #002d4d;
          margin-bottom: 10px;
        }
        .question-list {
          margin-left: 20px;
          padding-left: 15px;
        }
        .question-list li {
          margin-bottom: 8px;
        }
        .warning {
          color: #d35400;
          font-weight: bold;
        }
        .divider {
          border-top: 1px solid #ddd;
          margin: 20px 0;
        }
        .notification-text {
          font-style: italic;
          color: #777;
          font-size: 11px;
          margin-top: 15px;
          text-align: center;
        }
        .countdown {
          background-color: #f9e7c9;
          border: 1px solid #f5d6a8;
          border-radius: 4px;
          padding: 10px;
          margin: 15px 0;
          text-align: center;
          font-weight: bold;
          color: #d35400;
        }
        .titleTicket {
          text-align: center;
          color: #002d4d;
        }
      </style>
</head>
<body>
    <div class="container">
        
        {{-- Encabezado --}}
        <div class="header">
        </div>

        {{-- Contenido Dinámico --}}
        <div class="content">
            @yield('content') 
        </div>

        {{-- Pie de Página --}}
        <div class="footer">
            <div class="footer-content">
                <div class="footer-left">
                    <img src="https://backsvp.sena.edu.co/images/logo.png" alt="SVP Logo" class="footer-logo">
                    <img src="https://backsvp.sena.edu.co/images/logos_SVP_nuevo.webp" alt="SENA Logo" class="svp-logo">
                </div>
                <div class="footer-right">
                    <p><strong>SVP Soporte</strong><br>
                    Servicio Nacional de Aprendizaje SENA<br>
                    Este es un correo automático generado por el sistema.</p>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
