<?php
/**
 * Funciones principales del tema Breogan LMS
 * Versión limpia y organizada
 */
require_once get_template_directory() . '/inc/meta-boxes.php';
require_once get_template_directory() . '/inc/custom-styles.php';
require_once get_template_directory() . '/inc/customizer-main.php';
// ====================================
// CONFIGURACIÓN BÁSICA DEL TEMA
// ====================================

function breogan_lms_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 190,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-background');
    add_theme_support('custom-header');

    register_nav_menus(array(
        'main-menu' => __('Main Menu', 'breogan-lms-theme'),
        'footer-menu' => __('Footer Menu', 'breogan-lms-theme'),
    ));
}
add_action('after_setup_theme', 'breogan_lms_theme_setup');

// Función para menú de respaldo
function breogan_fallback_menu() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Inicio</a></li>';
    echo '<li><a href="https://rociodemayo.com/curso">Cursos</a></li>';
    echo '<li><a href="https://rociodemayo.com/blog">Blog</a></li>';
    echo '<li><a href="https://rociodemayo.com/sobre-nosotros">Nosotros</a></li>';
    echo '<li><a href="https://rociodemayo.com/instructor">Instructores</a></li>';
    echo '<li><a href="https://rociodemayo.com/tarot">Tarot</a></li>';
    echo '</ul>';
}

// ====================================
// SCRIPTS Y ESTILOS
// ====================================

function breogan_lms_theme_enqueue_scripts() {
    // Estilos
    wp_enqueue_style(
        'breogan-lms-style',
        get_stylesheet_uri(),
        array(),
        filemtime( get_template_directory() . '/style.css' )
    );

    // Para que funcione jQuery
    wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'breogan_lms_theme_enqueue_scripts' );



// Estilos críticos para corregir scroll horizontal
function breogan_critical_fixes() {
    ?>
    <style>
        html, body {
            overflow-x: hidden !important;
            max-width: 100% !important;
        }
        * {
            max-width: 100vw;
            box-sizing: border-box !important;
        }
    </style>
    <?php
}
add_action('wp_head', 'breogan_critical_fixes', 1);

// Estilos personalizados del tema
function breogan_custom_styles() {
    $primary_color = get_theme_mod('breogan_primary_color', '#4A90E2');
    $secondary_color = get_theme_mod('breogan_secondary_color', '#00B3E3');
    $font = get_theme_mod('breogan_font', 'Poppins');

    $custom_css = "
        :root {
            --primary-color: {$primary_color};
            --secondary-color: {$secondary_color};
            --dark-bg: #111827;
            --darker-bg: #0B1221;
            --card-bg: #1E293B;
            --font-main: '{$font}', sans-serif;
        }
    ";

    wp_add_inline_style('breogan-lms-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'breogan_custom_styles', 20);

// ====================================
// PERSONALIZADOR DE ICONOS
// ====================================


// ====================================
// PERSONALIZADOR
// ====================================

function breogan_lms_customize_register($wp_customize) {
    // Sección de opciones generales
    $wp_customize->add_section('breogan_general_settings', array(
        'title'    => __('Opciones Generales', 'breogan-lms-theme'),
        'priority' => 20,
    ));

    // Logo del sitio (texto alternativo)
    $wp_customize->add_setting('breogan_logo_text', array(
        'default'   => 'HERO',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('breogan_logo_text', array(
        'label'    => __('Texto del Logo', 'breogan-lms-theme'),
        'section'  => 'breogan_general_settings',
        'type'     => 'text',
    ));

    // Sección de colores
    $wp_customize->add_section('breogan_theme_colors', array(
        'title'    => __('Colores del Tema', 'breogan-lms-theme'),
        'priority' => 30,
    ));

    // Color primario
    $wp_customize->add_setting('breogan_primary_color', array(
        'default'   => '#4A90E2',
        'transport' => 'refresh',
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
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'breogan_secondary_color', array(
        'label'    => __('Color Secundario', 'breogan-lms-theme'),
        'section'  => 'breogan_theme_colors',
        'settings' => 'breogan_secondary_color',
    )));

    // Fuente del tema
    $wp_customize->add_setting('breogan_font', array(
        'default'   => 'Poppins',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('breogan_font', array(
        'label'    => __('Fuente del Tema', 'breogan-lms-theme'),
        'section'  => 'breogan_theme_colors',
        'type'     => 'select',
        'choices'  => array(
            'Poppins'   => 'Poppins',
            'Roboto'    => 'Roboto',
            'Montserrat'=> 'Montserrat',
            'Open Sans' => 'Open Sans',
            'Lato'      => 'Lato',
        ),
    ));

    // Sección de Hero (Página de inicio)
    $wp_customize->add_section('breogan_hero_settings', array(
        'title'    => __('Sección Hero', 'breogan-lms-theme'),
        'priority' => 40,
    ));

    // Título del Hero
    $wp_customize->add_setting('breogan_hero_title', array(
        'default'   => 'Selling Online Courses',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('breogan_hero_title', array(
        'label'    => __('Título Principal', 'breogan-lms-theme'),
        'section'  => 'breogan_hero_settings',
        'type'     => 'text',
    ));

    // Descripción del Hero
    $wp_customize->add_setting('breogan_hero_description', array(
        'default'   => 'Teach what you know and build a thriving community around your passion while creating additional streams of revenue.',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('breogan_hero_description', array(
        'label'    => __('Descripción', 'breogan-lms-theme'),
        'section'  => 'breogan_hero_settings',
        'type'     => 'textarea',
    ));

    // Imagen del Hero
    $wp_customize->add_setting('breogan_hero_image', array(
        'default'   => '',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'breogan_hero_image', array(
        'label'    => __('Imagen del Hero', 'breogan-lms-theme'),
        'section'  => 'breogan_hero_settings',
        'settings' => 'breogan_hero_image',
    )));
}
add_action('customize_register', 'breogan_lms_customize_register');

// ====================================
// CUSTOM POST TYPE PARA CURSOS
// ====================================

function breogan_lms_register_course_post_type() {
    $labels = array(
        'name'               => _x('Cursos', 'post type general name', 'breogan-lms-theme'),
        'singular_name'      => _x('Curso', 'post type singular name', 'breogan-lms-theme'),
        'menu_name'          => _x('Cursos', 'admin menu', 'breogan-lms-theme'),
        'add_new'            => _x('Añadir nuevo', 'curso', 'breogan-lms-theme'),
        'add_new_item'       => __('Añadir nuevo curso', 'breogan-lms-theme'),
        'new_item'           => __('Nuevo curso', 'breogan-lms-theme'),
        'edit_item'          => __('Editar curso', 'breogan-lms-theme'),
        'view_item'          => __('Ver curso', 'breogan-lms-theme'),
        'all_items'          => __('Todos los cursos', 'breogan-lms-theme'),
        'search_items'       => __('Buscar cursos', 'breogan-lms-theme'),
        'not_found'          => __('No se encontraron cursos.', 'breogan-lms-theme'),
        'not_found_in_trash' => __('No se encontraron cursos en la papelera.', 'breogan-lms-theme')
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __('Cursos para vender online', 'breogan-lms-theme'),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'curso'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-welcome-learn-more',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
    );

    register_post_type('curso', $args);

    // Taxonomía Categoría de Curso
    $category_labels = array(
        'name'              => _x('Categorías de Curso', 'taxonomy general name', 'breogan-lms-theme'),
        'singular_name'     => _x('Categoría de Curso', 'taxonomy singular name', 'breogan-lms-theme'),
        'search_items'      => __('Buscar Categorías', 'breogan-lms-theme'),
        'all_items'         => __('Todas las Categorías', 'breogan-lms-theme'),
        'parent_item'       => __('Categoría Padre', 'breogan-lms-theme'),
        'edit_item'         => __('Editar Categoría', 'breogan-lms-theme'),
        'update_item'       => __('Actualizar Categoría', 'breogan-lms-theme'),
        'add_new_item'      => __('Añadir Nueva Categoría', 'breogan-lms-theme'),
        'new_item_name'     => __('Nombre de Nueva Categoría', 'breogan-lms-theme'),
        'menu_name'         => __('Categorías', 'breogan-lms-theme'),
    );

    $category_args = array(
        'hierarchical'      => true,
        'labels'            => $category_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'categoria-curso'),
    );

    register_taxonomy('categoria_curso', array('curso'), $category_args);
}
add_action('init', 'breogan_lms_register_course_post_type');

// ====================================
// ELIMINAR SCRIPTS ANTIGUOS
// ====================================
remove_action('wp_footer', 'breogan_jquery_mobile_menu');
remove_action('wp_footer', 'breogan_jquery_dark_mode');

// ====================================
// SCRIPTS FINALES: MENÚ MÓVIL + MODO OSCURO
// ====================================

function breogan_combined_scripts() {
    ?>
    <script>
    (function($) {
        $(document).ready(function() {
            console.log('Script combinado iniciado');

            // ===== MENÚ MÓVIL =====
            var $mobileToggle  = $('#mobile-toggle');
            var $mobilePanel   = $('#mobile-panel');
            var $closePanel    = $('#close-panel');
            var $mobileOverlay = $('#mobile-overlay');

            function openMobileMenu() {
                $mobilePanel.addClass('active').css('right', '0');
                $mobileOverlay.fadeIn();
                $('body').addClass('has-mobile-menu-open').css('overflow', 'hidden');
            }

            function closeMobileMenu() {
                $mobilePanel.removeClass('active').css('right', '-280px');
                $mobileOverlay.fadeOut();
                $('body').removeClass('has-mobile-menu-open').css('overflow', '');
            }

            // Corregir scroll horizontal
            function fixHorizontalScroll() {
                if (document.body.scrollWidth > window.innerWidth) {
                    $('body').css('width', '100%').css('overflow-x', 'hidden');
                    $('html').css('overflow-x', 'hidden');
                }
            }

            // Ejecutar al cargar
            fixHorizontalScroll();

            // Ajustar y estilo panel
            if ($mobilePanel.length) {
                $mobilePanel.css({
                    'position': 'fixed',
                    'top': '0',
                    'right': '-280px',
                    'width': '280px',
                    'height': '100%',
                    'z-index': '9999',
                    'max-width': '80%',
                    'overflow-y': 'auto',
                    'overflow-x': 'hidden',
                    'transition': 'right 0.3s ease'
                });
            }

            if ($mobileOverlay.length) {
                $mobileOverlay.css({
                    'position': 'fixed',
                    'top': '0',
                    'left': '0',
                    'width': '100%',
                    'height': '100%',
                    'background-color': 'rgba(0,0,0,0.5)',
                    'z-index': '9998',
                    'display': 'none'
                });
            }

            // Eventos de menú móvil
            $mobileToggle.on('click', function(e) {
                e.preventDefault();
                openMobileMenu();
            });

            $closePanel.on('click', function(e) {
                e.preventDefault();
                closeMobileMenu();
            });

            $mobileOverlay.on('click', function() {
                closeMobileMenu();
            });

            $('.mobile-menu a').on('click', function() {
                closeMobileMenu();
            });

            $(window).on('resize.mobileMenu', function() {
                fixHorizontalScroll();
                if ($(window).width() >= 992) {
                    closeMobileMenu();
                }
            });

            // Prevenir scroll en body cuando el menú está abierto
            $(document).on('touchmove', function(e) {
                if ($('body').hasClass('has-mobile-menu-open') &&
                    !$(e.target).closest('#mobile-panel').length) {
                    e.preventDefault();
                }
            });

            // ===== MODO OSCURO/CLARO =====
            var $darkModeToggle       = $('#dark-mode-toggle');
            var $mobileDarkModeToggle = $('#mobile-toggle-dark-mode');
            var darkMode              = localStorage.getItem('darkMode') !== 'false';

            // Actualizar icono según modo
            function updateIcon($button) {
                if (darkMode) {
                    $button.html('<i class=\"fas fa-sun\"></i>');
                    $button.attr('title', 'Cambiar a modo claro');
                } else {
                    $button.html('<i class=\"fas fa-moon\"></i>');
                    $button.attr('title', 'Cambiar a modo oscuro');
                }
            }

            function enableDarkMode() {
    $('body').removeClass('light-mode');
    darkMode = true;
    localStorage.setItem('darkMode', 'true');
    if ($darkModeToggle.length) updateIcon($darkModeToggle);
    if ($mobileDarkModeToggle.length) updateIcon($mobileDarkModeToggle);

    // Cambiar color del panel móvil
    $mobilePanel.css('background-color', '<?php echo get_theme_mod("mobile_menu_dark_bg_color", "#0B1221"); ?>');
}

function enableLightMode() {
    $('body').addClass('light-mode');
    darkMode = false;
    localStorage.setItem('darkMode', 'false');
    if ($darkModeToggle.length) updateIcon($darkModeToggle);
    if ($mobileDarkModeToggle.length) updateIcon($mobileDarkModeToggle);

    // Cambiar color del panel móvil
    $mobilePanel.css('background-color', '<?php echo get_theme_mod("mobile_menu_light_bg_color", "#f5f8fa"); ?>');
}

            // Inicializar modo
            if (darkMode) {
                enableDarkMode();
            } else {
                enableLightMode();
            }

            // Click en toggles
            $darkModeToggle.on('click', function(e) {
                e.preventDefault();
                if (darkMode) {
                    enableLightMode();
                } else {
                    enableDarkMode();
                }
            });

            if ($mobileDarkModeToggle.length) {
                $mobileDarkModeToggle.on('click', function(e) {
                    e.preventDefault();
                    if (darkMode) {
                        enableLightMode();
                    } else {
                        enableDarkMode();
                    }
                });
            }
        });
    })(jQuery);
    </script>
    <?php
}
add_action('wp_footer', 'breogan_combined_scripts', 99);

// Añadir a functions.php
function breogan_register_instructor_post_type() {
    $labels = array(
        'name'               => _x('Instructores', 'post type general name', 'breogan-lms-theme'),
        'singular_name'      => _x('Instructor', 'post type singular name', 'breogan-lms-theme'),
        'menu_name'          => _x('Instructores', 'admin menu', 'breogan-lms-theme'),
        'add_new'            => _x('Añadir nuevo', 'instructor', 'breogan-lms-theme'),
        'add_new_item'       => __('Añadir nuevo instructor', 'breogan-lms-theme'),
        'new_item'           => __('Nuevo instructor', 'breogan-lms-theme'),
        'edit_item'          => __('Editar instructor', 'breogan-lms-theme'),
        'view_item'          => __('Ver instructor', 'breogan-lms-theme'),
        'all_items'          => __('Todos los instructores', 'breogan-lms-theme'),
        'search_items'       => __('Buscar instructores', 'breogan-lms-theme'),
        'not_found'          => __('No se encontraron instructores.', 'breogan-lms-theme'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'instructor'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-businessman',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
    );

    register_post_type('instructor', $args);
}
add_action('init', 'breogan_register_instructor_post_type');

// Añadir campos adicionales para instructores
function breogan_instructor_meta_boxes() {
    add_meta_box(
        'breogan_instructor_details',
        __('Detalles del Instructor', 'breogan-lms-theme'),
        'breogan_instructor_details_callback',
        'instructor',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'breogan_instructor_meta_boxes');

function breogan_instructor_details_callback($post) {
    wp_nonce_field('breogan_instructor_details_save', 'breogan_instructor_details_nonce');
    
    // Recuperar valores actuales
    $position = get_post_meta($post->ID, '_instructor_position', true);
    $social_twitter = get_post_meta($post->ID, '_instructor_twitter', true);
    $social_linkedin = get_post_meta($post->ID, '_instructor_linkedin', true);
    $social_website = get_post_meta($post->ID, '_instructor_website', true);
    
    // Campos para mostrar
    ?>
    <p>
        <label for="instructor_position"><?php _e('Cargo o Posición:', 'breogan-lms-theme'); ?></label>
        <input type="text" id="instructor_position" name="instructor_position" value="<?php echo esc_attr($position); ?>" style="width: 100%;" />
    </p>
    
    <h4><?php _e('Redes Sociales', 'breogan-lms-theme'); ?></h4>
    
    <p>
        <label for="instructor_twitter"><?php _e('Twitter:', 'breogan-lms-theme'); ?></label>
        <input type="url" id="instructor_twitter" name="instructor_twitter" value="<?php echo esc_url($social_twitter); ?>" placeholder="https://twitter.com/username" style="width: 100%;" />
    </p>
    
    <p>
        <label for="instructor_linkedin"><?php _e('LinkedIn:', 'breogan-lms-theme'); ?></label>
        <input type="url" id="instructor_linkedin" name="instructor_linkedin" value="<?php echo esc_url($social_linkedin); ?>" placeholder="https://linkedin.com/in/username" style="width: 100%;" />
    </p>
    
    <p>
        <label for="instructor_website"><?php _e('Sitio Web:', 'breogan-lms-theme'); ?></label>
        <input type="url" id="instructor_website" name="instructor_website" value="<?php echo esc_url($social_website); ?>" placeholder="https://example.com" style="width: 100%;" />
    </p>
    <?php
}

function breogan_instructor_details_save($post_id) {
    // Verificaciones de seguridad
    if (!isset($_POST['breogan_instructor_details_nonce']) || 
        !wp_verify_nonce($_POST['breogan_instructor_details_nonce'], 'breogan_instructor_details_save')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Guardar campos
    if (isset($_POST['instructor_position'])) {
        update_post_meta($post_id, '_instructor_position', sanitize_text_field($_POST['instructor_position']));
    }
    
    if (isset($_POST['instructor_twitter'])) {
        update_post_meta($post_id, '_instructor_twitter', esc_url_raw($_POST['instructor_twitter']));
    }
    
    if (isset($_POST['instructor_linkedin'])) {
        update_post_meta($post_id, '_instructor_linkedin', esc_url_raw($_POST['instructor_linkedin']));
    }
    
    if (isset($_POST['instructor_website'])) {
        update_post_meta($post_id, '_instructor_website', esc_url_raw($_POST['instructor_website']));
    }
}
add_action('save_post_instructor', 'breogan_instructor_details_save');

function breogan_instructor_inline_styles() {
    echo '<style>
/* ===== ESTILOS PARA PERFIL DE INSTRUCTOR (SINGLE) ===== */
        .instructor-container {
            padding: 60px 0;
            background-color: var(--darker-bg);
        }
        
        .instructor-profile {
            background-color: var(--card-bg);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .instructor-header {
            display: flex;
            padding: 40px;
            background-color: rgba(0, 0, 0, 0.1);
            gap: 30px;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .instructor-avatar {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid var(--primary-color);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            flex-shrink: 0;
        }
        
        .instructor-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .instructor-avatar-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e0e0e0;
            color: #666;
            font-size: 3rem;
        }
        
        .instructor-header-info {
            flex: 1;
            min-width: 200px;
        }
        
        .instructor-name {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: var(--text-light);
            line-height: 1.2;
        }
        
        .instructor-position {
            font-size: 1.2rem;
            color: var(--primary-color);
            margin-bottom: 20px;
            font-weight: 500;
        }
        
        .instructor-social {
            display: flex;
            gap: 15px;
        }
        
        .instructor-social .social-link {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            font-size: 1.2rem;
            transition: all 0.3s;
        }
        
        .instructor-social .social-link:hover {
            background-color: var(--primary-color);
            transform: translateY(-3px);
        }
        
        .instructor-content {
            padding: 40px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .instructor-content h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: var(--text-light);
        }
        
        .instructor-bio {
            color: var(--text-gray);
            line-height: 1.7;
        }
        
        .instructor-bio p {
            margin-bottom: 20px;
        }
        
        .instructor-courses {
            padding: 40px;
        }
        
        .instructor-courses h2 {
            font-size: 1.8rem;
            margin-bottom: 30px;
            color: var(--text-light);
        }
        
        .no-courses {
            padding: 30px;
            background-color: rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            color: var(--text-gray);
            text-align: center;
        }
        
        /* Responsive para single instructor */
        @media (max-width: 992px) {
            .instructor-header {
                padding: 30px;
            }
            
            .instructor-name {
                font-size: 2rem;
            }
            
            .instructor-content,
            .instructor-courses {
                padding: 30px;
            }
        }
        
        @media (max-width: 768px) {
            .instructor-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
                padding: 25px;
            }
            
            .instructor-social {
                justify-content: center;
            }
            
            .instructor-avatar {
                width: 150px;
                height: 150px;
            }
            
            .instructor-name {
                font-size: 1.8rem;
            }
            
            .instructor-content,
            .instructor-courses {
                padding: 25px;
            }
        }
        
        @media (max-width: 576px) {
            .instructor-avatar {
                width: 120px;
                height: 120px;
            }
            
            .instructor-name {
                font-size: 1.5rem;
            }
            
            .instructor-position {
                font-size: 1rem;
            }
            
            .instructor-content h2,
            .instructor-courses h2 {
                font-size: 1.5rem;
            }
        }
        
        /* ===== ESTILOS PARA ARCHIVO DE INSTRUCTORES ===== */
        .instructors-archive-banner {
            background-color: var(--darker-bg);
            padding: 60px 0;
            position: relative;
            overflow: hidden;
            text-align: center;
        }
        
        .instructors-archive-banner .banner-content {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .instructors-archive-banner .archive-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text-light);
        }
        
        .instructors-archive-banner .archive-description {
            font-size: 1.2rem;
            color: var(--text-gray);
        }
        
        .instructors-archive-container {
            padding: 60px 0;
            background-color: var(--dark-bg);
        }
        
        .instructors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .instructor-card {
            background-color: var(--card-bg);
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .instructor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        
        .instructor-card-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
        .instructor-card-inner {
            display: flex;
            flex-direction: column;
        }
        
        .instructor-card-avatar {
            height: 250px;
            overflow: hidden;
        }
        
        .instructor-card-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        
        .instructor-card:hover .instructor-card-avatar img {
            transform: scale(1.05);
        }
        
        .instructor-card-content {
            padding: 25px;
        }
        
        .instructor-card-name {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: var(--text-light);
        }
        
        .instructor-card-position {
            font-size: 1rem;
            color: var(--primary-color);
            margin-bottom: 15px;
            font-weight: 500;
        }
        
        .instructor-card-bio {
            color: var(--text-gray);
            margin-bottom: 20px;
            line-height: 1.6;
        }
        
        .instructor-card-more {
            display: flex;
            align-items: center;
            color: var(--primary-color);
            font-weight: 600;
            transition: transform 0.3s;
        }
        
        .instructor-card-more i {
            margin-left: 8px;
            transition: transform 0.3s;
        }
        
        .instructor-card:hover .instructor-card-more {
            transform: translateX(5px);
        }
        
        .instructor-card:hover .instructor-card-more i {
            transform: translateX(3px);
        }
        
        .no-instructors-message {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            background-color: var(--card-bg);
            border-radius: 15px;
        }
        
        .no-instructors-message i {
            font-size: 3rem;
            color: var(--text-gray);
            margin-bottom: 20px;
            display: block;
        }
        
        .no-instructors-message h2 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: var(--text-light);
        }
        
        .no-instructors-message p {
            font-size: 1.1rem;
            color: var(--text-gray);
        }
        
        /* Responsive para archive instructor */
        @media (max-width: 992px) {
            .instructors-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 25px;
            }
        }
        
        @media (max-width: 768px) {
            .instructors-archive-banner {
                padding: 40px 0;
            }
            
            .instructors-archive-banner .archive-title {
                font-size: 2rem;
            }
            
            .instructors-archive-container {
                padding: 40px 0;
            }
        }
        
        @media (max-width: 576px) {
            .instructors-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .instructors-archive-banner .archive-title {
                font-size: 1.8rem;
            }
            
            .instructors-archive-banner .archive-description {
                font-size: 1rem;
            }
        }
        
        /* Clase para modo claro */
        body.light-mode .instructor-profile,
        body.light-mode .instructor-card,
        body.light-mode .no-instructors-message {
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }
        
        body.light-mode .instructor-content {
            border-bottom-color: rgba(0, 0, 0, 0.1);
        }
        
        body.light-mode .instructor-social .social-link {
            background-color: rgba(0, 0, 0, 0.05);
        }
        
        body.light-mode .no-courses {
            background-color: rgba(0, 0, 0, 0.03);
        }    </style>';
}
add_action('wp_head', 'breogan_instructor_inline_styles');

// Función para aplicar los colores personalizados del menú
function breogan_custom_menu_styles() {
    // Obtener los colores personalizados del menú
    $menu_dark_text = get_theme_mod('menu_dark_text_color', '#FFFFFF');
    $menu_dark_hover = get_theme_mod('menu_dark_hover_color', '#4A90E2');
    $menu_dark_bg = get_theme_mod('menu_dark_bg_color', '#0B1221');
    
    $menu_light_text = get_theme_mod('menu_light_text_color', '#333333');
    $menu_light_hover = get_theme_mod('menu_light_hover_color', '#4A90E2');
    $menu_light_bg = get_theme_mod('menu_light_bg_color', '#FFFFFF');
    
    $mobile_menu_dark_bg = get_theme_mod('mobile_menu_dark_bg_color', '#0B1221');
    $mobile_menu_light_bg = get_theme_mod('mobile_menu_light_bg_color', '#f5f8fa');
    
    $custom_css = "
        /* Estilos para el menú en modo oscuro */
        .site-header {
            background-color: {$menu_dark_bg};
        }
        
        .nav-menu a {
            color: {$menu_dark_text};
        }
        
        .nav-menu a:hover {
            color: {$menu_dark_hover};
        }
        
        /* Estilos para el menú móvil en modo oscuro */
        #mobile-panel {
            background-color: {$mobile_menu_dark_bg};
        }
        
        .mobile-menu a {
            color: {$menu_dark_text};
        }
        
        .mobile-menu a:hover {
            color: {$menu_dark_hover};
        }
        
        /* Estilos para el menú en modo claro */
        body.light-mode .site-header {
            background-color: {$menu_light_bg};
        }
        
        body.light-mode .nav-menu a {
            color: {$menu_light_text};
        }
        
        body.light-mode .nav-menu a:hover {
            color: {$menu_light_hover};
        }
        
        /* Estilos para el menú móvil en modo claro */
        body.light-mode #mobile-panel {
            background-color: {$mobile_menu_light_bg};
        }
        
        body.light-mode .mobile-menu a {
            color: {$menu_light_text};
        }
        
        body.light-mode .mobile-menu a:hover {
            color: {$menu_light_hover};
        }
    ";
    
    wp_add_inline_style('breogan-lms-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'breogan_custom_menu_styles', 25);



function breogan_enqueue_parallax_init() {
   wp_enqueue_script('breogan-rellax', get_template_directory_uri() . '/assets/js/rellax.min.js', array('jquery'), '1.0', true);
}
add_action( 'wp_enqueue_scripts', 'breogan_enqueue_parallax_init' );

// PREVIEW CUSTOMIZE

function breogan_enqueue_customize_preview() {
    wp_enqueue_script(
        'breogan-customize-preview', 
        get_template_directory_uri() . '/assets/js/customize-preview.js', 
        array('customize-preview', 'jquery'), 
        wp_get_theme()->get('Version'), 
        true
    );
}
add_action('customize_preview_init', 'breogan_enqueue_customize_preview');

if (!function_exists('breogan_load_icons')) {
    function breogan_load_icons() {
        $icon_set = get_theme_mod('breogan_icon_set', 'font-awesome');

        switch ($icon_set) {
            case 'font-awesome':
                wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
                break;

            case 'feather':
                wp_enqueue_script('feather-icons', 'https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js', array(), '4.29.0', true);
                add_action('wp_footer', function() {
                    echo '<script>feather.replace();</script>';
                });
                break;

            case 'material':
                wp_enqueue_style('material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', array(), null);
                break;

            case 'bootstrap':
                wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css', array(), '1.10.5');
                break;
        }
    }
    add_action('wp_enqueue_scripts', 'breogan_load_icons');
}




function breogan_enqueue_scripts() {
    // Cargar el archivo de iconos solo en el Personalizador de WordPress
    if (is_customize_preview()) {
        wp_enqueue_script(
            'breogan-icons-customizer', // Nombre del script
            get_template_directory_uri() . '/assets/js/icons-customizer.js', // Ruta del script
            array('jquery', 'customize-preview'), // Dependencias (jQuery + soporte para el Customizer)
            null, // Versión (puedes poner filemtime para evitar caché)
            true // Cargar en el footer
        );
    }
}
add_action('customize_preview_init', 'breogan_enqueue_scripts');

// Registrar barra lateral para páginas
function breogan_register_sidebars() {
    register_sidebar(array(
        'name'          => __('Sidebar de Páginas y Blog', 'breogan-lms-theme'),
        'id'            => 'sidebar-page',
        'description'   => __('Widgets para la barra lateral de páginas y entradas', 'breogan-lms-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'breogan_register_sidebars');

function breogan_blog_sidebar_name($sidebar) {
    if (is_page_template('template-blog.php')) {
        return 'sidebar-page';
    }
    return $sidebar;
}
add_filter('get_sidebar', 'breogan_blog_sidebar_name');

// Añade este filtro para suprimir la advertencia
add_filter('deprecated_file_trigger_error', '__return_false');

// Log de depuración adicional
function breogan_debug_sidebar_template($sidebar) {
    error_log('Sidebar template being loaded: ' . $sidebar);
    return $sidebar;
}
add_filter('sidebar_template', 'breogan_debug_sidebar_template');

// Añadir campo de subtítulo para la plantilla con Hero
function breogan_add_page_subtitle_meta_box() {
    add_meta_box(
        'breogan_page_subtitle',
        __('Subtítulo de la Página', 'breogan-lms-theme'),
        'breogan_page_subtitle_callback',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'breogan_add_page_subtitle_meta_box');

function breogan_page_subtitle_callback($post) {
    wp_nonce_field('breogan_page_subtitle_save', 'breogan_page_subtitle_nonce');
    $subtitle = get_post_meta($post->ID, '_page_subtitle', true);
    ?>
    <p>
        <label for="page_subtitle"><?php _e('Subtítulo (se muestra en la plantilla con Hero):', 'breogan-lms-theme'); ?></label>
        <input type="text" id="page_subtitle" name="page_subtitle" value="<?php echo esc_attr($subtitle); ?>" style="width: 100%;" />
    </p>
    <?php
}

function breogan_page_subtitle_save($post_id) {
    if (!isset($_POST['breogan_page_subtitle_nonce']) || !wp_verify_nonce($_POST['breogan_page_subtitle_nonce'], 'breogan_page_subtitle_save')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['page_subtitle'])) {
        update_post_meta($post_id, '_page_subtitle', sanitize_text_field($_POST['page_subtitle']));
    }
}
add_action('save_post_page', 'breogan_page_subtitle_save');

/**
 * Deshabilitar header/footer en páginas
 */
function breogan_add_layout_options_meta_box() {
    add_meta_box(
        'breogan_layout_options',
        __('Opciones de Layout', 'breogan-lms-theme'),
        'breogan_layout_options_callback',
        'page',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'breogan_add_layout_options_meta_box');

/**
 * Callback para el metabox de opciones de layout
 */
function breogan_layout_options_callback($post) {
    wp_nonce_field('breogan_layout_options_save', 'breogan_layout_options_nonce');
    
    // Obtener valores actuales
    $disable_header = get_post_meta($post->ID, '_breogan_disable_header', true);
    $disable_footer = get_post_meta($post->ID, '_breogan_disable_footer', true);
    ?>
    <p>
        <label>
            <input type="checkbox" name="breogan_disable_header" <?php checked($disable_header, 'yes'); ?> />
            <?php _e('Deshabilitar Header', 'breogan-lms-theme'); ?>
        </label>
    </p>
    <p>
        <label>
            <input type="checkbox" name="breogan_disable_footer" <?php checked($disable_footer, 'yes'); ?> />
            <?php _e('Deshabilitar Footer', 'breogan-lms-theme'); ?>
        </label>
    </p>
    <p class="description">
        <?php _e('Estas opciones te permiten crear páginas personalizadas sin el header o footer estándar del tema.', 'breogan-lms-theme'); ?>
    </p>
    <?php
}

/**
 * Guardar metadatos de opciones de layout
 */
function breogan_layout_options_save($post_id) {
    // Verificar nonce
    if (!isset($_POST['breogan_layout_options_nonce']) || 
        !wp_verify_nonce($_POST['breogan_layout_options_nonce'], 'breogan_layout_options_save')) {
        return;
    }
    
    // Verificar autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Verificar permisos
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Actualizar metadata
    $disable_header = isset($_POST['breogan_disable_header']) ? 'yes' : 'no';
    $disable_footer = isset($_POST['breogan_disable_footer']) ? 'yes' : 'no';
    
    update_post_meta($post_id, '_breogan_disable_header', $disable_header);
    update_post_meta($post_id, '_breogan_disable_footer', $disable_footer);
}
add_action('save_post_page', 'breogan_layout_options_save');

/**
 * Añadir clases al body basadas en las opciones de layout
 */
function breogan_custom_body_classes($classes) {
    if (is_page()) {
        $disable_header = get_post_meta(get_the_ID(), '_breogan_disable_header', true);
        $disable_footer = get_post_meta(get_the_ID(), '_breogan_disable_footer', true);
        
        if ($disable_header === 'yes') {
            $classes[] = 'no-header';
        }
        
        if ($disable_footer === 'yes') {
            $classes[] = 'no-footer';
        }
    }
    
    return $classes;
}
add_filter('body_class', 'breogan_custom_body_classes');

/**
 * Personalizar la longitud del extracto
 */
function breogan_custom_excerpt_length($length) {
    return 20; // Mostrar solo 20 palabras
}
add_filter('excerpt_length', 'breogan_custom_excerpt_length', 999);

/**
 * Personalizar el texto del "leer más"
 */
function breogan_custom_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'breogan_custom_excerpt_more');

/**
 * Forzar extractos en todas las páginas de listado del blog
 */
function breogan_force_excerpts($content) {
    if (is_home() || is_archive() || is_search()) {
        return get_the_excerpt();
    }
    return $content;
}
add_filter('the_content', 'breogan_force_excerpts', 1);

/**
 * Añadir soporte para extractos en páginas
 */
add_post_type_support('page', 'excerpt');

/**
 * Crear un extracto personalizado con un botón de "Leer más"
 */
function breogan_custom_excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    
    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
    
    return $excerpt;
}

/**
 * Añadir clases de CSS a los enlaces de paginación
 */
function breogan_pagination_link_attributes($output) {
    $output = str_replace('<a class="page-numbers"', '<a class="page-numbers btn btn-outline-primary"', $output);
    $output = str_replace('<a class="prev page-numbers"', '<a class="prev page-numbers btn btn-outline-primary"', $output);
    $output = str_replace('<a class="next page-numbers"', '<a class="next page-numbers btn btn-outline-primary"', $output);
    $output = str_replace('<span aria-current="page" class="page-numbers current"', '<span aria-current="page" class="page-numbers current btn btn-primary"', $output);
    
    return $output;
}
add_filter('paginate_links', 'breogan_pagination_link_attributes');

/**
 * Personalizar el texto del botón "Leer más"
 */
function breogan_modify_read_more_link() {
    $read_more_text = get_theme_mod('breogan_read_more_text', __('Leer más', 'breogan-lms-theme'));
    return '<a class="more-link btn btn-primary btn-sm" href="' . get_permalink() . '">' . $read_more_text . ' <i class="fas fa-chevron-right"></i></a>';
}
add_filter('the_content_more_link', 'breogan_modify_read_more_link');
/**
 * Registrar áreas de widgets
 */
function breogan_widgets_init() {
    register_sidebar(array(
        'name'          => __('Barra lateral del blog', 'breogan-lms-theme'),
        'id'            => 'sidebar-1',
        'description'   => __('Añade widgets aquí para mostrarlos en la barra lateral del blog.', 'breogan-lms-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer 1', 'breogan-lms-theme'),
        'id'            => 'footer-1',
        'description'   => __('Añade widgets aquí para mostrarlos en la primera columna del footer.', 'breogan-lms-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer 2', 'breogan-lms-theme'),
        'id'            => 'footer-2',
        'description'   => __('Añade widgets aquí para mostrarlos en la segunda columna del footer.', 'breogan-lms-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer 3', 'breogan-lms-theme'),
        'id'            => 'footer-3',
        'description'   => __('Añade widgets aquí para mostrarlos en la tercera columna del footer.', 'breogan-lms-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer 4', 'breogan-lms-theme'),
        'id'            => 'footer-4',
        'description'   => __('Añade widgets aquí para mostrarlos en la cuarta columna del footer.', 'breogan-lms-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'breogan_widgets_init');

function breogan_enqueue_blog_styles() {
    // Solo cargamos estos estilos en las páginas de blog
    if (is_home() || is_archive() || is_search() || is_singular('post') || is_page_template('template-blog.php')) {
        wp_enqueue_style(
            'breogan-blog-style',
            get_template_directory_uri() . '/assets/css/blog-fullwidth.css',
            array(),
            filemtime(get_template_directory() . '/assets/css/blog-fullwidth.css')
        );
    }
}
add_action('wp_enqueue_scripts', 'breogan_enqueue_blog_styles');

// Añadir metabox para opción de ancho en template-with-hero
function hero_layout_metabox() {
    add_meta_box(
        'hero_layout_metabox',
        'Opciones de diseño',
        'hero_layout_metabox_callback',
        'page',
        'side',
        'high' // Cambiado a prioridad alta
    );
}
add_action('add_meta_boxes', 'hero_layout_metabox');

// Callback para el metabox
function hero_layout_metabox_callback($post) {
    // Solo mostrar si es el template con hero
    $template = get_post_meta($post->ID, '_wp_page_template', true);
    if ($template != 'template-with-hero.php') {
        echo '<p>Este panel solo está disponible con la plantilla "Plantilla con Hero".</p>';
        return;
    }
    
    wp_nonce_field('hero_layout_metabox', 'hero_layout_metabox_nonce');
    $layout = get_post_meta($post->ID, '_hero_layout', true);
    if (empty($layout)) {
        $layout = 'centered'; // Valor por defecto
    }
    ?>
    <p><strong>Diseño de contenido:</strong></p>
    <p>
        <label><input type="radio" name="hero_layout" value="centered" <?php checked($layout, 'centered'); ?>> Contenido centrado</label><br>
        <label><input type="radio" name="hero_layout" value="fullwidth" <?php checked($layout, 'fullwidth'); ?>> Ancho completo</label>
    </p>
    <?php
}

// Guardar datos del metabox
function save_hero_layout_metabox($post_id) {
    // Verificaciones de seguridad
    if (!isset($_POST['hero_layout_metabox_nonce']) || 
        !wp_verify_nonce($_POST['hero_layout_metabox_nonce'], 'hero_layout_metabox') ||
        defined('DOING_AUTOSAVE') && DOING_AUTOSAVE || 
        !current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Guardar la selección
    if (isset($_POST['hero_layout'])) {
        update_post_meta($post_id, '_hero_layout', sanitize_text_field($_POST['hero_layout']));
    }
}
add_action('save_post', 'save_hero_layout_metabox');

function add_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'add_font_awesome');

// Función para agregar Open Graph y Twitter Card tags
function rociodemayo_add_social_meta_tags() {
    global $post;
    
    if (is_singular()) {
        // Obtener información básica de la página
        $title = get_the_title();
        $description = (has_excerpt()) ? get_the_excerpt() : wp_trim_words(get_the_content(), 25, '...');
        $url = get_permalink();
        
        // Imagen destacada o imagen por defecto
        if (has_post_thumbnail()) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            $image_url = $image[0];
        } else {
            // Imagen por defecto - asegúrate de crear esta imagen y subirla
            $image_url = get_template_directory_uri() . '/assets/images/default-share-image.jpg';
        }
        
        // Open Graph tags
        echo '<meta property="og:title" content="' . esc_attr($title) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url($url) . '" />' . "\n";
        echo '<meta property="og:type" content="article" />' . "\n";
        echo '<meta property="og:image" content="' . esc_url($image_url) . '" />' . "\n";
        echo '<meta property="og:image:width" content="1200" />' . "\n";
        echo '<meta property="og:image:height" content="630" />' . "\n";
        echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '" />' . "\n";
        
        // Twitter Card tags
        echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr($title) . '" />' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr($description) . '" />' . "\n";
        echo '<meta name="twitter:image" content="' . esc_url($image_url) . '" />' . "\n";
    } else {
        // Para páginas que no son entradas individuales o páginas (como la home o archivos)
        $title = get_bloginfo('name');
        $description = get_bloginfo('description');
        $url = home_url('/');
        $image_url = get_template_directory_uri() . '/assets/images/default-share-image.jpg';
        
        echo '<meta property="og:title" content="' . esc_attr($title) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url($url) . '" />' . "\n";
        echo '<meta property="og:type" content="website" />' . "\n";
        echo '<meta property="og:image" content="' . esc_url($image_url) . '" />' . "\n";
        echo '<meta property="og:image:width" content="1200" />' . "\n";
        echo '<meta property="og:image:height" content="630" />' . "\n";
        echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '" />' . "\n";
        
        echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr($title) . '" />' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr($description) . '" />' . "\n";
        echo '<meta name="twitter:image" content="' . esc_url($image_url) . '" />' . "\n";
    }
}
add_action('wp_head', 'rociodemayo_add_social_meta_tags', 5);

function rociodemayo_fix_about_page_image() {
    // Verifica si es la página "sobre-nosotros"
    if (is_page('sobre-nosotros') || is_page('Sobre Nosotros') || strpos($_SERVER['REQUEST_URI'], 'sobre-nosotros') !== false) {
        
        // Ruta a una imagen específica para esta página
        $about_image_url = get_template_directory_uri() . '/assets/images/logo2.jpg';
        
        // Si hay una imagen destacada, úsala; si no, usa la imagen específica
        if (has_post_thumbnail()) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            $image_url = $image[0];
        } else {
            $image_url = $about_image_url;
        }
        
        // Asegúrate de que siempre se generen las meta tags para esta página
        echo '<meta property="og:image" content="' . esc_url($image_url) . '" />' . "\n";
        echo '<meta property="og:image:width" content="1200" />' . "\n";
        echo '<meta property="og:image:height" content="630" />' . "\n";
        echo '<meta name="twitter:image" content="' . esc_url($image_url) . '" />' . "\n";
    }
}
add_action('wp_head', 'rociodemayo_fix_about_page_image', 10);

function rociodemayo_facebook_specific_tags() {
    global $post;
    
    if (is_singular()) {
        $url = get_permalink();
        $title = get_the_title();
        $description = (has_excerpt()) ? get_the_excerpt() : wp_trim_words(get_the_content(), 25, '...');
        
        // Imagen destacada o imagen por defecto para Facebook
        if (has_post_thumbnail()) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
            $image_url = $image[0];
        } else {
            $image_url = get_template_directory_uri() . '/assets/images/facebook-share-image.jpg';
        }
        
        // Específico para la página sobre-nosotros
        if (is_page('sobre-nosotros') || strpos($_SERVER['REQUEST_URI'], 'sobre-nosotros') !== false) {
            $image_url = get_template_directory_uri() . '/assets/images/about-facebook-share.jpg';
        }
        
        // Etiquetas específicas para Facebook
        echo '<meta property="og:url" content="' . esc_url($url) . '" />' . "\n";
        echo '<meta property="og:type" content="website" />' . "\n";
        echo '<meta property="og:title" content="' . esc_attr($title) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '" />' . "\n";
        echo '<meta property="og:image" content="' . esc_url($image_url) . '" />' . "\n";
        echo '<meta property="og:image:width" content="1200" />' . "\n";
        echo '<meta property="og:image:height" content="630" />' . "\n";
        echo '<meta property="fb:app_id" content="TU_APP_ID" />' . "\n"; // Si tienes un App ID de Facebook
    }
}
add_action('wp_head', 'rociodemayo_facebook_specific_tags', 1);

function update_font_awesome() {
    wp_deregister_style('font-awesome'); // Desregistra cualquier versión anterior
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'update_font_awesome', 99);