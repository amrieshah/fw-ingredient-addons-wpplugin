<?php if ( !defined('FW') ) die('Forbidden');

/**
 * 
 * Author: amrieshah
 * Author URI: https://github.com/amrieshah
 * 
 */

/**
 * 
 * Define custom post type and taxonomies
 * 
 */

/**
 * Register an ingredient post type
 * 
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

$labels = array(
    'name' => _x( 'Ingredients', 'ingredient' ),
    'singular_name' => _x( 'Ingredient', 'ingredient' ),
    'add_new' => _x( 'Add New', 'ingredient', 'ingredients' ),
    'menu_name' => _x( 'Ingredient', 'admin menu', 'ingredients' ),
    'add_new_item' => _x( 'Add New Ingredient', 'ingredients' ),
    'edit_item' => _x( 'Edit Ingredient', 'ingredients' ),
    'new_item' => _x( 'New Ingredient', 'ingredients' ),
    'edit_item' => _x( 'Edit Ingredient', 'ingredients' )
);

$args = array(
    'labels' => $labels,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'publicly_queryable' => true,
    'capability_type' => 'post',
    'rewrite' => array( 'slug' => 'ingredient' ),
    'taxonomies' => array('post_tag'),
    'show_in_rest' => true,
    'supports' => array( 'title', 'thumbnail' )
);
register_post_type( 'ingredient', $args  );

/**
 * Register a type ingredient taxonomy
 * 
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */

$labels = array(
    'name'          => __('Ingredient Categories', 'ingredients'),
    'singular_name' => __('Category', 'ingredients'),
    'menu_name'     => __('Category', 'ingredients'),
    'all_items'     => __('All Categories', 'ingredients'),
    'edit_item'     => __('Edit Category', 'ingredients'),
    'view_item'     => __('View Category', 'ingredients'),
    'update_item'   => __('Update Category', 'ingredients'),
    'add_new_item'  => __('Add New Category', 'ingredients'),
    'new_item_name' => __('New Category Name', 'ingredients'),
);


$args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'show_admin_column'  => true,
    'show_in_nav_menus'  => true,
    'hierarchical'       => true,
    'query_var'          => true,
    'rewrite'            => array('slug' => 'ingredient-category'),
);
register_taxonomy('ingredient-category', 'ingredient', $args);

?>