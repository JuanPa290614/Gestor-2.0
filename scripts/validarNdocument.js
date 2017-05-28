function validar() {
    
    
    
    var asunto, tipoducment, dependencia,nuevo_doc;
    
    asunto = document.getElementById("asun").value;
    dependencia = document.getElementById("dep").value;
    tipoducment = document.getElementById("tipodoc").value;
    nuevo_doc = document.getElementById("btn_enviar").value;
    
    
    
    if(nuevo_doc == ""){
        swal('Oops...','No ha subido el domuneto!', 'error');       document.getElementById("file").style.backgroundColor = "red";        
        return false; 
    }
    
    if(asunto === ""){  
        
        swal('Oops...','No ha ingresado el asunto!', 'error');       document.getElementById("asun").style.borderBottomColor = "red";        
        return false;
                
    }else if (tipoducment === ""){        
       document.getElementById("tipodoc").style.borderBottomColor = "red";       
       swal('Oops...','No ha ingresado el tipo de dependencia!', 'error');
       return false;
                
    }else if (dependencia === ""){        
       document.getElementById("dep").style.borderBottomColor = "red";       
       swal('Oops...','No ha ingresado la dependencia!', 'error');
       return false; 
        
        
    }
   
    
}

