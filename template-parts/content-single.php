<?php
/**
 * Template part for displaying single posts
 *
 * @package Breogan_LMS_Theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post-content'); ?>>
    <header class="entry-header">
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail('large'); ?>
            </div>
        <?php endif; ?>
        
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
        
        <h1 class="entry-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        the_content(
            sprintf(
                /* translators: %s: Post title. */
                __('Continuar leyendo %s <span class="meta-nav">&rarr;</span>', 'breogan-lms-theme'),
                the_title('<span class="screen-reader-text">"', '"</span>', false)
            )
        );

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . __('Páginas:', 'breogan-lms-theme'),
                'after'  => '</div>',
            )
        );
        ?>
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
        
        <!-- Navegación entre posts -->
        <div class="post-navigation">
            <div class="nav-previous">
                <?php previous_post_link('%link', '<i class="fas fa-chevron-left"></i> %title'); ?>
            </div>
            <div class="nav-next">
                <?php next_post_link('%link', '%title <i class="fas fa-chevron-right"></i>'); ?>
            </div>
        </div>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->