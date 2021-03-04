<?php get_header(); ?>

<main class="container">
  <?php /* <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
      <h1 class="display-4 fst-italic">Title of a longer featured blog post</h1>
      <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
      <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>
    </div>
  </div> */ ?>

  <div class="row">
    <div class="col-md-8">
      <?php /*<h3 class="pb-4 mb-4 fst-italic border-bottom">
        From the Firehose
      </h3>*/ ?>
	
	<?php
$args = array(
  'numberposts' => 10
);
 
$latest_posts = get_posts( $args );
//print_r($latest_posts);
?>
		
		<?php foreach ($latest_posts as $post) { ?>
      <article class="blog-post position-relative">
        <h2 class="blog-post-title"><?php echo $post->post_title; ?></h2>
		<div class="d-flex justify-content-between">
		<?php $category_detail = get_the_category($post->ID);//$post->ID
		//print_r($category_detail);
			foreach($category_detail as $category){ ?>
			<a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->cat_name;?></a> 
			<?php } ?>
        <p class="blog-post-meta"><?php echo get_the_time('F d, Y', $post->ID); ?></p>
		</div>

        <?php echo get_the_excerpt($post->ID); ?>
        <?php // echo $post->post_content; ?>
		<p class="text-end"><a href="<?php echo get_permalink($post->ID); ?>" class="stretched-link">Прочети още</a></p>
      </article><!-- /.blog-post -->

		<?php } // endforeach ?>

      <?php /* <nav class="blog-pagination" aria-label="Pagination">
        <a class="btn btn-outline-primary" href="#">Стари</a>
        <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Нови</a>
      </nav>*/ ?>

    </div>

    <?php get_sidebar(); ?>

  </div><!-- /.row -->

</main><!-- /.container -->

<?php get_footer(); ?>