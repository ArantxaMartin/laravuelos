<?php

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
use Illuminate\Http\Request;


    Route::get('/', function () { return view('login', ['error' => '', 'usuario' => '', 'clave' => '']); });
	Route::post('inicio', 'controladorVuelos@inicio');
	Route::get('logout', 'controladorVuelos@logout'); 
	
	
	
	
	// NO MODIFICAR ESTAS TRES RUTAS PORQUE SON USADAS POR principal.blade.php PARA MOSTRAR CADA PÁGINA DE LA WEB:
	Route::get('misReservas', function(Request $request) {
								$usuario = $request->session()->get('usuario');
								$clave = $request->session()->get('clave');
								$plantilla = $request->session()->get('plantilla');
								return view('misReservas', ['usuario' => $usuario, 'plantilla' => $plantilla]);
							});
	
	Route::get('nuevaReserva', function (Request $request) {
									$usuario = $request->session()->get('usuario');
									$clave = $request->session()->get('clave');
									$plantilla = $request->session()->get('plantilla');
									return view('nuevaReserva', ['usuario' => $usuario, 'plantilla' => $plantilla]);
							});	
	
	Route::get('perfil', function(Request $request) {
							$usuario = $request->session()->get('usuario');
							$clave = $request->session()->get('clave');
							$plantilla = $request->session()->get('plantilla');
							return view('perfil', ['usuario' => $usuario, 'plantilla' => $plantilla]);
						});




	Route::post('cargarSelectOrigen', 'controladorVuelos@cargarSelectOrigen');
	Route::post('cargarSelectDestino', 'controladorVuelos@cargarSelectDestino');

	Route::post('validarFecha', 'controladorVuelos@validarFecha');

	Route::post('dibujarAvion', 'controladorVuelos@dibujarAvion');

	Route::post('reservarVuelo', 'controladorVuelos@reservarVuelo');

	Route::post('dibujarRuta', 'controladorVuelos@dibujarRuta');

	Route::post('mostrarReservas', 'controladorVuelos@mostrarReservas');

	Route::post('eliminarReservas', 'controladorVuelos@eliminarReservas');

	Route::post('cambiarDatosUsuario', 'controladorVuelos@cambiarDatosUsuario');