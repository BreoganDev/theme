(function($) {
    // Función para cargar fuentes de Google
    function loadGoogleFont(fontName) {
        if (fontName && fontName !== 'default') {
            $('head').append(`
                <link href="https://fonts.googleapis.com/css2?family=${fontName.replace(/ /g, '+')}:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
            `);
        }
    }

    // Inicializar fuente principal
    wp.customize('breogan_main_font', function(value) {
        value.bind(function(newval) {
            loadGoogleFont(newval);
            $('body, .site-main').css('font-family', `${newval}, sans-serif`);
        });
    });
    
    // Color de iconos de características
wp.customize('breogan_primary_color', function(value) {
    value.bind(function(newval) {
        // Selector más específico
        $('.stats-section .stats-icon i, .stats-section .stat-icon i, .stats-section .features-grid .features-icon i, .features-grid .feature-item .features-icon i').css('color', newval);
        
        // Actualizar variable CSS global
        $(':root').css('--primary-color', newval);
    });
});

    // Inicializar fuente de títulos
    wp.customize('breogan_heading_font', function(value) {
        value.bind(function(newval) {
            loadGoogleFont(newval);
            $('h1, h2, h3, h4, h5, h6, .section-title').css('font-family', `${newval}, sans-serif`);
        });
    });

    // Tamaño base de texto
    wp.customize('breogan_base_font_size', function(value) {
        value.bind(function(newval) {
            $('body').css('font-size', `${newval}px`);
        });
    });

    // Altura de línea
    wp.customize('breogan_line_height', function(value) {
        value.bind(function(newval) {
            $('body').css('line-height', newval);
        });
    });

    // Layout: Ancho del contenedor
    wp.customize('breogan_container_width', function(value) {
        value.bind(function(newval) {
            $('.container').css('max-width', `${newval}px`);
        });
    });

    // Layout: Porcentaje de ancho del contenedor
    wp.customize('breogan_container_width_percentage', function(value) {
        value.bind(function(newval) {
            $('.container').css('width', `${newval}%`);
        });
    });

    // Radio de borde para tarjetas
    wp.customize('breogan_card_border_radius', function(value) {
        value.bind(function(newval) {
            $('.curso-card, .course-card').css('border-radius', `${newval}px`);
        });
    });

    // Iconografía: Tamaño de iconos
    wp.customize('breogan_icon_size', function(value) {
        value.bind(function(newval) {
            $('i, .material-icons, .bi, [data-feather]').css('font-size', `${newval}px`);
        });
    });

    // Color de iconos en modo oscuro
    wp.customize('breogan_icon_dark_color', function(value) {
        value.bind(function(newval) {
            $('body:not(.light-mode) i, body:not(.light-mode) .material-icons, body:not(.light-mode) .bi, body:not(.light-mode) [data-feather]').css('color', newval);
        });
    });

    // Color de iconos en modo claro
    wp.customize('breogan_icon_light_color', function(value) {
        value.bind(function(newval) {
            $('body.light-mode i, body.light-mode .material-icons, body.light-mode .bi, body.light-mode [data-feather]').css('color', newval);
        });
    });
    
    // Colores del menú en modo oscuro
    wp.customize('breogan_dark_menu_bg', function(value) {
        value.bind(function(newval) {
            $('body:not(.light-mode) .site-header, body:not(.light-mode) #mobile-panel').css('background-color', newval);
        });
    });

    wp.customize('breogan_dark_menu_text', function(value) {
        value.bind(function(newval) {
            $('body:not(.light-mode) .nav-menu a, body:not(.light-mode) .mobile-menu a').css('color', newval);
        });
    });

    wp.customize('breogan_dark_menu_hover', function(value) {
        value.bind(function(newval) {
            $('body:not(.light-mode) .nav-menu a:hover, body:not(.light-mode) .mobile-menu a:hover').css('color', newval);
        });
    });

    // Colores del menú en modo claro
    wp.customize('breogan_light_menu_bg', function(value) {
        value.bind(function(newval) {
            $('body.light-mode .site-header, body.light-mode #mobile-panel').css('background-color', newval);
        });
    });

    wp.customize('breogan_light_menu_text', function(value) {
        value.bind(function(newval) {
            $('body.light-mode .nav-menu a, body.light-mode .mobile-menu a').css('color', newval);
        });
    });

    wp.customize('breogan_light_menu_hover', function(value) {
        value.bind(function(newval) {
            $('body.light-mode .nav-menu a:hover, body.light-mode .mobile-menu a:hover').css('color', newval);
        });
    });
    
    // Actualización de colores de iconos en modo oscuro
wp.customize('breogan_icon_dark_mode_primary_color', function(value) {
    value.bind(function(newval) {
        $('body:not(.light-mode) .stats-icon i, body:not(.light-mode) .stat-icon i, body:not(.light-mode) .features-grid .feature-item .features-icon i').css('color', newval);
    });
});

// Actualización de colores de iconos en modo claro (principales)
wp.customize('breogan_icon_light_mode_primary_color', function(value) {
    value.bind(function(newval) {
        $('body.light-mode .stats-icon i, body.light-mode .stat-icon i').css('color', newval);
    });
});

// Actualización de colores de iconos secundarios en modo claro
wp.customize('breogan_icon_light_mode_secondary_color', function(value) {
    value.bind(function(newval) {
        $('body.light-mode .features-grid .feature-item .features-icon i').css('color', newval);
    });
});

})(jQuery);(function($) {
    // Función para cargar fuentes de Google
    function loadGoogleFont(fontName) {
        if (fontName && fontName !== 'default') {
            $('head').append(`
                <link href="https://fonts.googleapis.com/css2?family=${fontName.replace(/ /g, '+')}:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
            `);
        }
    }

    // Inicializar fuente principal
    wp.customize('breogan_main_font', function(value) {
        value.bind(function(newval) {
            loadGoogleFont(newval);
            $('body, .site-main').css('font-family', `${newval}, sans-serif`);
        });
    });

    // Inicializar fuente de títulos
    wp.customize('breogan_heading_font', function(value) {
        value.bind(function(newval) {
            loadGoogleFont(newval);
            $('h1, h2, h3, h4, h5, h6, .section-title').css('font-family', `${newval}, sans-serif`);
        });
    });

    // Tamaño base de texto
    wp.customize('breogan_base_font_size', function(value) {
        value.bind(function(newval) {
            $('body').css('font-size', `${newval}px`);
        });
    });

    // Altura de línea
    wp.customize('breogan_line_height', function(value) {
        value.bind(function(newval) {
            $('body').css('line-height', newval);
        });
    });

    // Layout: Ancho del contenedor
    wp.customize('breogan_container_width', function(value) {
        value.bind(function(newval) {
            $('.container').css('max-width', `${newval}px`);
        });
    });

    // Layout: Porcentaje de ancho del contenedor
    wp.customize('breogan_container_width_percentage', function(value) {
        value.bind(function(newval) {
            $('.container').css('width', `${newval}%`);
        });
    });

    // Radio de borde para tarjetas
    wp.customize('breogan_card_border_radius', function(value) {
        value.bind(function(newval) {
            $('.curso-card, .course-card').css('border-radius', `${newval}px`);
        });
    });

    // Iconografía: Tamaño de iconos
    wp.customize('breogan_icon_size', function(value) {
        value.bind(function(newval) {
            $('i, .material-icons, .bi, [data-feather]').css('font-size', `${newval}px`);
        });
    });

    // Color de iconos en modo oscuro
    wp.customize('breogan_icon_dark_color', function(value) {
        value.bind(function(newval) {
            $('body:not(.light-mode) i, body:not(.light-mode) .material-icons, body:not(.light-mode) .bi, body:not(.light-mode) [data-feather]').css('color', newval);
        });
    });
    
     // Iconografía
    wp.customize('breogan_icon_size', function(value) {
        value.bind(function(newval) {
            $('i, .material-icons, .bi, [data-feather]').css('font-size', newval + 'px');
        });
    });

    // Layout
    wp.customize('breogan_container_width', function(value) {
        value.bind(function(newval) {
            $('.container').css('max-width', newval + 'px');
        });
    });
    })(jQuery);