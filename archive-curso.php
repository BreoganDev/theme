<?php
/**
 * Plantilla optimizada para el archivo de cursos
 */
get_header();

// Obtener algunas opciones del tema
$layout = get_theme_mod('breogan_courses_archive_layout', 'grid');
$columns = get_theme_mod('breogan_courses_archive_columns', 3);
?>

<div class="courses-archive-banner">
    <div class="container">
        <div class="banner-content">
            <h1 class="archive-title">Todos nuestros cursos</h1>
        </div>
    </div>
</div>

<main id="primary" class="site-main">
    <div class="container">
        <div class="courses-grid-wrapper">
            <div class="courses-grid courses-layout-<?php echo esc_attr($layout); ?> courses-columns-<?php echo esc_attr($columns); ?>">
                <?php
                $args = array(
                    'post_type' => 'curso',
                    'posts_per_page' => 12,
                );
                
                $cursos_query = new WP_Query($args);
                
                if ($cursos_query->have_posts()) :
                    while ($cursos_query->have_posts()) :
                        $cursos_query->the_post();
                        
                        // Obtener metadatos
                        $price = get_post_meta(get_the_ID(), '_curso_price', true);
                        $instructor = get_post_meta(get_the_ID(), '_curso_instructor', true);
                        $level = get_post_meta(get_the_ID(), '_curso_level', true);
                        
                        // Textos para el nivel
                        $level_texts = array(
                            'beginner' => 'Principiante',
                            'intermediate' => 'Intermedio',
                            'advanced' => 'Avanzado',
                            'all-levels' => 'Todos los niveles',
                        );
                        ?>
                        <div class="curso-card">
                            <div class="curso-card-inner">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="curso-image">
                                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="curso-content">
                                    <h3 class="curso-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    
                                    <?php if ($level && isset($level_texts[$level])) : ?>
                                        <div class="curso-level">
                                            <span><?php echo esc_html($level_texts[$level]); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="curso-meta">
                                        <?php if (!empty($instructor)) : ?>
                                            <div class="instructor">
                                                <span class="instructor-name"><?php echo esc_html($instructor); ?></span>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="curso-price">
                                            <?php 
                                            if ($price) {
                                                echo '$' . esc_html($price);
                                            } else {
                                                echo 'Gratis';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    
                                    <!-- Botón para ver más en lugar del extracto -->
                                    <div class="curso-action">
                                        <a href="<?php the_permalink(); ?>" class="btn">Ver detalles</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <div class="no-courses-message">
                        <h2>No se encontraron cursos</h2>
                    </div>
                    <?php
                endif;
                ?>
            </div>
            
            <?php
            // Paginación
            echo '<div class="pagination-container">';
            
            $big = 999999999;
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $cursos_query->max_num_pages,
                'prev_text' => '&laquo;',
                'next_text' => '&raquo;',
            ));
            
            echo '</div>';
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>