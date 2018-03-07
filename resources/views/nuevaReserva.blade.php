<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Vuelos</title>
		<link rel="stylesheet" href="css/{{$plantilla}}">
		<script>
			var token="{{ csrf_token() }}";

			function inicio(){
				cargarSelectOrigen();
				cargarSelectDestino();
			}

			function cargarSelectOrigen(){
				var xhr	= new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById('divOrigen').innerHTML = this.responseText;
						}
					};
				xhr.open("POST", 'cargarSelectOrigen', false);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				var parametros = "_token="+token;
				xhr.send(parametros);	
			}


			function cargarSelectDestino(){
				var xhr	= new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById('divDestino').innerHTML = this.responseText;
						}
					};
				var origen=document.getElementById('selectOrigen').value;
				xhr.open("POST", 'cargarSelectDestino', false);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				var parametros = "_token="+token+"&origen="+origen;
				xhr.send(parametros);	
			}

			function validarFecha(){
				var xhr	= new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById('mensajeFecha').innerHTML = this.responseText;
						}
					};
				var fechaIda=document.getElementById('fechaIda').value;
				var fechaVuelta=document.getElementById('fechaVuelta').value;

				xhr.open("POST", 'validarFecha', true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				var parametros = "_token="+token+"&fechaIda="+fechaIda+"&fechaVuelta="+fechaVuelta;
				xhr.send(parametros);	
			}

			function dibujarAvion(){
				var xhr	= new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById('divAsientosAvion').innerHTML = this.responseText;
						}
					};
				var origen=document.getElementById('selectOrigen').value;
				var destino=document.getElementById('selectDestino').value;
				var fechaIda=document.getElementById('fechaIda').value;
				var fechaVuelta=document.getElementById('fechaVuelta').value;

				xhr.open("POST", 'dibujarAvion', true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				var parametros = "_token="+token+"&origen="+origen+"&destino="+destino+"&fechaIda="+fechaIda+"&fechaVuelta="+fechaVuelta;
				xhr.send(parametros);
			}

			function reservarVuelo(){
				var xhr	= new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById('mensajeReservar').innerHTML = this.responseText;
						}
					};
				var origen=document.getElementById('selectOrigen').value;
				var destino=document.getElementById('selectDestino').value;
				var fechaIda=document.getElementById('fechaIda').value;
				var fechaVuelta=document.getElementById('fechaVuelta').value;
				var asientos = document.getElementsByName('radioBoton');

				var asientos = document.getElementsByName('radioAsientos');
				var asientoSeleccionado = "";
				for(var i = 0; i < asientos.length;i++){
					if(asientos[i].checked == true){
						asientoSeleccionado = asientos[i].id;
					}
				}

				xhr.open("POST", 'reservarVuelo', true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				var parametros = "_token="+token+"&origen="+origen+"&destino="+destino+"&fechaIda="+fechaIda+"&fechaVuelta="+fechaVuelta+"&asientoSeleccionado="+asientoSeleccionado;
				xhr.send(parametros);
			}

			function dibujarRuta(){
				var xhr	= new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById('divRuta').innerHTML = this.responseText;
						}
					};
				var origen=document.getElementById('selectOrigen').value;	
				var destino=document.getElementById('selectDestino').value;

				xhr.open("POST", 'dibujarRuta', true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				var parametros = "_token="+token+"&origen="+origen+"&destino="+destino;
				xhr.send(parametros);	
			}
			
			  
		</script>
</head>
<body class="fondo" onLoad="inicio();">
	{{ csrf_field() }}
	
	<div id="divMensaje">
	
	</div>
	
	<table class="tablaNuevo">
		<tr>
			<td class="texto">Origen:</td>
			<td>
				<div id="divOrigen">
				
				</div>
			</td>
			<td class="texto">Destino:</td>
			<td>
				<div id="divDestino">
				
				</div>
			</td>
		</tr>
		<tr>
			<td class="texto">Fecha de ida:</td>
			<td><input type="date" class="boton" id="fechaIda" name="fechaIda" onChange="validarFecha(); dibujarAvion();" required></td>
			<td class="texto">Fecha de vuelta:</td>
			<td><input type="date" class="boton" id="fechaVuelta" name="fechaVuelta" onChange="validarFecha(); dibujarAvion();" required></td>
		</tr>
		<tr>
			<td colspan="4">
				<div id="mensajeFecha">
				</div>
			</td>
		</tr>
	</table>
	<span class="texto">&nbsp;&nbsp;&nbsp;&nbsp;Asiento:</span>
		
	<div id="divAvion">
		<div id="divAlaSuperiorAvion"><img src="imagenes/alasuperior.png"></div>
		<div id="divCabezaAvion"><img src="imagenes/cabeza.png"></div>
		<div id="divAsientosAvion">
		
		</div>
		<div id="divColaAvion"><img src="imagenes/cola.png"></div>
		<div id="divAlaInferiorAvion"><img src="imagenes/alainferior.png"></div>
	</div>
	<br>
	<center><input type="submit" class="boton" name="botonNuevaReserva" value="Reservar" onClick="reservarVuelo();"></center>
	<div id="mensajeReservar">
	</div>	
	<div id="divRuta">

	</div>

</body>
</html>