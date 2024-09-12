	document.addEventListener('DOMContentLoaded', function() {
    const enlaces = document.querySelectorAll('nav ul.menu a[data-file]');
    
    enlaces.forEach(enlace => {
        enlace.addEventListener('click', function(event) {
            event.preventDefault();
            const archivo = this.getAttribute('data-file');
            cargarContenido(archivo);
        });
    });

    function cargarContenido(archivo) {
        fetch(archivo)
            .then(response => response.text())
            .then(data => {
                document.getElementById('contenedor_info').innerHTML = data;
            })
            .catch(error => {
                console.error('Error al cargar el contenido:', error);
            });
    }
});