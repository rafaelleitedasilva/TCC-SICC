<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png')}}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
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
        @media (max-width: 950px) {
            .h-custom {
                height: 100%;
            }
            form{
                width: 100% !important;
            }
        }
        form{
            width: 50%;
        }
        body::-webkit-scrollbar{
            width: 0px;
        }
    </style>

    @if ($errors->any())
    <div class="alert position-absolute alert-danger alert-dismissible fade show mt-3 w-50" style="min-width:500px;margin-left:50px;" role="alert">
        <h4>Erro de Autenticação!</h4>
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    @if(Session::has('message'))
    <div class="alert position-absolute alert-success alert-dismissible fade show mt-3 w-50" style="min-width:500px;margin-left:50px;" role="alert">
        <h4><strong>{{ Session::get('title') }}</strong></h4>
        <p>{{ Session::get('message') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <section>
        <div class="d-flex align-items-center justify-content-center flex-wrap" style="height: 100vh;">
            
            <form action="{{route('login')}}" method="POST" class="d-block" style="max-width: 800px;padding:0px 20px;margin-top:-30px;">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <h1 class="display text-center m-5" style="font-family:Georgia;">Login - Sicc</h1>
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control w-100"
                    placeholder="Seu email aqui" required />
                    <label class="form-label" for="email">Endereço de Email</label>
                </div>

                {{-- <div class="visible-print text-center">
                    @php
                        echo(QrCode::size(100)->generate(route('abertura')));
                        QrCode::generate('Me transforme em um QrCode!');
                    @endphp
                    <p>Me escaneie para retornar à página principal</p>
                </div> --}}

                <div class="form-outline mb-4" id="Empresa">
                    
                </div>
                
                <script>
                    $('#Empresa').hide();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
                    $(function(){
                        $('#email').change(function(event){ 
                            event.preventDefault();

                            var value = $(this).val();
                            
                            $.ajax({
                                url:"{{ route('empresa') }}",
                                type: "GET",
                                data: {
                                    '_token': $('meta[name="csrf-token"]').attr('content'),
                                    'email': value,
                                },
                                dataType: 'json',
                                success: function(response){
                                    if(response.length > 1){
                                        $('#Empresa').show();
                                        $('#Empresa').append('<select class="btn btn-primary form-control text-left" id="EmpresaSelect" name="Empresa"></select>');
                                        $('#Empresa').append('<label class="form-label" for="EmpresaSelect"> Empresa </label>');
                                        console.log(response);
                                        $.each(response, function(k,v){
                                            $('#EmpresaSelect').append(`<option type="text" id="email" name="Empresa" class="form-control" value='${v[0]}'>${v[1]}</option`);
                                        })
                                        
                                    }else{
                                        $('#Empresa').hide();
                                        $('#Empresa').append(`<input type="text" id="email" name="Empresa" class="form-control" value='${response[0][0]}' hidden />`);
                                    }
                                }
                            });
                        })
                    })
                </script>
                
                <!-- Password input -->
                <div class="form-outline mb-3">
                    <input type="password" id="password" name="password" class="form-control"
                    placeholder="**********" required />
                    <svg style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg" id="olho"  width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                    </svg>
                    <label class="form-label" for="password">Senha</label>
                </div>
                
                <script>
                    let x = 0;
                    $( "#olho" ).click(function() {
                        if(x == 0){
                            $("#password").attr("type", "text");
                            x=1
                        }else{
                            $("#password").attr("type", "password");
                            x=0
                        }
                    });
                </script>
                <div class="d-flex w-100 justify-content-between">
                    <button class="btn btn-primary" type="submit"> Entrar </button>
                    <a href="{{ route('forget.password.get') }}">Esqueceu a senha?</a>
                </div>
                
            </form>
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" style="max-width:500px;" class='d-block w-100 m-0' alt="">
        </div>
        
    </section> l 
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>