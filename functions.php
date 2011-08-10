<?php

	 /*
     * Google Font for cursive header title. This will change for sure to make it easier for users to change. 
     */
add_action('wp_print_styles', 'add_googlefonts');
function add_googlefonts() {
        $givemetypography = 'http://fonts.googleapis.com/css?family=Lobster+Two&v2';
       
            wp_register_style('googlewebfonts', $givemetypography);
            wp_enqueue_style( 'googlewebfonts');
}

// special thanks to Less Framework (http://lessframework.com/)
function go_responsive() {
	?>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
	<?php 
}
add_action ( 'bp_head', 'go_responsive' );
		
function bp_dtheme_enqueue_styles() {
       //nothing to see here
}
add_action( 'wp_print_styles', 'bp_dtheme_enqueue_styles' );

    /*
     * LessCSS for easy color changes.  
     */
add_action('wp_print_styles', 'add_lesscss');
function add_lesscss() {

	wp_register_style('lesscss', get_bloginfo('stylesheet_directory') . '/css/styles.less');
	wp_enqueue_style( 'lesscss');
}

add_action('init', 'add_lesscssjs');
function add_lesscssjs() {
    wp_register_script( 'lesscssjs', get_bloginfo('stylesheet_directory') . '/js/less-1.1.3.min.js');
    wp_enqueue_script( 'lesscssjs' );

}    

// add rel="stylesheet/less" to any less stylesheet url
// from http://plugins.svn.wordpress.org/template-provisioning/tags/0.2.5/template-provisioning.php
add_filter('style_loader_tag', 'filter_style_link_tags_for_less_js', 10, 2);
function filter_style_link_tags_for_less_js($tag, $handle)
	{
  	global $wp_styles;
  	
  	// if the src ends in ".less", the rel attribute should be "stylesheet/less"
  	if (preg_match("/\.less$/", $wp_styles->registered[$handle]->src)) {
  	  $tag = preg_replace("/rel=(['\"])[^'\"]*(['\"])/", "rel=$1stylesheet/less$2", $tag);
  	}
  	
	  return $tag;
	}

// This is taken from bp-default. We don't need custom header image or background style options. 	
function bp_dtheme_setup() {
	global $bp;

	// Load the AJAX functions for the theme
	require( TEMPLATEPATH . '/_inc/ajax.php' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'buddypress' ),
	) );


	if ( !is_admin() ) {
		// Register buttons for the relevant component templates
		// Friends button
		if ( bp_is_active( 'friends' ) )
			add_action( 'bp_member_header_actions',    'bp_add_friend_button' );

		// Activity button
		if ( bp_is_active( 'activity' ) )
			add_action( 'bp_member_header_actions',    'bp_send_public_message_button' );

		// Messages button
		if ( bp_is_active( 'messages' ) )
			add_action( 'bp_member_header_actions',    'bp_send_private_message_button' );

		// Group buttons
		if ( bp_is_active( 'groups' ) ) {
			add_action( 'bp_group_header_actions',     'bp_group_join_button' );
			add_action( 'bp_group_header_actions',     'bp_group_new_topic_button' );
			add_action( 'bp_directory_groups_actions', 'bp_group_join_button' );
		}

		// Blog button
		if ( bp_is_active( 'blogs' ) )
			add_action( 'bp_directory_blogs_actions',  'bp_blogs_visit_blog_button' );
	}
}
add_action( 'after_setup_theme', 'bp_dtheme_setup' );

// Batten down the hatches, we're going full-width... there's got to be a better way to make the theme full-width, but this will work in the meantime. Everything below is just inserting divs to help style a full-width background. 
function div_bp_before_header() {
	?>
		<div id="bp_before_header" class="fullwidth">
	<?php 
}
add_action ( 'bp_before_header', 'div_bp_before_header' );

// close the bp_before_header div
function div_bp_after_header() {
	?>
		</div> 
	<?php
}
add_action ( 'bp_after_header', 'div_bp_after_header' );

// This could have gone in div_bp_after_header, but we might want to add something later.
function div_bp_before_container() {
	?>
		<div id="bp_before_container" class="fullwidth">
	<?php 
}
add_action ( 'bp_before_container', 'div_bp_before_container' );

// close the bp_before_container div
function div_bp_after_container() {
	?>
		</div> 
	<?php
}
add_action ( 'bp_after_container', 'div_bp_after_container' );

// Batten down the hatches, we're going full-width
function div_bp_before_footer() {
	?>
		<div id="bp_before_footer" class="fullwidth">
	<?php 
}
add_action ( 'bp_before_footer', 'div_bp_before_footer' );

// close the bp_before_footer div
function div_bp_after_footer() {
	?>
		</div> 
	<?php
}
add_action ( 'bp_after_footer', 'div_bp_after_footer' );


// Batten down the hatches, we're going full-width
function div_bp_before_activity_post_form() {
	?>
		<div id="bp_before_activity_post_form">
	<?php 
}
add_action ( 'bp_before_activity_post_form', 'div_bp_before_activity_post_form' );

// close the bp_before_activity_post_form div
function div_bp_after_activity_post_form() {
	?>
		</div> 
	<?php
}
add_action ( 'bp_after_activity_post_form', 'div_bp_after_activity_post_form' );

// Batten down the hatches, we're going full-width
function div_bp_before_member_header() {
	?>
		<div id="bp_before_member_header">
	<?php 
}
add_action ( 'bp_before_member_header', 'div_bp_before_member_header' );

// close the bp_before_member_header div
function div_bp_after_member_header() {
	?>
		</div> 
	<?php
}
add_action ( 'bp_after_member_header', 'div_bp_after_member_header' );


// Batten down the hatches, we're going full-width
function div_bp_before_group_header() {
	?>
		<div id="bp_before_group_header">
	<?php 
}
add_action ( 'bp_before_group_header', 'div_bp_before_group_header' );

// close the bp_before_group_header div
function div_bp_after_group_header() {
	?>
		</div> 
	<?php
}
add_action ( 'bp_after_group_header', 'div_bp_after_group_header' );

//site credits
add_filter('gettext', 'sitecredits', 20, 3);
/**
 * Edit the default credits to add Frisco link. Remove if you'd like. 
 *
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
function sitecredits( $translated_text, $untranslated_text, $domain ) {

    $custom_field_text = 'Proudly powered by <a href="%1$s">WordPress</a> and <a href="%2$s">BuddyPress</a>.';

    if ( $untranslated_text === $custom_field_text ) {
        return 'Proudly powered by <a href="http://wordpress.org">WordPress</a>, <a href="http://buddypress.org">BuddyPress</a> and the <a href="http://friscotheme.com/">Frisco Theme</a>.';
    }

    return $translated_text;
}

?>