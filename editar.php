<?php

session_start();
if (@!$_SESSION['usuario']) {
	header("Location:index.html");
}
?>

<html>
    <head>
    <link rel="shortcut icon"  type="imagen/icon" href="images/logo1.ico"/>
	<title>Welcome to Your Files</title>
   
   <link type="text/css" rel="stylesheet" href="css/styleedit.css"/>
   <link type="text/css" rel="stylesheet" href="css/styleAlert.css"/>   <script src="scripts/alertas.js"></script>
    </head>    
    <body>
    
    
    
    <?php
        
		extract($_GET);
		require("php/connect_db.php");
        
	    $consulta="CALL usuarios(null, null, '$usuario', null, null, null, null, null , null, 'validar', null, null, null, null);";
		$respuesta=mysqli_query($mysqli,$consulta);
		while ($row=mysqli_fetch_row ($respuesta)){
            
		    	$nombre=$row[2];
		    	$apellido=$row[3];
		    	$usuario=$row[4];
		    	$pass=$row[5];
                $email=$row[7];
                $tipo=$row[8];
                $dependencia=$row[9];
            
		    }

    ?>
        <div id="bien">Editando al usuario: <?php echo $nombre?> <?php echo $apellido?> </div>
      <div id="modificaU"> 

        <form action="php/actualizar_usuario.php?usuario=<?php echo $usuario?>" method="post">
            
            <label for="nom" id="textN">NOMBRE:</label>
            <input type="text" name="txtnombre" id="nom" value= "<?php echo $nombre?>"/>
             
             <label for="ape" id="textA">APELLIDO:</label>
             <input type="text" name="txtapellido" id="ape" value= "<?php echo $apellido?>"/> 
             
              <label for="email" id="textE">EMAIL:</label>   
              <input type="text" name="txtemail" id="email" value= "<?php echo $email?>"/>
                      
              <label for="use" id="textU">USUARIO:</label>
               <input type="text" name="txtusuario" id="use" placeholder= "<?php echo $usuario?>" readonly onclick="swal('Oops...','El usuario no se puede modificar', readonly="readonly", 'error');"/>      
           
               <label for="pas" id="textP">CONTRASEÑA:</label>
               <input type="password" name="txtpass" id="pas" value="<?php echo $pass?>"/>
              
               <label for="pasa" id="textPs">CONFIRMAR<br> CONTRASEÑA:</label> 
               <input type="password" name="txtrpass" id="pasa" value= "<?php echo $pass?>"/>
                       
                <label for="tip" id="textT">TIPO DE<br> USUARIO:</label>
                <select name="txttipo" class="stilo" id="tip" >
                <option Value="<?php echo $tipo?>"> </option>
                <option value=0>ADMINISTRADOR</option>
                <option value=1>ESTANDAR</option>
                </select>
                
                <label for="dep" id="textD">DEPENDENCIA:</label>           
               <select name="txtdependencia" id="dep" class="stilo">
              <option value="<?php echo $dependencia?>"></option>
              <option value=1>SISTEMAS</option>
              <option value=2>FINANCIERA</option>
              </select>               
                                        
            
            <input type="submit" name="submit" id="reg" value="MODIFICAR" onclick="swal('EXCELENTE','Se actualizaron los datos!', 'success');"/>
           </form>
         </div>
    
    
    
    
    </body>

</html>