<?php
	/*	
	*	Goodlayers Function File
	*	---------------------------------------------------------------------
	*	This file include all of important function and features of the theme
	*	---------------------------------------------------------------------
	*/

	// goodlayers core plugin function
	include_once(get_template_directory() . '/admin/core/sidebar-generator.php');
	include_once(get_template_directory() . '/admin/core/utility.php');
	include_once(get_template_directory() . '/admin/core/media.php' );
	
	// create admin page
	if( is_admin() ){
		include_once(get_template_directory() . '/admin/tgmpa/class-tgm-plugin-activation.php');
		include_once(get_template_directory() . '/admin/tgmpa/plugin-activation.php');
		include_once(get_template_directory() . '/admin/function/getting-start.php');	
	}
	
	// plugins
	include_once(get_template_directory() . '/plugins/wpml.php');
	include_once(get_template_directory() . '/plugins/revslider.php');
	
	/////////////////////
	// front end script
	/////////////////////
	
	include_once(get_template_directory() . '/include/utility.php' );
	include_once(get_template_directory() . '/include/function-regist.php' );
	include_once(get_template_directory() . '/include/navigation-menu.php' );
	include_once(get_template_directory() . '/include/include-script.php' );
	include_once(get_template_directory() . '/include/goodlayers-core-filter.php' );
	include_once(get_template_directory() . '/include/goodlayers-core-element-filter.php' );
	include_once(get_template_directory() . '/include/maintenance.php' );
	include_once(get_template_directory() . '/include/pb-element-title.php' );
	include_once(get_template_directory() . '/woocommerce/woocommerce-settings.php' );
	
	/////////////////////
	// execute module 
	/////////////////////
	
	// initiate sidebar structure
	new gdlr_core_sidebar_generator( array(
		'before_widget' => '<div id="%1$s" class="widget %2$s traveltour-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="traveltour-widget-title"><span class="traveltour-widget-head-text">',
		'after_title'   => '</span></h3><span class="clear"></span>' ) );
	
	// remove the core default action to enqueue the theme script
	remove_action('after_setup_theme', 'gdlr_init_goodlayers_core_elements');
	add_action('after_setup_theme', 'traveltour_init_goodlayers_core_elements');
	if( !function_exists('traveltour_init_goodlayers_core_elements') ){
		function traveltour_init_goodlayers_core_elements(){

			// create an admin option and customizer
			if( (is_admin() || is_customize_preview()) && class_exists('gdlr_core_admin_option') && class_exists('gdlr_core_theme_customizer') ){
				
				$traveltour_admin_option = new gdlr_core_admin_option(array(
					'filewrite' => traveltour_get_style_custom(true)
				));	
				
				include_once( get_template_directory() . '/include/options/general.php');
				include_once( get_template_directory() . '/include/options/typography.php');
				include_once( get_template_directory() . '/include/options/color.php');
				include_once( get_template_directory() . '/include/options/plugin-settings.php');
				include_once( get_template_directory() . '/include/options/customize-utility.php');

				if( is_customize_preview() ){
					new gdlr_core_theme_customizer($traveltour_admin_option);
				}

				// clear an option for customize page
				add_action('wp', 'traveltour_clear_option');
				
			}
			
			// add the script for page builder / page options / post option
			if( is_admin() ){
				
				if( class_exists('gdlr_core_revision') ){
					$revision_num = 5;
					new gdlr_core_revision($revision_num);
				}
				
				// create page option
				if( class_exists('gdlr_core_page_option') ){

					// for page post type
					new gdlr_core_page_option(array(
						'post_type' => array('page'),
						'options' => array(
							'layout' => array(
								'title' => esc_html__('Layout', 'traveltour'),
								'options' => array(
									'enable-header-area' => array(
										'title' => esc_html__('Enable Header Area', 'traveltour'),
										'type' => 'checkbox',
										'default' => 'enable'
									),
									'sticky-navigation' => array(
										'title' => esc_html__('Sticky Navigation', 'traveltour'),
										'type' => 'combobox',
										'options' => array(
											'default' => esc_html__('Default', 'traveltour'),
											'enable' => esc_html__('Enable', 'traveltour'),
											'disable' => esc_html__('Disable', 'traveltour'),
										),
										'condition' => array( 'enable-header-area' => 'enable' )
									),
									'enable-page-title' => array(
										'title' => esc_html__('Enable Page Title', 'traveltour'),
										'type' => 'checkbox',
										'default' => 'enable',
										'condition' => array( 'enable-header-area' => 'enable' )
									),
									'page-caption' => array(
										'title' => esc_html__('Caption', 'traveltour'),
										'type' => 'textarea',
										'condition' => array( 'enable-header-area' => 'enable', 'enable-page-title' => 'enable' )
									),					
									'title-background' => array(
										'title' => esc_html__('Page Title Background', 'traveltour'),
										'type' => 'upload',
										'condition' => array( 'enable-header-area' => 'enable', 'enable-page-title' => 'enable' )
									),
									'show-content' => array(
										'title' => esc_html__('Show WordPress Editor Content', 'traveltour'),
										'type' => 'checkbox',
										'default' => 'enable',
										'description' => esc_html__('Disable this to hide the content in editor to show only page builder content.', 'traveltour'),
									),
									'sidebar' => array(
										'title' => esc_html__('Sidebar', 'traveltour'),
										'type' => 'radioimage',
										'options' => 'sidebar',
										'default' => 'none',
										'wrapper-class' => 'gdlr-core-fullsize'
									),
									'sidebar-left' => array(
										'title' => esc_html__('Sidebar Left', 'traveltour'),
										'type' => 'combobox',
										'options' => 'sidebar',
										'condition' => array( 'sidebar' => array('left', 'both') )
									),
									'sidebar-right' => array(
										'title' => esc_html__('Sidebar Right', 'traveltour'),
										'type' => 'combobox',
										'options' => 'sidebar',
										'condition' => array( 'sidebar' => array('right', 'both') )
									),
									'enable-footer' => array(
										'title' => esc_html__('Enable Footer', 'traveltour'),
										'type' => 'combobox',
										'options' => array(
											'default' => esc_html__('Default', 'traveltour'),
											'enable' => esc_html__('Enable', 'traveltour'),
											'disable' => esc_html__('Disable', 'traveltour'),
										)
									),
									'enable-copyright' => array(
										'title' => esc_html__('Enable Copyright', 'traveltour'),
										'type' => 'combobox',
										'options' => array(
											'default' => esc_html__('Default', 'traveltour'),
											'enable' => esc_html__('Enable', 'traveltour'),
											'disable' => esc_html__('Disable', 'traveltour'),
										)
									),

								)
							), // layout
							'title' => array(
								'title' => esc_html__('Title Style', 'traveltour'),
								'options' => array(

									'title-style' => array(
										'title' => esc_html__('Page Title Style', 'traveltour'),
										'type' => 'combobox',
										'options' => array(
											'default' => esc_html__('Default', 'traveltour'),
											'small' => esc_html__('Small', 'traveltour'),
											'medium' => esc_html__('Medium', 'traveltour'),
											'large' => esc_html__('Large', 'traveltour'),
											'custom' => esc_html__('Custom', 'traveltour'),
										),
										'default' => 'default'
									),
									'title-align' => array(
										'title' => esc_html__('Page Title Alignment', 'traveltour'),
										'type' => 'radioimage',
										'options' => 'text-align',
										'with-default' => true,
										'default' => 'default'
									),
									'title-spacing' => array(
										'title' => esc_html__('Page Title Padding', 'traveltour'),
										'type' => 'custom',
										'item-type' => 'padding',
										'data-input-type' => 'pixel',
										'options' => array('padding-top', 'padding-bottom', 'caption-top-margin'),
										'wrapper-class' => 'gdlr-core-fullsize gdlr-core-no-link gdlr-core-large',
										'condition' => array( 'title-style' => 'custom' )
									),
									'title-font-size' => array(
										'title' => esc_html__('Page Title Font Size', 'traveltour'),
										'type' => 'custom',
										'item-type' => 'padding',
										'data-input-type' => 'pixel',
										'options' => array('title-size', 'title-letter-spacing', 'caption-size', 'caption-letter-spacing'),
										'wrapper-class' => 'gdlr-core-fullsize gdlr-core-no-link gdlr-core-large',
										'condition' => array( 'title-style' => 'custom' )
									),
									'title-font-weight' => array(
										'title' => esc_html__('Page Title Font Weight', 'traveltour'),
										'type' => 'custom',
										'item-type' => 'padding',
										'options' => array('title-weight', 'caption-weight'),
										'wrapper-class' => 'gdlr-core-fullsize gdlr-core-no-link gdlr-core-large',
										'condition' => array( 'title-style' => 'custom' )
									),
									'title-font-transform' => array(
										'title' => esc_html__('Page Title Font Transform', 'traveltour'),
										'type' => 'combobox',
										'options' => array(
											'none' => esc_html__('None', 'traveltour'),
											'uppercase' => esc_html__('Uppercase', 'traveltour'),
											'lowercase' => esc_html__('Lowercase', 'traveltour'),
											'capitalize' => esc_html__('Capitalize', 'traveltour'),
										),
										'default' => 'uppercase',
										'condition' => array( 'title-style' => 'custom' )
									),
									'title-background-overlay-opacity' => array(
										'title' => esc_html__('Page Title Background Overlay Opacity', 'traveltour'),
										'type' => 'text',
										'description' => esc_html__('Fill the number between 0 - 1 ( Leave Blank For Default Value )', 'traveltour'),
										'condition' => array( 'title-style' => 'custom' )
									),
									'title-color' => array(
										'title' => esc_html__('Page Title Color', 'traveltour'),
										'type' => 'colorpicker',
									),
									'caption-color' => array(
										'title' => esc_html__('Page Caption Color', 'traveltour'),
										'type' => 'colorpicker',
									),
									'title-background-overlay-color' => array(
										'title' => esc_html__('Page Background Overlay Color', 'traveltour'),
										'type' => 'colorpicker',
									),

								)
							), // title
							'header' => array(
								'title' => esc_html__('Header', 'traveltour'),
								'options' => array(

									'header-slider' => array(
										'title' => esc_html__('Header Slider ( Above Navigation )', 'traveltour'),
										'type' => 'combobox',
										'options' => array(
											'none' => esc_html__('None', 'traveltour'),
											'layer-slider' => esc_html__('Layer Slider', 'traveltour'),
											'master-slider' => esc_html__('Master Slider', 'traveltour'),
											'revolution-slider' => esc_html__('Revolution Slider', 'traveltour'),
										),
										'description' => esc_html__('For header style plain / bar / boxed', 'traveltour'),
									),
									'layer-slider-id' => array(
										'title' => esc_html__('Choose Layer Slider', 'traveltour'),
										'type' => 'combobox',
										'options' => gdlr_core_get_layerslider_list(),
										'condition' => array( 'header-slider' => 'layer-slider' )
									),
									'master-slider-id' => array(
										'title' => esc_html__('Choose Master Slider', 'traveltour'),
										'type' => 'combobox',
										'options' => gdlr_core_get_masterslider_list(),
										'condition' => array( 'header-slider' => 'master-slider' )
									),
									'revolution-slider-id' => array(
										'title' => esc_html__('Choose Revolution Slider', 'traveltour'),
										'type' => 'combobox',
										'options' => gdlr_core_get_revolution_slider_list(),
										'condition' => array( 'header-slider' => 'revolution-slider' )
									),

								) // header options
							), // header
							'bullet-anchor' => array(
								'title' => esc_html__('Bullet Anchor', 'traveltour'),
								'options' => array(
									'bullet-anchor-description' => array(
										'type' => 'description',
										'description' => esc_html__('This feature is used for one page navigation. It will appear on the right side of page. You can put the id of element in \'Anchor Link\' field to let the bullet scroll the page to.', 'traveltour')
									),
									'bullet-anchor' => array(
										'title' => esc_html__('Add Anchor', 'traveltour'),
										'type' => 'custom',
										'item-type' => 'tabs',
										'options' => array(
											'title' => array(
												'title' => esc_html__('Anchor Link', 'traveltour'),
												'type' => 'text',
											),
											'anchor-color' => array(
												'title' => esc_html__('Anchor Color', 'traveltour'),
												'type' => 'colorpicker',
											),
											'anchor-hover-color' => array(
												'title' => esc_html__('Anchor Hover Color', 'traveltour'),
												'type' => 'colorpicker',
											)
										),
										'wrapper-class' => 'gdlr-core-fullsize'
									),
								)
							)
						)
					));

					// for post post type
					new gdlr_core_page_option(array(
						'post_type' => array('post'),
						'options' => array(
							'layout' => array(
								'title' => esc_html__('Layout', 'traveltour'),
								'options' => array(

									'show-content' => array(
										'title' => esc_html__('Show WordPress Editor Content', 'traveltour'),
										'type' => 'checkbox',
										'default' => 'enable',
										'description' => esc_html__('Disable this to hide the content in editor to show only page builder content.', 'traveltour'),
									),
									'sidebar' => array(
										'title' => esc_html__('Sidebar', 'traveltour'),
										'type' => 'radioimage',
										'options' => 'sidebar',
										'with-default' => true,
										'default' => 'default',
										'wrapper-class' => 'gdlr-core-fullsize'
									),
									'sidebar-left' => array(
										'title' => esc_html__('Sidebar Left', 'traveltour'),
										'type' => 'combobox',
										'options' => 'sidebar',
										'condition' => array( 'sidebar' => array('left', 'both') )
									),
									'sidebar-right' => array(
										'title' => esc_html__('Sidebar Right', 'traveltour'),
										'type' => 'combobox',
										'options' => 'sidebar',
										'condition' => array( 'sidebar' => array('right', 'both') )
									),
								)
							),
							'metro-layout' => array(
								'title' => esc_html__('Metro Layout', 'traveltour'),
								'options' => array(
									'metro-column-size' => array(
										'title' => esc_html__('Column Size', 'traveltour'),
										'type' => 'combobox',
										'options' => array( 'default'=> esc_html__('Default', 'traveltour'), 
											60 => '1/1', 30 => '1/2', 20 => '1/3', 40 => '2/3', 
											15 => '1/4', 45 => '3/4', 12 => '1/5', 24 => '2/5', 36 => '3/5', 48 => '4/5',
											10 => '1/6', 50 => '5/6'),
										'default' => 'default',
										'description' => esc_html__('Choosing default will display the value selected by the page builder item.', 'traveltour')
									),
									'metro-thumbnail-size' => array(
										'title' => esc_html__('Thumbnail Size', 'traveltour'),
										'type' => 'combobox',
										'options' => 'thumbnail-size',
										'with-default' => true,
										'default' => 'default',
										'description' => esc_html__('Choosing default will display the value selected by the page builder item.', 'traveltour')
									)
								)
							),						
							'title' => array(
								'title' => esc_html__('Title', 'traveltour'),
								'options' => array(

									'blog-title-style' => array(
										'title' => esc_html__('Blog Title Style', 'traveltour'),
										'type' => 'combobox',
										'options' => array(
											'default' => esc_html__('Default', 'traveltour'),
											'small' => esc_html__('Small', 'traveltour'),
											'large' => esc_html__('Large', 'traveltour'),
											'custom' => esc_html__('Custom', 'traveltour'),
											'inside-content' => esc_html__('Inside Content', 'traveltour'),
											'none' => esc_html__('None', 'traveltour'),
										),
										'default' => 'default'
									),
									'blog-title-padding' => array(
										'title' => esc_html__('Blog Title Padding', 'traveltour'),
										'type' => 'custom',
										'item-type' => 'padding',
										'data-input-type' => 'pixel',
										'options' => array('padding-top', 'padding-bottom'),
										'wrapper-class' => 'gdlr-core-fullsize gdlr-core-no-link gdlr-core-large',
										'condition' => array( 'blog-title-style' => 'custom' )
									),
									'blog-feature-image' => array(
										'title' => esc_html__('Blog Feature Image Location', 'traveltour'),
										'type' => 'combobox',
										'options' => array(
											'default' => esc_html__('Default', 'traveltour'),
											'content' => esc_html__('Inside Content', 'traveltour'),
											'title-background' => esc_html__('Title Background', 'traveltour'),
											'none' => esc_html__('None', 'traveltour'),
										)
									),
									'blog-title-background-image' => array(
										'title' => esc_html__('Blog Title Background Image', 'traveltour'),
										'type' => 'upload',
										'data-type' => 'file',
										'condition' => array( 
											'blog-title-style' => array('default', 'small', 'large', 'custom'),
											'blog-feature-image' => array('default', 'content', 'none')
										),
										'description' => esc_html__('Will be overridden by feature image if selected.', 'traveltour'),
									),
									'blog-title-background-overlay-opacity' => array(
										'title' => esc_html__('Blog Title Background Overlay Opacity', 'traveltour'),
										'type' => 'text',
										'description' => esc_html__('Fill the number between 0 - 1 ( Leave Blank For Default Value )', 'traveltour'),
										'condition' => array( 'blog-title-style' => 'custom' ),
									),
									'header-background-gradient' => array(
										'title' => esc_html__('Title Background Gradient', 'traveltour'),
										'type' => 'combobox',
										'options' => array(
											'default' => esc_html__('Default', 'traveltour'),
											'both' => esc_html__('Both', 'traveltour'),
											'top' => esc_html__('Top', 'traveltour'),
											'bottom' => esc_html__('Bottom', 'traveltour'),
											'none' => esc_html__('None', 'traveltour'),
										),
									),

								) // options
							) // title
						)
					));
				}

			}
			
			// create page builder
			if( class_exists('gdlr_core_page_builder') ){
				new gdlr_core_page_builder(array(
					'style' => array(
						'style-custom' => traveltour_get_style_custom()
					)
				));
			}
			
		} // traveltour_init_goodlayers_core_elements
	} // function_exists

	// if( !is_admin() ){ add_action('wp', 'traveltour_print_custom_export_data'); }
	if( !function_exists('traveltour_print_custom_export_data') ){
		function traveltour_print_custom_export_data(){

			// custom taxonomy
			$custom_taxs = get_option('tourmaster_custom_tour_taxs', array());
			echo json_encode($custom_taxs) . '<br>';

			// for custom tax thumbnail
			$data = array();
			$taxs = array('tour_category' => '', 'tour_tag' => '') + tourmaster_get_custom_tax_list();
			foreach( $taxs as $tax_slug => $tax_label ){
				$data[$tax_slug] = array();

				$term_list = tourmaster_get_term_list($tax_slug);
				foreach( $term_list as $term_slug => $term_label ){
					$term = get_term_by('slug', $term_slug, $tax_slug);
					$term_meta = get_term_meta($term->term_id, 'thumbnail', true);
					if( !empty($term_meta) ){
						$data[$tax_slug][$term_slug] = $term_meta;
					}
				}
				
			}
			echo json_encode($data) . '<Br>';
		}
	}

	// WPML FIX
	add_filter('option_traveltour_plugin', 'translate_maintenance_page_id');
	function translate_maintenance_page_id( $value ) {
		$value['maintenance-page'] = apply_filters('wpml_object_id', $value['maintenance-page'], 'page', true);

		return $value;
	}
	add_filter( 'icl_ls_languages', 'adjust_ls_permalinks' );
	function adjust_ls_permalinks( $languages ) {

	    //gets the maintenance page ID
	    $maintenance_page_id = traveltour_get_option('plugin', 'maintenance-page');
	    
	    //get if maintenance mode is enabled
	    $is_maintenance_mode_enabled = traveltour_get_option('plugin', 'enable-maintenance'); // 'enable'
	    
	    //check if maintenance mode is enabled and if we are in the maintenance page (the ID of the maintenance page is already translated)
	    if ( is_page ($maintenance_page_id) && 'enable' == $is_maintenance_mode_enabled && !is_user_logged_in()) {

	        // loop through languages setting url to home
	        $adjusted_languages = [];
	        foreach ($languages as $lang) {
	            $lang['url'] = apply_filters( 'wpml_permalink', get_option( 'home' ), $lang['code'] ); 
	            $adjusted_languages[] = $lang;
	        }
	        
	        return $adjusted_languages;
	    }
	    return $languages;

	}