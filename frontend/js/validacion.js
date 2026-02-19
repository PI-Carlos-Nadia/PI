document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("#form form");
  if (!form) return;

  const campos = ["nombre", "correo", "ciclo", "telefono", "consent"];
  campos.forEach(id => {
    const input = document.getElementById(id);
    if (!input) return;

    input.addEventListener("blur", () => validarCampo(input));
    input.addEventListener("input", () => {
      if (input.closest(".campo")?.classList.contains("campo--error")) {
        validarCampo(input);
      }
    });
  });

  form.addEventListener("submit", (e) => {
    if (!validarFormulario()) {
      e.preventDefault();
      const primerError = form.querySelector(".campo--error");
      primerError?.scrollIntoView({ behavior: "smooth", block: "center" });
    }
  });
});

function validarCampo(input) {
  const campo = input.closest(".campo");
  const spanError = campo?.querySelector(".error");
  if (!campo || !spanError) return true;

  const mensaje = getMensajeError(input);

  if (mensaje) {
    campo.classList.add("campo--error");
    campo.classList.remove("campo--ok");
    spanError.textContent = mensaje;
    return false;
  } else {
    campo.classList.remove("campo--error");
    campo.classList.add("campo--ok");
    spanError.textContent = "";
    return true;
  }
}

function validarFormulario() {
  const campos = ["nombre", "correo", "ciclo", "telefono", "consent"];
  let isValid = true;

  campos.forEach(id => {
    const input = document.getElementById(id);
    if (input && !validarCampo(input)) {
      isValid = false;
    }
  });

  return isValid;
}

function getMensajeError(input) {
  if (input.type === "checkbox") {
    return input.checked ? "" : "Debes aceptar el consentimiento";
  }

  if (input.validity.valueMissing) {
    return "Este campo es obligatorio";
  }

  switch (input.id) {
    case "nombre":
      if (input.validity.tooShort) return `El nombre debe tener al menos ${input.minLength} caracteres`;
      if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(input.value)) return "El nombre solo puede contener letras";
      break;

    case "correo":
      if (input.validity.typeMismatch) return "Introduce un correo electrónico válido";
      break;

    case "ciclo":
      if (!input.value) return "Selecciona un ciclo";
      break;

    case "telefono":
      if (!/^\d+$/.test(input.value)) return "El teléfono debe contener solo números";
      if (input.value.length < 9) return "El teléfono debe tener al menos 9 dígitos";
      break;
  }

  return "";
}