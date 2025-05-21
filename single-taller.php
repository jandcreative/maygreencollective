<?php
get_header();

global $wp_query;


$html_curso = get_field('form_html_curso');

$selector_clase = get_field('tipo_clase');

$item_01 = get_field('fecha');
$item_01_curso = get_field('fecha_curso');

$item_02 = get_field('item_02');
$item_03 = get_field('item_03');

?>

<main role="main">
	<section class="hero-taller">
		<div class="container">
			<div class="cab-text">
				<h1><?php the_title(); ?></h1>
				<?php the_excerpt(); ?>
			</div>
			<div class="thumb">
				<?php the_post_thumbnail(); ?>
			</div>
		</div>
		<div class="box-feature" style="background-color: var(--soft);">
			<div class="container-feature">
				<div class="flex">

						<div class="item">
							<div class="icon">
								<img src="https://www.maygreencollective.es/wp-content/uploads/icon_schedule.svg">
							</div>
							<div class="text">
								<span>Horario:</span>
								<?php if ('taller' == $selector_clase): ?>
									<p><?php echo esc_html($item_01); ?></p>
									<?php else: ?>
									<p><?php echo esc_html($item_01_curso); ?></p>
								<?php endif; ?>
							</div>
						</div>

					<?php if (!empty($item_02['value'])): ?>
						<div class="item">
							<div class="icon">
								<img src="https://www.maygreencollective.es/wp-content/uploads/icon_time.svg">
							</div>

							<div class="text">
								<span>Duración:</span>
								<p><?php echo $item_02['value']; ?></p>
							</div>
						</div>
					<?php endif; ?>

					<?php if (!empty($item_03['value'])): ?>
						<div class="item">
							<div class="icon">
								<img src="https://www.maygreencollective.es/wp-content/uploads/icon_price.svg">
							</div>

							<div class="text">
								<span>Precio:</span>
								<p><?php echo $item_03['value']; ?>€/persona</p>
							</div>
						</div>
					<?php endif; ?>

				</div>

			</div>
		</div>
	</section>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<section id="post-<?php the_ID(); ?>" class="post">

				<div class="container">
					<?php
					$terms = get_the_terms(get_the_ID(), 'categorias_talleres');

					if ($terms && !is_wp_error($terms)) {
						foreach ($terms as $term) {
						echo '<div class="flex-category"><span>Categoría:</span> <span class="tag-post">' . esc_html($term->name) . '</span></div>';
						}
					}
					?>
				</div>

				<div class="container flex-form">

					<?php the_content(); ?>
					<div class="form">
						<?php echo $html_curso; ?>
					</div>
				</div>
			</section>
	<?php endwhile;
	endif; ?>

	<?php mostrar_entradas_relacionadas(); ?>

</main>

<?php get_footer(); ?>

<script>

document.addEventListener("DOMContentLoaded", function() {
    var campos = document.querySelectorAll(".only_read input"); // Selecciona todos los inputs dentro de elementos con la clase .only_read
    campos.forEach(function(campo) {
        campo.setAttribute("readonly", "readonly");
    });
});

</script>

</body>

</html>