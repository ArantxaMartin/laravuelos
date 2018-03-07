<select id="selectOrigen" onChange="cargarSelectDestino(); dibujarAvion(); dibujarRuta();">
@foreach($origenes as $origen)
	<option> {{$origen->origen}} </option>
@endforeach
</select>