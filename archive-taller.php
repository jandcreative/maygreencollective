<?php
get_header();

global $wp_query;
?>

<main role="main">

    <section class="wp-block-group container alignwide talleres">
        <div class="intro">
            <img src="https://jandcreative-dev.com/may_green_collective/wp-content/uploads/icon_maygreencollective_pink-1.svg">
            <h1>Descubre todos nuestros talleres artesanales<!-- <?php the_field('title_intro_interioristas', 'options'); ?> --></h1>
            <p>Prepárate para un nuevo espacio en el corazón de Santa Cruz de Tenerife, donde moda, diseño y sostenibilidad se encuentran! En nuestro concept store, encontrarás productos locales y éticos, cuidadosamente seleccionados para un estilo de vida consciente.</p>
        </div>
    </section>

    <section class="layout-talleres">
        <div class="container">

            <!--     <div class="container-filter">
                    <?php echo do_shortcode('[facetwp facet="fecha"]'); ?>
                    <?php echo do_shortcode('[facetwp facet="ubicacin"]'); ?>
                    <?php echo do_shortcode('[facetwp facet="categories"]'); ?>
                    <?php echo do_shortcode('[facetwp facet="metodologia"]'); ?>
                    <?php echo do_shortcode('[facetwp facet="ponente"]'); ?>
            </div> -->
            <div class="talleres-list">
                <?php $args = array(
                    'post_type'      => 'taller', // Reemplaza 'tu_cpt' con el nombre de tu CPT
                    'posts_per_page' => -1,       // Mostrar todos los posts
                    'orderby'        => 'date',  // Ordenar por el título
                    'order'          => 'DESC',    // Orden ascendente (A a Z)
                );
                $query = new WP_Query($args);

                if ($query->have_posts()) { ?>
                    <?php
                    while (have_posts()) {
                        the_post();
                    ?>
                        <article>
                            <a href="<?php the_permalink(); ?>">
                                <div class="frame-image">
                                    <?php
                                    $terms = get_the_terms(get_the_ID(), 'categorias_talleres');

                                    if ($terms && !is_wp_error($terms)) {
                                        foreach ($terms as $term) {
                                            echo '<span class="tag">' . esc_html($term->name) . '</span>';
                                        }
                                    }
                                    ?>
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <div class="frame-content">
                                    <h2><?php the_title(); ?></h2>
                                    <?php the_excerpt(); ?>
                                    <a class="button">INSCRÍBETE</a>
                                </div>
                            </a>
                        </article>
                    <?php
                    }
                    ?>

                <?php
                }
                // Restaura la consulta global después de usar WP_Query
                wp_reset_postdata();
                ?>



            </div>
            <!-- 		<div class="block-espacer"></div> -->
        </div>
    </section>

    <section class="banner">
        <div class="hero-contact">
            <div class="container-contact">
                <h2>Conoce más sobre MayGreenCollective</h2>
                <a class="button" href="#">Ver Valores</a>
            </div>
        </div>
    </section>

</main>


<script>
    document.addEventListener('facetwp-loaded', function() {
        if (!window.facetwpRefreshed) {
            setTimeout(function() {
                FWP.refresh();
                window.facetwpRefreshed = true;
            }, 500);
        }
    });
</script>

<?php
get_footer();
?>

</body>

</html>
