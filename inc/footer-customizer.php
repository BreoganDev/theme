<?php
/**
 * Funciones para personalizar el footer
 *
 * @package Breogan_LMS_Theme
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Añadir opciones del footer al personalizador
 */
function breogan_footer_customizer_register($wp_customize) {
    // ====================================
    // FOOTER SETTINGS
    // ====================================
    
    $wp_customize->add_section('breogan_footer_settings', array(
        'title'    => __('Configuración del Footer', 'breogan-lms-theme'),
        'priority' => 90,
    ));
    
    // Descripción en el footer
    $wp_customize->add_setting('breogan_footer_description', array(
        'default'   => 'La plataforma líder para la creación y venta de cursos online. Comparte tu conocimiento y genera ingresos.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control('breogan_footer_description', array(
        'label'    => __('Descripción del Footer', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'type'     => 'textarea',
    ));
    
    // Copyright
    $wp_customize->add_setting('breogan_footer_copyright', array(
        'default'   => '&copy; ' . date('Y') . ' ' . get_bloginfo('name') . '. Todos los derechos reservados.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control('breogan_footer_copyright', array(
        'label'    => __('Texto de Copyright', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'type'     => 'textarea',
    ));
    
    // Créditos
    $wp_customize->add_setting('breogan_footer_credits', array(
        'default'   => 'Diseñado con <i class="fas fa-heart"></i> por Rocio',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control('breogan_footer_credits', array(
        'label'    => __('Créditos del footer', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'type'     => 'textarea',
        'description' => __('Puedes usar HTML para iconos, por ejemplo: &lt;i class="fas fa-heart"&gt;&lt;/i&gt;', 'breogan-lms-theme'),
    ));
    
    // Enlaces de redes sociales
    $wp_customize->add_setting('breogan_footer_facebook', array(
        'default'   => '#',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('breogan_footer_facebook', array(
        'label'    => __('URL de Facebook', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'type'     => 'url',
    ));
    
    $wp_customize->add_setting('breogan_footer_twitter', array(
        'default'   => '#',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('breogan_footer_twitter', array(
        'label'    => __('URL de Twitter', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'type'     => 'url',
    ));
    
    $wp_customize->add_setting('breogan_footer_instagram', array(
        'default'   => '#',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('breogan_footer_instagram', array(
        'label'    => __('URL de Instagram', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'type'     => 'url',
    ));
    
    $wp_customize->add_setting('breogan_footer_linkedin', array(
        'default'   => '#',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('breogan_footer_linkedin', array(
        'label'    => __('URL de LinkedIn', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'type'     => 'url',
    ));
    
    // ====================================
    // MODO OSCURO (DARK MODE)
    // ====================================
    
    // Título de la sección para Dark Mode
    $wp_customize->add_setting('breogan_footer_dark_mode_title', array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'breogan_footer_dark_mode_title', array(
        'label'    => __('CONFIGURACIÓN MODO OSCURO', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'settings' => 'breogan_footer_dark_mode_title',
        'type'     => 'hidden',
        'description' => '<hr><h3>' . __('Configuración Modo Oscuro', 'breogan-lms-theme') . '</h3>',
    )));
    
    // Color de fondo del footer - Modo Oscuro
    $wp_customize->add_setting('breogan_footer_dark_bg_color', array(
        'default'   => '#0B1221',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_footer_dark_bg_color', array(
        'label'    => __('Color de fondo (Modo Oscuro)', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'settings' => 'breogan_footer_dark_bg_color',
    )));
    
    // Color de texto del footer - Modo Oscuro
    $wp_customize->add_setting('breogan_footer_dark_text_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_footer_dark_text_color', array(
        'label'    => __('Color de texto (Modo Oscuro)', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'settings' => 'breogan_footer_dark_text_color',
    )));
    
    // Color de enlaces del footer - Modo Oscuro
    $wp_customize->add_setting('breogan_footer_dark_link_color', array(
        'default'   => '#94A3B8',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_footer_dark_link_color', array(
        'label'    => __('Color de enlaces (Modo Oscuro)', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'settings' => 'breogan_footer_dark_link_color',
    )));
    
    // Color de enlaces al pasar el mouse - Modo Oscuro
    $wp_customize->add_setting('breogan_footer_dark_link_hover_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_footer_dark_link_hover_color', array(
        'label'    => __('Color de enlaces al pasar el mouse (Modo Oscuro)', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'settings' => 'breogan_footer_dark_link_hover_color',
    )));
    
    // Color de fondo de los iconos sociales - Modo Oscuro
    $wp_customize->add_setting('breogan_footer_dark_social_bg_color', array(
        'default'   => 'rgba(255, 255, 255, 0.1)',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_footer_dark_social_bg_color', array(
        'label'    => __('Color de fondo de iconos sociales (Modo Oscuro)', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'type'     => 'text',
        'description' => __('Acepta rgba(). Ejemplo: rgba(255, 255, 255, 0.1)', 'breogan-lms-theme'),
    ));
    
    // Color de iconos sociales - Modo Oscuro
    $wp_customize->add_setting('breogan_footer_dark_social_icon_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_footer_dark_social_icon_color', array(
        'label'    => __('Color de iconos sociales (Modo Oscuro)', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'settings' => 'breogan_footer_dark_social_icon_color',
    )));
    
    // Color de borde superior del footer - Modo Oscuro
    $wp_customize->add_setting('breogan_footer_dark_border_color', array(
        'default'   => 'rgba(255, 255, 255, 0.1)',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_footer_dark_border_color', array(
        'label'    => __('Color del borde del footer (Modo Oscuro)', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'type'     => 'text',
        'description' => __('Acepta rgba(). Ejemplo: rgba(255, 255, 255, 0.1)', 'breogan-lms-theme'),
    ));
    
    // ====================================
    // MODO CLARO (LIGHT MODE)
    // ====================================
    
    // Título de la sección para Light Mode
    $wp_customize->add_setting('breogan_footer_light_mode_title', array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'breogan_footer_light_mode_title', array(
        'label'    => __('CONFIGURACIÓN MODO CLARO', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'settings' => 'breogan_footer_light_mode_title',
        'type'     => 'hidden',
        'description' => '<hr><h3>' . __('Configuración Modo Claro', 'breogan-lms-theme') . '</h3>',
    )));
    
    // Color de fondo del footer - Modo Claro
    $wp_customize->add_setting('breogan_footer_light_bg_color', array(
        'default'   => '#4A90E2',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_footer_light_bg_color', array(
        'label'    => __('Color de fondo (Modo Claro)', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'settings' => 'breogan_footer_light_bg_color',
    )));
    
    // Color de texto del footer - Modo Claro
    $wp_customize->add_setting('breogan_footer_light_text_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_footer_light_text_color', array(
        'label'    => __('Color de texto (Modo Claro)', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'settings' => 'breogan_footer_light_text_color',
    )));
    
    // Color de enlaces del footer - Modo Claro
    $wp_customize->add_setting('breogan_footer_light_link_color', array(
        'default'   => 'rgba(255, 255, 255, 0.85)',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_footer_light_link_color', array(
        'label'    => __('Color de enlaces (Modo Claro)', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'type'     => 'text',
        'description' => __('Acepta rgba(). Ejemplo: rgba(255, 255, 255, 0.85)', 'breogan-lms-theme'),
    ));
    
    // Color de enlaces al pasar el mouse - Modo Claro
    $wp_customize->add_setting('breogan_footer_light_link_hover_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_footer_light_link_hover_color', array(
        'label'    => __('Color de enlaces al pasar el mouse (Modo Claro)', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'settings' => 'breogan_footer_light_link_hover_color',
    )));
    
    // Color de fondo de los iconos sociales - Modo Claro
    $wp_customize->add_setting('breogan_footer_light_social_bg_color', array(
        'default'   => 'rgba(255, 255, 255, 0.2)',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_footer_light_social_bg_color', array(
        'label'    => __('Color de fondo de iconos sociales (Modo Claro)', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'type'     => 'text',
        'description' => __('Acepta rgba(). Ejemplo: rgba(255, 255, 255, 0.2)', 'breogan-lms-theme'),
    ));
    
    // Color de iconos sociales - Modo Claro
    $wp_customize->add_setting('breogan_footer_light_social_icon_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_footer_light_social_icon_color', array(
        'label'    => __('Color de iconos sociales (Modo Claro)', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'settings' => 'breogan_footer_light_social_icon_color',
    )));
    
    // Color de borde superior del footer - Modo Claro
    $wp_customize->add_setting('breogan_footer_light_border_color', array(
        'default'   => 'rgba(255, 255, 255, 0.2)',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_footer_light_border_color', array(
        'label'    => __('Color del borde del footer (Modo Claro)', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'type'     => 'text',
        'description' => __('Acepta rgba(). Ejemplo: rgba(255, 255, 255, 0.2)', 'breogan-lms-theme'),
    ));
    
    // ====================================
    // OPCIONES COMUNES
    // ====================================
    
    // Título de la sección para opciones comunes
    $wp_customize->add_setting('breogan_footer_common_options_title', array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'breogan_footer_common_options_title', array(
        'label'    => __('OPCIONES COMUNES', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'settings' => 'breogan_footer_common_options_title',
        'type'     => 'hidden',
        'description' => '<hr><h3>' . __('Opciones Comunes', 'breogan-lms-theme') . '</h3>',
    )));
    
    // Espaciado del footer (padding)
    $wp_customize->add_setting('breogan_footer_padding', array(
        'default'   => '60px 0 30px',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_footer_padding', array(
        'label'    => __('Espaciado del footer (padding)', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'type'     => 'text',
        'description' => __('Formato: top right bottom left (ej: 60px 0 30px)', 'breogan-lms-theme'),
    ));
}
add_action('customize_register', 'breogan_footer_customizer_register');

/**
 * Aplicar estilos personalizados al footer
 */
function breogan_footer_custom_styles() {
    // MODO OSCURO
    $footer_dark_bg = get_theme_mod('breogan_footer_dark_bg_color', '#0B1221');
    $footer_dark_text = get_theme_mod('breogan_footer_dark_text_color', '#FFFFFF');
    $footer_dark_link = get_theme_mod('breogan_footer_dark_link_color', '#94A3B8');
    $footer_dark_link_hover = get_theme_mod('breogan_footer_dark_link_hover_color', '#FFFFFF');
    $footer_dark_social_bg = get_theme_mod('breogan_footer_dark_social_bg_color', 'rgba(255, 255, 255, 0.1)');
    $footer_dark_social_icon = get_theme_mod('breogan_footer_dark_social_icon_color', '#FFFFFF');
    $footer_dark_border = get_theme_mod('breogan_footer_dark_border_color', 'rgba(255, 255, 255, 0.1)');
    
    // MODO CLARO
    $footer_light_bg = get_theme_mod('breogan_footer_light_bg_color', '#4A90E2');
    $footer_light_text = get_theme_mod('breogan_footer_light_text_color', '#FFFFFF');
    $footer_light_link = get_theme_mod('breogan_footer_light_link_color', 'rgba(255, 255, 255, 0.85)');
    $footer_light_link_hover = get_theme_mod('breogan_footer_light_link_hover_color', '#FFFFFF');
    $footer_light_social_bg = get_theme_mod('breogan_footer_light_social_bg_color', 'rgba(255, 255, 255, 0.2)');
    $footer_light_social_icon = get_theme_mod('breogan_footer_light_social_icon_color', '#FFFFFF');
    $footer_light_border = get_theme_mod('breogan_footer_light_border_color', 'rgba(255, 255, 255, 0.2)');
    
    // OPCIONES COMUNES
    $footer_padding = get_theme_mod('breogan_footer_padding', '60px 0 30px');
    
    // Construir CSS personalizado
    $custom_css = "
        /* Footer - Modo Oscuro (default) */
        .site-footer {
            background-color: {$footer_dark_bg};
            color: {$footer_dark_text};
            padding: {$footer_padding};
        }
        
        .site-footer .footer-links a,
        .site-footer .footer-description,
        .site-footer .footer-bottom {
            color: {$footer_dark_link};
        }
        
        .site-footer .footer-links a:hover {
            color: {$footer_dark_link_hover};
        }
        
        .site-footer .social-link {
            background-color: {$footer_dark_social_bg};
            color: {$footer_dark_social_icon};
        }
        
        .site-footer .footer-bottom {
            border-top: 1px solid {$footer_dark_border};
        }
        
        /* Footer - Modo Claro */
        body.light-mode .site-footer {
            background-color: {$footer_light_bg};
            color: {$footer_light_text};
        }
        
        body.light-mode .site-footer .footer-links a,
        body.light-mode .site-footer .footer-description,
        body.light-mode .site-footer .footer-bottom {
            color: {$footer_light_link};
        }
        
        body.light-mode .site-footer .footer-links a:hover {
            color: {$footer_light_link_hover};
        }
        
        body.light-mode .site-footer .social-link {
            background-color: {$footer_light_social_bg};
            color: {$footer_light_social_icon};
        }
        
        body.light-mode .site-footer .footer-bottom {
            border-top: 1px solid {$footer_light_border};
        }
    ";
    
    // Añadir estilos inline
    wp_add_inline_style('breogan-lms-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'breogan_footer_custom_styles', 25);