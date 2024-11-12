<footer>
	<div class="footer-nav container">

		<div class="logo-footer">
			<img src="<?php the_field('logo_nivd_footer', 'options'); ?>">
		</div>

		<div class="links">
			<?php wp_nav_menu(
				array(
					'theme_location' => 'legal',
					'container' => 'nav',
					'container_id' => 'legal',
				)
			);
			?>
		</div>
	</div>

</footer>

<?php wp_footer() ?>