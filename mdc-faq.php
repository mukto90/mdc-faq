<?php
/*
Plugin Name: MDC FAQ
Description: MDC FAQ is an awesome plugin to create a Frequently Asked Questions for you website.
Plugin URI: https://wordpress.org/plugins/mdc-faq
Author: Nazmul Ahsan
Author URI: http://mukto.medhabi.com
Version: 1.0.0
*/

//	register post type mdc_faq
function mdc_register_faq_post_types(){
	$labels = array(
		'name'               => _x( 'FAQs', 'post type general name', 'mdc-faq' ),
		'singular_name'      => _x( 'FAQ', 'post type singular name', 'mdc-faq' ),
		'menu_name'          => _x( 'FAQs', 'admin menu', 'mdc-faq' ),
		'name_admin_bar'     => _x( 'FAQ', 'add new on admin bar', 'mdc-faq' ),
		'add_new'            => _x( 'Add New', 'faq', 'mdc-faq' ),
		'add_new_item'       => __( 'Add New FAQ', 'mdc-faq' ),
		'new_item'           => __( 'New FAQ', 'mdc-faq' ),
		'edit_item'          => __( 'Edit FAQ', 'mdc-faq' ),
		'view_item'          => __( 'View FAQ', 'mdc-faq' ),
		'all_items'          => __( 'All FAQs', 'mdc-faq' ),
		'search_items'       => __( 'Search FAQs', 'mdc-faq' ),
		'parent_item_colon'  => __( 'Parent FAQs:', 'mdc-faq' ),
		'not_found'          => __( 'No FAQs found.', 'mdc-faq' ),
		'not_found_in_trash' => __( 'No FAQs found in Trash.', 'mdc-faq' )
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'faq' ),
		'capability_type'    => 'page',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor','thumbnail')
	);
	register_post_type( 'mdc_faq', $args );
}
add_action('init', 'mdc_register_faq_post_types');

//	change 'Enter Title Here' to something else.
function mdc_enter_title_here( $input ) {
    global $post_type;
    if( is_admin() && 'Enter title here' == $input && 'faq' == $post_type )
        return 'Enter Question here';
    return $input;
}
add_filter('gettext','mdc_enter_title_here');

//	create taxonomies.
function mdc_faq_taxonomy_register() {
	//	FAQ Categories, hierarchical
	$labels = array(
		'name'              => _x( 'FAQ Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'FAQ Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search FAQ Categories' ),
		'all_items'         => __( 'All Categories' ),
		'parent_item'       => __( 'Parent FAQ Category' ),
		'parent_item_colon' => __( 'Parent FAQ Category:' ),
		'edit_item'         => __( 'Edit FAQ Category' ),
		'update_item'       => __( 'Update FAQ Category' ),
		'add_new_item'      => __( 'Add New FAQ Category' ),
		'new_item_name'     => __( 'New FAQ Category Name' ),
		'menu_name'         => __( 'FAQ Category' ),
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'faq_category' ),
	);
	register_taxonomy( 'faq_category', array( 'mdc_faq' ), $args );

	//	Keywords, not hierarchical
	$labels = array(
		'name'                       => _x( 'Related Keywords', 'taxonomy general name' ),
		'singular_name'              => _x( 'Keyword', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Keywords' ),
		'popular_items'              => __( 'Popular Keywords' ),
		'all_items'                  => __( 'All Keywords' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Keyword' ),
		'update_item'                => __( 'Update Keyword' ),
		'add_new_item'               => __( 'Add New Keyword' ),
		'new_item_name'              => __( 'New Keyword Name' ),
		'separate_items_with_commas' => __( 'Separate keywords with commas' ),
		'add_or_remove_items'        => __( 'Add or remove keywords' ),
		'choose_from_most_used'      => __( 'Choose from the most used keywords' ),
		'not_found'                  => __( 'No keywords found.' ),
		'menu_name'                  => __( 'Keywords' ),
	);
	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'keyword' ),
	);
	register_taxonomy( 'keyword', 'mdc_faq', $args );
}
add_action( 'init', 'mdc_faq_taxonomy_register', 0 );