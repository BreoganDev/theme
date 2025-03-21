<?php
/**
 * Template Name: Página Ancho Completo
 * Description: Una plantilla de página sin barras laterales que ocupa todo el ancho.
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
    <body <?php body_class('template-centered'); ?>>
    <?php wp_body_open(); ?>
    <?php
}
?>

<main id="primary" class="site-main">
    <div class="container-fluid fullwidth-content">
        <?php
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('centered-article'); ?>>
                <header class="entry-header text-center">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content text-center">
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
    // Si el footer está deshabilitado, cerrar HTML básico
    ?>
    <?php wp_footer(); ?>
    </body>
    </html>
    <?php
}
?>