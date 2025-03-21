<?php

if (!function_exists('breogan_layout_customizer')) {
    function breogan_layout_customizer($wp_customize) {
        // Panel principal para el layout
        if (!$wp_customize->get_panel('breogan_layout_panel')) {
            $wp_customize->add_panel('breogan_layout_panel', array(
                'title'       => __('Layout y Estructura', 'breogan-lms-theme'),
                'priority'    => 60,
                'description' => __('Personaliza la estructura y diseño del tema.', 'breogan-lms-theme'),
            ));
        }

        // **🔹 OPCIÓN PARA ANCHO DEL SITIO (FULLWIDTH, CUSTOM, BOXED)**
        $wp_customize->add_section('breogan_general_layout', array(
            'title'    => __('Ancho del Sitio', 'breogan-lms-theme'),
            'panel'    => 'breogan_layout_panel',
            'priority' => 5,
        ));

        $wp_customize->add_setting('breogan_layout_type', array(
            'default'           => 'fullwidth',
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control('breogan_layout_type', array(
            'label'   => __('Tipo de Ancho', 'breogan-lms-theme'),
            'section' => 'breogan_general_layout',
            'type'    => 'radio',
            'choices' => array(
                'fullwidth'    => __('Ancho Completo', 'breogan-lms-theme'),
                'custom-width' => __('Ancho Personalizado', 'breogan-lms-theme'),
                'boxed'        => __('Diseño en Caja', 'breogan-lms-theme'),
            ),
        ));

        // **🔹 OPCIÓN PARA ANCHO PERSONALIZADO**
        $wp_customize->add_setting('breogan_custom_width', array(
            'default'           => '1200',
            'transport'         => 'refresh',
            'sanitize_callback' => 'absint',
        ));

        $wp_customize->add_control('breogan_custom_width', array(
            'label'       => __('Ancho Personalizado (px)', 'breogan-lms-theme'),
            'section'     => 'breogan_general_layout',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 900,
                'max'  => 1600,
                'step' => 10,
            ),
            'active_callback' => function() {
                return get_theme_mod('breogan_layout_type', 'fullwidth') === 'custom-width';
            },
        ));

        // **🔹 OPCIÓN PARA ANCHO EN CAJA**
        $wp_customize->add_setting('breogan_boxed_width', array(
            'default'           => '1200',
            'transport'         => 'refresh',
            'sanitize_callback' => 'absint',
        ));

        $wp_customize->add_control('breogan_boxed_width', array(
            'label'       => __('Ancho Máximo (Caja) (px)', 'breogan-lms-theme'),
            'section'     => 'breogan_general_layout',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 900,
                'max'  => 1400,
                'step' => 10,
            ),
            'active_callback' => function() {
                return get_theme_mod('breogan_layout_type', 'fullwidth') === 'boxed';
            },
        ));

        // **🔹 OPCIÓN PARA COLOR DE FONDO EN DISEÑO CAJA**
        $wp_customize->add_setting('breogan_boxed_bg', array(
            'default'           => '#F5F5F5',
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_boxed_bg', array(
            'label'           => __('Color de Fondo (Caja)', 'breogan-lms-theme'),
            'section'         => 'breogan_general_layout',
            'settings'        => 'breogan_boxed_bg',
            'active_callback' => function() {
                return get_theme_mod('breogan_layout_type', 'fullwidth') === 'boxed';
            },
        )));
    }
    add_action('customize_register', 'breogan_layout_customizer');
}


// Aplicar estilos de layout
// Aplicar estilos de layout
if (!function_exists('breogan_apply_layout_styles')) {
    function breogan_apply_layout_styles() {
    // Contenedor
    $container_width = get_theme_mod('breogan_container_width', '1200');
    $container_width_percentage = get_theme_mod('breogan_container_width_percentage', '90');
    $container_width_tablet = get_theme_mod('breogan_container_width_tablet', '95');
    $container_padding = get_theme_mod('breogan_container_padding', '15');
    
    // Grid
    $courses_columns_desktop = get_theme_mod('breogan_courses_columns_desktop', '3');
    $courses_columns_tablet = get_theme_mod('breogan_courses_columns_tablet', '2');
    $grid_gap = get_theme_mod('breogan_grid_gap', '20');
    
    // Espaciado
    $section_spacing = get_theme_mod('breogan_section_spacing', '60');
    $elements_spacing = get_theme_mod('breogan_elements_spacing', '20');
    $content_top_margin = get_theme_mod('breogan_content_top_margin', '30');
    $content_bottom_margin = get_theme_mod('breogan_content_bottom_margin', '60');
    
    // Bordes
    $card_border_radius = get_theme_mod('breogan_card_border_radius', '12');
    $button_border_radius = get_theme_mod('breogan_button_border_radius', '8');
    $image_border_radius = get_theme_mod('breogan_image_border_radius', '8');
    $border_style = get_theme_mod('breogan_border_style', 'solid');
    $border_width = get_theme_mod('breogan_border_width', '1');
    
    $custom_css = "
        /* Estilos de contenedor */
        .container {
            width: {$container_width_percentage}%;
            max-width: {$container_width}px;
            padding-left: {$container_padding}px;
            padding-right: {$container_padding}px;
        }
        
        /* Estilos de grid */
        .courses-grid {
            gap: {$grid_gap}px;
        }
        
        /* Selector corregido para que coincida con la estructura HTML */
        .courses-layout-grid.courses-columns-{$courses_columns_desktop} {
            grid-template-columns: repeat({$courses_columns_desktop}, 1fr);
        }
        
        /* Soporte adicional para todas las posibles columnas */
        .courses-layout-grid.courses-columns-1 {
            grid-template-columns: repeat(1, 1fr);
        }
        
        .courses-layout-grid.courses-columns-2 {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .courses-layout-grid.courses-columns-3 {
            grid-template-columns: repeat(3, 1fr);
        }
        
        .courses-layout-grid.courses-columns-4 {
            grid-template-columns: repeat(4, 1fr);
        }
        
        .courses-layout-grid.courses-columns-5 {
            grid-template-columns: repeat(5, 1fr);
        }
        
        @media (max-width: 1200px) {
            .courses-layout-grid.courses-columns-5 {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        @media (max-width: 992px) {
            /* Corrección para tablets */
            .courses-layout-grid.courses-columns-3,
            .courses-layout-grid.courses-columns-4,
            .courses-layout-grid.courses-columns-5 {
                grid-template-columns: repeat({$courses_columns_tablet}, 1fr);
            }
            
            .container {
                width: {$container_width_tablet}%;
            }
        }
        
        @media (max-width: 768px) {
            .courses-layout-grid.courses-columns-2,
            .courses-layout-grid.courses-columns-3,
            .courses-layout-grid.courses-columns-4,
            .courses-layout-grid.courses-columns-5 {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 576px) {
            .courses-layout-grid {
                grid-template-columns: 1fr !important;
            }
            
            .container {
                width: 100%;
                padding-left: 10px;
                padding-right: 10px;
            }
        }
        
        /* Espaciado */
        .courses-section, .features-section, .stats-section {
            padding-top: {$section_spacing}px;
            padding-bottom: {$section_spacing}px;
        }
        
        .hero-section {
            margin-bottom: {$section_spacing}px;
        }
        
        .site-main {
            margin-top: {$content_top_margin}px;
            margin-bottom: {$content_bottom_margin}px;
        }
        
        .feature-item, .stats-card, .curso-meta {
            margin-bottom: {$elements_spacing}px;
        }
        
        /* Bordes y redondeados */
        .course-card, .feature-item, .stats-card, .curso-content {
            border-radius: {$card_border_radius}px;
            overflow: hidden;
        }
        
        .btn, button, input[type='submit'], .pagination .page-numbers {
            border-radius: {$button_border_radius}px !important;
        }
        
        img, .curso-image img, .curso-featured-image img {
            border-radius: {$image_border_radius}px;
        }
        
        .feature-item, .stats-card, .curso-features li, .course-card {
            border-style: {$border_style};
            border-width: {$border_width}px;
            border-color: rgba(var(--primary-color-rgb), 0.1);
        }
        
        body.light-mode .feature-item,
        body.light-mode .stats-card,
        body.light-mode .curso-features li,
        body.light-mode .course-card {
            border-color: rgba(0, 0, 0, 0.1);
        }
    ";
    
// Verifica que esta acción esté correctamente configurada
add_action('wp_enqueue_scripts', 'breogan_apply_layout_styles', 25);
    
}

// Añadir JavaScript para actualización en tiempo real
function breogan_layout_live_preview() {
    wp_add_inline_script('customize-preview', "
    (function($) {
        // Contenedor
        wp.customize('breogan_container_width', function(value) {
            value.bind(function(newVal) {
                $('.container').css('max-width', newVal + 'px');
            });
        });
        
        wp.customize('breogan_container_width_percentage', function(value) {
            value.bind(function(newVal) {
                $('.container').css('width', newVal + '%');
            });
        });
        
        wp.customize('breogan_container_padding', function(value) {
            value.bind(function(newVal) {
                $('.container').css({
                    'padding-left': newVal + 'px',
                    'padding-right': newVal + 'px'
                });
            });
        });
        
        // Espaciado
        wp.customize('breogan_section_spacing', function(value) {
            value.bind(function(newVal) {
                $('.courses-section, .features-section, .stats-section').css({
                    'padding-top': newVal + 'px',
                    'padding-bottom': newVal + 'px'
                });
                $('.hero-section').css('margin-bottom', newVal + 'px');
            });
        });
        
        // Aplicar y recargar CSS para Grid
        wp.customize('breogan_courses_columns_desktop', function(value) {
            value.bind(function(newVal) {
                // Este cambio requiere recargar la página
                wp.customize.preview.send('refresh');
            });
        });
        
        wp.customize('breogan_courses_columns_tablet', function(value) {
            value.bind(function(newVal) {
                // Este cambio requiere recargar la página
                wp.customize.preview.send('refresh');
            });
        });
        
        wp.customize('breogan_grid_gap', function(value) {
            value.bind(function(newVal) {
                $('.courses-grid').css('gap', newVal + 'px');
            });
        });
        
        
    })(jQuery);
    ");
}
add_action('customize_preview_init', 'breogan_layout_live_preview');
}