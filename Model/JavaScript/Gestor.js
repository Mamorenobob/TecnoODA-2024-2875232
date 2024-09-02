document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const navList = document.getElementById('nav-list');

    menuToggle.addEventListener('click', function() {
        navList.classList.toggle('active');
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const contentDiv = document.getElementById('content');

    document.querySelectorAll('.nav-list a').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Evita la redirección

            const file = this.getAttribute('data-file');
            
            if (file) {
                fetch(file)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    })
                    .then(data => {
                        contentDiv.innerHTML = data;
                    })
                    .catch(error => {
                        contentDiv.innerHTML = `<p>Error cargando el contenido: ${error.message}</p>`;
                    });
            }
        });
    });
});
