<?php

//-------------------------------------------------Procesar imagen------------------------------------------------------------//

    session_start();
	$txtid=$_POST['txtid'];
	$txtdependencia=$_POST['txtdependencia'];
	require("connect_db.php");

//-------------------------------------------------Update Radicado------------------------------------------------------------//

            $estado = '3';
            $usuario = $_SESSION['usuario'];
            $respuesta= mysqli_query($mysqli,"CALL radicado ('$txtdependencia', '$estado', $txtid, null, 'reasignar', '$usuario');");

//---------------------------------------------Condiciones de consulta------------------------------------------------------------//

            if ($respuesta==null) {
        
                echo "Error de procesamieno no se han actuaizado los datos";
                echo "<script>location.href='../estandar.php'</script>";
        
	        }else {
                
                echo "<script>location.href='../estandar.php'</script>";
        
	        }
?>