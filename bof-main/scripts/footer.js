document.addEventListener('DOMContentLoaded', function () {
    // Obtener la referencia al elemento del footer
    var footer = document.querySelector('.footer'); // Cambié 'footer' por '.footer'
  
    // Crear los elementos y agregar el contenido del footer
    var ul = document.createElement('ul');
    ul.innerHTML = `
    <div>
    <ul>
      <li><img class="logopie" src="../imagenes/logos/nofondo.png" alt=""></li>
      <li><p>© 2023 NSLA Enterprises LLC. NSLA and the NSLA shield design are registered trademarks of the National Football League.The team names, logos and uniform designs are registered trademarks of the teams indicated. All other NSLA-related trademarks are trademarks of the National Football League. NSLA footage © NSLA Productions LLC.</p></li>
      <li class="terms">
        <a href="privacidad.html">Política de Privacidad</a>
        <a href="terminos.html">Terminos de Servicio</a>
        <a href="">Términos y Condiciones de Subscripción</a>
        <a href="">Tus Ajustes de Privacidad</a>
        <a href="">Ajustes de Cookies</a>
      </li>
    </ul>
  </div>
    `;
  
    // Agregar la lista creada al footer
    footer.appendChild(ul);
});
