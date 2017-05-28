<?php
session_start();

if (@!$_SESSION['usuario']) {
	header("Location:index.html");
    
}

?>
 
 <hmtl>
    <head>
        <title>reasignar Documento</title>
        
        <link type="text/css" rel="stylesheet" href="css/styleNuevodoc.css"/>
        <link type="text/css" rel="stylesheet" href="css/alertas.css"/>
	
        
        <!----------scrpts----------->
    
	<script src="scripts/validarNdocument.js"></script>
	<script src="scripts/alertas.js"></script>
        
    </head>
    
    <div id="til">Reasigna el Documento</div>
    <div id="rest">
    <body>
        <form method="POST" action="php/cambiar_radicado.php">
           
           <label for="asun" id="textA"><a title="EL ID DEL DOCUMENTO SE  OBTIENE DE LA TABLA">ID DOCUMEN:</a></label>
            <input type="text" name="txtid" id="asun"/>
            
            <label for="dep" id="textD"><a> DEPENDECIA:</a></label>
            <select name="txtdependencia" id="dep">
              <option></option>
              <option value=1>Sistemas</option>
              <option value=2>Financiera</option>
              </select>            
            
            <input type="submit" name="submit" value="Agregar" id="acep"/>
        </form>
         <div id="cancelar"><a href="estandar.php">X</a></div>
        
    </body>
    </div>
    
</hmtl>