var isOpen = false;

// Handler for admin image
document.getElementById('userImage').onclick = function() {
  toggleMenu();
}

// Function to toggle the menu
function toggleMenu() {
  if (!isOpen) {
    document.getElementById('dropdownMenu').style.display = 'block';
    isOpen = true;
  } else {
    document.getElementById('dropdownMenu').style.display = 'none';
    isOpen = false;
  }
}

// Handler for clicks outside the menu
window.onclick = function(event) {
  if (!event.target.matches('#userImage')) {
    document.getElementById('dropdownMenu').style.display = 'none';
    isOpen = false;
  }
}