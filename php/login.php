
<?php

//---------------------------------------------------Declarar variables------------------------------------------------------------//

    session_start();
	$txtusuario=$_POST['txtusuario'];
	$txtpass=$_POST['txtpass'];
	require("connect_db.php");

//----------------------------------------------------Select Usuario-------------------------------------------------------------//

	$consulta=mysqli_query($mysqli,"CALL usuarios(null, null, '$txtusuario', null, null, null, null, null , null, 'validar', null, null, null,null);");

//------------------------------------------------Condiciones de consulta--------------------------------------------------------//


	if($respuesta=mysqli_fetch_assoc($consulta)){
        
		if($txtpass==$respuesta['pass']){
            
//-------------------------------------------Declarar las variables de Sesion-------------------------------------------------------------//
             
            $_SESSION['telefono']=$respuesta['telefono'];
            $_SESSION['nacimiento']=$respuesta['nacimiento'];
            $_SESSION['id']=$respuesta['id'];
            $_SESSION['nombre']=$respuesta['nombre'];
            $_SESSION['apellido']=$respuesta['apellido'];
			$_SESSION['usuario']=$respuesta['usuario'];
            $_SESSION['email']=$respuesta['email'];
            $_SESSION['tipo_usuario']=$respuesta['tipo_usuario'];
            $_SESSION['foto']=$respuesta['foto'];
            $_SESSION['dependencia']=$respuesta['dependencia_usuario'];  
            $_SESSION['fondo']=$respuesta['fondo'];  
            $_SESSION['fuente']=$respuesta['fuente'];
            
//----------------------------------------------------Condiciones de validacion-------------------------------------------------------------//
            
            if($respuesta['tipo_usuario']==0){
                
               echo "<script>alert('Bienvenido Administrador:');</script>";
               echo "<script>location.href='../admin.php'</script>";
                
            }
            
            if($respuesta['tipo_usuario']==1){
                
                echo "<script>alert('Bienvenido');</script>";
                echo "<script>location.href='../estandar.php'</script>";
                
            }
		
            
		}else{
            
					
			echo "<script>location.href='../usuarioIncorrec.php?usuario=$txtusuario'</script>";
		}
	}else{
		
		echo '<script>alert("ESTE USUARIO NO EXISTE, SOLICITA A UN ADMINISTRADOR UN REGISTRO VALIDO")</script> ';
		echo "<script>location.href='../index.html'</script>";

	}

?>