<?php
	/*	
	*	Goodlayers Option
	*	---------------------------------------------------------------------
	*	This file store an array of theme options
	*	---------------------------------------------------------------------
	*/	

	// add custom css for theme option
	add_filter('gdlr_core_theme_option_top_file_write', 'traveltour_gdlr_core_theme_option_top_file_write', 10, 2);
	if( !function_exists('traveltour_gdlr_core_theme_option_top_file_write') ){
		function traveltour_gdlr_core_theme_option_top_file_write( $css, $option_slug ){
			if( $option_slug != 'goodlayers_main_menu' ) return;

			ob_start();
?>
.traveltour-body h1, .traveltour-body h2, .traveltour-body h3, .traveltour-body h4, .traveltour-body h5, .traveltour-body h6{ margin-top: 0px; margin-bottom: 20px; line-height: 1.2; font-weight: 700; }
#poststuff .gdlr-core-page-builder-body h2{ padding: 0px; margin-bottom: 20px; line-height: 1.2; font-weight: 700; }
#poststuff .gdlr-core-page-builder-body h1{ padding: 0px; font-weight: 700; }
.gdlr-core-button{ text-transform: none; letter-spacing: 0px; font-weight: 600; }
.gdlr-core-body .gdlr-core-accordion-item-tab .gdlr-core-accordion-item-title,
.gdlr-core-body .gdlr-core-toggle-box-item-tab .gdlr-core-toggle-box-item-title{ text-transform: none; letter-spacing: 0px; }
.gdlr-core-blog-full .gdlr-core-blog-full-head{ margin-bottom: 22px; }
.gdlr-core-blog-full .gdlr-core-blog-title{ margin-top: 7px; margin-bottom: 0px; }
.gdlr-core-blog-full .gdlr-core-blog-thumbnail{ margin-bottom: 35px; }
.gdlr-core-style-blog-full-with-frame .gdlr-core-blog-thumbnail{ margin-bottom: 0px; }
.gdlr-core-blog-modern .gdlr-core-blog-info-wrapper .gdlr-core-head i{ font-size: 13px; }
.gdlr-core-blog-modern.gdlr-core-with-image .gdlr-core-blog-modern-content{ padding-bottom: 20px; }
.gdlr-core-blog-widget{ border-top: 0px; padding-top: 0px; margin-bottom: 28px; }
.gdlr-core-blog-info-wrapper .gdlr-core-blog-info{ font-size: 13px; font-weight: normal; text-transform: none; letter-spacing: 0px; }
.gdlr-core-title-item .gdlr-core-title-item-link{ font-size: 15px; margin-left: 25px; display: inline-block; }
.gdlr-core-title-item .gdlr-core-title-item-link .gdlr-core-separator{ margin-right: 13px; }
.gdlr-core-title-item .gdlr-core-title-item-left-icon{ float: none; line-height: 1; margin: 0px 15px 0px 0px; display: inline-block; }
.gdlr-core-title-item.gdlr-core-left-align .gdlr-core-title-item-link{ position: static; display: inline-block; margin-top: 0px; font-style: normal; }
.gdlr-core-block-item-title-wrap .gdlr-core-block-item-title{ font-weight: normal; letter-spacing: 0px; text-transform: none; }
.gdlr-core-block-item-title-wrap .gdlr-core-block-item-read-more{ font-size: 15px; }
.gdlr-core-block-item-title-wrap .gdlr-core-block-item-read-more:before{ content: "/"; margin-right: 13px; margin-left: 25px; }
.gdlr-core-block-item-title-wrap.gdlr-core-left-align .gdlr-core-separator{ display: none; }
.gdlr-core-block-item-title-wrap.gdlr-core-center-align .gdlr-core-block-item-read-more:before{ display: none; }
.gdlr-core-block-item-title-wrap.gdlr-core-center-align .gdlr-core-block-item-read-more:after{ font-family: fontAwesome; content: "\f178"; margin-left: 10px; }

body .gdlr-core-icon-list-item .gdlr-core-icon-list-icon-wrap{ margin-right: 20px; }
body .gdlr-core-icon-list-item .gdlr-core-icon-list-content{ font-weight: 500; }
body .gdlr-core-blog-content .gdlr-core-button{ font-size: 14px; padding: 12px 27px; }
body .gdlr-core-blog-info-wrapper .gdlr-core-head{ margin-top: 0px; display: inline-block; }
.gdlr-core-style-blog-full-with-frame .gdlr-core-blog-full-frame{ padding: 50px 50px 30px; }
body .gdlr-core-filterer-wrap.gdlr-core-style-text .gdlr-core-filterer{ font-size: 16px; font-weight: 600; text-transform: none; }
body .gdlr-core-portfolio-thumbnail .gdlr-core-portfolio-info{ font-style: normal; }
body .gdlr-core-portfolio-grid .gdlr-core-portfolio-content-wrap .gdlr-core-portfolio-info{ font-style: normal; }
.gdlr-core-portfolio-slider-widget-wrap{ padding-top: 0; margin-top: -10px; }
.gdlr-core-load-more-wrap.gdlr-core-js.traveltour-item-pdlr{ margin-top: -20px; }
.gdlr-core-newsletter-item.gdlr-core-style-round .gdlr-core-newsletter-email input[type="email"]{ padding: 10px 47px 10px 22px; }
.gdlr-core-flexslider-nav.gdlr-core-rectangle-style li.flex-nav-prev{ margin-right: 2px; }
.gdlr-core-recent-post-widget-content span.gdlr-core-head{ margin-right: 0px; }
.gdlr-core-recent-post-widget .gdlr-core-recent-post-widget-title{ font-size: 14px; font-weight: 600; }
.gdlr-core-recent-post-widget .gdlr-core-blog-info{ font-size: 12px; text-transform: none; letter-spacing: 0; }
.traveltour-sidebar-area.gdlr-core-column-15  span.gdlr-core-blog-info.gdlr-core-blog-info-font.gdlr-core-skin-caption.gdlr-core-blog-info-author{ display: none; }
.traveltour-sidebar-area.gdlr-core-column-15 .gdlr-core-recent-post-widget .gdlr-core-recent-post-widget-thumbnail{ max-width: 56px; }
.traveltour-sidebar-area.gdlr-core-column-15 .gdlr-core-recent-post-widget .gdlr-core-recent-post-widget-title{ font-size: 13px; margin-bottom: 4px; margin-top: 0px; }
.traveltour-sidebar-area.gdlr-core-column-15 .gdlr-core-recent-post-widget.clearfix{ margin-bottom: 20px; }
.traveltour-sidebar-area.gdlr-core-column-15 .traveltour-tour-widget .traveltour-thumbnail-ribbon { margin-bottom: 10px; }
.traveltour-sidebar-area.gdlr-core-column-15 .traveltour-tour-widget .traveltour-tour-content-info.traveltour-with-ribbon .traveltour-tour-price-wrap{ float: left; }

.gdlr-core-testimonial-item .gdlr-core-testimonial-position .gdlr-core-rating{ display: block; }
@media only screen and (max-width: 767px){
.gdlr-core-title-item .gdlr-core-title-item-link,
.gdlr-core-title-item.gdlr-core-left-align .gdlr-core-title-item-link{ display: block; margin-left: 0px; margin-top: 10px !important; }
.gdlr-core-title-item .gdlr-core-title-item-link .gdlr-core-separator{ display: none; }
.gdlr-core-block-item-title-wrap .gdlr-core-block-item-read-more:before{ display: none; }
.gdlr-core-block-item-title-wrap .gdlr-core-block-item-read-more{ display: block; margin-top: 10px; }
}

body .gdlr-core-center-align .gdlr-core-title-item-title i{ margin-right: 0px; }
body .gdlr-core-title-item .gdlr-core-title-item-title i{ margin-right: 0px; }
body .gdlr-core-block-item-title-wrap.gdlr-core-left-align .gdlr-core-separator{ display: none; }

/* custom */
.gdlr-core-testimonial-item .gdlr-core-flexslider .flex-control-nav{ margin-top: 48px; }
.tourmaster-transparent-bottom-border.tourmaster-small.tourmaster-form-field select, 
.tourmaster-transparent-bottom-border.tourmaster-small.tourmaster-form-field input[type="text"], 
.tourmaster-transparent-bottom-border.tourmaster-small.tourmaster-form-field input[type="email"], 
.tourmaster-transparent-bottom-border.tourmaster-small.tourmaster-form-field input[type="password"], 
.tourmaster-transparent-bottom-border.tourmaster-small.tourmaster-form-field textarea{ padding: 0px 0px 20px; height: 50px; }
.tourmaster-tour-search-item.tourmaster-style-column .tourmaster-transparent-bottom-border.tourmaster-small .tourmaster-tour-search-field{ padding-right: 25px; }
.tourmaster-form-field.tourmaster-transparent-bottom-border.tourmaster-small .tourmaster-combobox-wrap:after{ content: "\f107"; right: 0px; margin-top: -19px; }
.tourmaster-tour-search-wrap .tourmaster-transparent-bottom-border.tourmaster-small  .tourmaster-datepicker-wrap:after{ content: "\f073"; margin-top: -21px; }
.traveltour-top-bar-right-social a{ margin-left: 21px; }
.gdlr-core-widget-list-shortcode ul{ list-style: none; margin-left: 0px; padding-bottom: 5px; }
ul.gdlr-core-custom-menu-widget.gdlr-core-menu-style-plain li{ margin-bottom: 9px; }
.sf-menu > .traveltour-normal-menu ul{ margin-left: -3px; }
.tourmaster-search-style-2 .tourmaster-tour-order-filterer-wrap{ padding-left: 28px; padding-bottom: 11px; padding-top: 14px; }
.tourmaster-tour-order-filterer-wrap .tourmaster-tour-order-filterer-style{ margin-top: 2px; margin-right: 3px; }
.tourmaster-tour-search-item-style-2 .tourmaster-tour-search-item-head-title i{ font-size: 17px; }
.tourmaster-tour-search-item-style-2 .tourmaster-type-filter-item{ margin-bottom: 38px; }
.tourmaster-tour-search-item.tourmaster-style-full.tourmaster-tour-search-item-style-2 .tourmaster-tour-search-field{ margin-bottom: 36px; }
.gdlr-core-testimonial-item .gdlr-core-testimonial-frame{ padding: 45px 40px 45px; }
.tourmaster-tour-medium .tourmaster-tour-view-more{ padding: 14px 15px 14px; }

.tourmaster-tour-item .gdlr-core-flexslider[data-nav="navigation-outer"] .flex-direction-nav li a i{ font-size: 32px; width: auto; }
.tourmaster-tour-item .gdlr-core-flexslider[data-nav="navigation-outer"] .flex-direction-nav li a i:after { background: rgba(0,0,0,0.09); }
.archive .tourmaster-tour-grid-style-2 .tourmaster-tour-title,
.tourmaster-template-search .tourmaster-tour-grid-style-2 .tourmaster-tour-title{ font-size: 17px; }
.tourmaster-tour-category-grid-3 .tourmaster-tour-category-head-animate{ padding: 0px 50px 0px; }
.tourmaster-tour-item-column-4 .tourmaster-tour-grid-style-2.tourmaster-price-right-title .tourmaster-tour-title{ padding-right: 0px; }
<?php
			$css .= ob_get_contents();
			ob_end_clean(); 

			return $css;
		}
	}
	add_filter('gdlr_core_theme_option_bottom_file_write', 'traveltour_gdlr_core_theme_option_bottom_file_write', 10, 2);
	if( !function_exists('traveltour_gdlr_core_theme_option_bottom_file_write') ){
		function traveltour_gdlr_core_theme_option_bottom_file_write( $css, $option_slug ){
			if( $option_slug != 'goodlayers_main_menu' ) return;

			$general = get_option('traveltour_general');

			if( !empty($general['item-padding']) ){
				$margin = 2 * intval(str_replace('px', '', $general['item-padding']));
				if( !empty($margin) && is_numeric($margin) ){
					$css .= '.traveltour-item-mgb, .gdlr-core-item-mgb{ margin-bottom: ' . $margin . 'px; }';
				}
			}

			return $css;
		}
	}

	$traveltour_admin_option->add_element(array(
	
		// general head section
		'title' => esc_html__('General', 'traveltour'),
		'slug' => 'traveltour_general',
		'icon' => get_template_directory_uri() . '/include/options/images/general.png',
		'options' => array(
		
			'layout' => array(
				'title' => esc_html__('Layout', 'traveltour'),
				'options' => array(
					
					'layout' => array(
						'title' => esc_html__('Layout', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'full' => esc_html__('Full', 'traveltour'),
							'boxed' => esc_html__('Boxed', 'traveltour'),
						)
					),
					'boxed-layout-top-margin' => array(
						'title' => esc_html__('Box Layout Top/Bottom Margin', 'traveltour'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '150',
						'data-type' => 'pixel',
						'default' => '0px',
						'selector' => 'body.traveltour-boxed .traveltour-body-wrapper{ margin-top: #gdlr#; margin-bottom: #gdlr#; }',
						'condition' => array( 'layout' => 'boxed' ) 
					),
					'body-margin' => array(
						'title' => esc_html__('Body Magin ( Frame Spaces )', 'traveltour'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '100',
						'data-type' => 'pixel',
						'default' => '0px',
						'selector' => '.traveltour-body-wrapper.traveltour-with-frame, body.traveltour-full .traveltour-fixed-footer{ margin: #gdlr#; }',
						'condition' => array( 'layout' => 'full' ),
						'description' => esc_html__('This value will be automatically omitted for side header style.', 'traveltour'),
					),
					'background-type' => array(
						'title' => esc_html__('Background Type', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'color' => esc_html__('Color', 'traveltour'),
							'image' => esc_html__('Image', 'traveltour'),
							'pattern' => esc_html__('Pattern', 'traveltour'),
						),
						'condition' => array( 'layout' => 'boxed' )
					),
					'background-image' => array(
						'title' => esc_html__('Background Image', 'traveltour'),
						'type' => 'upload',
						'data-type' => 'file', 
						'selector' => 'body.traveltour-boxed.traveltour-background-image .traveltour-body-background{ background-image: url(#gdlr#); }',
						'condition' => array( 'layout' => 'boxed', 'background-type' => 'image' )
					),
					'background-pattern' => array(
						'title' => esc_html__('Background Type', 'traveltour'),
						'type' => 'radioimage',
						'data-type' => 'text',
						'options' => 'pattern', 
						'selector' => 'body.traveltour-boxed.traveltour-background-pattern .traveltour-body-outer-wrapper{ background-image: url(' . GDLR_CORE_URL . '/include/images/pattern/#gdlr#.png); }',
						'condition' => array( 'layout' => 'boxed', 'background-type' => 'pattern' ),
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'enable-boxed-border' => array(
						'title' => esc_html__('Enable Boxed Border', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'disable',
						'condition' => array( 'layout' => 'boxed', 'background-type' => 'pattern' ),
					),
					'item-padding' => array(
						'title' => esc_html__('Item Left/Right Spaces', 'traveltour'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '40',
						'data-type' => 'pixel',
						'default' => '15px',
						'description' => 'Space between each page items',
						'selector' => '.traveltour-item-pdlr, .gdlr-core-item-pdlr{ padding-left: #gdlr#; padding-right: #gdlr#; }' . 
							'.traveltour-item-rvpdlr, .gdlr-core-item-rvpdlr{ margin-left: -#gdlr#; margin-right: -#gdlr#; }' .
							'.gdlr-core-metro-rvpdlr{ margin-top: -#gdlr#; margin-right: -#gdlr#; margin-bottom: -#gdlr#; margin-left: -#gdlr#; }' .
							'.traveltour-item-mglr, .gdlr-core-item-mglr, .traveltour-navigation .sf-menu > .traveltour-mega-menu .sf-mega{ margin-left: #gdlr#; margin-right: #gdlr#; }'
					),
					'container-width' => array(
						'title' => esc_html__('Container Width', 'traveltour'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '1180px',
						'selector' => '.traveltour-container, .gdlr-core-container, body.traveltour-boxed .traveltour-body-wrapper, ' . 
							'body.traveltour-boxed .traveltour-fixed-footer .traveltour-footer-wrapper, body.traveltour-boxed .traveltour-fixed-footer .traveltour-copyright-wrapper{ max-width: #gdlr#; }' 
					),
					'container-padding' => array(
						'title' => esc_html__('Container Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '100',
						'data-type' => 'pixel',
						'default' => '15px',
						'selector' => '.traveltour-body-front .gdlr-core-container, .traveltour-body-front .traveltour-container{ padding-left: #gdlr#; padding-right: #gdlr#; }'  . 
							'.traveltour-body-front .traveltour-container .traveltour-container, .traveltour-body-front .traveltour-container .gdlr-core-container, '.
							'.traveltour-body-front .gdlr-core-container .gdlr-core-container{ padding-left: 0px; padding-right: 0px; }'
					),
					'sidebar-width' => array(
						'title' => esc_html__('Sidebar Width', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'30' => '50%', '20' => '33.33%', '15' => '25%', '12' => '20%', '10' => '16.67%'
						),
						'default' => 20,
					),
					'both-sidebar-width' => array(
						'title' => esc_html__('Both Sidebar Width', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'30' => '50%', '20' => '33.33%', '15' => '25%', '12' => '20%', '10' => '16.67%'
						),
						'default' => 15,
					),
					
				) // header-options
			), // header-nav

			'top-bar' => array(
				'title' => esc_html__('Top Bar', 'traveltour'),
				'options' => array(

					'enable-top-bar' => array(
						'title' => esc_html__('Enable Top Bar', 'traveltour'),
						'type' => 'checkbox',
					),
					'enable-top-bar-divider' => array(
						'title' => esc_html__('Enable Top Bar Divider', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'disable'
					),
					'enable-top-bar-left-on-mobile' => array(
						'title' => esc_html__('Enable Top Bar Left On Mobile', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'disable'
					),
					'enable-top-bar-right-on-mobile' => array(
						'title' => esc_html__('Enable Top Bar Right On Mobile', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'top-bar-width' => array(
						'title' => esc_html__('Top Bar Width', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'boxed' => esc_html__('Boxed ( Within Container )', 'traveltour'),
							'full' => esc_html__('Full', 'traveltour'),
							'custom' => esc_html__('Custom', 'traveltour'),
						),
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'wpml-flag-type' => array(
						'title' => esc_html__('WPML Flag Type (If Enabled)', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'icon' => esc_html__('Icon', 'traveltour'),
							'dropdown' => esc_html__('Dropdown', 'traveltour'),
						)
					),
					'top-bar-width-pixel' => array(
						'title' => esc_html__('Top Bar Width Pixel', 'traveltour'),
						'type' => 'text',
						'data-type' => 'pixel',
						'default' => '1140px',
						'condition' => array( 'enable-top-bar' => 'enable', 'top-bar-width' => 'custom' ),
						'selector' => '.traveltour-top-bar-container.traveltour-top-bar-custom-container{ max-width: #gdlr#; }'
					),
					'top-bar-full-side-padding' => array(
						'title' => esc_html__('Top Bar Full ( Left/Right ) Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '100',
						'data-type' => 'pixel',
						'default' => '15px',
						'selector' => '.traveltour-top-bar-container.traveltour-top-bar-full{ padding-right: #gdlr#; padding-left: #gdlr#; }',
						'condition' => array( 'enable-top-bar' => 'enable', 'top-bar-width' => 'full' )
					),
					'top-bar-left-text' => array(
						'title' => esc_html__('Top Bar Left Text', 'traveltour'),
						'type' => 'textarea',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'enable-top-bar-right-login' => array(
						'title' => esc_html__('Enable Top Bar Right Login', 'traveltour'),
						'type' => 'checkbox',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-right-text' => array(
						'title' => esc_html__('Top Bar Right Text', 'traveltour'),
						'type' => 'textarea',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-top-padding' => array(
						'title' => esc_html__('Top Bar Top Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
 						'default' => '10px',
						'selector' => '.traveltour-top-bar{ padding-top: #gdlr#; }' . 
							'.traveltour-top-bar-right > div:before{ padding-top: #gdlr#; margin-top: -#gdlr#; }',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-bottom-padding' => array(
						'title' => esc_html__('Top Bar Bottom Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
						'default' => '10px',
						'selector' => '.traveltour-top-bar{ padding-bottom: #gdlr#; }'  . 
							'.traveltour-top-bar-right > div:before{ padding-bottom: #gdlr#; margin-bottom: -#gdlr#; }',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-text-size' => array(
						'title' => esc_html__('Top Bar Text Size', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'default' => '15px',
						'selector' => '.traveltour-top-bar{ font-size: #gdlr#; }',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-bottom-border' => array(
						'title' => esc_html__('Top Bar Bottom Border', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '10',
						'default' => '0',
						'selector' => '.traveltour-top-bar{ border-bottom-width: #gdlr#; }',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),

				)
			), // top bar

			'top-bar-social' => array(
				'title' => esc_html__('Top Bar Social', 'traveltour'),
				'options' => array(
					'enable-top-bar-social' => array(
						'title' => esc_html__('Enable Top Bar Social', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'top-bar-social-delicious' => array(
						'title' => esc_html__('Top Bar Social Delicious Link', 'traveltour'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-email' => array(
						'title' => esc_html__('Top Bar Social Email Link', 'traveltour'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-deviantart' => array(
						'title' => esc_html__('Top Bar Social Deviantart Link', 'traveltour'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-digg' => array(
						'title' => esc_html__('Top Bar Social Digg Link', 'traveltour'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-facebook' => array(
						'title' => esc_html__('Top Bar Social Facebook Link', 'traveltour'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-flickr' => array(
						'title' => esc_html__('Top Bar Social Flickr Link', 'traveltour'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-google-plus' => array(
						'title' => esc_html__('Top Bar Social Google Plus Link', 'traveltour'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-lastfm' => array(
						'title' => esc_html__('Top Bar Social Lastfm Link', 'traveltour'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-linkedin' => array(
						'title' => esc_html__('Top Bar Social Linkedin Link', 'traveltour'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-pinterest' => array(
						'title' => esc_html__('Top Bar Social Pinterest Link', 'traveltour'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-rss' => array(
						'title' => esc_html__('Top Bar Social RSS Link', 'traveltour'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-skype' => array(
						'title' => esc_html__('Top Bar Social Skype Link', 'traveltour'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-stumbleupon' => array(
						'title' => esc_html__('Top Bar Social Stumbleupon Link', 'traveltour'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-tumblr' => array(
						'title' => esc_html__('Top Bar Social Tumblr Link', 'traveltour'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-twitter' => array(
						'title' => esc_html__('Top Bar Social Twitter Link', 'traveltour'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-vimeo' => array(
						'title' => esc_html__('Top Bar Social Vimeo Link', 'traveltour'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-youtube' => array(
						'title' => esc_html__('Top Bar Social Youtube Link', 'traveltour'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-instagram' => array(
						'title' => esc_html__('Top Bar Social Instagram Link', 'traveltour'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-snapchat' => array(
						'title' => esc_html__('Top Bar Social Snapchat Link', 'traveltour'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),

				)
			),			

			'header' => array(
				'title' => esc_html__('Header', 'traveltour'),
				'options' => array(

					'header-style' => array(
						'title' => esc_html__('Header Style', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'plain' => esc_html__('Plain', 'traveltour'),
							'bar' => esc_html__('Bar', 'traveltour'),
							'boxed' => esc_html__('Boxed', 'traveltour'),
							'side' => esc_html__('Side Menu', 'traveltour'),
							'side-toggle' => esc_html__('Side Menu Toggle', 'traveltour'),
						),
						'default' => 'plain',
					),
					'header-plain-style' => array(
						'title' => esc_html__('Header Plain Style', 'traveltour'),
						'type' => 'radioimage',
						'options' => array(
							'menu-right' => get_template_directory_uri() . '/images/header/plain-menu-right.jpg',
							'center-logo' => get_template_directory_uri() . '/images/header/plain-center-logo.jpg',
							'center-menu' => get_template_directory_uri() . '/images/header/plain-center-menu.jpg',
							'splitted-menu' => get_template_directory_uri() . '/images/header/plain-splitted-menu.jpg',
						),
						'default' => 'menu-right',
						'condition' => array( 'header-style' => 'plain' ),
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'header-plain-bottom-border' => array(
						'title' => esc_html__('Plain Header Bottom Border', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '10',
						'default' => '0',
						'selector' => '.traveltour-header-style-plain{ border-bottom-width: #gdlr#; }',
						'condition' => array( 'header-style' => array('plain') )
					),
					'header-bar-navigation-align' => array(
						'title' => esc_html__('Header Bar Style', 'traveltour'),
						'type' => 'radioimage',
						'options' => array(
							'left' => get_template_directory_uri() . '/images/header/bar-left.jpg',
							'center' => get_template_directory_uri() . '/images/header/bar-center.jpg',
							'center-logo' => get_template_directory_uri() . '/images/header/bar-center-logo.jpg',
						),
						'default' => 'center',
						'condition' => array( 'header-style' => 'bar' ),
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'header-background-style' => array(
						'title' => esc_html__('Header/Navigation Background Style', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'solid' => esc_html__('Solid', 'traveltour'),
							'transparent' => esc_html__('Transparent', 'traveltour'),
						),
						'default' => 'solid',
						'condition' => array( 'header-style' => array('plain', 'bar') )
					),
					'top-bar-background-opacity' => array(
						'title' => esc_html__('Top Bar Background Opacity', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '50',
						'condition' => array( 'header-style' => 'plain', 'header-background-style' => 'transparent' ),
						'selector' => '.traveltour-header-background-transparent .traveltour-top-bar-background{ opacity: #gdlr#; }'
					),
					'header-background-opacity' => array(
						'title' => esc_html__('Header Background Opacity', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '50',
						'condition' => array( 'header-style' => 'plain', 'header-background-style' => 'transparent' ),
						'selector' => '.traveltour-header-background-transparent .traveltour-header-background{ opacity: #gdlr#; }'
					),
					'navigation-background-opacity' => array(
						'title' => esc_html__('Navigation Background Opacity', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '50',
						'condition' => array( 'header-style' => 'bar', 'header-background-style' => 'transparent' ),
						'selector' => '.traveltour-navigation-bar-wrap.traveltour-style-transparent .traveltour-navigation-background{ opacity: #gdlr#; }'
					),
					'header-boxed-style' => array(
						'title' => esc_html__('Header Boxed Style', 'traveltour'),
						'type' => 'radioimage',
						'options' => array(
							'menu-right' => get_template_directory_uri() . '/images/header/boxed-menu-right.jpg',
							'center-menu' => get_template_directory_uri() . '/images/header/boxed-center-menu.jpg',
							'splitted-menu' => get_template_directory_uri() . '/images/header/boxed-splitted-menu.jpg',
						),
						'default' => 'menu-right',
						'condition' => array( 'header-style' => 'boxed' ),
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'boxed-top-bar-background-opacity' => array(
						'title' => esc_html__('Top Bar Background Opacity', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '0',
						'condition' => array( 'header-style' => 'boxed' ),
						'selector' => '.traveltour-header-boxed-wrap .traveltour-top-bar-background{ opacity: #gdlr#; }'
					),
					'boxed-top-bar-background-extend' => array(
						'title' => esc_html__('Top Bar Background Extend ( Bottom )', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0px',
						'data-max' => '200px',
						'default' => '0px',
						'condition' => array( 'header-style' => 'boxed' ),
						'selector' => '.traveltour-header-boxed-wrap .traveltour-top-bar-background{ margin-bottom: -#gdlr#; }'
					),
					'boxed-header-top-margin' => array(
						'title' => esc_html__('Header Top Margin', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0px',
						'data-max' => '200px',
						'default' => '0px',
						'condition' => array( 'header-style' => 'boxed' ),
						'selector' => '.traveltour-header-style-boxed{ margin-top: #gdlr#; }'
					),
					'header-side-style' => array(
						'title' => esc_html__('Header Side Style', 'traveltour'),
						'type' => 'radioimage',
						'options' => array(
							'top-left' => get_template_directory_uri() . '/images/header/side-top-left.jpg',
							'middle-left' => get_template_directory_uri() . '/images/header/side-middle-left.jpg',
							'top-right' => get_template_directory_uri() . '/images/header/side-top-right.jpg',
							'middle-right' => get_template_directory_uri() . '/images/header/side-middle-right.jpg',
						),
						'default' => 'top-left',
						'condition' => array( 'header-style' => 'side' ),
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'header-side-align' => array(
						'title' => esc_html__('Header Side Text Align', 'traveltour'),
						'type' => 'radioimage',
						'options' => 'text-align',
						'default' => 'left',
						'condition' => array( 'header-style' => 'side' )
					),
					'header-side-toggle-style' => array(
						'title' => esc_html__('Header Side Toggle Style', 'traveltour'),
						'type' => 'radioimage',
						'options' => array(
							'left' => get_template_directory_uri() . '/images/header/side-toggle-left.jpg',
							'right' => get_template_directory_uri() . '/images/header/side-toggle-right.jpg',
						),
						'default' => 'left',
						'condition' => array( 'header-style' => 'side-toggle' ),
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'header-side-toggle-menu-type' => array(
						'title' => esc_html__('Header Side Toggle Menu Type', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'left' => esc_html__('Left Slide Menu', 'traveltour'),
							'right' => esc_html__('Right Slide Menu', 'traveltour'),
							'overlay' => esc_html__('Overlay Menu', 'traveltour'),
						),
						'default' => 'overlay',
						'condition' => array( 'header-style' => 'side-toggle' )
					),
					'header-side-toggle-display-logo' => array(
						'title' => esc_html__('Display Logo', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'header-style' => 'side-toggle' )
					),
					'header-width' => array(
						'title' => esc_html__('Header Width', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'boxed' => esc_html__('Boxed ( Within Container )', 'traveltour'),
							'full' => esc_html__('Full', 'traveltour'),
							'custom' => esc_html__('Custom', 'traveltour'),
						),
						'condition' => array('header-style'=> array('plain', 'bar', 'boxed'))
					),
					'header-width-pixel' => array(
						'title' => esc_html__('Header Width Pixel', 'traveltour'),
						'type' => 'text',
						'data-type' => 'pixel',
						'default' => '1140px',
						'condition' => array('header-style'=> array('plain', 'bar', 'boxed'), 'header-width' => 'custom'),
						'selector' => '.traveltour-header-container.traveltour-header-custom-container{ max-width: #gdlr#; }'
					),
					'header-full-side-padding' => array(
						'title' => esc_html__('Header Full ( Left/Right ) Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '100',
						'data-type' => 'pixel',
						'default' => '15px',
						'selector' => '.traveltour-header-container.traveltour-header-full{ padding-right: #gdlr#; padding-left: #gdlr#; }',
						'condition' => array('header-style'=> array('plain', 'bar', 'boxed'), 'header-width'=>'full')
					),
					'boxed-header-frame-radius' => array(
						'title' => esc_html__('Header Frame Radius', 'traveltour'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '3px',
						'condition' => array( 'header-style' => 'boxed' ),
						'selector' => '.traveltour-header-boxed-wrap .traveltour-header-background{ border-radius: #gdlr#; -moz-border-radius: #gdlr#; -webkit-border-radius: #gdlr#; }'
					),
					'boxed-header-content-padding' => array(
						'title' => esc_html__('Header Content ( Left/Right ) Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '100',
						'data-type' => 'pixel',
						'default' => '30px',
						'selector' => '.traveltour-header-style-boxed .traveltour-header-container-item{ padding-left: #gdlr#; padding-right: #gdlr#; }' . 
							'.traveltour-navigation-right{ right: #gdlr#; } .traveltour-navigation-left{ left: #gdlr#; }',
						'condition' => array( 'header-style' => 'boxed' )
					),
					'navigation-text-top-margin' => array(
						'title' => esc_html__('Navigation Text Top Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
						'default' => '0px',
						'condition' => array( 'header-style' => 'plain', 'header-plain-style' => 'splitted-menu' ),
						'selector' => '.traveltour-header-style-plain.traveltour-style-splitted-menu .traveltour-navigation .sf-menu > li > a{ padding-top: #gdlr#; } ' .
							'.traveltour-header-style-plain.traveltour-style-splitted-menu .traveltour-main-menu-left-wrap,' .
							'.traveltour-header-style-plain.traveltour-style-splitted-menu .traveltour-main-menu-right-wrap{ padding-top: #gdlr#; }'
					),
					'navigation-text-top-margin-boxed' => array(
						'title' => esc_html__('Navigation Text Top Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
						'default' => '0px',
						'condition' => array( 'header-style' => 'boxed', 'header-boxed-style' => 'splitted-menu' ),
						'selector' => '.traveltour-header-style-boxed.traveltour-style-splitted-menu .traveltour-navigation .sf-menu > li > a{ padding-top: #gdlr#; } ' .
							'.traveltour-header-style-boxed.traveltour-style-splitted-menu .traveltour-main-menu-left-wrap,' .
							'.traveltour-header-style-boxed.traveltour-style-splitted-menu .traveltour-main-menu-right-wrap{ padding-top: #gdlr#; }'
					),
					'navigation-text-side-spacing' => array(
						'title' => esc_html__('Navigation Text Side ( Left / Right ) Spaces', 'traveltour'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '30',
						'data-type' => 'pixel',
						'default' => '13px',
						'selector' => '.traveltour-navigation .sf-menu > li{ padding-left: #gdlr#; padding-right: #gdlr#; }',
						'condition' => array( 'header-style' => array('plain', 'bar', 'boxed') )
					),
					'navigation-left-offset' => array(
						'title' => esc_html__('Navigation Left Offset Spaces', 'traveltour'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '0',
						'selector' => '.traveltour-navigation .traveltour-main-menu{ margin-left: #gdlr#; }'
					),
					'navigation-slide-bar' => array(
						'title' => esc_html__('Navigation Slide Bar', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'header-style' => array('plain', 'bar', 'boxed') )
					),
					'navigation-slide-bar-top-margin' => array(
						'title' => esc_html__('Navigation Slide Bar Top Margin', 'traveltour'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '',
						'selector' => '.traveltour-navigation .traveltour-navigation-slide-bar{ margin-top: #gdlr#; }',
						'condition' => array( 'header-style' => array('plain', 'bar', 'boxed'), 'navigation-slide-bar' => 'enable' )
					),
					'side-header-width-pixel' => array(
						'title' => esc_html__('Header Width Pixel', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '600',
						'default' => '340px',
						'condition' => array('header-style' => array('side', 'side-toggle')),
						'selector' => '.traveltour-header-side-nav{ width: #gdlr#; }' . 
							'.traveltour-header-side-content.traveltour-style-left{ margin-left: #gdlr#; }' .
							'.traveltour-header-side-content.traveltour-style-right{ margin-right: #gdlr#; }'
					),
					'side-header-side-padding' => array(
						'title' => esc_html__('Header Side Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
						'default' => '70px',
						'condition' => array('header-style' => 'side'),
						'selector' => '.traveltour-header-side-nav.traveltour-style-side{ padding-left: #gdlr#; padding-right: #gdlr#; }' . 
							'.traveltour-header-side-nav.traveltour-style-left .sf-vertical > li > ul.sub-menu{ padding-left: #gdlr#; }' .
							'.traveltour-header-side-nav.traveltour-style-right .sf-vertical > li > ul.sub-menu{ padding-right: #gdlr#; }'
					),
					'navigation-text-top-spacing' => array(
						'title' => esc_html__('Navigation Text Top / Bottom Spaces', 'traveltour'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '40',
						'data-type' => 'pixel',
						'default' => '16px',
						'selector' => ' .traveltour-navigation .sf-vertical > li{ padding-top: #gdlr#; padding-bottom: #gdlr#; }',
						'condition' => array( 'header-style' => array('side') )
					),
					'logo-right-text' => array(
						'title' => esc_html__('Header Right Text', 'traveltour'),
						'type' => 'textarea',
						'condition' => array('header-style' => 'bar'),
					),
					'logo-right-text-top-padding' => array(
						'title' => esc_html__('Header Right Text Top Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
						'default' => '30px',
						'condition' => array('header-style' => 'bar'),
						'selector' => '.traveltour-header-style-bar .traveltour-logo-right-text{ padding-top: #gdlr#; }'
					),

				)
			), // header
			
			'logo' => array(
				'title' => esc_html__('Logo', 'traveltour'),
				'options' => array(
					'logo' => array(
						'title' => esc_html__('Logo', 'traveltour'),
						'type' => 'upload'
					),
					'mobile-logo' => array(
						'title' => esc_html__('Mobile Logo', 'traveltour'),
						'type' => 'upload',
						'description' => esc_html__('Leave this option blank to use the same logo.', 'traveltour'),
					),
					'logo-top-padding' => array(
						'title' => esc_html__('Logo Top Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '200',
						'data-type' => 'pixel',
						'default' => '20px',
						'selector' => '.traveltour-logo{ padding-top: #gdlr#; }',
						'description' => esc_html__('This option will be omitted on splitted menu option.', 'traveltour'),
					),
					'logo-bottom-padding' => array(
						'title' => esc_html__('Logo Bottom Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '200',
						'data-type' => 'pixel',
						'default' => '20px',
						'selector' => '.traveltour-logo{ padding-bottom: #gdlr#; }',
						'description' => esc_html__('This option will be omitted on splitted menu option.', 'traveltour'),
					),
					'logo-left-padding' => array(
						'title' => esc_html__('Logo Left Padding', 'traveltour'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'selector' => '.traveltour-logo.traveltour-item-pdlr{ padding-left: #gdlr#; }',
						'description' => esc_html__('Leave this field blank for default value.', 'traveltour'),
					),
					'max-logo-width' => array(
						'title' => esc_html__('Max Logo Width', 'traveltour'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '200px',
						'selector' => '.traveltour-logo-inner{ max-width: #gdlr#; }'
					),
				
				)
			),
			'navigation' => array(
				'title' => esc_html__('Navigation', 'traveltour'),
				'options' => array(
					'main-navigation-top-padding' => array(
						'title' => esc_html__('Main Navigation Top Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '200',
						'data-type' => 'pixel',
						'default' => '25px',
						'selector' => '.traveltour-navigation{ padding-top: #gdlr#; }' . 
							'.traveltour-navigation-top{ top: #gdlr#; }'
					),
					'main-navigation-bottom-padding' => array(
						'title' => esc_html__('Main Navigation Bottom Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '200',
						'data-type' => 'pixel',
						'default' => '20px',
						'selector' => '.traveltour-navigation .sf-menu > li > a{ padding-bottom: #gdlr#; }'
					),
					'main-navigation-right-padding' => array(
						'title' => esc_html__('Main Navigation Right Padding', 'traveltour'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'selector' => '.traveltour-navigation.traveltour-item-pdlr{ padding-right: #gdlr#; }',
						'description' => esc_html__('Leave this field blank for default value.', 'traveltour'),
					),
					'enable-main-navigation-sticky' => array(
						'title' => esc_html__('Enable Fixed Navigation Bar', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable',
					),
					'enable-logo-on-main-navigation-sticky' => array(
						'title' => esc_html__('Enable Logo on Fixed Navigation Bar', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'enable-main-navigation-sticky' => 'enable' )
					),
					'enable-main-navigation-submenu-indicator' => array(
						'title' => esc_html__('Enable Main Navigation Submenu Indicator', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'disable',
					),
					'navigation-right-top-margin' => array(
						'title' => esc_html__('Navigation Right ( search/cart/button ) Top Margin ', 'traveltour'),
						'type' => 'text',
						'data-input-type' => 'pixel',
						'data-type' => 'pixel',
						'selector' => '.traveltour-main-menu-right-wrap{ margin-top: #gdlr# !important; }'
					),
					'enable-main-navigation-search' => array(
						'title' => esc_html__('Enable Main Navigation Search', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable',
					),
					'enable-main-navigation-cart' => array(
						'title' => esc_html__('Enable Main Navigation Cart ( Woocommerce )', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable',
						'description' => esc_html__('The icon only shows if the woocommerce plugin is activated', 'traveltour')
					),
					'enable-main-navigation-right-button' => array(
						'title' => esc_html__('Enable Main Navigation Right Button', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'disable',
						'description' => esc_html__('This option will be ignored on header side style', 'traveltour')
					),
					'main-navigation-right-button-text' => array(
						'title' => esc_html__('Main Navigation Right Button Text', 'traveltour'),
						'type' => 'text',
						'default' => esc_html__('Buy Now', 'traveltour'),
						'condition' => array( 'enable-main-navigation-right-button' => 'enable' ) 
					),
					'main-navigation-right-button-link' => array(
						'title' => esc_html__('Main Navigation Right Button Link', 'traveltour'),
						'type' => 'text',
						'condition' => array( 'enable-main-navigation-right-button' => 'enable' ) 
					),
					'main-navigation-right-button-link-target' => array(
						'title' => esc_html__('Main Navigation Right Button Link Target', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'_self' => esc_html__('Current Screen', 'traveltour'),
							'_blank' => esc_html__('New Window', 'traveltour'),
						),
						'condition' => array( 'enable-main-navigation-right-button' => 'enable' ) 
					),
					'right-menu-type' => array(
						'title' => esc_html__('Secondary/Mobile Menu Type', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'left' => esc_html__('Left Slide Menu', 'traveltour'),
							'right' => esc_html__('Right Slide Menu', 'traveltour'),
							'overlay' => esc_html__('Overlay Menu', 'traveltour'),
						),
						'default' => 'right'
					),
					'right-menu-style' => array(
						'title' => esc_html__('Secondary/Mobile Menu Style', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'hamburger-with-border' => esc_html__('Hamburger With Border', 'traveltour'),
							'hamburger' => esc_html__('Hamburger', 'traveltour'),
						),
						'default' => 'hamburger-with-border'
					),
					
				) // logo-options
			), // logo-navigation			
			
			'title-style' => array(
				'title' => esc_html__('Page Title Style', 'traveltour'),
				'options' => array(

					'default-title-style' => array(
						'title' => esc_html__('Default Page Title Style', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'small' => esc_html__('Small', 'traveltour'),
							'medium' => esc_html__('Medium', 'traveltour'),
							'large' => esc_html__('Large', 'traveltour'),
							'custom' => esc_html__('Custom', 'traveltour'),
						),
						'default' => 'small'
					),
					'default-title-align' => array(
						'title' => esc_html__('Default Page Title Alignment', 'traveltour'),
						'type' => 'radioimage',
						'options' => 'text-align',
						'default' => 'left'
					),
					'default-title-top-padding' => array(
						'title' => esc_html__('Default Page Title Top Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '350',
						'default' => '93px',
						'selector' => '.traveltour-page-title-wrap.traveltour-style-custom .traveltour-page-title-content{ padding-top: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'default-title-bottom-padding' => array(
						'title' => esc_html__('Default Page Title Bottom Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '350',
						'default' => '87px',
						'selector' => '.traveltour-page-title-wrap.traveltour-style-custom .traveltour-page-title-content{ padding-bottom: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'default-page-caption-top-margin' => array(
						'title' => esc_html__('Default Page Caption Top Margin', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
						'default' => '13px',						
						'selector' => '.traveltour-page-title-wrap.traveltour-style-custom .traveltour-page-caption{ margin-top: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'default-title-font-transform' => array(
						'title' => esc_html__('Default Page Title Font Transform', 'traveltour'),
						'type' => 'combobox',
						'data-type' => 'text',
						'options' => array(
							'default' => esc_html__('Default', 'traveltour'),
							'none' => esc_html__('None', 'traveltour'),
							'uppercase' => esc_html__('Uppercase', 'traveltour'),
							'lowercase' => esc_html__('Lowercase', 'traveltour'),
							'capitalize' => esc_html__('Capitalize', 'traveltour'),
						),
						'default' => 'default',
						'selector' => '.traveltour-page-title-wrap .traveltour-page-title{ text-transform: #gdlr#; }'
					),
					'default-title-font-size' => array(
						'title' => esc_html__('Default Page Title Font Size', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'default' => '37px',
						'selector' => '.traveltour-page-title-wrap.traveltour-style-custom .traveltour-page-title{ font-size: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'default-title-font-weight' => array(
						'title' => esc_html__('Default Page Title Font Weight', 'traveltour'),
						'type' => 'text',
						'data-type' => 'text',
						'selector' => '.traveltour-page-title-wrap .traveltour-page-title{ font-weight: #gdlr#; }',
						'description' => esc_html__('Eg. lighter, bold, normal, 300, 400, 600, 700, 800. Leave this field blank for default value (700).', 'traveltour')					
					),
					'default-title-letter-spacing' => array(
						'title' => esc_html__('Default Page Title Letter Spacing', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '20',
						'default' => '0px',
						'selector' => '.traveltour-page-title-wrap.traveltour-style-custom .traveltour-page-title{ letter-spacing: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'default-caption-font-size' => array(
						'title' => esc_html__('Default Page Caption Font Size', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'default' => '16px',
						'selector' => '.traveltour-page-title-wrap.traveltour-style-custom .traveltour-page-caption{ font-size: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'default-caption-font-weight' => array(
						'title' => esc_html__('Default Page Caption Font Weight', 'traveltour'),
						'type' => 'text',
						'data-type' => 'text',
						'selector' => '.traveltour-page-title-wrap .traveltour-page-caption, ' . 
									  '.traveltour-page-title-wrap.traveltour-style-custom .traveltour-page-caption{ font-weight: #gdlr#; }',
						'description' => esc_html__('Eg. lighter, bold, normal, 300, 400, 600, 700, 800. Leave this field blank for default value (400).', 'traveltour')					
					),
					'default-caption-letter-spacing' => array(
						'title' => esc_html__('Default Page Caption Letter Spacing', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '20',
						'default' => '0px',
						'selector' => '.traveltour-page-title-wrap.traveltour-style-custom .traveltour-page-caption{ letter-spacing: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'default-title-background-overlay-opacity' => array(
						'title' => esc_html__('Default Page Title Background Overlay Opacity', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '80',
						'selector' => '.traveltour-page-title-wrap .traveltour-page-title-overlay{ opacity: #gdlr#; }'
					),
				) 
			), // title style

			'title-background' => array(
				'title' => esc_html__('Page Title Background', 'traveltour'),
				'options' => array(

					'default-title-background' => array(
						'title' => esc_html__('Default Page Title Background', 'traveltour'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => '.traveltour-page-title-wrap{ background-image: url(#gdlr#); }'
					),
					'default-portfolio-title-background' => array(
						'title' => esc_html__('Default Portfolio Title Background', 'traveltour'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => 'body.single-portfolio .traveltour-page-title-wrap{ background-image: url(#gdlr#); }'
					),
					'default-personnel-title-background' => array(
						'title' => esc_html__('Default Personnel Title Background', 'traveltour'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => 'body.single-personnel .traveltour-page-title-wrap{ background-image: url(#gdlr#); }'
					),
					'default-search-title-background' => array(
						'title' => esc_html__('Default Search Title Background', 'traveltour'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => 'body.search .traveltour-page-title-wrap{ background-image: url(#gdlr#); }'
					),
					'default-archive-title-background' => array(
						'title' => esc_html__('Default Archive Title Background', 'traveltour'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => 'body.archive .traveltour-page-title-wrap{ background-image: url(#gdlr#); }'
					),
					'default-404-background' => array(
						'title' => esc_html__('Default 404 Background', 'traveltour'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => '.traveltour-not-found-wrap .traveltour-not-found-background{ background-image: url(#gdlr#); }'
					),
					'default-404-background-opacity' => array(
						'title' => esc_html__('Default 404 Background Opacity', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '27',
						'selector' => '.traveltour-not-found-wrap .traveltour-not-found-background{ opacity: #gdlr#; }'
					),

				) 
			), // title background

			'blog-title-style' => array(
				'title' => esc_html__('Blog Title Style', 'traveltour'),
				'options' => array(

					'default-blog-title-style' => array(
						'title' => esc_html__('Default Blog Title Style', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'small' => esc_html__('Small', 'traveltour'),
							'large' => esc_html__('Large', 'traveltour'),
							'custom' => esc_html__('Custom', 'traveltour'),
							'inside-content' => esc_html__('Inside Content', 'traveltour'),
							'none' => esc_html__('None', 'traveltour'),
						),
						'default' => 'small'
					),
					'default-blog-title-top-padding' => array(
						'title' => esc_html__('Default Blog Title Top Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '400',
						'default' => '93px',
						'selector' => '.traveltour-blog-title-wrap.traveltour-style-custom .traveltour-blog-title-content{ padding-top: #gdlr#; }',
						'condition' => array( 'default-blog-title-style' => 'custom' )
					),
					'default-blog-title-bottom-padding' => array(
						'title' => esc_html__('Default Blog Title Bottom Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '400',
						'default' => '87px',
						'selector' => '.traveltour-blog-title-wrap.traveltour-style-custom .traveltour-blog-title-content{ padding-bottom: #gdlr#; }',
						'condition' => array( 'default-blog-title-style' => 'custom' )
					),
					'default-blog-feature-image' => array(
						'title' => esc_html__('Default Blog Feature Image Location', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'content' => esc_html__('Inside Content', 'traveltour'),
							'title-background' => esc_html__('Title Background', 'traveltour'),
							'none' => esc_html__('None', 'traveltour'),
						),
						'default' => 'content',
						'condition' => array( 'default-blog-title-style' => array('small', 'large', 'custom') )
					),
					'default-blog-title-background-image' => array(
						'title' => esc_html__('Default Blog Title Background Image', 'traveltour'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => '.traveltour-blog-title-wrap{ background-image: url(#gdlr#); }',
						'condition' => array( 'default-blog-title-style' => array('small', 'large', 'custom') )
					),
					'default-blog-title-background-overlay-opacity' => array(
						'title' => esc_html__('Default Blog Title Background Overlay Opacity', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '80',
						'selector' => '.traveltour-blog-title-wrap .traveltour-blog-title-overlay{ opacity: #gdlr#; }',
						'condition' => array( 'default-blog-title-style' => array('small', 'large', 'custom') )
					),
					'default-blog-title-background-gradient' => array(
						'title' => esc_html__('Default Blog Title Background Gradient ( Only For Feature Image )', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'both' => esc_html__('Both', 'traveltour'),
							'top' => esc_html__('Top', 'traveltour'),
							'bottom' => esc_html__('Bottom', 'traveltour'),
							'none' => esc_html__('None', 'traveltour'),
						),
						'default' => 'both'
					),
					'single-blog-title-top-gradient-size' => array(
						'title' => esc_html__('Single Blog Title Top Gradient Size', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '1000',
 						'default' => '450px',
						'selector' => '.traveltour-blog-title-wrap.traveltour-feature-image .traveltour-blog-title-top-overlay{ height: #gdlr#; }',
						'condition' => array( 'default-blog-title-background-gradient' => array('top', 'both') )
					),
					'single-blog-title-bottom-gradient-size' => array(
						'title' => esc_html__('Single Blog Title Bottom Gradient Size', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '1000',
 						'default' => '400px',
						'selector' => '.traveltour-blog-title-wrap.traveltour-feature-image .traveltour-blog-title-bottom-overlay{ height: #gdlr#; }',
						'condition' => array( 'default-blog-title-background-gradient' => array('bottom', 'both') )
					),

				) 
			), // post title style			

			'blog-style' => array(
				'title' => esc_html__('Blog Style', 'traveltour'),
				'options' => array(
					'blog-sidebar' => array(
						'title' => esc_html__('Single Blog Sidebar ( Default )', 'traveltour'),
						'type' => 'radioimage',
						'options' => 'sidebar',
						'default' => 'none',
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'blog-sidebar-left' => array(
						'title' => esc_html__('Single Blog Sidebar Left ( Default )', 'traveltour'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'blog-sidebar'=>array('left', 'both') )
					),
					'blog-sidebar-right' => array(
						'title' => esc_html__('Single Blog Sidebar Right ( Default )', 'traveltour'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'blog-sidebar'=>array('right', 'both') )
					),
					'blog-max-content-width' => array(
						'title' => esc_html__('Single Blog Max Content Width ( No sidebar layout )', 'traveltour'),
						'type' => 'text',
						'data-type' => 'text',
						'data-input-type' => 'pixel',
						'default' => '900px',
						'selector' => 'body.single-post .traveltour-sidebar-style-none, body.blog .traveltour-sidebar-style-none{ max-width: #gdlr#; }'
					),
					'blog-thumbnail-size' => array(
						'title' => esc_html__('Single Blog Thumbnail Size', 'traveltour'),
						'type' => 'combobox',
						'options' => 'thumbnail-size',
						'default' => 'full'
					),
					'blog-date-feature' => array(
						'title' => esc_html__('Enable Blog Date Feature', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'meta-option' => array(
						'title' => esc_html__('Meta Option', 'traveltour'),
						'type' => 'multi-combobox',
						'options' => array( 
							'date' => esc_html__('Date', 'traveltour'),
							'author' => esc_html__('Author', 'traveltour'),
							'category' => esc_html__('Category', 'traveltour'),
							'tag' => esc_html__('Tag', 'traveltour'),
							'comment' => esc_html__('Comment', 'traveltour'),
							'comment-number' => esc_html__('Comment Number', 'traveltour'),
						),
						'default' => array('author', 'category', 'tag', 'comment-number')
					),
					'blog-author' => array(
						'title' => esc_html__('Enable Single Blog Author', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'blog-navigation' => array(
						'title' => esc_html__('Enable Single Blog Navigation', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'pagination-style' => array(
						'title' => esc_html__('Pagination Style', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'plain' => esc_html__('Plain', 'traveltour'),
							'rectangle' => esc_html__('Rectangle', 'traveltour'),
							'rectangle-border' => esc_html__('Rectangle Border', 'traveltour'),
							'round' => esc_html__('Round', 'traveltour'),
							'round-border' => esc_html__('Round Border', 'traveltour'),
							'circle' => esc_html__('Circle', 'traveltour'),
							'circle-border' => esc_html__('Circle Border', 'traveltour'),
						),
						'default' => 'round'
					),
					'pagination-align' => array(
						'title' => esc_html__('Pagination Alignment', 'traveltour'),
						'type' => 'radioimage',
						'options' => 'text-align',
						'default' => 'right'
					),
				) // blog-style-options
			), // blog-style-nav

			'blog-social-share' => array(
				'title' => esc_html__('Blog Social Share', 'traveltour'),
				'options' => array(
					'blog-social-share' => array(
						'title' => esc_html__('Enable Single Blog Share', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'blog-social-share-count' => array(
						'title' => esc_html__('Enable Single Blog Share Count', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'blog-social-facebook' => array(
						'title' => esc_html__('Facebook', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable'
					),			
					'blog-social-linkedin' => array(
						'title' => esc_html__('Linkedin', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'disable'
					),			
					'blog-social-google-plus' => array(
						'title' => esc_html__('Google Plus', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable'
					),			
					'blog-social-pinterest' => array(
						'title' => esc_html__('Pinterest', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable'
					),			
					'blog-social-stumbleupon' => array(
						'title' => esc_html__('Stumbleupon', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'disable'
					),			
					'blog-social-twitter' => array(
						'title' => esc_html__('Twitter', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable'
					),			
					'blog-social-email' => array(
						'title' => esc_html__('Email', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'disable'
					),
				) // blog-style-options
			), // blog-style-nav
			
			'search-archive' => array(
				'title' => esc_html__('Search/Archive', 'traveltour'),
				'options' => array(
					'archive-blog-sidebar' => array(
						'title' => esc_html__('Archive Blog Sidebar', 'traveltour'),
						'type' => 'radioimage',
						'options' => 'sidebar',
						'default' => 'right',
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'archive-blog-sidebar-left' => array(
						'title' => esc_html__('Archive Blog Sidebar Left', 'traveltour'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'archive-blog-sidebar'=>array('left', 'both') )
					),
					'archive-blog-sidebar-right' => array(
						'title' => esc_html__('Archive Blog Sidebar Right', 'traveltour'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'archive-blog-sidebar'=>array('right', 'both') )
					),
					'archive-blog-style' => array(
						'title' => esc_html__('Archive Blog Style', 'traveltour'),
						'type' => 'radioimage',
						'options' => array(
							'blog-full' => GDLR_CORE_URL . '/include/images/blog-style/blog-full.png',
							'blog-full-with-frame' => GDLR_CORE_URL . '/include/images/blog-style/blog-full-with-frame.png',
							'blog-column' => GDLR_CORE_URL . '/include/images/blog-style/blog-column.png',
							'blog-column-with-frame' => GDLR_CORE_URL . '/include/images/blog-style/blog-column-with-frame.png',
							'blog-column-no-space' => GDLR_CORE_URL . '/include/images/blog-style/blog-column-no-space.png',
							'blog-image' => GDLR_CORE_URL . '/include/images/blog-style/blog-image.png',
							'blog-image-no-space' => GDLR_CORE_URL . '/include/images/blog-style/blog-image-no-space.png',
							'blog-left-thumbnail' => GDLR_CORE_URL . '/include/images/blog-style/blog-left-thumbnail.png',
							'blog-right-thumbnail' => GDLR_CORE_URL . '/include/images/blog-style/blog-right-thumbnail.png',
						),
						'default' => 'blog-full',
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'archive-blog-full-alignment' => array(
						'title' => esc_html__('Archive Blog Full Alignment', 'traveltour'),
						'type' => 'combobox',
						'default' => 'enable',
						'options' => array(
							'left' => esc_html__('Left', 'traveltour'),
							'center' => esc_html__('Center', 'traveltour'),
						),
						'condition' => array( 'archive-blog-style' => array('blog-full', 'blog-full-with-frame') )
					),
					'archive-thumbnail-size' => array(
						'title' => esc_html__('Archive Thumbnail Size', 'traveltour'),
						'type' => 'combobox',
						'options' => 'thumbnail-size'
					),
					'archive-show-thumbnail' => array(
						'title' => esc_html__('Archive Show Thumbnail', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'archive-blog-style' => array('blog-full', 'blog-full-with-frame', 'blog-column', 'blog-column-with-frame', 'blog-column-no-space', 'blog-left-thumbnail', 'blog-right-thumbnail') )
					),
					'archive-column-size' => array(
						'title' => esc_html__('Archive Column Size', 'traveltour'),
						'type' => 'combobox',
						'options' => array( 60 => 1, 30 => 2, 20 => 3, 15 => 4, 12 => 5 ),
						'default' => 20,
						'condition' => array( 'archive-blog-style' => array('blog-column', 'blog-column-with-frame', 'blog-column-no-space', 'blog-image', 'blog-image-no-space') )
					),
					'archive-excerpt' => array(
						'title' => esc_html__('Archive Excerpt Type', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'specify-number' => esc_html__('Specify Number', 'traveltour'),
							'show-all' => esc_html__('Show All ( use <!--more--> tag to cut the content )', 'traveltour'),
						),
						'default' => 'specify-number',
						'condition' => array('archive-blog-style' => array('blog-full', 'blog-full-with-frame', 'blog-column', 'blog-column-with-frame', 'blog-column-no-space', 'blog-left-thumbnail', 'blog-right-thumbnail'))
					),
					'archive-excerpt-number' => array(
						'title' => esc_html__('Archive Excerpt Number', 'traveltour'),
						'type' => 'text',
						'default' => 55,
						'data-input-type' => 'number',
						'condition' => array('archive-blog-style' => array('blog-full', 'blog-full-with-frame', 'blog-column', 'blog-column-with-frame', 'blog-column-no-space', 'blog-left-thumbnail', 'blog-right-thumbnail'), 'archive-excerpt' => 'specify-number')
					),
					'archive-date-feature' => array(
						'title' => esc_html__('Enable Blog Date Feature', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'archive-blog-style' => array('blog-full', 'blog-full-with-frame', 'blog-left-thumbnail', 'blog-right-thumbnail') )
					),
					'archive-meta-option' => array(
						'title' => esc_html__('Archive Meta Option', 'traveltour'),
						'type' => 'multi-combobox',
						'options' => array( 
							'date' => esc_html__('Date', 'traveltour'),
							'author' => esc_html__('Author', 'traveltour'),
							'category' => esc_html__('Category', 'traveltour'),
							'tag' => esc_html__('Tag', 'traveltour'),
							'comment' => esc_html__('Comment', 'traveltour'),
							'comment-number' => esc_html__('Comment Number', 'traveltour'),
						),
						'default' => array('date', 'author', 'category')
					),
					'archive-show-read-more' => array(
						'title' => esc_html__('Archive Show Read More Button', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array('archive-blog-style' => array('blog-full', 'blog-full-with-frame', 'blog-left-thumbnail', 'blog-right-thumbnail'),)
					),
				)
			),

			'woocommerce-style' => array(
				'title' => esc_html__('Woocommerce Style', 'traveltour'),
				'options' => array(

					'woocommerce-archive-sidebar' => array(
						'title' => esc_html__('Woocommerce Archive Sidebar', 'traveltour'),
						'type' => 'radioimage',
						'options' => 'sidebar',
						'default' => 'right',
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'woocommerce-archive-sidebar-left' => array(
						'title' => esc_html__('Woocommerce Archive Sidebar Left', 'traveltour'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'woocommerce-archive-sidebar'=>array('left', 'both') )
					),
					'woocommerce-archive-sidebar-right' => array(
						'title' => esc_html__('Woocommerce Archive Sidebar Right', 'traveltour'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'woocommerce-archive-sidebar'=>array('right', 'both') )
					),
					'woocommerce-archive-column-size' => array(
						'title' => esc_html__('Woocommerce Archive Column Size', 'traveltour'),
						'type' => 'combobox',
						'options' => array( 60 => 1, 30 => 2, 20 => 3, 15 => 4, 12 => 5, 10 => 6, ),
						'default' => 15
					),
					'woocommerce-archive-thumbnail' => array(
						'title' => esc_html__('Woocommerce Archive Thumbnail Size', 'traveltour'),
						'type' => 'combobox',
						'options' => 'thumbnail-size',
						'default' => 'full'
					),
					'woocommerce-related-product-column-size' => array(
						'title' => esc_html__('Woocommerce Related Product Column Size', 'traveltour'),
						'type' => 'combobox',
						'options' => array( 60 => 1, 30 => 2, 20 => 3, 15 => 4, 12 => 5, 10 => 6, ),
						'default' => 15
					),
					'woocommerce-related-product-num-fetch' => array(
						'title' => esc_html__('Woocommerce Related Product Num Fetch', 'traveltour'),
						'type' => 'text',
						'default' => 4,
						'data-input-type' => 'number'
					),
					'woocommerce-related-product-thumbnail' => array(
						'title' => esc_html__('Woocommerce Related Product Thumbnail Size', 'traveltour'),
						'type' => 'combobox',
						'options' => 'thumbnail-size',
						'default' => 'full'
					),
				)
			),

			'portfolio-style' => array(
				'title' => esc_html__('Portfolio Style', 'traveltour'),
				'options' => array(
					'portfolio-slug' => array(
						'title' => esc_html__('Portfolio Slug (Permalink)', 'traveltour'),
						'type' => 'text',
						'default' => 'portfolio',
						'description' => esc_html__('Please save the "Settings > Permalink" area once after made a changes to this field.', 'traveltour')
					),
					'portfolio-category-slug' => array(
						'title' => esc_html__('Portfolio Category Slug (Permalink)', 'traveltour'),
						'type' => 'text',
						'default' => 'portfolio_category',
						'description' => esc_html__('Please save the "Settings > Permalink" area once after made a changes to this field.', 'traveltour')
					),
					'portfolio-tag-slug' => array(
						'title' => esc_html__('Portfolio Tag Slug (Permalink)', 'traveltour'),
						'type' => 'text',
						'default' => 'portfolio_tag',
						'description' => esc_html__('Please save the "Settings > Permalink" area once after made a changes to this field.', 'traveltour')
					),
					'enable-single-portfolio-navigation' => array(
						'title' => esc_html__('Enable Single Portfolio Navigation', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'portfolio-icon-hover-link' => array(
						'title' => esc_html__('Portfolio Hover Icon (Link)', 'traveltour'),
						'type' => 'radioimage',
						'options' => 'hover-icon-link',
						'default' => 'icon_link_alt'
					),
					'portfolio-icon-hover-video' => array(
						'title' => esc_html__('Portfolio Hover Icon (Video)', 'traveltour'),
						'type' => 'radioimage',
						'options' => 'hover-icon-video',
						'default' => 'icon_film'
					),
					'portfolio-icon-hover-image' => array(
						'title' => esc_html__('Portfolio Hover Icon (Image)', 'traveltour'),
						'type' => 'radioimage',
						'options' => 'hover-icon-image',
						'default' => 'icon_zoom-in_alt'
					),
					'portfolio-icon-hover-size' => array(
						'title' => esc_html__('Portfolio Hover Icon Size', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'default' => '22px',
						'selector' => '.gdlr-core-portfolio-thumbnail .gdlr-core-portfolio-icon{ font-size: #gdlr#; }' 
					),
					'enable-related-portfolio' => array(
						'title' => esc_html__('Enable Related Portfolio', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'related-portfolio-style' => array(
						'title' => esc_html__('Related Portfolio Style', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'grid' => esc_html__('Grid', 'traveltour'),
							'modern' => esc_html__('Modern', 'traveltour'),
						),
						'condition' => array('enable-related-portfolio'=>'enable')
					),
					'related-portfolio-column-size' => array(
						'title' => esc_html__('Related Portfolio Column Size', 'traveltour'),
						'type' => 'combobox',
						'options' => array( 60 => 1, 30 => 2, 20 => 3, 15 => 4, 12 => 5, 10 => 6, ),
						'default' => 15,
						'condition' => array('enable-related-portfolio'=>'enable')
					),
					'related-portfolio-num-fetch' => array(
						'title' => esc_html__('Related Portfolio Num Fetch', 'traveltour'),
						'type' => 'text',
						'default' => 4,
						'data-input-type' => 'number',
						'condition' => array('enable-related-portfolio'=>'enable')
					),
					'related-portfolio-thumbnail-size' => array(
						'title' => esc_html__('Related Portfolio Thumbnail Size', 'traveltour'),
						'type' => 'combobox',
						'options' => 'thumbnail-size',
						'condition' => array('enable-related-portfolio'=>'enable'),
						'default' => 'medium'
					),
					'related-portfolio-num-excerpt' => array(
						'title' => esc_html__('Related Portfolio Num Excerpt', 'traveltour'),
						'type' => 'text',
						'default' => 20,
						'data-input-type' => 'number',
						'condition' => array('enable-related-portfolio'=>'enable', 'related-portfolio-style'=>'grid')
					),
				)
			),

			'portfolio-archive' => array(
				'title' => esc_html__('Portfolio Archive', 'traveltour'),
				'options' => array(
					'archive-portfolio-sidebar' => array(
						'title' => esc_html__('Archive Portfolio Sidebar', 'traveltour'),
						'type' => 'radioimage',
						'options' => 'sidebar',
						'default' => 'none',
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'archive-portfolio-sidebar-left' => array(
						'title' => esc_html__('Archive Portfolio Sidebar Left', 'traveltour'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'archive-portfolio-sidebar'=>array('left', 'both') )
					),
					'archive-portfolio-sidebar-right' => array(
						'title' => esc_html__('Archive Portfolio Sidebar Right', 'traveltour'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'archive-portfolio-sidebar'=>array('right', 'both') )
					),
					'archive-portfolio-style' => array(
						'title' => esc_html__('Archive Portfolio Style', 'traveltour'),
						'type' => 'radioimage',
						'options' => array(
							'modern' => get_template_directory_uri() . '/include/options/images/portfolio/modern.png',
							'modern-no-space' => get_template_directory_uri() . '/include/options/images/portfolio/modern-no-space.png',
							'grid' => get_template_directory_uri() . '/include/options/images/portfolio/grid.png',
							'grid-no-space' => get_template_directory_uri() . '/include/options/images/portfolio/grid-no-space.png',
							'modern-desc' => get_template_directory_uri() . '/include/options/images/portfolio/modern-desc.png',
							'modern-desc-no-space' => get_template_directory_uri() . '/include/options/images/portfolio/modern-desc-no-space.png',
							'medium' => get_template_directory_uri() . '/include/options/images/portfolio/medium.png',
						),
						'default' => 'medium',
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'archive-portfolio-thumbnail-size' => array(
						'title' => esc_html__('Archive Portfolio Thumbnail Size', 'traveltour'),
						'type' => 'combobox',
						'options' => 'thumbnail-size'
					),
					'archive-portfolio-grid-text-align' => array(
						'title' => esc_html__('Archive Portfolio Grid Text Align', 'traveltour'),
						'type' => 'radioimage',
						'options' => 'text-align',
						'default' => 'left',
						'condition' => array( 'archive-portfolio-style' => array( 'grid', 'grid-no-space' ) )
					),
					'archive-portfolio-grid-style' => array(
						'title' => esc_html__('Archive Portfolio Grid Content Style', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'normal' => esc_html__('Normal', 'traveltour'),
							'with-frame' => esc_html__('With Frame', 'traveltour'),
							'with-bottom-border' => esc_html__('With Bottom Border', 'traveltour'),
						),
						'default' => 'normal',
						'condition' => array( 'archive-portfolio-style' => array( 'grid', 'grid-no-space' ) )
					),
					'archive-enable-portfolio-tag' => array(
						'title' => esc_html__('Archive Enable Portfolio Tag', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'archive-portfolio-style' => array( 'grid', 'grid-no-space', 'modern-desc', 'modern-desc-no-space', 'medium' ) )
					),
					'archive-portfolio-medium-size' => array(
						'title' => esc_html__('Archive Portfolio Medium Thumbnail Size', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'small' => esc_html__('Small', 'traveltour'),
							'large' => esc_html__('Large', 'traveltour'),
						),
						'condition' => array( 'archive-portfolio-style' => 'medium' )
					),
					'archive-portfolio-medium-style' => array(
						'title' => esc_html__('Archive Portfolio Medium Thumbnail Style', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'left' => esc_html__('Left', 'traveltour'),
							'right' => esc_html__('Right', 'traveltour'),
							'switch' => esc_html__('Switch ( Between Left and Right )', 'traveltour'),
						),
						'default' => 'switch',
						'condition' => array( 'archive-portfolio-style' => 'medium' )
					),
					'archive-portfolio-hover' => array(
						'title' => esc_html__('Archive Portfolio Hover Style', 'traveltour'),
						'type' => 'radioimage',
						'options' => array(
							'title' => get_template_directory_uri() . '/include/options/images/portfolio/hover/title.png',
							'title-icon' => get_template_directory_uri() . '/include/options/images/portfolio/hover/title-icon.png',
							'title-tag' => get_template_directory_uri() . '/include/options/images/portfolio/hover/title-tag.png',
							'icon-title-tag' => get_template_directory_uri() . '/include/options/images/portfolio/hover/icon-title-tag.png',
							'icon' => get_template_directory_uri() . '/include/options/images/portfolio/hover/icon.png',
							'margin-title' => get_template_directory_uri() . '/include/options/images/portfolio/hover/margin-title.png',
							'margin-title-icon' => get_template_directory_uri() . '/include/options/images/portfolio/hover/margin-title-icon.png',
							'margin-title-tag' => get_template_directory_uri() . '/include/options/images/portfolio/hover/margin-title-tag.png',
							'margin-icon-title-tag' => get_template_directory_uri() . '/include/options/images/portfolio/hover/margin-icon-title-tag.png',
							'margin-icon' => get_template_directory_uri() . '/include/options/images/portfolio/hover/margin-icon.png',
							'none' => get_template_directory_uri() . '/include/options/images/portfolio/hover/none.png',
						),
						'default' => 'icon',
						'max-width' => '100px',
						'condition' => array( 'archive-portfolio-style' => array('modern', 'modern-no-space', 'grid', 'grid-no-space', 'medium') ),
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'archive-portfolio-column-size' => array(
						'title' => esc_html__('Archive Portfolio Column Size', 'traveltour'),
						'type' => 'combobox',
						'options' => array( 60=>1, 30=>2, 20=>3, 15=>4, 12=>5 ),
						'default' => 20,
						'condition' => array( 'archive-portfolio-style' => array('modern', 'modern-no-space', 'grid', 'grid-no-space', 'modern-desc', 'modern-desc-no-space') )
					),
					'archive-portfolio-excerpt' => array(
						'title' => esc_html__('Archive Portfolio Excerpt Type', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'specify-number' => esc_html__('Specify Number', 'traveltour'),
							'show-all' => esc_html__('Show All ( use <!--more--> tag to cut the content )', 'traveltour'),
							'none' => esc_html__('Disable Exceprt', 'traveltour'),
						),
						'default' => 'specify-number',
						'condition' => array( 'archive-portfolio-style' => array( 'grid', 'grid-no-space', 'modern-desc', 'modern-desc-no-space', 'medium' ) )
					),
					'archive-portfolio-excerpt-number' => array(
						'title' => esc_html__('Archive Portfolio Excerpt Number', 'traveltour'),
						'type' => 'text',
						'default' => 55,
						'data-input-type' => 'number',
						'condition' => array( 'archive-portfolio-style' => array( 'grid', 'grid-no-space', 'modern-desc', 'modern-desc-no-space', 'medium' ), 'archive-portfolio-excerpt' => 'specify-number' )
					),

				)
			),

			'personnel-style' => array(
				'title' => esc_html__('Personnel Style', 'traveltour'),
				'options' => array(
					'personnel-slug' => array(
						'title' => esc_html__('Personnel Slug (Permalink)', 'traveltour'),
						'type' => 'text',
						'default' => 'personnel',
						'description' => esc_html__('Please save the "Settings > Permalink" area once after made a changes to this field.', 'traveltour')
					),
					'personnel-category-slug' => array(
						'title' => esc_html__('Personnel Category Slug (Permalink)', 'traveltour'),
						'type' => 'text',
						'default' => 'personnel_category',
						'description' => esc_html__('Please save the "Settings > Permalink" area once after made a changes to this field.', 'traveltour')
					),
				)
			),

			'footer' => array(
				'title' => esc_html__('Footer/Copyright', 'traveltour'),
				'options' => array(

					'fixed-footer' => array(
						'title' => esc_html__('Fixed Footer', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'disable'
					),
					'enable-footer' => array(
						'title' => esc_html__('Enable Footer', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'enable-footer-column-divider' => array(
						'title' => esc_html__('Enable Footer Column Divider', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'enable-footer' => 'enable' )
					),
					'footer-top-padding' => array(
						'title' => esc_html__('Footer Top Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '300',
						'data-type' => 'pixel',
						'default' => '70px',
						'selector' => '.traveltour-footer-wrapper{ padding-top: #gdlr#; }',
						'condition' => array( 'enable-footer' => 'enable' )
					),
					'footer-bottom-padding' => array(
						'title' => esc_html__('Footer Bottom Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '300',
						'data-type' => 'pixel',
						'default' => '50px',
						'selector' => '.traveltour-footer-container{ padding-bottom: #gdlr#; }',
						'condition' => array( 'enable-footer' => 'enable' )
					),
					'footer-title-bottom-margin' => array(
						'title' => esc_html__('Footer Title Bottom Margin', 'traveltour'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'selector' => '.traveltour-footer-wrapper .traveltour-widget-title{ margin-bottom: #gdlr#; }',
						'condition' => array( 'enable-footer' => 'enable' )
					),

					'footer-style' => array(
						'title' => esc_html__('Footer Style', 'traveltour'),
						'type' => 'radioimage',
						'wrapper-class' => 'gdlr-core-fullsize',
						'options' => array(
							'footer-1' => get_template_directory_uri() . '/include/options/images/footer-style1.png',
							'footer-2' => get_template_directory_uri() . '/include/options/images/footer-style2.png',
							'footer-3' => get_template_directory_uri() . '/include/options/images/footer-style3.png',
							'footer-4' => get_template_directory_uri() . '/include/options/images/footer-style4.png',
							'footer-5' => get_template_directory_uri() . '/include/options/images/footer-style5.png',
							'footer-6' => get_template_directory_uri() . '/include/options/images/footer-style6.png',
						),
						'default' => 'footer-2',
						'condition' => array( 'enable-footer' => 'enable' )
					),
					'enable-copyright' => array(
						'title' => esc_html__('Enable Copyright', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'copyright-style' => array(
						'title' => esc_html__('Copyright Style', 'traveltour'),
						'type' => 'combobox',
						'options' => array(
							'center' => esc_html__('Center', 'traveltour'),
							'center-tb' => esc_html__('Center Inside Footer', 'traveltour'),
							'left-right' => esc_html__('Left & Right', 'traveltour'),
							'left-right-tb' => esc_html__('Left & Right Inside Footer', 'traveltour'),
						),
						'condition' => array( 'enable-copyright' => 'enable' )
					),
					'copyright-top-padding' => array(
						'title' => esc_html__('Footer Top Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '300',
						'data-type' => 'pixel',
						'default' => '38px',
						'selector' => '.traveltour-copyright-container{ padding-top: #gdlr#; }',
						'condition' => array( 'enable-footer' => 'enable' )
					),
					'copyright-bottom-padding' => array(
						'title' => esc_html__('Footer Bottom Padding', 'traveltour'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '300',
						'data-type' => 'pixel',
						'default' => '38px',
						'selector' => '.traveltour-copyright-container{ padding-bottom: #gdlr#; }',
						'condition' => array( 'enable-footer' => 'enable' )
					),
					'copyright-text' => array(
						'title' => esc_html__('Copyright Text', 'traveltour'),
						'type' => 'textarea',
						'wrapper-class' => 'gdlr-core-fullsize',
						'condition' => array( 'enable-copyright' => 'enable', 'copyright-style' => array('center', 'center-tb') )
					),
					'copyright-left' => array(
						'title' => esc_html__('Copyright Left', 'traveltour'),
						'type' => 'textarea',
						'wrapper-class' => 'gdlr-core-fullsize',
						'condition' => array( 'enable-copyright' => 'enable', 'copyright-style' => array('left-right', 'left-right-tb') )
					),
					'copyright-right' => array(
						'title' => esc_html__('Copyright Right', 'traveltour'),
						'type' => 'textarea',
						'wrapper-class' => 'gdlr-core-fullsize',
						'condition' => array( 'enable-copyright' => 'enable', 'copyright-style' => array('left-right', 'left-right-tb') )
					),
					'enable-back-to-top' => array(
						'title' => esc_html__('Enable Back To Top Button', 'traveltour'),
						'type' => 'checkbox',
						'default' => 'disable'
					),
				) // footer-options
			), // footer-nav	
		
		) // general-options
		
	), 2);