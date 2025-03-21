<?php
/**
 * Template Name: Página de Inicio
 */
 
get_header(); 

// Determinar el tipo de hero
$hero_type = get_theme_mod('breogan_hero_type', 'static');

if ($hero_type == 'parallax') : ?>
    <!-- Hero Parallax -->
    <?php
    // Obtener la imagen de fondo para el parallax
    $parallax_image = get_theme_mod('breogan_hero_image', '');
    if (empty($parallax_image)) {
        $parallax_image = get_template_directory_uri() . '/assets/images/hero-image.jpg';
    }
    ?>
    <section class="hero-section hero-parallax">
        <!-- Fondo con efecto parallax -->
        <div class="parallax-bg" 
             data-speed="0.5" 
             style="background-image: url('<?php echo esc_url($parallax_image); ?>');">
        </div>
        
        <!-- Overlay oscuro para mejor contraste -->
        <div class="hero-overlay"></div>
        
        <!-- Contenido del Hero -->
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title"><?php echo esc_html(get_theme_mod('breogan_hero_title', 'Selling Online Courses')); ?></h1>
                <p class="hero-description"><?php echo esc_html(get_theme_mod('breogan_hero_description', 'Teach what you know and build a thriving community around your passion while creating additional streams of revenue.')); ?></p>
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
    </section>
<?php else : ?>
   <!-- Hero Estático (default) -->
<section class="hero-section">
    <?php
    $hero_image = get_theme_mod('breogan_hero_image', '');
    if (!empty($hero_image)) {
        echo '<div class="hero-image" style="background-image: url(\'' . esc_url($hero_image) . '\');"></div>';
    } else {
        // Usa una imagen de la carpeta del tema como respaldo si no hay personalizada
        echo '<div class="hero-image" style="background-image: url(\'' . esc_url(get_template_directory_uri() . '/assets/images/hero-image.jpg') . '\');"></div>';
    }
    ?>
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title"><?php echo esc_html(get_theme_mod('breogan_hero_title', 'Selling Online Courses')); ?></h1>
            <p class="hero-description"><?php echo esc_html(get_theme_mod('breogan_hero_description', 'Teach what you know and build a thriving community around your passion while creating additional streams of revenue.')); ?></p>
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
</section>
<?php endif; ?>

<?php if (get_theme_mod('breogan_stats_enable', true)) : ?>
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <?php for ($i = 1; $i <= 3; $i++) : ?>
                <div class="stats-card stats-card-<?php echo $i; ?>">
                    <div class="stats-icon">
                       <i class="fas <?php echo esc_attr(get_theme_mod("breogan_stat{$i}_icon", "fa-users")); ?>"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number"><?php echo esc_html(get_theme_mod("breogan_stat{$i}_number", "00")); ?></div>
                        <div class="stat-label"><?php echo esc_html(get_theme_mod("breogan_stat{$i}_label", "Default Label")); ?></div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        <?php if (get_theme_mod('breogan_features_enable', true)) : ?>
        <div class="features-grid">
            <?php for ($i = 1; $i <= 3; $i++) : ?>
                <div class="feature-item feature-item-<?php echo $i; ?>">
                    <div class="features-icon">
                        <i class="fas <?php echo esc_attr(get_theme_mod("breogan_feature{$i}_icon", "fa-users")); ?>"></i>
                    </div>
                    <h3 class="feature-title"><?php echo esc_html(get_theme_mod("breogan_feature{$i}_title", "Feature Title")); ?></h3>
                    <p class="feature-description"><?php echo esc_html(get_theme_mod("breogan_feature{$i}_description", "Feature Description")); ?></p>
                </div>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<?php if (get_theme_mod('breogan_courses_enable', true)) : ?>
<section class="courses-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?php echo esc_html(get_theme_mod('breogan_courses_title', 'Top Courses')); ?></h2>
            <p class="section-description"><?php echo esc_html(get_theme_mod('breogan_courses_description', 'Browse our most popular online courses with experienced instructors.')); ?></p>
        </div>
        
        <div class="courses-grid">
            <?php
            // Determinar la fuente de los cursos
            $courses_source = get_theme_mod('breogan_courses_source', 'custom');
            
            if ($courses_source === 'cpt') {
                // Obtener cursos del Custom Post Type
                $args = array(
                    'post_type'      => 'curso',
                    'posts_per_page' => get_theme_mod('breogan_courses_count', 5),
                );
                
                // Añadir ordenación
                $orderby = get_theme_mod('breogan_courses_orderby', 'date');
                if ($orderby === 'featured') {
                    $args['meta_key'] = '_featured_curso';
                    $args['meta_value'] = 'yes';
                    $args['orderby'] = 'meta_value date';
                } else {
                    $args['orderby'] = $orderby;
                }
                
                $courses_query = new WP_Query($args);
                
                if ($courses_query->have_posts()) :
                    while ($courses_query->have_posts()) : $courses_query->the_post();
                        
                        // Obtener metadatos del curso
                        $price = get_post_meta(get_the_ID(), '_curso_price', true);
                        $instructor = get_post_meta(get_the_ID(), '_curso_instructor', true);
                        
                        // Obtener términos de la taxonomía para la etiqueta
                        $categories = get_the_terms(get_the_ID(), 'categoria_curso');
                        $category_name = !empty($categories) ? $categories[0]->name : 'Curso';
                        
                        ?>
                        <div class="course-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', array('class' => 'course-image')); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/course-placeholder.jpg'); ?>" alt="<?php the_title_attribute(); ?>" class="course-image">
                            <?php endif; ?>
                            
                            <div class="course-content">
                                <span class="course-tag"><?php echo esc_html($category_name); ?></span>
                                <h3 class="course-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="course-meta">
                                    <div class="instructor">
                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/instructor-placeholder.jpg'); ?>" alt="Instructor" class="instructor-image">
                                        <span class="instructor-name"><?php echo esc_html($instructor); ?></span>
                                    </div>
                                    <div class="course-price"><?php echo esc_html($price ? '€' . $price : 'Gratis'); ?></div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p class="no-courses">No se encontraron cursos.</p>';
                endif;
            } else {
                // Mostrar cursos personalizados
                // Curso 1
                $course1_title = get_theme_mod('breogan_custom_course1_title', 'Recursos Financieros');
                $course1_category = get_theme_mod('breogan_custom_course1_category', 'Negocio');
                $course1_instructor = get_theme_mod('breogan_custom_course1_instructor', 'María R.');
                $course1_price = get_theme_mod('breogan_custom_course1_price', '97');
                $course1_image = get_theme_mod('breogan_custom_course1_image', '');
                
                if (empty($course1_image)) {
                    $course1_image = get_template_directory_uri() . '/assets/images/course1.jpg';
                }
                
                ?>
                <div class="course-card">
                    <img src="<?php echo esc_url($course1_image); ?>" alt="<?php echo esc_attr($course1_title); ?>" class="course-image">
                    <div class="course-content">
                        <span class="course-tag"><?php echo esc_html($course1_category); ?></span>
                        <h3 class="course-title"><?php echo esc_html($course1_title); ?></h3>
                        <div class="course-meta">
                            <div class="instructor">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/instructor1.jpg'); ?>" alt="Instructor" class="instructor-image">
                                <span class="instructor-name"><?php echo esc_html($course1_instructor); ?></span>
                            </div>
                            <div class="course-price">$<?php echo esc_html($course1_price); ?></div>
                        </div>
                    </div>
                </div>
                
                <?php
                // Curso 2
                $course2_title = get_theme_mod('breogan_custom_course2_title', 'Fundamentos Del Marketing Digital');
                $course2_category = get_theme_mod('breogan_custom_course2_category', 'Marketing');
                $course2_instructor = get_theme_mod('breogan_custom_course2_instructor', 'José M.');
                $course2_price = get_theme_mod('breogan_custom_course2_price', '89');
                $course2_image = get_theme_mod('breogan_custom_course2_image', '');
                
                if (empty($course2_image)) {
                    $course2_image = get_template_directory_uri() . '/assets/images/course2.jpg';
                }
                
                ?>
                <div class="course-card">
                    <img src="<?php echo esc_url($course2_image); ?>" alt="<?php echo esc_attr($course2_title); ?>" class="course-image">
                    <div class="course-content">
                        <span class="course-tag"><?php echo esc_html($course2_category); ?></span>
                        <h3 class="course-title"><?php echo esc_html($course2_title); ?></h3>
                        <div class="course-meta">
                            <div class="instructor">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/instructor2.jpg'); ?>" alt="Instructor" class="instructor-image">
                                <span class="instructor-name"><?php echo esc_html($course2_instructor); ?></span>
                            </div>
                            <div class="course-price">$<?php echo esc_html($course2_price); ?></div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>