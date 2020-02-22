<?php
	/*	
	*	Goodlayers Item For Page Builder
	*/
	
	gdlr_core_page_builder_element::add_element('skill-bar', 'gdlr_core_pb_element_skill_bar_item'); 
	
	if( !class_exists('gdlr_core_pb_element_skill_bar_item') ){
		class gdlr_core_pb_element_skill_bar_item{
			
			// get the element settings
			static function get_settings(){
				return array(
					'icon' => 'fa-tasks',
					'title' => esc_html__('Skill Bar', 'goodlayers-core')
				);
			}
			
			// return the element options
			static function get_options(){
				global $gdlr_core_item_pdb;
				
				return array(
					'general' => array(
						'title' => esc_html__('General', 'goodlayers-core'),
						'options' => array(
							'bar-size' => array(
								'title' => esc_html__('Skill Bar Style', 'goodlayers-core'),
								'type' => 'radioimage',
								'options' => array(
									'small' => GDLR_CORE_URL . '/include/images/skill-bar/small.png',
									'medium' => GDLR_CORE_URL . '/include/images/skill-bar/medium.png',
									'large' => GDLR_CORE_URL . '/include/images/skill-bar/large.png',
								),
								'default' => 'small',
								'wrapper-class' => 'gdlr-core-fullsize'
							),
							'bar-type' => array(
								'title' => esc_html__('Skill Bar Type', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'rectangle' => esc_html__('Rectangle', 'goodlayers-core'),
									'rectangle2' => esc_html__('Rectangle 2 (For small and medium style)', 'goodlayers-core'),
									'round' => esc_html__('Round Corner', 'goodlayers-core'),
								),
								'default' => 'rectangle'
							), 
							'tabs' => array(
								'title' => esc_html__('Skill Item', 'goodlayers-core'),
								'type' => 'custom',
								'item-type' => 'tabs',
								'wrapper-class' => 'gdlr-core-fullsize',
								'options' => array(
									'heading-text' => array(
										'title' => esc_html__('Heading Text', 'goodlayers-core'),
										'type' => 'text',
									), 
									'icon' => array(
										'title' => esc_html__('Icon', 'goodlayers-core'),
										'type' => 'text',
									), 
									'percent' => array(
										'title' => esc_html__('Percent', 'goodlayers-core'),
										'type' => 'text',
										'data-input-type' => 'number',
										'description' => esc_html__('Only fill the number here', 'goodlayers-core'),
									), 
									'bar-text' => array(
										'title' => esc_html__('Bar Text', 'goodlayers-core'),
										'type' => 'text',
									), 
								),
								'default' => array(
									array(
										'heading-text' => esc_html__('Skill Heading Text', 'goodlayers-core'),
										'icon' => 'fa fa-gear',
										'percent' => 80,
										'bar-text' => esc_html__('Sameple Text', 'goodlayers-core'),
									),
									array(
										'heading-text' => esc_html__('Skill Heading Text', 'goodlayers-core'),
										'icon' => 'fa fa-gear',
										'percent' => 80,
										'bar-text' => '',
									),
								)
							),
						),
					),
					'color' => array(
						'title' => esc_html__('Color', 'goodlayers-core'),
						'options' => array(
							'heading-text-color' => array(
								'title' => esc_html__('Heading Text Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'icon-color' => array(
								'title' => esc_html__('Icon Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							), 
							'percent-color' => array(
								'title' => esc_html__('Percent Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'bar-filled-color' => array(
								'title' => esc_html__('Bar Filled Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'bar-background-color' => array(
								'title' => esc_html__('Bar Background Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
						),
					),
					'spacing' => array(
						'title' => esc_html__('Spacing', 'goodlayers-core'),
						'options' => array(
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
				$content  = self::get_content($settings);
				$id = mt_rand(0, 9999);
				
				ob_start();
?><script id="gdlr-core-preview-skill-bar-<?php echo esc_attr($id); ?>" >
jQuery(document).ready(function(){
	jQuery('#gdlr-core-preview-skill-bar-<?php echo esc_attr($id); ?>').parent().gdlr_core_skill_bar();
});
</script><?php	
				$content .= ob_get_contents();
				ob_end_clean();				
				return $content;
			}		
			
			// get the content from settings
			static function get_content( $settings = array() ){
				global $gdlr_core_item_pdb;
				
				// default variable
				if( empty($settings) ){
					$settings = array(
						'bar-size' => 'small', 'bar-type' => 'rectangle',
						'tabs' => array(
							array(
								'heading-text' => esc_html__('Skill Heading Text', 'goodlayers-core'),
								'icon' => 'fa fa-gear',
								'percent' => 80,
								'bar-text' => esc_html__('Sameple Text', 'goodlayers-core'),
							),
							array(
								'heading-text' => esc_html__('Skill Heading Text', 'goodlayers-core'),
								'icon' => 'fa fa-gear',
								'percent' => 80,
								'bar-text' => '',
							),
						),

						'padding-bottom' => $gdlr_core_item_pdb
					);
				}

				// default size
				$settings['bar-type'] = empty($settings['bar-type'])? 'rectangle': $settings['bar-type'];
				$settings['top-icon-size'] = (empty($settings['top-icon-size']) || $settings['top-icon-size'] == '30px')? '': $settings['top-icon-size'];
				$settings['top-text-size'] = (empty($settings['top-text-size']) || $settings['top-text-size'] == '16px')? '': $settings['top-text-size'];
				$settings['number-size'] = (empty($settings['number-size']) || $settings['number-size'] == '59px')? '': $settings['number-size'];
				$settings['bottom-text-size'] = (empty($settings['bottom-text-size']) || $settings['bottom-text-size'] == '16px')? '': $settings['bottom-text-size'];

				// start printing item
				$extra_class  = ' gdlr-core-size-' . $settings['bar-size'];
				$extra_class .= ' gdlr-core-type-' . $settings['bar-type'];
				$extra_class .= empty($settings['class'])? '': ' ' . $settings['class'];
				$ret  = '<div class="gdlr-core-skill-bar-item gdlr-core-item-pdlr gdlr-core-item-pdb ' . esc_attr($extra_class) . '" ';
				if( !empty($settings['padding-bottom']) && $settings['padding-bottom'] != $gdlr_core_item_pdb ){
					$ret .= gdlr_core_esc_style(array('padding-bottom'=>$settings['padding-bottom']));
				}
				if( !empty($settings['id']) ){
					$ret .= ' id="' . esc_attr($settings['id']) . '" ';
				}
				$ret .= ' >';
				
				foreach( $settings['tabs'] as $tab ){
					$ret .= '<div class="gdlr-core-skill-bar" >';
					$ret .= '<div class="gdlr-core-skill-bar-head gdlr-core-title-font" ';
					if( !empty($settings['bar-size']) && $settings['bar-size'] == 'large' && !empty($tab['percent']) ){
						$ret .= gdlr_core_esc_style(array('width'=>$tab['percent'] . '%'));
					}
					$ret .= '>';
					if( !empty($tab['heading-text']) ){
						$ret .= '<span class="gdlr-core-skill-bar-title" ' . gdlr_core_esc_style(array(
							'color' => empty($settings['heading-text-color'])? '': $settings['heading-text-color']
						)) . ' >' . gdlr_core_text_filter($tab['heading-text']) . '</span>';
					}
					if( !empty($tab['icon']) ){
						$ret .= '<i class="gdlr-core-skill-bar-icon ' . esc_attr($tab['icon']) . '" ' . gdlr_core_esc_style(array(
							'color' => empty($settings['icon-color'])? '': $settings['icon-color']
						)) . ' ></i>';
					}
					if( $settings['bar-type'] != 'rectangle2' || $settings['bar-size'] == 'large' ){
						$ret .= '<span class="gdlr-core-skill-bar-right" ' . gdlr_core_esc_style(array(
							'color' => empty($settings['percent-color'])? '': $settings['percent-color']
						)) . ' >' . (empty($tab['bar-text'])? $tab['percent'] . '%': gdlr_core_text_filter($tab['bar-text'])) . '</span>';
					}
					$ret .= '</div>'; // gdlr-core-skill-bar-head
					
					$ret .= '<div class="gdlr-core-skill-bar-progress" ' . gdlr_core_esc_style(array(
						'background-color' => empty($settings['bar-background-color'])? '': $settings['bar-background-color']
					)) . ' >';
					$ret .= '<div class="gdlr-core-skill-bar-filled gdlr-core-js" data-width="' . esc_attr($tab['percent']) . '" ' . gdlr_core_esc_style(array(
						'background-color' => empty($settings['bar-filled-color'])? '': $settings['bar-filled-color']
					)) . ' >';
					if( $settings['bar-type'] == 'rectangle2' && $settings['bar-size'] != 'large' ){
						$ret .= '<div class="gdlr-core-skill-bar-filled-indicator" ' . gdlr_core_esc_style(array(
							'background-color' => empty($settings['bar-filled-color'])? '': $settings['bar-filled-color']
						)) . ' ></div>';
						$ret .= '<span class="gdlr-core-skill-bar-right" ' . gdlr_core_esc_style(array(
							'color' => empty($settings['percent-color'])? '': $settings['percent-color']
						)) . ' >' . (empty($tab['bar-text'])? $tab['percent'] . '%': gdlr_core_text_filter($tab['bar-text'])) . '</span>';
					}
					$ret .= '</div>';
					$ret .= '</div>';
					$ret .= '</div>'; // gdlr-core-skill-bar
				}
				
				$ret .= '</div>'; // gdlr-core-skill-bar-item
				
				return $ret;
			}			
			
		} // gdlr_core_pb_element_skill_bar_item
	} // class_exists	