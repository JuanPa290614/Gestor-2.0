function validar() {
    
    
    
    var nombre, apellido, email, usuario, contraseña, confirmarcontra, tipoUser, dependencia , expresion;
    
    nombre = document.getElementById("nom").value;
    apellido = document.getElementById("ape").value;
    email = document.getElementById("email").value;
    usuario = document.getElementById("use").value;
    contraseña = document.getElementById("pas").value;
    confirmarcontra = document.getElementById("pasa").value;
    tipoUser = document.getElementById("tip").value;
    dependencia = document.getElementById("dep").value;
    
    
    
    if(nombre === ""){  
        swal('Oops...','No ha ingresado el nombre!', 'error');
       document.getElementById("nom").style.borderBottomColor = "red";        
        return false;
                
    }else if (apellido === ""){        
       document.getElementById("ape").style.borderBottomColor = "red";       
       swal('Oops...','No ha ingresado el apellido!', 'error');
       return false; 
        
        
    }else if (email === ""){        
       document.getElementById("email").style.borderBottomColor = "red";       
       swal('Oops...','No ha ingresado el correo!', 'error');
        return false;
        
             
    
       
   
        
        
    } 
    var expr = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    
    if ( !expr.test(email) ){
        
       swal('Oops...','El correo es invalido!', 'error');
     return false;
        
    }else if (usuario === ""){        
       document.getElementById("use").style.borderBottomColor = "red";       
       swal('Oops...','No ha ingresado el usuario!', 'error');
       return false;
        
        
    }else if (contraseña === ""){        
       document.getElementById("pas").style.borderBottomColor = "red";       
        swal('Oops...','La contraseña es necesaria!', 'error');
       return false;
        
        
    }else if (confirmarcontra === ""){        
       document.getElementById("pasa").style.borderBottomColor = "red";       
        swal('Oops...','Necesitas confirmar la contraseña por seguridad!', 'error');
       return false;
        
        
    }else if (tipoUser === ""){        
       document.getElementById("tip").style.borderBottomColor = "red";       
        swal('Oops...','Es necesario el tipo de usuario!', 'error');
       return false;
        
        
    }else if (dependencia === ""){        
       document.getElementById("dep").style.borderBottomColor = "red";       
       swal('Oops...','Es necesario la dependendia del nuevo usuario!', 'error');
     return false;
    }
    
    
   
    
}