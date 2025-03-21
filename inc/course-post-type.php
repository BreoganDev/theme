<?php
/**
 * Registro del Custom Post Type de Cursos
 */

function breogan_lms_register_course_post_type() {
    $labels = array(
        'name'               => _x('Cursos', 'post type general name', 'breogan-lms-theme'),
        'singular_name'      => _x('Curso', 'post type singular name', 'breogan-lms-theme'),
        'menu_name'          => _x('Cursos', 'admin menu', 'breogan-lms-theme'),
        'name_admin_bar'     => _x('Curso', 'add new on admin bar', 'breogan-lms-theme'),
        'add_new'            => _x('Añadir nuevo', 'curso', 'breogan-lms-theme'),
        'add_new_item'       => __('Añadir nuevo curso', 'breogan-lms-theme'),
        'new_item'           => __('Nuevo curso', 'breogan-lms-theme'),
        'edit_item'          => __('Editar curso', 'breogan-lms-theme'),
        'view_item'          => __('Ver curso', 'breogan-lms-theme'),
        'all_items'          => __('Todos los cursos', 'breogan-lms-theme'),
        'search_items'       => __('Buscar cursos', 'breogan-lms-theme'),
        'parent_item_colon'  => __('Cursos padre:', 'breogan-lms-theme'),
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
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
    );

    register_post_type('curso', $args);
    
    // Taxonomía Categoría de Curso
    $category_labels = array(
        'name'              => _x('Categorías de Curso', 'taxonomy general name', 'breogan-lms-theme'),
        'singular_name'     => _x('Categoría de Curso', 'taxonomy singular name', 'breogan-lms-theme'),
        'search_items'      => __('Buscar Categorías', 'breogan-lms-theme'),
        'all_items'         => __('Todas las Categorías', 'breogan-lms-theme'),
        'parent_item'       => __('Categoría Padre', 'breogan-lms-theme'),
        'parent_item_colon' => __('Categoría Padre:', 'breogan-lms-theme'),
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