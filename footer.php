<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <div class="footer-brand">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                        <?php 
                        if (has_custom_logo()) {
                            the_custom_logo();
                        } else {
                            echo esc_html(get_theme_mod('breogan_logo_text', 'HERO'));
                        }
                        ?>
                    </a>
                </div>
                <p class="footer-description">
                    <?php echo wp_kses_post(get_theme_mod('breogan_footer_description', 'La plataforma líder para la creación y venta de cursos online. Comparte tu conocimiento y genera ingresos.')); ?>
                </p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://x.com/RocioMayo77" target="_blank" rel="noopener" class="social-link twitter"><i class="fab fa-x-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="https://youtube.com/c/usuario" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            
            <div class="footer-col">
                <h4 class="footer-heading">Enlaces Rápidos</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a></li>
                    <li><a href="#">Sobre Nosotros</a></li>
                    <li><a href="<?php echo esc_url(get_post_type_archive_link('curso')); ?>">Cursos</a></li>
                    <li><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">Blog</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </div>
            
            <div class="footer-col">
                <h4 class="footer-heading">Categorías</h4>
                <ul class="footer-links">
                    <?php
                    // Listar categorías de cursos si existen
                    $curso_cats = get_terms(array(
                        'taxonomy' => 'categoria_curso',
                        'hide_empty' => false,
                        'number' => 5,
                    ));
                    
                    if (!empty($curso_cats) && !is_wp_error($curso_cats)) {
                        foreach ($curso_cats as $cat) {
                            echo '<li><a href="' . esc_url(get_term_link($cat)) . '">' . esc_html($cat->name) . '</a></li>';
                        }
                    } else {
                        // Categorías predeterminadas si no hay categorías de cursos
                        echo '<li><a href="#">Negocios</a></li>';
                        echo '<li><a href="#">Marketing</a></li>';
                        echo '<li><a href="#">Diseño</a></li>';
                        echo '<li><a href="#">Tecnología</a></li>';
                        echo '<li><a href="#">Personal</a></li>';
                    }
                    ?>
                </ul>
            </div>
            
            <div class="footer-col">
                <h4 class="footer-heading">Soporte</h4>
                <ul class="footer-links">
                    <li><a href="#">Preguntas Frecuentes</a></li>
                    <li><a href="<?php echo esc_url(get_privacy_policy_url()); ?>">Política de Privacidad</a></li>
                    <li><a href="#">Términos de Servicio</a></li>
                    <li><a href="#">Ayuda</a></li>
                    <li><a href="#">Afiliados</a></li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="copyright">
                <?php echo wp_kses_post(get_theme_mod('breogan_footer_copyright', '&copy; ' . date('Y') . ' ' . get_bloginfo('name') . '. Todos los derechos reservados.')); ?>
            </div>
            <div class="footer-credits">
                <?php echo wp_kses_post(get_theme_mod('breogan_footer_credits', 'Diseñado con <i class="fas fa-heart"></i> por Rocio')); ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>