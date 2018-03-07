<select id="selectDestino" onChange="cargarSelectDestino(); dibujarAvion(); dibujarRuta();">
@foreach($destinos as $destino)
	<option> {{$destino->destino}} </option>
@endforeach
</select>