function deleteRow(button) {
    // Encuentra la fila que contiene el botón de borrar
    const row = button.parentNode.parentNode;
    
    // Elimina la fila de la tabla
    row.parentNode.removeChild(row);
    
    alert('Producto eliminado correctamente.');
}