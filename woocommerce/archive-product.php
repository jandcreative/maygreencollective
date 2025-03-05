<?php
defined( 'ABSPATH' ) || exit;

get_header( 'shop' ); ?>

<div class="container"> <!-- Contenedor principal -->

    <?php
    /**
     * Hook: woocommerce_before_main_content.
     * - Añade el breadcrumb y abre divs de estructura.
     */
    do_action( 'woocommerce_before_main_content' );
    ?>

    <div class="woocommerce-products-header">
        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
            <h1 class="woocommerce-products-header__title page-title">
                <?php woocommerce_page_title(); // Muestra el nombre de la categoría o "Tienda" ?>
            </h1>
        <?php endif; ?>

        <!-- Texto de introducción -->
        <p class="intro-categoria">
        Debido a nuestra filosofía de sostenibilidad, tenemos muy claro que menos es más, especialmente cuando se trata de moda. Las camisetas de algodón orgánico reflejan una estética limpia y sencilla, prot una experiencia de uso más cómoda y libre de complicaciones.
        </p>

      <!-- Filtrado por etiquetas -->
      <?php
        // Obtener la categoría actual
        $current_category = get_queried_object();
        $is_product_category = (isset($current_category->term_id) && $current_category->taxonomy === 'product_cat');

        if ($is_product_category) {
            // Obtener los productos dentro de la categoría actual
            $product_ids = get_posts(array(
                'post_type' => 'product',
                'posts_per_page' => -1, // Obtener todos los productos
                'fields' => 'ids', // Solo obtener los IDs de los productos
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'id',
                        'terms'    => $current_category->term_id,
                        'operator' => 'IN',
                    ),
                ),
            ));

            // Obtener las etiquetas asociadas a los productos obtenidos
            if (!empty($product_ids)) {
                $tags = get_terms(array(
                    'taxonomy'   => 'product_tag',
                    'hide_empty' => true,
                    'object_ids' => $product_ids, // Filtrar solo las etiquetas asociadas a los productos de esta categoría
                ));

                if (!empty($tags)) : ?>
                    <div class="categories">
                        <ul class="list-inline-remote">
                            <li class="all">
                                <?php
                                // Determinar el enlace base (tienda o categoría actual)
                                $base_url = get_term_link($current_category->term_id, 'product_cat');
                                ?>
                                <a href="<?php echo esc_url($base_url); ?>" class="<?php echo (!isset($_GET['filter_tag']) || empty($_GET['filter_tag'])) ? 'current' : ''; ?>">
                                    Ver todos
                                </a>
                            </li>

                            <?php
                            // Obtener la etiqueta seleccionada actualmente
                            $current_tag = isset($_GET['filter_tag']) ? sanitize_text_field($_GET['filter_tag']) : '';

                            foreach ($tags as $tag) :
                                $class = ($current_tag === $tag->slug) ? ' class="current"' : '';
                                
                                // Construir la URL con la etiqueta seleccionada
                                $tag_link = add_query_arg(array('filter_tag' => $tag->slug), $base_url);
                            ?>
                                <li>
                                    <a href="<?php echo esc_url($tag_link); ?>"<?php echo $class; ?>><?php echo esc_html($tag->name); ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif;
            }
        }
        ?>

    </div>


    <?php
    /**
     * Hook: woocommerce_before_shop_loop.
     * - Muestra avisos, conteo de productos y ordenación.
     */
    do_action( 'woocommerce_before_shop_loop' );

    if ( woocommerce_product_loop() ) {

        woocommerce_product_loop_start();

        if ( wc_get_loop_prop( 'total' ) ) {
            while ( have_posts() ) {
                the_post();

                /**
                 * Hook: woocommerce_shop_loop.
                 */
                do_action( 'woocommerce_shop_loop' );

                wc_get_template_part( 'content', 'product' );
            }
        }

        woocommerce_product_loop_end();

        /**
         * Hook: woocommerce_after_shop_loop.
         * - Agrega paginación.
         */
        do_action( 'woocommerce_after_shop_loop' );

    } else {
        /**
         * Hook: woocommerce_no_products_found.
         * - Muestra un mensaje si no hay productos.
         */
        do_action( 'woocommerce_no_products_found' );
    }

    /**
     * Hook: woocommerce_after_main_content.
     * - Cierra los divs de estructura.
     */
    do_action( 'woocommerce_after_main_content' );

    /**
     * Hook: woocommerce_sidebar.
     * - Muestra la barra lateral si el tema la tiene.
     */
    do_action( 'woocommerce_sidebar' );
    ?>

</div> <!-- Fin del contenedor -->

<?php get_footer( 'shop' ); ?>
