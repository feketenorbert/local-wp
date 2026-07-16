<?php 

// ══════════════════════════════════════════
// 1. CPT - CARS 
// ══════════════════════════════════════════

function cars_register_cpt(){
    $labels =[
        "name" => __("Masini", "hello-elementor-child"),
        "singular_name" => __("Masina", "hello-elementor-child"),
        "add_new" => __( "Adaugă Masina", "hello-elementor-child"),
        "add_new_item" => __( "Adaugă Masina Nouă", "hello-elementor-child"),
        "edit_item" => __( "Editează Masina", "hello-elementor-child"),
        "view_item" => __( "Vezi Masina", "hello-elementor-child"),
        "all_items"          => __( "Toate Masinile", "hello-elementor-child"),
        "search_items"       => __( "Caută Masini", "hello-elementor-child"),
        "not_found"          => __( "Nicio masina găsită", "hello-elementor-child"),
    ];

    $args = [
        "labels" => $labels,
        "public" => true,
        "show_in_menu" => true,
        "menu_icon" => "dashicons-car",
        "supports" => ["title", "editor", "thumbnail", "excerpt"],
        "has_archive" => true,
        "rewrite"       => [ "slug" => "masini" ],
        "show_in_rest"  => true,   // activează Gutenberg editor
    ];

    register_post_type("masina", $args);
}
add_action( "init", "cars_register_cpt" );

// ══════════════════════════════════════════
// 2. CPT - MARCA
// ══════════════════════════════════════════

function cars_register_taxonomy_marca(){
    $labels = [
        "name"              => __( "Marca Masini", "hello-elementor-child"),
        "singular_name"     => __( "Marca", "hello-elementor-child"),
        "all_items"         => __( "Toate Marcile", "hello-elementor-child"),
        "edit_item"         => __( "Editează Marca", "hello-elementor-child"),
        "add_new_item"      => __( "Adaugă Marca", "hello-elementor-child"),
    ];

    $args = [
        "labels"       => $labels,
        "hierarchical" => true,    // true = se comportă ca o categorie (nu tag)
        "public"       => true,
        "rewrite"      => [ "slug" => "marca" ],
        "show_in_rest" => true,
    ];

    register_taxonomy( "marca", "masina", $args );
}
add_action( "init", "cars_register_taxonomy_marca" );
