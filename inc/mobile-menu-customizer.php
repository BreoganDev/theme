<?php
/**
 * Customizador para el menú móvil del tema
 * Permite personalizar colores, tipografía y efectos hover
 *
 * @package Breogan_LMS_Theme
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Añadir opciones de personalización del menú móvil al personalizador
 */
function breogan_mobile_menu_customizer($wp_customize) {
    // Panel para menú móvil
    $wp_customize->add_panel('breogan_mobile_menu_panel', array(
        'title'       => __('Menú Móvil', 'breogan-lms-theme'),
        'priority'    => 50,
        'description' => __('Personaliza el aspecto y funcionamiento del menú móvil.', 'breogan-lms-theme'),
    ));
    
    // ====================================
    // SECCIÓN: COLORES DEL MENÚ MÓVIL
    // ====================================
    
    $wp_customize->add_section('breogan_mobile_menu_colors', array(
        'title'    => __('Colores', 'breogan-lms-theme'),
        'panel'    => 'breogan_mobile_menu_panel',
        'priority' => 10,
    ));
    
    // MODO OSCURO - Color de fondo del panel
    $wp_customize->add_setting('mobile_menu_dark_bg_color', array(
        'default'   => '#0B1221',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mobile_menu_dark_bg_color', array(
        'label'    => __('Color de Fondo (Modo Oscuro)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_colors',
        'settings' => 'mobile_menu_dark_bg_color',
    )));
    
    // MODO OSCURO - Color de texto
    $wp_customize->add_setting('mobile_menu_dark_text_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mobile_menu_dark_text_color', array(
        'label'    => __('Color de Texto (Modo Oscuro)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_colors',
        'settings' => 'mobile_menu_dark_text_color',
    )));
    
    // MODO OSCURO - Color de enlaces
    $wp_customize->add_setting('mobile_menu_dark_link_color', array(
        'default'   => '#94A3B8',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mobile_menu_dark_link_color', array(
        'label'    => __('Color de Enlaces (Modo Oscuro)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_colors',
        'settings' => 'mobile_menu_dark_link_color',
    )));
    
    // MODO OSCURO - Color de Hover
    $wp_customize->add_setting('mobile_menu_dark_hover_color', array(
        'default'   => '#4A90E2',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mobile_menu_dark_hover_color', array(
        'label'    => __('Color al Pasar el Ratón (Modo Oscuro)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_colors',
        'settings' => 'mobile_menu_dark_hover_color',
    )));
    
    // MODO OSCURO - Color de fondo del botón
    $wp_customize->add_setting('mobile_menu_dark_button_bg', array(
        'default'   => 'rgba(255, 255, 255, 0.1)',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('mobile_menu_dark_button_bg', array(
        'label'    => __('Color de Fondo del Botón (Modo Oscuro)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_colors',
        'type'     => 'text',
        'description' => __('Acepta rgba(). Ejemplo: rgba(255, 255, 255, 0.1)', 'breogan-lms-theme'),
    ));
    
    // MODO CLARO - Color de fondo del panel
    $wp_customize->add_setting('mobile_menu_light_bg_color', array(
        'default'   => '#f5f8fa',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mobile_menu_light_bg_color', array(
        'label'    => __('Color de Fondo (Modo Claro)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_colors',
        'settings' => 'mobile_menu_light_bg_color',
    )));
    
    // MODO CLARO - Color de texto
    $wp_customize->add_setting('mobile_menu_light_text_color', array(
        'default'   => '#333333',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mobile_menu_light_text_color', array(
        'label'    => __('Color de Texto (Modo Claro)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_colors',
        'settings' => 'mobile_menu_light_text_color',
    )));
    
    // MODO CLARO - Color de enlaces
    $wp_customize->add_setting('mobile_menu_light_link_color', array(
        'default'   => '#555555',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mobile_menu_light_link_color', array(
        'label'    => __('Color de Enlaces (Modo Claro)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_colors',
        'settings' => 'mobile_menu_light_link_color',
    )));
    
    // MODO CLARO - Color de Hover
    $wp_customize->add_setting('mobile_menu_light_hover_color', array(
        'default'   => '#4A90E2',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mobile_menu_light_hover_color', array(
        'label'    => __('Color al Pasar el Ratón (Modo Claro)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_colors',
        'settings' => 'mobile_menu_light_hover_color',
    )));
    
    // MODO CLARO - Color de fondo del botón
    $wp_customize->add_setting('mobile_menu_light_button_bg', array(
        'default'   => 'rgba(0, 0, 0, 0.05)',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('mobile_menu_light_button_bg', array(
        'label'    => __('Color de Fondo del Botón (Modo Claro)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_colors',
        'type'     => 'text',
        'description' => __('Acepta rgba(). Ejemplo: rgba(0, 0, 0, 0.05)', 'breogan-lms-theme'),
    ));
    
    // ====================================
    // SECCIÓN: TIPOGRAFÍA
    // ====================================
    
    $wp_customize->add_section('breogan_mobile_menu_typography', array(
        'title'    => __('Tipografía', 'breogan-lms-theme'),
        'panel'    => 'breogan_mobile_menu_panel',
        'priority' => 20,
    ));
    
    // Tamaño de texto
    $wp_customize->add_setting('mobile_menu_font_size', array(
        'default'   => '16',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('mobile_menu_font_size', array(
        'label'    => __('Tamaño de Texto (px)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_typography',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 12,
            'max'  => 24,
            'step' => 1,
        ),
    ));
    
    // Peso de la fuente
    $wp_customize->add_setting('mobile_menu_font_weight', array(
        'default'   => '500',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('mobile_menu_font_weight', array(
        'label'    => __('Peso de la Fuente', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_typography',
        'type'     => 'select',
        'choices'  => array(
            '300' => __('Ligero (300)', 'breogan-lms-theme'),
            '400' => __('Normal (400)', 'breogan-lms-theme'),
            '500' => __('Medio (500)', 'breogan-lms-theme'),
            '600' => __('Semi-Negrita (600)', 'breogan-lms-theme'),
            '700' => __('Negrita (700)', 'breogan-lms-theme'),
        ),
    ));
    
    // Transformación de texto
    $wp_customize->add_setting('mobile_menu_text_transform', array(
        'default'   => 'none',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('mobile_menu_text_transform', array(
        'label'    => __('Transformación de Texto', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_typography',
        'type'     => 'select',
        'choices'  => array(
            'none'       => __('Normal', 'breogan-lms-theme'),
            'uppercase'  => __('MAYÚSCULAS', 'breogan-lms-theme'),
            'lowercase'  => __('minúsculas', 'breogan-lms-theme'),
            'capitalize' => __('Capitalizado', 'breogan-lms-theme'),
        ),
    ));
    
    // Espaciado entre letras
    $wp_customize->add_setting('mobile_menu_letter_spacing', array(
        'default'   => '0',
        'transport' => 'refresh',
        'sanitize_callback' => 'breogan_sanitize_float',
    ));
    
    $wp_customize->add_control('mobile_menu_letter_spacing', array(
        'label'    => __('Espaciado entre Letras (px)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_typography',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => -2,
            'max'  => 5,
            'step' => 0.5,
        ),
    ));
    
    // ====================================
    // SECCIÓN: DISEÑO Y DISPOSICIÓN
    // ====================================
    
    $wp_customize->add_section('breogan_mobile_menu_layout', array(
        'title'    => __('Diseño y Disposición', 'breogan-lms-theme'),
        'panel'    => 'breogan_mobile_menu_panel',
        'priority' => 30,
    ));
    
    // Ancho del panel
    $wp_customize->add_setting('mobile_menu_width', array(
        'default'   => '280',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('mobile_menu_width', array(
        'label'    => __('Ancho del Panel (px)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_layout',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 200,
            'max'  => 400,
            'step' => 10,
        ),
    ));
    
    // Ancho máximo en porcentaje
    $wp_customize->add_setting('mobile_menu_max_width', array(
        'default'   => '80',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('mobile_menu_max_width', array(
        'label'    => __('Ancho Máximo (%)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_layout',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 50,
            'max'  => 100,
            'step' => 5,
        ),
        'description' => __('Porcentaje máximo del ancho de la pantalla.', 'breogan-lms-theme'),
    ));
    
    // Posición del panel
    $wp_customize->add_setting('mobile_menu_position', array(
        'default'   => 'right',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('mobile_menu_position', array(
        'label'    => __('Posición del Panel', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_layout',
        'type'     => 'radio',
        'choices'  => array(
            'left'  => __('Izquierda', 'breogan-lms-theme'),
            'right' => __('Derecha', 'breogan-lms-theme'),
        ),
    ));
    
    // Radio de borde del panel
    $wp_customize->add_setting('mobile_menu_border_radius', array(
        'default'   => '0',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('mobile_menu_border_radius', array(
        'label'    => __('Radio de Borde (px)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_layout',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 30,
            'step' => 2,
        ),
        'description' => __('Radio de borde para el panel del menú.', 'breogan-lms-theme'),
    ));
    
    // Espaciado entre elementos
    $wp_customize->add_setting('mobile_menu_item_spacing', array(
        'default'   => '15',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('mobile_menu_item_spacing', array(
        'label'    => __('Espaciado entre Elementos (px)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_layout',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 5,
            'max'  => 40,
            'step' => 5,
        ),
    ));
    
    // Padding interno de elementos
    $wp_customize->add_setting('mobile_menu_item_padding', array(
        'default'   => '10',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('mobile_menu_item_padding', array(
        'label'    => __('Padding de Elementos (px)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_layout',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 5,
            'max'  => 30,
            'step' => 5,
        ),
    ));
    
    // ====================================
    // SECCIÓN: ANIMACIÓN Y EFECTOS
    // ====================================
    
    $wp_customize->add_section('breogan_mobile_menu_animation', array(
        'title'    => __('Animación y Efectos', 'breogan-lms-theme'),
        'panel'    => 'breogan_mobile_menu_panel',
        'priority' => 40,
    ));
    
    // Velocidad de animación
    $wp_customize->add_setting('mobile_menu_animation_speed', array(
        'default'   => '0.3',
        'transport' => 'refresh',
        'sanitize_callback' => 'breogan_sanitize_float',
    ));
    
    $wp_customize->add_control('mobile_menu_animation_speed', array(
        'label'    => __('Velocidad de Animación (s)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_animation',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 0.1,
            'max'  => 2.0,
            'step' => 0.1,
        ),
    ));
    
    // Tipo de animación
    $wp_customize->add_setting('mobile_menu_animation_type', array(
        'default'   => 'slide',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('mobile_menu_animation_type', array(
        'label'    => __('Tipo de Animación', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_animation',
        'type'     => 'select',
        'choices'  => array(
            'slide' => __('Deslizar', 'breogan-lms-theme'),
            'fade'  => __('Desvanecer', 'breogan-lms-theme'),
            'both'  => __('Deslizar y Desvanecer', 'breogan-lms-theme'),
        ),
    ));
    
    // Efecto hover para enlaces
    $wp_customize->add_setting('mobile_menu_hover_effect', array(
        'default'   => 'background',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('mobile_menu_hover_effect', array(
        'label'    => __('Efecto al Pasar el Ratón', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_animation',
        'type'     => 'select',
        'choices'  => array(
            'none'       => __('Ninguno', 'breogan-lms-theme'),
            'background' => __('Cambio de Fondo', 'breogan-lms-theme'),
            'underline'  => __('Subrayado', 'breogan-lms-theme'),
            'scale'      => __('Escalar', 'breogan-lms-theme'),
            'indent'     => __('Indentación', 'breogan-lms-theme'),
        ),
    ));
    
    // Opacidad del overlay
    $wp_customize->add_setting('mobile_menu_overlay_opacity', array(
        'default'   => '0.5',
        'transport' => 'refresh',
        'sanitize_callback' => 'breogan_sanitize_float',
    ));
    
    $wp_customize->add_control('mobile_menu_overlay_opacity', array(
        'label'    => __('Opacidad del Overlay', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_menu_animation',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 0.1,
            'max'  => 1.0,
            'step' => 0.1,
        ),
    ));
    
    // ====================================
    // SECCIÓN: BOTÓN HAMBURGUESA
    // ====================================
    
    $wp_customize->add_section('breogan_mobile_hamburger', array(
        'title'    => __('Botón Hamburguesa', 'breogan-lms-theme'),
        'panel'    => 'breogan_mobile_menu_panel',
        'priority' => 50,
    ));
    
    // Tamaño del botón
    $wp_customize->add_setting('mobile_hamburger_size', array(
        'default'   => '24',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('mobile_hamburger_size', array(
        'label'    => __('Tamaño del Botón (px)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_hamburger',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 16,
            'max'  => 40,
            'step' => 2,
        ),
    ));
    
    // Grosor de las líneas
    $wp_customize->add_setting('mobile_hamburger_thickness', array(
        'default'   => '2',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('mobile_hamburger_thickness', array(
        'label'    => __('Grosor de Líneas (px)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_hamburger',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 5,
            'step' => 1,
        ),
    ));
    
    // Color del botón - Modo Oscuro
    $wp_customize->add_setting('mobile_hamburger_dark_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mobile_hamburger_dark_color', array(
        'label'    => __('Color (Modo Oscuro)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_hamburger',
        'settings' => 'mobile_hamburger_dark_color',
    )));
    
    // Color del botón - Modo Claro
    $wp_customize->add_setting('mobile_hamburger_light_color', array(
        'default'   => '#333333',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mobile_hamburger_light_color', array(
        'label'    => __('Color (Modo Claro)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_hamburger',
        'settings' => 'mobile_hamburger_light_color',
    )));
    
    // Estilo del botón hamburguesa
    $wp_customize->add_setting('mobile_hamburger_style', array(
        'default'   => 'simple',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('mobile_hamburger_style', array(
        'label'    => __('Estilo del Botón', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_hamburger',
        'type'     => 'select',
        'choices'  => array(
            'simple'   => __('Simple', 'breogan-lms-theme'),
            'squish'   => __('Comprimido', 'breogan-lms-theme'),
            'spin'     => __('Girar', 'breogan-lms-theme'),
            'elastic'  => __('Elástico', 'breogan-lms-theme'),
            'arrow'    => __('Flecha', 'breogan-lms-theme'),
        ),
    ));
    
    // Borde para el botón hamburguesa
    $wp_customize->add_setting('mobile_hamburger_border', array(
        'default'   => 'none',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('mobile_hamburger_border', array(
        'label'    => __('Borde', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_hamburger',
        'type'     => 'select',
        'choices'  => array(
            'none'    => __('Sin borde', 'breogan-lms-theme'),
            'solid'   => __('Sólido', 'breogan-lms-theme'),
            'dashed'  => __('Discontinuo', 'breogan-lms-theme'),
            'dotted'  => __('Punteado', 'breogan-lms-theme'),
        ),
    ));
    
    // Radio de borde para el botón hamburguesa
    $wp_customize->add_setting('mobile_hamburger_border_radius', array(
        'default'   => '0',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('mobile_hamburger_border_radius', array(
        'label'    => __('Radio de Borde (px)', 'breogan-lms-theme'),
        'section'  => 'breogan_mobile_hamburger',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 50,
            'step' => 2,
        ),
        'active_callback' => function() {
            return get_theme_mod('mobile_hamburger_border', 'none') !== 'none';
        },
    ));
}
add_action('customize_register', 'breogan_mobile_menu_customizer');

/**
 * Sanitiza valores de punto flotante
 */
function breogan_sanitize_float($input) {
    return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}

/**
 * Aplicar los estilos personalizados del menú móvil
 */
function breogan_mobile_menu_customizer_styles() {
    // Recuperar valores
    // Colores
    $dark_bg = get_theme_mod('mobile_menu_dark_bg_color', '#0B1221');
    $dark_text = get_theme_mod('mobile_menu_dark_text_color', '#FFFFFF');
    $dark_link = get_theme_mod('mobile_menu_dark_link_color', '#94A3B8');
    $dark_hover = get_theme_mod('mobile_menu_dark_hover_color', '#4A90E2');
    $dark_button_bg = get_theme_mod('mobile_menu_dark_button_bg', 'rgba(255, 255, 255, 0.1)');
    
    $light_bg = get_theme_mod('mobile_menu_light_bg_color', '#f5f8fa');
    $light_text = get_theme_mod('mobile_menu_light_text_color', '#333333');
    $light_link = get_theme_mod('mobile_menu_light_link_color', '#555555');
    $light_hover = get_theme_mod('mobile_menu_light_hover_color', '#4A90E2');
    $light_button_bg = get_theme_mod('mobile_menu_light_button_bg', 'rgba(0, 0, 0, 0.05)');
    
    // Tipografía
    $font_size = get_theme_mod('mobile_menu_font_size', '16');
    $font_weight = get_theme_mod('mobile_menu_font_weight', '500');
    $text_transform = get_theme_mod('mobile_menu_text_transform', 'none');
    $letter_spacing = get_theme_mod('mobile_menu_letter_spacing', '0');
    
    // Diseño y Disposición
    $menu_width = get_theme_mod('mobile_menu_width', '280');
    $menu_max_width = get_theme_mod('mobile_menu_max_width', '80');
    $menu_position = get_theme_mod('mobile_menu_position', 'right');
    $border_radius = get_theme_mod('mobile_menu_border_radius', '0');
    $item_spacing = get_theme_mod('mobile_menu_item_spacing', '15');
    $item_padding = get_theme_mod('mobile_menu_item_padding', '10');
    
    // Animación
    $animation_speed = get_theme_mod('mobile_menu_animation_speed', '0.3');
    $animation_type = get_theme_mod('mobile_menu_animation_type', 'slide');
    $hover_effect = get_theme_mod('mobile_menu_hover_effect', 'background');
    $overlay_opacity = get_theme_mod('mobile_menu_overlay_opacity', '0.5');
    
    // Botón hamburguesa
    $hamburger_size = get_theme_mod('mobile_hamburger_size', '24');
    $hamburger_thickness = get_theme_mod('mobile_hamburger_thickness', '2');
    $hamburger_dark_color = get_theme_mod('mobile_hamburger_dark_color', '#FFFFFF');
    $hamburger_light_color = get_theme_mod('mobile_hamburger_light_color', '#333333');
    $hamburger_style = get_theme_mod('mobile_hamburger_style', 'simple');
    $hamburger_border = get_theme_mod('mobile_hamburger_border', 'none');
    $hamburger_border_radius = get_theme_mod('mobile_hamburger_border_radius', '0');
    
    // Construir CSS personalizado
    $custom_css = "
        /* === MENÚ MÓVIL - ESTILOS MODO OSCURO === */
        #mobile-panel {
            background-color: {$dark_bg};
            color: {$dark_text};
            width: {$menu_width}px;
            max-width: {$menu_max_width}%;
            border-radius: {$border_radius}px;
            transition: all {$animation_speed}s ease;
            " . ($menu_position === 'left' ? "left: -{$menu_width}px;" : "right: -{$menu_width}px;") . "
        }
        
        #mobile-panel.active {
            " . ($menu_position === 'left' ? "left: 0;" : "right: 0;") . "
        }
        
        #mobile-panel .mobile-menu {
            margin-bottom: {$item_spacing}px;
        }
        
        #mobile-panel .mobile-menu a {
            color: {$dark_link};
            padding: {$item_padding}px;
            font-size: {$font_size}px;
            font-weight: {$font_weight};
            text-transform: {$text_transform};
            letter-spacing: {$letter_spacing}px;
            display: block;
            transition: all {$animation_speed}s ease;
        }
        
        #mobile-panel .mobile-menu a:hover,
        #mobile-panel .mobile-menu a:focus {
            color: {$dark_hover};
            " . ($hover_effect === 'background' ? "background-color: rgba(255, 255, 255, 0.1);" : "") . "
            " . ($hover_effect === 'underline' ? "text-decoration: underline;" : "") . "
            " . ($hover_effect === 'scale' ? "transform: scale(1.05);" : "") . "
            " . ($hover_effect === 'indent' ? "padding-left: " . ($item_padding + 5) . "px;" : "") . "
        }
        
        #mobile-panel .mobile-panel-header {
            padding: {$item_padding}px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: {$item_spacing}px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        #mobile-panel .mobile-actions {
            padding-top: {$item_spacing}px;
            margin-top: {$item_spacing}px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: center;
        }
        
        #mobile-panel .icon-button {
            background-color: {$dark_button_bg};
            color: {$dark_text};
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 5px;
            cursor: pointer;
            transition: all {$animation_speed}s ease;
        }
        
        #mobile-panel .icon-button:hover {
            background-color: {$dark_hover};
            color: white;
        }
        
        #mobile-overlay {
            background-color: rgba(0, 0, 0, {$overlay_opacity});
            transition: opacity {$animation_speed}s;
            " . ($animation_type === 'fade' || $animation_type === 'both' ? "opacity: 0;" : "") . "
        }
        
        #mobile-overlay.active {
            opacity: 1;
        }
        
        /* Botón hamburguesa - Modo Oscuro */
        .mobile-toggle {
            color: {$hamburger_dark_color};
            font-size: {$hamburger_size}px;
            border: " . ($hamburger_border !== 'none' ? "1px {$hamburger_border} {$hamburger_dark_color}" : "none") . ";
            border-radius: {$hamburger_border_radius}px;
            padding: 8px;
            background: transparent;
            cursor: pointer;
            outline: none;
            display: none;
        }
        
        /* Hamburguesa personalizada */
        .hamburger-icon {
            width: {$hamburger_size}px;
            height: {$hamburger_size}px;
            position: relative;
            display: inline-block;
        }
        
        .hamburger-icon .bar {
            display: block;
            width: 100%;
            height: {$hamburger_thickness}px;
            background-color: {$hamburger_dark_color};
            position: absolute;
            left: 0;
            transition: all {$animation_speed}s ease;
        }
        
        .hamburger-icon .bar:nth-child(1) { top: 0; }
        .hamburger-icon .bar:nth-child(2) { top: 50%; transform: translateY(-50%); }
        .hamburger-icon .bar:nth-child(3) { bottom: 0; }
        
        /* Estilos específicos para cada tipo de hamburguesa */
        " . ($hamburger_style === 'spin' ? "
        .mobile-toggle.active .hamburger-icon .bar:nth-child(1) {
            transform: translateY(" . ($hamburger_size / 2 - $hamburger_thickness / 2) . "px) rotate(225deg);
        }
        .mobile-toggle.active .hamburger-icon .bar:nth-child(2) {
            opacity: 0;
        }
        .mobile-toggle.active .hamburger-icon .bar:nth-child(3) {
            transform: translateY(-" . ($hamburger_size / 2 - $hamburger_thickness / 2) . "px) rotate(-225deg);
        }
        " : "") . "
        
        " . ($hamburger_style === 'squish' ? "
        .mobile-toggle.active .hamburger-icon {
            transform: scale(0.8);
        }
        .mobile-toggle.active .hamburger-icon .bar:nth-child(1) {
            transform: translateY(" . ($hamburger_size / 2 - $hamburger_thickness / 2) . "px) rotate(45deg);
        }
        .mobile-toggle.active .hamburger-icon .bar:nth-child(2) {
            opacity: 0;
        }
        .mobile-toggle.active .hamburger-icon .bar:nth-child(3) {
            transform: translateY(-" . ($hamburger_size / 2 - $hamburger_thickness / 2) . "px) rotate(-45deg);
        }
        " : "") . "
        
        " . ($hamburger_style === 'elastic' ? "
        .mobile-toggle.active .hamburger-icon .bar:nth-child(1) {
            transform: translateY(" . ($hamburger_size / 2 - $hamburger_thickness / 2) . "px) rotate(135deg);
            transition-delay: 0.075s;
        }
        .mobile-toggle.active .hamburger-icon .bar:nth-child(2) {
            transform: rotate(-135deg);
            transition-delay: 0.075s;
        }
        .mobile-toggle.active .hamburger-icon .bar:nth-child(3) {
            transform: translateY(-" . ($hamburger_size / 2 - $hamburger_thickness / 2) . "px) rotate(-135deg);
            transition-delay: 0.075s;
        }
        " : "") . "
        
        " . ($hamburger_style === 'arrow' ? "
        .mobile-toggle.active .hamburger-icon .bar:nth-child(1) {
            width: 50%;
            transform: translateY(" . (($hamburger_size / 2) - $hamburger_thickness) . "px) translateX(10px) rotate(45deg);
        }
        .mobile-toggle.active .hamburger-icon .bar:nth-child(2) {
            transform: translateY(-50%);
        }
        .mobile-toggle.active .hamburger-icon .bar:nth-child(3) {
            width: 50%;
            transform: translateY(-" . (($hamburger_size / 2) - $hamburger_thickness) . "px) translateX(10px) rotate(-45deg);
        }
        " : "") . "
        
        /* Botón de cierre */
        #close-panel {
            color: {$dark_text};
            font-size: " . ($hamburger_size * 0.8) . "px;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 5px;
        }
        
        /* === MENÚ MÓVIL - ESTILOS MODO CLARO === */
        body.light-mode #mobile-panel {
            background-color: {$light_bg};
            color: {$light_text};
        }
        
        body.light-mode #mobile-panel .mobile-menu a {
            color: {$light_link};
        }
        
        body.light-mode #mobile-panel .mobile-menu a:hover,
        body.light-mode #mobile-panel .mobile-menu a:focus {
            color: {$light_hover};
            " . ($hover_effect === 'background' ? "background-color: rgba(0, 0, 0, 0.05);" : "") . "
        }
        
        body.light-mode #mobile-panel .mobile-panel-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        body.light-mode #mobile-panel .mobile-actions {
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        body.light-mode #mobile-panel .icon-button {
            background-color: {$light_button_bg};
            color: {$light_text};
        }
        
        body.light-mode #mobile-panel .icon-button:hover {
            background-color: {$light_hover};
            color: white;
        }
        
        body.light-mode .mobile-toggle {
            color: {$hamburger_light_color};
            border-color: {$hamburger_light_color};
        }
        
        body.light-mode .hamburger-icon .bar {
            background-color: {$hamburger_light_color};
        }
        
        body.light-mode #close-panel {
            color: {$light_text};
        }
        
        /* Responsive - Mostrar menú móvil */
        @media screen and (max-width: 991px) {
            .mobile-toggle {
                display: block;
            }
            
            .main-navigation {
                display: none;
            }
        }
    ";
    
    wp_add_inline_style('breogan-lms-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'breogan_mobile_menu_customizer_styles', 30);

/**
 * Script para controlar la funcionalidad del menú móvil
 */
function breogan_mobile_menu_script() {
    $animation_speed = get_theme_mod('mobile_menu_animation_speed', '0.3');
    $menu_width = get_theme_mod('mobile_menu_width', '280');
    $menu_position = get_theme_mod('mobile_menu_position', 'right');
    $hamburger_style = get_theme_mod('mobile_hamburger_style', 'simple');
    
    wp_add_inline_script('jquery', "
        jQuery(document).ready(function($) {
            var menuPosition = '{$menu_position}';
            var menuWidth = '{$menu_width}';
            var animationSpeed = {$animation_speed} * 1000;
            
            // Abrir menú móvil
            $('#mobile-toggle').on('click', function(e) {
                e.preventDefault();
                $(this).addClass('active');
                $('#mobile-panel').addClass('active');
                $('#mobile-overlay').addClass('active').fadeIn(animationSpeed);
                $('body').addClass('has-mobile-menu-open').css('overflow', 'hidden');
            });
            
            // Cerrar menú móvil
            function closeMenu() {
                $('#mobile-toggle').removeClass('active');
                $('#mobile-panel').removeClass('active');
                $('#mobile-overlay').removeClass('active').fadeOut(animationSpeed);
                $('body').removeClass('has-mobile-menu-open').css('overflow', '');
            }
            
            $('#close-panel').on('click', closeMenu);
            $('#mobile-overlay').on('click', closeMenu);
            $('.mobile-menu a').on('click', closeMenu);
            
            // Cerrar el menú al cambiar el tamaño de la ventana a escritorio
            $(window).on('resize', function() {
                if ($(window).width() >= 992) {
                    closeMenu();
                }
            });
            
            // Prevenir scroll en body cuando el menú está abierto (para móviles táctiles)
            $(document).on('touchmove', function(e) {
                if ($('body').hasClass('has-mobile-menu-open') && 
                    !$(e.target).closest('#mobile-panel').length) {
                    e.preventDefault();
                }
            });
        });
    ");
}
add_action('wp_enqueue_scripts', 'breogan_mobile_menu_script', 99);