<table>
<tr>
<th></th><th onClick="mostrarReservas('origen');">Origen</th><th>Destino</th><th onClick="mostrarReservas('fechaIda');">Fecha Ida</th><th>Fecha Vuelta</th><th>Asiento</th>

</tr>
@foreach ($reservas as $reserva)
	<tr>
		<td><input type="checkbox" name="checkReservas" id="{{$reserva->idReserva}}"></td>
		<td>{{$reserva->origen}}</td>
		<td>{{$reserva->destino}}</td>
		<td>{{$reserva->fechaIda}}</td>
		<td>{{$reserva->fechaVuelta}}</td>
		<td>{{$reserva->asiento}}</td>
	</tr>
@endforeach
</table>