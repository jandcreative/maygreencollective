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
                <?php echo do_shortcode('[facetwp facet="fecha"]'); ?>
                <?php echo do_shortcode('[facetwp facet="categories"]'); ?>
                <?php echo do_shortcode('[facetwp submit="Filtrar"]'); ?>
            </div>
    
                <?php
                $args = array(
                    'post_type'      => 'taller', // Nombre del CPT
                    'posts_per_page' => -1,
                    'facetwp'	=> true,   
                    'post_status' => 'publish',   
                  /*   'orderby'        => 'date',  
                    'order'          => 'DESC',  */ 
                );
                $query = new WP_Query($args);

                if ($query->have_posts()) { ?>
            
            <div class="talleres-list facetwp-template">

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

            </div>
            <!-- 		<div class="block-espacer"></div> -->
        </div>
    </section>

    <section class="banner">
        <div class="hero-contact">
            <div class="container-contact">
                <h2>Conoce más sobre MayGreenCollective</h2>
                <a class="button" href="https://www.maygreencollective.es/sobre-nosotros/#valores">Ver Valores</a>
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

<style>
    .container-filter {
    display: flex
;
    gap: 12px 16px;
    position: relative;
    flex-wrap: wrap;
    padding-bottom: 5px;
    margin-bottom: 2em;
}

.facetwp-submit {
    background-color: #333;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-weight: bold;
}

.facetwp-facet.facetwp-facet-fecha.facetwp-type-date_range {
    display: flex;
    gap: 2em;
}

.facetwp-facet.facetwp-facet-fecha input {
    font-weight: bold;
    font-size: 18px;
    background-color: transparent !important;
}

.container-filter input {
    padding: 4px 14px;
    border-radius: 10px;
    border: 2px solid #404041;
    color: #404041;
    appearance: none;
    height: 43px;
}
</style>