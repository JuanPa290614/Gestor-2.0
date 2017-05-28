<?php

//---------------------------------------------------Declarar variables------------------------------------------------------------//

    extract($_GET);
    require ("connect_db.php");

//----------------------------------------------------Delete documento-------------------------------------------------------------//

        $sqlborrar2="CALL radicado (null, null, '$iddocumento', null, 'Eliminar', null)";
		$resborra2r=mysqli_query($mysqli,$sqlborrar2);
        $sqlborrar="CALL documentos(null, null, 'eliminar', null, null, null, null, null, null, '$iddocumento');";
		$resborrar=mysqli_query($mysqli,$sqlborrar);

//-------------------------------------------------Condicion de consulta------------------------------------------------------------//
                        
		echo '<script>alert("REGISTRO ELIMINADO")</script> ';
		echo "<script>location.href='../admin.php'</script>";
	
?>