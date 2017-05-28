<?php
session_start();

if (@!$_SESSION['usuario']) {    
	header("Location:index.html");
    
}elseif ($_SESSION['tipo_usuario']==0) {
    header("Location:admin.php");
}

if ($_SESSION['dependencia']==1){
    
    $dependencia_usuario = 'Sistemas';
    
}else{
    
    $dependencia_usuario = 'Financiera';
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon"  type="imagen/icon" href="images/logo1.ico"/>
	<title>Welcome to Your Files</title>
	<!----------------css-------------->
	<link rel="stylesheet" type="text/css" href="css/styleestan.css"/>
   <link type="text/css" rel="stylesheet" href="css/jquery.dataTables.css"/>
   <link type="text/css" rel="stylesheet" href="css/styleAlert2.css"/>
   <link type="text/css" rel="stylesheet" href="css/styleAlert.css"/>
   <!--------------script-------------->
   <script src="scripts/alertas2.js"></script>
   <script src="scripts/alertas.js"></script>
   <script src="scripts/jquery.min.js"></script>   
   	<script src="scripts/jquery.js"></script>
	<script src="scripts/jquery.dataTablesDocu.js"></script>
	<script>
    $(document).ready(function() {
	$('#example').DataTable();
} );
    
    </script>
     
	<script>
        
   $(window).load(function () {
       
       $('#contenedor').hide();
       
   });
      
    </script>
       
     
        
</head>
<body>

<img id="bg" src="<?php echo $_SESSION['fondo'];?>" alt="Fondo" />
<div id="principal">
     <div id="menurigth" class="menurigth" onclick="submenub()">
           <img src="images/sacar.png" alt="menuAsialaderecha">
       </div>
       <div id="menurig" class="menurig" onclick="submenub()" >
           <img src="images/flecharigth.png" alt="menuPrincipal">
       </div>
      
       <div class="slider" >
        <ul>
            <?php             
            require("php/connect_db.php");
            
            $imagen=mysqli_query($mysqli,"SELECT foto FROM eventos");
            while ($fila = mysqli_fetch_array($imagen)){            
            
            echo '<li><img src="'.$fila[0].'"></li>';
                
            }
                
           ?>         
         </ul>        
       </div>                    
       <nav class="menu" id="menu" onclick="esconder()">
           <div class="imgperfil" onclick="informa()"><?php echo '<img src="'.$_SESSION['foto'].'"/>';?></div>
            <ul class="nav" id="nav">
                         
             <li><a onclick="subirDocumen()" title="SUBIR UN DOCUMENTO"><img src="images/folders-31.png" width="70" height="70" alt="cargando"/></a></li>                           
              <li><a onclick="reasignar()" title="REASIGNAR UN DOCUMENTO"><img src="images/folders-22.png" width="70" height="70" alt="cargando"/></a></li>     
                
             <li onclick="configura()"><a  title="CONFIGURACIONES"><img src="images/folders-26.png" width="80" height="70" alt="cargando"/></a></li>                         
            </ul>
            
        </nav>
            
        
       <div class="princi" id="princi">  
       <div class="informacionUsuario" id="informacionUsuario">
       <div id="foto"><?php echo '<img src="'.$_SESSION['foto'].'"/>';?>
       <div id="cambi" onclick="subirimg()">Editar</div>
       </div>
       
      <div class="flecha" id="flecha"></div>
      <label id="usua"><?php echo $_SESSION['nombre']; echo " "; echo $_SESSION['apellido'];?></label>
      <label id="email"><?php echo $_SESSION['email'];?></label>
      <label id="tip"><?php echo $dependencia_usuario;?></label>
           <div id="cerrar" onclick="adios()"><a href="php/desconectar.php" >Cerrar Sesi&oacute;n</a></div>
      </div>
      
      <div class="confi" id="confi">
           <ul>
               <li><a onclick="confiP()" title="CONFIGURACION PERSONAL"><img src="images/confiUsu.png" /></a></li>
               <li><a onclick="confiModule()"  title="CONFIGURACION GENERAL"><img src="images/003-rueda-dentada-2.png"/></a></li>
           </ul>
       </div>        
       
       <div class="tipo" id="tipo">
          <nav class="tipoD" id="tipoD">
          <ul class="nav1">
             <li><a href="estandar.php?tipo=1&proceso=consulta_estandar">Cotizaciones</a></li>
             <li><a href="estandar.php?tipo=2&proceso=consulta_estandar">Solicitudes</a></li>
             <li><a href="estandar.php?tipo=3&proceso=consulta_estandar">Permisos</a></li>
             <li><a href="estandar.php?tipo=4&proceso=consulta_estandar">Facturas</a></li>
             <li><a href="estandar.php?proceso=consulta_archivado">Archivados</a></li>    
          </ul>           
       </nav>  
       </div>          
          <div id="tablaAr" >
         <table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Id</th>
						<th>Asunto</th>
						<th>Nombre</th>
						<th>Fecha</th>
						<th>Dependencia</th>
						<th>Estado</th>
						<th>Acciones</th>
					</tr>
				</thead>
				
				<tbody>
					<?php
                    
                    $dependencia = $_SESSION['dependencia'];
                    
                    extract($_GET);
                    
                    if (@!$tipo) {
                        $tipo = 1;
                    }
                    
                    if (@!$proceso) {
                        $proceso = 'consulta_estandar';
                    }
                    
                 require("php/connect_db.php");
				 $sql=("CALL documentos('$tipo','$dependencia', '$proceso', null, null, null, null, null, null, null);");
				 $query=mysqli_query($mysqli,$sql);
            
				 while($arreglo=mysqli_fetch_array($query)){
                     
                     $iddocumento = $arreglo[0];
                     $idradicado = $arreglo[1];
                     $link = $arreglo[8]."";
                     
				  	echo "<tr>";
				    	echo '<td><a style="color: #369;" href="detalles.php?iddocumento='.$iddocumento.'">'.$arreglo[0].'</a></td>';
				    	echo "<td>$arreglo[2]</td>";
				    	echo '<td><a style="color: #369;" target="_blank" href="'.$link.'">'.$arreglo[3].'</a></td>';
				    	echo "<td>$arreglo[4]</td>";
                        echo "<td>$arreglo[5]</td>";
                        echo "<td>$arreglo[6]</td>";

                    echo "<td>
                    <a title='Archivar el documento' href='php/archivar_documento.php?id2=$idradicado'><img src='images/archivar.png' width='40' height='40'></a>
                    <a title='Dar una respuesta al documento' 
                    
                    parce perdon pero es que quiero cargar el contestar en  el div pues no se como hacerlo ya que usted al momento de redireccionar mandas el id  gracias lol 
                    
                    href='contestar_documento.php?iddocumento=$iddocumento'><img src='images/001-blog.png' width='40' height='40'></a>
                    <a title=' eliminar el documento' href='php/eliminar_documento.php?iddocumento=$iddocumento'><img src='images/003-eliminar.png' width='40' height='40'></a>
                    </td>";
				
					echo "</tr>";
				}
			?>
				</tbody>
			</table>
          </div>            
       </div>
       <div id="contenedor_paginas" class="contenedor_paginas"></div>
       
</div> 

  
<script src="scripts/scriptestan.js"></script>
    <!--------------cargador----------------->
        <div id="contenedor">
  <div class="loader" id="loader">Loading....</div>  
</div>



</body>
</html>