<?php 

//------------------------------------------------------Iniciar variables------------------------------------------------------------//

session_start();
sleep(2);

//-------------------------------------------------Condicion de consulta------------------------------------------------------------//

                if($_SESSION['usuario']){	
                    session_destroy();
                    header("location:../index.html");
                }
                else{
                    header("location:../index.html");
                }
?>