<?php

//-----------------------------------------------Declarar Variables------------------------------------------------------------//

    session_start();
    $txtemail=$_POST['txtemail'];
	$txttelefono=$_POST['txttelefono'];
	$txtnacimiento=$_POST['txtnacimiento'];
    $id = $_SESSION['id'];
	require("connect_db.php");

//-----------------------------------------------Update usuario estandar------------------------------------------------------------//

           $resultado=mysqli_query($mysqli,"CALL usuarios(null, null, null, null, '$txttelefono', '$txtemail', null, null , '$txtnacimiento', 'actualizar_estandar', '$id', null, null, null);");

//-----------------------------------------------Condiciones de consulta------------------------------------------------------------//

            if ($resultado==null) {
        
                echo "Error de procesamieno no se han actuaizado los datos";
                echo "<script>location.href='../estandar.php'</script>";
        
	        }else {
                
                $_SESSION['email'] = $txtemail;
                $_SESSION['telefono'] = $txttelefono;
                $_SESSION['nacimiento'] = $txtnacimiento;
                echo "<script>location.href='../estandar.php'</script>";
        
	        }

?>