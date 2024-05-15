<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InscricaoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*
- Formulário de Inscrição
- E-mail de Confirmação
- Sistema de Agendamento
 */


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/calendario', [EventosController::class, 'index'])->name('calendario.index');

Route::controller(EventosController::class)->group(function(){
    Route::get('calendario', 'index');
    Route::get('calendario/list', 'list');
    Route::post('fullcalenderAjax', 'ajax');
});

Route::middleware(['cors'])->group(function () {
    Route::get('/inscricao',[InscricaoController::class, 'create'])->name('inscricao.create');
    Route::post('/inscricao',[InscricaoController::class, 'store'])->name('inscricao.store');
    // Route::get('/comprovantepix',[InscricaoController::class, 'pix'])->name('inscricao.pix');
    Route::post('/comprovantepix',[InscricaoController::class, 'store_pix'])->name('inscricao.store.pix');


//    Route::get('/inscricao/confirmada/{email}',[InscricaoController::class, 'confirmar'])->name('inscricao.confirmar');
    // Route::get('/inscricao/confirmada/{ni}/{id}',[InscricaoController::class, 'confirmar'])->name('inscricao.confirmar');
    Route::get('/inscricao/confirmada/{ni}',[InscricaoController::class, 'confirmar'])->name('inscricao.confirmar');
    Route::get('/inscricao/confirmar_pix/{ni}',[InscricaoController::class, 'confirmar_pix'])->name('inscricao.confirmar_pix');
    
    // Tentar novamente pagamento pagamento
    Route::get('/inscricao/pagamento/{ni}',[InscricaoController::class, 'pagamento'])->name('inscricao.pagamento');

    Route::get('/mercadopago/webhook/failure', [InscricaoController::class, 'webhook'])->name('webhook');
    Route::get('/mercadopago/webhook/pending', [InscricaoController::class, 'webhook'])->name('webhook');
    Route::get('/mercadopago/webhook/success', [InscricaoController::class, 'webhook'])->name('webhook');

    // Route::get('/mercadopago/mpwebhook', [InscricaoController::class, 'mpwebhook'])->name('mpwebhook');
    
});


Route::post('mpwebhook', [InscricaoController::class, 'mpwebhook'])->name('mpwebhook');
// Route::post('/mercadopago/mpwebhook', function (Request $request) {
//     Log::debug($request->input());
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
