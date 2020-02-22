<?php
	/*	
	*	Goodlayers Option
	*	---------------------------------------------------------------------
	*	This file store an array of theme options
	*	---------------------------------------------------------------------
	*/	

	$traveltour_admin_option->add_element(array(
	
		// typography head section
		'title' => esc_html__('Typography', 'traveltour'),
		'slug' => 'traveltour_typography',
		'icon' => get_template_directory_uri() . '/include/options/images/typography.png',
		'options' => array(
		
			// starting the subnav
			'font-family' => array(
				'title' => esc_html__('Font Family', 'traveltour'),
				'options' => array(
					'heading-font' => array(
						'title' => esc_html__('Heading Font', 'traveltour'),
						'type' => 'font',
						'data-type' => 'font',
						'default' => 'Open Sans',
						'selector' => '.traveltour-body h1, .traveltour-body h2, .traveltour-body h3, ' . 
							'.traveltour-body h4, .traveltour-body h5, .traveltour-body h6, .traveltour-body .traveltour-title-font,' .
							'.traveltour-body .gdlr-core-title-font{ font-family: #gdlr#; }' . 
							'.woocommerce-breadcrumb, .woocommerce span.onsale, ' .
							'.single-product.woocommerce div.product p.price .woocommerce-Price-amount, .single-product.woocommerce #review_form #respond label{ font-family: #gdlr#; }'
					),
					'navigation-font' => array(
						'title' => esc_html__('Navigation Font', 'traveltour'),
						'type' => 'font',
						'data-type' => 'font',
						'default' => 'Open Sans',
						'selector' => '.traveltour-navigation .sf-menu > li > a, .traveltour-navigation .sf-vertical > li > a, .traveltour-navigation-font{ font-family: #gdlr#; }'
					),	
					'content-font' => array(
						'title' => esc_html__('Content Font', 'traveltour'),
						'type' => 'font',
						'data-type' => 'font',
						'default' => 'Open Sans',
						'selector' => '.traveltour-body, .traveltour-body .gdlr-core-content-font, ' . 
							'.traveltour-body input, .traveltour-body textarea, .traveltour-body button, .traveltour-body select, ' . 
							'.traveltour-body .traveltour-content-font, .gdlr-core-audio .mejs-container *{ font-family: #gdlr#; }'
					),
					'info-font' => array(
						'title' => esc_html__('Info Font', 'traveltour'),
						'type' => 'font',
						'data-type' => 'font',
						'default' => 'Open Sans',
						'selector' => '.traveltour-body .gdlr-core-info-font, .traveltour-body .traveltour-info-font{ font-family: #gdlr#; }'
					),
					'blog-info-font' => array(
						'title' => esc_html__('Blog Info Font', 'traveltour'),
						'type' => 'font',
						'data-type' => 'font',
						'default' => 'Open Sans',
						'selector' => '.traveltour-body .gdlr-core-blog-info-font, .traveltour-body .traveltour-blog-info-font{ font-family: #gdlr#; }'
					),
					'quote-font' => array(
						'title' => esc_html__('Quote Font', 'traveltour'),
						'type' => 'font',
						'data-type' => 'font',
						'default' => 'Open Sans',
						'selector' => '.traveltour-body .gdlr-core-quote-font{ font-family: #gdlr#; }'
					),

					'additional-font' => array(
						'title' => esc_html__('Additional Font', 'traveltour'),
						'type' => 'font',
						'data-type' => 'font',
						'customizer' => false,
						'default' => 'Georgia, serif',
						'description' => esc_html__('Additional font you want to include for custom css.', 'traveltour')
					),
					'additional-font2' => array(
						'title' => esc_html__('Additional Font2', 'traveltour'),
						'type' => 'font',
						'data-type' => 'font',
						'customizer' => false,
						'default' => 'Georgia, serif',
						'description' => esc_html__('Additional font you want to include for custom css.', 'traveltour')
					),
					
				) // font-family-options
			), // font-family-nav
			
			'font-size' => array(
				'title' => esc_html__('Font Size', 'traveltour'),
				'options' => array(
				
					'h1-font-size' => array(
						'title' => esc_html__('H1 Size', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'default' => '52px',
						'selector' => '.traveltour-body h1{ font-size: #gdlr#; }' 
					),					
					'h2-font-size' => array(
						'title' => esc_html__('H2 Size', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'default' => '48px',
						'selector' => '.traveltour-body h2, #poststuff .gdlr-core-page-builder-body h2{ font-size: #gdlr#; }' 
					),					
					'h3-font-size' => array(
						'title' => esc_html__('H3 Size', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'default' => '36px',
						'selector' => '.traveltour-body h3{ font-size: #gdlr#; }' 
					),					
					'h4-font-size' => array(
						'title' => esc_html__('H4 Size', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'default' => '28px',
						'selector' => '.traveltour-body h4{ font-size: #gdlr#; }' 
					),					
					'h5-font-size' => array(
						'title' => esc_html__('H5 Size', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'default' => '22px',
						'selector' => '.traveltour-body h5{ font-size: #gdlr#; }' 
					),					
					'h6-font-size' => array(
						'title' => esc_html__('H6 Size', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'default' => '18px',
						'selector' => '.traveltour-body h6{ font-size: #gdlr#; }' 
					),					
					'navigation-font-size' => array(
						'title' => esc_html__('Navigation Font Size', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'default' => '14px',
						'selector' => '.traveltour-navigation .sf-menu > li > a, .traveltour-navigation .sf-vertical > li > a{ font-size: #gdlr#; }' 
					),	
					'navigation-font-weight' => array(
						'title' => esc_html__('Navigation Font Weight', 'traveltour'),
						'type' => 'text',
						'data-type' => 'text',
						'default' => '800',
						'selector' => '.traveltour-navigation .sf-menu > li > a{ font-weight: #gdlr#; }',
						'description' => esc_html__('Eg. lighter, bold, normal, 300, 400, 600, 700, 800', 'traveltour')
					),	
					'navigation-text-transform' => array(
						'title' => esc_html__('Navigation Text Transform', 'traveltour'),
						'type' => 'combobox',
						'data-type' => 'text',
						'options' => array(
							'uppercase' => esc_html__('Uppercase', 'traveltour'),
							'lowercase' => esc_html__('Lowercase', 'traveltour'),
							'capitalize' => esc_html__('Capitalize', 'traveltour'),
							'none' => esc_html__('None', 'traveltour'),
						),
						'default' => 'uppercase',
						'selector' => '.traveltour-navigation .sf-menu > li > a{ text-transform: #gdlr#; }',
					),
					'content-font-size' => array(
						'title' => esc_html__('Content Size', 'traveltour'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'default' => '15px',
						'selector' => '.traveltour-body{ font-size: #gdlr#; }' 
					),
					'content-line-height' => array(
						'title' => esc_html__('Content Line Height', 'traveltour'),
						'type' => 'text',
						'data-type' => 'text',
						'default' => '1.7',
						'selector' => '.traveltour-body, .traveltour-body p, .traveltour-line-height, .gdlr-core-line-height{ line-height: #gdlr#; }'
					),
					
				) // font-size-options
			), // font-size-nav		

			'footer-font-size' => array(
				'title' => esc_html__('Sidebar / Footer Font Size', 'traveltour'),
				'options' => array(
					
					'sidebar-title-font-size' => array(
						'title' => esc_html__('Sidebar Title Font Size', 'traveltour'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'selector' => '.traveltour-sidebar-area .traveltour-widget-title{ font-size: #gdlr#; }' 
					),
					'sidebar-title-font-weight' => array(
						'title' => esc_html__('Sidebar Title Font Weight', 'traveltour'),
						'type' => 'text',
						'data-type' => 'text',
						'selector' => '.traveltour-sidebar-area .traveltour-widget-title{ font-weight: #gdlr#; }',
						'description' => esc_html__('Eg. lighter, bold, normal, 300, 400, 600, 700, 800', 'traveltour')
					),	
					'sidebar-title-font-letter-spacing' => array(
						'title' => esc_html__('Sidebar Title Font Letter Spacing', 'traveltour'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'selector' => '.traveltour-sidebar-area .traveltour-widget-title{ letter-spacing: #gdlr#; }'
					),
					'sidebar-title-text-transform' => array(
						'title' => esc_html__('Sidebar Title Text Transform', 'traveltour'),
						'type' => 'combobox',
						'data-type' => 'text',
						'options' => array(
							'uppercase' => esc_html__('Uppercase', 'traveltour'),
							'lowercase' => esc_html__('Lowercase', 'traveltour'),
							'capitalize' => esc_html__('Capitalize', 'traveltour'),
							'none' => esc_html__('None', 'traveltour'),
						),
						'default' => 'uppercase',
						'selector' => '.traveltour-sidebar-area .traveltour-widget-title{ text-transform: #gdlr#; }',
					),
					'footer-title-font-size' => array(
						'title' => esc_html__('Footer Title Font Size', 'traveltour'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'selector' => '.traveltour-footer-wrapper .traveltour-widget-title{ font-size: #gdlr#; }' 
					),
					'footer-title-font-weight' => array(
						'title' => esc_html__('Footer Title Font Weight', 'traveltour'),
						'type' => 'text',
						'data-type' => 'text',
						'selector' => '.traveltour-footer-wrapper .traveltour-widget-title{ font-weight: #gdlr#; }',
						'description' => esc_html__('Eg. lighter, bold, normal, 300, 400, 600, 700, 800', 'traveltour')
					),	
					'footer-title-font-letter-spacing' => array(
						'title' => esc_html__('Footer Title Font Letter Spacing', 'traveltour'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'selector' => '.traveltour-footer-wrapper .traveltour-widget-title{ letter-spacing: #gdlr#; }'
					),
					'footer-title-text-transform' => array(
						'title' => esc_html__('Footer Title Text Transform', 'traveltour'),
						'type' => 'combobox',
						'data-type' => 'text',
						'options' => array(
							'uppercase' => esc_html__('Uppercase', 'traveltour'),
							'lowercase' => esc_html__('Lowercase', 'traveltour'),
							'capitalize' => esc_html__('Capitalize', 'traveltour'),
							'none' => esc_html__('None', 'traveltour'),
						),
						'default' => 'uppercase',
						'selector' => '.traveltour-footer-wrapper .traveltour-widget-title{ text-transform: #gdlr#; }',
					),
					'footer-font-size' => array(
						'title' => esc_html__('Footer Content Font Size', 'traveltour'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'selector' => '.traveltour-footer-wrapper{ font-size: #gdlr#; }' 
					),
					'footer-content-font-weight' => array(
						'title' => esc_html__('Footer Content Font Weight', 'traveltour'),
						'type' => 'text',
						'data-type' => 'text',
						'selector' => '.traveltour-footer-wrapper .widget_text{ font-weight: #gdlr#; }',
						'description' => esc_html__('Eg. lighter, bold, normal, 300, 400, 600, 700, 800', 'traveltour')
					),	
					'footer-content-text-transform' => array(
						'title' => esc_html__('Footer Content Text Transform', 'traveltour'),
						'type' => 'combobox',
						'data-type' => 'text',
						'options' => array(
							'uppercase' => esc_html__('Uppercase', 'traveltour'),
							'lowercase' => esc_html__('Lowercase', 'traveltour'),
							'capitalize' => esc_html__('Capitalize', 'traveltour'),
							'none' => esc_html__('None', 'traveltour'),
						),
						'default' => 'none',
						'selector' => '.traveltour-footer-wrapper .widget_text{ text-transform: #gdlr#; }',
					),
					'copyright-font-size' => array(
						'title' => esc_html__('Copyright Font Size', 'traveltour'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'selector' => '.traveltour-copyright-text, .traveltour-copyright-left, .traveltour-copyright-right{ font-size: #gdlr#; }' 
					),
					'copyright-font-weight' => array(
						'title' => esc_html__('Copyright Font Weight', 'traveltour'),
						'type' => 'text',
						'data-type' => 'text',
						'selector' => '.traveltour-copyright-text, .traveltour-copyright-left, .traveltour-copyright-right{ font-weight: #gdlr#; }',
						'description' => esc_html__('Eg. lighter, bold, normal, 300, 400, 600, 700, 800', 'traveltour')
					),	
					'copyright-font-letter-spacing' => array(
						'title' => esc_html__('Copyright Font Letter Spacing', 'traveltour'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'selector' => '.traveltour-copyright-text, .traveltour-copyright-left, .traveltour-copyright-right{ letter-spacing: #gdlr#; }'
					),
					'copyright-text-transform' => array(
						'title' => esc_html__('Copyright Text Transform', 'traveltour'),
						'type' => 'combobox',
						'data-type' => 'text',
						'options' => array(
							'uppercase' => esc_html__('Uppercase', 'traveltour'),
							'lowercase' => esc_html__('Lowercase', 'traveltour'),
							'capitalize' => esc_html__('Capitalize', 'traveltour'),
							'none' => esc_html__('None', 'traveltour'),
						),
						'default' => 'uppercase',
						'selector' => '.traveltour-copyright-text, .traveltour-copyright-left, .traveltour-copyright-right{ text-transform: #gdlr#; }',
					),
				)
			),	
			
			'font-upload' => array(
				'title' => esc_html__('Font Uploader', 'traveltour'),
				'reload-after' => true,
				'customizer' => false,
				'options' => array(
				
					'font-upload' => array(
						'title' => esc_html__('Upload Fonts', 'traveltour'),
						'type' => 'custom',
						'item-type' => 'fontupload',
						'wrapper-class' => 'gdlr-core-fullsize',
					),
					
				) // fontupload-options
			), // fontupload-nav
		
		) // typography-options
		
	), 4);