<?php 

//-----------------------------------------------Declarar Variables------------------------------------------------------------//
    
    session_start();
    $id=$_SESSION['id']; 
    require("connect_db.php");

//-------------------------------------------------Procesar imagen------------------------------------------------------------//

    $foto=$_FILES["txtfoto"]["name"];
    $ruta=$_FILES["txtfoto"]["tmp_name"];
    $destino="../img/".$foto;
    $destino2="img/".$foto;
    $destinoactual = $_SESSION['foto'];

    if ($destino2 != 'img/'){
        
        $_SESSION['foto'] = $destino2;
        $destinoactual = $destino2;
        
    }

    if ($destino != '../img/'){
        
        copy($ruta,$destino);
        
    }


//-----------------------------------------------Update foto del usuario------------------------------------------------------------//

    $resultado = mysqli_query($mysqli,"CALL usuarios(null, null, null, null, null, null, null, null , null, 'foto', '$id', '$destinoactual', null, null);");

//-----------------------------------------------Condicion de consulta------------------------------------------------------------//

    if ($resultado==null) {
        
                echo "Error de procesamieno no se han actuaizado los datos";
                echo "<script>location.href='../estandar.php'</script>";
        
	        }else {
                
                echo "<script>location.href='../estandar.php'</script>";
        
	        } 

?>