<?php

//-----------------------------------------------Declarar Variables------------------------------------------------------------//
    
    require("connect_db.php");
    error_reporting(0);    

//-----------------------------------------------Primer Imagen------------------------------------------------------------//

    $foto=$_FILES["txtfoto"]["name"];
    $ruta=$_FILES["txtfoto"]["tmp_name"];
    $destino="../img/".$foto;
    $destino2="img/".$foto;
    
    $consulta = mysqli_query($mysqli,"CALL eventos ('1', null, 'consultar');");
    $respuesta=mysqli_fetch_assoc($consulta);

    $destinoactual = $respuesta['foto'];

    if ($destino2 != 'img/'){
        
        $destinoactual = $destino2;
        
    }

    copy($ruta,$destino);

//-----------------------------------------------Segunda Imagen------------------------------------------------------------//

    require("connect_db.php");
    $foto2=$_FILES["txtfoto2"]["name"];
    $ruta2=$_FILES["txtfoto2"]["tmp_name"];
    $destino3="../img/".$foto2;
    $destino4="img/".$foto2;

    $consulta = mysqli_query($mysqli,"CALL eventos ('2', null, 'consultar');");
    $respuesta=mysqli_fetch_assoc($consulta);

    $destinoactual2 = $respuesta['foto'];

    if ($destino4 != 'img/'){
        
        $destinoactual2 = $destino4;
        
    }

    copy($ruta2,$destino3);
//-----------------------------------------------Tercera Imagen------------------------------------------------------------//

    require("connect_db.php");
    $foto3=$_FILES["txtfoto3"]["name"];
    $ruta3=$_FILES["txtfoto3"]["tmp_name"];
    $destino5="../img/".$foto3;
    $destino6="img/".$foto3;

    $consulta = mysqli_query($mysqli,"CALL eventos ('3', null, 'consultar');");
    $respuesta=mysqli_fetch_assoc($consulta);

    $destinoactual3 = $respuesta['foto'];

    if ($destino6 != 'img/'){
        
        $destinoactual3 = $destino6;
        
    }

    copy($ruta3,$destino5);

//-----------------------------------------------Cuarta Imagen------------------------------------------------------------//

    require("connect_db.php");
    $foto4=$_FILES["txtfoto4"]["name"];
    $ruta4=$_FILES["txtfoto4"]["tmp_name"];
    $destino7="../img/".$foto4;
    $destino8="img/".$foto4;

    $consulta = mysqli_query($mysqli,"CALL eventos ('4', null, 'consultar');");
    $respuesta=mysqli_fetch_assoc($consulta);

    $destinoactual4 = $respuesta['foto'];

    if ($destino8 != 'img/'){
        
        $destinoactual4 = $destino8;
        
    }

    copy($ruta4,$destino7);

//-----------------------------------------------Codigo SQL------------------------------------------------------------//

    $mysqli -> next_result();
    mysqli_query($mysqli,"CALL eventos ('1', '$destinoactual', 'actualizar');");
    $mysqli -> next_result();
    mysqli_query($mysqli,"CALL eventos ('2', '$destinoactual2', 'actualizar');");
    $mysqli -> next_result();
    mysqli_query($mysqli,"CALL eventos ('3', '$destinoactual3', 'actualizar');");
    $mysqli -> next_result();
    mysqli_query($mysqli,"CALL eventos ('4', '$destinoactual4', 'actualizar');");

    echo "<script>location.href='../eventos.php'</script>";

?>