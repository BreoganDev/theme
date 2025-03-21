<?php
/**
 * The template for displaying archive pages
 *
 * @package Breogan_LMS_Theme
 */

get_header();
?>

<div class="blog-archive-banner">
    <div class="container">
        <div class="banner-content">
            <h1 class="archive-title">
                <?php
                if (is_category()) {
                    echo single_cat_title('', false);
                } elseif (is_tag()) {
                    echo single_tag_title('', false);
                } elseif (is_author()) {
                    the_post();
                    echo 'Artículos de ' . get_the_author();
                    rewind_posts();
                } elseif (is_day()) {
                    echo get_the_date();
                } elseif (is_month()) {
                    echo get_the_date('F Y');
                } elseif (is_year()) {
                    echo get_the_date('Y');
                } else {
                    echo 'Archivos';
                }
                ?>
            </h1>
            
            <?php
            // Descripción del archivo si está disponible
            $archive_description = '';
            if (is_category()) {
                $archive_description = category_description();
            } elseif (is_tag()) {
                $archive_description = tag_description();
            }
            
            if (!empty($archive_description)) {
                echo '<p class="archive-description">' . $archive_description . '</p>';
            }
            ?>
        </div>
    </div>
</div>

<main id="primary" class="site-main">
    <div class="container blog-archive-container">
        <div class="row">
            <div class="col-md-8">
                <div class="blog-posts-wrapper">
                    <?php
                    if (have_posts()) :
                        while (have_posts()) :
                            the_post();
                            
                            // Obtener la plantilla de contenido para posts
                            get_template_part('template-parts/content', get_post_format());
                            
                        endwhile;
                        
                        // Paginación
                        echo '<div class="pagination-container">';
                        the_posts_pagination(array(
                            'prev_text'    => '<i class="fas fa-chevron-left"></i> ' . __('Anterior', 'breogan-lms-theme'),
                            'next_text'    => __('Siguiente', 'breogan-lms-theme') . ' <i class="fas fa-chevron-right"></i>',
                            'end_size'     => 3,
                            'mid_size'     => 3
                        ));
                        echo '</div>';
                        
                    else :
                        // Si no hay posts
                        ?>
                        <div class="no-posts-found">
                            <i class="fas fa-newspaper"></i>
                            <h2><?php _e('No se encontraron artículos', 'breogan-lms-theme'); ?></h2>
                            <p><?php _e('No se encontraron artículos que coincidan con tu búsqueda.', 'breogan-lms-theme'); ?></p>
                        </div>
                        <?php
                    endif;
                    ?>
                </div>
            </div>
            
            <div class="col-md-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>