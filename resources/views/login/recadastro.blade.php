<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png')}}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Redefinição</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body>
    <section>
        <div class="container-fluid h-custom w-50" style="min-width: 500px;">
            <h1 class="display text-center m-5">Redefinição</h1>
            <form action="{{route('reset.password.post')}}" method="POST" class="m-auto h-100">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"  />

                <div class="form-outline mb-4">
                <input type="text" name="token" value="{{ $token }}" class="form-control w-100" readonly>
                <label>Token</label>
                </div>

                <div class="form-outline mb-4"> 
                <input type="email" name="email" id="email" class="form-control w-100" value="" >
                <label for="email">Email</label>
                </div>


                <div class="form-outline mb-4" id="Empresa">
                    
                </div>

                <div class="form-outline mb-4">
                <input type="password" name='password'  id="password" class="form-control w-100" placeholder="**********" required>
                <label>Senha</label>
                <svg style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg" id="olho"  width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                </svg>
                </div>

                <div class="form-outline mb-4">
                <input type="password" name='password_confirmation' id="password1" class="form-control w-100" placeholder="**********" required>
                <label>Confirmação de Senha</label>
                <svg style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg" id="olho1"  width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                </svg>
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

                                        $.each(response, function(k,v){
                                            $('#EmpresaSelect').append(`<option type="text" id="email" name="Empresa" class="form-control" value='${v[0]}'>${v[1]}</option`);
                                        })
                                        
                                    }else{
                                        $('#Empresa').append(`<input type="text" id="email" name="Empresa" class="form-control" value='${response[0]}' />`);
                                    }
                                }
                            });
                        })
                    })
                </script>

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

                    let x1 = 0;
                    $( "#olho1" ).click(function() {
                        if(x == 0){
                            $("#password1").attr("type", "text");
                            x1=1
                        }else{
                            $("#password1").attr("type", "password");
                            x1=0
                        }
                    });
                </script>

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