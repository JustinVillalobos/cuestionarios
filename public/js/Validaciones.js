
function validateInt(codigo,tamanioMax){

    var value=codigo.target.value;
    var tamanio=value.length;
    tecla = (document.all) ? codigo.keyCode : codigo.which;
    if (((tecla > 47 && tecla < 58) || tecla === 8 || tecla === 13 || tecla === 6) && tamanio<=tamanioMax-1) {
        return true;
    } else {
        return false;
    }

}
function validarPalabras(evento, tamanioMax) {
    digitos = (document.all) ? evento.keyCode : evento.which;
    var value=evento.target.value;
    var tamanio=value.length;
    tecla = String.fromCharCode(digitos).toLowerCase(),
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMÑOPQRSTUVWXYZÁÉÍÓÚ";
    if (letras.indexOf(tecla) === -1 || tamanio>tamanioMax-1) {
        return false;
    }
}
function validarAlfaNumerico(evento, tamanioMax){
  digitos = (document.all) ? evento.keyCode : evento.which;
  var value=evento.target.value;
  var tamanio=value.length;
  tecla = String.fromCharCode(digitos).toLowerCase(),
          letras = " áéíóúabcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMÑOPQRSTUVWXYZÁÉÍÓÚ1234567890";
  if (letras.indexOf(tecla) === -1 || tamanio>tamanioMax-1) {
      return false;
  }
}
function validarAlfaNumericoCaracteres(evento, tamanioMax){
  digitos = (document.all) ? evento.keyCode : evento.which;
  var value=evento.target.value;
  var tamanio=value.length;
 
  tecla = String.fromCharCode(digitos).toLowerCase(),
          letras = " áéíóúabcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMÑOPQRSTUVWXYZÁÉÍÓÚ1234567890:,.;=";
  if (letras.indexOf(tecla) === -1 || tamanio>tamanioMax-1) {
      return false;
  }else{
    return true;
  }
}
function validarCorreo(evento, tamanioMax){
  digitos = (document.all) ? evento.keyCode : evento.which;
  var value=evento.target.value;
  var tamanio=value.length;
  tecla = String.fromCharCode(digitos).toLowerCase(),
          letras = "áéíóúabcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMÑOPQRSTUVWXYZÁÉÍÓÚ1234567890@.-";
  if (letras.indexOf(tecla) === -1 || tamanio>tamanioMax-1) {
      return false;
  }
}
function validarPsw(evento, tamanioMax) {
    digitos = (document.all) ? evento.keyCode : evento.which;
    var value=evento.target.value;
    var tamanio=value.length;
    tecla = String.fromCharCode(digitos).toLowerCase(),
            letras = "áéíóúabcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMÑOPQRSTUVWXYZÁÉÍÓÚ./+_!1234567890=_";
    if (letras.indexOf(tecla) === -1 || tamanio>tamanioMax-1) {
        return false;
    }
}
function validarEmail2(valor) {
  if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valor)){
    return true;
  } else {
   return false;
  }
}
function validarEmail(valor) {
  if (/^[^\s@]+@[^\s@]+$/.test(valor)) {
    return true;
  } else {
    return false;
  }
}

function AlphabeticPattern() {
  return '[^a-zA-ZáéíóúaÁÉÍÓÚñÑ]';
}
function AlphabeticAndSpacePattern() {
  return '[^a-zA-ZáéíóúaÁÉÍÓÚñÑ ]';
}
function AlphaNumericAndSpacePattern() {
  return '[^a-zA-Z0-9áéíóúaÁÉÍÓÚñÑ ]';
}
function MixtPattern() {
  return '[^a-zA-Z0-9áéíóúaÁÉÍÓÚñÑ,. -]';
}
function EmailPattern() {
  return '[^a-zA-Z0-9áéíóúaÁÉÍÓÚ,@_. ]';
}
function MixtAltPattern() {
  return '[^a-zA-Z0-9áéíóúaÁÉÍÓÚñÑ,.\\s  -]';
}

function AlphaNumericPattern() {
  return '[^a-zA-Z0-9]';
}
function PasswordPattern() {
  return '[^a-zA-Z0-9!.,?¡¿_#]';
}
function evaluateValue(value, pattern) {
  var regex = new RegExp(pattern, 'g');
  return regex.test(value);
}
function validateLength(value, max) {
  return value.length<=max;
}
function isNumber(n) {
  return Number(n) == n;
}