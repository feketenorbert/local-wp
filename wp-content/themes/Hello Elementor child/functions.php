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

function books_cpt(){
	register_post_type('book', [
		'labels' => [
			'name'          => 'Books',
			'singular_name' => 'Book',
		],
		'public'            => true,
		'has_archive'       => true,
		'taxonomies' => ['genre', 'author', 'publication_year'],
	]);
}

add_action('init', 'books_cpt');

function books_taxonomies() {

    register_taxonomy('author', 'book', [
        'label'        => 'Authors',
        'hierarchical' => false,
        'public'       => true,
    ]);

	register_taxonomy('genre', 'book', [
        'label'        => 'Genre',
        'hierarchical' => true,
        'public'       => true,
    ]);

	register_taxonomy('publisher', 'book', [
        'label'        => 'Publisher',
        'hierarchical' => false,
        'public'       => true,
    ]);
}

add_action('init', 'books_taxonomies');