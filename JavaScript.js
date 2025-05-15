// Espera a que todo el contenido de la página se haya cargado
window.onload = function () {
    const preloader = document.getElementById("preloader");
    if (preloader) {
        preloader.style.display = "none";
    }

    // Mostrar campos correctos si ya hay selección al cargar
    const tipoUsuario = document.getElementById("tipoUsuario");
    if (tipoUsuario) mostrarCampos();
};

// Función para mostrar campos según el tipo de usuario
function mostrarCampos() {
    const tipoUsuario = document.getElementById("tipoUsuario").value;
    const camposPaciente = document.getElementById("camposPaciente");
    const camposDoctor = document.getElementById("camposDoctor");

    if (tipoUsuario === "paciente") {
        camposPaciente.style.display = "block";
        camposDoctor.style.display = "none";
    } else if (tipoUsuario === "doctor") {
        camposPaciente.style.display = "none";
        camposDoctor.style.display = "block";
    }
}

// Validación del formulario de contacto
function validarFormularioContacto(event) {
    event.preventDefault();

    const nombre = document.getElementById("nombre").value;
    const email = document.getElementById("email").value;
    const motivo = document.getElementById("motivo")?.value;
    const mensaje = document.getElementById("mensaje")?.value;

    if (!motivo || !mensaje) return true;

    if (nombre === "" || email === "" || motivo === "" || mensaje === "") {
        alert("Por favor, completa todos los campos antes de enviar.");
        return false;
    }

    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regexEmail.test(email)) {
        alert("Por favor, ingresa un correo electrónico válido.");
        return false;
    }

    alert("¡Mensaje enviado exitosamente!");
    document.getElementById("formularioContacto").reset();
    return true;
}

// Validación del formulario de registro
function validarFormularioRegistro(event) {
    const tipoUsuario = document.getElementById("tipoUsuario").value;
    const nombre = document.getElementById("nombre").value;
    const email = document.getElementById("email").value;
    const telefono = document.getElementById("telefono").value;

    if (!nombre || !email || !telefono) {
        alert("Por favor, completa los campos obligatorios.");
        event.preventDefault();
        return false;
    }

    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regexEmail.test(email)) {
        alert("Por favor, ingresa un correo electrónico válido.");
        event.preventDefault();
        return false;
    }

    if (tipoUsuario === "paciente") {
        const fechaNacimiento = document.getElementById("fechaNacimiento").value;
        if (!fechaNacimiento) {
            alert("Por favor, ingresa la fecha de nacimiento.");
            event.preventDefault();
            return false;
        }
    } else if (tipoUsuario === "doctor") {
        const especialidad = document.getElementById("especialidad").value;
        const consultorio = document.getElementById("consultorio").value;
        if (!especialidad || !consultorio) {
            alert("Por favor, completa todos los campos del doctor.");
            event.preventDefault();
            return false;
        }
    }

    // Si todo es válido, se permite el envío
    return true;
}

// Detectar formularios existentes
const formularioContacto = document.getElementById("formularioContacto");
if (formularioContacto) {
    formularioContacto.addEventListener("submit", validarFormularioContacto);
}

const formularioRegistro = document.querySelector("form[action='registro.php']");
if (formularioRegistro) {
    formularioRegistro.addEventListener("submit", validarFormularioRegistro);
    const tipoUsuario = document.getElementById("tipoUsuario");
    if (tipoUsuario) tipoUsuario.addEventListener("change", mostrarCampos);
}

// Efecto visual en botones
const botones = document.querySelectorAll(".button");
botones.forEach(button => {
    button.addEventListener("mouseover", () => {
        button.style.transform = "scale(1.05)";
        button.style.transition = "transform 0.3s ease";
    });

    button.addEventListener("mouseout", () => {
        button.style.transform = "scale(1)";
    });
});

// Confirmación antes de eliminar
function confirmarEliminacion() {
    return confirm("¿Estás seguro de que deseas eliminar este registro?");
}

const botonesEliminar = document.querySelectorAll("button");
botonesEliminar.forEach(button => {
    if (button.textContent === "Eliminar") {
        button.addEventListener("click", function (event) {
            if (!confirmarEliminacion()) {
                event.preventDefault();
            }
        });
    }
});
