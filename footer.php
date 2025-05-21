<footer>
	<div class="footer-nav">

	<div class="column">
			<?php the_field('text_social_media', 'options'); ?>
	</div>

	<div class="column">
	<h4>Categorías:</h4>
		<?php wp_nav_menu(
			array(
				'theme_location' => 'categorias',
				'container' => 'nav',
				'container_id' => 'enlace',
			)
		);
		?>
	</div>

	<div class="column">
	<h4>Ver también:</h4>
		<?php wp_nav_menu(
			array(
				'theme_location' => 'secondary',
				'container' => 'nav',
				'container_id' => 'enlace',
			)
		);
		?>
	</div>

	<div class="column">
	<h4>Legal:</h4>
		<?php wp_nav_menu(
			array(
				'theme_location' => 'legal',
				'container' => 'nav',
				'container_id' => 'enlace',
			)
		);
		?>
	</div>

	<div class="column">
		<?php the_field('html_social_media', 'options'); ?>

	</div>

	</div>

</footer>

<?php wp_footer() ?>

