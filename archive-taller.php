<?php
get_header();

global $wp_query;
?>

<main role="main">

    <section class="wp-block-group container alignwide talleres">
        <div class="intro">
            <img src="https://jandcreative-dev.com/may_green_collective/wp-content/uploads/icon_maygreencollective_pink-1.svg">
            <h1>Descubre todos nuestros talleres artesanales<!-- <?php the_field('title_intro_interioristas', 'options'); ?> --></h1>
            <p>En <strong>May Green Collective</strong>, te invitamos a explorar el arte de crear con tus propias manos. Nuestros talleres están diseñados para conectar con la naturaleza, fomentar la creatividad y aprender técnicas artesanales sostenibles de la mano de expertos locales.</p>
            <p>Tanto si eres principiante como si ya tienes experiencia, encontrarás un espacio acogedor donde transformar materiales naturales en piezas únicas. Cada sesión es una oportunidad para compartir, aprender y desarrollar nuevas habilidades en un entorno colaborativo y respetuoso con el medio ambiente.</p>
            <p>¡Ven a descubrir todo lo que puedes crear y sé parte de la comunidad de <strong>May Green Collective</strong>!</p>
        </div>
    </section>

    <section class="layout-talleres">
        <div class="container">



            <div class="container-filter">

            <?php echo do_shortcode('[facetwp facet="listado"]'); ?>

            </div>
   
                <?php $args = array(
                    'post_type' => 'taller',
                    'post_status' => 'publish',
                    'meta_key'       => 'fecha',
                    'orderby'        => 'meta_value', 
                    'order'          => 'ASC', 
                );
                $query = new WP_Query($args);


                if ($query->have_posts()) { ?>

            <div class="facetwp-template talleres-list" >

                    <?php while ($query->have_posts()) {
                        $query->the_post();
                        ?>
                        <article>
                           
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
                                    <a href="<?php the_permalink(); ?>" class="button">INSCRÍBETE</a>
                                </div>
                           
                        </article>
                        <?php
			} ?>
		</div>
		<?php } else {
			// No se encontraron posts
			echo 'No hay eventos disponibles.';
		}

		// Restablecer Post Data
		wp_reset_postdata();
		?>
            <!-- 		<div class="block-espacer"></div> -->
        </div>
    </section>


      
    <section class="banner">
        <div class="hero-contact">
            <div class="container-contact">
                <h2>Conoce más sobre MayGreenCollective</h2>
                <a class="button" href="https://www.maygreencollective.es/#valores">Ver Valores</a>
            </div>
        </div>
    </section>

</main>


<!-- <script>
    document.addEventListener('facetwp-loaded', function() {
        if (!window.facetwpRefreshed) {
            setTimeout(function() {
                FWP.refresh();
                window.facetwpRefreshed = true;
            }, 500);
        }
    });
</script> -->

<?php
get_footer();
?>

</body>

</html>

<style>
    .container-filter {
    display: flex;
    gap: 12px 24px;
    position: relative;
    flex-wrap: wrap;
    padding-bottom: 40px;
}

</style>
