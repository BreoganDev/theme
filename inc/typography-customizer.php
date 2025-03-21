<?php
function breogan_google_fonts_array() {
    return array(
        'default' => 'Fuente predeterminada del sistema',
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
}

// Añadir opciones de fuente
if (!function_exists('breogan_typography_customizer')) {
    function breogan_typography_customizer($wp_customize) {
    // Panel de tipografía
    $wp_customize->add_panel('breogan_typography_panel', array(
        'title'       => __('Tipografía', 'breogan-lms-theme'),
        'priority'    => 40,
        'description' => __('Personaliza las fuentes, tamaños y estilos de texto.', 'breogan-lms-theme'),
    ));
    
    // Sección: Fuentes principales
    $wp_customize->add_section('breogan_main_fonts', array(
        'title'    => __('Fuentes Principales', 'breogan-lms-theme'),
        'panel'    => 'breogan_typography_panel',
        'priority' => 10,
    ));
    
    // Fuente principal
    $wp_customize->add_setting('breogan_main_font', array(
        'default'   => 'Poppins',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_main_font', array(
        'label'    => __('Fuente Principal', 'breogan-lms-theme'),
        'section'  => 'breogan_main_fonts',
        'type'     => 'select',
        'choices'  => breogan_google_fonts_array(),
        'description' => __('Se usa para texto general y contenido.', 'breogan-lms-theme'),
    ));
    
    // Fuente de títulos
    $wp_customize->add_setting('breogan_heading_font', array(
        'default'   => 'Poppins',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_heading_font', array(
        'label'    => __('Fuente de Títulos', 'breogan-lms-theme'),
        'section'  => 'breogan_main_fonts',
        'type'     => 'select',
        'choices'  => breogan_google_fonts_array(),
        'description' => __('Se usa para encabezados (h1, h2, h3, etc).', 'breogan-lms-theme'),
    ));
    
    // Muestra de fuentes
    $wp_customize->add_setting('breogan_font_preview', array(
        'default'   => '',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'breogan_font_preview', array(
        'label'       => __('Vista previa de fuente', 'breogan-lms-theme'),
        'section'     => 'breogan_main_fonts',
        'description' => '<div class="font-preview-container">
            <p class="font-preview-heading">Este es un ejemplo de encabezado</p>
            <p class="font-preview-text">Este es un ejemplo de texto con la fuente seleccionada. Puedes ver cómo se verá el contenido en tu sitio web.</p>
        </div>',
        'type'        => 'hidden',
    )));
    
    // Peso de fuente principal
    $wp_customize->add_setting('breogan_main_font_weight', array(
        'default'   => '400',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_main_font_weight', array(
        'label'    => __('Peso de Fuente Principal', 'breogan-lms-theme'),
        'section'  => 'breogan_main_fonts',
        'type'     => 'select',
        'choices'  => array(
            '300' => __('Ligero (300)', 'breogan-lms-theme'),
            '400' => __('Normal (400)', 'breogan-lms-theme'),
            '500' => __('Medio (500)', 'breogan-lms-theme'),
            '600' => __('Semi-Negrita (600)', 'breogan-lms-theme'),
            '700' => __('Negrita (700)', 'breogan-lms-theme'),
        ),
    ));
    
    // Peso de fuente para títulos
    $wp_customize->add_setting('breogan_heading_font_weight', array(
        'default'   => '600',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_heading_font_weight', array(
        'label'    => __('Peso de Fuente para Títulos', 'breogan-lms-theme'),
        'section'  => 'breogan_main_fonts',
        'type'     => 'select',
        'choices'  => array(
            '400' => __('Normal (400)', 'breogan-lms-theme'),
            '500' => __('Medio (500)', 'breogan-lms-theme'),
            '600' => __('Semi-Negrita (600)', 'breogan-lms-theme'),
            '700' => __('Negrita (700)', 'breogan-lms-theme'),
            '800' => __('Extra-Negrita (800)', 'breogan-lms-theme'),
        ),
    ));
    
    // Sección: Tamaños de texto
    $wp_customize->add_section('breogan_text_sizes', array(
        'title'    => __('Tamaños de Texto', 'breogan-lms-theme'),
        'panel'    => 'breogan_typography_panel',
        'priority' => 20,
    ));
    
    // Tamaño base de texto
    $wp_customize->add_setting('breogan_base_font_size', array(
        'default'   => '16',
        'transport' => 'postMessage',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('breogan_base_font_size', array(
        'label'    => __('Tamaño Base de Texto (px)', 'breogan-lms-theme'),
        'section'  => 'breogan_text_sizes',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 12,
            'max'  => 24,
            'step' => 1,
        ),
        'description' => __('Tamaño base para texto normal. Todos los demás tamaños se escalan proporcionalmente.', 'breogan-lms-theme'),
    ));
    
    // Tamaño de H1
    $wp_customize->add_setting('breogan_h1_size', array(
        'default'   => '2.5',
        'transport' => 'postMessage',
        'sanitize_callback' => 'breogan_sanitize_float',
    ));
    
    $wp_customize->add_control('breogan_h1_size', array(
        'label'    => __('Tamaño de H1 (em)', 'breogan-lms-theme'),
        'section'  => 'breogan_text_sizes',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 1.5,
            'max'  => 4,
            'step' => 0.1,
        ),
    ));
    
    // Tamaño de H2
    $wp_customize->add_setting('breogan_h2_size', array(
        'default'   => '2.0',
        'transport' => 'postMessage',
        'sanitize_callback' => 'breogan_sanitize_float',
    ));
    
    $wp_customize->add_control('breogan_h2_size', array(
        'label'    => __('Tamaño de H2 (em)', 'breogan-lms-theme'),
        'section'  => 'breogan_text_sizes',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 1.2,
            'max'  => 3.5,
            'step' => 0.1,
        ),
    ));
    
    // Tamaño de H3
    $wp_customize->add_setting('breogan_h3_size', array(
        'default'   => '1.5',
        'transport' => 'postMessage',
        'sanitize_callback' => 'breogan_sanitize_float',
    ));
    
    $wp_customize->add_control('breogan_h3_size', array(
        'label'    => __('Tamaño de H3 (em)', 'breogan-lms-theme'),
        'section'  => 'breogan_text_sizes',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 1.0,
            'max'  => 3.0,
            'step' => 0.1,
        ),
    ));
    
    // Sección: Estilos adicionales de texto
    $wp_customize->add_section('breogan_text_styles', array(
        'title'    => __('Estilos de Texto', 'breogan-lms-theme'),
        'panel'    => 'breogan_typography_panel',
        'priority' => 30,
    ));
    
    // Altura de línea
    $wp_customize->add_setting('breogan_line_height', array(
        'default'   => '1.6',
        'transport' => 'postMessage',
        'sanitize_callback' => 'breogan_sanitize_float',
    ));
    
    $wp_customize->add_control('breogan_line_height', array(
        'label'    => __('Altura de Línea', 'breogan-lms-theme'),
        'section'  => 'breogan_text_styles',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 1.0,
            'max'  => 2.5,
            'step' => 0.1,
        ),
    ));
    
    // Espaciado de letra
    $wp_customize->add_setting('breogan_letter_spacing', array(
        'default'   => '0',
        'transport' => 'postMessage',
        'sanitize_callback' => 'breogan_sanitize_float',
    ));
    
    $wp_customize->add_control('breogan_letter_spacing', array(
        'label'    => __('Espaciado de Letra (px)', 'breogan-lms-theme'),
        'section'  => 'breogan_text_styles',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => -2,
            'max'  => 5,
            'step' => 0.1,
        ),
    ));
    
    // Transformación de texto títulos
    $wp_customize->add_setting('breogan_heading_transform', array(
        'default'   => 'none',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_heading_transform', array(
        'label'    => __('Transformación de Texto (Títulos)', 'breogan-lms-theme'),
        'section'  => 'breogan_text_styles',
        'type'     => 'select',
        'choices'  => array(
            'none'       => __('Normal', 'breogan-lms-theme'),
            'uppercase'  => __('MAYÚSCULAS', 'breogan-lms-theme'),
            'lowercase'  => __('minúsculas', 'breogan-lms-theme'),
            'capitalize' => __('Capitalizado', 'breogan-lms-theme'),
        ),
    ));
    
    // Personalización específica de títulos de sección
    $wp_customize->add_setting('breogan_section_title_style', array(
        'default'   => 'normal',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('breogan_section_title_style', array(
        'label'    => __('Estilo de Títulos de Sección', 'breogan-lms-theme'),
        'section'  => 'breogan_text_styles',
        'type'     => 'select',
        'choices'  => array(
            'normal'     => __('Normal', 'breogan-lms-theme'),
            'underline'  => __('Subrayado', 'breogan-lms-theme'),
            'overline'   => __('Línea superior', 'breogan-lms-theme'),
            'bordered'   => __('Con bordes', 'breogan-lms-theme'),
            'highlight'  => __('Resaltado', 'breogan-lms-theme'),
        ),
    ));
}
}