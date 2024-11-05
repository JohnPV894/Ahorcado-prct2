"use strict";

/**
 * 
 */

//Variables del juego
let diccionario=["hola","adios","computador","movil","mongodb","mysql"];
let tiempo=0;
let puntuacion=0;
let intentosRestantes=5;

//Entrada de datos
let inputLetra=undefined;

//#####################################################

function incluyeLetra(palabra,letra) {

      for (let contador = 0; contador < palabra.length; contador++) {
            if (palabra[contador]==letra) {
                  return contador;
            }

      }
      return false;
}

//JQUERY
$(document).ready(async function () {
      $(".palabraAdivinar").append(diccionario[0]);

      $(".enviar").click(function () { 
            //$("body").css("background-color", "red");
            if (incluyeLetra(diccionario[0],$(".letraEntrada").val())==false) {
                  
            }
            else if (incluyeLetra(diccionario[0],$(".letraEntrada").val())) {
                  $("var").append($(".letraEntrada").val());
            }
            
            
            
      });
});