document.getElementById("btn-register").addEventListener("click",register);
document.getElementById("btn-login").addEventListener("click",login);
window.addEventListener("resize",anchoPagina)

let formulario_login = document.querySelector(".formulario__login");
let formulario_register = document.querySelector(".formulario__register");
let formulario_proveedor_login = document.querySelector(".formulario_proveedor-login");
let formulario_proveedor_register = document.querySelector(".formulario_proveedor-register");
let contenedor_login_register = document.querySelector(".contenedor-login-register");
let caja_trasera_login = document.querySelector(".caja_trasera-login");
let caja_trasera_register = document.querySelector(".caja_trasera-register");
let caja_trasera_login_proveedor = document.querySelector(".caja_trasera-proveedor-login");
let caja_Trasera_register_proveedor = document.querySelector(".caja_trasera-register-proveedor");

function anchoPagina(){
    if(window.innerWidth > 850){
        caja_trasera_login.style.display = "block";
        caja_trasera_register.style.display = "block";
    }
    else{
        caja_trasera_register.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.display = "none";
        formulario_login.style.display = "block";
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "0";
    }
}
anchoPagina();
function login(){
    if(window.innerWidth > 850){
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "10px";
        formulario_login.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.opacity = "0";

    }
    else{
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "block";
        caja_trasera_register.style.display = "block";
    }
}

function register(){
    if(window.innerWidth > 850){
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "410px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.opacity = "0";
        caja_trasera_login.style.opacity = "1";
    }
    else{
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "block";
        caja_trasera_register.style.display = "none";
        caja_trasera_login.style.display = "block";
        caja_trasera_login.style.opacity = "1";
        formulario_register.style.top = "10px";
    }
}