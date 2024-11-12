"use strict";

//Variables del juego
let diccionario=["hola","adios","computador","movil","mongodb","mysql"];
let letrasInvalidas=[];//Letra introducidas por el usuario que no corresponden a la palabra oculta
let palabraOculta=diccionario[2];
let segundos=50;
let puntuacion=0;
let intentosRestantes=5;

//Entrada de datos
let inputLetra=undefined;

//#####################################################
function actualizarTemporizador(Tiempo,contenedorHtml) {
      $(contenedorHtml).append(Tiempo);
      setTimeout(() => {
            Tiempo--;
            $(contenedorHtml).empty();
            $(contenedorHtml).append(Tiempo);
      }, 1000);
      

}
//Recibe dos parametro l palabra oculta que el usuario adivinara 2 letra que recibamos del usuario
//si la palabra contiene la letra devuelve la pocision: sino la tiene devuelve falso
function incluyeLetra(palabra,letra) {
      let pocisiones=[];
      for (let contador = 0; contador < palabra.length; contador++) {
            if (palabra[contador]==letra) {
                  //console.log("incluye"+contador);
                  
                  pocisiones.push(contador+1);//Por alguna extraña razon contador necesita un +1 para funcionar correctamente
            }

      }
      if (pocisiones.length==0) {
            return false;
      }else{
            return pocisiones;
      }

}
function agregarContenedorPalabra(palabra,contenedorHtml) { 

      for (let indice = 1; indice < palabra.length+1; indice++) {//n°2 extraño pero aqui igual
            
            $(contenedorHtml).append(`<p class="letra${indice}">_</p>`);  
            $(`.letra${indice}`).data("encontrado", false);  
      }
}
function palabraDescubierta(palabra) {
      for (let indice = 1; indice <= palabra.length; indice++) {

            if ($(`.letra${indice}`).data("encontrado")==false ) {
                  //console.log($(`.letra${indice}`).data("encontrado"));
                  return false;
            }

      }
      return true;
}
async function obtenerPhp() {
      // 👇 URL to your data location
      new Promise((resolve, reject) => {
            fetch("http://localhost:3000/src/funcionalidades/recuperarDatos.php") 
            .then(response => response.json())
            .then(data => {
                  console.log(data);
                  
                resolve(data); // Aquí data es el objeto JavaScript parseado
            })
      })
}

console.log(obtenerPhp());

//JQUERY
$(document).ready(async function () {
      
      
      agregarContenedorPalabra(palabraOculta,".cadaLetra");
      $(".puntuacion").append("x",puntuacion);
      $(".tiempo").append(segundos);
      $(".palabraAdivinar").append(palabraOculta);

      const temporizador=setInterval(() => { // setInterval() ejecuta un fragmento de código de forma reiterada, con un retardo de tiempo fijo entre cada llamada. 
            segundos--;
            if (palabraDescubierta(palabraOculta) ||  segundos<=0 || intentosRestantes<=0 ) {
                  clearInterval(temporizador);
                  puntuacion=puntuacion+segundos;
                  console.log(puntuacion);
            }
            $(".tiempo").empty();
            if (segundos<10) {
                  $(".tiempo").append("0",segundos);
            }else{
            $(".tiempo").append(segundos);
            }
            $(".puntuacion").empty();
            $(".puntuacion").append("x",puntuacion);
      }, 1000);
      

    

      $(".letraEntrada").on("keydown", function(event) {  // || $(".enviar").click(function () { //Stack https://stackoverflow.com/questions/979662/how-can-i-detect-pressing-enter-on-the-keyboard-using-jquery
            if (event.key === "Enter") { // Detecta la tecla Enter
                  inputLetra=$(".letraEntrada").val();

                  if ( $(".letraEntrada").val().trim()!=""  && !(letrasInvalidas.includes(inputLetra)) ) {
                        if (incluyeLetra(palabraOculta,inputLetra)==false) {
                              console.log("Vocal No pertenece");
                              intentosRestantes--;
                              letrasInvalidas.push(inputLetra);
                        }
                        else if (incluyeLetra(palabraOculta,inputLetra)) {
      
                              for (let indice = 0; indice < incluyeLetra(palabraOculta,inputLetra).length; indice++) {
                                    
                                    $(`.letra${incluyeLetra(palabraOculta,inputLetra)[indice]}`).empty();
                                    $(`.letra${incluyeLetra(palabraOculta,inputLetra)[indice]}`).append($(".letraEntrada").val());
                                    $(`.letra${incluyeLetra(palabraOculta,inputLetra)[indice]}`).data("encontrado", true);
                                    
                              }
                              puntuacion=puntuacion+5;
                        }
                        
                  }
                  $(".letraEntrada").val("");//despues de procesar una letra limpiamos el campo        
            }
        });

        $(".boton-fijo").click(function () {
            location.reload()
        })
        $(".boton-fijo-izquiera").click(async function () {
            $(".boton-fijo-izquiera").empty()
            $(".boton-fijo-izquiera").append(await obtenerPhp());
        })

});



