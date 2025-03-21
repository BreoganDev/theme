(function($) {
    'use strict';
    
    // Comprobamos que jQuery está disponible
    if (typeof $ === 'undefined') {
        console.error('Parallax.js requiere jQuery para funcionar');
        return;
    }
    
    // Variables globales
    var $window = $(window);
    var $parallaxElements = $('.parallax-bg');
    var parallaxActive = $parallaxElements.length > 0;
    
    // Función principal de parallax
    function updateParallax() {
        if (!parallaxActive) return;
        
        var scrollTop = $window.scrollTop();
        
        $parallaxElements.each(function() {
            var $this = $(this);
            var elementTop = $this.offset().top;
            var elementHeight = $this.outerHeight();
            var viewportHeight = $window.height();
            
            // Verificar si el elemento está en el viewport
            if (elementTop + elementHeight < scrollTop || elementTop > scrollTop + viewportHeight) {
                return; // El elemento no es visible, no aplicamos parallax
            }
            
            // Calcular el desplazamiento de parallax
            var speed = $this.data('speed') || 0.3; // Velocidad por defecto: 0.3
            var offset = Math.round((scrollTop - elementTop) * speed);
            
            // Aplicar transformación
            $this.css({
                'transform': 'translate3d(0,' + offset + 'px, 0)'
            });
        });
    }
    
    // Inicialización del parallax
    function initParallax() {
        // No seguir si no hay elementos parallax
        if (!parallaxActive) return;
        
        // Configurar cada elemento parallax
        $parallaxElements.each(function() {
            var $this = $(this);
            
            // Asegurarnos que el elemento tenga la posición correcta
            if ($this.css('position') === 'static') {
                $this.css('position', 'relative');
            }
            
            // Verificar si hay una imagen de fondo
            var bgImage = $this.css('background-image');
            if (bgImage === 'none') {
                // Si no hay imagen, intentar obtenerla del atributo data-image
                var dataImage = $this.data('image');
                if (dataImage) {
                    $this.css('background-image', 'url(' + dataImage + ')');
                } else {
                    console.warn('Elemento parallax sin imagen de fondo:', $this);
                }
            }
            
            // Establecer propiedades CSS necesarias para parallax
            $this.css({
                'background-position': 'center center',
                'background-repeat': 'no-repeat',
                'background-size': 'cover',
                'will-change': 'transform'
            });
        });
        
        // Ejecutar primera actualización
        updateParallax();
        
        // Agregar event listeners
        $window.on('scroll.parallax', updateParallax);
        $window.on('resize.parallax', updateParallax);
        
        // Log para debug
        console.log('Parallax inicializado con', $parallaxElements.length, 'elementos');
    }
    
    // Iniciar cuando el DOM esté listo
    $(document).ready(function() {
        initParallax();
    });
    
    // Volver a inicializar si hay cambios dinámicos en la página
    $(document).on('post-load ajax-load', function() {
        // Re-detectar elementos parallax
        $parallaxElements = $('.parallax-bg');
        parallaxActive = $parallaxElements.length > 0;
        
        if (parallaxActive) {
            initParallax();
        }
    });
    
    // Exponer funciones al ámbito global para posible uso externo
    window.breoganParallax = {
        init: initParallax,
        update: updateParallax,
        refresh: function() {
            $parallaxElements = $('.parallax-bg');
            parallaxActive = $parallaxElements.length > 0;
            initParallax();
        }
    };
    
})(jQuery);
