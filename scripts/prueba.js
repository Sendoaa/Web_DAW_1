document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();
  
    // Obtén los valores de los campos del formulario
    var id = document.querySelector('input[name="id"]').value;
    var href = document.querySelector('input[name="href"]').value;
    var imagen = document.querySelector('input[name="imagen"]').value;
    var texto = document.querySelector('textarea[name="texto"]').value;
  
    // Crea un nuevo objeto XMLHttpRequest
    var xhr = new XMLHttpRequest();
  
    // Configura el manejador de eventos onload del objeto XMLHttpRequest
    xhr.onload = function() {
      if (xhr.status >= 200 && xhr.status < 300) {
        // Parsea el documento XML
        var doc = xhr.responseXML;
  
        // Crea un nuevo elemento de noticia
        var noticia = doc.createElement('noticia');
        noticia.setAttribute('id', id);
        noticia.setAttribute('href', href);
        noticia.setAttribute('imagen', imagen);
        noticia.textContent = texto;
  
        // Agrega el nuevo elemento de noticia al documento XML
        doc.querySelector('seccion').appendChild(noticia);
  
        // Serializa el documento XML a una cadena de texto
        var serializer = new XMLSerializer();
        var xmlStr = serializer.serializeToString(doc);
  
        // Aquí puedes guardar la cadena de texto XML de vuelta al servidor
        console.log(xmlStr);
      } else {
        console.log('La solicitud falló');
      }
    };
  
    // Abre y envía la solicitud
    xhr.open('GET', 'noticias.xml');
    xhr.responseType = 'document';
    xhr.send();
  });