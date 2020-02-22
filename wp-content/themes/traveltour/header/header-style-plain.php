<?php
	/* a template for displaying the header area */

	// header container
	$body_layout = traveltour_get_option('general', 'layout', 'full');
	$body_margin = traveltour_get_option('general', 'body-margin', '0px');
	$header_width = traveltour_get_option('general', 'header-width', 'boxed');
	$header_background_style = traveltour_get_option('general', 'header-background-style', 'solid');
	
	if( $header_width == 'boxed' ){
		$header_container_class = ' traveltour-container';
	}else if( $header_width == 'custom' ){
		$header_container_class = ' traveltour-header-custom-container';
	}else{
		$header_container_class = ' traveltour-header-full';
	}

	$header_style = traveltour_get_option('general', 'header-plain-style', 'menu-right');
	$header_wrap_class  = ' traveltour-style-' . $header_style;
	$header_wrap_class .= ' traveltour-sticky-navigation';
	if( $header_style == 'center-logo' || $body_layout == 'boxed' || 
		$body_margin != '0px' || $header_background_style == 'transparent' ){
		
		$header_wrap_class .= ' traveltour-style-slide';
	}else{
		$header_wrap_class .= ' traveltour-style-fixed';
	}
?>	
<header class="traveltour-header-wrap traveltour-header-style-plain <?php echo esc_attr($header_wrap_class); ?>" >
	<div class="traveltour-header-background" ></div>
	<div class="traveltour-header-container <?php echo esc_attr($header_container_class); ?>">
			
		<div class="traveltour-header-container-inner clearfix">
			<?php

				if( $header_style == 'splitted-menu' ){
					add_filter('traveltour_center_menu_item', 'traveltour_get_logo');
				}else{
					echo traveltour_get_logo();
				}

				$navigation_class = '';
				if( traveltour_get_option('general', 'enable-main-navigation-submenu-indicator', 'disable') == 'enable' ){
					$navigation_class = 'traveltour-navigation-submenu-indicator ';
				}
			?>
			<div class="traveltour-navigation traveltour-item-pdlr clearfix <?php echo esc_attr($navigation_class); ?>" >
			<?php
				// print main menu
				if( has_nav_menu('main_menu') ){
					echo '<div class="traveltour-main-menu" id="traveltour-main-menu" >';
					wp_nav_menu(array(
						'theme_location'=>'main_menu', 
						'container'=> '', 
						'menu_class'=> 'sf-menu',
						'walker' => new traveltour_menu_walker()
					));
					$slide_bar = traveltour_get_option('general', 'navigation-slide-bar', 'enable');
					if( $slide_bar == 'enable' ){
						echo '<div class="traveltour-navigation-slide-bar" id="traveltour-navigation-slide-bar" ></div>';
					}
					echo '</div>';
				}

				// menu right side
				$menu_right_class = '';
				if( in_array($header_style, array('center-menu', 'center-logo', 'splitted-menu')) ){
					$menu_right_class = ' traveltour-item-mglr traveltour-navigation-top';
				}

				$enable_search = (traveltour_get_option('general', 'enable-main-navigation-search', 'enable') == 'enable')? true: false;
				$enable_cart = (traveltour_get_option('general', 'enable-main-navigation-cart', 'enable') == 'enable' && class_exists('WooCommerce'))? true: false;
				$enable_right_button = (traveltour_get_option('general', 'enable-main-navigation-right-button', 'disable') == 'enable')? true: false;
				if( has_nav_menu('right_menu') || $enable_search || $enable_cart || $enable_right_button ){
					echo '<div class="traveltour-main-menu-right-wrap clearfix ' . esc_attr($menu_right_class) . '" >';

					// search icon
					if( $enable_search ){
						echo '<div class="traveltour-main-menu-search" id="traveltour-top-search" >';
						echo '<i class="fa fa-search" ></i>';
						echo '</div>';
						traveltour_get_top_search();
					}

					// cart icon
					if( $enable_cart ){
						echo '<div class="traveltour-main-menu-cart" id="traveltour-menu-cart" >';
						echo '<i class="fa fa-shopping-cart" ></i>';
						traveltour_get_woocommerce_bar();
						echo '</div>';
					}

					// menu right button
					if( $enable_right_button ){
						$button_link = traveltour_get_option('general', 'main-navigation-right-button-link', '');
						$button_link_target = traveltour_get_option('general', 'main-navigation-right-button-link-target', '_self');
						echo '<a class="traveltour-main-menu-right-button" href="' . esc_url($button_link) . '" target="' . esc_attr($button_link_target) . '" >';
						echo traveltour_get_option('general', 'main-navigation-right-button-text', '');
						echo '</a>';
					}

					// print right menu
					if( has_nav_menu('right_menu') && $header_style != 'splitted-menu' ){
						traveltour_get_custom_menu(array(
							'container-class' => 'traveltour-main-menu-right',
							'button-class' => 'traveltour-right-menu-button traveltour-top-menu-button',
							'icon-class' => 'fa fa-bars',
							'id' => 'traveltour-right-menu',
							'theme-location' => 'right_menu',
							'type' => traveltour_get_option('general', 'right-menu-type', 'right')
						));
					}

					echo '</div>'; // traveltour-main-menu-right-wrap

					if( has_nav_menu('right_menu') && $header_style == 'splitted-menu'  ){
						echo '<div class="traveltour-main-menu-left-wrap clearfix traveltour-item-pdlr traveltour-navigation-top" >';
						traveltour_get_custom_menu(array(
							'container-class' => 'traveltour-main-menu-right',
							'button-class' => 'traveltour-right-menu-button traveltour-top-menu-button',
							'icon-class' => 'fa fa-bars',
							'id' => 'traveltour-right-menu',
							'theme-location' => 'right_menu',
							'type' => traveltour_get_option('general', 'right-menu-type', 'right')
						));
						echo '</div>';
					}
				}
			?>
			</div><!-- traveltour-navigation -->

		</div><!-- traveltour-header-inner -->
	</div><!-- traveltour-header-container -->
</header><!-- header -->