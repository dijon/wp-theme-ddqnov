<?php
/**
 * Template Name: Search Page
 */

?>

<?php get_header(); ?>

<main class="container">

  <div class="row">
    <div class="col-md-8">

	<?php
$searchQuery = get_search_query();
$args = array(
                's' => $searchQuery,
            );
    // The Query
$results = new WP_Query( $args );
?>
		<h3>Резултати от търсенето</h3>

		<?php 
		if ( $results->have_posts() ) {
			while ( $results->have_posts() ) {
				$results->the_post();
				?>
      <article class="blog-post position-relative">
        <h2 class="blog-post-title"><?php echo the_title(); ?></h2>
		<div class="d-flex justify-content-between">
		<?php 
		$category_detail = get_the_category();
			foreach($category_detail as $category){ ?>
			<a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->cat_name;?></a> 
			<?php } ?>
        <p class="blog-post-meta"><?php the_date('F d, Y'); ?></p>
		</div>

        <?php the_excerpt(); ?>
        <?php // echo $post->post_content; ?>
		<p class="text-end"><a href="<?php the_permalink(); ?>" class="stretched-link">Прочети още</a></p>
      </article><!-- /.blog-post -->

		<?php } // endforeach 
		 }else{ ?>
			 <p>Не бяха открити резултати. </p>
		<?php } ?>

      <?php /* <nav class="blog-pagination" aria-label="Pagination">
        <a class="btn btn-outline-primary" href="#">Стари</a>
        <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Нови</a>
      </nav>*/ ?>

    </div>

    <?php get_sidebar(); ?>

  </div><!-- /.row -->

</main><!-- /.container -->

<?php get_footer(); ?>