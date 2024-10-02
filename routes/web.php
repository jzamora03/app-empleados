<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\CargoController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('empleados.index');
});

Route::resource('cargos', CargoController::class);

Route::resource('empleados', EmpleadoController::class);


Route::get('cargos', [CargoController::class, 'index'])->name('cargos.index');
Route::get('empleados/{id}/historial', [EmpleadoController::class, 'historial'])->name('empleados.historial');

Route::get('empleados/{id}/aumento/create', [EmpleadoController::class, 'createAumento'])->name('empleados.aumento.create');
Route::post('empleados/{id}/aumento', [EmpleadoController::class, 'storeAumento'])->name('empleados.aumento.store');






