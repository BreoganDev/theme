<?php
$hero_type = get_theme_mod('breogan_hero_type', 'static');

if ($hero_type == 'static') : ?>
    <!-- Hero con Imagen Estática -->
    <div class="hero-static" style="background-image: url('<?php echo esc_url(get_theme_mod('hero_static_image', get_template_directory_uri() . '/assets/img/default-hero.jpg')); ?>');">
        <div class="container">
            <div class="hero-content">
                <h1><?php echo esc_html(get_theme_mod('breogan_hero_title', 'Título por defecto')); ?></h1>
                <p><?php echo esc_html(get_theme_mod('breogan_hero_subtitle', 'Subtítulo por defecto')); ?></p>
                <div class="hero-cta">
                    <a href="<?php echo esc_url(get_theme_mod('breogan_hero_btn1_url', '#')); ?>" class="btn btn-primary">
                        <?php echo esc_html(get_theme_mod('breogan_hero_btn1_text', 'Get Started')); ?>
                    </a>
                    <a href="<?php echo esc_url(get_theme_mod('breogan_hero_btn2_url', '#')); ?>" class="btn btn-secondary">
                        <?php echo esc_html(get_theme_mod('breogan_hero_btn2_text', 'Learn More')); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php elseif ($hero_type == 'video') : ?>
    <!-- Hero con Video de Fondo -->
    <div class="hero-video">
        <video autoplay muted loop playsinline>
            <source src="<?php echo esc_url(get_theme_mod('hero_video', get_template_directory_uri() . '/assets/video/hero-video.mp4')); ?>" type="video/mp4">
        </video>
        <div class="hero-overlay">
            <div class="hero-content">
                <h1><?php echo esc_html(get_theme_mod('hero_title', 'Título por defecto')); ?></h1>
                <p><?php echo esc_html(get_theme_mod('hero_subtitle', 'Subtítulo por defecto')); ?></p>
            </div>
        </div>
    </div>
<?php elseif ($hero_type == 'parallax') : ?>
    <!-- Hero con Imagen Parallax -->
    <div class="hero-parallax" style="background-image: url('<?php echo esc_url(get_theme_mod('hero_parallax_image', get_template_directory_uri() . '/assets/img/parallax-hero.jpg')); ?>');">
        <div class="hero-overlay">
            <div class="hero-content">
                <h1><?php echo esc_html(get_theme_mod('hero_title', 'Título por defecto')); ?></h1>
                <p><?php echo esc_html(get_theme_mod('hero_subtitle', 'Subtítulo por defecto')); ?></p>
            </div>
        </div>
    </div>
<?php elseif ($hero_type == 'particles') : ?>
    <!-- Hero con Partículas Animadas -->
    <div id="particles-js"></div>
    <div class="hero-content">
        <h1><?php echo esc_html(get_theme_mod('hero_title', 'Título por defecto')); ?></h1>
        <p><?php echo esc_html(get_theme_mod('hero_subtitle', 'Subtítulo por defecto')); ?></p>
    </div>
<?php endif; ?>