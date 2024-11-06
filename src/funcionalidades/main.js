"use strict";

/**
 * 
 */

//Variables del juego
let diccionario=["hola","adios","computador","movil","mongodb","mysql"];
let palabraOculta=diccionario[0];
let segundos=60;
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
function incluyeLetra(palabra,letra) {

      for (let contador = 0; contador < palabra.length; contador++) {
            if (palabra[contador]==letra) {
                  //console.log("incluye"+contador);
                  
                  return contador+1;//Por alguna extraña razon contador necesita un +1 para funcionar correctamente
            }

      }
      return false;
}
function agregarContenedorPalabra(palabra,contenedorHtml) { 

      for (let indice = 1; indice < palabra.length+1; indice++) {//n°2 extraño pero aqui igual
            
            $(contenedorHtml).append(`<p class="letra${indice}">${indice}</p>`);  
            $(contenedorHtml).data("encontrado", false);  
      }
}
function partidaFinalizada(palabra) {
      for (let indice = 1; indice <= palabra.length; indice++) {
            
            if ($(`.lista${indice}`).data("encontrado")==true || intentosRestantes===0) {
                  return true;
            }

      }
      return false;
}
//JQUERY
$(document).ready(async function () {

            $(".tiempo").append(segundos);
      const temporizador=setInterval(() => { // setInterval() ejecuta un fragmento de código de forma reiterada, con un retardo de tiempo fijo entre cada llamada. 
            segundos--;
            if (partidaFinalizada(palabraOculta)) {
                clearInterval(temporizador);
            }
            $(".tiempo").empty();
            $(".tiempo").append(segundos);
      }, 1000);


      agregarContenedorPalabra(palabraOculta,".cadaLetra");
      $(".palabraAdivinar").append(palabraOculta);

      $(".enviar").click(function () { 

            if (incluyeLetra(palabraOculta,$(".letraEntrada").val())==false) {
                  console.log("Vocal No pertenece");
                  intentosRestantes--;
            }
            else if (incluyeLetra(palabraOculta,$(".letraEntrada").val())<=palabraOculta.length) {

                  console.log(`.letra${incluyeLetra(palabraOculta,$(".letraEntrada").val())}`);
                  $(`.letra${incluyeLetra(palabraOculta,$(".letraEntrada").val())}`).empty();
                  $(`.letra${incluyeLetra(palabraOculta,$(".letraEntrada").val())}`).append($(".letraEntrada").val());
                  $(`.letra${incluyeLetra(palabraOculta,$(".letraEntrada").val())}`).data("encontrado", true)
            }
            //${incluyeLetra(palabraOculta,$(".letraEntrada").val())}
            //${incluyeLetra(palabraOculta,$(".letraEntrada").val())}
            
      });
});