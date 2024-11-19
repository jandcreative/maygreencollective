<?php

/* Setup */
if(!function_exists('maygreen_support')):

	function maygreen_support() {

		// Add support for block styles.
		add_theme_support('wp-block-styles');

		add_theme_support('align-wide');

		// Enqueue editor styles.
		add_editor_style('style.css');

		register_nav_menus(
			array(
				'primary' => __('Menu Top', 'maygreen'),
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


