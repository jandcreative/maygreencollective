<?php

/* Setup */
if(!function_exists('maygreen_support')):

	function maygreen_support() {

		// Add support for block styles.
		add_theme_support('wp-block-styles');

		add_theme_support('align-wide');

        add_theme_support('woocommerce');

		// Enqueue editor styles.
		add_editor_style('style.css');

        register_nav_menus(
			array(
				'primary' => __('Menu Top', 'maygreen'),
			)
		);

        register_nav_menus(
			array(
				'icons' => __('Menu Icons', 'maygreen'),
			)
		);

        register_nav_menus(
			array(
				'mobile' => __('Menu Mobile', 'maygreen'),
			)
		);

        register_nav_menus(
			array(
				'secondary' => __('Menu Footer', 'maygreen'),
			)
		);
        
		register_nav_menus(
			array(
				'legal' => __('Menu Legal', 'maygreen'),
			)
		);
	}

endif;

add_action('after_setup_theme', 'maygreen_support');

function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyBjmxTJ_HAsZ_kOpR7bUbvmpT2hd-yNkhw';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


function add_file_types_to_uploads($file_types) {
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes);
	return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');

add_filter( 'acf/admin/prevent_escaped_html_notice', '__return_true' );


/* Add styles */
function maygreen_enqueue_style() {
	wp_enqueue_style('maygreen-style', get_stylesheet_uri(), 1.0, 'all');
	wp_enqueue_script('script', get_template_directory_uri() . '/js/menu.js', ['jquery']);
	wp_enqueue_script('nav', get_template_directory_uri() . '/js/nav.js', ['jquery']);
	wp_enqueue_script('scroll-reveal', get_template_directory_uri() . '/js/reveal.js');
}

add_action('wp_enqueue_scripts', 'maygreen_enqueue_style');


add_filter('block_categories_all', 'custom_block_category', 10, 2);
function custom_block_category($categories)
{

	array_unshift(
		$categories,
		array(
			'slug' => 'maygreen_block_category',
			'title' => 'May Green'
		)
	);

	return $categories;
}

/* Entradas relacionadas */

function mostrar_entradas_relacionadas(){

    // Obtener categorías de la entrada actual
    $categorias = wp_get_post_terms(get_the_ID(), 'categorias_talleres'); 
        
    // Obtén los IDs de las categorías
    $categorias_ids = wp_list_pluck($categorias, 'term_id');
    
    // Verifica si hay categorías asociadas
    if (!empty($categorias_ids)) {
        // Configura los argumentos para la consulta
        $query_args = array(
            'post_type'      => 'taller', // Especificar el CPT
            'posts_per_page' => 3,         // Limitar a 3 talleres relacionados
            'post__not_in'   => array(get_the_ID()),
            'orderby' => 'rand',  // Excluir el post actual
            'tax_query'      => array(
                array(
                    'taxonomy' => 'categorias_talleres', // Usar la taxonomía personalizada
                    'field'    => 'term_id',
                    'terms'    => $categorias_ids, // Filtrar por los IDs de las categorías
                ),
            ),
        );

        $related_posts = new WP_Query($query_args);

        // Comprueba si hay talleres relacionados y muéstralos
        if ($related_posts->have_posts()) {
            echo '<section class="cursos-relacionadas">
			        <h2>Otros talleres relacionados</h2>
		                <div class="background-relacionados">
				            <div class="container">
                                <div class="talleres-relacionados">';
                                while ($related_posts->have_posts()) {
                                    $related_posts->the_post();
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
                                            <h3><?php the_title(); ?></h3>
                                            <?php the_excerpt(); ?>
                                            <a href="<?php the_permalink(); ?>" class="button">INSCRÍBETE</a>
                                        </div>
                                </article>
                                <?php
            }
            echo '</div></div></div></section>';
            wp_reset_postdata();
        } else {
            echo '<p>No se encontraron talleres relacionados.</p>';
        }
    } else {
        echo '<p>Este taller no tiene categorías asociadas.</p>';
    }}

/* Admin */
function custom_login_logo() {
    echo '<style type="text/css">

		body.login {
			background-color: #F4F3E7;
		}
			
        .login .wp-login-logo a {
			background-image: url("https://www.maygreencollective.es/wp-content/uploads/img_logo_maygreencollective.svg") ; // Your Logo Here
			background-position: center center;
			background-size: contain;
			width: 100%;
        }

		.wp-core-ui .button-primary {
			background: #124737;
			border-color: #124737;
			color: #fff;
			text-decoration: none;
			text-shadow: none;
		}
		
    </style>';
}

add_action('login_head', 'custom_login_logo');

function login_url(){
return "https://www.maygreencollective.es/"; // Your URL Here
}
add_filter('login_headerurl', 'login_url');

// Añadir paleta colores personalizada en Gutenberg
function enable_custom_color_palette_gutenberg() {
    add_theme_support(
        'editor-color-palette',
        [
            [
                'name'  => esc_html__( 'Accent', 'maygreen' ),
                'slug'  => 'accent',
                'color' => '#124737',
            ],
            [
                'name'  => esc_html__( 'Skin', 'maygreen' ),
                'slug'  => 'soft',
                'color' => '#F4F3E7',
            ],
			[
                'name'  => esc_html__( 'Black', 'maygreen' ),
				'slug'  => 'black',
                'color' => '#000',
            ],
			[
                'name'  => esc_html__( 'White', 'maygreen' ),
				'slug'  => 'white',
                'color' => '#fff',
            ],
        ]
    );
}

add_action( 'after_setup_theme', 'enable_custom_color_palette_gutenberg' );

/* Formulario Gravity Forms - Fecha Talleres */

add_filter('gform_field_value_acf_field', 'populate_acf_field');
function populate_acf_field($value) {
    // Reemplaza con la función adecuada para obtener el valor del campo ACF
    // y asegúrate de usar el post ID correcto.
    $post_id = get_the_ID(); // Obtiene el ID de la publicación actual.
    $acf_field_value = get_field('fecha', $post_id); // Cambia 'nombre_del_campo_acf' por el nombre de tu campo ACF.
    
    return $acf_field_value;
}

/* Options Page */

if(function_exists('acf_add_options_page')) {

	acf_add_options_page(
		array(
			'page_title' => 'General Block Settings',
			'menu_title' => 'General Customization',
			'menu_slug' => 'theme-general-settings',
			'capability' => 'edit_posts',
			'redirect' => false
		)
	);
    
    acf_add_options_sub_page(
		array(
			'page_title' => 'Theme Header Settings',
			'menu_title' => 'Header',
			'parent_slug' => 'theme-general-settings',
		)
	);

    acf_add_options_sub_page(
		array(
			'page_title' => 'Theme Footer Settings',
			'menu_title' => 'Footer',
			'parent_slug' => 'theme-general-settings',
		)
	);

}

add_filter( 'gform_enqueue_scripts', '__return_false' );


/* WooCommerce */

add_action( 'after_setup_theme', 'enable_wc_gallery_features' );
function enable_wc_gallery_features() {
    add_theme_support( 'wc-product-gallery-slider' ); // Activa el slider con flechas
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
}

function move_product_meta_before_title() {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 ); // Elimina la meta original
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 4); // La coloca antes del título
}
add_action( 'wp', 'move_product_meta_before_title' );

/* Price */
function show_review_count_after_price() {
    global $product;

    // 🔹 Contador de reseñas
    $review_count = $product->get_review_count();
    
    echo '<div class="product-review-count">';
    echo '<strong>Reseñas:</strong> ' . $review_count . ' valoraciones';
    echo '</div>';
}
add_action( 'woocommerce_single_product_summary', 'show_review_count_after_price', 10 ); // Justo después del precio

/* Order Price */
function show_product_collection_after_price() {
    global $product;

    // Obtiene las colecciones asignadas al producto
    $terms = get_the_terms( $product->get_id(), 'coleccion' );

    if ( $terms && ! is_wp_error( $terms ) ) {
        echo '<div class="product-collection">COLECCIÓN';
        $collections = array();

        foreach ( $terms as $term ) {
            $collections[] = '<a href="' . get_term_link( $term ) . '">' . esc_html( $term->name ) . '</a>';
        }

        echo implode( ', ', $collections ) . '</div>';
    }
}
add_action( 'woocommerce_single_product_summary', 'show_product_collection_after_price', 11 );


// Reemplazar la descripción corta con la descripción larga en la ficha del producto
function custom_woocommerce_product_description() {
    global $product;

    // Obtener la descripción larga del producto
    $long_description = apply_filters( 'the_content', $product->get_description() );

    echo '<div class="woocommerce-product-details__long-description">';
    echo $long_description;
    echo '</div>';
}
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 ); // Elimina la descripción corta
add_action( 'woocommerce_single_product_summary', 'custom_woocommerce_product_description', 20 ); // Muestra la descripción larga en su lugar

// Eliminar las pestañas de WooCommerce
function remove_product_tabs( $tabs ) {
    // Elimina todas las pestañas
    unset( $tabs['description'] );   // Descripción
    unset( $tabs['additional_information'] ); // Información adicional
    
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'remove_product_tabs', 98 );


// Desactivar el sidebar en la página de productos de WooCommerce
function remove_woocommerce_sidebar() {
    if ( is_shop() || is_product_category() || is_product_tag() || is_tax( 'coleccion' ) || is_product() ) {
        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
    }
}
add_action( 'template_redirect', 'remove_woocommerce_sidebar' );


// Cambiar el texto de "Productos Relacionados"
function custom_woocommerce_related_products_title( $title ) {
    if ( is_product() ) {
        $title = 'También te recomendamos:'; // Cambiar por el texto deseado
    }
    return $title;
}
add_filter( 'woocommerce_product_related_products_heading', 'custom_woocommerce_related_products_title' );


function custom_related_products_title() {
    echo '<h3 class="woocommerce-loop-product__title">' . get_the_title() . '</h3>';
}

// Quitamos el título original (general para todos los productos)
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

// Agregamos el nuevo título SOLO en productos relacionados
add_action( 'woocommerce_shop_loop_item_title', 'custom_related_products_title', 10 );


/* Filtrado de Categeoria */
function filter_products_by_tag_category($query) {
    if (!is_admin() && $query->is_main_query()) {
        // Comprobar si estamos en una tienda o categoría de productos
        if (is_product_category() || is_shop()) {
            // Obtener la categoría actual
            $current_category = get_queried_object();
            if (isset($_GET['filter_tag']) && !empty($_GET['filter_tag'])) {
                $tag_slug = sanitize_text_field($_GET['filter_tag']);
                $query->set('tax_query', array(
                    array(
                        'taxonomy' => 'product_tag',
                        'field'    => 'slug',
                        'terms'    => $tag_slug,
                    ),
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'id',
                        'terms'    => $current_category->term_id,
                        'operator' => 'IN',
                    ),
                ));
            } else {
                // Si no hay etiqueta seleccionada, solo mostramos los productos de la categoría
                $query->set('tax_query', array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'id',
                        'terms'    => $current_category->term_id,
                        'operator' => 'IN',
                    ),
                ));
            }
        }
    }
}
add_action('pre_get_posts', 'filter_products_by_tag_category');

remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);


// Filtrar productos sin precio en todas las páginas de WooCommerce
function ocultar_productos_sin_precio( $query ) {
    // Verificar si estamos en la página de WooCommerce (tienda, categoría, o producto individual)
    if ( ! is_admin() && $query->is_main_query() && ( is_shop() || is_product_category() || is_product() || is_archive() ) ) {
        // Filtrar productos sin precio
        $meta_query = $query->get( 'meta_query', array() );
        
        // Añadir condición para excluir productos sin precio
        $meta_query[] = array(
            'key'     => '_price',
            'value'   => 0,
            'compare' => '>',
        );
        
        $query->set( 'meta_query', $meta_query );
    }
}
add_action( 'pre_get_posts', 'ocultar_productos_sin_precio' );

/* Quitamos los decimales para los numeros enteros */
add_filter('woocommerce_price_trim_zeros', '__return_true');


/**
 * Modificar el número de columnas en la página de la tienda y categorías
 */
add_filter('loop_shop_columns', 'custom_loop_columns', 999);
function custom_loop_columns() {
    return 3; // Número de productos por fila
}

add_filter( 'loop_shop_per_page', 'mostrar_todos_los_productos', 20 );
function mostrar_todos_los_productos( $productos_por_pagina ) {
    if ( is_product_category() ) {
        $productos_por_pagina = 9999; // Número alto para mostrar todos los productos
    }
    return $productos_por_pagina;
}

add_filter( 'gform_pre_render', 'aplicar_descuento_a_suscriptores' );
add_filter( 'gform_pre_validation', 'aplicar_descuento_a_suscriptores' );
add_filter( 'gform_pre_submission_filter', 'aplicar_descuento_a_suscriptores' );
add_filter( 'gform_admin_pre_render', 'aplicar_descuento_a_suscriptores' );


/* Descuento Suscriptores - 10% - Gravity forms */
function aplicar_descuento_a_suscriptores( $form ) {
    
    // Solo si el usuario está logueado y es suscriptor
    if ( is_user_logged_in() ) {
        $user = wp_get_current_user();
        if ( in_array( 'subscriber', (array) $user->roles ) ) {
            
            foreach ( $form['fields'] as &$field ) {
                // Verifica si es un campo de producto y aplica descuento
                if ( $field->type == 'product' && $field->inputType == 'singleproduct' ) {
                    $precio_original = floatval( $field->basePrice );
                    $nuevo_precio = $precio_original * 0.9; // 10% descuento
                    $field->basePrice = number_format( $nuevo_precio, 2, '.', '' );
                }
            }
        }
    }
    return $form;
}

/* Establece la URL de la página cuando el carrito está vacío */

add_filter('wpmenucart_emptyurl', 'custom_empty_cart_redirect');
function custom_empty_cart_redirect($empty_url) {
    return wc_get_cart_url(); // Redirige a la página del carrito
}

add_action( 'wp_footer', function() {
  if ( WC()->cart->is_empty() ) {
      echo '<style type="text/css">li.wpmenucartli a.wpmenucart-contents span.cartcontents{ display: none!important; }</style>';
  }
});

/* Mover Order Rating */
function custom_move_rating() {
    if ( is_product() ) {
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
        add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15 );
    }
}
add_action( 'wp', 'custom_move_rating' );

