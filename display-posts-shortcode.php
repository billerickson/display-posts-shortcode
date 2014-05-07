<?php
/**
 * Plugin Name: Display Posts Shortcode
 * Plugin URI: http://www.billerickson.net/shortcode-to-display-posts/
 * Description: Display a listing of posts using the [display-posts] shortcode
 * Version: 2.4
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
 * @version 2.4
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

	// Original Attributes, for filters
	$original_atts = $atts;

	// Pull in shortcode attributes and set defaults
	$atts = shortcode_atts( array(
		'title'              => '',
		'author'              => '',
		'category'            => '',
		'date_format'         => '(n/j/Y)',
		'display_posts_off'   => false,
		'exclude_current'     => false,
		'id'                  => false,
		'ignore_sticky_posts' => false,
		'image_size'          => false,
		'include_title'       => true,
		'include_author'      => false,
		'include_content'     => false,
		'include_date'        => false,
		'include_excerpt'     => false,
		'meta_key'            => '',
		'meta_value'          => '',
		'no_posts_message'    => '',
		'offset'              => 0,
		'order'               => 'DESC',
		'orderby'             => 'date',
		'post_parent'         => false,
		'post_status'         => 'publish',
		'post_type'           => 'post',
		'posts_per_page'      => '10',
		'tag'                 => '',
		'tax_operator'        => 'IN',
		'tax_term'            => false,
		'taxonomy'            => false,
		'wrapper'             => 'ul',
		'wrapper_class'       => 'display-posts-listing',
		'wrapper_id'          => false,
	), $atts, 'display-posts' );
	
	// End early if shortcode should be turned off
	if( $atts['display_posts_off'] )
		return;

	$shortcode_title = sanitize_text_field( $atts['title'] );
	$author = sanitize_text_field( $atts['author'] );
	$category = sanitize_text_field( $atts['category'] );
	$date_format = sanitize_text_field( $atts['date_format'] );
	$exclude_current = be_display_posts_bool( $atts['exclude_current'] );
	$id = $atts['id']; // Sanitized later as an array of integers
	$ignore_sticky_posts = be_display_posts_bool( $atts['ignore_sticky_posts'] );
	$image_size = sanitize_key( $atts['image_size'] );
	$include_title = be_display_posts_bool( $atts['include_title'] );
	$include_author = be_display_posts_bool( $atts['include_author'] );
	$include_content = be_display_posts_bool( $atts['include_content'] );
	$include_date = be_display_posts_bool( $atts['include_date'] );
	$include_excerpt = be_display_posts_bool( $atts['include_excerpt'] );
	$meta_key = sanitize_text_field( $atts['meta_key'] );
	$meta_value = sanitize_text_field( $atts['meta_value'] );
	$no_posts_message = sanitize_text_field( $atts['no_posts_message'] );
	$offset = intval( $atts['offset'] );
	$order = sanitize_key( $atts['order'] );
	$orderby = sanitize_key( $atts['orderby'] );
	$post_parent = $atts['post_parent']; // Validated later, after check for 'current'
	$post_status = $atts['post_status']; // Validated later as one of a few values
	$post_type = sanitize_text_field( $atts['post_type'] );
	$posts_per_page = intval( $atts['posts_per_page'] );
	$tag = sanitize_text_field( $atts['tag'] );
	$tax_operator = $atts['tax_operator']; // Validated later as one of a few values
	$tax_term = sanitize_text_field( $atts['tax_term'] );
	$taxonomy = sanitize_key( $atts['taxonomy'] );
	$wrapper = sanitize_text_field( $atts['wrapper'] );
	$wrapper_class = sanitize_html_class( $atts['wrapper_class'] );
	if( !empty( $wrapper_class ) )
		$wrapper_class = ' class="' . $wrapper_class . '"';
	$wrapper_id = sanitize_html_class( $atts['wrapper_id'] );
	if( !empty( $wrapper_id ) )
		$wrapper_id = ' id="' . $wrapper_id . '"';

	
	// Set up initial query for post
	$args = array(
		'category_name'       => $category,
		'order'               => $order,
		'orderby'             => $orderby,
		'post_type'           => explode( ',', $post_type ),
		'posts_per_page'      => $posts_per_page,
		'tag'                 => $tag,
	);
	
	// Ignore Sticky Posts
	if( $ignore_sticky_posts )
		$args['ignore_sticky_posts'] = true;
	
	// Meta key (for ordering)
	if( !empty( $meta_key ) )
		$args['meta_key'] = $meta_key;
	
	// Meta value (for simple meta queries)
	if( !empty( $meta_value ) )
		$args['meta_value'] = $meta_value;
		
	// If Post IDs
	if( $id ) {
		$posts_in = array_map( 'intval', explode( ',', $id ) );
		$args['post__in'] = $posts_in;
	}
	
	// If Exclude Current
	if( $exclude_current )
		$args['post__not_in'] = array( get_the_ID() );
	
	// Post Author
	if( !empty( $author ) )
		$args['author_name'] = $author;
		
	// Offset
	if( !empty( $offset ) )
		$args['offset'] = $offset;
	
	// Post Status	
	$post_status = explode( ', ', $post_status );		
	$validated = array();
	$available = array( 'publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash', 'any' );
	foreach ( $post_status as $unvalidated )
		if ( in_array( $unvalidated, $available ) )
			$validated[] = $unvalidated;
	if( !empty( $validated ) )		
		$args['post_status'] = $validated;
	
	
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
		
		// Check for multiple taxonomy queries
		$count = 2;
		$more_tax_queries = false;
		while( 
			isset( $original_atts['taxonomy_' . $count] ) && !empty( $original_atts['taxonomy_' . $count] ) && 
			isset( $original_atts['tax_' . $count . '_term'] ) && !empty( $original_atts['tax_' . $count . '_term'] ) 
		):
		
			// Sanitize values
			$more_tax_queries = true;
			$taxonomy = sanitize_key( $original_atts['taxonomy_' . $count] );
	 		$terms = explode( ', ', sanitize_text_field( $original_atts['tax_' . $count . '_term'] ) );
	 		$tax_operator = isset( $original_atts['tax_' . $count . '_operator'] ) ? $original_atts['tax_' . $count . '_operator'] : 'IN';
	 		$tax_operator = in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) ? $tax_operator : 'IN';
	 		
	 		$tax_args['tax_query'][] = array(
	 			'taxonomy' => $taxonomy,
	 			'field' => 'slug',
	 			'terms' => $terms,
	 			'operator' => $tax_operator
	 		);
	
			$count++;
			
		endwhile;
		
		if( $more_tax_queries ):
			$tax_relation = 'AND';
			if( isset( $original_atts['tax_relation'] ) && in_array( $original_atts['tax_relation'], array( 'AND', 'OR' ) ) )
				$tax_relation = $original_atts['tax_relation'];
			$args['tax_query']['relation'] = $tax_relation;
		endif;
		
		$args = array_merge( $args, $tax_args );
	}
	
	// If post parent attribute, set up parent
	if( $post_parent ) {
		if( 'current' == $post_parent ) {
			global $post;
			$post_parent = get_the_ID();
		}
		$args['post_parent'] = intval( $post_parent );
	}
	
	// Set up html elements used to wrap the posts. 
	// Default is ul/li, but can also be ol/li and div/div
	$wrapper_options = array( 'ul', 'ol', 'div' );
	if( ! in_array( $wrapper, $wrapper_options ) )
		$wrapper = 'ul';
	$inner_wrapper = 'div' == $wrapper ? 'div' : 'li';

	
	$listing = new WP_Query( apply_filters( 'display_posts_shortcode_args', $args, $original_atts ) );
	if ( ! $listing->have_posts() )
		return apply_filters( 'display_posts_shortcode_no_results', wpautop( $no_posts_message ) );
		
	$inner = '';
	while ( $listing->have_posts() ): $listing->the_post(); global $post;
		
		$image = $date = $author = $excerpt = $content = '';
		
		if ( $include_title )
			$title = '<a class="title" href="' . apply_filters( 'the_permalink', get_permalink() ) . '">' . get_the_title() . '</a>';
		
		if ( $image_size && has_post_thumbnail() )  
			$image = '<a class="image" href="' . get_permalink() . '">' . get_the_post_thumbnail( get_the_ID(), $image_size ) . '</a> ';
			
		if ( $include_date ) 
			$date = ' <span class="date">' . get_the_date( $date_format ) . '</span>';
			
		if( $include_author )
			$author = apply_filters( 'display_posts_shortcode_author', ' <span class="author">by ' . get_the_author() . '</span>' );
		
		if ( $include_excerpt ) 
			$excerpt = ' <span class="excerpt-dash">-</span> <span class="excerpt">' . get_the_excerpt() . '</span>';
			
		if( $include_content ) {
			add_filter( 'shortcode_atts_display-posts', 'be_display_posts_off', 10, 3 );
			$content = '<div class="content">' . apply_filters( 'the_content', get_the_content() ) . '</div>'; 
			remove_filter( 'shortcode_atts_display-posts', 'be_display_posts_off', 10, 3 );
		}
		
		$class = array( 'listing-item' );
		$class = sanitize_html_class( apply_filters( 'display_posts_shortcode_post_class', $class, $post, $listing, $original_atts ) );
		$output = '<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">' . $image . $title . $date . $author . $excerpt . $content . '</' . $inner_wrapper . '>';
		
		// If post is set to private, only show to logged in users
		if( 'private' == get_post_status( get_the_ID() ) && !current_user_can( 'read_private_posts' ) )
			$output = '';
		
		$inner .= apply_filters( 'display_posts_shortcode_output', $output, $original_atts, $image, $title, $date, $excerpt, $inner_wrapper, $content, $class );
		
	endwhile; wp_reset_postdata();
	
	$open = apply_filters( 'display_posts_shortcode_wrapper_open', '<' . $wrapper . $wrapper_class . $wrapper_id . '>', $original_atts );
	$close = apply_filters( 'display_posts_shortcode_wrapper_close', '</' . $wrapper . '>', $original_atts );
	
	$return = $open;

	if( $shortcode_title ) {

		$title_tag = apply_filters( 'display_posts_shortcode_title_tag', 'h2', $original_atts );

		$return .= '<' . $title_tag . ' class="display-posts-title">' . $shortcode_title . '</' . $title_tag . '>' . "\n";
	}

	$return .= $inner . $close;

	return $return;
}

/**
 * Turn off display posts shortcode 
 * If display full post content, any uses of [display-posts] are disabled
 *
 * @param array $out, returned shortcode values 
 * @param array $pairs, list of supported attributes and their defaults 
 * @param array $atts, original shortcode attributes 
 * @return array $out
 */
function be_display_posts_off( $out, $pairs, $atts ) {
	$out['display_posts_off'] = true;
	return $out;
}

/**
 * Convert string to boolean
 * because (bool) "false" == true
 *
 */
function be_display_posts_bool( $value ) {
	return !empty( $value ) && 'true' == $value ? true : false;
}
