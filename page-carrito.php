<?php 
/* Template Name: Página Carrito */ 
/* Template Post Type: post, page, product */
?>

<?php get_header(); ?>

<div id="page-wrapper">
    <main>
        <div class="intro-cart">
            <?php if (is_cart()): ?>
                <nav class="woocommerce-breadcrumb" aria-label="Breadcrumb"><a href="https://www.maygreencollective.es/">Inicio</a>&nbsp;/&nbsp;Carrito</nav>
            <?php elseif (is_checkout()): ?>
                <nav class="woocommerce-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo home_url(); ?>">Inicio</a>&nbsp;/&nbsp;<a href="<?php echo home_url('/carrito'); ?>">Volver al carrito</a>&nbsp;/&nbsp;Checkout</nav>
            <?php endif; ?>

            <h1><?php the_title()?></h1>
        </div>
        <?php the_content()?>
    </main>
</div>

<?php get_footer(); ?>

</body>
</html>