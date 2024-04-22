<?php

use App\Http\Controllers\EventosController;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/inscricao/confirmada/{email}',[InscricaoController::class, 'confirmar'])->name('inscricao.confirmar');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
