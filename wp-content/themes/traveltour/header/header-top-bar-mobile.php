<?php
	/* a template for displaying the top bar */

	$top_bar_left = traveltour_get_option('general', 'enable-top-bar-left-on-mobile', 'disable');
	$top_bar_right = traveltour_get_option('general', 'enable-top-bar-right-on-mobile', 'enable');
	if( $top_bar_left == 'enable' || $top_bar_right == 'enable' ){

		$top_bar_width = traveltour_get_option('general', 'top-bar-width', 'boxed');
		$top_bar_container_class = '';

		if( $top_bar_width == 'boxed' ){
			$top_bar_container_class = 'traveltour-container ';
		}else if( $top_bar_width == 'custom' ){
			$top_bar_container_class = 'traveltour-top-bar-custom-container ';
		}else{
			$top_bar_container_class = 'traveltour-top-bar-full ';
		}
		
		echo '<div class="traveltour-top-bar" >';
		echo '<div class="traveltour-top-bar-background" ></div>';
		echo '<div class="traveltour-top-bar-container clearfix ' . esc_attr($top_bar_container_class) . '" >';

		$language_flag = traveltour_get_wpml_flag();
		$left_text = traveltour_get_option('general', 'top-bar-left-text', '');
		if( (!empty($left_text) || !empty($language_flag)) ){
			echo '<div class="traveltour-top-bar-left traveltour-item-pdlr ' . ($top_bar_left == 'disable'? 'travel-tour-hide-on-mobile': '') . '">';
			echo gdlr_core_escape_content($language_flag);
			echo gdlr_core_text_filter($left_text);
			echo '</div>';
		}

		$right_text = traveltour_get_option('general', 'top-bar-right-text', '');
		$top_bar_social = traveltour_get_option('general', 'enable-top-bar-social', 'enable');
		echo '<div class="traveltour-top-bar-right traveltour-item-pdlr">';
		if( !empty($right_text) ){
			echo '<div class="traveltour-top-bar-right-text ' . ($top_bar_right == 'disable'? 'travel-tour-hide-on-mobile': '') . '">';
			echo gdlr_core_text_filter($right_text);
			echo '</div>';
		}

		if( $top_bar_social == 'enable' ){
			echo '<div class="traveltour-top-bar-right-social" >';
			get_template_part('header/header', 'social');
			echo '</div>';	
		}

		$top_bar_login = traveltour_get_option('general', 'enable-top-bar-right-login', 'enable');
		if( $top_bar_login == 'enable' && function_exists('tourmaster_user_top_bar') ){
			echo tourmaster_user_top_bar();
		}
		echo '</div>';
		echo '</div>';
		echo '</div>';

	}  // top bar
?>