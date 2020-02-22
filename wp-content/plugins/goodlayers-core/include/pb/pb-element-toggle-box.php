<?php
	/*	
	*	Goodlayers Item For Page Builder
	*/
	
	gdlr_core_page_builder_element::add_element('toggle-box', 'gdlr_core_pb_element_toggle_box'); 
	
	if( !class_exists('gdlr_core_pb_element_toggle_box') ){
		class gdlr_core_pb_element_toggle_box{
			
			// get the element settings
			static function get_settings(){
				return array(
					'icon' => 'fa-plus-square-o',
					'title' => esc_html__('Toggle Box', 'goodlayers-core')
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
								'title' => esc_html__('Add Toggle Box Tab', 'goodlayers-core'),
								'type' => 'custom',
								'item-type' => 'tabs',
								'wrapper-class' => 'gdlr-core-fullsize',
								'options' => array(
									'head-text' => array(
										'title' => esc_html__('Head Text', 'goodlayers-core'),
										'type' => 'text'
									),
									'title' => array(
										'title' => esc_html__('Title', 'goodlayers-core'),
										'type' => 'text'
									),
									'content' => array(
										'title' => esc_html__('Content', 'goodlayers-core'),
										'type' => 'textarea'
									),
									'active' => array(
										'title' => esc_html__('Is Active', 'goodlayers-core'),
										'type' => 'checkbox'
									),
								),
								'default' => array(
									array(
										'title' => esc_html__('A Toggle Box Title', 'goodlayers-core'),
										'content' => esc_html__('A toggle box content area', 'goodlayers-core'),
										'active' => 'enable',
									),
									array(
										'title' => esc_html__('A Toggle Box Title', 'goodlayers-core'),
										'content' => esc_html__('A toggle box content area', 'goodlayers-core'),
										'active' => 'disable',
									),
								)
							),
						),
					),
					'style' => array(
						'title' => esc_html__('Style', 'goodlayers-core'),
						'options' => array(
							'style' => array(
								'title' => esc_html__('Toggle Box Style', 'goodlayers-core'),
								'type' => 'radioimage',
								'options' => array(
									'box-icon' => GDLR_CORE_URL . '/include/images/accordion-toggle/box-icon.png',
									'icon' => GDLR_CORE_URL . '/include/images/accordion-toggle/icon.png',
									'background-title' => GDLR_CORE_URL . '/include/images/accordion-toggle/background-title.png',
									'background-title-icon' => GDLR_CORE_URL . '/include/images/accordion-toggle/background-title-icon.png',
								),
								'default' => 'box-icon',
								'wrapper-class' => 'gdlr-core-fullsize'
							),
							'align' => array(
								'title' => esc_html__('Text Align', 'goodlayers-core'),
								'type' => 'radioimage',
								'options' => 'text-align',
								'condition' => array( 'style' => array('background-title', 'background-title-icon') ),
								'default' => 'left'
							)
						)
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
?><script id="gdlr-core-preview-toggle-box-<?php echo esc_attr($id); ?>" >
jQuery(document).ready(function(){
	jQuery('#gdlr-core-preview-toggle-box-<?php echo esc_attr($id); ?>').parent().gdlr_core_toggle_box();
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
						'tabs' => array(
							array(
								'title' => esc_html__('A Toggle Box Title', 'goodlayers-core'),
								'content' => esc_html__('A toggle box content area', 'goodlayers-core'),
								'active' => 'enable',
							),
							array(
								'title' => esc_html__('A Toggle Box Title', 'goodlayers-core'),
								'content' => esc_html__('A toggle box content area', 'goodlayers-core'),
								'active' => 'enable',
							),
						),
						'style' => 'box-icon',
						'align' => 'left',
						'padding-bottom' => $gdlr_core_item_pdb
					);
				}
				
				$settings['style'] = empty($settings['style'])? 'box-icon': $settings['style'];
				
				// start printing item
				$icon_class = ($settings['style'] == 'box-icon')? ' gdlr-core-skin-e-background gdlr-core-skin-border': '';
				$title_class = ($settings['style'] == 'background-title')? ' gdlr-core-skin-e-background gdlr-core-skin-e-content': '';
				$toggle_item_class  = ' gdlr-core-toggle-box-style-' . esc_attr($settings['style']);
				$toggle_item_class .= empty($settings['class'])? '': ' ' . $settings['class'];
				if( in_array($settings['style'], array('background-title', 'background-title-icon')) && !empty($settings['align']) ){
					$toggle_item_class .= ' gdlr-core-' . esc_attr($settings['align']) . '-align';
				}
				
				$ret  = '<div class="gdlr-core-toggle-box-item gdlr-core-item-pdlr gdlr-core-item-pdb ' . esc_attr($toggle_item_class) . '" ';
				if( !empty($settings['padding-bottom']) && $settings['padding-bottom'] != $gdlr_core_item_pdb ){
					$ret .= gdlr_core_esc_style(array('padding-bottom'=>$settings['padding-bottom']));
				}
				if( !empty($settings['id']) ){
					$ret .= ' id="' . esc_attr($settings['id']) . '" ';
				}
				$ret .= ' >';
				if( !empty($settings['tabs']) ){
					foreach( $settings['tabs'] as $tab ){
						$ret .= '<div class="gdlr-core-toggle-box-item-tab clearfix ' . ($tab['active'] == 'enable'? ' gdlr-core-active': '') . '" >';
						$ret .= '<div class="gdlr-core-toggle-box-item-icon gdlr-core-js gdlr-core-skin-icon ' . esc_attr($icon_class) . '"></div>';
						$ret .= '<div class="gdlr-core-toggle-box-item-content-wrapper">';
						$ret .= '<h4 class="gdlr-core-toggle-box-item-title gdlr-core-js ' . esc_attr($title_class) . '">';
						if( !empty($tab['head-text']) ){
							$ret .= '<span class="gdlr-core-head" >' . $tab['head-text'] . '</span>';
						}
						$ret .= gdlr_core_text_filter($tab['title']);
						$ret .= '</h4>';
						$ret .= '<div class="gdlr-core-toggle-box-item-content">' . gdlr_core_content_filter($tab['content']) . '</div>';
						$ret .= '</div>'; // gdlr-core-toggle-box-item-content-wrapper
						$ret .= '</div>'; // gdlr-core-toggle-box-item-tab
					}
				}
				$ret .= '</div>'; // gdlr-core-toggle-box-item
				
				return $ret;
			}			
			
		} // gdlr_core_pb_element_column_service
	} // class_exists	