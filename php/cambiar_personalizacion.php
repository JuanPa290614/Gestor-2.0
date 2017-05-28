<?php

//-----------------------------------------------Declarar Variables------------------------------------------------------------//

    session_start();
    $id = $_SESSION['id'];
	require("connect_db.php");

//-------------------------------------------------Procesar imagen------------------------------------------------------------//

    $foto=$_FILES["txtfondo"]["name"];
    $ruta=$_FILES["txtfondo"]["tmp_name"];
    $destino="../img/".$foto;
    $destino2="img/".$foto;

    $destinoactual = $_SESSION['fondo'];
    $txtfuente=$_POST['txtfuente'];

    if ($destino2 != 'img/'){
        
        $_SESSION['fondo'] = $destino2;
        $destinoactual = $destino2;
        
    }
    if ($txtfuente == null){
        $txtfuente = $_SESSION['fuente']; 
    }

    if ($destino != '../img/'){
        
        copy($ruta,$destino);
        
    }

    

//----------------------------------------------------Update usuario------------------------------------------------------------//
     
           $resultado = mysqli_query($mysqli,"CALL usuarios(null, null, null, null, null, null, null, null , null, 'personalizar', '$id', null, '$destinoactual', '$txtfuente');");

//-------------------------------------------------Condicion de consulta------------------------------------------------------------//
             
            if ($resultado==null) {
        
                echo "Error de procesamieno no se han actuaizado los datos";
                echo "<script>location.href='../estandar.php'</script>";
        
	        }else {
                
                $_SESSION['fondo'] = $destinoactual;
                $_SESSION['fuente'] = $txtfuente;
                echo "<script>location.href='../estandar.php'</script>";
        
	        }

?>