<?php
get_header();

global $wp_query;
?>

<main role="main">
	<section class="hero-taller">
		<div class="container">
			<h2><?php the_title(); ?></h2>
			<?php the_excerpt(); ?>

			<div class="thumb">
				<?php the_post_thumbnail(); ?>
			</div>
		</div>
		<div class="box-feature" style="background-color: var(--soft);">
			<div class="container">
				<div class="flex">

				</div>

			</div>
		</div>
	</section>

	<section id="post-<?php the_ID(); ?>">
		<div class="container">
			<?php
			the_content();
			?>

			<div class="form">
				<!--<?php echo $form_curso; ?> -->
			</div>
		</div>
	</section>
	<section class="cursos-relacionadas">
		<div class="container">
			<!-- <?php mostrar_entradas_relacionadas(); ?> -->
		</div>
	</section>
</main>

<?php get_footer();?>

</body>

</html>

<style>
	main {
		padding: 80px 0;
	}

	.hero-taller h1 {
		font-family: "Roboto Slab", serif;
		font-size: 60px;
		line-height: normal;
		color: var(--accent);
		margin-bottom: 0;
		padding-bottom: 0;
	}
</style>