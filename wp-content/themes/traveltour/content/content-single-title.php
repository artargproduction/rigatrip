<?php
/**
 * The template part for displaying single post title
 */

	echo '<header class="traveltour-single-article-head clearfix" >';
	$blog_date = traveltour_get_option('general', 'blog-date-feature', '');
	$blog_title = get_the_title();

	if( empty($blog_date) || $blog_date == 'enable' ){
		echo '<div class="traveltour-single-article-date-wrapper">';
		if( empty($blog_title) ){
			echo '<a href="' . get_permalink() . '" >';
		}
		echo '<span class="traveltour-single-article-date-day">' .  get_the_time('d') . '</span>';
		echo '<span class="traveltour-single-article-date-month">' . get_the_time('M') . '</span>';
		if( empty($blog_title) ){
			echo '</a>';
		}
		echo '</div>';
	}

	echo '<div class="traveltour-single-article-head-right">';
	$single_blog_meta = traveltour_get_option('general', 'meta-option', '');
	if( empty($blog_date) && empty($single_blog_meta) ){
		$single_blog_meta = array('author', 'category', 'tag', 'comment-number');
	}
	echo traveltour_get_blog_info(array(
		'display' => $single_blog_meta,
		'wrapper' => true
	));

	if( is_single() ){
		echo '<h1 class="traveltour-single-article-title">' . get_the_title() . '</h1>';
	}else{
		echo '<h3 class="traveltour-single-article-title"><a href="' . get_permalink() . '" >' . $blog_title . '</a></h3>';
	}
	echo '</div>';
	echo '</header>';