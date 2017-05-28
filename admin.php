<?php
session_start();

extract($_GET);

require("php/connect_db.php");

    if(@$idborrar==2){
		
		mysqli_query($mysqli,"CALL usuarios(null, null, null, null, null, null, null, null , null, 'eliminar', $id, null, null, null);");
                    
		echo '<script>alert("REGISTRO ELIMINADO")</script> ';
		echo "<script>location.href='admin.php'</script>";
	}

if (@!$_SESSION['usuario']) {
	header("Location:index.html");
    
}elseif ($_SESSION['tipo_usuario']==1) {
	header("Location:estandar.php");
    
}
?>

<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon"  type="imagen/icon" href="images/logo1.ico"/>
	<title>Welcome to Your Files</title>	
	<!-----Css------------->
	<link type="text/css" rel="stylesheet" href="css/stylead.css">          
    <link type="text/css" rel="stylesheet" href="css/jquery.dataTables.min.css"/>
    <link type="text/css" rel="stylesheet" href="css/styleAlert2.css"/>
    <!------------SCRIPTS----------------->
    <script src="scripts/alertas2.js"></script>
   <script src="scripts/alertas.js"></script>
   <script src="scripts/jquery.js"></script>  
	<script src="scripts/jquery-1.12.4.js"></script>
	<script src="scripts/jquery.dataTables.min.js">
	</script>
	
	<script>
        $(document).ready(function() {
    $('table.display').DataTable();
} );
   
    </script>
    	
	<script>
        
   $(window).load(function () {
       
       $('#contenedor').hide();
       
   });
      
    </script>

</head>
<body>

<div id="menu" class="menu">
  
    <ul class="nav" id="nav">
       <li><a onclick="menupe()" style="background-color: #383028; cursor:pointer;" > 
       <div id="imagenP">
        <?php echo '<img src="'.$_SESSION['foto'].'" width="39" height="44" style="border-radius: 46px 46px 46px 46px;
        -moz-border-radius: 46px 46px 46px 46px;
        -webkit-border-radius: 46px 46px 46px 46px;
        cursor: pointer;"/>';?></div>
        <strong><?php echo $_SESSION['usuario'];?></strong></a></li>
        <li><a href="registrar.php">Registar Usuario</a></li>
        <li><a onclick="submenu()">Consultar</a>
        <ul id="navi" class="navi">
            <li><a target="_blank" href="historial.php?opcion=eliminados">Eliminados</a></li>   
            <li><a onclick="usuario()">Usuarios</a></li>
            <li><a onclick="documents()">Archivos</a></li>
        </ul>
        </li>
        <li onclick="adios()"><a href="php/desconectar.php" >Cerrar Sesi&oacute;n</a></li>
    </ul>
    <div class="menup" id="menup" onclick="menupe()"><img src="images/formas.png" width="39" height="44"/></div>   
</div>
<!---------------------------------------tabla usuarios----------------------------------------------------------->

<div id="usuarios">
  <div id="titu">ESTOS SON TODOS LOS USUARIOS</div>
   <div id="tablaU">
      <table id="" class="display" cellspacing="0" width="100%">
       <thead><tr>
           <th>Id</th>
           <th>Nombre</th>
           <th>Apellido</th>
           <th>Usuario</th>
           <th>Email</th>
           <th>Tipo_Usuario</th>
           <th>Dependencia</th>
           <th>Fecha Nacimiento</th>
           <th>Editar</th>
           <th>Borrar</th>
           </tr></thead>
               <tbody>
                
                 <?php
            
                 require("php/connect_db.php");
				 $sql=("CALL usuarios(null, null, null, null, null, null, null, null , null, 'admin', null, null, null, null);");
				 $query=mysqli_query($mysqli,$sql);
            
				 while($arreglo=mysqli_fetch_array($query)){
                     
				  	echo "<tr>";
				    	echo "<td>$arreglo[0]</td>";
				    	echo "<td>$arreglo[1]</td>";
				    	echo "<td>$arreglo[2]</td>";
				    	echo "<td>$arreglo[3]</td>";
                        echo "<td>$arreglo[4]</td>";
				    	echo "<td>$arreglo[5]</td>";
                        echo "<td>$arreglo[6]</td>";
                        echo "<td>$arreglo[7]</td>";

echo "<td><a href='editar.php?usuario=$arreglo[3]'><img src='images/004-dibujar-1.png' width='40' height='40'></a></td>";
echo "<td><a href='admin.php?id=$arreglo[0]&idborrar=2'><img src='images/003-eliminar.png' width='40' height='40'></a></td>";
				
					echo "</tr>";
				}				

			?>
           </tbody>
    </table>
    </div>
</div>
<!-----------------------tabla de archivos------------------------------------------------------------------------->
 

<div id="documentos">
  <div id="titu">ESTOS SON TODOS LOS DOCUMENTOS</div>
   <div id="tablaA">
       <table id="" class="display" cellspacing="0" width="100%">
        <thead>
					<tr>
						<th>Id</th>
						<th>Asunto</th>
						<th>Nombre</th>
						<th>Fecha</th>
						<th>Dependencia</th>
						<th>Estado</th>
						<th>Tipo</th>
						<th>Acciones</th>
					</tr>
				</thead>
				
				<tbody>
					<?php
                    
                 require("php/connect_db.php");
				 $sql=("CALL documentos('null','null', 'consulta_admin', null, null, null, null, null, null, null);");
				 $query=mysqli_query($mysqli,$sql);
            
				 while($arreglo=mysqli_fetch_array($query)){
                     
                     $id = $arreglo[0];
                     $id2 = $arreglo[1];
                     $link = $arreglo[8]."";
                     
				  	echo "<tr>";
				    	echo '<td><a style="color: #369;" target="_blank" href="historial.php?iddocumento='.$id.'&opcion=consultar">'.$arreglo[0].'</a></td>';
				    	echo "<td>$arreglo[2]</td>";
				    	echo '<td><a style="color: #369;" target="_blank" href="'.$link.'">'.$arreglo[3].'</a></td>';
				    	echo "<td>$arreglo[4]</td>";
                        echo "<td>$arreglo[5]</td>";
                        echo "<td>$arreglo[6]</td>";
                        echo "<td>$arreglo[7]</td>";

                    echo "<td>
                    <a href='php/archivar_documento.php?id2=$id2'><img src='images/archivar.png' width='40' height='40'></a>
                    <a href=''><img src='images/004-dibujar-1.png' width='40' height='40'></a>
                    <a href='php/eliminar_documento.php?id=$id'><img src='images/003-eliminar.png' width='40' height='40'></a>
                    </td>";
				
					echo "</tr>";
				}
			?>
				</tbody>
    </table>
       
    </div>
</div>

<!-------------------------------------------restos----------------------------------------------------------------->



<div id="restos">

<div id="principal">
    <div class="slider">
       <a href="index.html"><button id="more_event"></button></a>
       <button id="more_eventh"><a href="eventos.php">ACTUALIZAR EVENTOS</a></button>
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
</div>


</div>

<!----------------------------------------------eventos------------------------------------------->

    
    <script src="scripts/scriptadmin.js"></script>

<!----------------------cargador-------------->
  <div id="contenedor">
  <div class="loader" id="loader">Loading...</div>
</div>

</body>
</html>