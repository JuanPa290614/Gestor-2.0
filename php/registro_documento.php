<?php

//---------------------------------------------------Declarar variables------------------------------------------------------------//

    session_start();
	$txtasunto=$_POST['txtasunto'];
    $txttipo=$_POST['txttipo'];
    $txtdetalles=$_POST['txtdetalles'];
    $dependencia_usuario = $_SESSION['dependencia'];
    $dependencia = $_POST['txtdependencia'];
    $id=$_SESSION['id']; 
    require("connect_db.php");

//---------------------------------------------------Procesar imagen------------------------------------------------------------//

    $foto=$_FILES["txtdocumento"]["name"];
    $ruta=$_FILES["txtdocumento"]["tmp_name"];
    $destino="../docs/".$foto;
    $destino2="docs/".$foto;

    $destino_real = str_replace(' ', '', $destino);
    $destino_real2 = str_replace(' ', '', $destino2);

    copy($ruta,$destino_real);

//---------------------------------------------------Insertar documento------------------------------------------------------------//

                $insertar = mysqli_query($mysqli,"CALL documentos('$txttipo','$dependencia_usuario', 'crear', '$destino_real2', '$txtasunto', '$foto', '$txtdetalles', '$id', null, null);");

                $mysqli -> next_result();
                $consulta = mysqli_query($mysqli,"CALL documentos(null, null, 'id', null, null, '$foto', null, null, null, null);");
                $respuesta=mysqli_fetch_assoc($consulta);
                
                     $iddocumento = $respuesta['id'];

                $mysqli -> next_result();
                $estado = '1';
                $usuario = $_SESSION['usuario'];

                $insertar = mysqli_query($mysqli,"CALL radicado('$dependencia', '$estado', '$iddocumento', null, 'insertar', '$usuario');");
                mysqli_query($mysqli,"CALL radicado_seguimientos('$dependencia', '$estado', '$iddocumento', '$usuario', 'insertar');");

//---------------------------------------------------Condicion de consultas------------------------------------------------------------//

     echo "<script>alert('El Documento se ah enviado de manera satisfactoria');</script>";
     echo "<script>location.href='../estandar.php'</script>";
	
?>