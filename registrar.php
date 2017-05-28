<?php

session_start();
if (@!$_SESSION['usuario']) {
	header("Location:index.html");
}
?>

<!DOCTYPE html>
<html>
<head>
 <link rel="shortcut icon"  type="imagen/icon" href="images/logo1.ico"/>
	<title>REGISTRANDO UN NUEVO USUARIO</title>
	<!----------css------------>
	<link type="text/css" rel="stylesheet" href="css/styleR.css"/>
	<link type="text/css" rel="stylesheet" href="css/styleAlert.css"/>

	<!-------------scripts------------->
	<script src="scripts/scriptregis.js"></script>
	<script src="scripts/scriptvalidar.js"></script>
	<script src="scripts/alertas.js"></script>
	
	
</head>
<body>
        <div id="regis">REGISTRANDO UN NUEVO USUARIO</div>
        
        <div id="regisu"> 

        <form method="post" action="php/registro_usuario.php" onsubmit="return validar();">
            
            <label for="nom" id="textN">NOMBRE:</label>
            <input type="text" name="txtnombre" id="nom"/>
             
             <label for="ape" id="textA">APELLIDO:</label>
             <input type="text" name="txtapellido" id="ape"/> 
             
              <label for="email" id="textE">EMAIL:</label>   
              <input type="text" name="txtemail" id="email"/>
                      
              <label for="use" id="textU">USUARIO:</label>
               <input type="text" name="txtusuario" id="use"/>      
           
               <label for="pas" id="textP">CONTRASEÑA:</label>
               <input type="password" name="txtpass" id="pas"/>
              
               <label for="pasa" id="textPs">CONFIRMAR<br> CONTRASEÑA:</label> 
               <input type="password" name="txtrpass" id="pasa"/>
                       
                <label for="tip" id="textT">TIPO DE<br> USUARIO:</label>
                <select name="txttipo" class="stilo" id="tip">
                <option ></option>
                <option value=0>ADMINISTRADOR</option>
                <option value=1>ESTANDAR</option>
                </select>
                
                <label for="dep" id="textD">DEPENDENCIA:</label>           
               <select name="txtdependencia" id="dep" class="stilo">
              <option></option>
              <option value=1>SISTEMAS</option>
              <option value=2>FINANCIERA</option>
              </select>               
                                        
            
            <input type="submit" name="submit" id="reg" value="REGISTER"/>
           </form>
         </div>
                  
         
         
        
</body>
</html>