<?php 
	/*	
	*	Goodlayers Function Inclusion File
	*	---------------------------------------------------------------------
	*	This file contains the script to includes necessary function to the theme
	*	---------------------------------------------------------------------
	*/

	// Set the content width based on the theme's design and stylesheet.
	if( !isset($content_width) ){
		$content_width = str_replace('px', '', '1150px'); 
	}

	// Add body class for page builder
	add_filter('body_class', 'traveltour_body_class');
	if( !function_exists('traveltour_body_class') ){
		function traveltour_body_class( $classes ) {
			$classes[] = 'traveltour-body';
			$classes[] = 'traveltour-body-front';

			$layout = traveltour_get_option('general', 'layout', 'full');
			if( $layout == 'boxed' ){
			 	$classes[] = 'traveltour-boxed';

			 	$background = traveltour_get_option('general', 'background-type', 'color');
			 	if( $background == 'image' ){
			 		$classes[] = 'traveltour-background-image';
			 	}else if( $background == 'pattern' ){
			 		$classes[] = 'traveltour-background-pattern';
			 	}

			 	$border = traveltour_get_option('general', 'enable-boxed-border', 'disable');
			 	if( $border == 'enable' ){
			 		$classes[] = 'traveltour-boxed-border';
			 	}
			}else{
				$classes[] = 'traveltour-full';
			}


			if( is_page() ){
				$post_option = traveltour_get_post_option(get_the_ID());
			}

			if( empty($post_option['sticky-navigation']) || $post_option['sticky-navigation'] == 'default' ){
				$sticky_menu = traveltour_get_option('general', 'enable-main-navigation-sticky', 'enable');
			}else{
				$sticky_menu = $post_option['sticky-navigation'];
			}
			if( $sticky_menu == 'enable' ){
				$classes[] = ' traveltour-with-sticky-navigation';
				
				$sticky_menu_logo = traveltour_get_option('general', 'enable-logo-on-main-navigation-sticky', 'enable');
				if( $sticky_menu_logo == 'disable' ){
					$classes[] = ' traveltour-sticky-navigation-no-logo';
				}
			}

			return $classes;
		}
	}

	// Set the neccessary function to be used in the theme
	add_action('after_setup_theme', 'traveltour_theme_setup');
	if( !function_exists( 'traveltour_theme_setup' ) ){
		function traveltour_theme_setup(){
			
			// define textdomain for translation
			load_theme_textdomain('traveltour', get_template_directory() . '/languages');

			// add default posts and comments RSS feed links to head.
			add_theme_support('automatic-feed-links');

			// declare that this theme does not use a hard-coded <title> tag in <head>
			add_theme_support('title-tag');

			// tmce editor stylesheet
			add_editor_style('/css/editor-style.css');

			// define menu locations
			register_nav_menus(array(
				'main_menu' => esc_html__('Primary Menu', 'traveltour'),
				'right_menu' => esc_html__('Secondary Menu', 'traveltour'),
				'mobile_menu' => esc_html__('Mobile Menu', 'traveltour'),
			));

			// enable support for post formats / thumbnail
			add_theme_support('post-thumbnails');
			add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link', 'gallery', 'audio')); // 'status', 'chat'
			
			// switch default core markup
			add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
			
			// add custom image size
			$thumbnail_sizes = traveltour_get_option('plugin', 'thumbnail-sizing');
			if( !empty($thumbnail_sizes) ){
				foreach( $thumbnail_sizes as $thumbnail_size ){
					add_image_size($thumbnail_size['name'], $thumbnail_size['width'], $thumbnail_size['height'], true);
				}
			}

		}
	}

	// turn the page comment off by default
	add_filter( 'wp_insert_post_data', 'traveltour_page_default_comments_off' );
	if( !function_exists('traveltour_page_default_comments_off') ){
		function traveltour_page_default_comments_off( $data ) {
			if( $data['post_type'] == 'page' && $data['post_status'] == 'auto-draft' ) {
				$data['comment_status'] = 0;
			} 

			return $data;
		}
	}	

	// logo displaying
	if( !function_exists('traveltour_get_logo') ){
		function traveltour_get_logo($settings = array()){

			$extra_class  = (isset($settings['padding']) && $settings['padding'] === false)? '': ' traveltour-item-pdlr';
			
			$ret  = '<div class="traveltour-logo ' . esc_attr($extra_class) . '">';
			$ret .= '<div class="traveltour-logo-inner">';
		
			// print logo
			if( !empty($settings['mobile']) ){
				$logo_id = traveltour_get_option('general', 'mobile-logo');
			} 
			if( empty($logo_id) ){
				$logo_id = traveltour_get_option('general', 'logo');
			}

			$ret .= '<a href="' . esc_url(home_url('/')) . '" >';
			if( empty($logo_id) ){
				$ret .= gdlr_core_get_image(get_template_directory_uri() . '/images/logo.png');
			}else{
				$ret .= gdlr_core_get_image($logo_id);
			}
			$ret .= '</a>';

			$ret .= '</div>';
			$ret .= '</div>';

			return $ret;
		}	
	}

	// set anchor color
	add_action('wp_enqueue_scripts', 'traveltour_set_anchor_color', 11);
	if( !function_exists('traveltour_set_anchor_color') ){
		function traveltour_set_anchor_color(){
			$post_option = traveltour_get_post_option(get_the_ID());

			$anchor_css = '';
			if( !empty($post_option['bullet-anchor']) ){
				foreach( $post_option['bullet-anchor'] as $anchor ){
					if( !empty($anchor['title']) ){
						$anchor_section = str_replace('#', '', $anchor['title']);

						if( !empty($anchor['anchor-color']) ){
							$anchor_css .= '.traveltour-bullet-anchor[data-anchor-section="' . esc_attr($anchor_section) . '"] a:before{ background-color: ' . esc_html($anchor['anchor-color']) . '; }';
						}
						if( !empty($anchor['anchor-hover-color']) ){
							$anchor_css .= '.traveltour-bullet-anchor[data-anchor-section="' . esc_attr($anchor_section) . '"] a:hover, ';
							$anchor_css .= '.traveltour-bullet-anchor[data-anchor-section="' . esc_attr($anchor_section) . '"] a.current-menu-item{ border-color: ' . esc_html($anchor['anchor-hover-color']) . '; }';
							$anchor_css .= '.traveltour-bullet-anchor[data-anchor-section="' . esc_attr($anchor_section) . '"] a:hover:before, ';
							$anchor_css .= '.traveltour-bullet-anchor[data-anchor-section="' . esc_attr($anchor_section) . '"] a.current-menu-item:before{ background: ' . esc_html($anchor['anchor-hover-color']) . '; }';
						}
					}
				}
			}

			if( !empty($anchor_css) ){
				wp_add_inline_style('traveltour-style-core', $anchor_css);
			}
		}
	}

	// remove id from nav menu item
	add_filter('nav_menu_item_id', 'traveltour_nav_menu_item_id', 10, 4);
	if( !function_exists('traveltour_nav_menu_item_id') ){
		function traveltour_nav_menu_item_id( $id, $item, $args, $depth ){
			return '';
		}
	}

	// add additional script
	add_action('wp_enqueue_scripts', 'traveltour_header_script', 11);
	if( !function_exists('traveltour_header_script') ){
		function traveltour_header_script(){
			$header_script = traveltour_get_option('plugin', 'additional-head-script', '');
			if( !empty($header_script) ){
				echo '<script>' . $header_script . '</script>';
			}

			$header_script2 = traveltour_get_option('plugin', 'additional-head-script2', '');
			if( !empty($header_script2) ){
				echo gdlr_core_text_filter($header_script2);
			}
		}
	}
	add_action('wp_enqueue_scripts', 'traveltour_footer_script', 11);
	if( !function_exists('traveltour_footer_script') ){
		function traveltour_footer_script(){
			$footer_script = traveltour_get_option('plugin', 'additional-script', '');
			if( !empty($footer_script) ){
				wp_add_inline_script('traveltour-script-core', $footer_script);
			}

		}
	}

	remove_action('tgmpa_register', 'newsletter_register_required_plugins');