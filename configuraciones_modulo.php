<?php
session_start();

if (@!$_SESSION['usuario']) {
	header("Location:index.html");    
}

$fondo = $_SESSION['fondo'];
$fuente = $_SESSION['fuente'];

?>

<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon"  type="imagen/icon" href="images/logo1.ico"/>
<title> Configuracion del modulo </title>
<link type="text/css" rel="stylesheet" href="css/styleconfimodulo.css"/>
    <script src="scripts/scriptcoonfimode.js"></script>
</head>
<body>
  <div id="bien">Personaliza tu entorno</div>
  
  <div id="resto">
      <form method="POST" action="php/cambiar_personalizacion.php" enctype ="multipart/form-data" onsubmit="return validar();">    
           
            
            
           <div class="file">
          <p class="texto">Subir una imagen para el fondo del modulo</p>           
            <input type="file" name="txtfondo" class="btn_enviar" value = "<?php echo $fondo?>"/ id="img" onchange="previewFile()"><br>
          </div>          
          <img src="<?php echo $fondo;?>" alt="CARGANDO" width="400" height="300" style=" margin-left: 18%;" id="fto"/>
            <?php
        
           
        
            ?>
            
           <select name="txtfuente" id="tipoL">
              <option>Elija el tipo de letra</option>             
              <option value='Arial'>Arial</option>
              <option value='Algerian'>Algerian</option>
              <option value='Berlin'>Berlin Sans FB</option>
              <option value='Bradley'>Bradley Hand ITC</option>
              <option value='Comic Sans'>Comic Sans</option>
              <option value='Century go'>Century Gothic</option>
              <option value='Century sch'>Century Schoolbook</option>
                
              </select> 
            
            
            <input type="submit" name="submit" value="Aceptar" id="aceptar"/>
        </form>
        
         <div><a href="estandar.php">X</a></div>
         
          </div>
        
   
</body>
</html>