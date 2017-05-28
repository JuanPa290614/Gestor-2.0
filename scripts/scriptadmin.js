var menu = document.getElementById("menu");
var navF = document.getElementById("nav");
var altura = menu.offsetTop;
window.addEventListener("scroll", function(){
    if(window.pageYOffset > altura){

        menu.classList.add("fixed");
        navF.classList.add("navF");
        
    }else{
        menu.classList.remove("fixed");
         navF.classList.remove("navF");
    }
})


function maseventos() {
     if($("#agregar").css("opacity")=="0"){
    document.getElementById("agregar").style.opacity= "1";
      document.getElementById("agregar").style.zIndex= "9";
}else{}
}

function nomaseventos () {
    if($("#agregar").css("opacity")=="1"){
    document.getElementById("agregar").style.opacity= "0";
      document.getElementById("agregar").style.zIndex= "-5";
}else{}
    
    
}


function usuario(){
    
  if($("#usuarios").css("opacity")=="0"){
    document.getElementById("usuarios").style.opacity= "1";
      document.getElementById("usuarios").style.zIndex= "9";
      document.getElementById("documentos").style.opacity= "0";
       document.getElementById("documentos").style.zIndex= "-1";
      
   
   
 }else{}
}

function documents() {
    
    if($("#documentos").css("opacity")=="0"){
    document.getElementById("documentos").style.opacity= "1";
        document.getElementById("documentos").style.zIndex= "9";
        document.getElementById("usuarios").style.opacity= "0";
        document.getElementById("usuarios").style.zIndex= "-1";
   
   
 }else{}
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

function menupe() {
    var menu = document.getElementById("menu");
   
    
   if( menu.offsetWidth < 531 ){
       
       
        if($("#nav").css("display")=="none"){
    document.getElementById("nav").style.display= "block";
    document.getElementById("menup").style.display= "none";
      
}else{
    document.getElementById("nav").style.display= "none";      document.getElementById("menup").style.display= "block";}
       
}else{
 location.href = "admin.php";
}

}

function submenu(){
       if($("#navi").css("display")=="none"){
    document.getElementById("navi").style.display= "block";
         
 }else{
     document.getElementById("navi").style.display= "none";
 }
    
}
