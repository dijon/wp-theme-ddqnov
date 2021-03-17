<?php
/**
* A Simple Category Template
*/
 
get_header(); ?> 

<main class="container">
    <div class="row">
        <div class="col-md-8">
	    <?php
		// Check if there are any posts to display
		if ( have_posts() ) : ?>
		    <h1 class="lead text-muted">Категория: <?php echo single_cat_title('', false); ?></h1>
		
		<?php
		// Display optional category description
		 if ( category_description() ) : ?>
		    <div class="archive-meta"><?php echo category_description(); ?></div>
		<?php endif; ?>

        <?php while ( have_posts() ) : the_post(); ?>
            <article class="blog-post position-relative">
                <h2 class="blog-post-title"><?php the_title(); ?></h2>
                <p class="blog-post-meta"><?php the_date('F d, Y'); ?></p>
                <?php the_excerpt(); ?>
                <p class="text-end"><a href="<?php the_permalink(); ?>" class="stretched-link">Прочети още</a></p>
            </article><!-- /.blog-post -->
        <?php endwhile; else: ?>
            <p>Няма още статии в тази категория.</p>
        <?php endif; ?>

            <!-- Add the pagination functions here. -->
            <?php ddqnov_pagination(); ?>
        </div>

        <?php get_sidebar(); ?>
    </div><!-- /.row -->
</main><!-- /.container -->

<?php get_footer(); ?>