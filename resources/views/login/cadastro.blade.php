<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>
<style>
.divider:after,
.divider:before {
    content: "";
    flex: 1;
    height: 1px;
    background: #eee;
}
.h-custom {
    height: calc(100% - 73px);
}
@media (max-width: 450px) {
    .h-custom {
        height: 100%;
    }
}
</style>

@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
@endif

<section class="vh-100">

<div class="container-fluid h-custom">

<div class="row d-flex justify-content-center align-items-center h-100">

<div class="col-lg-6 offset-xl-1">

<form action="{{route('cadastro_login')}}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<h1 class="display">Cadastro</h1>

<!-- Nome input -->
<div class="form-outline mb-3">
<input type="text" id="nome" name="nome" style="text-align: right;" class="form-control form-control-lg"
placeholder="Coloque um nome para o usuário" />
<label class="form-label" for="nome">Nome</label>
</div>

<!-- Email input -->
<div class="form-outline mb-4">
<input type="email" id="email" style="text-align: right;" name="email" class="form-control form-control-lg"
placeholder="Coloque um Email válido" />
<label class="form-label" for="email">Endereço de Email</label>
</div>

<!-- Password input -->
<div class="form-outline mb-3">
<input type="password" id="password" name="password" style="text-align: right;" class="form-control form-control-lg"
placeholder="Coloque uma Senha válida" />
<label class="form-label" for="password">Senha</label>
</div>

<!-- Acesso select -->
<div class="form-outline mb-3">
<select type="acesso" id="acesso" name="acesso" style="text-align: right;" class="form-control form-control-lg">
<option value="admin">Administrativo</option>
<option value="Manutenção">Manutenção</option>
<option value="Compras">Compras</option>
<option value="Geral">Geral</option>
</select>
<label class="form-label" for="acesso">Acesso</label>
</div>



<div class="d-flex w-100 justify-content-start pt-4">
<button class="btn btn-primary" type="submit"> Cadastrar </button>
</div>

</form>

</div>

</div>

</div>

</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>