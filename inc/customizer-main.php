<?php
/**
 * Sistema principal de personalización
 * Añadir al archivo inc/customizer-main.php
 */
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/typography-customizer.php'; 
require_once get_template_directory() . '/inc/layout-customizer.php';
require_once get_template_directory() . '/inc/icons-customizer.php'; // Cargar antes que home
require_once get_template_directory() . '/inc/customizer-home.php'; // Cargar después de icons
require_once get_template_directory() . '/inc/mobile-menu-customizer.php';
require_once get_template_directory() . '/inc/footer-customizer.php';
/**
 * Inicializar el sistema de personalización avanzado
 */
function breogan_advanced_customizer_init($wp_customize) {
    // Asegurarse de que exista la sección de configuración general
    if (!$wp_customize->get_section('breogan_general_settings')) {
        $wp_customize->add_section('breogan_general_settings', array(
            'title'    => __('Configuración General', 'breogan-lms-theme'),
            'priority' => 20,
        ));
    }
    
    // Modo oscuro por defecto
    $wp_customize->add_setting('breogan_dark_mode_default', array(
        'default'   => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'breogan_sanitize_checkbox',
    ));
    
    $wp_customize->add_control('breogan_dark_mode_default', array(
        'label'    => __('Modo oscuro por defecto', 'breogan-lms-theme'),
        'section'  => 'breogan_general_settings',
        'type'     => 'checkbox',
        'description' => __('Determina si el sitio se mostrará en modo oscuro por defecto.', 'breogan-lms-theme'),
    ));
    
    // Exportar configuración
    $wp_customize->add_setting('breogan_export_settings', array(
        'default'   => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_export_settings', array(
        'label'       => __('Exportar Configuración', 'breogan-lms-theme'),
        'section'     => 'breogan_general_settings',
        'type'        => 'button',
        'input_attrs' => array(
            'value' => __('Exportar', 'breogan-lms-theme'),
            'class' => 'button button-primary',
        ),
        'description' => __('Exporta la configuración actual para poder importarla en otro sitio.', 'breogan-lms-theme'),
    ));
    
    // Importar configuración
    $wp_customize->add_setting('breogan_import_settings', array(
        'default'   => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_import_settings', array(
        'label'       => __('Importar Configuración', 'breogan-lms-theme'),
        'section'     => 'breogan_general_settings',
        'type'        => 'textarea',
        'description' => __('Pega el código de configuración exportado.', 'breogan-lms-theme'),
    ));
    
    $wp_customize->add_setting('breogan_import_button', array(
        'default'   => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_import_button', array(
        'label'       => __('Aplicar Configuración Importada', 'breogan-lms-theme'),
        'section'     => 'breogan_general_settings',
        'type'        => 'button',
        'input_attrs' => array(
            'value' => __('Importar', 'breogan-lms-theme'),
            'class' => 'button button-primary',
        ),
    ));
    
    // Restablecer valores por defecto
    $wp_customize->add_setting('breogan_reset_settings', array(
        'default'   => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_reset_settings', array(
        'label'       => __('Restablecer Valores por Defecto', 'breogan-lms-theme'),
        'section'     => 'breogan_general_settings',
        'type'        => 'button',
        'input_attrs' => array(
            'value' => __('Restablecer', 'breogan-lms-theme'),
            'class' => 'button button-secondary',
        ),
        'description' => __('¡Advertencia! Esta acción no se puede deshacer. Se restablecerán todos los ajustes a sus valores por defecto.', 'breogan-lms-theme'),
    ));
}
add_action('customize_register', 'breogan_advanced_customizer_init', 999);

// Scripts para exportar/importar ajustes
function breogan_customizer_import_export_scripts() {
    ?>
    <script>
    (function($) {
        // Exportar configuración
        wp.customize.control('breogan_export_settings', function(control) {
            control.container.find('input').on('click', function(e) {
                e.preventDefault();
                
                // Obtener todos los ajustes
                var settings = {};
                wp.customize.control.each(function(control) {
                    var settingId = control.id;
                    if (settingId && wp.customize.has(settingId)) {
                        var setting = wp.customize(settingId);
                        if (setting && setting.get) {
                            settings[settingId] = setting.get();
                        }
                    }
                });
                
                // Convertir a JSON y codificar en base64
                var exportData = btoa(JSON.stringify(settings));
                
                // Mostrar el código para copiar
                alert("Copia este código para importarlo en otro sitio:\n\n" + exportData);
            });
        });
        
        // Importar configuración
        wp.customize.control('breogan_import_button', function(control) {
            control.container.find('input').on('click', function(e) {
                e.preventDefault();
                
                // Obtener el código importado
                var importCode = wp.customize.control('breogan_import_settings').setting.get();
                
                if (!importCode) {
                    alert("Por favor, ingresa un código de configuración válido.");
                    return;
                }
                
                try {
                    // Decodificar Base64 y parsear JSON
                    var importData = JSON.parse(atob(importCode));
                    
                    // Confirmar importación
                    if (confirm("¿Estás seguro de que deseas importar esta configuración? Los ajustes actuales serán reemplazados.")) {
                        // Aplicar los ajustes
                        $.each(importData, function(settingId, value) {
                            if (wp.customize.has(settingId)) {
                                wp.customize(settingId).set(value);
                            }
                        });
                        
                        alert("Configuración importada con éxito. Actualiza la página para ver los cambios.");
                        
                        // Refrescar la página después de un breve retraso
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                } catch (e) {
                    alert("Error al importar la configuración. Por favor, verifica que el código sea válido.");
                    console.error("Error al importar configuración:", e);
                }
            });
        });
        
        // Restablecer valores por defecto
        wp.customize.control('breogan_reset_settings', function(control) {
            control.container.find('input').on('click', function(e) {
                e.preventDefault();
                
                if (confirm("¿Estás seguro de que deseas restablecer todos los ajustes a sus valores por defecto? Esta acción no se puede deshacer.")) {
                    // Restablecer ajustes
                    wp.customize.control.each(function(control) {
                        var settingId = control.id;
                        if (settingId && wp.customize.has(settingId) && control.params.default !== undefined) {
                            wp.customize(settingId).set(control.params.default);
                        }
                    });
                    
                    alert("Todos los ajustes han sido restablecidos a sus valores por defecto. Actualiza la página para ver los cambios.");
                    
                    // Refrescar la página después de un breve retraso
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
            });
        });
    })(jQuery);
    </script>
    <?php

add_action('customize_controls_print_footer_scripts', 'breogan_customizer_import_export_scripts');

// Sanitize checkbox
function breogan_sanitize_checkbox($checked) {
    return (isset($checked) && true === (bool) $checked) ? true : false;
}

// Agregar modo oscuro por defecto
function breogan_apply_dark_mode_default() {
    $dark_mode_default = get_theme_mod('breogan_dark_mode_default', true);
    
    if ($dark_mode_default) {
        ?>
        <script>
        (function() {
            // Si no hay preferencia guardada, establecer modo oscuro por defecto
            if (localStorage.getItem('darkMode') === null) {
                localStorage.setItem('darkMode', 'true');
            }
        })();
        </script>
        <?php
    } else {
        ?>
        <script>
        (function() {
            // Si no hay preferencia guardada, establecer modo claro por defecto
            if (localStorage.getItem('darkMode') === null) {
                localStorage.setItem('darkMode', 'false');
                // Agregar clase de modo claro al body en la carga
                document.body.classList.add('light-mode');
            }
        })();
        </script>
        <?php
    }
}
add_action('wp_head', 'breogan_apply_dark_mode_default', 5);

/**
 * Mostrar panel de ayuda en el Customizer
 */
function breogan_customizer_help_panel($wp_customize) {
    $wp_customize->add_section('breogan_help_section', array(
        'title'    => __('Ayuda y Documentación', 'breogan-lms-theme'),
        'priority' => 999,
    ));
    
    $wp_customize->add_setting('breogan_help_info', array(
        'default'   => '',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'breogan_help_info', array(
        'label'       => __('Guía de Personalización', 'breogan-lms-theme'),
        'description' => '
            <div class="customizer-help-panel">
                <h3>' . __('Bienvenido al Personalizador Avanzado de Breogan LMS', 'breogan-lms-theme') . '</h3>
                <p>' . __('Este panel te permite personalizar completamente el aspecto de tu sitio. A continuación encontrarás información sobre las secciones principales:', 'breogan-lms-theme') . '</p>
                
                <div class="help-section">
                    <h4>' . __('Sistema de Colores', 'breogan-lms-theme') . '</h4>
                    <p>' . __('Personaliza todos los colores del tema, desde los colores principales hasta los específicos para modo oscuro y claro. También puedes elegir paletas predefinidas.', 'breogan-lms-theme') . '</p>
                </div>
                
                <div class="help-section">
                    <h4>' . __('Tipografía', 'breogan-lms-theme') . '</h4>
                    <p>' . __('Selecciona las fuentes para tu sitio, ajusta tamaños, pesos y estilos. Puedes elegir entre numerosas fuentes de Google.', 'breogan-lms-theme') . '</p>
                </div>
                
                <div class="help-section">
                    <h4>' . __('Menú Móvil', 'breogan-lms-theme') . '</h4>
                    <p>' . __('Configura el aspecto y comportamiento del menú en dispositivos móviles. Personaliza el botón hamburguesa, animaciones y colores.', 'breogan-lms-theme') . '</p>
                </div>
                
                <div class="help-section">
                    <h4>' . __('Layout y Estructura', 'breogan-lms-theme') . '</h4>
                    <p>' . __('Ajusta el ancho del contenedor, márgenes, espaciados y la disposición general de los elementos del sitio.', 'breogan-lms-theme') . '</p>
                </div>
                
                <div class="help-section">
                    <h4>' . __('Iconografía', 'breogan-lms-theme') . '</h4>
                    <p>' . __('Elige entre diferentes bibliotecas de iconos y personaliza su aspecto. Puedes seleccionar iconos específicos para diferentes elementos del sitio.', 'breogan-lms-theme') . '</p>
                </div>
                
                <div class="help-section">
                    <h4>' . __('Exportar/Importar', 'breogan-lms-theme') . '</h4>
                    <p>' . __('Puedes guardar tu configuración y aplicarla en otros sitios utilizando las opciones de exportar/importar en la sección "Configuración General".', 'breogan-lms-theme') . '</p>
                </div>
                
                <div class="help-contact">
                    <h4>' . __('¿Necesitas ayuda?', 'breogan-lms-theme') . '</h4>
                    <p>' . __('Si tienes alguna pregunta o necesitas asistencia, puedes contactar con nuestro equipo de soporte:', 'breogan-lms-theme') . '</p>
                    <a href="mailto:soporte@breogan-lms.com" class="button button-primary">' . __('Contactar Soporte', 'breogan-lms-theme') . '</a>
                </div>
            </div>
        ',
        'section'     => 'breogan_help_section',
        'type'        => 'hidden',
    )));
    
    // Añadir estilos para el panel de ayuda
    wp_add_inline_style('customize-controls', "
        .customizer-help-panel {
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .customizer-help-panel h3 {
            margin-top: 0;
            color: #0073aa;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        
        .help-section {
            margin-bottom: 20px;
        }
        
        .help-section h4 {
            margin-bottom: 5px;
            color: #23282d;
        }
        
        .help-contact {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-top: 30px;
        }
    ");
}
add_action('customize_register', 'breogan_customizer_help_panel');

/**
 * Añadir Información de Versión del Tema
 */
function breogan_theme_version_info($wp_customize) {
    $theme = wp_get_theme();
    $version = $theme->get('Version');
    
    $wp_customize->add_setting('breogan_theme_version', array(
        'default'   => '',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'breogan_theme_version', array(
        'label'       => __('Información del Tema', 'breogan-lms-theme'),
        'description' => sprintf(
            __('Versión actual: %s', 'breogan-lms-theme'),
            '<strong>' . $version . '</strong>'
        ),
        'section'     => 'breogan_help_section',
        'type'        => 'hidden',
    )));
}
add_action('customize_register', 'breogan_theme_version_info');

/**
 * Añadir botón para ver la documentación completa
 */
function breogan_documentation_button($wp_customize) {
    $wp_customize->add_setting('breogan_documentation_link', array(
        'default'   => '',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'breogan_documentation_link', array(
        'label'       => __('Documentación Completa', 'breogan-lms-theme'),
        'description' => __('Consulta nuestra documentación completa para aprovechar al máximo todas las funcionalidades del tema.', 'breogan-lms-theme'),
        'section'     => 'breogan_help_section',
        'type'        => 'button',
        'input_attrs' => array(
            'value' => __('Ver Documentación', 'breogan-lms-theme'),
            'class' => 'button button-primary',
            'onclick' => 'window.open("https://breogan-lms.com/documentacion", "_blank")',
        ),
    )));
}
add_action('customize_register', 'breogan_documentation_button');
}

/**
 * Personalizar opciones del blog
 */
function breogan_blog_customizer($wp_customize) {
    // Sección para opciones del blog
    $wp_customize->add_section('breogan_blog_settings', array(
        'title'    => __('Configuración del Blog', 'breogan-lms-theme'),
        'priority' => 80,
    ));
    
    // Mostrar sección de blog en la página de inicio
    $wp_customize->add_setting('breogan_home_blog_enable', array(
        'default'   => true,
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_home_blog_enable', array(
        'label'    => __('Mostrar sección de blog en la página de inicio', 'breogan-lms-theme'),
        'section'  => 'breogan_blog_settings',
        'type'     => 'checkbox',
    ));
    
    // Título de la sección de blog en la página de inicio
    $wp_customize->add_setting('breogan_home_blog_title', array(
        'default'   => __('Últimas del Blog', 'breogan-lms-theme'),
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_home_blog_title', array(
        'label'    => __('Título de la sección de blog', 'breogan-lms-theme'),
        'section'  => 'breogan_blog_settings',
        'type'     => 'text',
        'active_callback' => function() {
            return get_theme_mod('breogan_home_blog_enable', true);
        },
    ));
    
    // Descripción de la sección de blog en la página de inicio
    $wp_customize->add_setting('breogan_home_blog_description', array(
        'default'   => __('Explora nuestros artículos más recientes y mantente informado.', 'breogan-lms-theme'),
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_home_blog_description', array(
        'label'    => __('Descripción de la sección de blog', 'breogan-lms-theme'),
        'section'  => 'breogan_blog_settings',
        'type'     => 'textarea',
        'active_callback' => function() {
            return get_theme_mod('breogan_home_blog_enable', true);
        },
    ));
    
    // Número de posts en la página de inicio
    $wp_customize->add_setting('breogan_home_blog_count', array(
        'default'   => 3,
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_home_blog_count', array(
        'label'    => __('Número de posts en la página de inicio', 'breogan-lms-theme'),
        'section'  => 'breogan_blog_settings',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 6,
            'step' => 1,
        ),
        'active_callback' => function() {
            return get_theme_mod('breogan_home_blog_enable', true);
        },
    ));
    
    // Mostrar fecha
    $wp_customize->add_setting('breogan_blog_show_date', array(
        'default'   => true,
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_blog_show_date', array(
        'label'    => __('Mostrar fecha en los posts', 'breogan-lms-theme'),
        'section'  => 'breogan_blog_settings',
        'type'     => 'checkbox',
    ));
    
    // Mostrar autor
    $wp_customize->add_setting('breogan_blog_show_author', array(
        'default'   => true,
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_blog_show_author', array(
        'label'    => __('Mostrar autor en los posts', 'breogan-lms-theme'),
        'section'  => 'breogan_blog_settings',
        'type'     => 'checkbox',
    ));
    
    // Mostrar categorías
    $wp_customize->add_setting('breogan_blog_show_categories', array(
        'default'   => true,
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_blog_show_categories', array(
        'label'    => __('Mostrar categorías en los posts', 'breogan-lms-theme'),
        'section'  => 'breogan_blog_settings',
        'type'     => 'checkbox',
    ));
    
    // Mostrar etiquetas
    $wp_customize->add_setting('breogan_blog_show_tags', array(
        'default'   => true,
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_blog_show_tags', array(
        'label'    => __('Mostrar etiquetas en los posts', 'breogan-lms-theme'),
        'section'  => 'breogan_blog_settings',
        'type'     => 'checkbox',
    ));
    
    // Longitud del extracto
    $wp_customize->add_setting('breogan_excerpt_length', array(
        'default'   => 30,
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_excerpt_length', array(
        'label'    => __('Longitud del extracto (palabras)', 'breogan-lms-theme'),
        'section'  => 'breogan_blog_settings',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 10,
            'max'  => 100,
            'step' => 5,
        ),
    ));
    
    // Texto del botón "Leer más"
    $wp_customize->add_setting('breogan_read_more_text', array(
        'default'   => __('Leer más', 'breogan-lms-theme'),
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_read_more_text', array(
        'label'    => __('Texto del botón "Leer más"', 'breogan-lms-theme'),
        'section'  => 'breogan_blog_settings',
        'type'     => 'text',
    ));
    
    // Layout del blog
    $wp_customize->add_setting('breogan_blog_layout', array(
        'default'   => 'grid',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_blog_layout', array(
        'label'    => __('Layout del blog', 'breogan-lms-theme'),
        'section'  => 'breogan_blog_settings',
        'type'     => 'select',
        'choices'  => array(
            'grid'    => __('Cuadrícula', 'breogan-lms-theme'),
            'list'    => __('Lista', 'breogan-lms-theme'),
            'masonry' => __('Masonry', 'breogan-lms-theme'),
        ),
    ));
    
    // Columnas en la vista de cuadrícula
    $wp_customize->add_setting('breogan_blog_columns', array(
        'default'   => 2,
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_blog_columns', array(
        'label'    => __('Columnas (vista de cuadrícula)', 'breogan-lms-theme'),
        'section'  => 'breogan_blog_settings',
        'type'     => 'select',
        'choices'  => array(
            1 => '1',
            2 => '2',
            3 => '3',
        ),
        'active_callback' => function() {
            return get_theme_mod('breogan_blog_layout', 'grid') === 'grid';
        },
    ));
    
    // Banner del blog
    $wp_customize->add_setting('breogan_blog_banner_title', array(
        'default'   => __('Nuestro Blog', 'breogan-lms-theme'),
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_blog_banner_title', array(
        'label'    => __('Título del banner del blog', 'breogan-lms-theme'),
        'section'  => 'breogan_blog_settings',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('breogan_blog_banner_description', array(
        'default'   => __('Explora nuestros artículos más recientes y mantente al día con las últimas noticias, tutoriales y recursos.', 'breogan-lms-theme'),
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_blog_banner_description', array(
        'label'    => __('Descripción del banner del blog', 'breogan-lms-theme'),
        'section'  => 'breogan_blog_settings',
        'type'     => 'textarea',
    ));
    
    // Imagen de fondo del banner del blog
    $wp_customize->add_setting('breogan_blog_banner_image', array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'breogan_blog_banner_image', array(
        'label'    => __('Imagen de fondo del banner del blog', 'breogan-lms-theme'),
        'section'  => 'breogan_blog_settings',
        'settings' => 'breogan_blog_banner_image',
    )));
}
add_action('customize_register', 'breogan_blog_customizer');

/**
 * Aplicar la longitud personalizada del extracto
 */
function breogan_custom_excerpt_length_from_theme_mod($length) {
    return get_theme_mod('breogan_excerpt_length', 30);
}
add_filter('excerpt_length', 'breogan_custom_excerpt_length_from_theme_mod', 999);

/**
 * Aplicar el texto personalizado del "leer más"
 */
function breogan_custom_read_more_text($more) {
    return '...';
}
add_filter('excerpt_more', 'breogan_custom_read_more_text');