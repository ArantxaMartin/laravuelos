<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Vuelos</title>
		<link rel="stylesheet" href="css/plantilla1.css">
</head>
<body>
	<div id="divLogin">
		<form method="post" action="inicio">
		    {{ csrf_field() }}
			<table class="tablaLogin">
				<tr>
					<td rowspan="3"><img src="imagenes/logo.png" width="220" height="100"></td>
					<td class="texto">Usuario:</td> <td><input name="usuario" type="text" class="boton" value="{{ $usuario }}" required></td></tr>
				<tr>
					<td class="texto">Clave:</td> <td><input name="clave" type="password" class="boton" value="{{ $clave }}" required></td></tr>
				<tr height="60">
					<td><input class="boton" name="crearUsuario" type="submit" value="CREAR USUARIO"></td>
					<td><input class="boton" name="acceder" type="submit" value="ACCEDER"></td></tr>
			</table>
		</form>
		<p class="error"> {{ $error }} </p> 
	</div>
</body>
</html>