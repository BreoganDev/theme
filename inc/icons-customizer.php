<?php
function breogan_icons_customizer($wp_customize) {
    // Panel de Iconografía
    $wp_customize->add_panel('breogan_icons_panel', array(
        'title'       => __('Iconografía', 'breogan-lms-theme'),
        'priority'    => 70,
        'description' => __('Personaliza los iconos y su aspecto en todo el sitio.', 'breogan-lms-theme'),
    ));
    
    // Sección: Biblioteca de Iconos
    $wp_customize->add_section('breogan_icons_library', array(
        'title'    => __('Biblioteca de Iconos', 'breogan-lms-theme'),
        'panel'    => 'breogan_icons_panel',
        'priority' => 10,
    ));
    
    // Biblioteca de iconos a usar
    $wp_customize->add_setting('breogan_icon_library', array(
        'default'   => 'font-awesome',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_icon_library', array(
        'label'    => __('Biblioteca de Iconos', 'breogan-lms-theme'),
        'section'  => 'breogan_icons_library',
        'type'     => 'select',
        'choices'  => array(
            'font-awesome' => __('Font Awesome 6', 'breogan-lms-theme'),
            'material'     => __('Material Icons', 'breogan-lms-theme'),
            'bootstrap'    => __('Bootstrap Icons', 'breogan-lms-theme'),
            'feather'      => __('Feather Icons', 'breogan-lms-theme'),
        ),
        'description' => __('Selecciona la biblioteca de iconos que se usará en todo el sitio.', 'breogan-lms-theme'),
    ));
    
    // Estilo de Font Awesome
    $wp_customize->add_setting('breogan_fontawesome_style', array(
        'default'   => 'solid',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_fontawesome_style', array(
        'label'    => __('Estilo de Font Awesome', 'breogan-lms-theme'),
        'section'  => 'breogan_icons_library',
        'type'     => 'select',
        'choices'  => array(
            'solid'   => __('Sólido', 'breogan-lms-theme'),
            'regular' => __('Regular', 'breogan-lms-theme'),
            'light'   => __('Ligero', 'breogan-lms-theme'),
            'brands'  => __('Marcas', 'breogan-lms-theme'),
        ),
        'active_callback' => function() {
            return get_theme_mod('breogan_icon_library', 'font-awesome') === 'font-awesome';
        },
    ));
    
    // Versión de Material Icons
    $wp_customize->add_setting('breogan_material_style', array(
        'default'   => 'filled',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_material_style', array(
        'label'    => __('Estilo de Material Icons', 'breogan-lms-theme'),
        'section'  => 'breogan_icons_library',
        'type'     => 'select',
        'choices'  => array(
            'filled'    => __('Relleno', 'breogan-lms-theme'),
            'outlined'  => __('Contorno', 'breogan-lms-theme'),
            'round'     => __('Redondeado', 'breogan-lms-theme'),
            'sharp'     => __('Afilado', 'breogan-lms-theme'),
            'two-tone'  => __('Dos tonos', 'breogan-lms-theme'),
        ),
        'active_callback' => function() {
            return get_theme_mod('breogan_icon_library', 'font-awesome') === 'material';
        },
    ));
    
    // Sección: Aspecto de los Iconos
    $wp_customize->add_section('breogan_icons_appearance', array(
        'title'    => __('Aspecto de los Iconos', 'breogan-lms-theme'),
        'panel'    => 'breogan_icons_panel',
        'priority' => 20,
    ));
    
    // Tamaño base de iconos
    $wp_customize->add_setting('breogan_icon_size', array(
        'default'   => '16',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('breogan_icon_size', array(
        'label'    => __('Tamaño Base de Iconos (px)', 'breogan-lms-theme'),
        'section'  => 'breogan_icons_appearance',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 12,
            'max'  => 24,
            'step' => 1,
        ),
    ));
    
    // Color de iconos - Modo Oscuro
    $wp_customize->add_setting('breogan_icon_dark_color', array(
        'default'   => '#4A90E2',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_icon_dark_color', array(
        'label'    => __('Color Principal (Modo Oscuro)', 'breogan-lms-theme'),
        'section'  => 'breogan_icons_appearance',
        'settings' => 'breogan_icon_dark_color',
    )));
    
    // Color de iconos - Modo Claro
    $wp_customize->add_setting('breogan_icon_light_color', array(
        'default'   => '#4A90E2',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_icon_light_color', array(
        'label'    => __('Color Principal (Modo Claro)', 'breogan-lms-theme'),
        'section'  => 'breogan_icons_appearance',
        'settings' => 'breogan_icon_light_color',
    )));
    
    // Efectos al pasar el ratón
    $wp_customize->add_setting('breogan_icon_hover_effect', array(
        'default'   => 'none',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_icon_hover_effect', array(
        'label'    => __('Efecto al Pasar el Ratón', 'breogan-lms-theme'),
        'section'  => 'breogan_icons_appearance',
        'type'     => 'select',
        'choices'  => array(
            'none'    => __('Ninguno', 'breogan-lms-theme'),
            'pulse'   => __('Pulso', 'breogan-lms-theme'),
            'bounce'  => __('Rebote', 'breogan-lms-theme'),
            'shake'   => __('Sacudida', 'breogan-lms-theme'),
            'spin'    => __('Giro', 'breogan-lms-theme'),
            'flip'    => __('Volteo', 'breogan-lms-theme'),
        ),
    ));
    
    // Visualización de iconos sociales
    $wp_customize->add_setting('breogan_social_icons_style', array(
        'default'   => 'normal',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_social_icons_style', array(
        'label'    => __('Estilo de Iconos Sociales', 'breogan-lms-theme'),
        'section'  => 'breogan_icons_appearance',
        'type'     => 'select',
        'choices'  => array(
            'normal'  => __('Normal', 'breogan-lms-theme'),
            'circle'  => __('Círculo', 'breogan-lms-theme'),
            'square'  => __('Cuadrado', 'breogan-lms-theme'),
            'rounded' => __('Redondeado', 'breogan-lms-theme'),
        ),
    ));
    
    // Modo de color para iconos sociales
    $wp_customize->add_setting('breogan_social_icons_color_mode', array(
        'default'   => 'brand',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_social_icons_color_mode', array(
        'label'    => __('Colores de Iconos Sociales', 'breogan-lms-theme'),
        'section'  => 'breogan_icons_appearance',
        'type'     => 'select',
        'choices'  => array(
            'brand'    => __('Colores de Marca', 'breogan-lms-theme'),
            'monochrome' => __('Monocromático', 'breogan-lms-theme'),
            'theme'    => __('Color del Tema', 'breogan-lms-theme'),
        ),
    ));
    
    // Sección: Iconos Específicos
    $wp_customize->add_section('breogan_specific_icons', array(
        'title'    => __('Iconos Específicos', 'breogan-lms-theme'),
        'panel'    => 'breogan_icons_panel',
        'priority' => 30,
    ));
    
    // Mostrar un selector visual de iconos
    $wp_customize->add_setting('breogan_icon_picker_info', array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'breogan_icon_picker_info', array(
        'label'       => __('Selector de Iconos', 'breogan-lms-theme'),
        'description' => __('Utiliza el selector visual de iconos para personalizar los iconos específicos del tema.', 'breogan-lms-theme') . '<div id="breogan-icon-picker-container"></div>',
        'section'     => 'breogan_specific_icons',
        'settings'    => 'breogan_icon_picker_info',
        'type'        => 'hidden',
    )));
    
    // Definir los iconos personalizables
    $customizable_icons = array(
        'user' => array(
            'label' => __('Usuario', 'breogan-lms-theme'),
            'default' => 'fa-user',
        ),
        'search' => array(
            'label' => __('Búsqueda', 'breogan-lms-theme'),
            'default' => 'fa-search',
        ),
        'cart' => array(
            'label' => __('Carrito', 'breogan-lms-theme'),
            'default' => 'fa-shopping-cart',
        ),
        'menu' => array(
            'label' => __('Menú', 'breogan-lms-theme'),
            'default' => 'fa-bars',
        ),
        'close' => array(
            'label' => __('Cerrar', 'breogan-lms-theme'),
            'default' => 'fa-times',
        ),
        'arrow_right' => array(
            'label' => __('Flecha Derecha', 'breogan-lms-theme'),
            'default' => 'fa-arrow-right',
        ),
        'arrow_left' => array(
            'label' => __('Flecha Izquierda', 'breogan-lms-theme'),
            'default' => 'fa-arrow-left',
        ),
        'clock' => array(
            'label' => __('Reloj', 'breogan-lms-theme'),
            'default' => 'fa-clock',
        ),
        'calendar' => array(
            'label' => __('Calendario', 'breogan-lms-theme'),
            'default' => 'fa-calendar-alt',
        ),
        'level' => array(
            'label' => __('Nivel de Curso', 'breogan-lms-theme'),
            'default' => 'fa-signal',
        ),
        'video' => array(
            'label' => __('Video', 'breogan-lms-theme'),
            'default' => 'fa-video',
        ),
        'certificate' => array(
            'label' => __('Certificado', 'breogan-lms-theme'),
            'default' => 'fa-certificate',
        ),
        'download' => array(
            'label' => __('Descarga', 'breogan-lms-theme'),
            'default' => 'fa-download',
        ),
        'infinity' => array(
            'label' => __('Infinito', 'breogan-lms-theme'),
            'default' => 'fa-infinity',
        ),
    );
    
    // Crear los controles para cada icono personalizable
    foreach ($customizable_icons as $icon_id => $icon_data) {
        $wp_customize->add_setting('breogan_icon_' . $icon_id, array(
            'default'   => $icon_data['default'],
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('breogan_icon_' . $icon_id, array(
            'label'    => $icon_data['label'],
            'section'  => 'breogan_specific_icons',
            'type'     => 'text',
            'description' => '<div class="icon-preview"><i class="' . $icon_data['default'] . '"></i></div><button class="button icon-picker-button" data-target="breogan_icon_' . $icon_id . '">' . __('Seleccionar Icono', 'breogan-lms-theme') . '</button>',
        ));
    }
    
    // ESTA ES LA PARTE NUEVA: Integrar secciones de estadísticas y características en el panel de iconografía
    
    // Verificar si las secciones existen antes de intentar moverlas
    if ($wp_customize->get_section('breogan_stats_settings')) {
        // Mover la sección de estadísticas al panel de iconografía
        $wp_customize->get_section('breogan_stats_settings')->panel = 'breogan_icons_panel';
        $wp_customize->get_section('breogan_stats_settings')->priority = 40;
        
        // Opcional: Mejorar el título para indicar que es parte del panel de iconografía
        $wp_customize->get_section('breogan_stats_settings')->title = __('Iconos de Estadísticas', 'breogan-lms-theme');
    }
    
    if ($wp_customize->get_section('breogan_features_settings')) {
        // Mover la sección de características al panel de iconografía
        $wp_customize->get_section('breogan_features_settings')->panel = 'breogan_icons_panel';
        $wp_customize->get_section('breogan_features_settings')->priority = 50;
        
        // Opcional: Mejorar el título para indicar que es parte del panel de iconografía
        $wp_customize->get_section('breogan_features_settings')->title = __('Iconos de Características', 'breogan-lms-theme');
    }
    
    // Fin de la parte nueva
}
add_action('customize_register', 'breogan_icons_customizer');

function breogan_apply_icon_styles() {
    // Colores para modo oscuro
    $icon_dark_primary = get_theme_mod('breogan_icon_dark_mode_primary_color', '#4A90E2');
    $icon_dark_secondary = get_theme_mod('breogan_icon_dark_mode_secondary_color', '#00B3E3');
    
    // Colores para modo claro
    $icon_light_primary = get_theme_mod('breogan_icon_light_mode_primary_color', '#000000'); // Negro por defecto
    $icon_light_secondary = get_theme_mod('breogan_icon_light_mode_secondary_color', '#000000'); // Negro por defecto
    
    $custom_css = "
        /* Iconos principales en modo oscuro */
        body:not(.light-mode) .stats-icon i,
        body:not(.light-mode) .stat-icon i,
        body:not(.light-mode) .stats-section .stats-icon i {
            color: {$icon_dark_primary} !important;
        }
        
        /* Iconos principales en modo claro */
        body.light-mode .stats-icon i,
        body.light-mode .stat-icon i,
        body.light-mode .stats-section .stats-icon i {
            color: {$icon_light_primary} !important;
        }
        
        /* Iconos de features en modo oscuro */
        body:not(.light-mode) .features-grid .feature-item .features-icon i {
            color: {$icon_dark_primary} !important;
        }
        
        /* Iconos de features en modo claro */
        body.light-mode .features-grid .feature-item .features-icon i {
            color: {$icon_light_secondary} !important;
        }
    ";
    wp_add_inline_style('breogan-lms-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'breogan_apply_icon_styles', 99);

