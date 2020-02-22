<?php
	/* a template for displaying the header area */

	$header_class = 'traveltour-' . traveltour_get_option('general', 'header-side-align', 'left') . '-align';
?>	
<header class="traveltour-header-wrap traveltour-header-style-side <?php echo esc_attr($header_class); ?>" >
	<?php

		echo traveltour_get_logo(array('padding' => false));

		$navigation_class = '';
		if( traveltour_get_option('general', 'enable-main-navigation-submenu-indicator', 'disable') == 'enable' ){
			$navigation_class = 'traveltour-navigation-submenu-indicator ';
		}
	?>
	<div class="traveltour-navigation clearfix traveltour-pos-middle <?php echo esc_attr($navigation_class); ?>" >
	<?php
		// print main menu
		if( has_nav_menu('main_menu') ){
			echo '<div class="traveltour-main-menu" id="traveltour-main-menu" >';
			wp_nav_menu(array(
				'theme_location'=>'main_menu', 
				'container'=> '', 
				'menu_class'=> 'sf-vertical'
			));
			echo '</div>';
		}

		// menu right side
		$enable_search = (traveltour_get_option('general', 'enable-main-navigation-search', 'enable') == 'enable')? true: false;
		$enable_cart = (traveltour_get_option('general', 'enable-main-navigation-cart', 'enable') == 'enable' && class_exists('WooCommerce'))? true: false;
		if( $enable_search || $enable_cart ){
			echo '<div class="traveltour-main-menu-right-wrap clearfix" >';

			// search icon
			if( $enable_search ){
				echo '<div class="traveltour-main-menu-search" id="traveltour-top-search" >';
				echo '<i class="fa fa-search" ></i>';
				echo '</div>';
				traveltour_get_top_search();
			}

			// cart icon
			if( $enable_cart ){
				echo '<div class="traveltour-main-menu-cart" id="traveltour-main-menu-cart" >';
				echo '<i class="fa fa-shopping-cart" ></i>';
				traveltour_get_woocommerce_bar();
				echo '</div>';
			}

			echo '</div>'; // traveltour-main-menu-right-wrap
		}
	?>
	</div><!-- traveltour-navigation -->
	<?php
		// social network
		$top_bar_social = traveltour_get_option('general', 'enable-top-bar-social', 'enable');
		if( $top_bar_social == 'enable' ){
			echo '<div class="traveltour-header-social traveltour-pos-bottom" >';
			get_template_part('header/header', 'social');
			echo '</div>';
			
			traveltour_set_option('general', 'enable-top-bar-social', 'disable');
		}
	?>
</header><!-- header -->