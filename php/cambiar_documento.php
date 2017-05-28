<?php

//-----------------------------------------------Declarar Variables------------------------------------------------------------//

    session_start();
    $txtrespuesta=$_POST['txtrespuesta'];

    extract($_GET);

    if ($txtdependencia == 'Sistemas'){
        $txtdependencia = 1;
    }else{
        $txtdependencia = 2;
    }

	require("connect_db.php");

//-------------------------------------------------Update documento------------------------------------------------------------//

            $estado = '2';
            $usuario = $_SESSION['usuario'];
            $respuesta = mysqli_query($mysqli,"CALL documentos(null, null, 'respuesta', null, null, null, null, null, '$txtrespuesta', '$iddocumento');");
            $respuesta2 = mysqli_query($mysqli,"CALL radicado('$txtdependencia', '$estado', null, '$idradicado', 'contestar', '$usuario');");

//------------------------------------------------Condiciones de consulta------------------------------------------------------//

            if ($respuesta==null) {
        
                echo "Error de procesamieno no se han actuaizado los datos";
                echo "<script>location.href='../estandar.php'</script>";
        
	        }else {
                
                echo "<script>location.href='../estandar.php'</script>";
                
	        } 
?>