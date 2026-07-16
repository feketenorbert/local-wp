<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0' );

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function hello_elementor_child_scripts_styles() {

	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		HELLO_ELEMENTOR_CHILD_VERSION
	);

}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20 );


require_once get_stylesheet_directory() . '/inc/cpt.php';

add_shortcode('last_3_cars_shortcode', 'last_3_cars');

function last_3_cars() {
	// Query arguments to fetch the last 3 cars
	$args = array(
		'post_type' => 'masina',
		'posts_per_page' => 3,
		'orderby' => 'date',
		'order' => 'ASC',
	);

	// Query the posts
	$query = new WP_Query($args);

	// Output the posts
	if ($query->have_posts()) {
		echo '<ul class="last-3-cars">';
		while ($query->have_posts()) {
			$query->the_post();?>
			<div class="last-3-cars-items">
				<span class="last-3-cars-title"><?php the_title(); ?></span>
				<span class="last-3-cars-content"><?php the_content(); ?></span>
			</div>
			<?php
		}
		echo '</ul>';
	} else {
		echo 'No posts found.';
	}

	// Reset the post data
	wp_reset_postdata();

}
