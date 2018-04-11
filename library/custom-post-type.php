<?php
/* helloworld Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 
*/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'helloworld_flush_rewrite_rules' );

// Flush your rewrite rules
function helloworld_flush_rewrite_rules() {
	flush_rewrite_rules();
}

// let's create the function for the custom type
function custom_post_example() { 
	// creating (registering) the custom type.
	register_post_type( 'custom_type', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Tests', 'helloworldtheme' ), /* This is the Title of the Group. Replace 'Tests' with the post-type name you require e.g. 'Projects' */
			'singular_name' => __( 'Test', 'helloworldtheme' ), /* This is the individual type */
			'all_items' => __( 'All Tests', 'helloworldtheme' ), /* the all items menu item */
			'add_new' => __( 'Add Test', 'helloworldtheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Test', 'helloworldtheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'helloworldtheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Test', 'helloworldtheme' ), /* Edit Display Title */
			'new_item' => __( 'New Test', 'helloworldtheme' ), /* New Display Title */
			'view_item' => __( 'View Test', 'helloworldtheme' ), /* View Display Title */
			'search_items' => __( 'Search Tests', 'helloworldtheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'helloworldtheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'helloworldtheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Tests around the world', 'helloworldtheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon'   => 'dashicons-groups', /* the icon for the custom post type menu https://developer.wordpress.org/resource/dashicons/#format-aside*/
			'rewrite'	=> array( 'slug' => 'test', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'tests', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'sticky')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'custom_type' );
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_example');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
	register_taxonomy( 'custom_cat', 
		array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Test Categories', 'helloworldtheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Test Category', 'helloworldtheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Test Categories', 'helloworldtheme' ), /* search title for taxomony */
				'all_items' => __( 'All Test Categories', 'helloworldtheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Test Categories', 'helloworldtheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Test Categories:', 'helloworldtheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Test Category', 'helloworldtheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Test Category', 'helloworldtheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Test Category', 'helloworldtheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Test Category', 'helloworldtheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'customs' ),
		)
	);

?>
