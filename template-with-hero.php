<?php
/**
 * Template Name: Plantilla con Hero
 * Template Post Type: page
 * Description: Plantilla con sección hero que permite elegir entre ancho completo o centrado
 */

// Obtener la opción de layout
$layout = get_post_meta(get_the_ID(), '_hero_layout', true);

// Garantizar un valor por defecto si no hay elección
if (empty($layout)) {
    $layout = 'centered'; // Valor por defecto
}

// Definir clases de contenedor para cada sección según la elección
$hero_container_class = ($layout === 'fullwidth') ? 'container-fluid hero-fullwidth' : 'container hero-centered';
$content_container_class = ($layout === 'fullwidth') ? 'container-fluid content-fullwidth' : 'container content-centered';

// Agregar clase al body para control adicional desde CSS
add_filter('body_class', function($classes) use ($layout) {
    $classes[] = 'hero-layout-' . $layout;
    return $classes;
});

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
    <body <?php body_class('template-hero'); ?>>
    <?php wp_body_open(); ?>
    <?php
}

// Obtener la URL de la imagen destacada
$hero_image = '';
if (has_post_thumbnail()) {
    $hero_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
}
?>

<!-- Output para debug -->
<!-- Layout elegido: <?php echo esc_html($layout); ?> -->
<!-- Clase de contenedor hero: <?php echo esc_html($hero_container_class); ?> -->
<!-- Clase de contenedor contenido: <?php echo esc_html($content_container_class); ?> -->

<div class="page-hero" style="background-image: url('<?php echo esc_url($hero_image); ?>');">
    <div class="<?php echo esc_attr($hero_container_class); ?>">
        <div class="hero-content">
            <h1 class="hero-title"><?php the_title(); ?></h1>
            <?php if (get_post_meta(get_the_ID(), '_page_subtitle', true)) : ?>
                <p class="hero-description"><?php echo esc_html(get_post_meta(get_the_ID(), '_page_subtitle', true)); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<main id="primary" class="site-main">
    <div class="<?php echo esc_attr($content_container_class); ?> page-container">
        <?php
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('page-content hero-page-content'); ?>>
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
    // Si el footer está deshabilitado, cerrar HTML básico
    ?>
    <?php wp_footer(); ?>
    </body>
    </html>
    <?php
}
?>