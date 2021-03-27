<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicon.png"/>

    <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link href="<?php echo get_template_directory_uri(); ?>/blog/blog.css" rel="stylesheet">
	
	<style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
	
    <title>ddqnov - Личен блог!</title>
  </head>
  <body>
  
  <div class="container">
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col">
        <a class="blog-header-logo text-dark" href="<?php echo get_home_url(); ?>">ddqnov.eu</a>
      </div>
      <div class="col d-flex justify-content-end align-items-center">
	   <?php get_search_form(); ?>
      </div>
    </div>
  </header>

  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
	<?php // We load the array of items in the variable $items
		$menuLocations = get_nav_menu_locations();
		$items = wp_get_nav_menu_items($menuLocations['ddqnov-menu']);

		// We check that the array is not empty 
		if( !empty( $items ) ): ?>

		<?php foreach ( $items as $item ): ?>
		<a class="p-2 link-secondary" href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a>
		<?php endforeach; ?>

		<?php else: ?> 
		<p class="msg msg--error">Няма добавени линкове или менюто 'ddqnov' не е добавено.</p>
	<?php endif; ?>
    </nav>
  </div>
</div>