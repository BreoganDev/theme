<?php
/**
 * Plantilla para mostrar un curso individual
 */
get_header();
?>

<main id="primary" class="site-main">
    <div class="container curso-container">
        <?php
        while (have_posts()) :
            the_post();
            
            // Obtener metadatos del curso
            $price = get_post_meta(get_the_ID(), '_curso_price', true);
            $instructor = get_post_meta(get_the_ID(), '_curso_instructor', true);
            $duration = get_post_meta(get_the_ID(), '_curso_duration', true);
            $level = get_post_meta(get_the_ID(), '_curso_level', true);
            $instructor_image = get_post_meta(get_the_ID(), '_curso_instructor_image', true);
            
            // Textos para el nivel
            $level_texts = array(
                'beginner' => __('Principiante', 'breogan-lms-theme'),
                'intermediate' => __('Intermedio', 'breogan-lms-theme'),
                'advanced' => __('Avanzado', 'breogan-lms-theme'),
                'all-levels' => __('Todos los niveles', 'breogan-lms-theme'),
            );
            
            // Obtener categorías
            $categories = get_the_terms(get_the_ID(), 'categoria_curso');
            ?>
            
            <article id="curso-<?php the_ID(); ?>" <?php post_class('curso-single'); ?>>
                <div class="curso-header">
                    <div class="curso-header-content">
                        <?php if ($categories && !is_wp_error($categories)) : ?>
                            <div class="curso-categories">
                                <?php foreach ($categories as $category) : ?>
                                    <span class="curso-category"><?php echo esc_html($category->name); ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        
                        <h1 class="curso-title"><?php the_title(); ?></h1>
                        
                        <div class="curso-meta">
                            <?php if ($instructor) : ?>
                                <div class="curso-instructor">
                                    <i class="fas fa-user-tie"></i>
                                    <span><?php echo esc_html($instructor); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($duration) : ?>
                                <div class="curso-duration">
                                    <i class="fas fa-clock"></i>
                                    <span><?php echo esc_html($duration); ?> <?php _e('horas', 'breogan-lms-theme'); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($level && isset($level_texts[$level])) : ?>
                                <div class="curso-level">
                                    <i class="fas fa-signal"></i>
                                    <span><?php echo esc_html($level_texts[$level]); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="curso-featured-image">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="curso-content-wrapper">
                    <div class="curso-main-content">
                        <div class="curso-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    
                    <div class="curso-sidebar">
                        <div class="curso-price-card">
                            <div class="curso-price">
                                <?php if ($price) : ?>
                                    <span class="price-amount">€<?php echo esc_html($price); ?></span>
                                <?php else : ?>
                                    <span class="price-free"><?php _e('Gratis', 'breogan-lms-theme'); ?></span>
                                <?php endif; ?>
                            </div>
                            
                            <a href="#" class="btn btn-primary btn-block">
                                <?php _e('Inscribirse ahora', 'breogan-lms-theme'); ?>
                            </a>
                            
                            <ul class="curso-features">
                                <li><i class="fas fa-video"></i> <?php _e('Videos a tu ritmo', 'breogan-lms-theme'); ?></li>
                                <li><i class="fas fa-file-pdf"></i> <?php _e('Recursos descargables', 'breogan-lms-theme'); ?></li>
                                <li><i class="fas fa-certificate"></i> <?php _e('Certificado al completar', 'breogan-lms-theme'); ?></li>
                                <li><i class="fas fa-infinity"></i> <?php _e('Acceso ilimitado', 'breogan-lms-theme'); ?></li>
                            </ul>
                        </div>
                        
                        <?php if (!empty($instructor_image)) : ?>
                            <div class="curso-instructor-card">
                                <img src="<?php echo esc_url($instructor_image); ?>" alt="<?php echo esc_attr($instructor); ?>" class="instructor-image">
                                <div class="instructor-details">
                                    <h3><?php echo esc_html($instructor); ?></h3>
                                    <a href="<?php 
                                        // Buscar el enlace del instructor por su nombre
                                        $instructor_query = new WP_Query(array(
                                            'post_type' => 'instructor',
                                            'title' => $instructor,
                                            'posts_per_page' => 1
                                        ));
                                        
                                        if ($instructor_query->have_posts()) {
                                            $instructor_query->the_post();
                                            echo esc_url(get_permalink());
                                            wp_reset_postdata();
                                        } else {
                                            echo '#';
                                        }
                                    ?>" class="btn btn-secondary">
                                        <?php _e('Ver perfil del instructor', 'breogan-lms-theme'); ?>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </article>
        <?php
        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();