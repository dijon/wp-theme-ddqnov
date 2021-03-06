<?php get_header(); ?>

<main class="container">
  <div class="row">
    <div class="col-md-8">
		<?php while ( have_posts() ) : the_post(); ?>
		<article class="blog-post">
			<h2 class="blog-post-title"><?php the_title();?></h2>
			<p class="blog-post-meta"><?php the_date('F d, Y'); ?></p>
			<?php the_content(); ?>
		</article><!-- /.blog-post -->
		<?php endwhile; ?>
    </div>

    <?php get_sidebar(); ?>

  </div><!-- /.row -->
</main><!-- /.container -->

<?php get_footer(); ?>