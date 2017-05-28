<?php
session_start();

if (@!$_SESSION['usuario']) {
	header("Location:index.html");
    
}

?>
 
 <hmtl>
    <head>
        <title>Nuevo Documento</title>
        
        <link type="text/css" rel="stylesheet" href="css/styleNuevodoc.css"/>
        <link type="text/css" rel="stylesheet" href="css/styleAlert.css"/>
        <link type="text/css" rel="stylesheet" href="css/styleAlert2.css"/>
	
        
        <!----------scrpts----------->
    
	<script src="scripts/validarNdocument.js"></script>
	<script src="scripts/alertas.js"></script>
    <script src="scripts/sweetalert2.min.js"></script>
        
    </head>
    
    <div id="til">Nuevo Documento</div>
    <div id="rest">
    <body>
        <form method="POST" action="php/registro_documento.php" enctype ="multipart/form-data" onsubmit="return validar();">
           
           
           
            <div id="file">
              <p id="texto">Subir el documento</p> 
            <input name="txtdocumento" type="file" accept="application/pdf" id="btn_enviar"  />
            </div> 
            
           <label for="asun" id="textA"><a title="EL ASUNTO QUE VA A LLEVAR EL DOCUMENTO">ASUNTO:</a></label>
            <input type="text" name="txtasunto" id="asun"/>
            
            
           <label for="tipodoc" id="textTD"><a title="Tipo Documento: Cotizaciones, Solicitudes, Perfimos....">TIPO DOCU:</a></label>
            <select name="txttipo" id="tipodoc">
              <option></option>
              <option value=1>Cotizaciones</option>
              <option value=2>Solicitudes</option>
              <option value=3>Permisos</option>
              <option value=4>Facturas</option>
              </select>
            
            
            <label for="dep" id="textD"><a title="LA DEPENDECIA A LA QUE DESEA ASIGNAR EL DOCUMENTO NUEVO ">DEPENDECIA:</a></label>
            <select name="txtdependencia" id="dep">
              <option></option>
              <option value=1>Sistemas</option>
              <option value=2>Financiera</option>
              </select> 
            
            <label for="deta" id="detale"><a title="LOS DETALLES SON OPCIONALES">DETALLES:</a></label>
            <input type="text" name="txtdetalles" id="deta"/>
            
            
            <input type="submit" name="submit" value="Agregar" id="acep"/>
        </form>
        <div id="cancelar"><a href="estandar.php">X</a></div>
        
    </body>
    </div>
    
</hmtl>
           

           