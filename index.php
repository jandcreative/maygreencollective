<?php get_header(); ?>

<div id="page-wrapper">

	<?php the_content(); ?>

</div>


<?php get_footer(); ?>
<!-- <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script> -->

<?php
// Verifica si el usuario está en un dispositivo móvil
if (!wp_is_mobile()) {
	// Si no es un dispositivo móvil, imprime el script
	?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
	<script type="text/javascript" src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/js/my-gsap.js"></script>

	<?php
}
?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
	// You can also pass an optional settings object
	// below listed default settingsb
	AOS.init({

		once: true, // whether animation should happen only once - while scrolling down
		disable: 'phone', // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
	});
</script>
</body>

</html>

<style>
@media only screen and (max-width: 480px) {
    .reveal-opacity {
        visibility: visible;
        -webkit-transform: none;
        transform: none;
        opacity: 1;
    }
}
</style>








