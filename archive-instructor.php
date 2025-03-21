<?php
/**
 * Plantilla para mostrar el archivo de instructores
 */
get_header();
?>

<div class="instructors-archive-banner">
    <div class="container">
        <div class="banner-content">
            <h1 class="archive-title"><?php echo __('Nuestros Instructores', 'breogan-lms-theme'); ?></h1>
            <p class="archive-description"><?php echo __('Conoce a nuestro equipo de instructores expertos', 'breogan-lms-theme'); ?></p>
        </div>
    </div>
</div>

<main id="primary" class="site-main">
    <div class="container instructors-archive-container">
        <div class="instructors-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    
                    // Obtener metadatos del instructor
                    $position = get_post_meta(get_the_ID(), '_instructor_position', true);
                    ?>
                    <div class="instructor-card">
                        <a href="<?php the_permalink(); ?>" class="instructor-card-link">
                            <div class="instructor-card-inner">
                                <div class="instructor-card-avatar">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium'); ?>
                                    <?php else : ?>
                                        <div class="instructor-avatar-placeholder">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="instructor-card-content">
                                    <h2 class="instructor-card-name"><?php the_title(); ?></h2>
                                    
                                    <?php if ($position) : ?>
                                        <div class="instructor-card-position"><?php echo esc_html($position); ?></div>
                                    <?php endif; ?>
                                    
                                    <div class="instructor-card-bio">
    <a href="<?php the_permalink(); ?>" class="instructor-bio-link">Ver biografía completa</a>
</div>
                                    
                                  
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                endwhile;
                
                // Paginación
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => '<i class="fas fa-chevron-left"></i>',
                    'next_text' => '<i class="fas fa-chevron-right"></i>',
                ));
                
            else :
                ?>
                <div class="no-instructors-message">
                    <i class="fas fa-user-graduate"></i>
                    <h2><?php _e('No se encontraron instructores', 'breogan-lms-theme'); ?></h2>
                    <p><?php _e('Actualmente no hay instructores disponibles.', 'breogan-lms-theme'); ?></p>
                </div>
                <?php
            endif;
            ?>
        </div>
    </div>
</main>

<?php
get_footer();