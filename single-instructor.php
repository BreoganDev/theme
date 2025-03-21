<?php
/**
 * Plantilla para mostrar un perfil de instructor individual
 */
get_header();
?>

<main id="primary" class="site-main">
    <div class="container instructor-container">
        <?php
        while (have_posts()) :
            the_post();
            
            // Obtener metadatos del instructor
            $position = get_post_meta(get_the_ID(), '_instructor_position', true);
            $twitter = get_post_meta(get_the_ID(), '_instructor_twitter', true);
            $linkedin = get_post_meta(get_the_ID(), '_instructor_linkedin', true);
            $website = get_post_meta(get_the_ID(), '_instructor_website', true);
            ?>
            
            <article id="instructor-<?php the_ID(); ?>" <?php post_class('instructor-profile'); ?>>
                <div class="instructor-header">
                    <div class="instructor-avatar">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium'); ?>
                        <?php else : ?>
                            <div class="instructor-avatar-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="instructor-header-info">
                        <h1 class="instructor-name"><?php the_title(); ?></h1>
                        
                        <?php if ($position) : ?>
                            <div class="instructor-position"><?php echo esc_html($position); ?></div>
                        <?php endif; ?>
                        
                        <div class="instructor-social">
                            <?php if ($twitter) : ?>
                                <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener noreferrer" class="social-link twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            <?php endif; ?>
                            
                            <?php if ($linkedin) : ?>
                                <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener noreferrer" class="social-link linkedin">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            <?php endif; ?>
                            
                            <?php if ($website) : ?>
                                <a href="<?php echo esc_url($website); ?>" target="_blank" rel="noopener noreferrer" class="social-link website">
                                    <i class="fas fa-globe"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="instructor-content">
                    <h2><?php _e('Biografía', 'breogan-lms-theme'); ?></h2>
                    <?php the_content(); ?>
                </div>
                
                <div class="instructor-courses">
                    <h2><?php _e('Cursos impartidos', 'breogan-lms-theme'); ?></h2>
                    
                    <?php
                    // Buscar cursos asociados a este instructor
                    $instructor_name = get_the_title();
                    
                    $args = array(
                        'post_type'      => 'curso',
                        'posts_per_page' => -1,
                        'meta_query'     => array(
                            array(
                                'key'     => '_curso_instructor',
                                'value'   => $instructor_name,
                                'compare' => '='
                            ),
                        ),
                    );
                    
                    $instructor_courses = new WP_Query($args);
                    
                    if ($instructor_courses->have_posts()) :
                        echo '<div class="courses-grid courses-layout-grid courses-columns-3">';
                        
                        while ($instructor_courses->have_posts()) :
                            $instructor_courses->the_post();
                            
                            // Obtener metadatos del curso
                            $price = get_post_meta(get_the_ID(), '_curso_price', true);
                            $level = get_post_meta(get_the_ID(), '_curso_level', true);
                            
                            // Textos para el nivel
                            $level_texts = array(
                                'beginner' => __('Principiante', 'breogan-lms-theme'),
                                'intermediate' => __('Intermedio', 'breogan-lms-theme'),
                                'advanced' => __('Avanzado', 'breogan-lms-theme'),
                                'all-levels' => __('Todos los niveles', 'breogan-lms-theme'),
                            );
                            ?>
                            
                            <div class="curso-card">
                                <div class="curso-card-inner">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="curso-image">
                                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="curso-content">
                                        <h3 class="curso-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        
                                        <?php if ($level && isset($level_texts[$level])) : ?>
                                            <div class="curso-level">
                                                <i class="fas fa-signal"></i>
                                                <span><?php echo esc_html($level_texts[$level]); ?></span>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="curso-excerpt">
                                            <?php 
                                            $excerpt = get_the_excerpt();
                                            echo wp_trim_words($excerpt, 15, '...');
                                            ?>
                                        </div>
                                        
                                        <div class="curso-meta">
                                            <div class="curso-price">
                                                <?php 
                                                if ($price) {
                                                    echo '$' . esc_html($price);
                                                } else {
                                                    _e('Gratis', 'breogan-lms-theme');
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        <?php
                        endwhile;
                        wp_reset_postdata();
                        
                        echo '</div>';
                    else :
                        echo '<p class="no-courses">' . __('Este instructor aún no tiene cursos publicados.', 'breogan-lms-theme') . '</p>';
                    endif;
                    ?>
                </div>
            </article>
        <?php
        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();