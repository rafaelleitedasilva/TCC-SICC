<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png')}}" type="image/x-icon">
    <title>Esqueceu a senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body>
    @if(Session::has('message'))
    <div class="alert {{ Session::get('alert-class') }} alert-success alert-dismissible d-block m-auto fade show w-50" style="z-index:3000;margin-top:20px;" role="alert">
        <h4><strong>{{ Session::get('title') }}</strong></h4>
        <p>{{ Session::get('message') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <section>
        <div class="container-fluid h-custom w-50" style="min-width: 500px;">
            <h1 class="display text-center m-5">Redefinição</h1>
            <p class="text-center m-5">Será enviado um email de redefinição de senha, caso o email cadastrado não seja válido contate o administrador da sua empresa.</p>
            <form action="{{route('forget.password.post')}}" method="POST" class="m-auto h-100">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"  />

                <input type="email" name='email' class="form-control w-100" placeholder="Email de acesso" required>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary mt-5" type="submit"> Enviar </button>
                </div>

            </form>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>