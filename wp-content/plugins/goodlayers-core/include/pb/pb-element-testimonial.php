<?php
	/*	
	*	Goodlayers Item For Page Builder
	*/
	
	gdlr_core_page_builder_element::add_element('testimonial', 'gdlr_core_pb_element_testimonial'); 
	
	if( !class_exists('gdlr_core_pb_element_testimonial') ){
		class gdlr_core_pb_element_testimonial{
			
			// get the element settings
			static function get_settings(){
				return array(
					'icon' => 'fa-quote-right',
					'title' => esc_html__('Testimonial', 'goodlayers-core')
				);
			}
			
			// return the element options
			static function get_options(){
				global $gdlr_core_item_pdb;
				
				return array(
					'general' => array(
						'title' => esc_html__('General', 'goodlayers-core'),
						'options' => array(
							'title' => array(
								'title' => esc_html__('Title', 'goodlayers-core'),
								'type' => 'text',
								'default' => esc_html__('Sample Testimonial Title', 'goodlayers-core'),
							),
							'title-left-icon' => array(
								'title' => esc_html__('Title Left Icon ( Only for centered title style )', 'goodlayers-core'),
								'type' => 'icons',
								'allow-none' => true,
								'wrapper-class' => 'gdlr-core-fullsize',
							),
							'caption' => array(
								'title' => esc_html__('Caption ( Only for center style )', 'goodlayers-core'),
								'type' => 'text'
							),
							'tabs' => array(
								'title' => esc_html__('Add Testimonial Tab', 'goodlayers-core'),
								'type' => 'custom',
								'item-type' => 'tabs',
								'wrapper-class' => 'gdlr-core-fullsize',
								'options' => array(
									'title' => array(
										'title' => esc_html__('Name', 'goodlayers-core'),
										'type' => 'text'
									),
									'position' => array(
										'title' => esc_html__('Position', 'goodlayers-core'),
										'type' => 'text'
									),
									'content' => array(
										'title' => esc_html__('Content', 'goodlayers-core'),
										'type' => 'textarea'
									),
									'image' => array(
										'title' => esc_html__('Author Image', 'goodlayers-core'),
										'type' => 'upload'
									),
									'rating' => array(
										'title' => esc_html__('Rating ( Fill number 1 to 10 )', 'goodlayers-core'),
										'type' => 'text'
									),
								),
								'default' => array(
									array(
										'title' => esc_html__('Sameple Name', 'goodlayers-core'),
										'position' => esc_html__('Sample Position', 'goodlayers-core'),
										'content' => esc_html__('Sample testimonial content area', 'goodlayers-core'),
										'image' => '',
									),
									array(
										'title' => esc_html__('Sameple Name', 'goodlayers-core'),
										'position' => esc_html__('Sample Position', 'goodlayers-core'),
										'content' => esc_html__('Sample testimonial content area', 'goodlayers-core'),
										'image' => '',
									),
								)
							),
						),
					),
					'style' => array(
						'title' => esc_html__('Style', 'goodlayers-core'),
						'options' => array(
							'style' => array(
								'title' => esc_html__('Testimonial Style', 'goodlayers-core'),
								'type' => 'radioimage',
								'options' => array(
									'left' => GDLR_CORE_URL . '/include/images/testimonial/left.png',
									'left-2' => GDLR_CORE_URL . '/include/images/testimonial/left-2.jpg',
									'left-bg' => GDLR_CORE_URL . '/include/images/testimonial/left-bg.png',
									'center' => GDLR_CORE_URL . '/include/images/testimonial/center.png',
									'center-2' => GDLR_CORE_URL . '/include/images/testimonial/center-2.png',
									'right' => GDLR_CORE_URL . '/include/images/testimonial/right.png',
								),
								'default' => 'left',
								'wrapper-class' => 'gdlr-core-fullsize'
							),
							'with-frame' => array(
								'title' => esc_html__('With Frame', 'goodlayers-core'),
								'type' => 'checkbox',
								'default' => 'disable'
							),
							'column' => array(
								'title' => esc_html__('Column Number', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array( 1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6),
								'default' => 3
							),
							'thumbnail-size' => array(
								'title' => esc_html__('Thumbnail Size', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => 'thumbnail-size',
								'default' => 'thumbnail',
							),
							'enable-quote' => array(
								'title' => esc_html__('Enable Testimonial Quote', 'goodlayers-core'),
								'type' => 'checkbox',
								'default' => 'enable',
								'condition' => array( 'style' => array('left', 'left-2', 'left-bg', 'center', 'right') )
							),
							'left-quote-position' => array(
								'title' => esc_html__('Quote Position', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'left' => esc_html__('Left', 'goodlayers-core'),
									'top' => esc_html__('Top', 'goodlayers-core')
								),
								'default' => 'left',
								'condition' => array( 'style' => 'left', 'enable-quote' => 'enable' )
							),
							'quote-position' => array(
								'title' => esc_html__('Quote Position', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'top' => esc_html__('Top', 'goodlayers-core'),
									'bottom' => esc_html__('Bottom', 'goodlayers-core')
								),
								'default' => 'bottom',
								'condition' => array( 'style' => 'center', 'enable-quote' => 'enable' )
							),
							'rating-position' => array(
								'title' => esc_html__('Rating Position', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'left' => esc_html__('Left', 'goodlayers-core'),
									'right' => esc_html__('Right', 'goodlayers-core'),
								),
								'condition' => array( 'style' => array('left', 'left-2', 'left-bg') )
							),
							'rating-top-margin' => array(
								'title' => esc_html__('Rating Top Margin', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
								'condition' => array( 'style' => array('left', 'left-2', 'left-bg'), 'rating-position' => 'right' )
							),
							'carousel' => array(
								'title' => esc_html__('Enable Carousel', 'goodlayers-core'),
								'type' => 'checkbox',
								'default' => 'disable'
							),
							'carousel-overflow' => array(
								'title' => esc_html__('Carousel Overflow', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'' => esc_html__('Hidden', 'goodlayers-core'),
									'visible' => esc_html__('Visible', 'goodlayers-core')
								),
								'condition' => array( 'carousel' => 'enable' )
							),
							'carousel-autoslide' => array(
								'title' => esc_html__('Autoslide Carousel', 'goodlayers-core'),
								'type' => 'checkbox',
								'default' => 'enable',
								'condition' => array( 'carousel' => 'enable' )
							),
							'carousel-scrolling-item-amount' => array(
								'title' => esc_html__('Carousel Scrolling Item Amount', 'goodlayers-core'),
								'type' => 'text',
								'default' => '1',
								'condition' => array( 'carousel' => 'enable' )
							),
							'carousel-navigation' => array(
								'title' => esc_html__('Carousel Navigation', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => (function_exists('gdlr_core_get_flexslider_navigation_types')? gdlr_core_get_flexslider_navigation_types(): array()),
								'default' => 'navigation',
								'condition' => array( 'carousel' => 'enable' )
							),
							'carousel-navigation-align' => (function_exists('gdlr_core_get_flexslider_navigation_align')? gdlr_core_get_flexslider_navigation_align(): array()),
							'carousel-navigation-left-icon' => (function_exists('gdlr_core_get_flexslider_navigation_left_icon')? gdlr_core_get_flexslider_navigation_left_icon(): array()),
							'carousel-navigation-right-icon' => (function_exists('gdlr_core_get_flexslider_navigation_right_icon')? gdlr_core_get_flexslider_navigation_right_icon(): array()),
							'carousel-navigation-size' => (function_exists('gdlr_core_get_flexslider_navigation_icon_size')? gdlr_core_get_flexslider_navigation_icon_size(): array()),
							'carousel-navigation-icon-color' => (function_exists('gdlr_core_get_flexslider_navigation_icon_color')? gdlr_core_get_flexslider_navigation_icon_color(): array()),
							'carousel-navigation-icon-bg' => (function_exists('gdlr_core_get_flexslider_navigation_icon_background')? gdlr_core_get_flexslider_navigation_icon_background(): array()),
							'carousel-navigation-icon-padding' => (function_exists('gdlr_core_get_flexslider_navigation_icon_padding')? gdlr_core_get_flexslider_navigation_icon_padding(): array()),
							'carousel-navigation-icon-radius' => (function_exists('gdlr_core_get_flexslider_navigation_icon_radius')? gdlr_core_get_flexslider_navigation_icon_radius(): array()),
							'carousel-navigation-margin' => (function_exists('gdlr_core_get_flexslider_navigation_margin')? gdlr_core_get_flexslider_navigation_margin(): array()),
							'carousel-navigation-icon-margin' => (function_exists('gdlr_core_get_flexslider_navigation_icon_margin')? gdlr_core_get_flexslider_navigation_icon_margin(): array()),
							'carousel-nav-style' => array(
								'title' => esc_html__('Carousel Nav Style', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'default' => esc_html__('Default', 'goodlayers-core'),
									'gdlr-core-plain-style gdlr-core-small' => esc_html__('Small Plain Style', 'goodlayers-core'),
									'gdlr-core-plain-style' => esc_html__('Plain Style', 'goodlayers-core'),
									'gdlr-core-plain-circle-style' => esc_html__('Plain Circle Style', 'goodlayers-core'),
									'gdlr-core-middle-plain-style' => esc_html__('Plain Style - Middle ( Simple Line Icon )', 'goodlayers-core'),
									'gdlr-core-round-style' => esc_html__('Large Round Style', 'goodlayers-core'),
									'gdlr-core-rectangle-style' => esc_html__('Rectangle Style', 'goodlayers-core'),
									'gdlr-core-rectangle-style gdlr-core-large' => esc_html__('Large Rectangle Style', 'goodlayers-core'),
								),
								'condition' => array( 'carousel' => 'enable', 'carousel-navigation' => array('navigation','both') )
							),
							'carousel-bullet-style' => array(
								'title' => esc_html__('Carousel Bullet Style', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => (function_exists('gdlr_core_get_flexslider_bullet_types')? gdlr_core_get_flexslider_bullet_types(): array()),
								'condition' => array( 'carousel' => 'enable', 'carousel-navigation' => array('bullet','both') )
							)
						)
					),
					'typography' => array(
						'title' => esc_html__('Typograhy', 'goodlayers-core'),
						'options' => array(
							'quote-size' => array(
								'title' => esc_html__('Quote Size', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel'
							),
							'quote-font-weight' => array(
								'title' => esc_html__('Quote Size', 'goodlayers-core'),
								'type' => 'text',
							),
							'quote-height' => array(
								'title' => esc_html__('Quote Height', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel'
							),
							'quote-top-margin' => array(
								'title' => esc_html__('Quote Top Margin', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel'
							),
							'quote-bottom-margin' => array(
								'title' => esc_html__('Quote Bottom Margin', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel'
							),
							'title-size' => array(
								'title' => esc_html__('Title Size', 'goodlayers-core'),
								'type' => 'fontslider',
								'default' => '28px'
							),
							'title-text-transform' => array(
								'title' => esc_html__('Title Text Transform', 'goodlayers-core'),
								'type' => 'combobox',
								'data-type' => 'text',
								'options' => array(
									'none' => esc_html__('None', 'goodlayers-core'),
									'uppercase' => esc_html__('Uppercase', 'goodlayers-core'),
									'lowercase' => esc_html__('Lowercase', 'goodlayers-core'),
									'capitalize' => esc_html__('Capitalize', 'goodlayers-core'),
								),
								'default' => 'uppercase'
							),
							'title-font-weight' => array(
								'title' => esc_html__('Title Font Weight', 'goodlayers-core'),
								'type' => 'text',
							),
							'title-letter-spacing' => array(
								'title' => esc_html__('Title Letter Spacing', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
							),
							'content-size' => array(
								'title' => esc_html__('Content Size', 'goodlayers-core'),
								'type' => 'fontslider',
								'default' => '15px'
							),
							'content-font-style' => array(
								'title' => esc_html__('Content Font Style', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'' => esc_html__('Default', 'goodlayers-core'),
									'normal' => esc_html__('Normal', 'goodlayers-core'),
									'italic' => esc_html__('Italic', 'goodlayers-core'),
								),
							),
							'content-font-weight' => array(
								'title' => esc_html__('Content Font Weight', 'goodlayers-core'),
								'type' => 'text',
							),
							'content-letter-spacing' => array(
								'title' => esc_html__('Content Letter Spacing', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
							),
							'name-size' => array(
								'title' => esc_html__('Name Size', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
								'default' => ''
							),
							'name-font-weight' => array(
								'title' => esc_html__('Name Font Weight', 'goodlayers-core'),
								'type' => 'text',
							),
							'name-letter-spacing' => array(
								'title' => esc_html__('Name Letter Spacing', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
								'description' => esc_html__('Leave blank for default value', 'goodlayers-core')
							),
							'name-text-transform' => array(
								'title' => esc_html__('Name Text Transform', 'goodlayers-core'),
								'type' => 'combobox',
								'data-type' => 'text',
								'options' => array(
									'' => esc_html__('Default', 'goodlayes-core'),
									'none' => esc_html__('None', 'goodlayers-core'),
									'uppercase' => esc_html__('Uppercase', 'goodlayers-core'),
									'lowercase' => esc_html__('Lowercase', 'goodlayers-core'),
									'capitalize' => esc_html__('Capitalize', 'goodlayers-core'),
								)
							),
							'caption-size' => array(
								'title' => esc_html__('Position Size', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel'
							),
							'position-font-style' => array(
								'title' => esc_html__('Position Font Style', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'' => esc_html__('Default', 'goodlayers-core'),
									'normal' => esc_html__('Normal', 'goodlayers-core'),
									'italic' => esc_html__('Italic', 'goodlayers-core'),
								),
							),
							'position-font-weight' => array(
								'title' => esc_html__('Position Font Weight', 'goodlayers-core'),
								'type' => 'text',
							),
							'rating-font-size' => array(
								'title' => esc_html__('Rating Font Size', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel'
							),
						)
					),				
					'frame' => array(
						'title' => esc_html__('Frame/Shadow', 'goodlayers-core'),
						'options' => array(
							'frame-border-size' => array(
								'title' => esc_html__('Frame Border Size', 'goodlayers-core'),
								'type' => 'custom',
								'item-type' => 'padding',
								'data-input-type' => 'pixel',
								'default' => array( 'top'=>'', 'right'=>'', 'bottom'=>'', 'left'=>'', 'settings'=>'link' )
							),
							'frame-border-color' => array(
								'title' => esc_html__('Frame Border Color', 'goodlayers-core'),
								'type' => 'colorpicker',
								'descripiton' => esc_html__('Only effects the "Column With Frame" style', 'goodlayers-core')
							),
							'frame-hover-border-color' => array(
								'title' => esc_html__('Frame Hover Border Color', 'goodlayers-core'),
								'type' => 'colorpicker',
								'data-input-type' => 'pixel',
								'description' => esc_html__('Only For Blog Column With Frame Style', 'goodlayers-core')
							),
							'frame-border-radius' => array(
								'title' => esc_html__('Frame Border Radius', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
							),
							'frame-shadow-size' => array(
								'title' => esc_html__('Frame Shadow Size', 'goodlayers-core'),
								'type' => 'custom',
								'item-type' => 'padding',
								'options' => array('x', 'y', 'size'),
								'data-input-type' => 'pixel',
							),
							'frame-shadow-color' => array(
								'title' => esc_html__('Frame Shadow Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'frame-shadow-opacity' => array(
								'title' => esc_html__('Frame Shadow Opacity', 'goodlayers-core'),
								'type' => 'text',
								'default' => '0.2',
								'description' => esc_html__('Fill the number between 0.01 to 1', 'goodlayers-core')
							),
							'enable-move-up-shadow-effect' => array(
								'title' => esc_html__('Move Up Shadow Hover Effect', 'goodlayers-core'),
								'type' => 'checkbox',
								'default' => 'disable',
								'descripiton' => esc_html__('Only effects the "Column With Frame" style', 'goodlayers-core')
							),
							'move-up-effect-length' => array(
								'title' => esc_html__('Move Up Hover Effect Length', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
								'condition' => array( 'enable-move-up-shadow-effect' => 'enable' )
							),
							'frame-hover-border-width' => array(
								'title' => esc_html__('Frame Hover Border Width', 'goodlayers-core'),
								'type' => 'custom',
								'item-type' => 'padding',
								'data-input-type' => 'pixel',
								'default' => array( 'top'=>'', 'right'=>'', 'bottom'=>'', 'left'=>'', 'settings'=>'link' )
							),
							'frame-hover-shadow-size' => array(
								'title' => esc_html__('Shadow Hover Size ( for image/frame )', 'goodlayers-core'),
								'type' => 'custom',
								'item-type' => 'padding',
								'options' => array('x', 'y', 'size'),
								'data-input-type' => 'pixel',
								'condition' => array( 'enable-move-up-shadow-effect' => 'enable' )
							),
							'frame-hover-shadow-color' => array(
								'title' => esc_html__('Shadow Hover Color ( for image/frame )', 'goodlayers-core'),
								'type' => 'colorpicker',
								'condition' => array( 'enable-move-up-shadow-effect' => 'enable' )
							),
							'frame-hover-shadow-opacity' => array(
								'title' => esc_html__('Shadow Hover Opacity ( for image/frame )', 'goodlayers-core'),
								'type' => 'text',
								'default' => '0.2',
								'description' => esc_html__('Fill the number between 0.01 to 1', 'goodlayers-core'),
								'condition' => array( 'enable-move-up-shadow-effect' => 'enable' )
							),
						)
					),
					'color' => array(
						'title' => esc_html__('Color', 'goodlayers-core'),
						'options' => array(
							'title-color' => array(
								'title' => esc_html__('Title Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'caption-color' => array(
								'title' => esc_html__('Caption Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'quote-color' => array(
								'title' => esc_html__('Quote Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'content-color' => array(
								'title' => esc_html__('Content Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'name-color' => array(
								'title' => esc_html__('Name Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'position-color' => array(
								'title' => esc_html__('Position Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'star-rating-color' => array(
								'title' => esc_html__('Star Rating Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							)
						)
					),
					'spacing' => array(
						'title' => esc_html__('Spacing', 'goodlayers-core'),
						'options' => array(
							'thumbnail-width' => array(
								'title' => esc_html__('Thumbnail Width', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel'
							),
							'caption-spaces' => array(
								'title' => esc_html__('Space Between Caption ( And Title )', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
								'default' => ''
							),
							'title-wrap-bottom-margin' => array(
								'title' => esc_html__('Title Wrap Bottom Margin', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
							),
							'content-bottom-padding' => array(
								'title' => esc_html__('Content Bottom Margin', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
								'default' => '0px'
							),
							'padding-bottom' => array(
								'title' => esc_html__('Padding Bottom ( Item )', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
								'default' => $gdlr_core_item_pdb
							)
						)
					)
				);
			}

			// get the preview for page builder
			static function get_preview( $settings = array() ){
				$content  = self::get_content($settings, true);
				$id = mt_rand(0, 9999);
				
				ob_start();
?><script id="gdlr-core-preview-testimonial-<?php echo esc_attr($id); ?>" >
if( document.readyState == 'complete' ){
	jQuery(document).ready(function(){
		jQuery('#gdlr-core-preview-testimonial-<?php echo esc_attr($id); ?>').parent().gdlr_core_flexslider();
	});
}else{
	jQuery(window).load(function(){
		jQuery('#gdlr-core-preview-testimonial-<?php echo esc_attr($id); ?>').parent().gdlr_core_flexslider();
	});
}
</script><?php	
				$content .= ob_get_contents();
				ob_end_clean();
				
				return $content;
			}		
			
			// get the content from settings
			static function get_content( $settings = array(), $preview = false ){
				global $gdlr_core_item_pdb;

				// default variable
				if( empty($settings) ){
					$settings = array(
						'title' => esc_html__('Sample Testimonial Title', 'goodlayers-core'),
						'tabs' => array(
							array(
								'title' => esc_html__('Sameple Name', 'goodlayers-core'),
								'position' => esc_html__('Sample Position', 'goodlayers-core'),
								'content' => esc_html__('Sample testimonial content area', 'goodlayers-core'),
								'image' => '',
							),
							array(
								'title' => esc_html__('Sameple Name', 'goodlayers-core'),
								'position' => esc_html__('Sample Position', 'goodlayers-core'),
								'content' => esc_html__('Sample testimonial content area', 'goodlayers-core'),
								'image' => '',
							),
						),
						'column' => 3, 'carousel' => 'disable', 'style' => 'left', 
						'padding-bottom' => $gdlr_core_item_pdb
					);
				}
				
				// default value
				$settings['style'] = empty($settings['style'])? 'left': $settings['style'];
				$settings['with-frame'] = empty($settings['with-frame'])? 'disable': $settings['with-frame']; 
 				$settings['column'] = empty($settings['column'])? '3': $settings['column'];
				$settings['carousel'] = empty($settings['carousel'])? 'disable': $settings['carousel'];

				// custom css
				$custom_style  = '';
				if( $settings['with-frame'] == 'enable' ){
					if( !empty($settings['frame-hover-border-width']) && $settings['frame-hover-border-width'] != array( 'top'=>'', 'right'=>'', 'bottom'=>'', 'left'=>'', 'settings'=>'link' ) ){
						$custom_style .= '#custom_style_id .gdlr-core-testimonial-frame:hover .gdlr-core-testimonial-frame-border{ ' . gdlr_core_esc_style(array(
							'border-width' => $settings['frame-hover-border-width']
						), false, true) . ' }';
					}
					if( !empty($settings['frame-hover-border-color']) ){
						$custom_style .= '#custom_style_id .gdlr-core-testimonial-frame:hover .gdlr-core-testimonial-frame-border{ border-color: ' . $settings['frame-hover-border-color'] . ' !important; }';
					}
					if( !empty($settings['enable-move-up-shadow-effect']) && $settings['enable-move-up-shadow-effect'] == 'enable' ){
						$custom_style_temp = gdlr_core_esc_style(array(
							'background-shadow-size' => empty($settings['frame-hover-shadow-size'])? '': $settings['frame-hover-shadow-size'],
							'background-shadow-color' => empty($settings['frame-hover-shadow-color'])? '': $settings['frame-hover-shadow-color'],
							'background-shadow-opacity' => empty($settings['frame-hover-shadow-opacity'])? '': $settings['frame-hover-shadow-opacity'],
						), false);
						if( !empty($settings['move-up-effect-length']) ){
							$custom_style_temp .= 'transform: translate3d(0, -' . $settings['move-up-effect-length'] . ', 0); ';
						}
						if( !empty($custom_style_temp) ){
							$custom_style .= '#custom_style_id .gdlr-core-move-up-with-shadow:hover{ ' . $custom_style_temp . ' }';
						}
					}
				}
				if( !empty($custom_style) ){
					if( empty($settings['id']) ){
						global $gdlr_core_portfolio_id; 
						$gdlr_core_portfolio_id = empty($gdlr_core_portfolio_id)? array(): $gdlr_core_portfolio_id;

						// generate unique id so it does not get overwritten in admin area
						$rnd_portfolio_id = mt_rand(0, 99999);
						while( in_array($rnd_portfolio_id, $gdlr_core_portfolio_id) ){
							$rnd_portfolio_id = mt_rand(0, 99999);
						}
						$gdlr_core_portfolio_id[] = $rnd_portfolio_id;
						$settings['id'] = 'gdlr-core-portfolio-' . $rnd_portfolio_id;
					}

					$custom_style = str_replace('custom_style_id', $settings['id'], $custom_style); 
					if( $preview ){
						$custom_style = '<style>' . $custom_style . '</style>';
					}else{
						gdlr_core_add_inline_style($custom_style);
						$custom_style = '';
					}
				}

				// start printing item
				$extra_class  = ' gdlr-core-testimonial-style-' . $settings['style'];
				$extra_class .= ($settings['carousel'] == 'enable')? ' gdlr-core-item-pdlr': '';
				$extra_class .= empty($settings['class'])? '': ' ' . $settings['class'];
				
				$ret  = '<div class="gdlr-core-testimonial-item gdlr-core-item-pdb clearfix ' . esc_attr($extra_class) . '" ';
				if( !empty($settings['padding-bottom']) && $settings['padding-bottom'] != $gdlr_core_item_pdb ){
					$ret .= gdlr_core_esc_style(array('padding-bottom'=>$settings['padding-bottom']));
				}
				if( !empty($settings['id']) ){
					$ret .= ' id="' . esc_attr($settings['id']) . '" ';
				}
				$ret .= ' >';

				if( !empty($settings['title']) && in_array($settings['style'], array('center', 'left-2')) ){
					if( $settings['carousel'] == 'disable' ){
						$title_settings = $settings;
						$title_settings['title-align'] = 'center';
						$title_settings['title-text-transform'] = (empty($settings['title-text-transform']) || $settings['title-text-transform'] == 'uppercase')? '': $settings['title-text-transform'];
						$title_settings['title-letter-spacing'] = empty($title_settings['title-letter-spacing'])? '': $title_settings['title-letter-spacing'];
						$title_settings['title-font-weight'] = empty($title_settings['title-font-weight'])? '': $title_settings['title-font-weight'];
						$ret .= gdlr_core_block_item_title($title_settings);
					}

				}else if( !empty($settings['title']) ){
					$ret .= '<div class="gdlr-core-testimonial-item-title-wrap ' . (($settings['carousel'] == 'enable')? '': 'gdlr-core-item-mglr') . '" ' . gdlr_core_esc_style(array(
						'margin-bottom' => empty($settings['title-wrap-bottom-margin'])? '': $settings['title-wrap-bottom-margin']
					)) . ' >';
					$ret .= '<h3 class="gdlr-core-testimonial-item-title" ' . gdlr_core_esc_style(array(
						'font-size' => (empty($settings['title-size']) || $settings['title-size'] == '28px')? '': $settings['title-size'],
						'font-weight' => empty($settings['title-font-weight'])? '': $settings['title-font-weight'],
						'text-transform' => (empty($settings['title-text-transform']) || $settings['title-text-transform'] == 'uppercase')? '': $settings['title-text-transform'],
						'letter-spacing' => empty($settings['title-letter-spacing'])? '': $settings['title-letter-spacing'],
						'color' => (empty($settings['title-color']))? '': $settings['title-color']
					)) . ' >';
					$ret .= gdlr_core_text_filter($settings['title']);
					$ret .= '</h3>';

					if( !empty($settings['carousel-navigation']) && in_array($settings['carousel-navigation'], array('navigation', 'both')) ){
						$nav_style = (empty($settings['carousel-nav-style']) || $settings['carousel-nav-style'] == 'default')? 'gdlr-core-plain-style': $settings['carousel-nav-style'];
						if( $nav_style != 'gdlr-core-middle-plain-style' ){
							$title_settings = array('carousel' => 'enable');
							if( $settings['style'] == 'left' ){
								$ret .= '<div class="gdlr-core-flexslider-nav ' . esc_attr($nav_style) . ' gdlr-core-absolute-center gdlr-core-right" ></div>';
							}else if( $settings['style'] == 'right' ){
								$ret .= '<div class="gdlr-core-flexslider-nav ' . esc_attr($nav_style) . ' gdlr-core-absolute-center gdlr-core-left" ></div>';
							}
						}
					}
					
					$ret .= '</div>'; // gdlr-core-testimonial-title-wrap
				}

				// grid item
				if( $settings['carousel'] == 'disable' ){

					if( !empty($settings['tabs']) ){
						$t_column_count = 0;
						$t_column = 60 / intval($settings['column']);
						foreach( $settings['tabs'] as $tab ){
							$column_class  = ' gdlr-core-column-' . $t_column;
							$column_class .= ($t_column_count % 60 == 0)? ' gdlr-core-column-first': '';

							$ret .= '<div class="gdlr-core-testimonial-column gdlr-core-item-pdlr gdlr-core-item-mgb ' . esc_attr($column_class) . '" >';
							$ret .= self::get_tab_item($tab, $settings);
							$ret .= '</div>';

							$t_column_count += $t_column;
						}
					}

				// carousel item
				}else{
					$slides = array();
					$flex_atts = array(
						'carousel' => true,
						'overflow' => empty($settings['carousel-overflow'])? '': $settings['carousel-overflow'],
						'column' => empty($settings['column'])? '3': $settings['column'],
						'move' => empty($settings['carousel-scrolling-item-amount'])? '': $settings['carousel-scrolling-item-amount'],
						'navigation' => empty($settings['carousel-navigation'])? 'navigation': $settings['carousel-navigation'],
						'navigation-align' => empty($settings['carousel-navigation-align'])? '': $settings['carousel-navigation-align'],
						'navigation-size' => empty($settings['carousel-navigation-size'])? '': $settings['carousel-navigation-size'],
						'navigation-icon-color' => empty($settings['carousel-navigation-icon-color'])? '': $settings['carousel-navigation-icon-color'],
						'navigation-icon-background' => empty($settings['carousel-navigation-icon-bg'])? '': $settings['carousel-navigation-icon-bg'],
						'navigation-icon-padding' => empty($settings['carousel-navigation-icon-padding'])? '': $settings['carousel-navigation-icon-padding'],
						'navigation-icon-radius' => empty($settings['carousel-navigation-icon-radius'])? '': $settings['carousel-navigation-icon-radius'],
						'navigation-margin' => empty($settings['carousel-navigation-margin'])? '': $settings['carousel-navigation-margin'],
						'navigation-icon-margin' => empty($settings['carousel-navigation-icon-margin'])? '': $settings['carousel-navigation-icon-margin'],
						'navigation-left-icon' => empty($settings['carousel-navigation-left-icon'])? '': $settings['carousel-navigation-left-icon'],
						'navigation-right-icon' => empty($settings['carousel-navigation-right-icon'])? '': $settings['carousel-navigation-right-icon'],
						'bullet-style' => empty($settings['carousel-bullet-style'])? '': $settings['carousel-bullet-style'],
						'disable-autoslide' => (empty($settings['carousel-autoslide']) || $settings['carousel-autoslide'] == 'enable')? '': true,
					);

					if( !empty($settings['carousel-navigation']) && in_array($settings['carousel-navigation'], array('navigation', 'both')) ){
					
						$center_nav_style = (empty($settings['carousel-nav-style']))? 'default': $settings['carousel-nav-style'];
						if( !empty($settings['title']) && in_array($settings['style'], array('center', 'left-2')) ){
							$title_settings = $settings;
							$title_settings['title-align'] = 'center';
							if( $center_nav_style != 'default' ){
								$title_settings['carousel'] = 'disable';
							}
							$flex_atts['pre-content'] = gdlr_core_block_item_title($title_settings);
						}

						if( $center_nav_style == 'gdlr-core-middle-plain-style' ){
							$flex_atts['vcenter-nav'] = true;
							$flex_atts['additional-class'] = 'gdlr-core-nav-style-middle-plain';

						}else if( $settings['style'] == 'left' || $settings['style'] == 'right' ){
							if( $center_nav_style != 'default' ){
								$flex_atts['nav-parent'] = 'gdlr-core-testimonial-item';

								if( empty($title_settings['carousel']) || $title_settings['carousel'] == 'disable' ){
									$center_nav = '<div class="gdlr-core-flexslider-nav ' . esc_attr($center_nav_style) . ' gdlr-core-center-align" ></div>';
								}
							}
						}else{						
							if( $center_nav_style == 'default' ){
								$flex_atts['vcenter-nav'] = true;
								$flex_atts['additional-class'] = 'gdlr-core-nav-style-middle-large';
							}else{
								$flex_atts['nav-parent'] = 'gdlr-core-testimonial-item';
								$center_nav = '<div class="gdlr-core-flexslider-nav ' . esc_attr($center_nav_style) . ' gdlr-core-center-align" ></div>';
							}
						}
					}

					if( !empty($settings['tabs']) ){
						foreach( $settings['tabs'] as $tab ){
							$slides[] = self::get_tab_item($tab, $settings);
						}
					}

					$ret .= gdlr_core_get_flexslider($slides, $flex_atts);
					$ret .= empty($center_nav)? '': $center_nav;
				}

				$ret .= '</div>'; // gdlr-core-testimonial-item
				$ret .= $custom_style;
				
				return $ret;
			}

			static function get_tab_item( $tab = array(), $settings = array() ){ 

				$ret  = '<div class="gdlr-core-testimonial clearfix" >';
				if( $settings['with-frame'] == 'enable' ){
					$frame_css = array(
						'border-radius' => empty($settings['frame-border-radius'])? '': $settings['frame-border-radius'],
					);					
					$ret .= '<div class="gdlr-core-testimonial-frame clearfix gdlr-core-skin-e-background ';
					if( !empty($settings['enable-move-up-shadow-effect']) && $settings['enable-move-up-shadow-effect'] == 'enable' ){
						$ret .= ' gdlr-core-move-up-with-shadow gdlr-core-outer-frame-element ';
					}else if( !empty($settings['frame-shadow-size']['size']) && !empty($settings['frame-shadow-color']) && !empty($settings['frame-shadow-opacity']) ){
						$frame_css['background-shadow-size'] = $settings['frame-shadow-size'];
						$frame_css['background-shadow-color'] = $settings['frame-shadow-color'];
						$frame_css['background-shadow-opacity'] = $settings['frame-shadow-opacity'];
						$ret .= ' gdlr-core-outer-frame-element ';
					}
					$ret .= '" ' . gdlr_core_esc_style($frame_css) . ' >';

					$ret .= '<div class="gdlr-core-testimonial-frame-border" ' . gdlr_core_esc_style(array(
						'border-width' => ( empty($settings['frame-border-size']) || $settings['frame-border-size'] == array('top'=>'', 'right'=>'', 'bottom'=>'', 'left'=>'', 'settings'=>'link') )? '': $settings['frame-border-size'],
						'border-color' => empty($settings['frame-border-color'])? '': $settings['frame-border-color'],
						'border-radius' => empty($settings['frame-border-radius'])? '': $settings['frame-border-radius'],
					)) . ' ></div>';

				}
	
				if( ($settings['style'] == 'left' || $settings['style'] == 'right') &&
					(empty($settings['enable-quote']) || $settings['enable-quote'] == 'enable') ){
					$ret .= '<div class="gdlr-core-testimonial-quote gdlr-core-quote-font ';
					if( !empty($settings['left-quote-position']) && $settings['left-quote-position'] == 'top' ){
						$ret .= ' gdlr-core-top';
					}
					$ret .= '" ' . gdlr_core_esc_style(array(
						'font-size' => empty($settings['quote-size'])? '': $settings['quote-size'],
						'font-weight' => empty($settings['quote-font-weight'])? '': $settings['quote-font-weight'],
						'height' => empty($settings['quote-height'])? '': $settings['quote-height'],
						'margin-top' => empty($settings['quote-top-margin'])? '': $settings['quote-top-margin'],
						'margin-bottom' => empty($settings['quote-bottom-margin'])? '': $settings['quote-bottom-margin'],
						'color' => empty($settings['quote-color'])? '': $settings['quote-color']
					)) . ' >' . ($settings['style'] == 'right'? '&#8221;': '&#8220;') . '</div>';
				}else if( $settings['style'] == 'left-2' && !empty($tab['image']) ){
					$thumbnail_size = empty($settings['thumbnail-size'])? 'thumbnail': $settings['thumbnail-size'];
					
					$ret .= '<div class="gdlr-core-testimonial-author-image gdlr-core-media-image" ' . gdlr_core_esc_style(array(
						'width' => empty($settings['thumbnail-width'])? '': $settings['thumbnail-width']
					)) . ' >';
					$ret .= gdlr_core_get_image($tab['image'], $thumbnail_size);
					if( empty($settings['enable-quote']) || $settings['enable-quote'] == 'enable' ){
						$ret .= '<div class="gdlr-core-testimonial-quote gdlr-core-quote-font gdlr-core-skin-icon" ' . gdlr_core_esc_style(array(
							'font-size' => empty($settings['quote-size'])? '': $settings['quote-size'],
							'font-weight' => empty($settings['quote-font-weight'])? '': $settings['quote-font-weight'],
							'height' => empty($settings['quote-height'])? '': $settings['quote-height'],
							'margin-top' => empty($settings['quote-top-margin'])? '': $settings['quote-top-margin'],
							'margin-bottom' => empty($settings['quote-bottom-margin'])? '': $settings['quote-bottom-margin'],
							'color' => empty($settings['quote-color'])? '': $settings['quote-color']
						)) . ' >&#8220;</div>';
					}
					$ret .= '</div>';
				}

				$ret .= '<div class="gdlr-core-testimonial-content-wrap" >';

				if( $settings['style'] == 'center' && (empty($settings['enable-quote']) || $settings['enable-quote'] == 'enable') &&
					(!empty($settings['quote-position']) && $settings['quote-position'] == 'top') ){
					$ret .= '<div class="gdlr-core-testimonial-quote gdlr-core-quote-font gdlr-core-skin-icon" ' . gdlr_core_esc_style(array(
						'font-size' => empty($settings['quote-size'])? '': $settings['quote-size'],
						'font-weight' => empty($settings['quote-font-weight'])? '': $settings['quote-font-weight'],
						'height' => empty($settings['quote-height'])? '': $settings['quote-height'],
						'margin-top' => empty($settings['quote-top-margin'])? '': $settings['quote-top-margin'],
						'margin-bottom' => empty($settings['quote-bottom-margin'])? '': $settings['quote-bottom-margin'],
						'color' => empty($settings['quote-color'])? '': $settings['quote-color']
					)) . ' >&#8220;</div>';
				}

				if( !empty($tab['content']) ){
					$ret .= '<div class="gdlr-core-testimonial-content gdlr-core-info-font gdlr-core-skin-content" ' . gdlr_core_esc_style(array(
						'font-size' => (empty($settings['content-size']) || $settings['content-size'] == '28px')? '': $settings['content-size'],
						'font-style' => empty($settings['content-font-style'])? '': $settings['content-font-style'],
						'font-weight' => empty($settings['content-font-weight'])? '': $settings['content-font-weight'],
						'letter-spacing' => empty($settings['content-letter-spacing'])? '': $settings['content-letter-spacing'],
						'color' => (empty($settings['content-color']))? '': $settings['content-color'],
						'padding-bottom' => (empty($settings['content-bottom-padding']) || $settings['content-bottom-padding'] == '0px')? '': $settings['content-bottom-padding']
					)) . ' >';
					if( $settings['style'] == 'left-bg' ){
						$ret .= '<div class="gdlr-core-testimonial-quote gdlr-core-quote-font gdlr-core-skin-icon" ' . gdlr_core_esc_style(array(
							'font-size' => empty($settings['quote-size'])? '': $settings['quote-size'],
							'font-weight' => empty($settings['quote-font-weight'])? '': $settings['quote-font-weight'],
							'height' => empty($settings['quote-height'])? '': $settings['quote-height'],
							'margin-top' => empty($settings['quote-top-margin'])? '': $settings['quote-top-margin'],
							'margin-bottom' => empty($settings['quote-bottom-margin'])? '': $settings['quote-bottom-margin'],
							'color' => empty($settings['quote-color'])? '': $settings['quote-color']
						)) . ' >&#8220;</div>';
					}
					$ret .= gdlr_core_content_filter($tab['content']);
					$ret .= '</div>';
				}

				if( $settings['style'] == 'center' && (empty($settings['enable-quote']) || $settings['enable-quote'] == 'enable') &&
					(empty($settings['quote-position']) || $settings['quote-position'] == 'bottom') ){
					$ret .= '<div class="gdlr-core-testimonial-quote gdlr-core-quote-font gdlr-core-skin-icon" ' . gdlr_core_esc_style(array(
						'font-size' => empty($settings['quote-size'])? '': $settings['quote-size'],
						'font-weight' => empty($settings['quote-font-weight'])? '': $settings['quote-font-weight'],
						'height' => empty($settings['quote-height'])? '': $settings['quote-height'],
						'margin-top' => empty($settings['quote-top-margin'])? '': $settings['quote-top-margin'],
						'margin-bottom' => empty($settings['quote-bottom-margin'])? '': $settings['quote-bottom-margin'],
						'color' => empty($settings['quote-color'])? '': $settings['quote-color']
					)) . ' >&#8220;</div>';
				}

				$ret .= '<div class="gdlr-core-testimonial-author-wrap clearfix" >';
				if( !in_array($settings['style'], array('left-2', 'center-2')) && !empty($tab['image']) ){
					$ret .= '<div class="gdlr-core-testimonial-author-image gdlr-core-media-image" ' . gdlr_core_esc_style(array(
						'width' => empty($settings['thumbnail-width'])? '': $settings['thumbnail-width']
					)) . ' >' . gdlr_core_get_image($tab['image'], 'thumbnail') . '</div>';
				}
				$ret .= '<div class="gdlr-core-testimonial-author-content" >';
				if( !empty($tab['title']) ){
					$ret .= '<div class="gdlr-core-testimonial-title gdlr-core-title-font gdlr-core-skin-title" ' . gdlr_core_esc_style(array(
						'color' => (empty($settings['name-color']))? '': $settings['name-color'],
						'font-size' => (empty($settings['name-size']))? '': $settings['name-size'],
						'font-weight' => (empty($settings['name-font-weight']))? '': $settings['name-font-weight'],
						'letter-spacing' => (empty($settings['name-letter-spacing']))? '': $settings['name-letter-spacing'],
						'text-transform' => (empty($settings['name-text-transform']))? '': $settings['name-text-transform'],
					)) . ' >' . gdlr_core_text_filter($tab['title']) . '</div>';
				}
				if( !empty($tab['position']) || !empty($tab['rating']) ){
					$ret .= '<div class="gdlr-core-testimonial-position gdlr-core-info-font gdlr-core-skin-caption" ' . gdlr_core_esc_style(array(
						'color' => empty($settings['position-color'])? '': $settings['position-color'],
						'font-size' => empty($settings['caption-size'])? '': $settings['caption-size'],
						'font-style' => empty($settings['position-font-style'])? '': $settings['position-font-style'],
						'font-weight' => empty($settings['position-font-weight'])? '': $settings['position-font-weight']
					)) . ' >';
					if( !empty($tab['rating']) ){
						$rating_class = '';
						if( in_array($settings['style'], array('left', 'left-2', 'left-bg')) && !empty($settings['rating-position']) ){
							$rating_class = ' gdlr-core-' . $settings['rating-position'];
						}
						
						$settings['star-rating-color'] = empty($settings['star-rating-color'])? '': $settings['star-rating-color'];
						$ret .= gdlr_core_get_rating($tab['rating'], array(
							'class' => $rating_class,
							'rating-color' => $settings['star-rating-color']
						), array(
							'font-size' => empty($settings['rating-font-size'])? '': $settings['rating-font-size'],
							'margin-top' => empty($settings['rating-top-margin'])? '': $settings['rating-top-margin']
						));
					}
					if( !empty($tab['position']) ){
						$ret .= gdlr_core_text_filter($tab['position']);
					}
					$ret .= '</div>';
				}
				$ret .= '</div>'; // gdlr-core-testimonial-author-content

				if( $settings['style'] == 'center-2' && !empty($tab['image']) ){
					$ret .= '<div class="gdlr-core-testimonial-author-image gdlr-core-media-image" ' . gdlr_core_esc_style(array(
						'width' => empty($settings['thumbnail-width'])? '': $settings['thumbnail-width']
					)) . ' >' . gdlr_core_get_image($tab['image'], 'thumbnail') . '</div>';
				}
				$ret .= '</div>'; // gdlr-core-testimonial-author-wrap

				$ret .= '</div>'; // gdlr-core-testimonial-content-wrap

				if( $settings['with-frame'] == 'enable' ){
					$ret .= '</div>';
				}
				$ret .= '</div>'; // gdlr-core-testimonial

				return $ret;
			}			
			
		} // gdlr_core_pb_element_testimonial
	} // class_exists	