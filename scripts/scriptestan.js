var menu = document.getElementById("menu");
var altura = menu.offsetTop;
window.addEventListener("scroll", function(){
    if(window.pageYOffset > altura){

        menu.classList.add("fixed");
        
    }else{
        menu.classList.remove("fixed");
    }
})
//segundo pegajoso

var tip = document.getElementById("tipo");
var princ = document.getElementById("princi");
var infor = document.getElementById("informacionUsuario");
var fle = document.getElementById("flecha");
var configu = document.getElementById("confi");
var conteP =  document.getElementById("contenedor_paginas");
var menup = document.getElementById("menup");
var entrarP = document.getElementById("menurig");
var entraS = document.getElementById("menurigth");

window.addEventListener("scroll", function(){
    if(window.pageYOffset > altura){
        
        fle.classList.add("flechaFixed");
        configu.classList.add("confiF");
        infor.classList.add("informacionUsuarioFixed");
        princ.classList.add("fixedP");
        conteP.classList.add("fixedConteP");
        tip.classList.add("tipoFixed");
        menup.classList.add("menupFi");
        entrarP.classList.add("menurigF");
        entraS.classList.add("menurigthF");
        
    }else{
        
       
         tip.classList.remove("tipoFixed");
         fle.classList.remove("flechaFixed");
        infor.classList.remove("informacionUsuarioFixed");
        princ.classList.remove("fixedP");
        configu.classList.remove("confiF");
        conteP.classList.remove("fixedConteP");
         menup.classList.remove("menupFi");
        entrarP.classList.remove("menurigF");
        entraS.classList.remove("menurigthF");
    }
})



function informa(){
    
       if($("#informacionUsuario").css("opacity")=="0"){
    document.getElementById('informacionUsuario').style.opacity= "1";
           document.getElementById('informacionUsuario').style.zIndex= "21";
}else{
     document.getElementById('informacionUsuario').style.opacity= "0";
    document.getElementById('informacionUsuario').style.zIndex= "-10"; 
}
}

function adios(){
    swal({
  title: 'Chaito Cuidate!',
  text: 'Te extrañaremos.',
  timer: 2000
}).then(
  function () {},
  // handling the promise rejection
  function (dismiss) {
    if (dismiss === 'timer') {
      console.log('I was closed by the timer')
    }
  }
)
}

function configura(){
     if($("#confi").css("display")=="none"){
    document.getElementById('confi').style.display= "block"; 
         document.getElementById('confi').style.zIndex= "21"; 
}else{
     document.getElementById('confi').style.display= "none"; 
    document.getElementById('confi').style.zIndex= "-1"; 
}
}

function subirimg() {
    
       if($("#contenedor_paginas").css("opacity")=="0"){
    document.getElementById('contenedor_paginas').style.opacity= "1";
    document.getElementById('informacionUsuario').style.opacity= "0"; 
    $("#contenedor_paginas").load('menu_usuario.php');
     document.getElementById('contenedor_paginas').style.zIndex= "21"; 
     
    
           
}else{
     document.getElementById('contenedor_paginas').style.opacity= "0"; 
    document.getElementById('contenedor_paginas').style.zIndex= "-1"; 
    
}
    
     
    
}


function subirDocumen(){
    
if($("#contenedor_paginas").css("opacity")=="0"){
    document.getElementById('contenedor_paginas').style.opacity= "1";   
    $("#contenedor_paginas").load('nuevo_documento.php'); 
     document.getElementById('contenedor_paginas').style.zIndex= "21"; 
   
           
}else{
     document.getElementById('contenedor_paginas').style.opacity= "0";      
    document.getElementById('contenedor_paginas').style.zIndex= "-1"; 
    
}    
    
}

function reasignar(){
        
if($("#contenedor_paginas").css("opacity")=="0"){
    document.getElementById('contenedor_paginas').style.opacity= "1";
    
    $("#contenedor_paginas").load('reasignar_documento.php');   
   document.getElementById('contenedor_paginas').style.zIndex= "21"; 
           
}else{
     document.getElementById('contenedor_paginas').style.opacity= "0"; 
      document.getElementById('contenedor_paginas').style.zIndex= "-1"; 
    
}   
}

function confiP(){
        
            
if($("#contenedor_paginas").css("opacity")=="0"){
    document.getElementById('contenedor_paginas').style.opacity= "1";     
    $("#contenedor_paginas").load('configuracion_user.php'); 
    document.getElementById('contenedor_paginas').style.zIndex= "21"; 
    
   
           
}else{
     document.getElementById('contenedor_paginas').style.opacity= "0"; 
    document.getElementById('contenedor_paginas').style.zIndex= "-1"; 
    
}
    
}

function confiModule(){
        
            
if($("#contenedor_paginas").css("opacity")=="0"){
    document.getElementById('contenedor_paginas').style.opacity= "1";     
    $("#contenedor_paginas").load('configuraciones_modulo.php'); 
    document.getElementById('contenedor_paginas').style.zIndex= "21"; 
    
   
           
}else{
     document.getElementById('contenedor_paginas').style.opacity= "0"; 
    document.getElementById('contenedor_paginas').style.zIndex= "-1"; 
    
}
 
}


function esconder() {
   if(($("#contenedor_paginas").css("opacity") =="1") || ($("#informacionUsuario").css("opacity")=="1")) {
    document.getElementById('contenedor_paginas').style.opacity= "0";     
    document.getElementById('contenedor_paginas').style.zIndex= "-1"; 
    
    document.getElementById('informacionUsuario').style.opacity= "0";
    document.getElementById('informacionUsuario').style.zIndex= "-5"; 
           
}else{
     
}
}

function menupe() {
    
    if($("#nav").css("display")=="none"){
    document.getElementById("nav").style.display= "block";
    document.getElementById("menu").style.zIndex= "20";
   
   
      
}else{
    document.getElementById("nav").style.display= "none";
    document.getElementById("menu").style.zIndex= "-5";
   
}
}

function submenub(){

    $("#menurigth").click(function(){
        
        if($("#tipo").css("marginLeft") == "-100px"){
            document.getElementById("tipo").style.marginLeft= "0px";
            document.getElementById("menurigth").innerHTML = "<img src='images/meter.png' alt='menuAsialaderecha'>";
            document.getElementById("menurig").style.display= "none";
        }else{         
            document.getElementById("tipo").style.marginLeft= "-100px";
            document.getElementById("menurigth").innerHTML = "<img src='images/sacar.png' alt='menuAsialaderecha'>";
            document.getElementById("menurig").style.display= "block";
        }   
        
        
        
    });
    
    $("#menurig").click(function(){
        if($("#menu").css("marginLeft") == "-100px"){
            document.getElementById("menu").style.marginLeft= "0px";
            document.getElementById("menurig").innerHTML = "<img src='images/flechaleft.png' alt='menuAsialaderecha'>";
            document.getElementById("menurigth").style.display= "none";
        }else{         
            document.getElementById("menu").style.marginLeft= "-100px";
            document.getElementById("menurig").innerHTML = "<img src='images/flecharigth.png' alt='menuAsialaderecha'>";
            document.getElementById("menurigth").style.display= "block";
        } 
    });
     
}
