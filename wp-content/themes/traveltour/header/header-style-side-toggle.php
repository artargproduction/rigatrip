<?php
	/* a template for displaying the header area */
?>	
<header class="traveltour-header-wrap traveltour-header-style-side-toggle" >
	<?php
		$display_logo = traveltour_get_option('general', 'header-side-toggle-display-logo', 'enable');
		if( $display_logo == 'enable' ){
			echo traveltour_get_logo(array('padding' => false));
		}

		$navigation_class = '';
		if( traveltour_get_option('general', 'enable-main-navigation-submenu-indicator', 'disable') == 'enable' ){
			$navigation_class = 'traveltour-navigation-submenu-indicator ';
		}
	?>
	<div class="traveltour-navigation clearfix <?php echo esc_attr($navigation_class); ?>" >
	<?php
		// print main menu
		if( has_nav_menu('main_menu') ){
			traveltour_get_custom_menu(array(
				'container-class' => 'traveltour-main-menu',
				'button-class' => 'traveltour-side-menu-icon',
				'icon-class' => 'fa fa-bars',
				'id' => 'traveltour-main-menu',
				'theme-location' => 'main_menu',
				'type' => traveltour_get_option('general', 'header-side-toggle-menu-type', 'overlay')
			));
		}
	?>
	</div><!-- traveltour-navigation -->
	<?php

		// menu right side
		$enable_search = (traveltour_get_option('general', 'enable-main-navigation-search', 'enable') == 'enable')? true: false;
		$enable_cart = (traveltour_get_option('general', 'enable-main-navigation-cart', 'enable') == 'enable' && class_exists('WooCommerce'))? true: false;
		if( $enable_search || $enable_cart ){ 
			echo '<div class="traveltour-header-icon traveltour-pos-bottom" >';

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
</header><!-- header -->