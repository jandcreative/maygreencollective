<?php
get_header();

global $wp_query;


$html_curso = get_field('form_html_curso');


$item_01 = get_field('item_01');
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

				<?php if (!empty($item_01['value'])): ?>
					<div class="item">
						<div class="icon">
							<img src="http://maygreencollective.local/wp-content/uploads/icon_schedule.svg">
						</div>
						<div class="text">
							<span>Horario:</span>
							<p><?php echo $item_01['value'];?><!-- Primer miércoles de cada mes - 18:00h --></p>
						</div>
					</div>
				<?php endif; ?>

				<?php if (!empty($item_02['value'])): ?>
					<div class="item">
						<div class="icon">
							<img src="http://maygreencollective.local/wp-content/uploads/icon_time.svg">
						</div>

						<div class="text">
							<span>Duración:</span>
							<p><?php echo $item_02['value'];?></p>
						</div>
					</div>
				<?php endif; ?>

				<?php if (!empty($item_03['value'])): ?>
					<div class="item">
						<div class="icon">
							<img src="http://maygreencollective.local/wp-content/uploads/iocn_price.svg">
						</div>

						<div class="text">
							<span>Precio:</span>
							<p><?php echo $item_03['value'];?>€/persona</p>
						</div>
					</div>
				<?php endif; ?>

				</div>

			</div>
		</div>
	</section>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <section id="post-<?php the_ID(); ?>" class="post">
        <div class="container flex-form">
            <?php the_content(); ?>
            <div class="form">
                <?php echo $html_curso; ?>
            </div>
        </div>
    </section>
<?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>

</body>

</html>