<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
		integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Roboto+Serif:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&display=swap"
		rel="stylesheet">
	<link
		href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
		rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
	<link
		href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
		rel="stylesheet">
	<script>
		$(function () {
			$('a[href*="#"]:not([href="#"])').click(function () {
				if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
					if (target.length) {
						// Desplazar 100px por encima del objetivo
						$('html, body').animate({
							scrollTop: target.offset().top - 80 // Resta 100px a la posición 'top' del objetivo
						}, 1000);
						return false;
					}
				}
			});
		});
	</script>
	<?php wp_head(); ?>
	<?php
	// Verifica si el usuario está en un dispositivo móvil
	if (!wp_is_mobile()) {
		// Si no es un dispositivo móvil, imprime el script
		?>
		<script src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/js/reveal.js"></script>

		<?php
	}
	?>

</head>

<body id="top" <?php body_class(); ?>>
	<div class="full-menu">
		<?php wp_nav_menu(
			array(
				'theme_location' => 'mobile',
				'container' => 'nav',
				'container_id' => 'enlace',
			)
		);
		?>
	</div>
	<header id="header">

		<div class="marquee">
			<?php the_field('marquee_text', 'options'); ?>
		</div>

		<div id="header-nav" class="alignwide">

			<div class="nav-bar-left">
				<a href="<?php bloginfo('url'); ?>">
					<div class="logo"></div>
				</a>
				<div id="hamburguer" class="mobile">
					<div class="lines line-top"></div>
					<div class="lines line-mid"></div>
					<div class="lines line-bottom"></div>
				</div>
			</div>

			<div class="nav-bar">
				<div class="desktop-menu">
					<?php wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container' => 'nav',
							'container id' => 'nav',
						)
					);
					?>
				</div>

				<div class="icons-menu">

				   <!--  <div id="menu-item-fibosearch">
						Hola
					</div> -->

					<div class="search">
						<img src="http://maygreencollective.local/wp-content/uploads/icon_search.svg" alt="search">
					</div>

					<div class="account">
						<a href="https://www.maygreencollective.es/mi-cuenta/">
							<img src="https://www.maygreencollective.es/wp-content/uploads/icon_account.svg"
								alt="Mi Cuenta">
						</a>
					</div>
					<div class="carrito">
						<?php wp_nav_menu(
							array(
								'theme_location' => 'icons',
								'container' => 'nav',
								'container id' => 'nav',
							)
						);
						?>
					</div>
				</div>
			

		</div>

	</header>
	
	<div id="search-popup" style="display:none;">
	 	<div class="item-flex">
			<?php echo do_shortcode('[fibosearch]'); ?>
			<div class="close"><img src="http://maygreencollective.local/wp-content/uploads/icon_croix.svg"></div>
		</div>
	</div>

	<div class="overlay-menu"></div>
	<?php
	if (is_user_logged_in()) {
		$current_user = wp_get_current_user();
		$allowed_roles = array('customer', 'subscriber');
		if (array_intersect($allowed_roles, (array) $current_user->roles)) {
			// El usuario tiene al menos uno de los roles permitidos
			?>
			<div class="login-notice">
				<div class="usuario-logueado">
					<p>¡Hola, <?php echo esc_html($current_user->display_name); ?>!</p>
				</div>
			</div>
			<?php
		}
	}	
	?>
