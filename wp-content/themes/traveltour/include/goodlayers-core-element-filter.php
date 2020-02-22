<?php 
	/*	
	*	Goodlayers Core Plugin Filter
	*	---------------------------------------------------------------------
	*	This file contains the script to includes necessary function
	* 	for compatibility with goodlayers core plugin
	*	---------------------------------------------------------------------
	*/

	// title nav style
	add_filter('gdlr_core_block_item_title_nav_filter', 'traveltour_gdlr_core_block_item_title_nav_filter');
	if( !function_exists('traveltour_gdlr_core_block_item_title_nav_filter') ){
		function traveltour_gdlr_core_block_item_title_nav_filter( $style ){
			return 'gdlr-core-rectangle-style';
		}
	}

	// add title item option
	add_filter('gdlr_core_title_item_options', 'traveltour_gdlr_core_title_item_options');
	if( !function_exists('traveltour_gdlr_core_title_item_options') ){
		function traveltour_gdlr_core_title_item_options($options){

			if( !empty($options['style']['options']['side-border-size']['condition']) ){
				$options['style']['options']['side-border-size']['condition']['text-align'] = 'center';
				$options['style']['options']['side-border-spaces']['condition']['text-align'] = 'center';
				$options['style']['options']['side-border-style']['condition']['text-align'] = 'center';
			}

			return $options;
		}
	}

	// style blog content
	add_filter('gdlr_core_blog_style_content', 'traveltour_gdlr_core_blog_style_content', 10, 3);
	if( !function_exists('traveltour_gdlr_core_blog_style_content') ){
		function traveltour_gdlr_core_blog_style_content($ret, $args, $blog_style){

			if( $args['blog-style'] == 'blog-full' || $args['blog-style'] == 'blog-full-with-frame' ){

				$post_format = get_post_format();
				if( in_array($post_format, array('aside', 'quote', 'link')) ){
					$args['extra-class']  = ' gdlr-core-blog-full gdlr-core-large';
					$args['extra-class'] .= (!empty($args['layout']) && $args['layout'] == 'carousel')? '': ' gdlr-core-item-pdlr';

					return $blog_style->blog_format( $args, $post_format );
				}

				$additional_class  = (!empty($args['layout']) && $args['layout'] == 'carousel')? '': ' gdlr-core-item-pdlr';
				$additional_class .= (!empty($args['blog-full-alignment']))? ' gdlr-core-style-' . $args['blog-full-alignment']: '';

				$ret  = '<div class="gdlr-core-item-list gdlr-core-blog-full ' . esc_attr($additional_class) . '" >';
				if( empty($args['show-thumbnail']) || $args['show-thumbnail'] == 'enable' ){
					$ret .= $blog_style->blog_thumbnail(array(
						'thumbnail-size' => $args['thumbnail-size'],
						'post-format' => $post_format,
						'post-format-thumbnail' => false,
						'opacity-on-hover' => empty($args['enable-thumbnail-opacity-on-hover'])? 'enable': $args['enable-thumbnail-opacity-on-hover'],
						'zoom-on-hover' => empty($args['enable-thumbnail-zoom-on-hover'])? 'enable': $args['enable-thumbnail-zoom-on-hover'],
						'grayscale-effect' => empty($args['enable-thumbnail-grayscale-effect'])? 'disable': $args['enable-thumbnail-grayscale-effect']
					)); 
				}
				
				$ret .= ($args['blog-style'] == 'blog-full-with-frame')? '<div class="gdlr-core-blog-full-frame gdlr-core-skin-e-background">': '';
				$ret .= '<div class="gdlr-core-blog-full-head clearfix">';
				$ret .= $blog_style->blog_date($args);
				
				$ret .= '<div class="gdlr-core-blog-full-head-right">';
				$ret .= $blog_style->blog_info(array(
					'display' => $args['meta-option'],
					'wrapper' => true
				));
				$ret .= $blog_style->blog_title( $args );				
				$ret .= '</div>'; // gdlr-core-blog-full-head-right
				$ret .= '</div>'; // gdlr-core-blog-full-head
				
				$ret .= $blog_style->get_blog_excerpt($args);
				
				$ret .= ($args['blog-style'] == 'blog-full-with-frame')? '</div>': '';
				$ret .= '</div>'; // gdlr-core-blog-full
				
				return $ret;

			}

			return false;

		}
	}