<?php

//-------------------------------------------------Declarar variable de conexion------------------------------------------------------------//

    $mysqli = new MySQLi("localhost", "root","", "gestor_archivos");

//-------------------------------------------------Condicion de consulta------------------------------------------------------------//

		if ($mysqli -> connect_errno) {
            
			die( "Fallo la conexión a MySQL: (" . $mysqli -> mysqli_connect_errno() 
				. ") " . $mysqli -> mysqli_connect_error());
		}
?>