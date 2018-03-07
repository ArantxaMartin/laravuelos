<table>
<tr>
<?php
	$arrayAsientosOcupados=array();
	foreach ($vuelos as $vuelo) {
		if(!in_array($vuelo->asiento, $arrayAsientosOcupados)){
			array_push($arrayAsientosOcupados, $vuelo->asiento);
		}
	}

	for($i=1;$i<=8;$i++){
		if($i==5){
		echo "</tr><tr>";
		}

		if(in_array($i, $arrayAsientosOcupados)){
			echo "<td bgcolor='blue'></td>";
		}else{
			echo "<td style=\"padding:1px;\">
			<input type='radio' name='radioAsientos' id='".$i."'>".$i.
			"</td>";
		}
	}

echo "</tr>";
echo "</table>";