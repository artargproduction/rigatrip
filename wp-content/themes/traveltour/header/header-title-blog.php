<?php
	/* a template for displaying the single post title */
	
	$post_option = traveltour_get_post_option(get_the_ID());
	if( empty($post_option['blog-title-style']) || $post_option['blog-title-style'] == 'default' ){
		$title_style = traveltour_get_option('general', 'default-blog-title-style', 'small');
	}else{	
		$title_style = $post_option['blog-title-style'];

		if( $post_option['blog-title-style'] == 'custom' ){
			$title_spacing = empty($post_option['blog-title-padding'])? array(): $post_option['blog-title-padding'];
			$title_overlay_opacity = empty($post_option['blog-title-background-overlay-opacity'])? '': $post_option['blog-title-background-overlay-opacity'];
				
		}
	}

	$extra_class = ' traveltour-style-' . $title_style;

	if( $title_style != 'none' && $title_style != 'inside-content' ){	

		// background
		if( empty($post_option['blog-feature-image']) || $post_option['blog-feature-image'] == 'default' ){
			$feature_image_pos = traveltour_get_option('general', 'default-blog-feature-image', 'content');
		}else{
			$feature_image_pos = $post_option['blog-feature-image'];
		}

		if( $feature_image_pos == 'title-background' ){
			$title_background = wp_get_attachment_url(get_post_thumbnail_id());
			$extra_class .= ' traveltour-feature-image';

		}else if( !empty($post_option['blog-title-background-image']) ){
			if( is_numeric($post_option['blog-title-background-image']) ){
				$title_background = wp_get_attachment_url($post_option['blog-title-background-image']);
			}else{
				$title_background = $post_option['blog-title-background-image'];
			}
		}

		$header_overlay = traveltour_get_option('general', 'default-blog-title-background-gradient', 'both');
		if( !empty($tour_option['header-background-gradient']) && $tour_option['header-background-gradient'] != 'default' ){
			$header_overlay = $tour_option['header-background-gradient'];
		}

		// start printing blog item
		echo '<div class="traveltour-blog-title-wrap ' . esc_attr($extra_class) . '" ' . gdlr_core_esc_style(array(
			'background-image' => empty($title_background)? '': $title_background
		)) . '>';
		echo '<div class="traveltour-header-transparent-substitute" ></div>';
		if( $header_overlay == 'top' || $header_overlay == 'both' ){
			echo '<div class="traveltour-blog-title-top-overlay" ></div>';
		}
		echo '<div class="traveltour-blog-title-overlay" ' . gdlr_core_esc_style(array(
			'opacity' => empty($title_overlay_opacity)? '': $title_overlay_opacity,
			'background-color' => empty($background_overlay_color)? '': $background_overlay_color
		)) . ' ></div>';
		if( $header_overlay == 'bottom' || $header_overlay == 'both' ){
			echo '<div class="traveltour-blog-title-bottom-overlay" ></div>';
		}
		echo '<div class="traveltour-blog-title-container traveltour-container" >';
		echo '<div class="traveltour-blog-title-content traveltour-item-pdlr" ' . gdlr_core_esc_style(array(
			'padding-top' => empty($title_spacing['padding-top'])? '': $title_spacing['padding-top'],
			'padding-bottom' => empty($title_spacing['padding-bottom'])? '': $title_spacing['padding-bottom']
		)) . ' >';

		get_template_part('content/content-single', 'title');

		echo '</div>'; // traveltour-page-title-content
		echo '</div>'; // traveltour-page-title-container
		echo '</div>'; // traveltour-page-title-wrap

		// breadcrumbs
		if( function_exists('bcn_display') ){
			echo '<div class="traveltour-breadcrumbs" >';
			echo '<div class="traveltour-breadcrumbs-container traveltour-container" >';
			echo '<div class="traveltour-breadcrumbs-item traveltour-item-pdlr" >';
       		bcn_display();
       		echo '</div>';
       		echo '</div>';
       		echo '</div>';
    	}

	}else if( $title_style == 'inside-content' ){
		echo '<div class="traveltour-header-transparent-substitute" ></div>';
	}
?>