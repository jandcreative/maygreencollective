<?php get_header(); ?>

<div id="page-wrapper" class="error-page">

	<div class="intro-error">
		<h1>Si estás perdido</h1>
		<p>Puedes volver a <a href="<?php bloginfo('url'); ?>">casa</a> o buscar algun producto</p>
		<?php echo do_shortcode('[fibosearch]'); ?>
	</div>

</div>

<?php get_footer(); ?>
</body>

</html>