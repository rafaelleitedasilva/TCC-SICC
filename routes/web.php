<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\{
    LoginController,
    ChamadoController,
    AdminController,
    ComprasController,
    CadastroController,
    VisualizacaoController,
    DeleteController,
    RelatorioController,
    WebsiteController,
    QrcodeController,
    PerfilController
};
use App\Models\{
    User,
    PasswordReset
};
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});

Route::get('/home', [WebsiteController::class, 'Home'])->name('home');
Route::get('/contato', [WebsiteController::class, 'Contact'])->name('contato');
Route::post('/contato', [WebsiteController::class, 'Contato'])->name('contact');

Route::group(['middleware' => 'web'], function(){
    Auth::routes();
    Route::group(['middleware'=>'RoleGeral'],function () {
        Route::group(['prefix'=>'chamado'], function(){
            Route::get('/chamadosJson', [ChamadoController::class, 'chamados'])->name('chamado_json');
            Route::get('/historico', [ChamadoController::class, 'showHistorico'])->name('historico');
            Route::get('/abertura', [ChamadoController::class, 'showChamado'])->name('abertura');
            Route::get('/abertura/objeto/{ID}', [ChamadoController::class, 'qrcodeObjeto'])->name('qrcodeObjeto');
            Route::get('/abertura/setor/{ID}', [ChamadoController::class, 'qrcodeSetor'])->name('qrcodeSetor');
            Route::post('/abertura', [ChamadoController::class, 'storeChamado'])->name('abertura');
            Route::post('/comentario', [ChamadoController::class, 'comentarioChamado'])->name('comentario');
            Route::post('/alterar', [ChamadoController::class, 'alterarChamado'])->name('alterar_processo');
            Route::post('/item', [ChamadoController::class, 'alterarItem'])->name('alterar_item');
            Route::get('/{ID}', [ChamadoController::class, 'Chamado'])->name('chamado');
        });
        
        Route::group(['prefix'=>'relatorio'], function(){
            Route::get('/objeto_dados', [RelatorioController::class, 'ObjetoDados'])->name('objeto_dados');
            Route::get('/anos_dados', [RelatorioController::class, 'AnosDados'])->name('anos_dados');
            Route::get('/mes_dados', [RelatorioController::class, 'MesDados'])->name('mes_dados');
            Route::get('/ano_mensal_dados', [RelatorioController::class, 'AnoMesDados'])->name('ano_mensal_dados');
            Route::get('/ano_anual_dados', [RelatorioController::class, 'AnoAnoDados'])->name('ano_anual_dados');
            Route::get('/mes_dados_tabela', [RelatorioController::class, 'MesDadosTabela'])->name('mes_dados_tabela');
            Route::get('/setor_dados', [RelatorioController::class, 'SetorDados'])->name('setor_dados');
            Route::get('/setor_dados_tabela', [RelatorioController::class, 'SetorDadosTabela'])->name('setor_dados_tabela');
            Route::get('/setor', [RelatorioController::class, 'Setor'])->name('relatorio_setor');
            Route::get('/objeto', [RelatorioController::class, 'Objeto'])->name('relatorio_objeto');
            Route::get('/mensal', [RelatorioController::class, 'Mensal'])->name('relatorio_mensal');
            Route::get('/anual', [RelatorioController::class, 'Anual'])->name('relatorio_anual');
        });
        
        Route::group(['prefix'=>'compras', 'middleware'=>'RoleCompras'],function () {
            Route::get('/fornecedor', [ComprasController::class, 'showFornecedor'])->name('cadastro_fornecedor');
            Route::post('/fornecedor', [ComprasController::class, 'storeFornecedor'])->name('cadastro_fornecedor');
            Route::get('/fornecedoresJson', [ComprasController::class, 'fornecedores'])->name('fornecedores_json');
            Route::get('/fornecedores', [VisualizacaoController::class, 'Fornecedores'])->name('fornecedores');
            Route::get('/fornecedores/{ID}', [VisualizacaoController::class, 'updateFornecedores'])->name('update_fornecedores');
            Route::post('/fornecedores/{ID}', [VisualizacaoController::class, 'updateFornecedoresStore'])->name('update_fornecedores');
        });
        
        Route::group(['prefix'=>'cadastro', 'middleware'=>'RoleAntiGeral'],function () {

            Route::get('/cadastroSetor', [CadastroController::class, 'showSetor'])->name('cadastro_setor');
            Route::post('/cadastroSetor', [CadastroController::class, 'storeSetor'])->name('cadastro_setor');
            
            Route::get('/cadastroItem', [CadastroController::class, 'showItem'])->name('cadastro_item');
            Route::post('/cadastroItem', [CadastroController::class, 'storeItem'])->name('cadastro_item');
            
            Route::get('/cadastroObjeto', [CadastroController::class, 'showObjeto'])->name('cadastro_objeto');
            Route::post('/cadastroObjeto', [CadastroController::class, 'storeObjeto'])->name('cadastro_objeto');
            
        });
        
        Route::group(['prefix'=>'visualizacao', 'middleware'=>'RoleAntiGeral'],function () {
            
            Route::get('/setores', [VisualizacaoController::class, 'Setores'])->name('setores');
            Route::get('/setores/{ID}', [VisualizacaoController::class, 'updateSetores'])->name('update_setores');
            Route::get('/setoresJson', [VisualizacaoController::class, 'SetoresJson'])->name('setores_json');
            Route::post('/setores/{ID}', [VisualizacaoController::class, 'updateSetoresStore'])->name('update_setores');
            
            Route::get('/itens', [VisualizacaoController::class, 'Itens'])->name('itens');
            Route::get('/itens/{ID}', [VisualizacaoController::class, 'updateItens'])->name('update_itens');
            Route::post('/itens/{ID}', [VisualizacaoController::class, 'updateItensStore'])->name('update_itens');
            
            Route::get('/objetos', [VisualizacaoController::class, 'Objetos'])->name('objetos');
            Route::get('/objetos/{ID}', [VisualizacaoController::class, 'updateObjetos'])->name('update_objetos');
            Route::post('/objetos/{ID}', [VisualizacaoController::class, 'updateObjetosStore'])->name('update_objetos');
        });
        
        
        Route::group(['prefix'=>'delete', 'middleware'=>'RoleAntiGeral'],function () {
            Route::get('/setores/{ID}', [DeleteController::class, 'Setores'])->name('setores_delete');
            Route::get('/usuarios/{ID}', [DeleteController::class, 'Usuarios'])->name('usuarios_delete');
            Route::get('/fornecedores/{ID}', [DeleteController::class, 'Fornecedores'])->name('fornecedores_delete');
            Route::get('/itens/{ID}', [DeleteController::class, 'Itens'])->name('itens_delete');
            Route::get('/objetos/{ID}', [DeleteController::class, 'Objetos'])->name('objetos_delete');
        });
        
        Route::group(['prefix'=>'admin' , 'middleware'=>'RoleAdministrator'], function(){
            Route::get('/cadastroUsuario', [AdminController::class, 'showCadastro'])->name('cadastro_login');
            Route::post('/cadastroUsuario', [AdminController::class, 'storeCadastro'])->name('cadastro_login');
            Route::get('/usuarios', [AdminController::class, 'showUsuarios'])->name('usuarios');
            Route::get('/usuarios/{ID}', [AdminController::class, 'updateUsuarios'])->name('updateUsuarios');
            Route::post('/usuarios/{ID}', [AdminController::class, 'updateUsuariosStore'])->name('updateUsuarios');
        });

        Route::group(['prefix'=>'qrcode'], function(){
            Route::get('/objeto', [QrcodeController::class, 'Objeto'])->name('qrcode_objeto');
            Route::get('/setor', [QrcodeController::class, 'Setor'])->name('qrcode_setor');
            Route::get('/camera', [QrcodeController::class, 'Camera'])->name('qrcode_camera');
        });
        
        Route::get('/perfil', [PerfilController::class, 'perfil'])->name('perfil');
        Route::post('/perfil', [PerfilController::class, 'perfilStore'])->name('perfil');
        Route::post('/perfil/upload', [PerfilController::class, 'upload'])->name('perfil_upload');
        Route::get('/funcionarios', [PerfilController::class, 'funcionarios'])->name('funcionarios');
    });
    
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/empresa', [LoginController::class, 'empresa'])->name('empresa');
    Route::post('/login', [LoginController::class, 'auth'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    
    
    Route::get('forget-password', function(){
        return view('login.esqueceu')->with(['status' => null]);
    })->name('forget.password.get');
    
    
    Route::post('forget-password', function(Request $request){
        $status = Password::sendResetLink(
            $request->only('email')
        );
        
        Session::flash('title', 'Email enviado!');
        Session::flash('message', 'Um link de recadastro de email foi enviado para o seu email, cheque a sua caixa de entrada e spam!'); 
        Session::flash('alert-class', 'alert-success'); 
        
        return redirect('login');
        
    })->name('forget.password.post'); 
    
    Route::get('password/reset/{token}', function (string $token) {
        return view('login.recadastro', ['token' => $token]);
    })->name('password.reset');
    
    Route::post('reset-password', function(Request $request){
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'Empresa', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));
                    
                    $user->save();
                }
            );
            
            return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')
            : back()->withErrors(['email' => [__($status)]]);
        })->name('reset.password.post');
    });