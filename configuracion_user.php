<?php
session_start();

if (@!$_SESSION['usuario']) {
	header("Location:index.html");    
}

$telefono = $_SESSION['telefono'];
$email = $_SESSION['email'];
$nacimiento = $_SESSION['nacimiento']

?>

<!DOCTYPE html>
<html>
<head>
<title> Configuracion del usuario </title>
<link type="text/css" rel="stylesheet" href="css/styleconfiguraperso.css"/>
</head>
<body>
  <div id="bien">Editando su informacion personal</div>
  <div id="resto"><form method="POST" action="php/actualizar_usuario_estandar.php" onsubmit="return validar();">    
           
            
            
           <label for="email" id="textA"><a title="SI EL CORREO NO ESTA BIEN PUEDES CAMBIARLO O NO LO PUEDE ABRIR  CAMBIALO...">EMAIL:</a></label>
            <input type="text" name="txtemail" id="emaill" value = "<?php echo $email?>"/>
            
            
           <label for="tel" id="textTD"><a title="MODIFIQUE EL NUMERO DE TELEFONO POR SI LO CAMBIO">TELEFONO:</a></label>
             <input type="text" name="txttelefono" id="tel" value = "<?php echo $telefono?>"/>
            
            <label for="Fecha" id="textD"><a title="CAMBIA LA FECHA DE NACIMINETO ">FECHA NACI:</a></label>
             <input type="date" name="txtnacimiento" id="Fecha" value = "<?php echo $nacimiento?>"/> 
            
           
            
            
            <input type="submit" name="submit" value="Agregar" id="acep"/>
        </form>
        
         <div id="cancelar"><a href="estandar.php">X</a></div>
         
          </div>
          
   
</body>
</html>
