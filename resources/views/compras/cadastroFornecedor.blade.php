@extends('template.principal')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Cadastro de Fornecedor</h2>
    </div>
</div>

<section>
    <div class="container-fluid h-custom">
        
        <div class="row d-flex justify-content-center align-Items-center h-100">
            
            <div class="col mt-3">
                
                <form action="{{route('cadastro_fornecedor')}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    
                    <!-- Nome input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="Nome"><Strong>Nome do Fornecedor</Strong></label>
                        <input type="text" id="Nome" name="Nome" class="form-control form-control-lg" require
                        />
                    </div>
                    
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="email"><strong>Email</strong></label>
                        <textarea type="email" id="email" placeholder="Coloque o email de contato da empresa"  name="email" class="form-control form-control-lg"
                        require></textarea>
                    </div>

                    {{-- Telefone Input --}}
                    <div class="form-outline mb-4">
                        <label class="form-label" for="telefone"><strong>Telefone</strong></label>
                        <textarea id="telefone" placeholder="Coloque todos os telefones da empresa"  name="telefone" class="form-control form-control-lg"
                        require></textarea>
                    </div>
                    
                    <!-- Localização input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="Contatos"><strong>Localização</strong></label>
                        <input type="text" id="local" name='Local' placeholder="Local da Empresa"  class="form-control form-control-lg" require
                        />
                    </div>
                    
                    <!-- Descrição input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="descricao"><strong>Descrição</strong></label>
                        <textarea type="text" id="descricao" placeholder="Descrição do fornecedor..." maxlength='2000'  name="Descricao" class="form-control form-control-lg"
                        ></textarea>
                    </div>

                    <!-- Serviço input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="Servico"><strong>Serviço</strong></label>
                        <input type="text" id="Servico" name='Servico' placeholder="Tipo de Serviço" class="form-control form-control-lg" require/>
                    </div>
                    
                    @if(Auth()->user()->Empresa != 'Administrador Sicc')
                    <input type="text" name="Empresa" value="{{Auth()->user()->Empresa}}" hidden>
                    @else
                    <div class="form-outline mb-3">
                        <input type="text" name="Empresa" value="" class="form-control form-control-lg" placeholder="Coloque o Nome da Empresa">
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