<?php

use App\Http\Controllers\ContaController;
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

Route::get('/', function () {
    return view('welcome');
});

// Rotas para Contas
//criando a controller(que vai nas [] com php artisan make:controller NomeConta)
Route::get('/indexConta',[ContaController::class, 'index'])->name('conta.index'); //se apertar ctrl e clicar no index é direcionado pra controller
Route::get('/indexConta',[ContaController::class, 'index'])->name('conta.index');
Route::get('/createConta',[ContaController::class, 'create'])->name('conta.create');
Route::post('/storeConta',[ContaController::class, 'store'])->name('conta.store');
Route::get('/showConta/{conta}',[ContaController::class, 'show'])->name('conta.show');//é acrescentado o {conta} para indicar que deve ser enviado o id da conta. Paramentro com o mesmo nome da Models (nesse caso conta)
Route::get('/editConta/{conta}',[ContaController::class, 'edit'])->name('conta.edit');
Route::put('/updateConta/{conta}',[ContaController::class, 'update'])->name('conta.update'); 
Route::delete('/destroyConta/{conta}',[ContaController::class, 'destroy'])->name('conta.destroy'); 

Route::get('/gerar-pdf-conta',[ContaController::class, 'gerarPdf'])->name('conta.gerar-pdf');