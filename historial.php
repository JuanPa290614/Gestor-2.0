<html>
    <head>
       <link rel="shortcut icon"  type="imagen/icon" href="images/logo1.ico"/>
        <title>Historial Documentos</title>
        <link rel="stylesheet" type="text/css" href="css/stylehistory.css"/>
        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css"/>
        <link rel="stylesheet" href="css/jquery.dataTables.min.css"/>
      
      <script src="scripts/jquery.js"></script>
      <script src="scripts/jquery.dataTables.min.js"></script>      
      <script src="scripts/jquery.dataTablesDocu.js"></script>
      
      <script>
    $(document).ready(function() {
	$('#example').DataTable();
} );
    
    </script>
    </head>
        
    <body>
       <div id="til"> Historial de los documentos</div>
        <div id="tabla">
            
            <table id="example" class="display" cellspacing="0" width="100%">
            <thead><tr>
           <th>Id</th>
           <th>Usuario</th>
           <th>Apellido</th>
           <th>Usuario</th>
           <th>Fecha</th>
           </tr></thead>
               <tbody>
                
                   <?php
                
                    if (@!$iddocumento) {
                        $iddocumento = null;
                    }
                    
                    extract($_GET);
                    require("php/connect_db.php");
                    $sql=("CALL radicado_seguimientos(null, null, '$iddocumento', null, '$opcion');");
                    $query=mysqli_query($mysqli,$sql);

                    while($arreglo=mysqli_fetch_array($query)){

                        echo "<tr>";
                            echo "<td>$arreglo[0]</td>";
                            echo "<td>$arreglo[1]</td>";
                            echo "<td>$arreglo[2]</td>";
                            echo "<td>$arreglo[3]</td>";
                            echo "<td>$arreglo[4]</td>";
                        echo "</tr>";
				}
			?>
           </tbody>
    </table>
            
            
        </div>
    </body>
</html>