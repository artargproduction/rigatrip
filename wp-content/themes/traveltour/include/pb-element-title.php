<?php
	/*	
	*	Goodlayers Item For Page Builder
	*/
	
	if( class_exists('gdlr_core_page_builder_element') ){
		gdlr_core_page_builder_element::add_element('title', 'traveltour_pb_element_title'); 
	}
	
	
	if( !class_exists('traveltour_pb_element_title') ){
		class traveltour_pb_element_title{
			
			// get the element settings
			static function get_settings(){
				return array(
					'icon' => 'fa-text-width',
					'title' => esc_html__('Title', 'traveltour')
				);
			}
			
			// return the element options
			static function get_options(){
				global $gdlr_core_item_pdb;
				
				return apply_filters('gdlr_core_title_item_options', array(
					'general' => array(
						'title' => esc_html__('General', 'traveltour'),
						'options' => array(
							'title' => array(
								'title' => esc_html__('Title', 'traveltour'),
								'type' => 'text',
								'default' => esc_html__('Default Sample Title', 'traveltour'),
							),	
							'caption' => array(
								'title' => esc_html__('Caption', 'traveltour'),
								'type' => 'text',
								'default' => esc_html__('Default sample caption text', 'traveltour'),
							),
							'caption-position' => array(
								'title' => esc_html__('Caption Position', 'traveltour'),
								'type' => 'combobox',
								'options' => array(
									'top' => esc_html__('Top', 'traveltour'),
									'bottom' => esc_html__('Bottom', 'traveltour'),
								),
								'default' => 'top'
							),
							'title-link-text' => array(
								'title' => esc_html__('Title Link Text', 'traveltour'),
								'type' => 'text',
								'description' => esc_html__('Leave this field blank to link the title text', 'traveltour')
							),
							'title-link' => array(
								'title' => esc_html__('Title Link', 'traveltour'),
								'type' => 'text'
							),
							'title-link-target' => array(
								'title' => esc_html__('Title Link Target', 'traveltour'),
								'type' => 'combobox',
								'options' => array(
									'_self' => esc_html__('Current Screen', 'traveltour'),
									'_blank' => esc_html__('New Window', 'traveltour'),
								)
							),				
						)
					),
					'style' => array(
						'title' => esc_html__('Style', 'traveltour'),
						'options' => array(
							'text-align' => array(
								'title' => esc_html__('Text Align', 'traveltour'),
								'type' => 'radioimage',
								'options' => 'text-align',
								'default' => 'left'
							),
							'left-media-type' => array(
								'title' => esc_html__('Left Title Media Type', 'traveltour'),
								'type' => 'combobox',
								'options' => array(
									'none' => esc_html__('None', 'traveltour'),
									'icon' => esc_html__('Icon', 'traveltour'),
									'image' => esc_html__('Image', 'traveltour'),
								),
								'default' => 'image',
							),
							'left-icon' => array(
								'title' => esc_html__('Left Title Icon Selector', 'traveltour'),
								'type' => 'icons',
								'default' => 'fa fa-gear',
								'wrapper-class' => 'gdlr-core-fullsize',
								'condition' => array( 'left-media-type' => 'icon' )
							),
							'left-image' => array(
								'title' => esc_html__('Left Title Image', 'traveltour'),
								'type' => 'upload',
								'condition' => array( 'left-media-type' => 'image' ),
							),
							'heading-tag' => array(
								'title' => esc_html__('Heading Tag', 'traveltour'),
								'type' => 'combobox',
								'options' => array(
									'h1' => esc_html__('H1', 'traveltour'),
									'h2' => esc_html__('H2', 'traveltour'),
									'h3' => esc_html__('H3', 'traveltour'),
									'h4' => esc_html__('H4', 'traveltour'),
									'h5' => esc_html__('H5', 'traveltour'),
									'h6' => esc_html__('H6', 'traveltour'),
								),
								'default' => 'h3'
							),
						)
					),
					'typography' => array(
						'title' => esc_html('Typography', 'traveltour'),
						'options' => array(
							'icon-font-size' => array(
								'title' => esc_html__('Left Icon Size ( Only for left align with icon )', 'traveltour'),
								'type' => 'fontslider',
								'default' => '30px'
							),
							'title-font-size' => array(
								'title' => esc_html__('Title Font Size', 'traveltour'),
								'type' => 'fontslider',
								'default' => '41px'
							),
							'title-font-weight' => array(
								'title' => esc_html__('Title Font Weight', 'traveltour'),
								'type' => 'text',
								'default' => 800,
								'description' => esc_html__('Eg. lighter, bold, normal, 300, 400, 600, 700, 800', 'traveltour')
							),
							'title-font-style' => array(
								'title' => esc_html__('Title Font Style', 'traveltour'),
								'type' => 'combobox',
								'options' => array(
									'normal' => esc_html__('Normal', 'traveltour'),
									'italic' => esc_html__('Italic', 'traveltour'),
								),
								'default' => 'normal'
							),
							'title-font-letter-spacing' => array(
								'title' => esc_html__('Title Font Letter Spacing', 'traveltour'),
								'type' => 'text',
								'data-input-type' => 'pixel',
								'default' => '1px'
							),
							'title-font-uppercase' => array(
								'title' => esc_html__('Title Font Uppercase', 'traveltour'),
								'type' => 'checkbox',
								'default' => 'enable'
							),	
							'caption-font-size' => array(
								'title' => esc_html__('Caption Font Size', 'traveltour'),
								'type' => 'fontslider',
								'default' => '16px'
							),
							'caption-font-weight' => array(
								'title' => esc_html__('Caption Font Weight', 'traveltour'),
								'type' => 'text',
								'default' => 400
							),
							'caption-font-style' => array(
								'title' => esc_html__('Caption Font Style', 'traveltour'),
								'type' => 'combobox',
								'options' => array(
									'normal' => esc_html__('Normal', 'traveltour'),
									'italic' => esc_html__('Italic', 'traveltour'),
								),
								'default' => 'italic'
							),
							'caption-font-letter-spacing' => array(
								'title' => esc_html__('Caption Font Letter Spacing', 'traveltour'),
								'type' => 'text',
								'data-input-type' => 'pixel',
								'default' => '0px'
							),
							'caption-font-uppercase' => array(
								'title' => esc_html__('Caption Font Uppercase', 'traveltour'),
								'type' => 'checkbox',
								'default' => 'disable'
							),
						)
					),
					'color' => array(
						'title' => esc_html('Color', 'traveltour'),
						'options' => array(
							'left-icon-color' => array(
								'title' => esc_html__('Left Icon Color', 'traveltour'),
								'type' => 'colorpicker',
							),	
							'title-color' => array(
								'title' => esc_html__('Title Color', 'traveltour'),
								'type' => 'colorpicker',
							),	
							'title-link-hover-color' => array(
								'title' => esc_html__('Title Link Hover Color', 'traveltour'),
								'type' => 'colorpicker',
							),	
							'caption-color' => array(
								'title' => esc_html__('Caption Color', 'traveltour'),
								'type' => 'colorpicker',
							),
						)
					),
					'spacing' => array(
						'title' => esc_html('Spacing', 'traveltour'),
						'options' => array(
							
							'caption-spaces' => array(
								'title' => esc_html__('Space Between Caption ( And Title )', 'traveltour'),
								'type' => 'text',
								'data-input-type' => 'pixel',
								'default' => '10px'
							),
							'media-margin-right' => array(
								'title' => esc_html__('Left Title Media Right Margin', 'traveltour'),
								'type' => 'text',
								'data-input-type' => 'pixel',
								'default' => '15px',
							),
							'padding-bottom' => array(
								'title' => esc_html__('Padding Bottom ( Item )', 'traveltour'),
								'type' => 'text',
								'data-input-type' => 'pixel',
								'default' => $gdlr_core_item_pdb
							)
						)
					)
				));
			}
			
			// get the preview for page builder
			static function get_preview( $settings = array() ){
				$content  = self::get_content($settings, true);
				$id = mt_rand(0, 9999);
				
				ob_start();
?><script type="text/javascript" id="gdlr-core-preview-title-<?php echo esc_attr($id); ?>" >
jQuery(document).ready(function(){
	jQuery('#gdlr-core-preview-title-<?php echo esc_attr($id); ?>').parent().gdlr_core_title_divider();
});
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
						'title' => esc_html__('Default Sample Title', 'traveltour'),
						'caption' => esc_html__('Default sample caption text', 'traveltour'),
						'title-link' => '',
						'text-align' => 'left',
						'padding-bottom' => $gdlr_core_item_pdb
					);
				}

				$extra_style = '';
				if( !empty($settings['title-link']) && (!empty($settings['title-color']) || !empty($settings['title-link-hover-color'])) ){
					if( empty($settings['id']) ){
						global $gdlr_core_title_id; 
						$gdlr_core_title_id = empty($gdlr_core_title_id)? array(): $gdlr_core_title_id;
						
						// generate unique id so it does not get overwritten in admin area
						$rnd_title_id = mt_rand(0, 99999);
						while( in_array($rnd_title_id, $gdlr_core_title_id) ){
							$rnd_title_id = mt_rand(0, 99999);
						}
						$gdlr_core_title_id[] = $rnd_title_id;
						$settings['id'] = 'gdlr-core-title-item-id-' . $rnd_title_id;
					}
						
					
					if( !empty($settings['title-color']) ){
						$extra_style .= '#' . $settings['id'] . ' .gdlr-core-title-item-title a{ color:' . $settings['title-color'] . '; }';
					}
					if( !empty($settings['title-link-hover-color']) ){
						$extra_style .= '#' . $settings['id'] . ' .gdlr-core-title-item-title a:hover{ color:' . $settings['title-link-hover-color'] . '; }';
					}
					if( $preview ){
						$style_type = 'text/css';
						$extra_style = '<style type="' . esc_attr($style_type) . '" scoped >' . $extra_style . '</style>';
					}else{
						gdlr_core_add_inline_style($extra_style);
						$extra_style = '';
					}
				}				
				
				// default value
				$settings['text-align'] = empty($settings['text-align'])? 'left': $settings['text-align'];
				$settings['caption-position'] = empty($settings['caption-position'])? 'top': $settings['caption-position'];
				$settings['heading-tag'] = ($preview || empty($settings['heading-tag']))? 'h3': $settings['heading-tag'];

				$title_atts = array(
					'font-size' => (empty($settings['title-font-size']) || $settings['title-font-size'] == '41px')? '': $settings['title-font-size'],
					'font-weight' => (empty($settings['title-font-weight']) || $settings['title-font-weight'] == '800')? '': $settings['title-font-weight'],
					'font-style' => (empty($settings['title-font-style']) || $settings['title-font-style'] == 'normal')? '': $settings['title-font-style'],
					'letter-spacing' => (empty($settings['title-font-letter-spacing']) || $settings['title-font-letter-spacing'] == '1px')? '': $settings['title-font-letter-spacing'],
					'text-transform' => (empty($settings['title-font-uppercase']) || $settings['title-font-uppercase'] == 'enable')? '': 'none',
					'color' => empty($settings['title-color'])? '': $settings['title-color']
				);
				$caption_atts = array(
					'font-size' => (empty($settings['caption-font-size']) || $settings['caption-font-size'] == '16px')? '': $settings['caption-font-size'],
					'font-weight' => (empty($settings['caption-font-weight']) || $settings['caption-font-weight'] == '400')? '': $settings['caption-font-weight'],
					'font-style' => (empty($settings['caption-font-style']) || $settings['caption-font-style'] == 'italic')? '': $settings['caption-font-style'],
					'letter-spacing' => (empty($settings['caption-font-letter-spacing']) || $settings['caption-font-letter-spacing'] == '0px')? '': $settings['caption-font-letter-spacing'],
					'text-transform' => (empty($settings['caption-font-uppercase']) || $settings['caption-font-uppercase'] == 'disable')? '': 'uppercase',
					'color' => empty($settings['caption-color'])? '': $settings['caption-color']
				);

				// start printing item
				$extra_class  = ' gdlr-core-' . $settings['text-align'] . '-align';
				$extra_class .= ' gdlr-core-title-item-caption-' . $settings['caption-position'];
				$extra_class .= empty($settings['no-pdlr'])? ' gdlr-core-item-pdlr': '';
				$extra_class .= empty($settings['class'])? '': ' ' . $settings['class'];
				$extra_class .= apply_filters('gdlr_core_pb_element_title_class', '', $settings);
				
				$ret  = '<div class="gdlr-core-title-item gdlr-core-item-pdb clearfix ' . esc_attr($extra_class) . '" ';
				if( !empty($settings['padding-bottom']) && $settings['padding-bottom'] != $gdlr_core_item_pdb ){
					$ret .= gdlr_core_esc_style(array('padding-bottom'=>$settings['padding-bottom']));
				}
				if( !empty($settings['id']) ){
					$ret .= ' id="' . esc_attr($settings['id']) . '" ';
				}
				$ret .= ' >';

				if( $settings['caption-position'] == 'top' && !empty($settings['caption']) ){
					$caption_atts['margin-bottom'] = (empty($settings['caption-spaces']) || $settings['caption-spaces'] == '10px')? '': $settings['caption-spaces'];
					$ret .= '<span class="gdlr-core-title-item-caption gdlr-core-info-font gdlr-core-skin-caption" ' . gdlr_core_esc_style($caption_atts) . ' >' . gdlr_core_text_filter($settings['caption']) . '</span>';
				}
				if( !empty($settings['title']) ){
					
					$ret .= '<div class="gdlr-core-title-item-title-wrap" >';
					$ret .= '<' . $settings['heading-tag'] . ' class="gdlr-core-title-item-title gdlr-core-skin-title" ' . gdlr_core_esc_style($title_atts) . ' >';
					if( empty($settings['title-link-text']) && !empty($settings['title-link']) ){
						$ret .= '<a href="'. esc_url($settings['title-link']) . '" target="' . (empty($settings['title-link-target'])? '_self': $settings['title-link-target']) . '" >';
					}
					$media_css_atts = array('margin-right' => (empty($settings['media-margin-right']) || $settings['media-margin-right'] == '15px')? '': $settings['media-margin-right'] );
					if( empty($settings['left-media-type']) || $settings['left-media-type'] == 'image' ){
						if( !empty($settings['left-image']) ){
							$ret .= '<span class="gdlr-core-title-item-left-image gdlr-core-media-image" ' . gdlr_core_esc_style($media_css_atts) . ' >' . gdlr_core_get_image($settings['left-image']) . '</span>';
						}
					}else if( $settings['left-media-type'] == 'icon' ){
						$media_css_atts['font-size'] = (empty($settings['icon-font-size']) || $settings['icon-font-size'] == '30px')? '': $settings['icon-font-size'];
						$ret .= '<span class="gdlr-core-title-item-left-icon" ' . gdlr_core_esc_style($media_css_atts) . ' >';
						$ret .= '<i class="' . esc_attr($settings['left-icon']) . '" ' . gdlr_core_esc_style(array(
							'color' => empty($settings['left-icon-color'])? '': $settings['left-icon-color']
						)) . ' ></i>';
						$ret .= '</span>';
					}
					
					$ret .= gdlr_core_text_filter($settings['title']);
					if( empty($settings['title-link-text']) && !empty($settings['title-link']) ){
						$ret .= '</a>';
					}
					$ret .= '<span class="gdlr-core-title-item-title-divider gdlr-core-skin-divider" ></span>';
					$ret .= '</' . $settings['heading-tag'] . '>';

					if( !empty($settings['title-link-text']) && !empty($settings['title-link']) ){
						$ret .= '<a href="'. esc_url($settings['title-link']) . '" target="' . (empty($settings['title-link-target'])? '_self': $settings['title-link-target']) . '" class="gdlr-core-title-item-link">';
						$ret .= '<span class="gdlr-core-separator" >/</span>';
						$ret .= gdlr_core_text_filter($settings['title-link-text']);
						$ret .= '</a>';
					}
					$ret .= '</div>';
					
				}
				if( $settings['caption-position'] == 'bottom' && !empty($settings['caption']) ){
					$caption_atts['margin-top'] = (empty($settings['caption-spaces']) || $settings['caption-spaces'] == '10px')? '': $settings['caption-spaces'];
					$ret .= '<span class="gdlr-core-title-item-caption gdlr-core-info-font gdlr-core-skin-caption" ' . gdlr_core_esc_style($caption_atts) . ' >';
					$ret .= gdlr_core_text_filter($settings['caption']);
					$ret .= '</span>';
				}

				$ret .= '</div>' . $extra_style;

				return $ret;
			}
			
		} // traveltour_pb_element_title
	} // class_exists	
