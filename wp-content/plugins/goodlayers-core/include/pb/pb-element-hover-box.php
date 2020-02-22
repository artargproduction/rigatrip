<?php
	/*	
	*	Goodlayers Item For Page Builder
	*/
	
	gdlr_core_page_builder_element::add_element('hover-box', 'gdlr_core_pb_element_hover_box'); 
	
	if( !class_exists('gdlr_core_pb_element_hover_box') ){
		class gdlr_core_pb_element_hover_box{
			
			// get the element settings
			static function get_settings(){
				return array(
					'icon' => 'fa-inbox',
					'title' => esc_html__('Hover Box', 'goodlayers-core')
				);
			}
			
			// return the element options
			static function get_options(){
				global $gdlr_core_item_pdb;
				
				return array(
					'general' => array(
						'title' => esc_html__('General', 'goodlayers-core'),
						'options' => array(
							'tabs' => array(
								'title' => esc_html__('Add New Tab', 'goodlayers-core'),
								'type' => 'custom',
								'item-type' => 'tabs',
								'wrapper-class' => 'gdlr-core-fullsize',
								'options' => array(
									'image' => array(
										'title' => esc_html__('Image', 'goodlayers-core'),
										'type' => 'upload'
									),
									'title' => array(
										'title' => esc_html__('Title', 'goodlayers-core'),
										'type' => 'text'
									),
									'content' => array(
										'title' => esc_html__('Content', 'goodlayers-core'),
										'type' => 'textarea'
									),
									'link' => array(
										'title' => esc_html__('Link', 'goodlayers-core'),
										'type' => 'text'
									),
								),
								'default' => array(
									array(
										'title' => esc_html__('Sameple Name', 'goodlayers-core'),
										'content' => esc_html__('Sample content area', 'goodlayers-core'),
									),
									array(
										'title' => esc_html__('Sameple Name', 'goodlayers-core'),
										'content' => esc_html__('Sample content area', 'goodlayers-core'),
									),
								)
							),
						),
					),
					'style' => array(
						'title' => esc_html__('Style', 'goodlayers-core'),
						'options' => array(
							'text-align' => array(
								'title' => esc_html__('Text Align', 'goodlayers-core'),
								'type' => 'radioimage',
								'options' => 'text-align',
								'default' => 'center'
							),	
							'image-position' => array(
								'title' => esc_html__('Image Position', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'top' => esc_html__('Top of Hover Box', 'goodlayers-core'),
									'inside' => esc_html__('Inside Hover Box', 'goodlayers-core')
								),
								'default' => 'top'
							),
							'column' => array(
								'title' => esc_html__('Column Number', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array( 1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6),
								'default' => 3
							),
							'carousel' => array(
								'title' => esc_html__('Enable Carousel', 'goodlayers-core'),
								'type' => 'checkbox',
								'default' => 'disable'
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
								'options' => array(
									'none' => esc_html__('None', 'goodlayers-core'),
									'navigation' => esc_html__('Only Navigation', 'goodlayers-core'),
									'bullet' => esc_html__('Only Bullet', 'goodlayers-core'),
									'both' => esc_html__('Both Navigation and Bullet', 'goodlayers-core'),
								),
								'default' => 'navigation',
								'condition' => array( 'carousel' => 'enable' )
							),
							'carousel-nav-style' => array(
								'title' => esc_html__('Carousel Nav Style', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'default' => esc_html__('Default', 'goodlayers-core'),
									'gdlr-core-plain-style gdlr-core-small' => esc_html__('Small Plain Style', 'goodlayers-core'),
									'gdlr-core-plain-style' => esc_html__('Plain Style', 'goodlayers-core'),
									'gdlr-core-plain-circle-style' => esc_html__('Plain Circle Style', 'goodlayers-core'),
									'gdlr-core-round-style' => esc_html__('Large Round Style', 'goodlayers-core'),
									'gdlr-core-rectangle-style' => esc_html__('Rectangle Style', 'goodlayers-core'),
									'gdlr-core-rectangle-style gdlr-core-large' => esc_html__('Large Rectangle Style', 'goodlayers-core'),
								),
								'condition' => array( 'carousel' => 'enable', 'carousel-navigation' => array('navigation','both') )
							),
							'carousel-bullet-style' => array(
								'title' => esc_html__('Carousel Bullet Style', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'default' => esc_html__('Default', 'goodlayers-core'),
									'cylinder' => esc_html__('Cylinder', 'goodlayers-core'),
								),
								'condition' => array( 'carousel' => 'enable', 'carousel-navigation' => array('bullet','both') )
							)
						)
					),
					'typography' => array(
						'title' => esc_html__('Typograhy', 'goodlayers-core'),
						'options' => array(
							'hover-box-title-size' => array(
								'title' => esc_html__('Hover Box Title Size', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
							),
							'hover-box-title-text-transform' => array(
								'title' => esc_html__('Hover Box Title Text Transform', 'goodlayers-core'),
								'type' => 'combobox',
								'data-type' => 'text',
								'options' => array(
									'none' => esc_html__('None', 'goodlayers-core'),
									'uppercase' => esc_html__('Uppercase', 'goodlayers-core'),
									'lowercase' => esc_html__('Lowercase', 'goodlayers-core'),
									'capitalize' => esc_html__('Capitalize', 'goodlayers-core'),
								),
								'default' => 'none'
							),
							'hover-box-title-font-weight' => array(
								'title' => esc_html__('Hover Box Title Font Weight', 'goodlayers-core'),
								'type' => 'text',
							),
							'hover-box-title-letter-spacing' => array(
								'title' => esc_html__('Hover Box Title Letter Spacing', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
							),
						)
					),				
					'color' => array(
						'title' => esc_html__('Color', 'goodlayers-core'),
						'options' => array(
							'hover-box-title-color' => array(
								'title' => esc_html__('Hover Box Title Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'hover-box-content-color' => array(
								'title' => esc_html__('Hover Box Content Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'hover-box-background-color' => array(
								'title' => esc_html__('Hover Box Background Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'hover-box-background-hover-color' => array(
								'title' => esc_html__('Hover Box Background Hover Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							)
						)
					),
					'shadow' => array(
						'title' => esc_html__('Shadow', 'goodlayers-core'),
						'options' => array(
							'shadow-size' => array(
								'title' => esc_html__('Shadow Size', 'goodlayers-core'),
								'type' => 'custom',
								'item-type' => 'padding',
								'options' => array('x', 'y', 'size'),
								'data-input-type' => 'pixel',
							),
							'shadow-color' => array(
								'title' => esc_html__('Shadow Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'shadow-opacity' => array(
								'title' => esc_html__('Shadow Opacity', 'goodlayers-core'),
								'type' => 'text',
								'default' => '0.2',
								'description' => esc_html__('Fill the number between 0.01 to 1', 'goodlayers-core')
							),
						)
					),
					'spacing' => array(
						'title' => esc_html__('Spacing', 'goodlayers-core'),
						'options' => array(
							'hover-box-padding' => array(
								'title' => esc_html__('Hover Box Padding', 'goodlayers-core'),
								'type' => 'custom',
								'item-type' => 'padding',
								'data-input-type' => 'pixel',
								'default' => array( 'top'=>'45px', 'right'=>'30px', 'bottom'=>'25px', 'left'=>'30px', 'settings'=>'unlink' )
							),
							'padding-bottom' => array(
								'title' => esc_html__('Padding Bottom ( Wrapper )', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
								'default' => $gdlr_core_item_pdb
							)
						)
					),
					'item-title' => array(
						'title' => esc_html__('Item Title', 'goodlayers-core'),
						'options' => gdlr_core_block_item_option()
					)
				);
			}

			// get the preview for page builder
			static function get_preview( $settings = array() ){
				$content  = self::get_content($settings, true);
				$id = mt_rand(0, 9999);
				
				ob_start();
?><script id="gdlr-core-preview-hover-box-<?php echo esc_attr($id); ?>" >
if( document.readyState == 'complete' ){
	jQuery(document).ready(function(){
		jQuery('#gdlr-core-preview-hover-box-<?php echo esc_attr($id); ?>').parent().gdlr_core_flexslider();
	});
}else{
	jQuery(window).load(function(){
		jQuery('#gdlr-core-preview-hover-box-<?php echo esc_attr($id); ?>').parent().gdlr_core_flexslider();
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
						'tabs' => array(
							array(
								'title' => esc_html__('Sameple Name', 'goodlayers-core'),
								'content' => esc_html__('Sample content area', 'goodlayers-core'),
							),
							array(
								'title' => esc_html__('Sameple Name', 'goodlayers-core'),
								'content' => esc_html__('Sample content area', 'goodlayers-core'),
							),
						),
						'padding-bottom' => $gdlr_core_item_pdb
					);
				}
				
				$extra_style = '';
				$hover_style = gdlr_core_esc_style(array(
					'background-color' => empty($settings['hover-box-background-hover-color'])? '': $settings['hover-box-background-hover-color']
				), false, true);
				if( !empty($hover_style) ){

					if( empty($settings['id']) ){
						global $gdlr_core_hover_box_id; 
						$gdlr_core_hover_box_id = empty($gdlr_core_hover_box_id)? array(): $gdlr_core_hover_box_id;

						// generate unique id so it does not get overwritten in admin area
						$rnd_id = mt_rand(0, 99999);
						while( in_array($rnd_id, $gdlr_core_hover_box_id) ){
							$rnd_id = mt_rand(0, 99999);
						}
						$gdlr_core_hover_box_id[] = $rnd_id;

						$settings['id'] = 'gdlr-core-hover-box-id-' . $rnd_id;
					}
					
					$extra_style  = '#gdlr-core-hover-box-id-' . $rnd_id . ' .gdlr-core-hover-box:hover{' . $hover_style . '}';
					if( $preview ){
						$extra_style = '<style>' . $extra_style . '</style>';
					}else{
						gdlr_core_add_inline_style($extra_style);
						$extra_style = '';
					}
				}

				// default value
				$settings['image-position'] = empty($settings['image-position'])? 'top': $settings['image-position'];
				$settings['column'] = empty($settings['column'])? '3': $settings['column'];
				$settings['carousel'] = empty($settings['carousel'])? 'disable': $settings['carousel'];

				// start printing item
				$extra_class  = ($settings['carousel'] == 'enable')? ' gdlr-core-item-pdlr': '';
				$extra_class .= empty($settings['class'])? '': ' ' . $settings['class'];
				$extra_class .= ' gdlr-core-' . (empty($settings['text-align'])? 'center': $settings['text-align']) . '-align';
				
				$ret  = $extra_style;
				$ret .= '<div class="gdlr-core-hover-box-item gdlr-core-item-pdb clearfix ' . esc_attr($extra_class) . '" ';
				if( !empty($settings['padding-bottom']) && $settings['padding-bottom'] != $gdlr_core_item_pdb ){
					$ret .= gdlr_core_esc_style(array('padding-bottom'=>$settings['padding-bottom']));
				}
				if( !empty($settings['id']) ){
					$ret .= ' id="' . esc_attr($settings['id']) . '" ';
				}
				$ret .= ' >';

				$ret .= gdlr_core_block_item_title($settings);

				// grid item
				if( $settings['carousel'] == 'disable' ){

					if( !empty($settings['tabs']) ){
						$t_column_count = 0;
						$t_column = 60 / intval($settings['column']);
						foreach( $settings['tabs'] as $tab ){
							$column_class  = ' gdlr-core-column-' . $t_column;
							$column_class .= ($t_column_count % 60 == 0)? ' gdlr-core-column-first': '';

							$ret .= '<div class="gdlr-core-hover-box-column gdlr-core-item-pdlr gdlr-core-item-mgb ' . esc_attr($column_class) . '" >';
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
						'column' => empty($settings['column'])? '3': $settings['column'],
						'move' => empty($settings['carousel-scrolling-item-amount'])? '': $settings['carousel-scrolling-item-amount'],
						'navigation' => empty($settings['carousel-navigation'])? 'navigation': $settings['carousel-navigation'],
						'bullet-style' => empty($settings['carousel-bullet-style'])? '': $settings['carousel-bullet-style'],
						'nav-parent' => 'gdlr-core-hover-box-item',
						'disable-autoslide' => (empty($settings['carousel-autoslide']) || $settings['carousel-autoslide'] == 'enable')? '': true,
					);

					if( !empty($settings['tabs']) ){
						foreach( $settings['tabs'] as $tab ){
							$slides[] = self::get_tab_item($tab, $settings);
						}
					}

					$ret .= gdlr_core_get_flexslider($slides, $flex_atts);
				}

				$ret .= '</div>'; // gdlr-core-hover-box-item
				
				return $ret;
			}

			static function get_tab_item( $tab = array(), $settings = array() ){ 

				$shadow_atts = array(
					'background-color' => empty($settings['hover-box-background-color'])? '': $settings['hover-box-background-color'],
				);
				$shadow_class = '';
				if( !empty($settings['shadow-size']['size']) && !empty($settings['shadow-color']) && !empty($settings['shadow-opacity']) ){
					$shadow_atts = $shadow_atts + array(
						'background-shadow-size' => empty($settings['shadow-size'])? '': $settings['shadow-size'],
						'background-shadow-color' => empty($settings['shadow-color'])? '': $settings['shadow-color'],
						'background-shadow-opacity' => empty($settings['shadow-opacity'])? '': $settings['shadow-opacity'],
					);

					$shadow_class .= ' gdlr-core-outer-frame-element ';
				}

				$ret  = '<div class="gdlr-core-hover-box ' . esc_attr($shadow_class) . ' clearfix" ' . gdlr_core_esc_style($shadow_atts) . ' >';
				if( $settings['image-position'] == 'top' && !empty($tab['image']) ){
					$ret .= '<div class="gdlr-core-hover-box-thumbnail-top gdlr-core-media-image" >';
					$ret .= gdlr_core_get_image($tab['image']);
					$ret .= '</div>';
				}

				$ret .= '<div class="gdlr-core-hover-box-content-wrap" ' . gdlr_core_esc_style(array(
					'padding' => (empty($settings['hover-box-padding']) || $settings['hover-box-padding'] == array( 
							'top'=>'45px', 'right'=>'30px', 'bottom'=>'25px', 'left'=>'30px', 'settings'=>'unlink' 
						))? '': $settings['hover-box-padding']
				)) . ' >';
				if( $settings['image-position'] == 'inside' && !empty($tab['image']) ){
					$ret .= '<div class="gdlr-core-hover-box-thumbnail-inside gdlr-core-media-image" >';
					$ret .= gdlr_core_get_image($tab['image']);
					$ret .= '</div>';
				}
				if( !empty($tab['title']) ){
					$ret .= '<h3 class="gdlr-core-hover-box-title gdlr-core-skin-title" ' . gdlr_core_esc_style(array(
						'font-size' => empty($settings['hover-box-title-size'])? '': $settings['hover-box-title-size'],
						'font-weight' => empty($settings['hover-box-title-font-weight'])? '': $settings['hover-box-title-font-weight'],
						'text-transform' => empty($settings['hover-box-title-text-transform'])? '': $settings['hover-box-title-text-transform'],
						'letter-spacing' => empty($settings['hover-box-title-letter-spacing'])? '': $settings['hover-box-title-letter-spacing'],
						'color' => (empty($settings['hover-box-title-color']))? '': $settings['hover-box-title-color'],
					)) . ' >' . gdlr_core_text_filter($tab['title']) . '</h3>';
				}

				if( !empty($tab['content']) ){
					$ret .= '<div class="gdlr-core-hover-box-content gdlr-core-skin-content" ' . gdlr_core_esc_style(array(
						'font-size' => empty($settings['content-size']) ? '': $settings['content-size'],
						'color' => empty($settings['hover-box-content-color'])? '': $settings['hover-box-content-color'],
					)) . ' >' . gdlr_core_content_filter($tab['content']) . '</div>';
				}
				$ret .= '</div>'; // gdlr-core-hover-box-content

				if( !empty($tab['link']) ){
					$ret .= '<a class="gdlr-core-hover-box-link" href="' . esc_url($tab['link']) . '" ></a>';
				}
				$ret .= '</div>'; // gdlr-core-hover-box

				return $ret;
			}			
			
		} // gdlr_core_pb_element_hover_box
	} // class_exists	