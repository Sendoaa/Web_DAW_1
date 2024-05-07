// Variables para el menú desplegable
var isOpenMenu = false;
var dropdownMenu = document.getElementById('dropdownMenu');

// Función para manejar el clic en la imagen de usuario
document.getElementById('userImage').onclick = function() {
  toggleMenu();
}

// Función para alternar el menú
function toggleMenu() {
  if (!isOpenMenu) {
    showMenu();
  } else {
    hideMenu();
  }
}

// Función para mostrar el menú
function showMenu() {
  dropdownMenu.style.display = 'block';
  isOpenMenu = true;
}

// Función para ocultar el menú
function hideMenu() {
  dropdownMenu.style.display = 'none';
  isOpenMenu = false;
}

// Manejador para clics fuera del menú
window.onclick = function(event) {
  if (!event.target.matches('#userImage')) {
    hideMenu();
  }
}

// Manejador para el enlace de cierre de sesión
document.getElementById('logoutlink').onclick = function() {
  // Agregar un pequeño retraso para asegurar que la sesión se cierre correctamente antes de recargar la página
  setTimeout(function() {
    location.reload();
  }, 500);
}

// Variables para el modal
var modal = document.getElementById("myModal");
var btnOpenModal = document.getElementById("openModal");
var spanCloseModal = document.getElementsByClassName("close")[0];

// Función para abrir el modal
btnOpenModal.onclick = function() {
  openModal();
}

// Función para cerrar el modal
spanCloseModal.onclick = function() {
  closeModal();
}

// Función para abrir el modal
function openModal() {
  modal.style.display = "block";
}

// Función para cerrar el modal
function closeModal() {
  modal.style.display = "none";
}

// Cerrar el modal si el usuario hace clic fuera de él
window.onclick = function(event) {
  if (event.target == modal) {
    closeModal();
  }
}
