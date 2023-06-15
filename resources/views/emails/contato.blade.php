<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333333;
        }

        p {
            margin-bottom: 10px;
        }

        .message {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #cccccc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Contato</h2>
        <p><strong>Nome:</strong> {{ $nome }}</p>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Assunto:</strong> {!! $assunto !!}</p>
        <p><strong>Mensagem:</strong></p>
        <div class="message">
            {!! $mensagem !!}
        </div>
    </div>
</body>
</html>
