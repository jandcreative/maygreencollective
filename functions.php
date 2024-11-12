<?php

/* Setup */
if(!function_exists('nivd_support')):

	function nivd_support() {

		// Add support for block styles.
		add_theme_support('wp-block-styles');

		add_theme_support('align-wide');

		// Enqueue editor styles.
		add_editor_style('style.css');

		register_nav_menus(
			array(
				'primary' => __('Menu Top', 'nivd'),
			)
		);
		register_nav_menus(
			array(
				'legal' => __('Menu Legal', 'nivd'),
			)
		);

	}

endif;

add_action('after_setup_theme', 'nivd_support');


function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyA-rJfouQ23ni_4QEHz9bnYqzq-bp1qNmg';
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
function nivd_enqueue_style() {
	wp_enqueue_style('nivd-style', get_stylesheet_uri(), 1.0, 'all');
	wp_enqueue_script('script', get_template_directory_uri() . '/js/menu.js', ['jquery']);
	wp_enqueue_script('nav', get_template_directory_uri() . '/js/nav.js', ['jquery']);
	wp_enqueue_script('scroll-reveal', get_template_directory_uri() . '/js/reveal.js');
}

add_action('wp_enqueue_scripts', 'nivd_enqueue_style');


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
			'slug' => 'nivd_block_category',
			'title' => 'NIVD'
		)
	);

	return $categories;
}

function custom_login_logo() {
    echo '<style type="text/css">
	
        .login h1 a {
			background-image: url(https://nivd.world/wp-content/uploads/logo_nivd.svg) ; // Your Logo Here
			background-position: center center;
			background-size: contain;
			width: 100%;
        }

		.wp-core-ui .button-primary {
			background: #FF5B22;
			border-color: #FF5B22;
			color: #fff;
			text-decoration: none;
			text-shadow: none;
		}
		
    </style>';
}


add_action('login_head', 'custom_login_logo');

function login_url(){
return "https://nivd.world/"; // Your URL Here
}
add_filter('login_headerurl', 'login_url');

// Añadir paleta colores personalizada en Gutenberg
function enable_custom_color_palette_gutenberg() {
    add_theme_support(
        'editor-color-palette',
        [
            [
                'name'  => esc_html__( 'Accent', 'nivd' ),
                'slug'  => 'orange',
                'color' => '#FF5B22',
            ],
            [
                'name'  => esc_html__( 'Skin', 'nivd' ),
                'slug'  => 'skin',
                'color' => '#FFE6DE',
            ],
            [
                'name'  => esc_html__( 'Skin Soft', 'nivd' ),
				'slug'  => 'skin-soft',
                'color' => '#FFEEED',
            ],
			[
                'name'  => esc_html__( 'Black', 'nivd' ),
				'slug'  => 'black',
                'color' => '#000',
            ],
			[
                'name'  => esc_html__( 'White', 'nivd' ),
				'slug'  => 'white',
                'color' => '#fff',
            ],
        ]
    );
}

add_action( 'after_setup_theme', 'enable_custom_color_palette_gutenberg' );


if(function_exists('acf_add_options_page')) {

	acf_add_options_page(
		array(
			'page_title' => 'General Block Settings',
			'menu_title' => 'Block Settings',
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


