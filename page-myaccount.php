<?php
/* Template Name: Content - MiCuenta */
/* Template Post Type: post, page, product */
?>

<?php get_header(); ?>

	<div id="page-wrapper">
		<section class="content-account">
			<div class="intro">
				<h1><?php the_title()?></h1>
			</div>
			<div class="container-account">
				<div class="block-content">
					<?php the_content()?>
				</div>
			</div>
		</section>
	</div>

	<?php get_footer(); ?>

</body>
</html>
