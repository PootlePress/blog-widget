<?php

if ( ! function_exists( 'blog_widget_title' ) ) {
	/**
	 * Prints post title
	 */
	function blog_widget_title() {
		echo '<h2 class="blog-widget-post-title">';
		echo '<a class="blog-widget-post-title" href="'.get_the_permalink().'">';
		the_title();
		echo '</a>';
		echo'</h2>';
	}
}

if ( ! function_exists( 'blog_widget_post_img' ) ) {
	/**
	 * Prints post image
	 */
	function blog_widget_post_img() {
		if ( has_post_thumbnail() ) {
			echo '<a class="blog-widget-featured-image" href="'.get_the_permalink().'">';
			the_post_thumbnail( 'large' );
			echo '</a>';
		}
	}
}

if ( ! function_exists( 'blog_widget_post_meta' ) ) {
	/**
	 * Prints post meta
	 */
	function blog_widget_post_meta() {
		if ( 'post' == get_post_type() ) {
			//Author
			echo
				'<div class="blog-widget-author-time"><span class="blog-widget-author">By <a rel="author" href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '">'
				. get_the_author() .
				'</a></span>';
			//Publish date
			echo '<span class="blog-widget-time"> on <time datetime="' . get_the_time( 'F j, Y' ) . '">' . get_the_time( 'F j, Y' ) . '</time></span></div>';
			
			//Get tags and catoegories
			$categories_list = get_the_category_list( ', ' );
			$tags_list = get_the_tag_list( '',  ', ' );
			
			if ( $categories_list || $tags_list) {
				echo '<div class="blog-widget-taxonomies">';
			}
			
			//Categories
			if ( $categories_list ) {
				echo '<span class="blog-widget-cat-links">'.$categories_list.'</span>';
			} 
			
			//Categories and tags seperator if both present
			if ( $categories_list && $tags_list) {
				echo ', ';
			}
			
			//Tags
			if ( $tags_list ) { 
				echo '<span class="blog-widget-tags-links">'. $tags_list.'</span>';
			}
						
			if ( $categories_list || $tags_list) {
				echo '</div>';
			}
		}
	}
}

if ( ! function_exists( 'blog_widget_post_excerpt' ) ) {
	/**
	 * Prints post excerpt
	 */
	function blog_widget_post_excerpt() {
		echo '<div class="blog-widget-post-excerpt">'.get_the_excerpt().'</div>';
	}
}

if ( ! function_exists( 'blog_widget_post_comments' ) ) {
	/**
	 * Prints post comments
	 */
	function blog_widget_post_comments() {
		//Comments
		if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
			echo '<div class="blog-widget-comments-link">';
			comments_popup_link( 'Leave a comment', '1 Comment', '% Comments' );
			echo '</div>';
		}
	}
}

if ( ! function_exists( 'blog_widget_post_more_link' ) ) {
	/**
	 * Prints post read more link
	 */
	function blog_widget_post_more_link() {
		//Comments
		if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
			echo '<a class="blog-widget-read-more" href="'.get_the_permalink().'">Read more...</a>';
		}
	}
}

/**
 * Register style sheet.
 */
function blg_wid_styles() {
	global $blg_wid_plugin_dir;
	wp_register_style( 'blog_widget_style', $blg_wid_plugin_dir . '/css/style.css' );
	wp_enqueue_style( 'blog_widget_style' );
	wp_enqueue_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'blg_wid_styles' );
