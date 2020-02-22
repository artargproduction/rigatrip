<?php
	// mobile menu template
	
	echo '<div class="traveltour-mobile-header-wrap" >';

	// top bar
	get_template_part('header/header', 'top-bar-mobile');

	// header
	echo '<div class="traveltour-mobile-header traveltour-header-background traveltour-style-slide" id="traveltour-mobile-header" >';
	echo '<div class="traveltour-mobile-header-container traveltour-container" >';
	echo traveltour_get_logo(array('mobile' => true));

	echo '<div class="traveltour-mobile-menu-right" >';

	// search icon
	$enable_search = (traveltour_get_option('general', 'enable-main-navigation-search', 'enable') == 'enable')? true: false;
	if( $enable_search ){
		echo '<div class="traveltour-main-menu-search" id="traveltour-mobile-top-search" >';
		echo '<i class="fa fa-search" ></i>';
		echo '</div>';
		traveltour_get_top_search();
	}

	// cart icon
	$enable_cart = (traveltour_get_option('general', 'enable-main-navigation-cart', 'enable') == 'enable' && class_exists('WooCommerce'))? true: false;
	if( $enable_cart ){
		echo '<div class="traveltour-main-menu-cart" id="traveltour-mobile-menu-cart" >';
		echo '<i class="fa fa-shopping-cart" ></i>';
		traveltour_get_woocommerce_bar();
		echo '</div>';
	}

	// mobile menu
	if( has_nav_menu('mobile_menu') ){
		traveltour_get_custom_menu(array(
			'type' => traveltour_get_option('general', 'right-menu-type', 'right'),
			'container-class' => 'traveltour-mobile-menu',
			'button-class' => 'traveltour-mobile-menu-button',
			'icon-class' => 'fa fa-bars',
			'id' => 'traveltour-mobile-menu',
			'theme-location' => 'mobile_menu'
		));
	}
	echo '</div>'; // traveltour-mobile-menu-right
	echo '</div>'; // traveltour-mobile-header-container
	echo '</div>'; // traveltour-mobile-header

	echo '</div>'; // traveltour-mobile-header-wrap