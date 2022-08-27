<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ChamadoController;  
use App\Http\Controllers\ResmasPapelController; 
use App\Http\Controllers\Auth\RegisteredUserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/ 
// REAL TIME
// Route::get('broadcast/{msg}', function($msg){
//     broadcast(new channelPublico($msg));
// });

Route::get('/', [ChamadoController::class, 'create'])->name('welcome');

Route::get('/chamado', [ChamadoController::class, 'create'])->name('chamado.create');

Route::post('/chamado', [ChamadoController::class, 'store'])->name('chamado.store');

Route::get('/papel', [ResmasPapelController::class, 'painel'])->name('chamado.papel');  // Solicitacao de papel

Route::post('/papel', [ResmasPapelController::class, 'store'])->name('resma.store');

Route::middleware('auth')->group(function () {  // PAGINA PARA CRIAR UM EVENTO PRECISA TÁ LOGADO
    Route::get('/home', [ChamadoController::class, 'painel'])->name('dashboard.home');

    Route::get('/resumo', [ChamadoController::class, 'chamadosRealizados'])->name('dashboard.resumo');

    Route::put('/chamado/finalizar/{id}', [ChamadoController::class, 'finalizarChamado'])->name('chamado.finalizarChamado');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');

    Route::put('/resma/finalizar/{id}', [ResmasPapelController::class, 'liberarPapel'])->name('resma.liberar');

    Route::get('/notificacao/{nome}&{setor}&{descricao}', [ChamadoController::class, 'disparaMessagem']);  // MANDA MSG VIA TELEGRAM

    Route::get('/relatorioPDF/{chamado?}{solicitacaoPapel?}{dataOne?}{dataTwo?}', [ChamadoController::class, 'geraRelatorio'])->name('relatorioPDF');

});




// PAGINA NAO ENCONTRADA EM PRODUCAO APENAS
// Route::any('{url}', function(){
//     return view('chamado.chamado');
// })->where( 'url','.*');