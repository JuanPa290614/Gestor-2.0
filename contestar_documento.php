<?php
session_start();
require("php/connect_db.php");

if (@!$_SESSION['usuario']) {
	header("Location:index.html");
}

extract($_GET);

    $consulta=mysqli_query($mysqli,"CALL documentos(null, null, 'contestar', null, null, null, null, null, null, '$iddocumento');");
    $arreglo=mysqli_fetch_array($consulta);

    $idradicado = $arreglo[11];
    $txtdependencia = $arreglo[6];

?>
 
 <hmtl>
    <head>      
       <link rel="shortcut icon" type="imagen/icon" href="images/logo1.ico"/>
        <title>Contestando un Documento</title>
        <link rel="stylesheet" type="text/css" href="css/stylecontstardocumen.css"/>
    </head>
    <body>
    <div id="til">Contestando un Documento</div>
    <div id="rest">
    
        <form method="POST" action="php/cambiar_documento.php?iddocumento=<?php echo $iddocumento?>&idradicado=<?php echo $idradicado?>&txtdependencia=<?php echo $txtdependencia?>">           
            
            <label id="respu"> Respuesta:</label>
            <textarea name="txtrespuesta" id="text" placeholder="Sin respuesta"><?php echo $arreglo[10]?></textarea>
            
            <label><a title="EL ID DEL DOCUMENTO SE  OBTIENE DE LA TABLA" id="creado">El documento fue creado por: <?php echo $arreglo[8]?> <?php echo $arreglo[9]?></a></label><br><br>  
            
            <input type="submit" name="submit" value="Contestar" id="btn"/>
            
        </form>
         
        
    
    </div>
    </body>
</hmtl>