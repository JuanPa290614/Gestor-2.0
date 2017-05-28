<?php
session_start();

if (@!$_SESSION['usuario']) {
	header("Location:index.html");
    
}
if ($_SESSION['tipo_usuario']==1) {
	header("Location:estandar.php");
    
}

?>

       <!DOCTYPE html>
       <html>
       <head>
          <link rel="shortcut icon"  type="imagen/icon" href="images/logo1.ico"/>
           <title>Actualizando los eventos</title>
          <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
           
           
           <link type="text/css" rel="stylesheet" href="css/styleevents.css"/>
           <script src="scripts/scriptsevents.js"></script>

       </head>
       <body>
       
         <div id="bien">Actualizando los eventos <a id="atra" href="admin.php"></a> </div>
         <div id="resto">         
                      <form method="post" action="php/cambiar_evento.php" enctype ="multipart/form-data">
                         
                          <div class="file">
                             <p class="texto">Subir una imagen para el primer evento</p>
                              <input type="file" name="txtfoto" class="btn_enviar" id="img" onchange="previewFile()" accept="image/*"/>                             
                          </div>
                          <?php
                              require("php/connect_db.php");
                              $consulta=mysqli_query($mysqli,"CALL eventos ('1', null, 'consultar');");        
                              $respuesta= mysqli_fetch_array($consulta);            
                              $ruta = $respuesta["foto"];                               
                              ?>                         
                          <img src="<?php echo $ruta;?>" alt="CARGANDO" width="46%" height="60%" style=" margin-left: 28%;" id="fto"/>
                          <!-----------------------------------------------------segundo evento---------------------------------------->
                          
                          <div class="file">
                             <p class="texto">Subir una imagen para el segundo evento</p>
                              <input type="file" name="txtfoto2" class="btn_enviar" id="img2" onchange="previewFile2()" accept="image/*"/>                             
                          </div>
                          <?php
                              require("php/connect_db.php");
                              $consulta=mysqli_query($mysqli,"CALL eventos ('2', null, 'consultar');");        
                              $respuesta= mysqli_fetch_array($consulta);            
                              $ruta = $respuesta["foto"];                               
                              ?>                         
                          <img src="<?php echo $ruta;?>" alt="CARGANDO" width="46%" height="60%" style=" margin-left: 28%;" id="fto2"/>
                          <!-----------------------------------------------------tercer evento---------------------------------------->
                          
                          <div class="file">
                             <p class="texto">Subir una imagen para el tercer evento</p>
                              <input type="file" name="txtfoto3" class="btn_enviar" id="img3" onchange="previewFile3()" accept="image/*"/>                             
                          </div>
                          <?php
                              require("php/connect_db.php");
                              $consulta=mysqli_query($mysqli,"CALL eventos ('3', null, 'consultar');");        
                              $respuesta= mysqli_fetch_array($consulta);            
                              $ruta = $respuesta["foto"]; 
                              ?>                         
                          <img src="<?php echo $ruta;?>" alt="CARGANDO" width="46%" height="60%" style=" margin-left: 28%;" id="fto3"/>
                          <!---------------------------------------------------------cuarto evento------------------------------------->
                           
                          <div class="file">
                             <p class="texto">Subir una imagen para el cuarto evento</p>
                              <input type="file" name="txtfoto4" class="btn_enviar" id="img4" onchange="previewFile4()" accept="image/*"/>                             
                          </div>
                          <?php
                              require("php/connect_db.php");
                              $consulta=mysqli_query($mysqli,"CALL eventos ('4', null, 'consultar');");        
                              $respuesta= mysqli_fetch_array($consulta);            
                              $ruta = $respuesta["foto"];                               
                              ?>                         
                          <img src="<?php echo $ruta;?>" alt="CARGANDO" width="46%" height="60%" style=" margin-left: 28%;" id="fto4"/>
                          
                           <input type="submit" name="submit" value="ACTUALIZAR LOS EVENTOS" id="btn"/>                 
              
                      </form>
                                  
         </div> 
             
                   
        
       </body>
       </html>
               