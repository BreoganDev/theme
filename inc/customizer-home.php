<?php
/**
 * Funciones para el personalizador avanzado
 * Añade este código en un archivo separado (por ejemplo, inc/customizer-home.php)
 * Y luego inclúyelo desde functions.php con: require_once get_template_directory() . '/inc/customizer-home.php';
 */

// Función principal para registrar todas las opciones del personalizador
function breogan_home_customizer_register($wp_customize) {
    // Ya tienes la sección Hero, ahora vamos a añadir más opciones a ella
    
    // ====================================
    // HERO SECTION - BOTONES
    // ====================================
    
    // Botón 1 - Texto
    $wp_customize->add_setting('breogan_hero_btn1_text', array(
        'default'   => 'Get Started',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_hero_btn1_text', array(
        'label'    => __('Texto del botón principal', 'breogan-lms-theme'),
        'section'  => 'breogan_hero_settings',
        'type'     => 'text',
    ));
    
    // Botón 1 - URL
    $wp_customize->add_setting('breogan_hero_btn1_url', array(
        'default'   => '#',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_hero_btn1_url', array(
        'label'    => __('URL del botón principal', 'breogan-lms-theme'),
        'section'  => 'breogan_hero_settings',
        'type'     => 'url',
    ));
    
    // Botón 2 - Texto
    $wp_customize->add_setting('breogan_hero_btn2_text', array(
        'default'   => 'Learn More',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_hero_btn2_text', array(
        'label'    => __('Texto del botón secundario', 'breogan-lms-theme'),
        'section'  => 'breogan_hero_settings',
        'type'     => 'text',
    ));
    
    // Botón 2 - URL
    $wp_customize->add_setting('breogan_hero_btn2_url', array(
        'default'   => '#',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_hero_btn2_url', array(
        'label'    => __('URL del botón secundario', 'breogan-lms-theme'),
        'section'  => 'breogan_hero_settings',
        'type'     => 'url',
    ));
    
    // ====================================
    // STATS SECTION (TARJETAS DE ESTADÍSTICAS)
    // ====================================
    
    $wp_customize->add_section('breogan_stats_settings', array(
        'title'    => __('Sección de Estadísticas', 'breogan-lms-theme'),
        'priority' => 50,
    ));
    
    // Mostrar/ocultar sección
    $wp_customize->add_setting('breogan_stats_enable', array(
        'default'   => true,
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_stats_enable', array(
        'label'    => __('Mostrar sección de estadísticas', 'breogan-lms-theme'),
        'section'  => 'breogan_stats_settings',
        'type'     => 'checkbox',
    ));
    
    // Estadística 1
    $wp_customize->add_setting('breogan_stat1_number', array(
        'default'   => '03',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_stat1_number', array(
        'label'    => __('Estadística 1 - Número', 'breogan-lms-theme'),
        'section'  => 'breogan_stats_settings',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('breogan_stat1_label', array(
        'default'   => 'Years Experience',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_stat1_label', array(
        'label'    => __('Estadística 1 - Etiqueta', 'breogan-lms-theme'),
        'section'  => 'breogan_stats_settings',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('breogan_stat1_icon', array(
        'default'   => 'fas fa-users',
        'transport' => 'refresh',
    ));
    
   // Reemplazar en customizer-home.php
$wp_customize->add_control('breogan_stat1_icon', array(
    'label'    => __('Estadística 1 - Icono (clase Font Awesome)', 'breogan-lms-theme'),
    'section'  => 'breogan_stats_settings',
    'type'     => 'text',
    'priority' => 15, // Añadir prioridad
    'description' => __('Ejemplo: fas fa-users, fas fa-chart-line, etc.', 'breogan-lms-theme'),
));
    
    // Estadística 2
    $wp_customize->add_setting('breogan_stat2_number', array(
        'default'   => '87',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_stat2_number', array(
        'label'    => __('Estadística 2 - Número', 'breogan-lms-theme'),
        'section'  => 'breogan_stats_settings',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('breogan_stat2_label', array(
        'default'   => 'Total Courses',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_stat2_label', array(
        'label'    => __('Estadística 2 - Etiqueta', 'breogan-lms-theme'),
        'section'  => 'breogan_stats_settings',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('breogan_stat2_icon', array(
        'default'   => 'fas fa-graduation-cap',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_stat2_icon', array(
        'label'    => __('Estadística 2 - Icono (clase Font Awesome)', 'breogan-lms-theme'),
        'section'  => 'breogan_stats_settings',
        'type'     => 'text',
    ));
    
    // Estadística 3
    $wp_customize->add_setting('breogan_stat3_number', array(
        'default'   => '443',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_stat3_number', array(
        'label'    => __('Estadística 3 - Número', 'breogan-lms-theme'),
        'section'  => 'breogan_stats_settings',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('breogan_stat3_label', array(
        'default'   => 'Certified Students',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_stat3_label', array(
        'label'    => __('Estadística 3 - Etiqueta', 'breogan-lms-theme'),
        'section'  => 'breogan_stats_settings',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('breogan_stat3_icon', array(
        'default'   => 'fas fa-certificate',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_stat3_icon', array(
        'label'    => __('Estadística 3 - Icono (clase Font Awesome)', 'breogan-lms-theme'),
        'section'  => 'breogan_stats_settings',
        'type'     => 'text',
    ));
    
    // ====================================
    // FEATURE ITEMS (CARACTERÍSTICAS)
    // ====================================
    
    $wp_customize->add_section('breogan_features_settings', array(
        'title'    => __('Sección de Características', 'breogan-lms-theme'),
        'priority' => 60,
    ));
    
    // Mostrar/ocultar sección
    $wp_customize->add_setting('breogan_features_enable', array(
        'default'   => true,
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_features_enable', array(
        'label'    => __('Mostrar sección de características', 'breogan-lms-theme'),
        'section'  => 'breogan_features_settings',
        'type'     => 'checkbox',
    ));
    
    // Característica 1
    $wp_customize->add_setting('breogan_feature1_title', array(
        'default'   => 'Marketing Strategies',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_feature1_title', array(
        'label'    => __('Característica 1 - Título', 'breogan-lms-theme'),
        'section'  => 'breogan_features_settings',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('breogan_feature1_description', array(
        'default'   => 'Learn effective marketing strategies to promote your online courses and reach more students.',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_feature1_description', array(
        'label'    => __('Característica 1 - Descripción', 'breogan-lms-theme'),
        'section'  => 'breogan_features_settings',
        'type'     => 'textarea',
    ));
    
    $wp_customize->add_setting('breogan_feature1_icon', array(
        'default'   => 'fas fa-bullseye',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_feature1_icon', array(
        'label'    => __('Característica 1 - Icono (clase Font Awesome)', 'breogan-lms-theme'),
        'section'  => 'breogan_features_settings',
        'type'     => 'text',
    ));
    
    // Característica 2
    $wp_customize->add_setting('breogan_feature2_title', array(
        'default'   => 'Growth Techniques',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_feature2_title', array(
        'label'    => __('Característica 2 - Título', 'breogan-lms-theme'),
        'section'  => 'breogan_features_settings',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('breogan_feature2_description', array(
        'default'   => 'Discover proven growth techniques to scale your online course business effectively.',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_feature2_description', array(
        'label'    => __('Característica 2 - Descripción', 'breogan-lms-theme'),
        'section'  => 'breogan_features_settings',
        'type'     => 'textarea',
    ));
    
    $wp_customize->add_setting('breogan_feature2_icon', array(
        'default'   => 'fas fa-chart-line',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_feature2_icon', array(
        'label'    => __('Característica 2 - Icono (clase Font Awesome)', 'breogan-lms-theme'),
        'section'  => 'breogan_features_settings',
        'type'     => 'text',
    ));
    
    // Característica 3
    $wp_customize->add_setting('breogan_feature3_title', array(
        'default'   => 'Community Building',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_feature3_title', array(
        'label'    => __('Característica 3 - Título', 'breogan-lms-theme'),
        'section'  => 'breogan_features_settings',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('breogan_feature3_description', array(
        'default'   => 'Build an engaged community around your courses to increase retention and referrals.',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_feature3_description', array(
        'label'    => __('Característica 3 - Descripción', 'breogan-lms-theme'),
        'section'  => 'breogan_features_settings',
        'type'     => 'textarea',
    ));
    
    $wp_customize->add_setting('breogan_feature3_icon', array(
        'default'   => 'fas fa-comments',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_feature3_icon', array(
        'label'    => __('Característica 3 - Icono (clase Font Awesome)', 'breogan-lms-theme'),
        'section'  => 'breogan_features_settings',
        'type'     => 'text',
    ));
    
    // ====================================
    // COURSES SECTION (CURSOS)
    // ====================================
    
    $wp_customize->add_section('breogan_courses_settings', array(
        'title'    => __('Sección de Cursos', 'breogan-lms-theme'),
        'priority' => 70,
    ));
    
    // Mostrar/ocultar sección
    $wp_customize->add_setting('breogan_courses_enable', array(
        'default'   => true,
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_courses_enable', array(
        'label'    => __('Mostrar sección de cursos', 'breogan-lms-theme'),
        'section'  => 'breogan_courses_settings',
        'type'     => 'checkbox',
    ));
    
    // Título de la sección
    $wp_customize->add_setting('breogan_courses_title', array(
        'default'   => 'Top Courses',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_courses_title', array(
        'label'    => __('Título de la sección', 'breogan-lms-theme'),
        'section'  => 'breogan_courses_settings',
        'type'     => 'text',
    ));
    
    // Descripción de la sección
    $wp_customize->add_setting('breogan_courses_description', array(
        'default'   => 'Browse our most popular online courses with experienced instructors.',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_courses_description', array(
        'label'    => __('Descripción de la sección', 'breogan-lms-theme'),
        'section'  => 'breogan_courses_settings',
        'type'     => 'textarea',
    ));
    
    // Origen de los cursos
    $wp_customize->add_setting('breogan_courses_source', array(
        'default'   => 'custom',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_courses_source', array(
        'label'    => __('Origen de los cursos', 'breogan-lms-theme'),
        'section'  => 'breogan_courses_settings',
        'type'     => 'radio',
        'choices'  => array(
            'custom' => __('Cursos personalizados', 'breogan-lms-theme'),
            'cpt'    => __('Cursos del CPT (Custom Post Type)', 'breogan-lms-theme'),
        ),
    ));
    
    // Cantidad de cursos a mostrar (si son del CPT)
    $wp_customize->add_setting('breogan_courses_count', array(
        'default'   => 5,
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_courses_count', array(
        'label'    => __('Cantidad de cursos a mostrar', 'breogan-lms-theme'),
        'section'  => 'breogan_courses_settings',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 10,
            'step' => 1,
        ),
        'active_callback' => function() {
            return get_theme_mod('breogan_courses_source', 'custom') === 'cpt';
        },
    ));
    
    // Tipo de ordenación de cursos (si son del CPT)
    $wp_customize->add_setting('breogan_courses_orderby', array(
        'default'   => 'date',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_courses_orderby', array(
        'label'    => __('Ordenar cursos por', 'breogan-lms-theme'),
        'section'  => 'breogan_courses_settings',
        'type'     => 'select',
        'choices'  => array(
            'date'     => __('Fecha de publicación', 'breogan-lms-theme'),
            'title'    => __('Título', 'breogan-lms-theme'),
            'rand'     => __('Aleatorio', 'breogan-lms-theme'),
            'featured' => __('Destacados primero', 'breogan-lms-theme'),
        ),
        'active_callback' => function() {
            return get_theme_mod('breogan_courses_source', 'custom') === 'cpt';
        },
    ));
    
    // CURSOS PERSONALIZADOS (Si elige "custom")
    // Este es un enfoque simplificado. Para una solución completa,
    // tendríamos que implementar un panel de control personalizado
    // que permitiera añadir/eliminar cursos dinámicamente.
    
    // Curso 1
    $wp_customize->add_setting('breogan_custom_course1_title', array(
        'default'   => 'Recursos Financieros',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_custom_course1_title', array(
        'label'    => __('Curso 1 - Título', 'breogan-lms-theme'),
        'section'  => 'breogan_courses_settings',
        'type'     => 'text',
        'active_callback' => function() {
            return get_theme_mod('breogan_courses_source', 'custom') === 'custom';
        },
    ));
    
    $wp_customize->add_setting('breogan_custom_course1_category', array(
        'default'   => 'Negocio',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_custom_course1_category', array(
        'label'    => __('Curso 1 - Categoría', 'breogan-lms-theme'),
        'section'  => 'breogan_courses_settings',
        'type'     => 'text',
        'active_callback' => function() {
            return get_theme_mod('breogan_courses_source', 'custom') === 'custom';
        },
    ));
    
    $wp_customize->add_setting('breogan_custom_course1_instructor', array(
        'default'   => 'María R.',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_custom_course1_instructor', array(
        'label'    => __('Curso 1 - Instructor', 'breogan-lms-theme'),
        'section'  => 'breogan_courses_settings',
        'type'     => 'text',
        'active_callback' => function() {
            return get_theme_mod('breogan_courses_source', 'custom') === 'custom';
        },
    ));
    
    $wp_customize->add_setting('breogan_custom_course1_price', array(
        'default'   => '97',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_custom_course1_price', array(
        'label'    => __('Curso 1 - Precio', 'breogan-lms-theme'),
        'section'  => 'breogan_courses_settings',
        'type'     => 'text',
        'active_callback' => function() {
            return get_theme_mod('breogan_courses_source', 'custom') === 'custom';
        },
    ));
    
    // Imagen del curso 1
    $wp_customize->add_setting('breogan_custom_course1_image', array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'breogan_custom_course1_image', array(
        'label'    => __('Curso 1 - Imagen', 'breogan-lms-theme'),
        'section'  => 'breogan_courses_settings',
        'settings' => 'breogan_custom_course1_image',
        'active_callback' => function() {
            return get_theme_mod('breogan_courses_source', 'custom') === 'custom';
        },
    )));
    
    // Curso 2
    $wp_customize->add_setting('breogan_custom_course2_title', array(
        'default'   => 'Fundamentos Del Marketing Digital',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_custom_course2_title', array(
        'label'    => __('Curso 2 - Título', 'breogan-lms-theme'),
        'section'  => 'breogan_courses_settings',
        'type'     => 'text',
        'active_callback' => function() {
            return get_theme_mod('breogan_courses_source', 'custom') === 'custom';
        },
    ));
    
    $wp_customize->add_setting('breogan_custom_course2_category', array(
        'default'   => 'Marketing',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_custom_course2_category', array(
        'label'    => __('Curso 2 - Categoría', 'breogan-lms-theme'),
        'section'  => 'breogan_courses_settings',
        'type'     => 'text',
        'active_callback' => function() {
            return get_theme_mod('breogan_courses_source', 'custom') === 'custom';
        },
    ));
    
    $wp_customize->add_setting('breogan_custom_course2_instructor', array(
        'default'   => 'José M.',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_custom_course2_instructor', array(
        'label'    => __('Curso 2 - Instructor', 'breogan-lms-theme'),
        'section'  => 'breogan_courses_settings',
        'type'     => 'text',
        'active_callback' => function() {
            return get_theme_mod('breogan_courses_source', 'custom') === 'custom';
        },
    ));
    
    $wp_customize->add_setting('breogan_custom_course2_price', array(
        'default'   => '89',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('breogan_custom_course2_price', array(
        'label'    => __('Curso 2 - Precio', 'breogan-lms-theme'),
        'section'  => 'breogan_courses_settings',
        'type'     => 'text',
        'active_callback' => function() {
            return get_theme_mod('breogan_courses_source', 'custom') === 'custom';
        },
    ));
    
    // Imagen del curso 2
    $wp_customize->add_setting('breogan_custom_course2_image', array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'breogan_custom_course2_image', array(
        'label'    => __('Curso 2 - Imagen', 'breogan-lms-theme'),
        'section'  => 'breogan_courses_settings',
        'settings' => 'breogan_custom_course2_image',
        'active_callback' => function() {
            return get_theme_mod('breogan_courses_source', 'custom') === 'custom';
        },
    )));
    
    // Se podrían agregar más cursos (3, 4, 5...) siguiendo este patrón
    
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
    ));
    
    $wp_customize->add_control('breogan_footer_credits', array(
        'label'    => __('Créditos del footer', 'breogan-lms-theme'),
        'section'  => 'breogan_footer_settings',
        'type'     => 'textarea',
        'description' => __('Puedes usar HTML para iconos, por ejemplo: &lt;i class="fas fa-heart"&gt;&lt;/i&gt;', 'breogan-lms-theme'),
    ));
}
add_action('customize_register', 'breogan_home_customizer_register', 20);