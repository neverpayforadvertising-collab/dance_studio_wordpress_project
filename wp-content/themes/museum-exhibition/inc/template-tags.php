<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package museum_exhibition
 */

if ( ! function_exists( 'museum_exhibition_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function museum_exhibition_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$museum_exhibition_posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	$byline = '<span class="author vcard" itemprop="author"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
    
	echo '<span class="posted-on">' . $museum_exhibition_posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function museum_exhibition_categorized_blog() {
	if ( false === ( $museum_exhibition_all_the_cool_cats = get_transient( 'museum_exhibition_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$museum_exhibition_all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$museum_exhibition_all_the_cool_cats = count( $museum_exhibition_all_the_cool_cats );

		set_transient( 'museum_exhibition_categories', $museum_exhibition_all_the_cool_cats );
	}

	if ( $museum_exhibition_all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so museum_exhibition_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so museum_exhibition_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in museum_exhibition_categorized_blog.
 */
function museum_exhibition_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'museum_exhibition_categories' );
}
add_action( 'edit_category', 'museum_exhibition_category_transient_flusher' );
add_action( 'save_post',     'museum_exhibition_category_transient_flusher' );


if ( ! function_exists( 'museum_exhibition_category_list' ) ) :
/**
 * Prints Categories lists
*/
function museum_exhibition_category_list(){
    // Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$museum_exhibition_categories_list = get_the_category_list( esc_html__( ', ', 'museum-exhibition' ) );
		if ( $museum_exhibition_categories_list && museum_exhibition_categorized_blog() ) {
			echo '<span class="category">' . $museum_exhibition_categories_list . '</span>';
		}
	}
}
endif;