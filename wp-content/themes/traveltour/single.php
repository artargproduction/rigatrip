<?php
/**
 * The template for displaying all single posts and attachments
 */

get_header(); 

// switch_to_locale('en_US');
// switch_to_locale('th');

// esc_html_e('Post Comment', 'traveltour');

	// print header title
	if( get_post_type() == 'post' ){
		get_template_part('header/header', 'title-blog');
	}


	while( have_posts() ){ the_post();

		$post_option = traveltour_get_post_option(get_the_ID());

		if( empty($post_option['sidebar']) || $post_option['sidebar'] == 'default' ){
			$sidebar_type = traveltour_get_option('general', 'blog-sidebar', 'none');
			$sidebar_left = traveltour_get_option('general', 'blog-sidebar-left');
			$sidebar_right = traveltour_get_option('general', 'blog-sidebar-right');
		}else{
			$sidebar_type = empty($post_option['sidebar'])? 'none': $post_option['sidebar'];
			$sidebar_left = empty($post_option['sidebar-left'])? '': $post_option['sidebar-left'];
			$sidebar_right = empty($post_option['sidebar-right'])? '': $post_option['sidebar-right'];
		}

		echo '<div class="traveltour-content-container traveltour-container">';
		echo '<div class="' . traveltour_get_sidebar_wrap_class($sidebar_type) . '" >';

		// sidebar content
		echo '<div class="' . traveltour_get_sidebar_class(array('sidebar-type'=>$sidebar_type, 'section'=>'center')) . '" >';
		echo '<div class="traveltour-content-wrap traveltour-item-pdlr clearfix" >';

		// single content
		if( empty($post_option['show-content']) || $post_option['show-content'] == 'enable' ){
			echo '<div class="traveltour-content-area" >';
			if( in_array(get_post_format(), array('aside', 'quote', 'link')) ){
				get_template_part('content/content', get_post_format());
			}else{
				get_template_part('content/content', 'single');
			}
			echo '</div>';
		}

		if( !post_password_required() ){
			if( $sidebar_type != 'none' ){
				echo '<div class="traveltour-page-builder-wrap traveltour-item-rvpdlr" >';
				do_action('gdlr_core_print_page_builder');
				echo '</div>';
			}else{
				ob_start();
				do_action('gdlr_core_print_page_builder');
				$pb_content = ob_get_contents();
				ob_end_clean();

				if( !empty($pb_content) ){
					echo '</div>'; // traveltour-content-area
					echo '</div>'; // traveltour_get_sidebar_class
					echo '</div>'; // traveltour_get_sidebar_wrap_class
					echo '</div>'; // traveltour_content_container
					echo gdlr_core_escape_content($pb_content);
					echo '<div class="traveltour-bottom-page-builder-container traveltour-container" >'; // traveltour-content-area
					echo '<div class="traveltour-bottom-page-builder-sidebar-wrap traveltour-sidebar-style-none" >'; // traveltour_get_sidebar_class
					echo '<div class="traveltour-bottom-page-builder-sidebar-class" >'; // traveltour_get_sidebar_wrap_class
					echo '<div class="traveltour-bottom-page-builder-content traveltour-item-pdlr" >'; // traveltour_content_container
				}
			}
		}

		// social share
		if( traveltour_get_option('general', 'blog-social-share', 'enable') == 'enable' ){
			if( class_exists('gdlr_core_pb_element_social_share') ){
				$share_count = (traveltour_get_option('general', 'blog-social-share-count', 'enable') == 'enable')? 'counter': 'none';

				echo '<div class="traveltour-single-social-share traveltour-item-rvpdlr" >';
				echo gdlr_core_pb_element_social_share::get_content(array(
					'social-head' => $share_count,
					'layout'=>'left-text', 
					'text-align'=>'center',
					'facebook'=>traveltour_get_option('general', 'blog-social-facebook', 'enable'),
					'linkedin'=>traveltour_get_option('general', 'blog-social-linkedin', 'enable'),
					'google-plus'=>traveltour_get_option('general', 'blog-social-google-plus', 'enable'),
					'pinterest'=>traveltour_get_option('general', 'blog-social-pinterest', 'enable'),
					'stumbleupon'=>traveltour_get_option('general', 'blog-social-stumbleupon', 'enable'),
					'twitter'=>traveltour_get_option('general', 'blog-social-twitter', 'enable'),
					'email'=>traveltour_get_option('general', 'blog-social-email', 'enable'),
					'padding-bottom'=>'0px'
				));
				echo '</div>';
			}
		}

		// author section
		$author_desc = get_the_author_meta('description');
		if( !empty($author_desc) && traveltour_get_option('general', 'blog-author', 'enable') == 'enable' ){
			echo '<div class="clear"></div>';
			echo '<div class="traveltour-single-author" >';
			echo '<div class="traveltour-single-author-wrap" >';
			echo '<div class="traveltour-single-author-avartar traveltour-media-image">' . get_avatar(get_the_author_meta('ID'), 90) . '</div>';
			
			echo '<div class="traveltour-single-author-content-wrap" >';
			echo '<div class="traveltour-single-author-caption traveltour-info-font" >' . esc_html__('About the author', 'traveltour') . '</div>';
			echo '<h4 class="traveltour-single-author-title">';
			the_author_posts_link();
			echo '</h4>';

			echo '<div class="traveltour-single-author-description" >' . gdlr_core_text_filter($author_desc) . '</div>';
			echo '</div>'; // traveltour-single-author-content-wrap
			echo '</div>'; // traveltour-single-author-wrap
			echo '</div>'; // traveltour-single-author
		}

		// prev - next post navigation
		if( traveltour_get_option('general', 'blog-navigation', 'enable') == 'enable' ){
			$prev_post = get_previous_post_link(
				'<span class="traveltour-single-nav traveltour-single-nav-left">%link</span>',
				'<i class="arrow_left" ></i><span class="traveltour-text" >' . esc_html__( 'Prev', 'traveltour' ) . '</span>'
			);
			$next_post = get_next_post_link(
				'<span class="traveltour-single-nav traveltour-single-nav-right">%link</span>',
				'<span class="traveltour-text" >' . esc_html__( 'Next', 'traveltour' ) . '</span><i class="arrow_right" ></i>'
			);
			if( !empty($prev_post) || !empty($next_post) ){
				echo '<div class="traveltour-single-nav-area clearfix" >' . $prev_post . $next_post . '</div>';
			}
		}

		// comments template
		if( comments_open() || get_comments_number() ){
			comments_template();
		}

		echo '</div>'; // traveltour-content-area
		echo '</div>'; // traveltour-get-sidebar-class

		// sidebar left
		if( $sidebar_type == 'left' || $sidebar_type == 'both' ){
			echo traveltour_get_sidebar($sidebar_type, 'left', $sidebar_left);
		}

		// sidebar right
		if( $sidebar_type == 'right' || $sidebar_type == 'both' ){
			echo traveltour_get_sidebar($sidebar_type, 'right', $sidebar_right);
		}

		echo '</div>'; // traveltour-get-sidebar-wrap-class
	 	echo '</div>'; // traveltour-content-container

	} // while

	get_footer(); 
?>