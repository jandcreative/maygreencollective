<?php
defined('ABSPATH') || exit;

get_header('shop'); ?>
<div id="page-wrapper">
    <div class="woocommerce-products-header-coleccion">
        <div class="container-coleccion">
            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                <h1 class="woocommerce-products-header__title page-title">
                        Colección <br><?php woocommerce_page_title(); // Muestra el nombre de la categoría o "Tienda" ?>
                </h1>
            <?php endif; ?>

            <div class="intro-coleccion">
            <?php 
            // Obtiene el ID de la categoría de producto actual
            $term = get_queried_object();
            $descripcion_coleccion = get_field('descripcion_taxonomia', $term); 

            // Si hay contenido en ACF, lo muestra; de lo contrario, usa un texto predeterminado.
            if ($descripcion_coleccion) {
                echo $descripcion_coleccion;
            }
            ?>
        </div>

        </div>
    </div>

    <div class="container">

        <?php
        do_action('woocommerce_before_main_content');

        if (woocommerce_product_loop()) {
            woocommerce_product_loop_start();

            while (have_posts()) {
                the_post();
                do_action('woocommerce_shop_loop');
                wc_get_template_part('content', 'product');
            }

            woocommerce_product_loop_end();
        } else {
            do_action('woocommerce_no_products_found');
        }

        do_action('woocommerce_after_main_content');
        do_action('woocommerce_sidebar');
        ?>
    </div>

    <section class="banner">
        <div class="hero-contact">
            <div class="container-contact">
                <h2>Conoce más sobre MayGreenCollective</h2>
                <a class="button" href="https://www.maygreencollective.es/sobre-nosotros/#valores">Ver Valores</a>
        </div>
    </section>
    </div>
<?php get_footer('shop'); ?>


