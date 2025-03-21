<?php
/**
 * Funciones para el personalizador de WordPress
 * 
 * Este archivo contiene las funciones para hacer que los elementos del tema
 * sean fácilmente personalizables desde el personalizador de WordPress.
 */

function breogan_custom_styles_customize_register($wp_customize) {
    /**
     * Sección de opciones generales
     */
    $wp_customize->add_section('breogan_general_settings', array(
        'title'    => __('Opciones Generales', 'breogan-lms-theme'),
        'priority' => 20,
    ));
    
    // Logo del sitio (usando la funcionalidad nativa de WordPress)
    $wp_customize->add_setting('breogan_logo_text', array(
        'default'   => 'HERO',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_logo_text', array(
        'label'    => __('Texto del Logo', 'breogan-lms-theme'),
        'section'  => 'breogan_general_settings',
        'type'     => 'text',
    ));

    /**
     * Sección de colores
     */
    $wp_customize->add_section('breogan_theme_colors', array(
        'title'    => __('Colores del Tema', 'breogan-lms-theme'),
        'priority' => 30,
    ));

    // Color primario
    $wp_customize->add_setting('breogan_primary_color', array(
        'default'   => '#4A90E2',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_primary_color', array(
        'label'    => __('Color Primario', 'breogan-lms-theme'),
        'section'  => 'breogan_theme_colors',
        'settings' => 'breogan_primary_color',
    )));
    
    // Color secundario
    $wp_customize->add_setting('breogan_secondary_color', array(
        'default'   => '#00B3E3',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_secondary_color', array(
        'label'    => __('Color Secundario', 'breogan-lms-theme'),
        'section'  => 'breogan_theme_colors',
        'settings' => 'breogan_secondary_color',
    )));

    // Color de fondo
    $wp_customize->add_setting('breogan_dark_bg', array(
        'default'   => '#111827',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_dark_bg', array(
        'label'    => __('Color de Fondo', 'breogan-lms-theme'),
        'section'  => 'breogan_theme_colors',
        'settings' => 'breogan_dark_bg',
    )));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_hero_overlay_color', array(
    'label'    => __('Color del overlay', 'breogan-lms-theme'),
    'section'  => 'breogan_hero_settings',
    'description' => __('Puedes usar rgba para controlar la opacidad. Ejemplo: rgba(0,0,0,0.5)', 'breogan-lms-theme'),
)));

    // Fuente del tema
    $wp_customize->add_setting('breogan_font', array(
        'default'   => 'Poppins',
        'transport' => 'refresh',
    ));
    
    // Sección de configuración del Hero
$wp_customize->add_section('breogan_hero_settings', array(
    'title'    => __('Configuración Hero', 'breogan-lms-theme'),
    'priority' => 25,
));

// Agregar setting para el tipo de Hero
$wp_customize->add_setting('breogan_hero_type', array(
    'default'   => 'static',
    'transport' => 'refresh',
));

// Agregar control de selección para el tipo de Hero
$wp_customize->add_control('breogan_hero_type', array(
    'label'    => __('Tipo de Hero', 'breogan-lms-theme'),
    'section'  => 'breogan_hero_settings',
    'type'     => 'select',
    'choices'  => array(
        'static'   => __('Imagen Estática', 'breogan-lms-theme'),
        'video'    => __('Video', 'breogan-lms-theme'),
        'parallax' => __('Parallax', 'breogan-lms-theme'),
    ),
));

// Función de sanitización para el tipo de Hero
if ( ! function_exists( 'breogan_sanitize_hero_type' ) ) {
    function breogan_sanitize_hero_type( $input ) {
        $valid = array( 'static', 'video', 'parallax', 'particles' );
        return in_array( $input, $valid ) ? $input : 'static';
    }
}

    $wp_customize->add_control('breogan_font', array(
        'label'    => __('Fuente del Tema', 'breogan-lms-theme'),
        'section'  => 'breogan_theme_colors',
        'type'     => 'select',
        'choices'  => array(
            'Poppins'    => 'Poppins',
            'Roboto'     => 'Roboto',
            'Montserrat' => 'Montserrat',
            'Open Sans'  => 'Open Sans',
            'Lato'       => 'Lato',
        ),
    ));
} // <-- Se cierra la función breogan_custom_styles_customize_register

add_action('customize_register', 'breogan_custom_styles_customize_register');

function breogan_header_customizer($wp_customize) {
    // Añadir sección si no existe
    if (!$wp_customize->get_section('breogan_header_settings')) {
        $wp_customize->add_section('breogan_header_settings', array(
            'title'    => __('Configuración del Header', 'breogan-lms-theme'),
            'priority' => 30,
        ));
    }
    
    // Posición del logo
    $wp_customize->add_setting('breogan_logo_position', array(
        'default'           => 'left',
        'sanitize_callback' => 'breogan_sanitize_logo_position',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_logo_position', array(
        'label'       => __('Posición del Logo', 'breogan-lms-theme'),
        'section'     => 'breogan_header_settings',
        'type'        => 'radio',
        'choices'     => array(
            'left'   => __('Izquierda', 'breogan-lms-theme'),
            'center' => __('Centro', 'breogan-lms-theme'),
            'right'  => __('Derecha', 'breogan-lms-theme'),
        ),
    ));
}
add_action('customize_register', 'breogan_header_customizer');

// Función para sanitizar la posición del logo
function breogan_sanitize_logo_position($input) {
    $valid = array('left', 'center', 'right');
    if (in_array($input, $valid, true)) {
        return $input;
    }
    return 'left';
}

function breogan_header_styles() {
    $logo_position = get_theme_mod('breogan_logo_position', 'left');
    
    $custom_css = "
        .header-container {
            justify-content: ";
    
    switch ($logo_position) {
        case 'center':
            $custom_css .= "center";
            break;
        case 'right':
            $custom_css .= "flex-end";
            break;
        default: // 'left'
            $custom_css .= "flex-start";
            break;
    }
    
    $custom_css .= ";
        }
        
        /* Ajustes adicionales basados en la posición */
        ";
    
    if ($logo_position === 'center') {
        $custom_css .= "
            .site-logo {
                margin: 0 auto;
            }
            .main-navigation {
                margin-left: auto;
                margin-right: auto;
            }
        ";
    } elseif ($logo_position === 'right') {
        $custom_css .= "
            .main-navigation {
                margin-right: auto;
                order: 1;
            }
            .site-logo {
                order: 2;
            }
        ";
    }
    
    wp_add_inline_style('breogan-lms-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'breogan_header_styles', 20);

function breogan_container_customizer($wp_customize) {
    // Añadir sección si no existe
    if (!$wp_customize->get_section('breogan_layout_settings')) {
        $wp_customize->add_section('breogan_layout_settings', array(
            'title'    => __('Configuración del Layout', 'breogan-lms-theme'),
            'priority' => 40,
        ));
    }
    
    // Anchura del contenedor
    $wp_customize->add_setting('breogan_container_width', array(
        'default'           => '1200',
        'sanitize_callback' => 'absint', // Asegura que sea un entero positivo
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_container_width', array(
        'label'       => __('Ancho máximo del contenedor (px)', 'breogan-lms-theme'),
        'section'     => 'breogan_layout_settings',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 900,
            'max'  => 1600,
            'step' => 10,
        ),
    ));
}
add_action('customize_register', 'breogan_container_customizer');

function breogan_container_styles() {
    $container_width = get_theme_mod('breogan_container_width', '1200');
    
    $custom_css = "
        .container {
            max-width: {$container_width}px;
        }
    ";
    
    wp_add_inline_style('breogan-lms-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'breogan_container_styles', 20);

function breogan_header_buttons_customizer($wp_customize) {
    // Usa la sección de header existente
    
    // Botón de acción 1 - Activar/Desactivar
    $wp_customize->add_setting('breogan_header_button1_enable', array(
        'default'           => true,
        'sanitize_callback' => 'breogan_sanitize_checkbox',
    ));
    
    $wp_customize->add_control('breogan_header_button1_enable', array(
        'label'    => __('Mostrar botón de acción 1', 'breogan-lms-theme'),
        'section'  => 'breogan_header_settings',
        'type'     => 'checkbox',
    ));
    
    // Botón de acción 1 - Texto
    $wp_customize->add_setting('breogan_header_button1_text', array(
        'default'           => __('Inscribirse', 'breogan-lms-theme'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_header_button1_text', array(
        'label'           => __('Texto del botón 1', 'breogan-lms-theme'),
        'section'         => 'breogan_header_settings',
        'type'            => 'text',
        'active_callback' => function() {
            return get_theme_mod('breogan_header_button1_enable', true);
        },
    ));
    
    // Botón de acción 1 - URL
    $wp_customize->add_setting('breogan_header_button1_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('breogan_header_button1_url', array(
        'label'           => __('URL del botón 1', 'breogan-lms-theme'),
        'section'         => 'breogan_header_settings',
        'type'            => 'url',
        'active_callback' => function() {
            return get_theme_mod('breogan_header_button1_enable', true);
        },
    ));
    
    // Botón de acción 1 - Estilo
    $wp_customize->add_setting('breogan_header_button1_style', array(
        'default'           => 'primary',
        'sanitize_callback' => 'breogan_sanitize_button_style',
    ));
    
    $wp_customize->add_control('breogan_header_button1_style', array(
        'label'           => __('Estilo del botón 1', 'breogan-lms-theme'),
        'section'         => 'breogan_header_settings',
        'type'            => 'select',
        'choices'         => array(
            'primary'   => __('Primario', 'breogan-lms-theme'),
            'secondary' => __('Secundario', 'breogan-lms-theme'),
            'outline'   => __('Contorno', 'breogan-lms-theme'),
            'link'      => __('Enlace', 'breogan-lms-theme'),
        ),
        'active_callback' => function() {
            return get_theme_mod('breogan_header_button1_enable', true);
        },
    ));
    
    // Repite lo mismo para el botón 2
    $wp_customize->add_setting('breogan_header_button2_enable', array(
        'default'           => false,
        'sanitize_callback' => 'breogan_sanitize_checkbox',
    ));
    
    $wp_customize->add_control('breogan_header_button2_enable', array(
        'label'    => __('Mostrar botón de acción 2', 'breogan-lms-theme'),
        'section'  => 'breogan_header_settings',
        'type'     => 'checkbox',
    ));
    
    // Configuraciones similares para texto, URL y estilo del botón 2...
}
add_action('customize_register', 'breogan_header_buttons_customizer');

// Función para sanitizar checkbox
function breogan_sanitize_checkbox($checked) {
    return (isset($checked) && true === (bool) $checked) ? true : false;
}

// Función para sanitizar estilo de botón
function breogan_sanitize_button_style($input) {
    $valid = array('primary', 'secondary', 'outline', 'link');
    if (in_array($input, $valid, true)) {
        return $input;
    }
    return 'primary';
}

function breogan_hero_customizer($wp_customize) {
    // Añadir sección si no existe
    if (!$wp_customize->get_section('breogan_hero_settings')) {
        $wp_customize->add_section('breogan_hero_settings', array(
            'title'    => __('Sección Hero', 'breogan-lms-theme'),
            'priority' => 50,
        ));
    }
    
    // Tipo de hero
   $wp_customize->add_setting('breogan_hero_type', array(
    'default'           => 'static',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'refresh',
));
    
   // Agregar control de selección para el tipo de Hero
$wp_customize->add_control('breogan_hero_type', array(
    'label'    => __('Tipo de Hero', 'breogan-lms-theme'),
    'section'  => 'breogan_hero_settings',
    'type'     => 'select',
    'choices'  => array(
        'static'    => __('Imagen Estática', 'breogan-lms-theme'),
        'video'     => __('Video de Fondo', 'breogan-lms-theme'),
        'parallax'  => __('Imagen con Parallax', 'breogan-lms-theme'),
        'particles' => __('Partículas Animadas', 'breogan-lms-theme'),
    ),
));

    
    
    // Imagen de fondo (para imagen estática y paralaje)
//   $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "hero_carousel_image{$i}", array(
//        'label'           => sprintf(__('Imagen %d del carrusel', 'breogan-lms-theme'), $i),
//        'section'         => 'breogan_hero_settings',
//        'settings'        => "hero_carousel_image{$i}",
//        'active_callback' => function() {
//            return get_theme_mod('breogan_hero_type', 'static') === 'carousel';
//        },
//    )));
    
    // URL del video (para video de fondo)
    $wp_customize->add_setting('breogan_hero_video', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('breogan_hero_video', array(
        'label'           => __('URL del video (YouTube o archivo MP4)', 'breogan-lms-theme'),
        'section'         => 'breogan_hero_settings',
        'type'            => 'url',
        'active_callback' => function() {
            return get_theme_mod('breogan_hero_type', 'image') === 'video';
        },
    ));
    
    // Imágenes para el carrusel (hasta 3)
    for ($i = 1; $i <= 3; $i++) {
    $wp_customize->add_setting("hero_carousel_image{$i}", array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
        
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "breogan_hero_carousel_image{$i}", array(
            'label'           => sprintf(__('Imagen %d del carrusel', 'breogan-lms-theme'), $i),
            'section'         => 'breogan_hero_settings',
            'settings'        => "breogan_hero_carousel_image{$i}",
            'active_callback' => function() {
                return get_theme_mod('breogan_hero_type', 'image') === 'carousel';
            },
        )));
    }
    
    // Color de partículas (para partículas animadas)
    $wp_customize->add_setting('breogan_hero_particles_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_hero_particles_color', array(
        'label'           => __('Color de partículas', 'breogan-lms-theme'),
        'section'         => 'breogan_hero_settings',
        'settings'        => 'breogan_hero_particles_color',
        'active_callback' => function() {
            return get_theme_mod('breogan_hero_type', 'image') === 'particles';
        },
    )));
    
    // Overlay (para todos los tipos)
    $wp_customize->add_setting('breogan_hero_overlay_enable', array(
        'default'           => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'breogan_sanitize_checkbox',
    ));
    
    $wp_customize->add_control('breogan_hero_overlay_enable', array(
        'label'    => __('Activar overlay', 'breogan-lms-theme'),
        'section'  => 'breogan_hero_settings',
        'type'     => 'checkbox',
    ));
    
    // Color del overlay
    $wp_customize->add_setting('breogan_hero_overlay_color', array(
        'default'           => 'rgba(0,0,0,0.5)',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_hero_overlay_color', array(
        'label'           => __('Color del overlay (rgba)', 'breogan-lms-theme'),
        'section'         => 'breogan_hero_settings',
        'type'            => 'text',
        'description'     => __('Formato: rgba(0,0,0,0.5) - El último valor (0.5) controla la opacidad', 'breogan-lms-theme'),
        'active_callback' => function() {
            return get_theme_mod('breogan_hero_overlay_enable', true);
        },
    ));
}
add_action('customize_register', 'breogan_hero_customizer');

// Función para sanitizar tipo de hero
function breogan_sanitize_hero_type($input) {
    $valid = array('image', 'video', 'parallax', 'particles');
    if (in_array($input, $valid, true)) {
        return $input;
    }
    return 'image';
}

function breogan_hero_section() {
    $hero_type = get_theme_mod('breogan_hero_type', 'image');
    $overlay_enabled = get_theme_mod('breogan_hero_overlay_enable', true);
    $overlay_color = get_theme_mod('breogan_hero_overlay_color', 'rgba(0,0,0,0.5)');
    
    // Clases CSS para el hero
    $hero_classes = 'hero-section';
    $hero_classes .= ' hero-' . $hero_type;
    
    // Inicio del hero
    echo '<section class="' . esc_attr($hero_classes) . '">';
    
    // Background según el tipo
    switch ($hero_type) {
        case 'image':
            $hero_image = get_theme_mod('breogan_hero_image', '');
            if (!empty($hero_image)) {
                echo '<div class="hero-background" style="background-image: url(\'' . esc_url($hero_image) . '\');"></div>';
            }
            break;
            
        case 'parallax':
            $hero_image = get_theme_mod('breogan_hero_image', '');
            if (!empty($hero_image)) {
                echo '<div class="hero-background parallax-bg" data-image="' . esc_url($hero_image) . '"></div>';
            }
            break;
            
        case 'video':
            $hero_video = get_theme_mod('breogan_hero_video', '');
            if (!empty($hero_video)) {
                // Determinar si es YouTube o video directo
                if (strpos($hero_video, 'youtube.com') !== false || strpos($hero_video, 'youtu.be') !== false) {
                    // Extraer ID de YouTube
                    preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $hero_video, $matches);
                    if (!empty($matches[1])) {
                        echo '<div class="hero-video-container">';
                        echo '<div id="hero-youtube-player" data-video-id="' . esc_attr($matches[1]) . '"></div>';
                        echo '</div>';
                    }
                } else {
                    echo '<video class="hero-video" autoplay muted loop playsinline>';
                    echo '<source src="' . esc_url($hero_video) . '" type="video/mp4">';
                    echo '</video>';
                }
            }
            break;
            
        case 'carousel':
            echo '<div class="hero-carousel">';
            for ($i = 1; $i <= 3; $i++) {
                $slide_image = get_theme_mod("breogan_hero_carousel_image{$i}", '');
                if (!empty($slide_image)) {
                    echo '<div class="carousel-slide" style="background-image: url(\'' . esc_url($slide_image) . '\');"></div>';
                }
            }
            echo '</div>';
            echo '<div class="carousel-controls">';
            echo '<button class="carousel-prev"><i class="fas fa-chevron-left"></i></button>';
            echo '<button class="carousel-next"><i class="fas fa-chevron-right"></i></button>';
            echo '</div>';
            break;
            
        case 'particles':
            $particles_color = get_theme_mod('breogan_hero_particles_color', '#ffffff');
            echo '<div id="particles-container" data-color="' . esc_attr($particles_color) . '"></div>';
            break;
    }
    
    // Overlay si está habilitado
    if ($overlay_enabled) {
        echo '<div class="hero-overlay" style="background-color: ' . esc_attr($overlay_color) . ';"></div>';
    }
    
    // Contenido del hero
    echo '<div class="container">';
    echo '<div class="hero-content">';
    echo '<h1 class="hero-title">' . esc_html(get_theme_mod('breogan_hero_title', 'Selling Online Courses')) . '</h1>';
    echo '<p class="hero-description">' . esc_html(get_theme_mod('breogan_hero_description', 'Teach what you know and build a thriving community around your passion while creating additional streams of revenue.')) . '</p>';
    echo '<div class="hero-cta">';
    echo '<a href="' . esc_url(get_theme_mod('breogan_hero_btn1_url', '#')) . '" class="btn btn-primary">' . esc_html(get_theme_mod('breogan_hero_btn1_text', 'Get Started')) . '</a>';
    echo '<a href="' . esc_url(get_theme_mod('breogan_hero_btn2_url', '#')) . '" class="btn btn-secondary">' . esc_html(get_theme_mod('breogan_hero_btn2_text', 'Learn More')) . '</a>';
    echo '</div>'; // .hero-cta
    echo '</div>'; // .hero-content
    echo '</div>'; // .container
    
    echo '</section>'; // .hero-section
}

function breogan_hero_scripts() {
    $hero_type = get_theme_mod('breogan_hero_type', 'image');
    
    // Cargar scripts específicos según el tipo de hero
    switch ($hero_type) {
        case 'parallax':
            wp_enqueue_script('breogan-parallax', get_template_directory_uri() . '/assets/js/rellax.min.js', array('jquery'), '1.0', true);
            wp_add_inline_script('breogan-parallax', '
                jQuery(document).ready(function($) {
                    $(".parallax-bg").each(function() {
                        var img = $(this).data("image");
                        $(this).css("background-image", "url(" + img + ")");
                    });
                    
                    $(window).on("scroll", function() {
                        var scrolled = $(window).scrollTop();
                        $(".parallax-bg").css("transform", "translateY(" + (scrolled * 0.3) + "px)");
                    });
                });
            ');
            break;
            
        case 'video':
            $hero_video = get_theme_mod('breogan_hero_video', '');
            if (strpos($hero_video, 'youtube.com') !== false || strpos($hero_video, 'youtu.be') !== false) {
                wp_enqueue_script('breogan-youtube-api', 'https://www.youtube.com/iframe_api', array(), null, true);
                wp_add_inline_script('breogan-youtube-api', '
                    var player;
                    function onYouTubeIframeAPIReady() {
                        var videoElement = document.getElementById("hero-youtube-player");
                        if (videoElement) {
                            player = new YT.Player("hero-youtube-player", {
                                videoId: videoElement.dataset.videoId,
                                playerVars: {
                                    autoplay: 1,
                                    loop: 1,
                                    controls: 0,
                                    showinfo: 0,
                                    autohide: 1,
                                    modestbranding: 1,
                                    mute: 1,
                                    playsinline: 1,
                                    rel: 0
                                },
                                events: {
                                    onReady: function(e) {
                                        e.target.mute();
                                        e.target.playVideo();
                                    },
                                    onStateChange: function(e) {
                                        if (e.data === YT.PlayerState.ENDED) {
                                            player.playVideo();
                                        }
                                    }
                                }
                            });
                        }
                    }
                ');
            }
            break;
            
        case 'carousel':
           // wp_enqueue_script('breogan-carousel', get_template_directory_uri() . '/assets/js/carousel.min.js', array('jquery'), '1.0', true);
            wp_add_inline_script('breogan-carousel', '
                jQuery(document).ready(function($) {
                    var $carousel = $(".hero-carousel");
                    var $slides = $carousel.find(".carousel-slide");
                    var currentSlide = 0;
                    var slideCount = $slides.length;
                    
                    function showSlide(index) {
                        $slides.removeClass("active");
                        $slides.eq(index).addClass("active");
                    }
                    
                    // Inicializar el carrusel
                    if (slideCount > 0) {
                        showSlide(0);
                        
                        // Autoplay
                        setInterval(function() {
                            currentSlide = (currentSlide + 1) % slideCount;
                            showSlide(currentSlide);
                        }, 5000);
                        
                        // Controles
                        $(".carousel-prev").on("click", function() {
                            currentSlide = (currentSlide - 1 + slideCount) % slideCount;
                            showSlide(currentSlide);
                        });
                        
                        $(".carousel-next").on("click", function() {
                            currentSlide = (currentSlide + 1) % slideCount;
                            showSlide(currentSlide);
                        });
                    }
                });
            ');
            break;
            
        case 'particles':
            wp_enqueue_script('breogan-particles', 'https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js', array(), '2.0.0', true);
            wp_add_inline_script('breogan-particles', '
                document.addEventListener("DOMContentLoaded", function() {
                    var container = document.getElementById("particles-container");
                    if (container) {
                        var color = container.dataset.color || "#ffffff";
                        
                        particlesJS("particles-container", {
                            particles: {
                                number: { value: 80, density: { enable: true, value_area: 800 } },
                                color: { value: color },
                                shape: { type: "circle" },
                                opacity: { value: 0.5, random: false },
                                size: { value: 3, random: true },
                                line_linked: {
                                    enable: true,
                                    distance: 150,
                                    color: color,
                                    opacity: 0.4,
                                    width: 1
                                },
                                move: {
                                    enable: true,
                                    speed: 2,
                                    direction: "none",
                                    random: false,
                                    straight: false,
                                    out_mode: "out",
                                    bounce: false
                                }
                            },
                            interactivity: {
                                detect_on: "canvas",
                                events: {
                                    onhover: { enable: true, mode: "grab" },
                                    onclick: { enable: true, mode: "push" },
                                    resize: true
                                }
                            },
                            retina_detect: true
                        });
                    }
                });
            ');
            break;
    }
}
add_action('wp_enqueue_scripts', 'breogan_hero_scripts');

function breogan_hero_styles() {
    $hero_type = get_theme_mod('breogan_hero_type', 'image');
    
    $custom_css = "
        /* Estilos base para todos los tipos de hero */
        .hero-section {
            position: relative;
            height: 80vh;
            min-height: 500px;
            overflow: hidden;
        }
        
        .hero-background,
        .hero-video,
        .hero-carousel,
        #particles-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
        
        .hero-background {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
        }
        
        .hero-content {
            position: relative;
            z-index: 3;
            padding: 30px 0;
        }
    ";
    
    wp_add_inline_style('breogan-lms-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'breogan_hero_styles', 25);

/**
 * Aplicar estilos personalizados en línea
 */
function breogan_lms_custom_styles() {
    $primary_color = get_theme_mod('breogan_primary_color', '#4A90E2');
    $secondary_color = get_theme_mod('breogan_secondary_color', '#00B3E3');
    $dark_bg = get_theme_mod('breogan_dark_bg', '#111827');
    $font = get_theme_mod('breogan_font', 'Poppins');
    
    $custom_css = "
    :root {
        --primary-color: " . esc_attr($primary_color) . ";
        --secondary-color: " . esc_attr($secondary_color) . ";
        --dark-bg: " . esc_attr($dark_bg) . ";
        --darker-bg: " . esc_attr(breogan_adjust_brightness($dark_bg, -20)) . ";
        --card-bg: " . esc_attr(breogan_adjust_brightness($dark_bg, 20)) . ";
        --font-main: '" . esc_attr($font) . "', sans-serif;
    }
    ";
    
    wp_add_inline_style('breogan-lms-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'breogan_lms_custom_styles', 20);

// Función para ajustar el brillo de un color hex
function breogan_adjust_brightness($hex, $steps) {
    // Quitar el # si está presente
    $hex = ltrim($hex, '#');
    
    // Convertir a RGB
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    
    // Ajustar el brillo
    $r = max(0, min(255, $r + $steps));
    $g = max(0, min(255, $g + $steps));
    $b = max(0, min(255, $b + $steps));
    
    // Convertir de nuevo a hex
    return '#' . sprintf('%02x', $r) . sprintf('%02x', $g) . sprintf('%02x', $b);
}

// Añadimos el diseño de los cards
function breogan_card_style_customizer($wp_customize) {
    // Añadir sección para diseño de tarjetas
    $wp_customize->add_section('breogan_card_styles', array(
        'title'    => __('Estilos de Tarjetas', 'breogan-lms-theme'),
        'priority' => 45,
    ));
    
    // Añadir configuración para el estilo de tarjeta
    $wp_customize->add_setting('breogan_card_style', array(
        'default'   => 'classic',
        'transport' => 'refresh',
    ));
    
    // Añadir control para seleccionar el estilo
    $wp_customize->add_control('breogan_card_style', array(
        'label'    => __('Estilo de tarjetas de curso', 'breogan-lms-theme'),
        'section'  => 'breogan_card_styles',
        'type'     => 'select',
        'choices'  => array(
            'classic'    => __('Clásico', 'breogan-lms-theme'),
            'minimal'    => __('Minimalista', 'breogan-lms-theme'),
            'featured'   => __('Destacado', 'breogan-lms-theme'),
            'horizontal' => __('Horizontal', 'breogan-lms-theme'),
        ),
    ));
}
add_action('customize_register', 'breogan_card_style_customizer');

// function breogan_icons_customizer($wp_customize) {
    // Añadir sección para iconografía
//    $wp_customize->add_section('breogan_icons_settings', array(
//        'title'    => __('Iconografía', 'breogan-lms-theme'),
//        'priority' => 45,
//    ));
//    
    // Añadir configuración para el conjunto de iconos
//    $wp_customize->add_setting('breogan_icon_set', array(
//        'default'   => 'font-awesome',
//        'transport' => 'refresh',
//    ));
    
    // Añadir control para seleccionar el conjunto de iconos
//    $wp_customize->add_control('breogan_icon_set', array(
//        'label'    => __('Conjunto de iconos', 'breogan-lms-theme'),
//        'section'  => 'breogan_icons_settings',
//        'type'     => 'select',
//        'choices'  => array(
//            'font-awesome' => __('Font Awesome', 'breogan-lms-theme'),
//            'feather'      => __('Feather Icons', 'breogan-lms-theme'),
//            'material'     => __('Material Icons', 'breogan-lms-theme'),
//            'bootstrap'    => __('Bootstrap Icons', 'breogan-lms-theme'),
//        ),
//    ));
// }
// add_action('customize_register', 'breogan_icons_customizer'); //

function breogan_load_icons() {
    $icon_set = get_theme_mod('breogan_icon_set', 'font-awesome');
    
    switch ($icon_set) {
        case 'font-awesome':
            wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
            break;
            
        case 'feather':
            wp_enqueue_style('feather-icons', 'https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.css', array(), '4.29.0');
            wp_enqueue_script('feather-icons-js', 'https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js', array(), '4.29.0', true);
            add_action('wp_footer', function() {
                echo '<script>feather.replace();</script>';
            });
            break;
            
        case 'material':
            wp_enqueue_style('material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', array(), null);
            break;
            
        case 'bootstrap':
            wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css', array(), '1.10.5');
            break;
    }
}
add_action('wp_enqueue_scripts', 'breogan_load_icons');

// Sección de personalización del menú
function breogan_menu_customizer($wp_customize) {
    // Crear una nueva sección para el menú
    $wp_customize->add_section('breogan_menu_settings', array(
        'title'    => __('Personalización del Menú', 'breogan-lms-theme'),
        'priority' => 46,
    ));
    
    // MODO OSCURO - Color de texto
    $wp_customize->add_setting('menu_dark_text_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_dark_text_color', array(
        'label'    => __('Modo Oscuro - Color de Texto', 'breogan-lms-theme'),
        'section'  => 'breogan_menu_settings',
    )));
    
    // MODO OSCURO - Color de hover
    $wp_customize->add_setting('menu_dark_hover_color', array(
        'default'   => '#4A90E2',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_dark_hover_color', array(
        'label'    => __('Modo Oscuro - Color al Pasar el Ratón', 'breogan-lms-theme'),
        'section'  => 'breogan_menu_settings',
    )));
    
    // MODO OSCURO - Color de fondo del menú
    $wp_customize->add_setting('menu_dark_bg_color', array(
        'default'   => '#0B1221',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_dark_bg_color', array(
        'label'    => __('Modo Oscuro - Color de Fondo del Menú', 'breogan-lms-theme'),
        'section'  => 'breogan_menu_settings',
    )));
    
    // MODO CLARO - Color de texto
    $wp_customize->add_setting('menu_light_text_color', array(
        'default'   => '#333333',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_light_text_color', array(
        'label'    => __('Modo Claro - Color de Texto', 'breogan-lms-theme'),
        'section'  => 'breogan_menu_settings',
    )));
    
    // MODO CLARO - Color de hover
    $wp_customize->add_setting('menu_light_hover_color', array(
        'default'   => '#4A90E2',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_light_hover_color', array(
        'label'    => __('Modo Claro - Color al Pasar el Ratón', 'breogan-lms-theme'),
        'section'  => 'breogan_menu_settings',
    )));
    
    // MODO CLARO - Color de fondo del menú
    $wp_customize->add_setting('menu_light_bg_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_light_bg_color', array(
        'label'    => __('Modo Claro - Color de Fondo del Menú', 'breogan-lms-theme'),
        'section'  => 'breogan_menu_settings',
    )));
    
    // MENU MÓVIL - Color de fondo (Modo Oscuro)
    $wp_customize->add_setting('mobile_menu_dark_bg_color', array(
        'default'   => '#0B1221',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mobile_menu_dark_bg_color', array(
        'label'    => __('Menú Móvil - Color de Fondo (Modo Oscuro)', 'breogan-lms-theme'),
        'section'  => 'breogan_menu_settings',
    )));
    
    // MENU MÓVIL - Color de fondo (Modo Claro)
    $wp_customize->add_setting('mobile_menu_light_bg_color', array(
        'default'   => '#f5f8fa',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mobile_menu_light_bg_color', array(
        'label'    => __('Menú Móvil - Color de Fondo (Modo Claro)', 'breogan-lms-theme'),
        'section'  => 'breogan_menu_settings',
    )));
}
add_action('customize_register', 'breogan_menu_customizer');

function breogan_advanced_color_system($wp_customize) {
    // Panel principal para colores
    $wp_customize->add_panel('breogan_colors_panel', array(
        'title'    => __('Sistema de Colores', 'breogan-lms-theme'),
        'priority' => 30,
        'description' => __('Personaliza todos los colores del tema.', 'breogan-lms-theme'),
    ));
    
    // Sección: Colores primarios
    $wp_customize->add_section('breogan_primary_colors', array(
        'title'    => __('Colores Primarios', 'breogan-lms-theme'),
        'panel'    => 'breogan_colors_panel',
        'priority' => 10,
    ));
    
    // Color primario
    $wp_customize->add_setting('breogan_primary_color', array(
        'default'           => '#4A90E2',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_primary_color', array(
        'label'    => __('Color Primario', 'breogan-lms-theme'),
        'section'  => 'breogan_primary_colors',
        'settings' => 'breogan_primary_color',
        'description' => __('Se usa para botones, enlaces y elementos destacados.', 'breogan-lms-theme'),
    )));
    
    // Color secundario
    $wp_customize->add_setting('breogan_secondary_color', array(
        'default'           => '#00B3E3',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_secondary_color', array(
        'label'    => __('Color Secundario', 'breogan-lms-theme'),
        'section'  => 'breogan_primary_colors',
        'settings' => 'breogan_secondary_color',
        'description' => __('Se usa para acentos y elementos secundarios.', 'breogan-lms-theme'),
    )));
    
    // Color de acento
    $wp_customize->add_setting('breogan_accent_color', array(
        'default'           => '#FF6B00',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_accent_color', array(
        'label'    => __('Color de Acento', 'breogan-lms-theme'),
        'section'  => 'breogan_primary_colors',
        'settings' => 'breogan_accent_color',
        'description' => __('Se usa para llamadas a la acción y elementos que deben destacar.', 'breogan-lms-theme'),
    )));
    
    // Color de éxito
    $wp_customize->add_setting('breogan_success_color', array(
        'default'           => '#10B981',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_success_color', array(
        'label'    => __('Color de Éxito', 'breogan-lms-theme'),
        'section'  => 'breogan_primary_colors',
        'settings' => 'breogan_success_color',
        'description' => __('Se usa para precios, mensajes de éxito y confirmaciones.', 'breogan-lms-theme'),
    )));
    
    // Sección: Modo Oscuro
    $wp_customize->add_section('breogan_dark_mode_colors', array(
        'title'    => __('Colores Modo Oscuro', 'breogan-lms-theme'),
        'panel'    => 'breogan_colors_panel',
        'priority' => 20,
    ));
    
    // Color de fondo oscuro
    $wp_customize->add_setting('breogan_dark_bg', array(
        'default'           => '#111827',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_dark_bg', array(
        'label'    => __('Color de Fondo Principal', 'breogan-lms-theme'),
        'section'  => 'breogan_dark_mode_colors',
        'settings' => 'breogan_dark_bg',
    )));
    
    // Color de fondo más oscuro
    $wp_customize->add_setting('breogan_darker_bg', array(
        'default'           => '#0B1221',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_darker_bg', array(
        'label'    => __('Color de Fondo Más Oscuro', 'breogan-lms-theme'),
        'section'  => 'breogan_dark_mode_colors',
        'settings' => 'breogan_darker_bg',
        'description' => __('Para header, footer y secciones que necesitan destacar.', 'breogan-lms-theme'),
    )));
    
    // Color de tarjetas
    $wp_customize->add_setting('breogan_card_bg', array(
        'default'           => '#1E293B',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_card_bg', array(
        'label'    => __('Color de Fondo de Tarjetas', 'breogan-lms-theme'),
        'section'  => 'breogan_dark_mode_colors',
        'settings' => 'breogan_card_bg',
    )));
    
    // Color de texto claro
    $wp_customize->add_setting('breogan_text_light', array(
        'default'           => '#FFFFFF',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_text_light', array(
        'label'    => __('Color de Texto Principal', 'breogan-lms-theme'),
        'section'  => 'breogan_dark_mode_colors',
        'settings' => 'breogan_text_light',
    )));
    
    // Color de texto gris
    $wp_customize->add_setting('breogan_text_gray', array(
        'default'           => '#94A3B8',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_text_gray', array(
        'label'    => __('Color de Texto Secundario', 'breogan-lms-theme'),
        'section'  => 'breogan_dark_mode_colors',
        'settings' => 'breogan_text_gray',
    )));
    
    // Sección: Modo Claro
    $wp_customize->add_section('breogan_light_mode_colors', array(
        'title'    => __('Colores Modo Claro', 'breogan-lms-theme'),
        'panel'    => 'breogan_colors_panel',
        'priority' => 30,
    ));
    
    // Color de fondo claro
    $wp_customize->add_setting('breogan_light_bg', array(
        'default'           => '#FFFFFF',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_light_bg', array(
        'label'    => __('Color de Fondo Principal', 'breogan-lms-theme'),
        'section'  => 'breogan_light_mode_colors',
        'settings' => 'breogan_light_bg',
    )));
    
    // Color de fondo más claro
    $wp_customize->add_setting('breogan_lighter_bg', array(
        'default'           => '#F5F8FA',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_lighter_bg', array(
        'label'    => __('Color de Fondo Secundario', 'breogan-lms-theme'),
        'section'  => 'breogan_light_mode_colors',
        'settings' => 'breogan_lighter_bg',
        'description' => __('Para alternar secciones y crear contraste.', 'breogan-lms-theme'),
    )));
    
    // Color de tarjetas claro
    $wp_customize->add_setting('breogan_light_card_bg', array(
        'default'           => '#FFFFFF',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_light_card_bg', array(
        'label'    => __('Color de Fondo de Tarjetas', 'breogan-lms-theme'),
        'section'  => 'breogan_light_mode_colors',
        'settings' => 'breogan_light_card_bg',
    )));
    
    // Color de texto oscuro
    $wp_customize->add_setting('breogan_text_dark', array(
        'default'           => '#333333',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_text_dark', array(
        'label'    => __('Color de Texto Principal', 'breogan-lms-theme'),
        'section'  => 'breogan_light_mode_colors',
        'settings' => 'breogan_text_dark',
    )));
    
    // Color de texto medio
    $wp_customize->add_setting('breogan_text_medium', array(
        'default'           => '#666666',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_text_medium', array(
        'label'    => __('Color de Texto Secundario', 'breogan-lms-theme'),
        'section'  => 'breogan_light_mode_colors',
        'settings' => 'breogan_text_medium',
    )));
    
    // Opción para usar paletas predefinidas
    $wp_customize->add_section('breogan_color_palettes', array(
        'title'    => __('Paletas de Color', 'breogan-lms-theme'),
        'panel'    => 'breogan_colors_panel',
        'priority' => 5,
    ));
    
    $wp_customize->add_setting('breogan_color_palette', array(
        'default'           => 'default',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_color_palette', array(
        'label'    => __('Seleccionar Paleta de Color', 'breogan-lms-theme'),
        'section'  => 'breogan_color_palettes',
        'type'     => 'select',
        'choices'  => array(
            'default' => __('Breogan (Predeterminado)', 'breogan-lms-theme'),
            'ocean'   => __('Océano', 'breogan-lms-theme'),
            'forest'  => __('Bosque', 'breogan-lms-theme'),
            'sunset'  => __('Atardecer', 'breogan-lms-theme'),
            'lavender' => __('Lavanda', 'breogan-lms-theme'),
            'custom'  => __('Personalizado', 'breogan-lms-theme'),
        ),
        'description' => __('Selecciona una paleta preconfigurada o personaliza los colores manualmente.', 'breogan-lms-theme'),
    ));
    
    // Botón para aplicar paleta
    $wp_customize->add_setting('breogan_apply_palette', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_apply_palette', array(
        'label'       => __('Aplicar Paleta', 'breogan-lms-theme'),
        'section'     => 'breogan_color_palettes',
        'type'        => 'button',
        'input_attrs' => array(
            'class'   => 'button button-primary',
            'value'   => __('Aplicar Paleta Seleccionada', 'breogan-lms-theme'),
            'onclick' => 'breogan_apply_color_palette()',
        ),
        'description' => __('Esto reemplazará todos tus colores personalizados por los de la paleta seleccionada.', 'breogan-lms-theme'),
    ));
}
add_action('customize_register', 'breogan_advanced_color_system');

// JavaScript para aplicar paletas
function breogan_color_palettes_script() {
    ?>
    <script>
    function breogan_apply_color_palette() {
        var palette = wp.customize.control('breogan_color_palette').setting.get();
        var colors = {};
        
        // Definir las paletas de colores
        switch(palette) {
            case 'ocean':
                colors = {
                    primary: '#0077B6',
                    secondary: '#00B4D8',
                    accent: '#48CAE4',
                    success: '#20A561',
                    dark_bg: '#03045E',
                    darker_bg: '#023E8A',
                    card_bg: '#0096C7',
                    text_light: '#FFFFFF',
                    text_gray: '#CAF0F8',
                    light_bg: '#F5FEFF',
                    lighter_bg: '#E0FAFF',
                    light_card_bg: '#FFFFFF',
                    text_dark: '#03045E',
                    text_medium: '#0077B6'
                };
                break;
                
            case 'forest':
                colors = {
                    primary: '#2D6A4F',
                    secondary: '#40916C',
                    accent: '#74C69D',
                    success: '#2D7D52',
                    dark_bg: '#081C15',
                    darker_bg: '#1B4332',
                    card_bg: '#2D6A4F',
                    text_light: '#FFFFFF',
                    text_gray: '#B7E4C7',
                    light_bg: '#FFFFFF',
                    lighter_bg: '#F0FFF4',
                    light_card_bg: '#FFFFFF',
                    text_dark: '#081C15',
                    text_medium: '#2D6A4F'
                };
                break;
                
            case 'sunset':
                colors = {
                    primary: '#F72585',
                    secondary: '#7209B7',
                    accent: '#4CC9F0',
                    success: '#4895EF',
                    dark_bg: '#3A0CA3',
                    darker_bg: '#10002B',
                    card_bg: '#4361EE',
                    text_light: '#FFFFFF',
                    text_gray: '#B5DEFF',
                    light_bg: '#FFF0F6',
                    lighter_bg: '#FFF9FB',
                    light_card_bg: '#FFFFFF',
                    text_dark: '#3A0CA3',
                    text_medium: '#7209B7'
                };
                break;
                
            case 'lavender':
                colors = {
                    primary: '#7C3AED',
                    secondary: '#8B5CF6',
                    accent: '#A78BFA',
                    success: '#10B981',
                    dark_bg: '#27272A',
                    darker_bg: '#18181B',
                    card_bg: '#3F3F46',
                    text_light: '#FFFFFF',
                    text_gray: '#D4D4D8',
                    light_bg: '#FFFFFF',
                    lighter_bg: '#F5F3FF',
                    light_card_bg: '#FFFFFF',
                    text_dark: '#18181B',
                    text_medium: '#71717A'
                };
                break;
                
            case 'default':
                colors = {
                    primary: '#4A90E2',
                    secondary: '#00B3E3',
                    accent: '#FF6B00',
                    success: '#10B981',
                    dark_bg: '#111827',
                    darker_bg: '#0B1221',
                    card_bg: '#1E293B',
                    text_light: '#FFFFFF',
                    text_gray: '#94A3B8',
                    light_bg: '#FFFFFF',
                    lighter_bg: '#F5F8FA',
                    light_card_bg: '#FFFFFF',
                    text_dark: '#333333',
                    text_medium: '#666666'
                };
                break;
                
            case 'custom':
                // No cambiar los colores si es personalizado
                return;
        }
        
        // Aplicar la paleta
        wp.customize('breogan_primary_color').set(colors.primary);
        wp.customize('breogan_secondary_color').set(colors.secondary);
        wp.customize('breogan_accent_color').set(colors.accent);
        wp.customize('breogan_success_color').set(colors.success);
        wp.customize('breogan_dark_bg').set(colors.dark_bg);
        wp.customize('breogan_darker_bg').set(colors.darker_bg);
        wp.customize('breogan_card_bg').set(colors.card_bg);
        wp.customize('breogan_text_light').set(colors.text_light);
        wp.customize('breogan_text_gray').set(colors.text_gray);
        wp.customize('breogan_light_bg').set(colors.light_bg);
        wp.customize('breogan_lighter_bg').set(colors.lighter_bg);
        wp.customize('breogan_light_card_bg').set(colors.light_card_bg);
        wp.customize('breogan_text_dark').set(colors.text_dark);
        wp.customize('breogan_text_medium').set(colors.text_medium);
    }
    
    // Añadir el botón de forma correcta
    wp.customize.control('breogan_apply_palette', function(control) {
        control.container.find('input').on('click', function(e) {
            e.preventDefault();
            breogan_apply_color_palette();
        });
    });
    </script>
    <?php
}
add_action('customize_controls_print_footer_scripts', 'breogan_color_palettes_script');

// Aplicar todos los colores personalizados
function breogan_apply_custom_colors() {
    $primary_color = get_theme_mod('breogan_primary_color', '#4A90E2');
    $secondary_color = get_theme_mod('breogan_secondary_color', '#00B3E3');
    $accent_color = get_theme_mod('breogan_accent_color', '#FF6B00');
    $success_color = get_theme_mod('breogan_success_color', '#10B981');
    
    // Colores modo oscuro
    $dark_bg = get_theme_mod('breogan_dark_bg', '#111827');
    $darker_bg = get_theme_mod('breogan_darker_bg', '#0B1221');
    $card_bg = get_theme_mod('breogan_card_bg', '#1E293B');
    $text_light = get_theme_mod('breogan_text_light', '#FFFFFF');
    $text_gray = get_theme_mod('breogan_text_gray', '#94A3B8');
    
    // Colores modo claro
    $light_bg = get_theme_mod('breogan_light_bg', '#FFFFFF');
    $lighter_bg = get_theme_mod('breogan_lighter_bg', '#F5F8FA');
    $light_card_bg = get_theme_mod('breogan_light_card_bg', '#FFFFFF');
    $text_dark = get_theme_mod('breogan_text_dark', '#333333');
    $text_medium = get_theme_mod('breogan_text_medium', '#666666');
    
    $custom_css = "
        :root {
            --primary-color: {$primary_color};
            --secondary-color: {$secondary_color};
            --accent-color: {$accent_color};
            --success-color: {$success_color};
            --dark-bg: {$dark_bg};
            --darker-bg: {$darker_bg};
            --card-bg: {$card_bg};
            --text-light: {$text_light};
            --text-gray: {$text_gray};
            --light-bg: {$light_bg};
            --lighter-bg: {$lighter_bg};
            --light-card-bg: {$light_card_bg};
            --text-dark: {$text_dark};
            --text-medium: {$text_medium};
        }
        
        /* Aplicación en modo oscuro (default) */
        body {
            background-color: var(--dark-bg);
            color: var(--text-light);
        }
        
        .site-header, .hero-section, .footer {
            background-color: var(--darker-bg);
        }
        
        .course-card, .feature-item, .stats-card {
            background-color: var(--card-bg);
        }
        
        /* Aplicación en modo claro */
        body.light-mode {
            background-color: var(--light-bg);
            color: var(--text-dark);
        }
        
        body.light-mode .site-header, 
        body.light-mode .hero-section, 
        body.light-mode .footer {
            background-color: var(--lighter-bg);
        }
        
        body.light-mode .course-card, 
        body.light-mode .feature-item, 
        body.light-mode .stats-card {
            background-color: var(--light-card-bg);
        }
        
        /* Aplicación de colores principales */
        .btn-primary, 
        .wp-block-button__link,
        .curso-price-card .btn,
        .pagination .current {
            background-color: var(--primary-color);
            color: white;
        }
        
        a, .curso-features li i, .social-link:hover {
            color: var(--primary-color);
        }
        
        .curso-category {
            background-color: rgba(var(--primary-color-rgb), 0.2);
            color: var(--primary-color);
        }
        
        .price-amount, .price-free {
            color: var(--success-color);
        }
        
        .site-footer {
            background-color: var(--darker-bg);
        }
        
        body.light-mode .site-footer {
            background-color: var(--primary-color);
        }
        
        /* Convertir colores HEX a RGB para usar con transparencia */
        :root {
            --primary-color-rgb: " . implode(',', sscanf($primary_color, "#%02x%02x%02x")) . ";
            --secondary-color-rgb: " . implode(',', sscanf($secondary_color, "#%02x%02x%02x")) . ";
            --accent-color-rgb: " . implode(',', sscanf($accent_color, "#%02x%02x%02x")) . ";
        }
    ";
    
    wp_add_inline_style('breogan-lms-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'breogan_apply_custom_colors', 20);

function breogan_icon($name, $extra_class = '') {
    $icon_set = get_theme_mod('breogan_icon_set', 'font-awesome');
    $output = '';
    
    switch ($icon_set) {
        case 'font-awesome':
            // Mapeo de nombres genéricos a nombres de Font Awesome
            $fa_map = array(
                'user'           => 'fa-user',
                'clock'          => 'fa-clock',
                'signal'         => 'fa-signal',
                'heart'          => 'fa-heart',
                'video'          => 'fa-video',
                'file'           => 'fa-file-pdf',
                'certificate'    => 'fa-certificate',
                'infinity'       => 'fa-infinity',
                'search'         => 'fa-search',
                'twitter'        => 'fa-twitter',
                'linkedin'       => 'fa-linkedin-in',
                'globe'          => 'fa-globe',
                'book'           => 'fa-book-open',
                'chevron-left'   => 'fa-chevron-left',
                'chevron-right'  => 'fa-chevron-right',
            );
            
            $icon_class = isset($fa_map[$name]) ? $fa_map[$name] : 'fa-' . $name;
            $output = '<i class="fas ' . $icon_class . ' ' . $extra_class . '"></i>';
            break;
            
        case 'feather':
            $output = '<i data-feather="' . $name . '" class="' . $extra_class . '"></i>';
            break;
            
        case 'material':
            // Mapeo de nombres genéricos a nombres de Material Icons
            $material_map = array(
                'user'           => 'person',
                'clock'          => 'access_time',
                'signal'         => 'signal_cellular_alt',
                'heart'          => 'favorite',
                'video'          => 'videocam',
                'file'           => 'description',
                'certificate'    => 'verified',
                'infinity'       => 'all_inclusive',
                'search'         => 'search',
                'twitter'        => 'twitter', // Se necesitaría un icono personalizado
                'linkedin'       => 'linkedin', // Se necesitaría un icono personalizado
                'globe'          => 'public',
                'book'           => 'menu_book',
                'chevron-left'   => 'chevron_left',
                'chevron-right'  => 'chevron_right',
            );
            
            $icon_name = isset($material_map[$name]) ? $material_map[$name] : $name;
            $output = '<span class="material-icons ' . $extra_class . '">' . $icon_name . '</span>';
            break;
            
        case 'bootstrap':
            // Mapeo de nombres genéricos a nombres de Bootstrap Icons
            $bs_map = array(
                'user'           => 'bi-person',
                'clock'          => 'bi-clock',
                'signal'         => 'bi-reception-4',
                'heart'          => 'bi-heart',
                'video'          => 'bi-camera-video',
                'file'           => 'bi-file-pdf',
                'certificate'    => 'bi-patch-check',
                'infinity'       => 'bi-infinity',
                'search'         => 'bi-search',
                'twitter'        => 'bi-twitter',
                'linkedin'       => 'bi-linkedin',
                'globe'          => 'bi-globe',
                'book'           => 'bi-book',
                'chevron-left'   => 'bi-chevron-left',
                'chevron-right'  => 'bi-chevron-right',
            );
            
            $icon_class = isset($bs_map[$name]) ? $bs_map[$name] : 'bi-' . $name;
            $output = '<i class="bi ' . $icon_class . ' ' . $extra_class . '"></i>';
            break;
    }
    
    return $output;
}


function breogan_menu_color_customizer($wp_customize) {
    // Sección para colores del menú
    $wp_customize->add_section('breogan_menu_colors', array(
        'title'    => __('Colores del Menú', 'breogan-lms-theme'),
        'priority' => 50,
    ));

    // MODO OSCURO - Colores del menú
    $wp_customize->add_setting('breogan_dark_menu_bg', array(
        'default'   => '#0B1221',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_dark_menu_bg', array(
        'label'    => __('Fondo del Menú (Modo Oscuro)', 'breogan-lms-theme'),
        'section'  => 'breogan_menu_colors',
        'settings' => 'breogan_dark_menu_bg',
    )));

    $wp_customize->add_setting('breogan_dark_menu_text', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_dark_menu_text', array(
        'label'    => __('Texto del Menú (Modo Oscuro)', 'breogan-lms-theme'),
        'section'  => 'breogan_menu_colors',
        'settings' => 'breogan_dark_menu_text',
    )));

    $wp_customize->add_setting('breogan_dark_menu_hover', array(
        'default'   => '#4A90E2',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_dark_menu_hover', array(
        'label'    => __('Color al Pasar el Ratón (Modo Oscuro)', 'breogan-lms-theme'),
        'section'  => 'breogan_menu_colors',
        'settings' => 'breogan_dark_menu_hover',
    )));

    // MODO CLARO - Colores del menú
    $wp_customize->add_setting('breogan_light_menu_bg', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_light_menu_bg', array(
        'label'    => __('Fondo del Menú (Modo Claro)', 'breogan-lms-theme'),
        'section'  => 'breogan_menu_colors',
        'settings' => 'breogan_light_menu_bg',
    )));

    $wp_customize->add_setting('breogan_light_menu_text', array(
        'default'   => '#333333',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_light_menu_text', array(
        'label'    => __('Texto del Menú (Modo Claro)', 'breogan-lms-theme'),
        'section'  => 'breogan_menu_colors',
        'settings' => 'breogan_light_menu_text',
    )));

    $wp_customize->add_setting('breogan_light_menu_hover', array(
        'default'   => '#4A90E2',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_light_menu_hover', array(
        'label'    => __('Color al Pasar el Ratón (Modo Claro)', 'breogan-lms-theme'),
        'section'  => 'breogan_menu_colors',
        'settings' => 'breogan_light_menu_hover',
    )));
}
add_action('customize_register', 'breogan_menu_color_customizer');

function breogan_apply_feature_icon_styles() {
    $primary_color = get_theme_mod('breogan_primary_color', '#4A90E2');
    
    $custom_css = "
        .stats-icon i,
        .stat-icon i,
        .features-icon i {
            color: {$primary_color} !important;
        }
    ";
    
    wp_add_inline_style('breogan-lms-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'breogan_apply_feature_icon_styles', 99);

// Aplicar estilos de menú personalizados
if (!function_exists('breogan_custom_menu_styles')) {
    function breogan_custom_menu_styles() {
    // Colores para modo oscuro
    $dark_menu_bg = get_theme_mod('breogan_dark_menu_bg', '#0B1221');
    $dark_menu_text = get_theme_mod('breogan_dark_menu_text', '#FFFFFF');
    $dark_menu_hover = get_theme_mod('breogan_dark_menu_hover', '#4A90E2');

    // Colores para modo claro
    $light_menu_bg = get_theme_mod('breogan_light_menu_bg', '#FFFFFF');
    $light_menu_text = get_theme_mod('breogan_light_menu_text', '#333333');
    $light_menu_hover = get_theme_mod('breogan_light_menu_hover', '#4A90E2');

    $custom_css = "
        /* Estilos de menú para modo oscuro (predeterminado) */
        .site-header {
            background-color: {$dark_menu_bg};
        }

        .nav-menu a {
            color: {$dark_menu_text};
        }

        .nav-menu a:hover {
            color: {$dark_menu_hover};
        }

        /* Estilos de menú para modo claro */
        body.light-mode .site-header {
            background-color: {$light_menu_bg};
        }

        body.light-mode .nav-menu a {
            color: {$light_menu_text};
        }

        body.light-mode .nav-menu a:hover {
            color: {$light_menu_hover};
        }

        /* Estilos para menú móvil */
        #mobile-panel {
            background-color: {$dark_menu_bg};
        }

        .mobile-menu a {
            color: {$dark_menu_text};
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .mobile-menu a:hover {
            color: {$dark_menu_hover};
        }

        /* Estilos para menú móvil en modo claro */
        body.light-mode #mobile-panel {
            background-color: {$light_menu_bg};
        }

        body.light-mode .mobile-menu a {
            color: {$light_menu_text};
            border-bottom: 1px solid rgba(0,0,0,0.1);
        }

        body.light-mode .mobile-menu a:hover {
            color: {$light_menu_hover};
        }
    ";

    wp_add_inline_style('breogan-lms-style', $custom_css);
}
if (!has_action('wp_enqueue_scripts', 'breogan_custom_menu_styles')) {
    add_action('wp_enqueue_scripts', 'breogan_custom_menu_styles', 25);
}
// Agregar soporte para vista previa en tiempo real
function breogan_menu_color_live_preview() {
    wp_enqueue_script('customize-preview', get_template_directory_uri() . '/assets/js/customize-preview.js', array('customize-preview'), null, true);
}
add_action('customize_preview_init', 'breogan_menu_color_live_preview');
}

function breogan_typography_customizer($wp_customize) {
    // Crear sección de Tipografía en el Customizer
    $wp_customize->add_section('breogan_typography_settings', array(
        'title'    => __('Tipografía', 'breogan-lms-theme'),
        'priority' => 35,
        'description' => __('Configura las fuentes para los textos de tu sitio.', 'breogan-lms-theme'),
    ));

    // Opciones de fuentes disponibles (Google Fonts y otras)
    $font_choices = array(
        'Poppins' => 'Poppins',
        'Roboto' => 'Roboto',
        'Montserrat' => 'Montserrat',
        'Open Sans' => 'Open Sans',
        'Lato' => 'Lato',
        'Raleway' => 'Raleway',
        'Playfair Display' => 'Playfair Display',
        'Nunito' => 'Nunito',
        'Source Sans Pro' => 'Source Sans Pro',
        'Quicksand' => 'Quicksand',
        'Ubuntu' => 'Ubuntu',
        'Rubik' => 'Rubik',
        'Work Sans' => 'Work Sans',
        'Merriweather' => 'Merriweather',
        'PT Sans' => 'PT Sans',
        'PT Serif' => 'PT Serif',
        'Cabin' => 'Cabin',
        'Josefin Sans' => 'Josefin Sans',
        'Mulish' => 'Mulish',
        'Noto Sans' => 'Noto Sans',
    );

    // Opciones de peso de fuente
        $font_weights = array(
            '300' => __('Light (300)', 'breogan-lms-theme'),
            '400' => __('Normal (400)', 'breogan-lms-theme'),
            '500' => __('Medium (500)', 'breogan-lms-theme'),
            '600' => __('Semi-Bold (600)', 'breogan-lms-theme'),
            '700' => __('Bold (700)', 'breogan-lms-theme'),
            '800' => __('Extra-Bold (800)', 'breogan-lms-theme'),
        );

        // 🔹 **Fuente y Peso para Encabezados (H1 - H6)**
        $wp_customize->add_setting('breogan_heading_font', array(
            'default'   => 'Poppins',
            'transport' => 'refresh',
        ));
        $wp_customize->add_control('breogan_heading_font', array(
            'label'   => __('Fuente para Encabezados (H1 - H6)', 'breogan-lms-theme'),
            'section' => 'breogan_typography_settings',
            'type'    => 'select',
            'choices' => $font_choices,
        ));

        $wp_customize->add_setting('breogan_heading_weight', array(
            'default'   => '600',
            'transport' => 'refresh',
        ));
        $wp_customize->add_control('breogan_heading_weight', array(
            'label'   => __('Peso para Encabezados (H1 - H6)', 'breogan-lms-theme'),
            'section' => 'breogan_typography_settings',
            'type'    => 'select',
            'choices' => $font_weights,
        ));

        // 🔹 **Fuente y Peso para Párrafos**
        $wp_customize->add_setting('breogan_body_font', array(
            'default'   => 'Open Sans',
            'transport' => 'refresh',
        ));
        $wp_customize->add_control('breogan_body_font', array(
            'label'   => __('Fuente para Párrafos', 'breogan-lms-theme'),
            'section' => 'breogan_typography_settings',
            'type'    => 'select',
            'choices' => $font_choices,
        ));

        $wp_customize->add_setting('breogan_body_weight', array(
            'default'   => '400',
            'transport' => 'refresh',
        ));
        $wp_customize->add_control('breogan_body_weight', array(
            'label'   => __('Peso para Párrafos', 'breogan-lms-theme'),
            'section' => 'breogan_typography_settings',
            'type'    => 'select',
            'choices' => $font_weights,
        ));

        // 🔹 **Fuente y Peso para Menús**
        $wp_customize->add_setting('breogan_menu_font', array(
            'default'   => 'Montserrat',
            'transport' => 'refresh',
        ));
        $wp_customize->add_control('breogan_menu_font', array(
            'label'   => __('Fuente para Menús de Navegación', 'breogan-lms-theme'),
            'section' => 'breogan_typography_settings',
            'type'    => 'select',
            'choices' => $font_choices,
        ));

        $wp_customize->add_setting('breogan_menu_weight', array(
            'default'   => '500',
            'transport' => 'refresh',
        ));
        $wp_customize->add_control('breogan_menu_weight', array(
            'label'   => __('Peso para Menús de Navegación', 'breogan-lms-theme'),
            'section' => 'breogan_typography_settings',
            'type'    => 'select',
            'choices' => $font_weights,
        ));

        // 🔹 **Fuente y Peso para Botones**
        $wp_customize->add_setting('breogan_button_font', array(
            'default'   => 'Poppins',
            'transport' => 'refresh',
        ));
        $wp_customize->add_control('breogan_button_font', array(
            'label'   => __('Fuente para Botones', 'breogan-lms-theme'),
            'section' => 'breogan_typography_settings',
            'type'    => 'select',
            'choices' => $font_choices,
        ));

        $wp_customize->add_setting('breogan_button_weight', array(
            'default'   => '600',
            'transport' => 'refresh',
        ));
        $wp_customize->add_control('breogan_button_weight', array(
            'label'   => __('Peso para Botones', 'breogan-lms-theme'),
            'section' => 'breogan_typography_settings',
            'type'    => 'select',
            'choices' => $font_weights,
        ));
    }
    add_action('customize_register', 'breogan_typography_customizer');


/**
 * Cargar las fuentes seleccionadas en el frontend
 */
function breogan_enqueue_custom_fonts() {
    $heading_font = get_theme_mod('breogan_heading_font', 'Poppins');
    $body_font = get_theme_mod('breogan_body_font', 'Open Sans');
    $menu_font = get_theme_mod('breogan_menu_font', 'Montserrat');
    $button_font = get_theme_mod('breogan_button_font', 'Poppins');

    // Construir la URL de Google Fonts
    $google_fonts_url = 'https://fonts.googleapis.com/css2?family=' . urlencode($heading_font) . ':wght@400;600;700&family=' . urlencode($body_font) . ':wght@400;600&family=' . urlencode($menu_font) . ':wght@400;600&family=' . urlencode($button_font) . ':wght@400;600&display=swap';

    wp_enqueue_style('breogan-google-fonts', $google_fonts_url, array(), null);
}
add_action('wp_enqueue_scripts', 'breogan_enqueue_custom_fonts');

/**
 * Aplicar las fuentes seleccionadas mediante estilos CSS dinámicos
 */
if (!function_exists('breogan_apply_typography_styles')) {
    function breogan_apply_typography_styles() {
        $heading_font = get_theme_mod('breogan_heading_font', 'Poppins');
        $heading_weight = get_theme_mod('breogan_heading_weight', '600');
        $body_font = get_theme_mod('breogan_body_font', 'Open Sans');
        $body_weight = get_theme_mod('breogan_body_weight', '400');
        $menu_font = get_theme_mod('breogan_menu_font', 'Montserrat');
        $menu_weight = get_theme_mod('breogan_menu_weight', '500');
        $button_font = get_theme_mod('breogan_button_font', 'Poppins');
        $button_weight = get_theme_mod('breogan_button_weight', '600');

        $custom_css = "
            body {
                font-family: '{$body_font}', sans-serif;
                font-weight: {$body_weight};
            }

            h1, h2, h3, h4, h5, h6 {
                font-family: '{$heading_font}', sans-serif;
                font-weight: {$heading_weight};
            }

            .nav-menu a {
                font-family: '{$menu_font}', sans-serif;
                font-weight: {$menu_weight};
            }

            .btn, button, input[type='submit'] {
                font-family: '{$button_font}', sans-serif;
                font-weight: {$button_weight};
            }
        ";

        wp_add_inline_style('breogan-lms-style', $custom_css);
    }
    add_action('wp_enqueue_scripts', 'breogan_apply_typography_styles', 20);
}
