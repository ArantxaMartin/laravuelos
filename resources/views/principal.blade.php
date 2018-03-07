<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Vuelos</title>
		<link rel="stylesheet" href="css/{{$plantilla}}">
		<script>
			function abrirPagina (url) {
				document.getElementById('iframeContenido').src = url;
			}
	
			function cambiarColor (boton, color) {
				boton.style.backgroundColor = color;
			}
		</script>
</head>
<body onLoad="abrirPagina('nuevaReserva');">
	<div id="divCabecera">
		<div id="divLogo">
			<img src="imagenes/logo.png" width="465" height="140">
		</div>
		
		<div id="divMenu">
			<table>
			<tr>
				<td colspan="4" align="right"><span class="texto"> {{ $usuario }} </span></td>
			</tr>
			<tr>
				<td><button type="button" class="botonMenu" onClick="abrirPagina('nuevaReserva');" onMouseEnter="cambiarColor(this, '#0062C5');" onMouseOut="cambiarColor(this, '#0080FF');">Nueva reserva</button></td>
				<td><button type="button" class="botonMenu" onClick="abrirPagina('misReservas');" onMouseEnter="cambiarColor(this, '#0062C5');" onMouseOut="cambiarColor(this, '#0080FF');">Mis reservas</button></td>
				<td><button type="button" class="botonMenu" onClick="abrirPagina('perfil');" onMouseEnter="cambiarColor(this, '#0062C5');" onMouseOut="cambiarColor(this, '#0080FF');">Perfil</button></td>
				<td><button type="button" class="botonMenu" onClick="window.location.assign('logout');" onMouseEnter="cambiarColor(this, '#0062C5');" onMouseOut="cambiarColor(this, '#0080FF');">Salir</button></td>
			</tr>
			</table>
		</div>
	</div>
	
	<iframe id="iframeContenido" scrolling="auto" frameborder="0" src=""></iframe>
</body>
</html>