<?php
	/* a template for displaying the page title */

	$page_title = '';
	$page_caption = '';

	$main_head = false;
	$main_caption = false; 

	$title_style = traveltour_get_option('general', 'default-title-style', 'small');
	$title_align = traveltour_get_option('general', 'default-title-align', 'left');

	// for index page
	if( is_home() ){
		$main_head = true;
		$page_title = esc_html__('Home Page', 'traveltour');

	// for single post
	}else if( is_single() && in_array(get_post_type(), array('post', 'tour')) ){


	// for single product
	}else if( is_single() && get_post_type() == 'product' ){

		echo '<div class="traveltour-header-transparent-substitute" ></div>';

	// for pages
	}else if( is_page() || is_single() ){
		$post_option = traveltour_get_post_option(get_the_ID());

		$main_head = true;
		$page_title = get_the_title();
		$page_caption = empty($post_option['page-caption'])? '': $post_option['page-caption'];

		if( !empty($post_option['title-background']) ){
			$title_background = $post_option['title-background'];
		}

		$title_color = empty($post_option['title-color'])? '': $post_option['title-color'];
		$caption_color = empty($post_option['caption-color'])? '': $post_option['caption-color'];
		$background_overlay_color = empty($post_option['title-background-overlay-color'])? '': $post_option['title-background-overlay-color'];
		if( !empty($post_option['title-align']) && $post_option['title-align'] != 'default' ){
			$title_align = $post_option['title-align'];
		}

		if( !empty($post_option['title-style']) && $post_option['title-style'] != 'default' ){
			$title_style = $post_option['title-style'];

			if( $post_option['title-style'] == 'custom' ){
				$title_size = empty($post_option['title-font-size'])? '': $post_option['title-font-size'];
				$title_weight = empty($post_option['title-font-weight'])? '': $post_option['title-font-weight'];
				$title_transform = empty($post_option['title-font-transform'])? '': $post_option['title-font-transform'];
				$title_spacing = empty($post_option['title-spacing'])? array(): $post_option['title-spacing'];
				$title_overlay_opacity = empty($post_option['title-background-overlay-opacity'])? '': $post_option['title-background-overlay-opacity'];
			}
		}

	// 404 page
	}else if( is_404() ){

	// search page
	}else if( is_search() ){

		if( have_posts() ){
			$page_title = esc_html__('Search Results', 'traveltour');
			$page_caption = get_search_query();
		}else{
			get_template_part('content/archive', 'not-found');
		}

	// archive page
	}else if( is_archive() ){

		if( is_category() || is_tax('portfolio_category') || is_tax('product_cat') || is_tax('tour_category') ){
			$page_title = esc_html__('Category', 'traveltour');
			$main_head = false;
			$main_caption = true;
			
			if( is_tax('product_cat') && function_exists('woocommerce_breadcrumb') ){
				ob_start();
				woocommerce_breadcrumb();
				$page_caption = ob_get_contents();
				ob_end_clean();
			}else{
				$page_caption = single_cat_title('', false);
			}

			if( is_tax('tour_category') ){
				$archive_title_background = get_term_meta(get_queried_object()->term_id, 'archive-title-background', true);
				if( !empty($archive_title_background) ){
					$title_background = $archive_title_background;
				}
			}
		}else if( is_tag() || is_tax('portfolio_tag') || is_tax('product_tag') || is_tax('tour_tag') ){
			$page_title = esc_html__('Tag', 'traveltour');
			$main_head = false;
			$main_caption = true;
			
			if( is_tax('product_cat') && function_exists('woocommerce_breadcrumb') ){
				ob_start();
				woocommerce_breadcrumb();
				$page_caption = ob_get_contents();
				ob_end_clean();
			}else{
				$page_caption = single_cat_title('', false);
			}

			if( is_tax('tour_tag') ){
				$archive_title_background = get_term_meta(get_queried_object()->term_id, 'archive-title-background', true);
				if( !empty($archive_title_background) ){
					$title_background = $archive_title_background;
				}
			}
		}else if( function_exists('tourmaster_is_custom_tour_tax') && tourmaster_is_custom_tour_tax() ){
			$page_title = single_cat_title('', false);
			$main_head = true;
			
			$archive_title_background = get_term_meta(get_queried_object()->term_id, 'archive-title-background', true);
			if( !empty($archive_title_background) ){
				$title_background = $archive_title_background;
			}
		}else if( is_day() ){
			$page_title = esc_html__('Day','traveltour');
			$page_caption = get_the_date('F j, Y');
		}else if( is_month() ){
			$page_title = esc_html__('Month','traveltour');
			$page_caption = get_the_date('F Y');
		}else if( is_year() ){
			$page_title = esc_html__('Year','traveltour');
			$page_caption = get_the_date('Y');
		}else if( is_author() ){
			$page_title = esc_html__('By','traveltour');
			
			$author_id = get_query_var('author');
			$author = get_user_by('id', $author_id);
			$page_caption = $author->display_name;					
		}else if( is_post_type_archive('product') ){
			$page_title = esc_html__('Shop', 'traveltour');
			$page_caption = '';
		}else{
			$page_title = get_the_title();
			$page_caption = '';
		}

	}

	if( (empty($post_option['enable-page-title']) || $post_option['enable-page-title'] == 'enable') && (!empty($page_title) || !empty($page_caption)) ){	

		$page_title = apply_filters('traveltour_page_title', $page_title);
		$page_caption = apply_filters('traveltour_page_caption', $page_caption);

		$extra_class  = ' traveltour-style-' . $title_style;
		$extra_class .= ' traveltour-' . $title_align . '-align';

		echo '<div class="traveltour-page-title-wrap ' . esc_attr($extra_class) . '" ' . gdlr_core_esc_style(array(
			'background-image' => empty($title_background)? '': $title_background
		)) . '>';
		echo '<div class="traveltour-header-transparent-substitute" ></div>';
		echo '<div class="traveltour-page-title-overlay" ' . gdlr_core_esc_style(array(
			'opacity' => empty($title_overlay_opacity)? '': $title_overlay_opacity,
			'background-color' => empty($background_overlay_color)? '': $background_overlay_color
		)) . ' ></div>';
		echo '<div class="traveltour-page-title-container traveltour-container" >';
		echo '<div class="traveltour-page-title-content traveltour-item-pdlr" ' . gdlr_core_esc_style(array(
			'padding-top' => empty($title_spacing['padding-top'])? '': $title_spacing['padding-top'],
			'padding-bottom' => empty($title_spacing['padding-bottom'])? '': $title_spacing['padding-bottom']
		)) . ' >';
		if( !empty($page_title) ){
			if( !empty($main_head) ){
				echo '<h1 class="traveltour-page-title" ' . gdlr_core_esc_style(array(
					'font-size' => empty($title_size['title-size'])? '': $title_size['title-size'],
					'font-weight' => empty($title_weight['title-weight'])? '': $title_weight['title-weight'],
					'text-transform' => (empty($title_transform) || $title_transform == 'default')? '': $title_transform,
					'letter-spacing' => empty($title_size['title-letter-spacing'])? '': $title_size['title-letter-spacing'],
					'color' => empty($title_color)? '': $title_color
				)) . ' >' . $page_title . '</h1>';
			}else{
				echo '<h3 class="traveltour-page-title" ' . gdlr_core_esc_style(array(
					'font-size' => empty($title_size['title-size'])? '': $title_size['title-size'],
					'font-weight' => empty($title_weight['title-weight'])? '': $title_weight['title-weight'],
					'text-transform' => (empty($title_transform) || $title_transform == 'default')? '': $title_transform,
					'letter-spacing' => empty($title_size['title-letter-spacing'])? '': $title_size['title-letter-spacing'],
					'color' => empty($title_color)? '': $title_color
				)) . ' >' . $page_title . '</h3>';
			}
		}

		if( !empty($page_caption) ){
			echo ($main_caption)? '<h1': '<div';
			echo ' class="traveltour-page-caption" ' . gdlr_core_esc_style(array(
					'font-size' => empty($title_size['caption-size'])? '': $title_size['caption-size'],
					'font-weight' => empty($title_weight['caption-weight'])? '': $title_weight['caption-weight'],
					'letter-spacing' => empty($title_size['caption-letter-spacing'])? '': $title_size['caption-letter-spacing'],
					'margin-top' => empty($title_spacing['caption-top-margin'])? '': $title_spacing['caption-top-margin'],
					'color' => empty($caption_color)? '': $caption_color
				)) . ' >' . $page_caption;
			echo ($main_caption)? '</h1>': '</div>';
		}
		echo '</div>'; // traveltour-page-title-content
		echo '</div>'; // traveltour-page-title-container
		echo '</div>'; // traveltour-page-title-wrap
	}
?>