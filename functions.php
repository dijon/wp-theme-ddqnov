<?php

add_theme_support('menus');

function wpb_ddqnov_menu() {
	register_nav_menus([
		'ddqnov-menu' => __('Ddqnov Menu'),
	]);
}
add_action('init', 'wpb_ddqnov_menu');

function image_tag_class($class) {
    $class .= ' img-fluid mx-auto d-block';
    return $class;
}
add_filter('get_image_tag_class', 'image_tag_class' );

// pagination function
function ddqnov_pagination() {
    global $wp_query;
    $big = 9999999; // need an unlikely integer
    $pages = paginate_links([
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'type' => 'array',
    ]);

    if(is_array($pages)) {
        echo '<nav><ul class="pagination">';
        foreach ( $pages as $page ) {
            echo "<li class=\"page-item\">". str_replace('class="', 'class="page-link ', $page) ."</li>";
        }
        echo '</ul></nav>';
    }
}

// fix pagination query if permalink is %category%/%postname%
function remove_page_from_query_string($query_string)
{
    if ($query_string['name'] == 'page' && isset($query_string['page'])) {
        unset($query_string['name']);
        $query_string['paged'] = $query_string['page'];
    }
    return $query_string;
}
add_filter('request', 'remove_page_from_query_string');