<?php
get_header();

	$shadow_size = tourmaster_get_option('general', 'tour-search-item-frame-shadow-size', '');
	$settings = array(
		'pagination' => 'page',
		'grid-style' => tourmaster_get_option('general', 'tour-search-order-filterer-grid-style-type', 'style-1'),
		'column-size' => tourmaster_get_option('general', 'tour-search-order-filterer-grid-style-column', '30'),
		'tour-info' => tourmaster_get_option('general', 'tour-search-item-info', array()),
		'excerpt' => tourmaster_get_option('general', 'tour-search-item-excerpt', 'specify-number'),
		'excerpt-number' => tourmaster_get_option('general', 'tour-search-item-excerpt-number', '55'),
		'tour-rating' => tourmaster_get_option('general', 'tour-search-item-rating', 'enable'),
		'num-fetch' => tourmaster_get_option('general', 'tour-search-item-num-fetch', '9'),
		'custom-pagination' => true,
		'frame-shadow-size' => empty($shadow_size)? '': array('x' => 0, 'y' => 0, 'size' => $shadow_size),
		'frame-shadow-color' => tourmaster_get_option('general', 'tour-search-item-frame-shadow-color', ''),
		'frame-shadow-opacity' => tourmaster_get_option('general', 'tour-search-item-frame-shadow-opacity', ''),
	);
	$settings['paged'] = (get_query_var('paged'))? get_query_var('paged') : get_query_var('page');
	$settings['paged'] = empty($settings['paged'])? 1: $settings['paged'];

	if( $settings['grid-style'] == 'style-2' ){
		$settings['tour-border-radius'] = '3px';
	} 

	// search query
	$args = array(
		'post_status' => 'publish',
		'post_type' => 'tour',
		'posts_per_page' => $settings['num-fetch'],
		'paged' => $settings['paged'],
	);

	// keywords
	if( !empty($_GET['tour-search']) ){
		$args['s'] = $_GET['tour-search'];
	}

	// category
	$args['tax_query'] = array(
		'relation' => 'AND'
	);
	$category = empty($_GET['tour_category'])? '': $_GET['tour_category'];
	if( !empty($category) ){
		$args['tax_query'][] = array(
			array('terms'=>$category, 'taxonomy'=>'tour_category', 'field'=>'slug')
		);
	}

	// taxonomy
	$tax_fields = array( 'tour_tag' => esc_html__('Tag', 'tourmaster') );
	$tax_fields = $tax_fields + tourmaster_get_custom_tax_list();
	foreach( $tax_fields as $tax_field => $tax_title ){
		if( !empty($_GET['tax-' . $tax_field]) ){
			$args['tax_query'][] = array(
				array('terms'=>$_GET['tax-' . $tax_field], 'taxonomy'=>$tax_field, 'field'=>'slug')
			);
		}
	}
	$meta_query = array(
		'relation' => 'AND'
	);

	// duration
	if( !empty($_GET['duration']) ){
		if( $_GET['duration'] == '1' ){
			$meta_query[] = array(
				'key'     => 'tourmaster-tour-duration',
				'value'   => '1',
				'compare' => '=',
				'type'    => 'NUMERIC'
			);
		}else if( $_GET['duration'] == '2' ){
			$meta_query[] = array(
				'key'     => 'tourmaster-tour-duration',
				'value'   => array(2, 4),
				'compare' => 'BETWEEN',
				'type'    => 'NUMERIC'
			);
		}else if( $_GET['duration'] == '5' ){
			$meta_query[] = array(
				'key'     => 'tourmaster-tour-duration',
				'value'   => array(5, 7),
				'compare' => 'BETWEEN',
				'type'    => 'NUMERIC'
			);
		}else if( $_GET['duration'] == '7' ){
			$meta_query[] = array(
				'key'     => 'tourmaster-tour-duration',
				'value'   => '7',
				'compare' => '>',
				'type'    => 'NUMERIC'
			);
		}
	}

	// date
	if( !empty($_GET['date']) ){
		$meta_query[] = array(
			'key'     => 'tourmaster-tour-date',
			'value'   => $_GET['date'],
			'compare' => 'LIKE',
		);
	}	

	// date
	if( !empty($_GET['month']) ){
		$meta_query[] = array(
			'key'     => 'tourmaster-tour-date',
			'value'   => $_GET['month'],
			'compare' => 'LIKE',
		);
	}	

	// min price 
	if( !empty($_GET['min-price']) ){
		$meta_query[] = array(
			'key'     => 'tourmaster-tour-price',
			'value'   => $_GET['min-price'],
			'compare' => '>=',
			'type'    => 'NUMERIC'
		);
	}

	// max price 
	if( !empty($_GET['max-price']) ){
		$meta_query[] = array(
			'key'     => 'tourmaster-tour-price',
			'value'   => $_GET['max-price'],
			'compare' => '<=',
			'type'    => 'NUMERIC'
		);
	}

	// max price 
	if( !empty($_GET['rating']) ){
		$meta_query[] = array(
			'key'     => 'tourmaster-tour-rating-score',
			'value'   => $_GET['rating'],
			'compare' => '>=',
			'type'    => 'NUMERIC'
		);
	}

	if( !empty($meta_query) ){
		$args['meta_query'] = $meta_query;
	}

	$settings['query'] = new WP_Query($args);
	
	global $tourmaster_found_posts;
	$tourmaster_found_posts = $settings['query']->found_posts;


	// start the content
	$search_style = tourmaster_get_option('general', 'search-page-style', 'style-1');
	if( $search_style == 'style-2' ){
		$settings['filter-icon'] = 'svg';
	}

	echo '<div class="tourmaster-template-wrapper tourmaster-search-' . esc_attr($search_style) . '" >';
	echo '<div class="tourmaster-container" >';

	// sidebar content
	$sidebar_type = 'none';
	echo '<div class="' . tourmaster_get_sidebar_wrap_class($sidebar_type) . '" >';
	echo '<div class="' . tourmaster_get_sidebar_class(array('sidebar-type'=>$sidebar_type, 'section'=>'center')) . '" >';
	
	
	echo '<div class="tourmaster-page-content" >';
	
	// search filter
	$enable_search_filter = tourmaster_get_option('general', 'enable-tour-search-filter', 'disable');
	if( $enable_search_filter != 'disable' ){
		$search_settings = array(
			'fields' => tourmaster_get_option('general', 'tour-search-fields', ''),
			'enable-rating-field' => tourmaster_get_option('general', 'tour-search-rating-field', ''),
			'filters' => tourmaster_get_option('general', 'tour-search-filters', ''),
			'filter-state' => tourmaster_get_option('general', 'tour-search-filter-state', 'disable'),
			'style' => 'full',
			'item-style' => $search_style,
			'with-frame' => 'enable'
		);
		echo '<div class="tourmaster-tour-search-item-wrap" >';
		echo tourmaster_pb_element_tour_search::get_content($search_settings);
		echo '</div>';
	}

	// content
	if( $settings['query']->have_posts() ){	

		$settings['enable-order-filterer'] = 'enable'; 
		$settings['order-filterer-grid-style'] = tourmaster_get_option('general', 'tour-search-order-filterer-grid-style', ''); 
		$settings['order-filterer-grid-style-thumbnail'] = tourmaster_get_option('general', 'tour-search-order-filterer-grid-style-thumbnail', ''); 
		$settings['order-filterer-grid-style-column'] = $settings['column-size']; 
		
		$settings['order-filterer-list-style'] = tourmaster_get_option('general', 'tour-search-item-style', '');
		$settings['order-filterer-list-style-thumbnail'] = tourmaster_get_option('general', 'tour-search-item-thumbnail', '');

		$default_style = tourmaster_get_option('general', 'tour-search-default-style', 'list');
		if( $default_style == 'list' ){
			$settings['tour-style'] = $settings['order-filterer-list-style'];
			$settings['thumbnail-size'] = $settings['order-filterer-list-style-thumbnail'];
		}else if( $default_style == 'grid' ){
			$settings['tour-style'] = $settings['order-filterer-grid-style'];
			$settings['thumbnail-size'] =$settings['order-filterer-grid-style-thumbnail'];
		}

		$settings['s'] = empty($args['s'])? '': $args['s'];
		$settings['tax_query'] = $args['tax_query'];
		$settings['meta_query'] = $meta_query;

		echo '<div class="tourmaster-tour-search-content-wrap" >';
		if( $search_style == 'style-2' ){
			global $tourmaster_found_posts;
			echo '<h3 class="tourmaster-tour-search-content-head tourmaster-item-mglr" >';
			echo sprintf(esc_html__('%d Results Found', 'tourmaster'), $tourmaster_found_posts);
			echo '</h3>';
		} 
		echo tourmaster_pb_element_tour::get_content($settings);
		echo '</div>';
	}else{
		echo '<div class="tourmaster-single-search-not-found-wrap tourmaster-item-pdlr" >';
		echo '<div class="tourmaster-single-search-not-found-inner" >';
		echo '<div class="tourmaster-single-search-not-found" >';
		echo '<h3 class="tourmaster-single-search-not-found-title" >' . esc_html__('Not Found', 'tourmaster') . '</h3>';
		echo '<div class="tourmaster-single-search-not-found-caption" >' . esc_html__('Nothing matched your search criteria. Please try again with different keywords', 'tourmaster') . '</div>';
		echo '</div>'; // tourmaster-single-search-not-found

		if( $enable_search_filter == 'disable' ){
			echo tourmaster_pb_element_tour_search::get_content(array(
				'fields' => tourmaster_get_option('general', 'search-not-found-fields', array()),
				'style' => tourmaster_get_option('general', 'search-not-found-style', 'column'),
				'with-frame' => 'disable',
				'padding-bottom' => '0px',
				'no-pdlr' => true
			));		
		}

		echo '</div>'; // tourmaster-single-search-not-found-inner
		echo '</div>'; // tourmaster-single-search-not-found-wrap
	}

	echo '</div>'; // tourmaster-page-content
	
	echo '</div>'; // tourmaster-get-sidebar-class
	echo '</div>'; // tourmaster-get-sidebar-wrap-class	
	
	echo '</div>'; // tourmaster-container
	echo '</div>'; // tourmaster-template-wrapper

get_footer(); 

?>