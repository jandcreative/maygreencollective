<?php
/* Template Name: Page Socio */
/* Template Post Type: post, page, product */
?>

<?php get_header(); ?>

<div id="page-wrapper">

	<?php the_content(); ?>

</div>


<?php get_footer(); ?>


<script type="text/javascript" src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/js/accordion.js"></script>

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








