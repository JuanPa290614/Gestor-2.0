<?php

//-----------------------------------------------Declarar Variables------------------------------------------------------------//
    
    session_start();
    extract($_GET);
    require("connect_db.php");

//--------------------------------------------------Update radicado------------------------------------------------------------//

    $estado= '4';
    $usuario = $_SESSION['usuario'];
    $resultado = mysqli_query($mysqli,"CALL radicado(null, '$estado', null, '$id2', 'estado', '$usuario');");

//-----------------------------------------------Declarar Variables------------------------------------------------------------//
            
    if ($resultado==null) {
        
                echo "Error de procesamieno no se han actuaizado los datos";
                echo "<script>location.href='../estandar.php'</script>";
        
	        }else {
                
                echo "<script>location.href='../estandar.php'</script>";
        
	        }
?>