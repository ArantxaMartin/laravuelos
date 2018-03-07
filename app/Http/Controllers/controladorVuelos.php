<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class controladorVuelos extends Controller {
	
	///////////////  LOGIN y LOGOUT   //////////////////////////////////////////////////////////
	
	public function inicio (Request $request) {
		if(isset($request->crearUsuario)){
			$usuario=$request->usuario;
			$clave=$request->clave;

			$usuarios=DB::select('SELECT * FROM t_usuarios WHERE usuario=?',[$usuario]);

			if(count($usuarios)>0){
				$mensaje="Error: El usuario ya existe.";
				return view ('login', ['error' => $mensaje,'usuario'=>$usuario, 'clave'=>$clave]);
			}else{
				if((DB::insert('INSERT INTO t_usuarios (usuario, clave, plantilla) VALUES (?,?,?)',[$usuario,$clave,"plantilla1.css"]))==true){
					$mensaje="Se ha creado el usuario correctamente.";
					return view ('login', ['error' => $mensaje,'usuario'=>$usuario, 'clave'=>$clave]);
				}else{
					$mensaje="Error: No se ha podido crear el usuario.";
					return view ('login', ['error' => $mensaje,'usuario'=>$usuario, 'clave'=>$clave]);
				}
			}
		}

		if(isset($request->acceder)){
			$usuario=$request->usuario;
			$clave=$request->clave;

			$usuarios=DB::select('SELECT * FROM t_usuarios WHERE usuario=?',[$usuario]);


			if(count($usuarios)>0){
				if($clave==$usuarios[0]->clave){
					$plantilla=$usuarios[0]->plantilla;
					$request->session()->put('usuario', $usuario);
					$request->session()->put('clave', $clave);
					$request->session()->put('plantilla', $plantilla);
					return view ('principal', ['usuario' => $usuario, 'clave' => $clave, 'plantilla' => $plantilla]);
				}else{
					$mensaje="Datos incorrectos.";
					return view ('login', ['error' => $mensaje,'usuario'=>$usuario, 'clave'=>$clave]);

				}
			}else{
				$mensaje="Error: El usuario no existe.";
				return view ('login', ['error' => $mensaje,'usuario'=>$usuario, 'clave'=>$clave]);
			}
		}
	}

	
	public function logout (Request $request) {
		$request->session()->flush();
		return redirect('/');
	}
	
	
	
	//////////////// LISTAR RESERVAS ///////////////////////////////////////////////////////////
	
	public function mostrarReservas(Request $request){
		$usuario=$request->session()->get('usuario');
		$fechaIdaDesde=$request->fechaIdaDesde;
		$fechaIdaHasta=$request->fechaIdaHasta;
		
		$orden=$request->orden;

		if($fechaIdaDesde!=null && $fechaIdaHasta==null){
			$reservas=DB::select('SELECT * FROM t_reservas WHERE usuario=? AND fechaIda>=? ORDER BY ?',[$usuario,$fechaIdaDesde,$orden]);

		}else if($fechaIdaDesde==null && $fechaIdaHasta!=null){
			$reservas=DB::select('SELECT * FROM t_reservas WHERE usuario=? AND fechaIda<=? ORDER BY ?',[$usuario,$fechaIdaHasta,$orden]);

		}else if($fechaIdaDesde!=null && $fechaIdaHasta!=null){
			//$reservas=DB::select('SELECT * FROM t_reservas WHERE usuario=? AND fechaIda BETWEEN ? AND ?',[$usuario,$fechaIdaDesde,$fechaIdaHasta]);
			$reservas=DB::select('SELECT * FROM t_reservas WHERE usuario=? AND fechaIda>=? AND fechaIda<=? ORDER BY ?',[$usuario,$fechaIdaDesde, $fechaIdaHasta, $orden]);
		}else{
			$reservas=DB::select('SELECT * FROM t_reservas WHERE usuario=? ORDER BY ?',[$usuario,$orden]);
		}

		return view('tablaReservas', ['reservas'=>$reservas]);
	}


	
	public function eliminarReservas(Request $request){
		$reservas = array();
		$reservas=explode(",", $request->reservasSeleccionadas);
		$usuario=$request->session()->get('usuario');

		$contador=0;
		if(count($reservas)>0){
			for($i=0;$i<count($reservas)-1;$i++){
				if((DB::delete('DELETE FROM t_reservas WHERE usuario=? AND idReserva=?',[$usuario, $reservas[$i]]))>0){
					$contador++;
				}else{
					$mensaje="Error al eliminar la reserva numero: ".$i;
					return view('mensaje', ['mensaje'=>$mensaje]);
				}
			}
			$mensaje="Se han eliminado ".$contador." reservas.";
			return view('mensaje', ['mensaje'=>$mensaje]);
		}else{
			$mensaje="No se han seleccionado reservas para eliminar";
			return view('mensaje', ['mensaje'=>$mensaje]);
		}
	}
		
	//////////////  NUEVA RESERVA ////////////////////////////////////
	
	
	public function dibujarRuta (Request $request) {
		$origen=$request->origen;
		$destino=$request->destino;
		return view('ruta', ['origen'=>$origen, 'destino'=>$destino]);
	}

	public function cargarSelectOrigen(Request $request){
		$origenes=DB::select('SELECT DISTINCT origen FROM t_rutas;');
		return view('selectOrigen', ['origenes'=>$origenes]);
	}

	public function cargarSelectDestino(Request $request){
		$origen=$request->origen;
		$destinos=DB::select('SELECT DISTINCT destino FROM t_rutas WHERE origen=?',[$origen]);
		return view('selectDestino', ['destinos'=>$destinos]);
	}

	public function validarFecha(Request $request){
		$fechaIda=$request->fechaIda;
		$fechaVuelta=$request->fechaVuelta;

		if($fechaIda>$fechaVuelta){
			$mensaje="Error: La fecha de ida no puede ser posterior a la fecha de vuelta.";
			return view('mensaje',['mensaje'=>$mensaje]);
		}else{
			$mensaje="La fecha es correcta.";
			return view('mensaje',['mensaje'=>$mensaje]);
		}
	}

	public function dibujarAvion(Request $request){
		$origen=$request->origen;
		$destino=$request->destino;
		$fechaIda=$request->fechaIda;
		$fechaVuelta=$request->fechaVuelta;

		$vuelos=DB::select('SELECT * FROM t_reservas WHERE origen=? AND destino=? AND fechaIda=? AND fechaVuelta=?',[$origen,$destino,$fechaIda,$fechaVuelta]);

		return view('dibujarAvion',['vuelos'=>$vuelos]);
	}

	public function reservarVuelo(Request $request){
		$origen=$request->origen;
		$destino=$request->destino;
		$fechaIda=$request->fechaIda;
		$fechaVuelta=$request->fechaVuelta;
		$asientoSeleccionado=$request->asientoSeleccionado;
		$usuario=$request->session()->get('usuario');

		if($fechaIda<$fechaVuelta){
			if((DB::insert('INSERT INTO t_reservas (usuario, origen, destino, fechaIda, fechaVuelta, asiento) VALUES (?,?,?,?,?,?)',[$usuario, $origen,$destino,$fechaIda,$fechaVuelta, $asientoSeleccionado]))==true){
				$mensaje="Reserva realizada con éxito.";
				return view('mensaje',['mensaje'=>$mensaje]);
			}else{
				$mensaje="Error al realizar la reserva.";
				return view('mensaje',['mensaje'=>$mensaje]);
			}		
		}else{
			$mensaje="La fecha es incorrecta.";
			return view('mensaje',['mensaje'=>$mensaje]);
		}	


	}
	

	
	/////////////////  CAMBIAR PERFIL   //////////////////////////////////////////////////////////
	
	public function cambiarDatosUsuario(Request $request){
		$claveActual=$request->claveActual;
		$claveNueva=$request->claveNueva;
		$plantilla=$request->plantilla;
		
		$usuario=$request->session()->get('usuario');
		$claveReal = $request->session()->get('clave');
		$plantillaReal=	$request->session()->get('plantilla');

		if($claveActual!=null && $claveNueva!=null){
			if($claveActual!=$claveReal){
				$mensaje="La clave actual introducida es incorrecta.";
				return view('mensaje', ['mensaje' => $mensaje]);
			}else if($claveActual==$claveNueva || $claveNueva == $claveReal){
				$mensaje="La clave nueva no puede ser igual a la actual.";
				return view('mensaje', ['mensaje' => $mensaje]);		
			}else{	
				if((DB::update('UPDATE t_usuarios SET clave=?, plantilla=? WHERE usuario=?',[$claveNueva,$plantilla,$usuario]))>0){
					$mensaje="Datos modificados con éxito.";
					return view('mensaje', ['mensaje' => $mensaje]);			
				}else{
					$mensaje="Error al modificar los datos.";
					return view('mensaje', ['mensaje' => $mensaje]);			
				}
			}
		}else{
			if((DB::update('UPDATE t_usuarios SET plantilla=? WHERE usuario=?',[$plantilla,$usuario]))>0){
				$mensaje="Datos modificados con éxito.";
				return view('mensaje', ['mensaje' => $mensaje]);
			}
		}
	}

}
