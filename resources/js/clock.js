function updateClock() {
    var now = new Date();
    var clock = document.getElementById('clock');
    clock.innerText = now.toLocaleTimeString();
    setTimeout(updateClock, 1000); // Actualiza el reloj cada segundo
}

// Llama a la función para iniciar el reloj cuando la página esté completamente cargada
window.addEventListener('load', function () {
    updateClock();
});