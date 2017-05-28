<?php

    extract($_GET);
    require("php/connect_db.php");

    $consulta=mysqli_query($mysqli,"CALL usuarios(null, null, '$usuario', null, null, null, null, null , null, 'validar', null, null, null,null)");

	if($respuesta=mysqli_fetch_assoc($consulta)){
        
            $nombre=$respuesta['nombre'];
            $pellido=$respuesta['apellido'];
			$usuario=$respuesta['usuario'];
            $foto=$respuesta['foto'];
    }

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon"  type="imagen/icon" href="images/logo1.ico"/>
	<title>Contraseña Incorrecta </title>
   <!-------------css-------->
    <link type="text/css" rel="stylesheet" href="css/styleUI.css"/>
    <!----------scripts-------------->
    <script src="scripts/jquery-1.12.4.js"></script>
    
</head>
<body >
    
    <div id="bien">CONTRASE&Ntilde;A INCORRECTA</div>
    
    <div id="loginP">
    <div id="LoginE">
    <p id="tilE">INICIAR SESI&Oacute;N</p>
          <form action="php/login.php" method="post">          
         
             <input type="text" name="txtusuario" id="userE"  placeholder="&#128582; USERNAME" value="<?php echo $usuario;?>" required />
             
              <input type="password" name="txtpass" id="passE"   placeholder="&#128272; PASSWORD" required/>    
            <button type="submit" id="entrar" >ENTRAR</button>              
        </form>      
        <div id="imagenP">
            <img src="<?php echo $foto;?>" width="100%" height="100%"/>
        </div>
        
        <label name="NombreU" id="NP"><?php echo $nombre;?></label>
         <label name="ApellidoU" id="AP"><?php echo $pellido;?></label>
    </div>
    
    </div>
    
    
    

</body>
</html>