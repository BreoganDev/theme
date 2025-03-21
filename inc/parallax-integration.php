<?php
/**
 * Integración de Parallax para el tema Breogan LMS
 * Este archivo gestiona la correcta carga y funcionamiento del efecto parallax
 *
 * @package Breogan_LMS_Theme
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Registra y carga los scripts necesarios para el efecto parallax
 */
function breogan_enqueue_parallax_scripts() {
    // Desregistrar el script antiguo si existe
    wp_deregister_script('breogan-rellax');
    
    // Registrar y encolar el nuevo script de parallax
    wp_enqueue_script(
        'breogan-parallax', 
        get_template_directory_uri() . '/assets/js/parallax.js', 
        array('jquery'), 
        '1.0', 
        true
    );
}
add_action('wp_enqueue_scripts', 'breogan_enqueue_parallax_scripts');

// Agregar soporte para atributos data a elementos HTML
function breogan_add_parallax_attributes($tag, $handle, $src) {
    // Modificar solo nuestro script
    if ('breogan-parallax' !== $handle) {
        return $tag;
    }
    
    // Añadir el atributo de crossorigin
    $tag = str_replace(' src', ' crossorigin="anonymous" src', $tag);
    
    return $tag;
}
add_filter('script_loader_tag', 'breogan_add_parallax_attributes', 10, 3);
/**
 * Añade opciones para Parallax en el Customizer
 */
function breogan_parallax_customizer($wp_customize) {
    // Sección para Parallax si estamos en sección de Hero
    if ($wp_customize->get_section('breogan_hero_settings')) {
        // Velocidad del Parallax
        $wp_customize->add_setting('breogan_parallax_speed', array(
            'default'   => '0.3',
            'transport' => 'refresh',
            'sanitize_callback' => function($value) {
                return is_numeric($value) ? floatval($value) : 0.3;
            },
        ));
        
        $wp_customize->add_control('breogan_parallax_speed', array(
            'label'    => __('Velocidad del efecto parallax', 'breogan-lms-theme'),
            'section'  => 'breogan_hero_settings',
            'type'     => 'number',
            'input_attrs' => array(
                'min'  => 0.1,
                'max'  => 1,
                'step' => 0.1,
            ),
            'active_callback' => function() {
                return get_theme_mod('breogan_hero_type', 'static') === 'parallax';
            },
            'description' => __('Valores entre 0.1 (efecto sutil) y 1 (efecto intenso).', 'breogan-lms-theme'),
        ));
        
        // Imagen de fondo para parallax
        $wp_customize->add_setting('breogan_parallax_image', array(
            'default'   => '',
            'transport' => 'refresh',
        ));
        
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'breogan_parallax_image', array(
            'label'    => __('Imagen de fondo para Parallax', 'breogan-lms-theme'),
            'section'  => 'breogan_hero_settings',
            'settings' => 'breogan_parallax_image',
            'active_callback' => function() {
                return get_theme_mod('breogan_hero_type', 'static') === 'parallax';
            },
        )));
    }
}
add_action('customize_register', 'breogan_parallax_customizer');

/**
 * Función para generar el HTML del Hero con Parallax
 */
function breogan_parallax_hero() {
    // Recuperar configuración
    $parallax_image = get_theme_mod('breogan_parallax_image', '');
    $parallax_speed = get_theme_mod('breogan_parallax_speed', '0.3');
    $hero_title = get_theme_mod('breogan_hero_title', __('Selling Online Courses', 'breogan-lms-theme'));
    $hero_description = get_theme_mod('breogan_hero_description', __('Teach what you know and build a thriving community around your passion while creating additional streams of revenue.', 'breogan-lms-theme'));
    $btn1_text = get_theme_mod('breogan_hero_btn1_text', __('Get Started', 'breogan-lms-theme'));
    $btn1_url = get_theme_mod('breogan_hero_btn1_url', '#');
    $btn2_text = get_theme_mod('breogan_hero_btn2_text', __('Learn More', 'breogan-lms-theme'));
    $btn2_url = get_theme_mod('breogan_hero_btn2_url', '#');
    
    // Si no hay imagen de parallax, usar una imagen predeterminada
    if (empty($parallax_image)) {
        $parallax_image = get_template_directory_uri() . '/assets/images/default-parallax.jpg';
    }
    
    // Imprimir HTML del Hero con Parallax
    ?>
    <section class="hero-section hero-parallax">
        <div class="parallax-bg" data-speed="<?php echo esc_attr($parallax_speed); ?>" data-image="<?php echo esc_url($parallax_image); ?>"></div>
        
        <div class="hero-overlay">
            <div class="container">
                <div class="hero-content">
                    <h1 class="hero-title"><?php echo esc_html($hero_title); ?></h1>
                    <p class="hero-description"><?php echo esc_html($hero_description); ?></p>
                    <div class="hero-cta">
                        <a href="<?php echo esc_url($btn1_url); ?>" class="btn btn-primary">
                            <?php echo esc_html($btn1_text); ?>
                        </a>
                        <a href="<?php echo esc_url($btn2_url); ?>" class="btn btn-secondary">
                            <?php echo esc_html($btn2_text); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}

/**
 * Agregar un atributo data-speed al div de parallax para control desde el Customizer
 */
function breogan_parallax_footer_script() {
    // Solo ejecutar si hay elementos parallax
    if (has_action('breogan_hero') && get_theme_mod('breogan_hero_type', 'static') === 'parallax') {
        $parallax_speed = get_theme_mod('breogan_parallax_speed', '0.3');
        ?>
        <script>
        jQuery(document).ready(function($) {
            // Asegurar que el script parallax está cargado
            if (typeof window.breoganParallax !== 'undefined') {
                // Actualizar velocidad de parallax según configuración
                $('.parallax-bg').attr('data-speed', <?php echo floatval($parallax_speed); ?>);
                
                // Refrescar parallax
                window.breoganParallax.refresh();
            }
        });
        </script>
        <?php
    }
}
add_action('wp_footer', 'breogan_parallax_footer_script', 100);

/**
 * Hook para insertar el parallax en la sección hero
 */
function breogan_add_parallax_to_hero() {
    $hero_type = get_theme_mod('breogan_hero_type', 'static');
    
    if ($hero_type === 'parallax') {
        breogan_parallax_hero();
    }
}

// Agregar al hook del hero si existe
if (has_action('breogan_hero')) {
    add_action('breogan_hero', 'breogan_add_parallax_to_hero');
}