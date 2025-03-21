<?php
/**
 * The template for displaying all single posts - Full Width Version (No Sidebar)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Breogan_LMS_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container blog-archive-container blog-fullwidth">
        <div class="blog-content-wrapper">
            <?php
            while (have_posts()) :
                the_post();
                
                // Cargar la plantilla de contenido para posts individuales
                get_template_part('template-parts/content', 'single');
                
                // Si comments están abiertos o hay al menos un comentario, carga la plantilla de comentarios
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>
        </div>
    </div>
</main>

<?php
get_footer();