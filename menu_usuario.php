<?php
session_start();

if (@!$_SESSION['usuario']) {
	header("Location:index.html");    
}

?>
 
 <hmtl>   
    <head>
        <link rel="shortcut icon"  type="imagen/icon" href="images/logo1.ico"/>
        <title>Actualizar Imagen</title>
    <link type="text/css" rel="stylesheet" href="css/StyleActu.css"/>
    <script src="scripts/ScriptimgP.js"></script>
   
    
      </head>
   
   
    <body>
             
       <div id="cambiar">Cambiar Imagen de perfil</div>
       <div id="restos">
        <form method="post" action="php/cambiar_img_usuario.php" enctype ="multipart/form-data">
            
            <div id="file">
              <p id="texto">Subir la imagen para perfil</p>
               <input type="file" name="txtfoto" id="btn_enviar"  onchange="previewFile()" accept="image/*"/>
            </div> 
            
            <button type="submit" name="submit" id="acep">Aceptar</button>   
            
            <button type="button" id="cancel"><a href="estandar.php">Cancelar</a></button>    
        </form>
        
        <img src="<?php echo $_SESSION['foto'];?>" alt="CARGANDO" id="fto"/>
        
       
        </div>            
    </body>
    
</hmtl>
           

           