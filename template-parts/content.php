<?php
/**
 * Template part for displaying posts
 *
 * @package Breogan_LMS_Theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
    <div class="post-inner">
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('medium_large'); ?>
                </a>
            </div>
        <?php endif; ?>
        
        <div class="post-content">
            <header class="entry-header">
                <div class="entry-meta">
                    <?php
                    // Fecha
                    echo '<span class="post-date"><i class="fas fa-calendar-alt"></i> ';
                    echo get_the_date();
                    echo '</span>';
                    
                    // Autor
                    echo '<span class="post-author"><i class="fas fa-user"></i> ';
                    echo get_the_author();
                    echo '</span>';
                    
                    // Categorías
                    if (has_category()) {
                        echo '<span class="post-categories"><i class="fas fa-folder"></i> ';
                        the_category(', ');
                        echo '</span>';
                    }
                    ?>
                </div><!-- .entry-meta -->
                
                <h2 class="entry-title">
                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h2>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php
                // Forzar siempre el extracto en las páginas de listado
                the_excerpt();
                ?>
                <div class="read-more-link">
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                        <?php echo esc_html(get_theme_mod('breogan_read_more_text', __('Leer más', 'breogan-lms-theme'))); ?> <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div><!-- .entry-content -->

            <footer class="entry-footer">
                <?php
                // Etiquetas
                if (has_tag()) {
                    echo '<div class="post-tags"><i class="fas fa-tags"></i> ';
                    the_tags('', ', ', '');
                    echo '</div>';
                }
                ?>
            </footer><!-- .entry-footer -->
        </div><!-- .post-content -->
    </div><!-- .post-inner -->
</article><!-- #post-<?php the_ID(); ?> -->