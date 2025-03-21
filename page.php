<?php
/**
 * Plantilla para páginas estándar
 */

// Verificar si se debe mostrar el header
$disable_header = get_post_meta(get_the_ID(), '_breogan_disable_header', true);
if ($disable_header !== 'yes') {
    get_header();
} else {
    // Si el header está deshabilitado, aún necesitamos abrir el HTML básico
    ?><!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <?php
}
?>

<main id="primary" class="site-main">
    <div class="container page-container">
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
</main>

<?php
// Verificar si se debe mostrar el footer
$disable_footer = get_post_meta(get_the_ID(), '_breogan_disable_footer', true);
if ($disable_footer !== 'yes') {
    get_footer();
} else {
    // Si el footer está deshabilitado, aún necesitamos cerrar el HTML básico
    ?>
    <?php wp_footer(); ?>
    </body>
    </html>
    <?php
}