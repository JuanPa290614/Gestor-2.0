<?php

//-----------------------------------------------Declarar Variables------------------------------------------------------------//

    $txtnombre=$_POST['txtnombre'];
	$txtapellido=$_POST['txtapellido'];
	$txtpass=$_POST['txtpass'];
    $txtemail=$_POST['txtemail'];
	$txttipo=$_POST['txttipo'];
	$txtdependencia=$_POST['txtdependencia'];
	require("connect_db.php");
    extract($_GET);     
    sleep (3);

//--------------------------------------------------Update usuario------------------------------------------------------------//

            $resultado=mysqli_query($mysqli,"CALL usuarios('$txtnombre', '$txtapellido', '$usuario', '$txtpass', null, '$txtemail', '$txttipo', '$txtdependencia' , null, 'actualizar_admin', null, null, null, null);");

//-----------------------------------------------Condicion de consulta------------------------------------------------------------//

            if ($resultado==null) {
        
                echo "Error de procesamieno no se han actuaizado los datos";
                echo "<script>location.href='../admin.php'</script>";
        
	        }else {
                
                echo "<script>location.href='../admin.php'</script>";                
        
	        }

?>