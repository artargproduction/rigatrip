<?php
	/* a template for displaying the header top slider */

	$post_option = traveltour_get_post_option(get_the_ID());

	echo '<div class="traveltour-above-navigation-slider" >';
	if( $post_option['header-slider'] == 'layer-slider' ){
		echo do_shortcode('[layerslider id="' . esc_attr($post_option['layer-slider-id']) . '"]');
	}else if( $post_option['header-slider'] == 'master-slider' ){
		echo get_masterslider($post_option['master-slider-id']);
	}else if( $post_option['header-slider'] == 'revolution-slider' ){
		echo do_shortcode('[rev_slider alias="' . esc_attr($post_option['revolution-slider-id']) . '"]');
	}
	echo '</div>';