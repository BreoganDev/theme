<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php 
    $font_family = get_theme_mod('breogan_font', 'Poppins');
    echo '<link href="https://fonts.googleapis.com/css2?family=' . esc_attr(str_replace(' ', '+', $font_family)) . ':wght@300;400;500;600;700&display=swap" rel="stylesheet">';
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    
    <header class="site-header">
        <div class="container header-container">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                <?php 
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo esc_html(get_theme_mod('breogan_logo_text', 'HERO'));
                }
                ?>
            </a>
            
            <!-- Después de tu navegación principal -->
<div class="header-actions">
    <?php if (get_theme_mod('breogan_header_button1_enable', true)) : ?>
        <a href="<?php echo esc_url(get_theme_mod('breogan_header_button1_url', '#')); ?>" 
           class="btn btn-<?php echo esc_attr(get_theme_mod('breogan_header_button1_style', 'primary')); ?>">
            <?php echo esc_html(get_theme_mod('breogan_header_button1_text', __('Inscribirse', 'breogan-lms-theme'))); ?>
        </a>
    <?php endif; ?>
    
    <?php if (get_theme_mod('breogan_header_button2_enable', false)) : ?>
        <a href="<?php echo esc_url(get_theme_mod('breogan_header_button2_url', '#')); ?>" 
           class="btn btn-<?php echo esc_attr(get_theme_mod('breogan_header_button2_style', 'secondary')); ?>">
            <?php echo esc_html(get_theme_mod('breogan_header_button2_text', __('Iniciar sesión', 'breogan-lms-theme'))); ?>
        </a>
    <?php endif; ?>
</div>
            
            <!-- Botón hamburguesa simple -->
            <button id="mobile-toggle" class="mobile-toggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <nav class="main-navigation">
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'main-menu',
                        'container' => false,
                        'menu_class' => 'nav-menu',
                        'fallback_cb' => 'breogan_fallback_menu',
                    ));
                ?>
                
                <div class="user-actions">
                    <button class="icon-button" id="dark-mode-toggle">
                        <i class="fas fa-moon"></i>
                    </button>
                    <button class="icon-button">
                        <i class="fas fa-search"></i>
                    </button>
                    <button class="icon-button">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
            </nav>
        </div>
    </header>
    
    <!-- Panel móvil simplificado -->
    <div id="mobile-panel" class="mobile-panel">
        <div class="mobile-panel-header">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                <?php 
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo esc_html(get_theme_mod('breogan_logo_text', 'HERO'));
                }
                ?>
            </a>
            <button id="close-panel" class="close-panel">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="mobile-panel-content">
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'container' => false,
                    'menu_class' => 'mobile-menu',
                    'fallback_cb' => 'breogan_fallback_menu',
                ));
            ?>
            <!-- Botón de modo oscuro en el panel móvil -->
            <div class="mobile-actions">
                <button id="mobile-toggle-dark-mode" class="icon-button">
                    <i class="fas fa-moon"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Overlay simple -->
    <div id="mobile-overlay" class="mobile-overlay"></div>