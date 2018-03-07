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

			function cambiarDatosUsuario(){
				var xhr	= new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
							document.getElementById('mensaje').innerHTML=this.responseText;
						}
					};

				var claveActual=document.getElementById('claveActual').value;
				var claveNueva=document.getElementById('claveNueva').value;
				var plantilla=document.getElementById('plantilla').value;

				xhr.open("POST", 'cambiarDatosUsuario', true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				var parametros = "_token="+token+"&claveActual="+claveActual+"&claveNueva="+claveNueva+"&plantilla="+plantilla;
				xhr.send(parametros);	
			}
			
		</script>		
</head>
<body class="fondo">
	{{ csrf_field() }}
	
	<p class="texto">Perfil de {{$usuario}} </p>
	
	<table class="tablaPerfil">
		<tr>
			<td class="texto">Clave actual:</td>
			<td><input type="password" class="boton" name="claveActual" id="claveActual" required></td>
		</tr>
		<tr>
			<td class="texto">Nueva clave:</td>
			<td><input type="password" class="boton" name="claveNueva" id="claveNueva" required></td>
		</tr>	
		<tr>
			<td class="texto">Plantilla:</td>
			<td>
				<select class="boton" name="plantilla" id="plantilla" required>
					<option value="plantilla1.css">plantilla1.css</option>";
					<option value="plantilla2.css">plantilla2.css</option>";
				</select>
			</td>
		</tr>			
		<tr>
			<td colspan="2" align="center"><div class="texto" id="mensaje"></div></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" class="boton" name="botonCambiar" value="Cambiar" onClick="cambiarDatosUsuario(); "></td>
		</tr>
	</table>

</body>
</html>