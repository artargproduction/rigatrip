<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

	get_header();

	$sidebar_type = traveltour_get_option('general', 'woocommerce-archive-sidebar', 'none');
	$sidebar_left = traveltour_get_option('general', 'woocommerce-archive-sidebar-left');
	$sidebar_right = traveltour_get_option('general', 'woocommerce-archive-sidebar-right');		


	echo '<div class="traveltour-content-container traveltour-container">';
	echo '<div class="' . traveltour_get_sidebar_wrap_class($sidebar_type) . '" >';

	// sidebar content
	echo '<div class="' . traveltour_get_sidebar_class(array('sidebar-type'=>$sidebar_type, 'section'=>'center')) . '" >';
	
	if( class_exists('gdlr_core_pb_element_product') ){

		get_template_part('content/archive', 'product');

	}else{

		get_template_part('content/archive', 'default');
		
	}

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


	get_footer(); 
?>