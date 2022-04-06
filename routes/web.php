<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ClienteController;
use App\Http\Controllers\admin\CompraController;
use App\Http\Controllers\admin\DescuentoController;
use App\Http\Controllers\admin\EnvioController;
use App\Http\Controllers\admin\ImageController;
use App\Http\Controllers\admin\PrendaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartDetailController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\PrendaController as ControllersPrendaController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', [TestController::class, 'welcome']);
//Search
Route::get('/search', [SearchController::class, 'show']);
Route::get('products/json',[SearchController::class, 'data']);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('products/{id}', [ControllersPrendaController::class, 'show']);
Route::get('categories/{category}', [CategoriaController::class, 'show']);
//clientes
Route::get('clientes/{cliente}', [ClienteController::class, 'show']);
Route::post('/clientes/{id}/edit', [ClienteController::class, 'update']);

Route::post('/cart', [CartDetailController::class, 'store']);
Route::delete('/cart', [CartDetailController::class, 'destroy']);

Route::get('/cart/{id}/edit', [CartDetailController::class, 'edit']); //form editar
Route::delete('/cart/{id}/edit', [CartDetailController::class, 'update']);

Route::post('/order', [CartController::class, 'update']);

Route::post('/reaction', [OpinionController::class, 'store']);
Route::post('/reaction/{id}/edit', [OpinionController::class, 'update']); //actualizar
Route::post('/reaction/{id}/delete', [OpinionController::class, 'destroy']); //eliminar

//Pedidos
Route::get("/pedidos/ticket", [PedidosController::class, 'ticket'])->name("pedidos.ticket");
Route::resource('/pedidos', PedidosController::class); //
Route::post('/pedidos/{id}/delete', [PedidosController::class, 'destroy']); //eliminar

Route::middleware(['auth','admin'])->namespace('Admin')->prefix('admin')->group(function () {
    //prendas
    Route::get('/products', [PrendaController::class, 'index']); //listar 
	Route::get('/products/create', [PrendaController::class, 'create']); //formulario para crear
	Route::post('/products', [PrendaController::class, 'store']); //crear
	Route::get('/products/{id}/edit', [PrendaController::class, 'edit']); //form editar
	Route::post('/products/{id}/edit', [PrendaController::class, 'update']); //actualizar
	Route::post('/products/{id}/delete', [PrendaController::class, 'destroy']); //eliminar

	Route::get('/products/{id}/images', [ImageController::class, 'index']); //listado imagenes 
	Route::post('/products/{id}/images', [ImageController::class, 'store']); //registrar
	Route::delete('/products/{id}/images', [ImageController::class, 'destroy']); //eliminar image
	Route::get('/products/{id}/images/select/{image}', [ImageController::class, 'select']); //destacar 

	//category
	Route::get('/categories', [CategoryController::class, 'index']); //listar 
	Route::get('/categories/create', [CategoryController::class, 'create']); //formulario para crear
	Route::post('/categories', [CategoryController::class, 'store']); //crear
	Route::get('/categories/{category}/edit', [CategoryController::class, 'edit']); //form editar
	
	Route::post('/categories/{category}/edit', [CategoryController::class, 'update']); //actualizar
	Route::delete('/categories/{category}', [CategoryController::class, 'destroy']); //eliminar

	//compras
	Route::get('/compra', [CompraController::class, 'index']); //listar 
	Route::get('/compra/create', [CompraController::class, 'create']); //formulario para crear
	Route::post('/compra', [CompraController::class, 'store']); //crear
	Route::get('/compra/{id}/edit', [CompraController::class, 'edit']); //form editar
	Route::post('/compra/{id}/edit', [CompraController::class, 'update']); //actualizar
	Route::post('/compra/{id}/delete', [CompraController::class, 'destroy']); //eliminar
	Route::get('/compra/{id}', [CompraController::class, 'show']);

	//Descuentos
	Route::get('/descuentos', [DescuentoController::class, 'index']); //listar
	Route::get('/descuentos/{cescuento}/edit', [DescuentoController::class, 'addDescuento']); //form editar
	Route::post('/descuentos/{cescuento}/edit', [DescuentoController::class, 'updateDescuento']); //actualizar
	Route::delete('/descuentos/{cescuento}', [DescuentoController::class, 'destroy']); //eliminar

	//pédidos
	Route::get('/pedido', [PedidosController::class, 'ListPedidos']); //listar
	Route::get('/pedido/{pedido}', [PedidosController::class, 'show']);

	//Envios
	Route::get('/envios', [EnvioController::class, 'index']); //listar
	Route::get('/envios/create', [EnvioController::class, 'create']); //formulario para crear
	Route::post('/envios', [EnvioController::class, 'store']); //crear
	Route::get('/envios/{envio}/edit', [EnvioController::class, 'edit']); //form editar
	
	Route::post('/envios/{envio}/edit', [EnvioController::class, 'update']); //actualizar
	Route::delete('/envios/{envio}', [EnvioController::class, 'destroy']); //eliminar

	Route::post('/envios/{envio}/actEstPed', [EnvioController::class, 'ActualizarEstadoPedido']); //actualizar el estado del pedido
	Route::get('/envios/{envio}', [EnvioController::class, 'show']);
	
	//clientes
	Route::get('/clientes', [ClienteController::class, 'index']); //listar
	Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy']); //eliminar

	//opinion
	Route::get('/opinion', [OpinionController::class, 'index']); //

});