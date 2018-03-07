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

			function mostrarReservas(orden){
				var xhr	= new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById('divTablaReservas').innerHTML = this.responseText;
						}
					};

				var fechaIdaDesde=document.getElementById('fechaIdaDesde').value;
				var fechaIdaHasta=document.getElementById('fechaIdaHasta').value;

				xhr.open("POST", 'mostrarReservas', true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				var parametros = "_token="+token+"&fechaIdaDesde="+fechaIdaDesde+"&fechaIdaHasta="+fechaIdaHasta+"&orden="+orden;
				xhr.send(parametros);	
			}

			function eliminarReservas(){
				var xhr	= new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById('mensajeEliminar').innerHTML = this.responseText;
						}
					};

				var reservas = document.getElementsByName('checkReservas');
				var reservasSeleccionadas = "";
				for(var i = 0; i < reservas.length;i++){
					if(reservas[i].checked == true){
						reservasSeleccionadas += reservas[i].id+",";
					}
				}

				xhr.open("POST", "eliminarReservas", true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				var parametros = "_token="+token+"&reservasSeleccionadas="+reservasSeleccionadas;
				xhr.send(parametros);
			}


		</script>
</head>
<body class="fondo" onLoad="mostrarReservas('fechaIda');">
	{{ csrf_field() }}
	<table class="tablaBuscar">
		<tr>
			<td class="texto">Fecha de ida desde:</td>
			<td><input type="date" class="boton" id="fechaIdaDesde" onChange="mostrarReservas('fechaIda');"></td>
			<td class="texto">hasta:</td>
			<td><input type="date" class="boton" id="fechaIdaHasta" onChange="mostrarReservas('fechaIda');"></td>
		</tr>
	</table> 
	
	<br>
	
	<div id="divTablaReservas">

	</div>
	<div id="mensajeEliminar">

	</div>
	
	<hr>
	
	<center><input type="submit" class="boton" name="botonAnularReservas" value="Anular reservas" onClick="eliminarReservas(); mostrarReservas('fechaIda');"></center>

</body>
</html>