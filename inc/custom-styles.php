<?php
function breogan_generate_custom_styles() {
    // Obtener valores personalizados
    $primary_color = get_theme_mod('breogan_primary_color', '#4A90E2');
    $secondary_color = get_theme_mod('breogan_secondary_color', '#00B3E3');
    
    // Colores del menú (Modo Oscuro)
    $dark_menu_bg = get_theme_mod('breogan_dark_menu_bg', '#0B1221');
    $dark_menu_text = get_theme_mod('breogan_dark_menu_text', '#FFFFFF');
    $dark_menu_hover = get_theme_mod('breogan_dark_menu_hover', '#4A90E2');

    // Colores del menú (Modo Claro)
    $light_menu_bg = get_theme_mod('breogan_light_menu_bg', '#FFFFFF');
    $light_menu_text = get_theme_mod('breogan_light_menu_text', '#333333');
    $light_menu_hover = get_theme_mod('breogan_light_menu_hover', '#4A90E2');

    // Layout y espaciado
    $container_width = get_theme_mod('breogan_container_width', 1200);
    $container_width_percentage = get_theme_mod('breogan_container_width_percentage', 90);
    $card_border_radius = get_theme_mod('breogan_card_border_radius', 12);

    // Iconografía
    $icon_size = get_theme_mod('breogan_icon_size', 16);
    $icon_dark_color = get_theme_mod('breogan_icon_dark_color', $primary_color);
    $icon_light_color = get_theme_mod('breogan_icon_light_color', $primary_color);

    // Generar CSS
    $custom_css = "
    /* Iconos de stats y features */
    .stats-icon i,
    .stat-icon i,
    .features-icon i {
        color: {$primary_color} !important;
    }
    :root {
        --primary-color: {$primary_color};
        --secondary-color: {$secondary_color};
    }

    /* Estilos de Layout */
    .container {
        max-width: {$container_width}px;
        width: {$container_width_percentage}%;
    }

    /* Estilos de Tarjetas */
    .curso-card, .course-card {
        border-radius: {$card_border_radius}px;
    }

    /* Iconografía */
    body:not(.light-mode) i, 
    body:not(.light-mode) .material-icons, 
    body:not(.light-mode) .bi, 
    body:not(.light-mode) [data-feather] {
        color: {$icon_dark_color} !important;
        font-size: {$icon_size}px;
    }

    body.light-mode i, 
    body.light-mode .material-icons, 
    body.light-mode .bi, 
    body.light-mode [data-feather] {
        color: {$icon_light_color} !important;
        font-size: {$icon_size}px;
    }

    /* Menú - Modo Oscuro */
    body:not(.light-mode) .site-header,
    body:not(.light-mode) #mobile-panel {
        background-color: {$dark_menu_bg} !important;
    }

    body:not(.light-mode) .nav-menu a,
    body:not(.light-mode) .mobile-menu a {
        color: {$dark_menu_text} !important;
    }

    body:not(.light-mode) .nav-menu a:hover,
    body:not(.light-mode) .mobile-menu a:hover {
        color: {$dark_menu_hover} !important;
    }

    /* Menú - Modo Claro */
    body.light-mode .site-header,
    body.light-mode #mobile-panel {
        background-color: {$light_menu_bg} !important;
    }

    body.light-mode .nav-menu a,
    body.light-mode .mobile-menu a {
        color: {$light_menu_text} !important;
    }

    body.light-mode .nav-menu a:hover,
    body.light-mode .mobile-menu a:hover {
        color: {$light_menu_hover} !important;
    }
    ";

    return $custom_css;
}

function breogan_enqueue_custom_styles() {
    $custom_css = breogan_generate_custom_styles();
    wp_add_inline_style('breogan-lms-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'breogan_enqueue_custom_styles', 99);