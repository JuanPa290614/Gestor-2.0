<?php

//---------------------------------------------------Declarar variables------------------------------------------------------------//

	$txtnombre=$_POST['txtnombre'];
	$txtapellido=$_POST['txtapellido'];
    $txtusuario=$_POST['txtusuario'];
	$txtpass=$_POST['txtpass'];
    $txtrpass=$_POST['txtrpass'];
    $txtemail=$_POST['txtemail'];
	$txttipo=$_POST['txttipo'];
	$txtdependencia=$_POST['txtdependencia'];
    require("connect_db.php");

//---------------------------------------------------Valiadar usuario--------------------------------------------------------------//
    
	$checkusuario=mysqli_query($mysqli,"CALL usuarios(null, null, '$txtusuario', null, null, null, null, null , null, 'validar', null, null, null,null);");
	$check_usuario=mysqli_num_rows($checkusuario);

//--------------------------------------------------Condiciones de consulta--------------------------------------------------------------//
		
        if($txtpass==$txtrpass){
            
			if($check_usuario>0){
                
				echo '<script language="javascript">alert("Atencion, ya existe el usuario designado, por favor cambie su usuario");</script>';
                echo "<script>location.href='../registrar.php'</script>";
                
			}else{
                
                $mysqli -> next_result(); 
                
                mysqli_query($mysqli,"CALL usuarios('$txtnombre', '$txtapellido', '$txtusuario', '$txtpass', null, '$txtemail', '$txttipo', '$txtdependencia' , null, 'crear', null, null, null, null);");
                
				echo '<script language="javascript">alert("Usuario registrado con éxito");</script>';
                echo "<script>location.href='../admin.php'</script>";
				
			}
			
		}else{
			echo '<script language="javascript">alert("Las contraseñas ingresadas no son iguales");</script>';
            echo "<script>location.href='../registrar.php'</script>";
		}
	
?>