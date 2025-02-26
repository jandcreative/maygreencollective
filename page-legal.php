<?php
/* Template Name: Content - Legal */
/* Template Post Type: post, page, product */
?>

<?php get_header(); ?>

	<div id="page-wrapper">
		<section class="content-legal">
			<div class="intro">
				<h1><?php the_title()?></h1>
			</div>
			<div class="container-legal">
				<div class="block-content">
					<?php the_content()?>
				</div>
			</div>
		</section>
	</div>

	<?php get_footer(); ?>

</body>
</html>
