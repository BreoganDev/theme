/**
 * Script para manejar el modo oscuro
 */
document.addEventListener('DOMContentLoaded', function() {
    // Obtener botón de toggle
    const toggleButton = document.getElementById('dark-mode-toggle');
    
    if (toggleButton) {
        // Iconos para cada modo
        const moonIcon = '<i class="fas fa-moon"></i>';
        const sunIcon = '<i class="fas fa-sun"></i>';
        
        // Comprobar estado guardado
        if (localStorage.getItem('dark-mode') === 'true') {
            document.body.classList.add('dark-mode');
            toggleButton.innerHTML = sunIcon;
        } else {
            document.body.classList.remove('dark-mode');
            toggleButton.innerHTML = moonIcon;
        }
        
        // Añadir evento de clic
        toggleButton.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            
            if (document.body.classList.contains('dark-mode')) {
                toggleButton.innerHTML = sunIcon;
                localStorage.setItem('dark-mode', 'true');
                console.log('Modo oscuro activado');
            } else {
                toggleButton.innerHTML = moonIcon;
                localStorage.setItem('dark-mode', 'false');
                console.log('Modo oscuro desactivado');
            }
        });
    } else {
        console.warn('El botón de modo oscuro no se encontró en la página');
    }
});