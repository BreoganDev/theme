<?php
/**
 * Template Name: Página con Barra Lateral
 * Description: Una plantilla que incluye una barra lateral.
 */
// Verificar si se debe mostrar el header
$disable_header = get_post_meta(get_the_ID(), '_breogan_disable_header', true);
if ($disable_header !== 'yes') {
    get_header();
} else {
    // Si el header está deshabilitado, abrir HTML básico
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class('template-sidebar'); ?>>
    <?php wp_body_open(); ?>
    <?php
}
?>
<main id="primary" class="site-main">
    <div class="container page-container">
        <div class="row">
            <div class="col-lg-8">
                <?php
                while (have_posts()) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
                        <header class="page-header">
                            <h1 class="page-title"><?php the_title(); ?></h1>
                        </header>
                        <div class="page-content-inner">
                            <?php the_content(); ?>
                        </div>
                    </article>
                <?php
                endwhile;
                ?>
            </div>
            
            <div class="col-lg-4">
                <div class="page-sidebar">
                    <?php if (is_active_sidebar('sidebar-page')) : ?>
                        <?php dynamic_sidebar('sidebar-page'); ?>
                    <?php else : ?>
                        <!-- Sidebar predeterminada si no hay widgets -->
                        <div class="widget-area">
                            <div class="widget">
                                <h3 class="widget-title"><?php _e('Categorías', 'breogan-lms-theme'); ?></h3>
                                <ul>
                                    <?php wp_list_categories(['title_li' => '']); ?>
                                </ul>
                            </div>
                            
                            <div class="widget">
                                <h3 class="widget-title"><?php _e('Páginas', 'breogan-lms-theme'); ?></h3>
                                <ul>
                                    <?php wp_list_pages(['title_li' => '']); ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
// Verificar si se debe mostrar el footer
$disable_footer = get_post_meta(get_the_ID(), '_breogan_disable_footer', true);
if ($disable_footer !== 'yes') {
    get_footer();
} else {
    // Si el footer está deshabilitado, cerrar HTML básico
    ?>
    <?php wp_footer(); ?>
    </body>
    </html>
    <?php
}
?>