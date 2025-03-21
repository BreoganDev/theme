<?php
/**
 * Template Name: Página de Inicio con Blog
 *
 * Una plantilla para la página de inicio que incluye una sección de blog
 * mostrando los últimos posts.
 *
 * @package Breogan_LMS_Theme
 */

get_header();

// Incluir las secciones de la página de inicio
get_template_part('template-parts/home', 'hero');
get_template_part('template-parts/home', 'features');
get_template_part('template-parts/home', 'courses');

// Consulta para obtener los últimos posts del blog
$args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 3, // Mostrar solo los 3 más recientes
);

$recent_posts = new WP_Query($args);
?>

<!-- Sección de Blog en la Página de Inicio -->
<?php if (get_theme_mod('breogan_home_blog_enable', true)) : ?>
<section class="home-blog-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?php echo esc_html(get_theme_mod('breogan_home_blog_title', __('Últimas del Blog', 'breogan-lms-theme'))); ?></h2>
            <p class="section-description"><?php echo esc_html(get_theme_mod('breogan_home_blog_description', __('Explora nuestros artículos más recientes y mantente informado.', 'breogan-lms-theme'))); ?></p>
        </div>
        
        <div class="home-blog-grid">
            <?php
            if ($recent_posts->have_posts()) :
                while ($recent_posts->have_posts()) :
                    $recent_posts->the_post();
                    ?>
                    <div class="blog-card">
                        <div class="blog-card-inner">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="blog-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <span class="blog-date"><i class="fas fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                                    <?php if (has_category()) : ?>
                                        <span class="blog-category"><i class="fas fa-folder"></i> <?php the_category(', '); ?></span>
                                    <?php endif; ?>
                                </div>
                                
                                <h3 class="blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                
                                <div class="blog-excerpt">
                                    <?php echo breogan_custom_excerpt(20); // Función definida en functions.php ?>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                    <?php _e('Leer más', 'breogan-lms-theme'); ?> <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <div class="no-posts-message">
                    <p><?php _e('No hay artículos publicados aún.', 'breogan-lms-theme'); ?></p>
                </div>
                <?php
            endif;
            ?>
        </div>
        
        <div class="view-all-posts">
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn-primary">
                <?php _e('Ver todos los artículos', 'breogan-lms-theme'); ?> <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Otras secciones de la página de inicio -->
<?php
get_template_part('template-parts/home', 'cta');
get_template_part('template-parts/home', 'testimonials');

get_footer();