<?php
/**
 * Template Name: Página de Blog (Sin Sidebar)
 *
 * Esta plantilla se puede aplicar a una página para mostrar los posts más recientes
 * en un formato de blog personalizado de ancho completo.
 *
 * @package Breogan_LMS_Theme
 */
get_header();

// Determinar la cantidad de posts por página y la paginación
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$posts_per_page = get_option('posts_per_page');

// Argumentos para la consulta de posts
$args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => $posts_per_page,
    'paged'          => $paged,
);

// Ejecutar la consulta
$blog_query = new WP_Query($args);
?>

<div class="blog-archive-banner">
    <div class="container">
        <div class="banner-content">
            <h1 class="archive-title"><?php echo get_the_title(); ?></h1>
            <?php if (has_excerpt()) : ?>
                <p class="archive-description"><?php echo get_the_excerpt(); ?></p>
            <?php else : ?>
                <p class="archive-description"><?php echo __('Explora nuestros artículos más recientes y mantente al día con las últimas noticias, tutoriales y recursos.', 'breogan-lms-theme'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<main id="primary" class="site-main">
    <div class="container blog-archive-container blog-fullwidth">
        <div class="blog-posts-wrapper">
            <?php
            if ($blog_query->have_posts()) :
                echo '<div class="posts-grid">';
                
                while ($blog_query->have_posts()) :
                    $blog_query->the_post();
                    
                    // Obtener la plantilla de contenido para posts
                    get_template_part('template-parts/content', get_post_format());
                    
                endwhile;
                
                echo '</div>';
                
                // Navegación de paginación
                echo '<div class="pagination-container">';
                echo paginate_links(array(
                    'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                    'format'       => '?paged=%#%',
                    'current'      => max(1, $paged),
                    'total'        => $blog_query->max_num_pages,
                    'prev_text'    => '<i class="fas fa-chevron-left"></i> ' . __('Anterior', 'breogan-lms-theme'),
                    'next_text'    => __('Siguiente', 'breogan-lms-theme') . ' <i class="fas fa-chevron-right"></i>',
                    'type'         => 'list',
                    'end_size'     => 3,
                    'mid_size'     => 3
                ));
                echo '</div>';
                
                // Restaurar datos de post originales
                wp_reset_postdata();
                
            else :
                // Si no hay posts
                ?>
                <div class="no-posts-found">
                    <i class="fas fa-newspaper"></i>
                    <h2><?php _e('No se encontraron artículos', 'breogan-lms-theme'); ?></h2>
                    <p><?php _e('Parece que aún no hay artículos publicados. Vuelve pronto para ver nuevo contenido.', 'breogan-lms-theme'); ?></p>
                </div>
                <?php
            endif;
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>