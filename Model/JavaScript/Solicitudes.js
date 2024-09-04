
document.getElementById('dynamicForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const nombre = document.getElementById('nombre').value;
    const cantidad = document.getElementById('cantidad').value;
    const valor = document.getElementById('valor').value.replace(/[^0-9.]/g, ''); // Remove non-numeric characters except dot
    const valorFormateado = formatCurrency(parseFloat(valor));
    const ubicacion = document.getElementById('ubicacion').value;
    const fecha = document.getElementById('fecha').value;
    const marca = document.getElementById('marca').value;
    const codigo = document.getElementById('codigo').value;
    const descripcion = document.getElementById('descripcion').value;
    const proveedor = document.getElementById('proveedor').value;

    const result = `
        <h2>Datos Enviados:</h2>
        <p><strong>Nombre:</strong> ${nombre}</p>
        <p><strong>Cantidad:</strong> ${cantidad}</p>
        <p><strong>Valor:</strong> ${valorFormateado}</p>
        <p><strong>Ubicación:</strong> ${ubicacion}</p>
        <p><strong>Fecha:</strong> ${fecha}</p>
        <p><strong>Marca:</strong> ${marca}</p>
        <p><strong>Código:</strong> ${codigo}</p>
        <p><strong>Descripción:</strong> ${descripcion}</p>
        <p><strong>Proveedor:</strong> ${proveedor}</p>
    `;

    document.getElementById('result').innerHTML = result;
});

function formatCurrency(value) {
    if (isNaN(value)) return '$0.00';
    return '$' + value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}
