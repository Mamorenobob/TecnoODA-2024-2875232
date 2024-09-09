
document.addEventListener("DOMContentLoaded", function() {
    const menuLinks = document.querySelectorAll(".navbar .menu a[data-file]");
    const contenedorInfo = document.getElementById("contenedor_info");

    menuLinks.forEach(link => {
        link.addEventListener("click", function(event) {
            event.preventDefault(); // Evita que el enlace siga su comportamiento por defecto

            const file = this.getAttribute("data-file");

            // Cargar el contenido del archivo solicitado
            fetch(file)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    // Mostrar el contenido en el div contenedor_info
                    contenedorInfo.innerHTML = data;
                })
                .catch(error => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
        });
    });
});