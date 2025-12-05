document.addEventListener("DOMContentLoaded", () => {
 console.log("JS CARGADO");
    const form = document.querySelector("#form form");


  form.addEventListener("submit", (e) => {
    if (!validarFormulario()) {
      e.preventDefault(); // Evita envío al servidor
    }
  });
});


function validarFormulario() {
  let isValid = true;

  // Limpia errores anteriores
  document.querySelectorAll(".error").forEach(el => el.textContent = "");

  const campos = ["nombre", "correo", "ciclo", "telefono"];

  campos.forEach(id => {
    const input = document.getElementById(id);
    const spanError = input.nextElementSibling;

    if (!input.checkValidity()) {
      spanError.textContent = getMensajeError(input);
      isValid = false;
    }
  });

  return isValid;
}


function getMensajeError(input) {

  if (input.validity.valueMissing) {
    return "Este campo es obligatorio";
  }

  if (input.id === "nombre") {
    if (input.validity.tooShort) {
      return "El nombre debe tener al menos 4 caracteres";
    }
    return "Nombre no válido";
  }

  if (input.id === "correo") {
    return "Introduce un correo electrónico válido";
  }

  if (input.id === "ciclo") {
    return "Selecciona un ciclo";
  }

  if (input.id === "telefono") {
    if (input.validity.tooShort) return "El teléfono debe tener al menos 9 dígitos";
    if (isNaN(input.value)) return "El teléfono debe contener solo números";
    return "Teléfono no válido";
  }

  return "Valor no válido";
}
