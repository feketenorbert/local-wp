<?php
/**
 * Plugin Header Comment : is a comment that contains information about the plugin
 */
/**
 * Plugin Name: Norbert Plugin
 * Plugin URI: https://norbert-plugin.com
 * Description: A WordPress plugin for managing property listings and real estate content.
 * Version: 1.0.0
 * Author: Gorea Silviu
 * Author URI: https://norbert-plugin.com/authors/silviu-gorea
 * License: GPL v2 or laters
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: norbert-plugin
 * Domain Path: /lang
 */

// Exit if accessed directly
if (!defined("ABSPATH")) {
    exit();
}

/*
 * Define plugin constants
 */
define("NORBERT_PLUGIN_VERSION", "1.0.0");
define("NORBERT_PLUGIN_DIR", plugin_dir_path(__FILE__));
define("NORBERT_PLUGIN_URL", plugin_dir_url(__FILE__));

class norbertPlugin
{
    public function register()
    {
        add_action("init", [$this, "custom_post_tye"], 0); // $this means the current instance of the class, and we are calling the custom_post_tye method on that instance.
    }
    public function custom_post_tye()
        {
            // Register CUSTOM POST TYPE - Cars
            register_post_type("car", [
                "public" => true,
                "has_archive" => true,
                "rewrite" => ["slug" => "cars"], // ['slug' => 'properties']
                "label" => esc_html__("Car", "norbert-plugin"),
                "supports" => [
                    "title",
                    "editor",
                    "thumbnail",
                    "excerpt",
                    "custom-fields",
                ],
            ]);
            // Register CUSTOM TAXONOMY - Year
            $labels = [
                "name" => esc_html_x(
                    "Years",
                    "taxonomy general name",
                    "norbert-plugin",
                ),
                "singular_name" => esc_html_x(
                    "Year",
                    "taxonomy singular name",
                    "norbert-plugin",
                ),
                "search_items" => esc_html__("Search Years", "norbert-plugin"),
                "all_items" => esc_html__("All Years", "norbert-plugin"),
                "parent_item" => esc_html__("Parent Year", "norbert-plugin"),
                "parent_item_colon" => esc_html__(
                    "Parent Year:",
                    "norbert-plugin",
                ),
                "edit_item" => esc_html__("Edit Year", "norbert-plugin"),
                "update_item" => esc_html__("Update Year", "norbert-plugin"),
                "add_new_item" => esc_html__("Add New Year", "norbert-plugin"),
                "new_item_name" => esc_html__(
                    "New Year Name",
                    "norbert-plugin",
                ),
                "separate_items_with_commas" => esc_html__(
                    "Separate years with commas",
                    "norbert-plugin",
                ),
                "add_or_remove_items" => esc_html__(
                    "Add or remove years",
                    "norbert-plugin",
                ),
                "choose_from_most_used" => esc_html__(
                    "Choose from the most used years",
                    "norbert-plugin",
                ),
                "not_found" => esc_html__("No years found.", "norbert-plugin"),
                "menu_name" => esc_html__("Year", "norbert-plugin"),
            ];
            $args = [
                "hierarchical" => true,
                "show_ui" => true,
                "show_admin_column" => true,
                "query_var" => true,
                "rewrite" => ["slug" => "years"],
                "labels" => $labels,
            ];

            register_taxonomy("year", "car", $args);

            unset($labels);
            unset($args);
            // Register CUSTOM TAXONOMY - Property Type
            $labels = [
                "name" => esc_html_x(
                    "Types",
                    "taxonomy general name",
                    "norbert-plugin",
                ),
                "singular_name" => esc_html_x(
                    "Type",
                    "taxonomy singular name",
                    "norbert-plugin",
                ),
                "search_items" => esc_html__("Search Types", "norbert-plugin"),
                "all_items" => esc_html__("All Types", "norbert-plugin"),
                "parent_item" => esc_html__("Parent Type", "norbert-plugin"),
                "parent_item_colon" => esc_html__(
                    "Parent Type:",
                    "norbert-plugin",
                ),
                "edit_item" => esc_html__("Edit Type", "norbert-plugin"),
                "update_item" => esc_html__("Update Type", "norbert-plugin"),
                "add_new_item" => esc_html__("Add New Type", "norbert-plugin"),
                "new_item_name" => esc_html__("New Type Name", "norbert-plugin"),
                "separate_items_with_commas" => esc_html__(
                    "Separate types with commas",
                    "norbert-plugin",
                ),
                "add_or_remove_items" => esc_html__(
                    "Add or remove types",
                    "norbert-plugin",
                ),
                "choose_from_most_used" => esc_html__(
                    "Choose from the most used types",
                    "norbert-plugin",
                ),
                "not_found" => esc_html__("No types found.", "norbert-plugin"),
                "menu_name" => esc_html__("Type", "norbert-plugin"),
            ];
            $args = [
                "hierarchical" => true,
                "show_ui" => true,
                "show_admin_column" => true,
                "query_var" => true,
                "rewrite" => ["slug" => "type"],
                "labels" => $labels,
            ];

            register_taxonomy("property-type", "car", $args);
    }
    static function activation()
    {
        // Code to run on plugin activation
        flush_rewrite_rules();
    }
    static function deactivation()
    {
        // Code to run on plugin deactivation
        flush_rewrite_rules();
    }
}


if (class_exists("norbertPlugin")) {
    // initialize hooks
    $norbertPlugin = new norbertPlugin();
    $norbertPlugin->register();

    register_activation_hook(__FILE__, ["norbertPlugin", "activation"]);
    register_deactivation_hook(__FILE__, ["norbertPlugin", "deactivation"]);
}
