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


/* function filtrar_productos_por_etiqueta($query) {
    if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_taxonomy() || is_tax('product_cat'))) {

        if (isset($_GET['filter_tag']) && !empty($_GET['filter_tag'])) {
            $query->set('tax_query', array(
                array(
                    'taxonomy' => 'product_tag',
                    'field'    => 'slug',
                    'terms'    => array(sanitize_text_field($_GET['filter_tag'])),
                    'operator' => 'IN',
                ),
            ));
        }
    }
}
add_action('pre_get_posts', 'filtrar_productos_por_etiqueta', 20); */


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


/*
function disable_custom_script_on_mobile() {
		if (wp_is_mobile()) {
			wp_dequeue_script('scroll-reveal');
		}
}
add_action('wp_enqueue_scripts', 'disable_custom_script_on_mobile', 99);
*/


add_filter('block_categories_all', 'custom_block_category', 10, 2);
function custom_block_category($categories)
{

	array_unshift(
		$categories,
		array(
			'slug' => 'maygreen_block_category',
			'title' => 'MayGreen'
		)
	);

	return $categories;
}

  // Obtén las categorías de la taxonomía personalizada 'categorias_talleres' del post actual
        
   
/* Mostrar talleres relacionados */
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
            echo '
            	<section class="cursos-relacionadas">
			        <h2>Otros talleres relaiconados</h2>
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
            echo '</div>				</div>
			</div>
	</section>';
            wp_reset_postdata();
        } else {
            echo '<p>No se encontraron talleres relacionados.</p>';
        }
    } else {
        echo '<p>Este taller no tiene categorías asociadas.</p>';
    }}


function custom_login_logo() {
    echo '<style type="text/css">

		body.login {
			background-color: #F4F3E7;
		}
	
    	.login .wp-login-logo a {
			background-image: url("https://jandcreative-dev.com/may_green_collective/wp-content/uploads/img_logo_maygreencollective.svg") ; // Your Logo Here
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

add_filter('facetwp_assets', '__return_true');


function login_url(){
return "http://maygreencollective.local/"; // Your URL Here
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

/* function register_taller_post_type() {
    $labels = [
        'name'                  => 'Talleres',
        'singular_name'         => 'Taller',
        'menu_name'             => 'Talleres',
        'name_admin_bar'        => 'Taller',
        'add_new'               => 'Añadir nuevo',
        'add_new_item'          => 'Añadir nuevo taller',
        'edit_item'             => 'Editar taller',
        'new_item'              => 'Nuevo taller',
        'view_item'             => 'Ver taller',
        'view_items'            => 'Ver talleres',
        'all_items'             => 'Todos los talleres',
        'search_items'          => 'Buscar talleres',
        'not_found'             => 'No se encontraron talleres',
        'not_found_in_trash'    => 'No se encontraron talleres en la papelera',
        'archives'              => 'Archivos de talleres',
        'attributes'            => 'Atributos de taller',
    ];

    $args = [
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => [
            'slug' => 'talleres',
            'with_front' => true,
        ],
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-art',
        'supports'              => ['title', 'editor', 'thumbnail', 'page-attributes'],
        'show_in_rest'          => true,
    ];

    register_post_type('taller', $args);
}
add_action('init', 'register_taller_post_type'); */

add_filter('gform_field_value_acf_field', 'populate_acf_field');
function populate_acf_field($value) {
    $post_id = get_the_ID(); // Obtén el ID de la publicación actual.

    // Verifica el formulario específico (ejemplo: ID del formulario es 5)
    if (rgget('form_id') == 10) { 
        // Usar el campo 'fecha_02' para este formulario
        $acf_field_value = get_field('fecha_curso', $post_id); 
    } else {
        // Usar el campo 'fecha' por defecto para otros formularios
        $acf_field_value = get_field('fecha', $post_id);
    }

    return $acf_field_value;
}

/* function check_and_update_workshop_status() {
    // Aquí debes ajustar 'fecha' al nombre exacto de tu campo ACF
    $args = array(
        'post_type'      => 'taller', // Tipo de publicación del taller
        'posts_per_page' => -1, // Obtener todas las publicaciones
        'post_status'    => 'publish', // Solo publicaciones publicadas
    );

    // Obtener todas las publicaciones de tipo 'taller' publicadas
    $talleres = new WP_Query($args);

    if ($talleres->have_posts()) {
        while ($talleres->have_posts()) {
            $talleres->the_post();

            // Obtener la fecha y hora del campo ACF 'fecha'
            $fecha_acf = get_field('fecha'); // Nombre del campo ACF de la fecha

            // Comprobar si el campo 'fecha' tiene un valor
            if ($fecha_acf) {
                // Convertimos la fecha ACF en un timestamp de UNIX
                $fecha_acf_timestamp = strtotime($fecha_acf);
                
                // Obtener la fecha y hora actuales (usando la zona horaria de WordPress)
                $fecha_actual_timestamp = current_time('timestamp'); // Fecha y hora actuales

                // Si la fecha ACF ya pasó (es menor que la fecha actual), cambiar el estado a "Borrador"
                if ($fecha_acf_timestamp < $fecha_actual_timestamp) {
                    // Actualizar el estado de la publicación a Borrador
                    $post_id = get_the_ID();
                    wp_update_post(array(
                        'ID' => $post_id,
                        'post_status' => 'draft', // Establecer como Borrador
                    ));
                }
            }
        }
        wp_reset_postdata();
    }
} */

add_filter('gform_pre_render', 'limit_entries_by_date_for_form');
add_filter('gform_pre_validation', 'limit_entries_by_date_for_form');
add_filter('gform_pre_submission_filter', 'limit_entries_by_date_for_form');
add_filter('gform_admin_pre_render', 'limit_entries_by_date_for_form');

function limit_entries_by_date_for_form($form) {
    // ID del formulario específico que quieres aplicar la limitación
    $form_id_to_limit = 2; // Cambia este número por el ID de tu formulario específico

    // Verificar si estamos trabajando con el formulario que queremos limitar
    if ($form['id'] != $form_id_to_limit) {
        return $form; // Si no es el formulario que queremos, no hacemos nada
    }

    // ID del campo de la fecha en tu formulario. Cambia 'fecha' por el nombre del campo exacto.
    $fecha_field_id = 27; // Cambia este número al ID del campo de fecha en tu formulario

    // Buscar el campo de fecha en el formulario
    $fecha_field = null;
    foreach ($form['fields'] as $field) {
        if ($field->id == $fecha_field_id) {
            $fecha_field = $field;
            break;
        }
    }

    if ($fecha_field) {
        // Si el campo de fecha existe, obtenemos la fecha seleccionada
        $fecha_value = rgpost('input_' . $fecha_field_id); // Obtiene el valor del campo de fecha

        // Si no se ha seleccionado una fecha, no hacemos nada
        if (empty($fecha_value)) {
            return $form;
        }

        // Convertir la fecha a un timestamp para comparación (asumimos que la fecha es en formato Y-m-d)
        $fecha_timestamp = strtotime($fecha_value);

        // Contar las entradas que ya se han registrado para esa fecha en el formulario
        $search_criteria = array(
            'status' => 'active', // Solo entradas activas
            'field_filters' => array(
                array(
                    'key'   => 'fecha', // El nombre del campo de fecha
                    'value' => $fecha_timestamp, // Comparamos con la fecha seleccionada
                ),
            ),
        );

        // Contamos las entradas con el campo de fecha específico
        $entry_count = GFAPI::count_entries($form['id'], $search_criteria);

        // Limitar a 5 entradas por fecha
        if ($entry_count >= 6) {
            // Si ya se han alcanzado las 5 entradas, desactivamos el formulario y mostramos el mensaje
            $form['fields'] = array(
                array(
                    'type'    => 'html',
                    'content' => '<p>Lo sentimos, las entradas para esta fecha ya están completas.</p>',
                ),
            );
            $form['button']['type'] = 'hidden'; // Ocultamos el botón de envío
        }
    }

    return $form;
}


// Hook para ejecutar la función periódicamente
add_action('check_and_update_workshop_status_cron', 'check_and_update_workshop_status');

if(function_exists('acf_add_options_page')) {

	acf_add_options_page(
		array(
			'page_title' => 'General Block Settings',
			'menu_title' => 'Footer',
			'menu_slug' => 'theme-general-settings',
			'capability' => 'edit_posts',
			'redirect' => false
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

function show_review_count_after_price() {
    global $product;

    // 🔹 Contador de reseñas
    $review_count = $product->get_review_count();
    
    echo '<div class="product-review-count">';
    echo '<strong>Reseñas:</strong> ' . $review_count . ' valoraciones';
    echo '</div>';
}
add_action( 'woocommerce_single_product_summary', 'show_review_count_after_price', 10 ); // Justo después del precio

/* // Modificar las clases de los precios regulares y rebajados
function custom_woocommerce_price_classes( $price, $product ) {
    // Si el producto está en oferta, se modifica la clase del precio rebajado
    if ( $product->is_on_sale() ) {
        // Agrega la clase 'sale-price' al precio rebajado
        $price = preg_replace( '/class="woocommerce-Price-amount/', 'class="woocommerce-Price-amount sale-price', $price );
    } else {
        // Agrega la clase 'regular-price' al precio normal
        $price = preg_replace( '/class="woocommerce-Price-amount/', 'class="woocommerce-Price-amount regular-price', $price );
    }
    return $price;
}
add_filter( 'woocommerce_get_price_html', 'custom_woocommerce_price_classes', 10, 2 ); */


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
    if ( is_shop() || is_product_category() || is_tax( 'coleccion' )  || is_product() ) {
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
