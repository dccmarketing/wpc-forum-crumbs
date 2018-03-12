<?php
/**
 * Plugin Name: 			WPC Forum Crumbs
 * Plugin URI: 				https://www.wpcdecatur.org
 * Description: 			Changes the site breadcrumbs in the Forums.
 * Author: 					dccmarketing
 * Author URI: 				https://www.demanddcc.com/
 * Version: 				1.0.0
 * License: 				GPL2+
 * License URI: 			http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @since 					1.0.0
 * @package 				wpcfc
 */

add_filter( 'bbp_before_get_breadcrumb_parse_args', 'wpcfc_breadcrumb_options' );
add_filter( 'bbp_breadcrumbs', 'wpcfc_test', 10, 1 );

/**
 * Remove breadcrumbs from BBPress Topic index view
 */
function wpcfc_breadcrumb_options() {

	// Home - default = true
	$args['include_home']    = false;

	// Forum root - default = true
	$args['include_root']    = false;

	// Current - default = true
	$args['include_current'] = false;

	return $args;

} // wpcfc_breadcrumb_options()

function wpcfc_test( $crumbs ) {

	$currentForumID = bbp_get_forum_id();

	// $metaArgs['meta_key'] 	= 'forum_id';
	// $metaArgs['meta_value'] = $currentForumID;
    //
    //
	// // $metaArgs['meta_key'] 					= 'forum_id';
	// // $metaArgs['meta_query'][0]['key'] 		= 'forum_id';
	// // $metaArgs['meta_query'][0]['value'] 	= $currentForumID;
    //
	// $results = new WP_Query( $metaArgs );




	$args = array(
		'meta_query' => array(
			array(
				'key'     => 'forum_id',
				'value'   => $currentForumID,
			),
		),
	);

	// The Query
	$query = new WP_Query( $args );

	wp_die( print_r( $query ) );



	// check post-meta table for a matching meta_value
	// if none, return $crumbs
	// If there is one, get the post_id
	// build new breadcrumbs from that post ID using get_ancestors

	//wp_die( print_r( $crumbs ) );

	return $crumbs;

} // wpcfc_test()
