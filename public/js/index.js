$("#s-1").click(function () {
  $("#s-1").attr("checked", false);
  $("#tab-1").attr("checked", true);
});
function validarEmail(valor) {
  if (/^[^\s@]+@[^\s@]+$/.test(valor)) {
    return true;
  } else {
    return false;
  }
}
function PasswordPattern() {
  return "[^a-zA-Z0-9!.,?¡¿_#]";
}
function AlphabeticAndSpacePattern() {
  return '[^a-zA-ZáéíóúaÁÉÍÓÚñÑ ]';
}
function MixtPattern() {
  return '[^a-zA-Z0-9áéíóúaÁÉÍÓÚñÑ,. -]';
}
function evaluateValue(value, pattern) {
  var regex = new RegExp(pattern, "g");
  return regex.test(value);
}
function validateLength(value, max) {
  return value.length <= max;
}
function validateLogin() {
  let email = $("#user").val();
  let pass = $("#pass").val();

  let validate = true;
  let validatePassword = true;
  if (email.length > 25) {
    validate = false;
    $("#user + span").html("Correo demasiado extenso");
  }
  if (email.length == 0) {
    validate = false;
    $("#user + span").html("Campo vacío");
  }
  if(validate){
      $("#user + span").html("");
  }
  if (evaluateValue(pass, PasswordPattern())) {
    validatePassword = false;
    $("#pass + span").html("Contraseña Inv&aacutelida");
  }
  if (pass.length > 25) {
    validatePassword = false;
    $("#pass + span").html("Contraseña demasiado extensa");
  }
  if (pass.length == 0) {
    validatePassword = false;
    $("#pass + span").html("Campo vacío");
  }
  if(validatePassword){
    $("#pass + span").html("");
}
if(validatePassword && validate){
  return true;
}else{
  return false;
}
}
