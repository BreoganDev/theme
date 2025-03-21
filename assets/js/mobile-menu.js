/**
 * Script para manejar el menú móvil
 */
document.addEventListener('DOMContentLoaded', function() {
    // Elementos del menú móvil
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenuClose = document.querySelector('.mobile-menu-close');
    const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
    const mobileDarkModeToggle = document.getElementById('mobile-dark-mode-toggle');
    const mainDarkModeToggle = document.getElementById('dark-mode-toggle');
    const body = document.body;
    
    // Función para abrir el menú móvil
    function openMobileMenu() {
        mobileMenuOverlay.classList.add('active');
        body.classList.add('mobile-menu-open');
        
        // Prevenir el desplazamiento de la página cuando el menú está abierto
        body.style.overflow = 'hidden';
    }
    
    // Función para cerrar el menú móvil
    function closeMobileMenu() {
        mobileMenuOverlay.classList.remove('active');
        body.classList.remove('mobile-menu-open');
        
        // Restaurar el desplazamiento de la página
        body.style.overflow = '';
    }
    
    // Abrir el menú al hacer clic en el botón hamburguesa
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', openMobileMenu);
    }
    
    // Cerrar el menú al hacer clic en el botón de cierre
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', closeMobileMenu);
    }
    
    // Cerrar el menú al hacer clic en el overlay
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', function(event) {
            // Solo cerrar si se hace clic directamente en el overlay, no en su contenido
            if (event.target === mobileMenuOverlay) {
                closeMobileMenu();
            }
        });
    }
    
    // Cerrar el menú al hacer clic en un enlace del menú
    const mobileMenuLinks = document.querySelectorAll('.mobile-nav-menu a');
    mobileMenuLinks.forEach(function(link) {
        link.addEventListener('click', closeMobileMenu);
    });
    
    // Sincronizar el toggle de modo oscuro del menú móvil con el principal
    if (mobileDarkModeToggle && mainDarkModeToggle) {
        mobileDarkModeToggle.addEventListener('click', function() {
            // Simular un clic en el botón principal para mantener la lógica en un solo lugar
            mainDarkModeToggle.click();
            
            // Actualizar el icono en el menú móvil
            if (body.classList.contains('dark-mode')) {
                mobileDarkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            } else {
                mobileDarkModeToggle.innerHTML = '<i class="fas fa-moon"></i>';
            }
        });
        
        // Establecer el icono inicial correcto
        if (body.classList.contains('dark-mode')) {
            mobileDarkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
        }
    }
    
    // Cerrar el menú al cambiar el tamaño de la ventana a un tamaño grande
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 992) {
            closeMobileMenu();
        }
    });
});