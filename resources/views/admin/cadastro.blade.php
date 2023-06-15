@extends('template.principal')
@section('content')
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

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Cadastro de Usuários</h2>
        
    </div>
    <div class="col-lg-2">
        
    </div>
</div>

<section>
    
    <div class="container-fluid h-custom">
        
        <div class="row d-flex justify-content-center align-items-center h-100">
            
            <div class="col mt-3">
                
                <form action="{{route('cadastro_login')}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    
                    <!-- Nome input -->
                    <div class="form-outline mb-3">
                        <input type="text" id="nome" name="nome"  class="form-control form-control-lg"
                        placeholder="..." />
                        <label class="form-label" for="nome">Nome</label>
                    </div>
                    
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="email"  name="email" class="form-control form-control-lg"
                        placeholder="..." />
                        <label class="form-label" for="email">Endereço de Email</label>
                    </div>
                    
                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <input type="password" id="password" name="password"  class="form-control form-control-lg"
                        placeholder="..." />
                        <svg style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg" id="olho"  width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                        </svg>
                        <label class="form-label" for="password">Senha</label>
                    </div>

                    <script>
                        $( "#olho" ).mousedown(function() {
                            $("#password").attr("type", "text");
                        });
                        
                        $( "#olho" ).mouseup(function() {
                            $("#password").attr("type", "password");
                        });
                    </script>
                    
                    <!-- Acesso select -->
                    <div class="form-outline mb-3">
                        <select type="acesso" id="acesso" name="acesso"  class="form-control form-control-lg">
                            <option value="admin">Administrativo</option>
                            <option value="Manutenção">Manutenção</option>
                            <option value="Compras">Compras</option>
                            <option value="Geral">Geral</option>
                        </select>
                        <label class="form-label" for="acesso">Acesso</label>
                    </div>
                    @if(Auth()->user()->Empresa != 1)
                    <input type="text" name="Empresa" value="{{Auth()->user()->Empresa}}" hidden>
                    @else
                    <div class="form-outline mb-3">
                        <input type="text" name="Empresa" value="" class="form-control form-control-lg" placeholder="Coloque o nome da Empresa">
                        <label class="form-label" for="Empresa">Empresa</label>
                    </div>
                    @endif
                    <div class="d-flex w-100 justify-content-start pt-4">
                        <button class="btn btn-primary" type="submit"> Cadastrar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection