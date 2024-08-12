const botonPrincipal = document.getElementById('botonPrincipal');
const botonesDesplegables = document.getElementById('botonesDesplegables');

botonPrincipal.addEventListener('click', () => {
  if (botonesDesplegables.style.display === 'none') {
    botonesDesplegables.style.display = 'block';
  } else {
    botonesDesplegables.style.display = 'none';
  }
});