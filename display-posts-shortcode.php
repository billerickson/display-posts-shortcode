<?php
/**
 * Plugin Name: Display Posts Shortcode
 * Plugin URI: http://www.billerickson.net/shortcode-to-display-posts/
 * Description: Display a listing of posts using the [display-posts] shortcode
 * Version: 1.9
 * Author: Bill Erickson
 * Author URI: http://www.billerickson.net
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package Display Posts
 * @version 1.8
 * @author Bill Erickson <bill@billerickson.net>
 * @copyright Copyright (c) 2011, Bill Erickson
 * @link http://www.billerickson.net/shortcode-to-display-posts/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 
 
/**
 * To Customize, use the following filters:
 *
 * `display_posts_shortcode_args`
 * For customizing the $args passed to WP_Query
 *
 * `display_posts_shortcode_output`
 * For customizing the output of individual posts.
 * Example: https://gist.github.com/1175575#file_display_posts_shortcode_output.php
 *
 * `display_posts_shortcode_wrapper_open` 
 * display_posts_shortcode_wrapper_close`
 * For customizing the outer markup of the whole listing. By default it is a <ul> but
 * can be changed to <ol> or <div> using the 'wrapper' attribute, or by using this filter.
 * Example: https://gist.github.com/1270278
 */ 
 
// Create the shortcode
add_shortcode( 'display-posts', 'be_display_posts_shortcode' );
function be_display_posts_shortcode( $atts ) {

	// Pull in shortcode attributes and set defaults
	extract( shortcode_atts( array(
		'category'        => '',
		'date_format'     => '(n/j/Y)',
		'id'              => false,
		'image_size'      => false,
		'include_date'    => false,
		'include_excerpt' => false,
		'order'           => 'DESC',
		'orderby'         => 'date',
		'post_parent'     => false,
		'post_type'       => 'post',
		'posts_per_page'  => '10',
		'tag'             => '',
		'tax_operator'    => 'IN',
		'tax_term'        => false,
		'taxonomy'        => false,
		'wrapper'         => 'ul',
	), $atts ) );
	
	// Set up initial query for post
	$args = array(
		'category_name'  => $category,
		'order'          => $order,
		'orderby'        => $orderby,
		'post_type'      => explode( ',', $post_type ),
		'posts_per_page' => $posts_per_page,
		'tag'            => $tag,
	);
	
	// If Post IDs
	if( $id ) {
		$posts_in = explode( ',', $id );
		$args['post__in'] = $posts_in;
	}
	
	
	// If taxonomy attributes, create a taxonomy query
	if ( !empty( $taxonomy ) && !empty( $tax_term ) ) {
	
		// Term string to array
		$tax_term = explode( ', ', $tax_term );
		
		// Validate operator
		if( !in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) )
			$tax_operator = 'IN';
					
		$tax_args = array(
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'slug',
					'terms'    => $tax_term,
					'operator' => $tax_operator
				)
			)
		);
		$args = array_merge( $args, $tax_args );
	}
	
	// If post parent attribute, set up parent
	if( $post_parent ) {
		if( 'current' == $post_parent ) {
			global $post;
			$post_parent = $post->ID;
		}
		$args['post_parent'] = $post_parent;
	}
	
	// Set up html elements used to wrap the posts. 
	// Default is ul/li, but can also be ol/li and div/div
	$wrapper_options = array( 'ul', 'ol', 'div' );
	if( ! in_array( $wrapper, $wrapper_options ) )
		$wrapper = 'ul';
	$inner_wrapper = 'div' == $wrapper ? 'div' : 'li';

	
	$listing = new WP_Query( apply_filters( 'display_posts_shortcode_args', $args, $atts ) );
	if ( ! $listing->have_posts() )
		return apply_filters( 'display_posts_shortcode_no_results', false );
		
	$inner = '';
	while ( $listing->have_posts() ): $listing->the_post(); global $post;
		
		$image = $date = $excerpt = '';
		
		$title = '<a class="title" href="' . get_permalink() . '">' . get_the_title() . '</a>';
		
		if ( $image_size && has_post_thumbnail() )  
			$image = '<a class="image" href="' . get_permalink() . '">' . get_the_post_thumbnail( $post->ID, $image_size ) . '</a> ';
			
		if ( $include_date ) 
			$date = ' <span class="date">' . get_the_date( $date_format ) . '</span>';
		
		if ( $include_excerpt ) 
			$excerpt = ' <span class="excerpt-dash">-</span> <span class="excerpt">' . get_the_excerpt() . '</span>';
		
		$output = '<' . $inner_wrapper . ' class="listing-item">' . $image . $title . $date . $excerpt . '</' . $inner_wrapper . '>';
		
		$inner .= apply_filters( 'display_posts_shortcode_output', $output, $atts, $image, $title, $date, $excerpt, $inner_wrapper );
		
	endwhile; wp_reset_postdata();
	
	$open = apply_filters( 'display_posts_shortcode_wrapper_open', '<' . $wrapper . ' class="display-posts-listing">' );
	$close = apply_filters( 'display_posts_shortcode_wrapper_close', '</' . $wrapper . '>' );
	$return = $open . $inner . $close;

	return $return;
}
