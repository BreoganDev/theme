<?php
/**
 * Proporciona campos personalizados para los cursos
 */

// Registrar meta boxes para el CPT Curso
function breogan_curso_meta_boxes() {
    add_meta_box(
        'breogan_curso_details',
        __('Detalles del Curso', 'breogan-lms-theme'),
        'breogan_curso_details_callback',
        'curso',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'breogan_curso_meta_boxes');

// Callback para el meta box de detalles del curso
function breogan_curso_details_callback($post) {
    wp_nonce_field('breogan_curso_details_save', 'breogan_curso_details_nonce');
    
    // Recuperar valores actuales
    $price = get_post_meta($post->ID, '_curso_price', true);
    $instructor = get_post_meta($post->ID, '_curso_instructor', true);
    $featured = get_post_meta($post->ID, '_featured_curso', true) === 'yes';
    $duration = get_post_meta($post->ID, '_curso_duration', true);
    $level = get_post_meta($post->ID, '_curso_level', true);
    
    // Campo de precio
    echo '<p>';
    echo '<label for="curso_price">' . __('Precio (€):', 'breogan-lms-theme') . '</label> ';
    echo '<input type="number" min="0" step="0.01" id="curso_price" name="curso_price" value="' . esc_attr($price) . '" style="width: 100px;" />';
    echo '</p>';
    
    // Campo de instructor
    echo '<p>';
    echo '<label for="curso_instructor">' . __('Instructor:', 'breogan-lms-theme') . '</label> ';
    echo '<input type="text" id="curso_instructor" name="curso_instructor" value="' . esc_attr($instructor) . '" style="width: 300px;" />';
    echo '</p>';
    
    // Campo de duración
    echo '<p>';
    echo '<label for="curso_duration">' . __('Duración (horas):', 'breogan-lms-theme') . '</label> ';
    echo '<input type="number" min="1" id="curso_duration" name="curso_duration" value="' . esc_attr($duration) . '" style="width: 100px;" />';
    echo '</p>';
    
    // Campo de nivel
    echo '<p>';
    echo '<label for="curso_level">' . __('Nivel:', 'breogan-lms-theme') . '</label> ';
    echo '<select id="curso_level" name="curso_level" style="width: 200px;">';
    $levels = array(
        '' => __('Seleccionar nivel', 'breogan-lms-theme'),
        'beginner' => __('Principiante', 'breogan-lms-theme'),
        'intermediate' => __('Intermedio', 'breogan-lms-theme'),
        'advanced' => __('Avanzado', 'breogan-lms-theme'),
        'all-levels' => __('Todos los niveles', 'breogan-lms-theme'),
    );
    foreach ($levels as $value => $label) {
        echo '<option value="' . esc_attr($value) . '"' . selected($level, $value, false) . '>' . esc_html($label) . '</option>';
    }
    echo '</select>';
    echo '</p>';
    
    // Campo destacado
    echo '<p>';
    echo '<input type="checkbox" id="featured_curso" name="featured_curso" ' . checked($featured, true, false) . ' />';
    echo '<label for="featured_curso">' . __('Curso Destacado', 'breogan-lms-theme') . '</label> ';
    echo '</p>';
}

// Guardar datos de meta box de detalles
function breogan_curso_details_save($post_id) {
    // Verificar nonce
    if (!isset($_POST['breogan_curso_details_nonce']) || 
        !wp_verify_nonce($_POST['breogan_curso_details_nonce'], 'breogan_curso_details_save')) {
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
    
    // Guardar campos
    if (isset($_POST['curso_price'])) {
        update_post_meta($post_id, '_curso_price', sanitize_text_field($_POST['curso_price']));
    }
    
    if (isset($_POST['curso_instructor'])) {
        update_post_meta($post_id, '_curso_instructor', sanitize_text_field($_POST['curso_instructor']));
    }
    
    if (isset($_POST['curso_duration'])) {
        update_post_meta($post_id, '_curso_duration', sanitize_text_field($_POST['curso_duration']));
    }
    
    if (isset($_POST['curso_level'])) {
        update_post_meta($post_id, '_curso_level', sanitize_text_field($_POST['curso_level']));
    }
    
    // Destacado es un checkbox
    $featured = isset($_POST['featured_curso']) ? 'yes' : 'no';
    update_post_meta($post_id, '_featured_curso', $featured);
}
add_action('save_post_curso', 'breogan_curso_details_save');

// Añadir un meta box separado para la imagen del instructor
function breogan_add_instructor_image_field() {
    add_meta_box(
        'breogan_instructor_image',
        __('Imagen del Instructor', 'breogan-lms-theme'),
        'breogan_instructor_image_callback',
        'curso',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'breogan_add_instructor_image_field');

// Callback para la imagen del instructor
function breogan_instructor_image_callback($post) {
    wp_nonce_field('instructor_image_save', 'instructor_image_nonce');
    $instructor_image = get_post_meta($post->ID, '_curso_instructor_image', true);
    ?>
    <div class="instructor-image-container">
        <p>
            <?php if ($instructor_image) : ?>
                <div class="instructor-preview" style="margin-bottom: 10px;">
                    <img src="<?php echo esc_url($instructor_image); ?>" style="max-width: 100%; height: auto;">
                </div>
            <?php endif; ?>
            <input type="hidden" name="curso_instructor_image" id="curso_instructor_image" value="<?php echo esc_attr($instructor_image); ?>">
            <button type="button" class="button instructor-upload"><?php _e('Seleccionar imagen', 'breogan-lms-theme'); ?></button>
            <?php if ($instructor_image) : ?>
                <button type="button" class="button instructor-remove"><?php _e('Eliminar imagen', 'breogan-lms-theme'); ?></button>
            <?php endif; ?>
        </p>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        // Subir imagen
        $('.instructor-upload').click(function(e) {
            e.preventDefault();
            
            var frame = wp.media({
                title: '<?php _e("Seleccionar o subir imagen del instructor", "breogan-lms-theme"); ?>',
                button: {
                    text: '<?php _e("Usar esta imagen", "breogan-lms-theme"); ?>'
                },
                multiple: false
            });
            
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#curso_instructor_image').val(attachment.url);
                $('.instructor-preview').remove();
                $('.instructor-image-container p').prepend('<div class="instructor-preview" style="margin-bottom: 10px;"><img src="' + attachment.url + '" style="max-width: 100%; height: auto;"></div>');
                if ($('.instructor-remove').length === 0) {
                    $('.instructor-upload').after('<button type="button" class="button instructor-remove"><?php _e("Eliminar imagen", "breogan-lms-theme"); ?></button>');
                }
            });
            
            frame.open();
        });
        
        // Eliminar imagen
        $(document).on('click', '.instructor-remove', function(e) {
            e.preventDefault();
            $('#curso_instructor_image').val('');
            $('.instructor-preview').remove();
            $(this).remove();
        });
    });
    </script>
    <?php
}

// Guardar campo de imagen del instructor
function breogan_save_instructor_image($post_id) {
    if (!isset($_POST['instructor_image_nonce']) || !wp_verify_nonce($_POST['instructor_image_nonce'], 'instructor_image_save')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['curso_instructor_image'])) {
        update_post_meta($post_id, '_curso_instructor_image', esc_url_raw($_POST['curso_instructor_image']));
    }
}
add_action('save_post_curso', 'breogan_save_instructor_image');

// Columnas personalizadas en la lista de administración
function breogan_curso_columns($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        // Insertar precio e instructor después del título
        if ($key == 'title') {
            $new_columns[$key] = $value;
            $new_columns['precio'] = __('Precio', 'breogan-lms-theme');
            $new_columns['instructor'] = __('Instructor', 'breogan-lms-theme');
            $new_columns['destacado'] = __('Destacado', 'breogan-lms-theme');
        } else {
            $new_columns[$key] = $value;
        }
    }
    return $new_columns;
}
add_filter('manage_curso_posts_columns', 'breogan_curso_columns');

// Mostrar datos en las columnas personalizadas
function breogan_curso_custom_column($column, $post_id) {
    switch ($column) {
        case 'precio':
            $price = get_post_meta($post_id, '_curso_price', true);
            echo $price ? '€' . esc_html($price) : __('Gratis', 'breogan-lms-theme');
            break;
        
        case 'instructor':
            $instructor = get_post_meta($post_id, '_curso_instructor', true);
            $instructor_image = get_post_meta($post_id, '_curso_instructor_image', true);
            if (!empty($instructor_image)) {
                echo '<img src="' . esc_url($instructor_image) . '" alt="' . esc_attr($instructor) . '" style="width: 30px; height: 30px; border-radius: 50%; vertical-align: middle; margin-right: 5px;">';
            }
            echo esc_html($instructor);
            break;
            
        case 'destacado':
            $featured = get_post_meta($post_id, '_featured_curso', true);
            echo $featured === 'yes' ? '<span style="color: green;">✓</span>' : '<span style="color: red;">✗</span>';
            break;
    }
}
add_action('manage_curso_posts_custom_column', 'breogan_curso_custom_column', 10, 2);

// Hacer que las columnas sean ordenables
function breogan_curso_sortable_columns($columns) {
    $columns['precio'] = 'precio';
    $columns['instructor'] = 'instructor';
    $columns['destacado'] = 'destacado';
    return $columns;
}
add_filter('manage_edit-curso_sortable_columns', 'breogan_curso_sortable_columns');

// Manejar la ordenación de columnas personalizadas
function breogan_curso_orderby($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }
    
    $orderby = $query->get('orderby');
    
    if ('precio' === $orderby) {
        $query->set('meta_key', '_curso_price');
        $query->set('orderby', 'meta_value_num');
    }
    
    if ('instructor' === $orderby) {
        $query->set('meta_key', '_curso_instructor');
        $query->set('orderby', 'meta_value');
    }
    
    if ('destacado' === $orderby) {
        $query->set('meta_key', '_featured_curso');
        $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_posts', 'breogan_curso_orderby');

// Añadir script para Media Uploader en el admin
function breogan_admin_scripts($hook) {
    global $post;
    
    if ($hook == 'post-new.php' || $hook == 'post.php') {
        if (isset($post) && $post->post_type === 'curso') {
            wp_enqueue_media();
        }
    }
}
add_action('admin_enqueue_scripts', 'breogan_admin_scripts');

