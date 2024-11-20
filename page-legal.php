<?php
/* Template Name: Content - Legal */
/* Template Post Type: post, page, product */
?>

<?php get_header(); ?>

<div id="page-wrapper">

  <?php while (have_posts()):
    the_post(); ?>


    <section id="legal" class="legal">

      <div class="container">
        <h1 class="entry-title">
          <?php the_title(); ?>
        </h1>

        <div class="content">
          <?php the_content(); ?>
        </div>

      </div>

    </section>

  <?php endwhile; ?>

</div>

<?php get_footer(); ?>

</body>

</html>