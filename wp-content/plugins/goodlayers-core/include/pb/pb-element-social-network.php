<?php
	/*	
	*	Goodlayers Item For Page Builder
	*/
	
	gdlr_core_page_builder_element::add_element('social-network', 'gdlr_core_pb_element_social_network'); 
	
	if( !class_exists('gdlr_core_pb_element_social_network') ){
		class gdlr_core_pb_element_social_network{
			
			// get the element settings
			static function get_settings(){
				return array(
					'icon' => 'social_facebook',
					'title' => esc_html__('Social Network', 'goodlayers-core')
				);
			}
			
			// return the element options
			static function get_options(){
				global $gdlr_core_item_pdb;
				
				return array(
					'general' => array(
						'title' => esc_html__('General', 'goodlayers-core'),
						'options' => array(
							
							'delicious' => array(
								'title' => esc_html__('Social Delicious Link', 'goodlayers-core'),
								'type' => 'text'
							),
							'email' => array(
								'title' => esc_html__('Social Email Link', 'goodlayers-core'),
								'type' => 'text',
								'default' => '#'
							),
							'deviantart' => array(
								'title' => esc_html__('Social Deviantart Link', 'goodlayers-core'),
								'type' => 'text'
							),
							'digg' => array(
								'title' => esc_html__('Social Digg Link', 'goodlayers-core'),
								'type' => 'text'
							),
							'facebook' => array(
								'title' => esc_html__('Social Facebook Link', 'goodlayers-core'),
								'type' => 'text',
								'default' => '#'
							),
							'flickr' => array(
								'title' => esc_html__('Social Flickr Link', 'goodlayers-core'),
								'type' => 'text'
							),
							'google-plus' => array(
								'title' => esc_html__('Social Google Plus Link', 'goodlayers-core'),
								'type' => 'text',
								'default' => '#'
							),
							'lastfm' => array(
								'title' => esc_html__('Social Lastfm Link', 'goodlayers-core'),
								'type' => 'text'
							),
							'linkedin' => array(
								'title' => esc_html__('Social Linkedin Link', 'goodlayers-core'),
								'type' => 'text'
							),
							'pinterest' => array(
								'title' => esc_html__('Social Pinterest Link', 'goodlayers-core'),
								'type' => 'text'
							),
							'rss' => array(
								'title' => esc_html__('Social RSS Link', 'goodlayers-core'),
								'type' => 'text'
							),
							'skype' => array(
								'title' => esc_html__('Social Skype Link', 'goodlayers-core'),
								'type' => 'text',
								'default' => '#'
							),
							'stumbleupon' => array(
								'title' => esc_html__('Social Stumbleupon Link', 'goodlayers-core'),
								'type' => 'text'
							),
							'tumblr' => array(
								'title' => esc_html__('Social Tumblr Link', 'goodlayers-core'),
								'type' => 'text'
							),
							'twitter' => array(
								'title' => esc_html__('Social Twitter Link', 'goodlayers-core'),
								'type' => 'text',
								'default' => '#'
							),
							'vimeo' => array(
								'title' => esc_html__('Social Vimeo Link', 'goodlayers-core'),
								'type' => 'text'
							),
							'youtube' => array(
								'title' => esc_html__('Social Youtube Link', 'goodlayers-core'),
								'type' => 'text'
							),
							'dribbble' => array(
								'title' => esc_html__('Social Dribbble Link', 'goodlayers-core'),
								'type' => 'text'
							),
							'behance' => array(
								'title' => esc_html__('Social Behance Link', 'goodlayers-core'),
								'type' => 'text'
							),
							'instagram' => array(
								'title' => esc_html__('Social Instagram Link', 'goodlayers-core'),
								'type' => 'text'
							),
							'snapchat' => array(
								'title' => esc_html__('Social Snapchat Link', 'goodlayers-core'),
								'type' => 'text'
							),

						)
					),
					'style' => array(
						'title' => esc_html__('Style & Size', 'goodlayers-core'),
						'options' => array(

							'text-align' => array(
								'title' => esc_html__('Text Align', 'goodlayers-core'),
								'type' => 'radioimage',
								'options' => 'text-align',
								'default' => 'left'
							),	
							'icon-size' => array(
								'title' => esc_html__('Icon Size', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel'
							),	
							'with-text' => array(
								'title' => esc_html__('With Text', 'goodlayers-core'),
								'type' => 'checkbox',
								'default' => 'disable'
							),		
							'text-size' => array(
								'title' => esc_html__('Text Size', 'goodlayers-core'),
								'type' => 'fontslider',
								'default' => '15px',
								'condition' => array( 'with-text' => 'enable' )
							)

						)
					),
					'color' => array(
						'title' => esc_html__('Color', 'goodlayers-core'),
						'options' => array(
							'icon-color' => array(
								'title' => esc_html__('Icon Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							)
						)
					),
					'spacing' => array(
						'title' => esc_html__('Spacing', 'goodlayers-core'),
						'options' => array(
							'icon-space' => array(
								'title' => esc_html__('Space Between Icon', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
								'default' => '20px'
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
				return $content;
			}			
			
			// get the content from settings
			static function get_content( $settings = array(), $preview = false ){
				global $gdlr_core_item_pdb;
				
				// default variable
				if( empty($settings) ){
					$settings = array(
						'text-align' => 'left', 'social-head' => 'counter',
						'email' => '#', 'facebook' => '#', 'google-plus' => '#', 'skype' => '#', 'twitter' => '#', 
						'padding-bottom' => $gdlr_core_item_pdb
					);
				}

				// start printing item
				$extra_class  = ' gdlr-core-' . (empty($settings['text-align'])? 'left': $settings['text-align']) . '-align';
				$extra_class .= empty($settings['no-pdlr'])? ' gdlr-core-item-pdlr': '';
				$extra_class .= empty($settings['class'])? '': ' ' . $settings['class'];
				
				$ret  = '<div class="gdlr-core-social-network-item gdlr-core-item-pdb ' . esc_attr($extra_class) . '" ';
				if( !empty($settings['padding-bottom']) && $settings['padding-bottom'] != $gdlr_core_item_pdb ){
					$ret .= gdlr_core_esc_style(array('padding-bottom'=>$settings['padding-bottom']));
				}
				if( !empty($settings['id']) ){
					$ret .= ' id="' . esc_attr($settings['id']) . '" ';
				}
				$ret .= ' >';

				$social_list = array(
					'delicious' => array('title'=> 'Delicious', 'icon'=>'fa fa-delicious'), 
					'email' => array('title'=> 'Email', 'icon'=>'fa fa-envelope'),
					'deviantart' => array('title'=> 'Deviantart', 'icon'=>'fa fa-deviantart'),
					'digg' => array('title'=> 'Digg', 'icon'=>'fa fa-digg'),
					'facebook' => array('title'=> 'Facebook', 'icon'=>'fa fa-facebook'),
					'flickr' => array('title'=> 'Flickr', 'icon'=>'fa fa-flickr'),
					'google-plus' => array('title'=> 'Google Plus', 'icon'=>'fa fa-google-plus'),
					'lastfm' => array('title'=> 'Lastfm', 'icon'=>'fa fa-lastfm'),
					'linkedin' => array('title'=> 'Linkedin', 'icon'=>'fa fa-linkedin'),
					'pinterest' => array('title'=> 'Pinterest', 'icon'=>'fa fa-pinterest-p'),
					'rss' => array('title'=> 'Rss', 'icon'=>'fa fa-rss'), 
					'skype' => array('title'=> 'Skype', 'icon'=>'fa fa-skype'),
					'stumbleupon' => array('title'=> 'Stumbleupon', 'icon'=>'fa fa-stumbleupon'),
					'tumblr' => array('title'=> 'Tumblr', 'icon'=>'fa fa-tumblr'),
					'twitter' => array('title'=> 'Twitter', 'icon'=>'fa fa-twitter'),
					'vimeo' => array('title'=> 'Vimeo', 'icon'=>'fa fa-vimeo'),
					'youtube' => array('title'=> 'Youtube', 'icon'=>'fa fa-youtube'),
					'dribbble' => array('title'=> 'Dribbble', 'icon'=>'fa fa-dribbble'),
					'behance' => array('title'=> 'Behance', 'icon'=>'fa fa-behance'),
					'instagram' => array('title'=> 'Instagram', 'icon'=>'fa fa-instagram'),
					'snapchat' => array('title'=> 'Snapchat', 'icon'=>'fa fa-snapchat-ghost'),
				);

				$icon_space_count = 0;
				$settings['icon-space'] = (empty($settings['icon-space']) || $settings['icon-space'] == '20px')? '': $settings['icon-space'];

				foreach( $social_list as $social_key => $social_option ){
					$social_title = $social_option['title'];
					$social_icon = $social_option['icon'];

					if( !empty($settings[$social_key]) ){
						$social_link = $settings[$social_key];

						if( $social_key == 'email' && !empty($social_link) ){
							$social_link = 'mailto:' . $social_link;
						}

						$ret .= '<a href="' . esc_url($social_link) . '" ';
						$ret .= 'target="' . (empty($settings['link-target'])? '_blank': $settings['link-target']) . '" ';
						$ret .= 'class="gdlr-core-social-network-icon" title="' . esc_attr($social_key) . '" ' . gdlr_core_esc_style(array(
							'font-size' => empty($settings['icon-size'])? '': $settings['icon-size'],
							'color' => empty($settings['icon-color'])? '': $settings['icon-color'],
							'margin-left' => ($icon_space_count > 0)? $settings['icon-space']: ''
						)) . ' >';
						$ret .= '<i class="' . esc_attr($social_icon) . '" ></i>';
						if( !empty($settings['with-text']) && $settings['with-text'] == 'enable' ){
							$ret .= '<span class="gdlr-core-social-network-item-text" ' . gdlr_core_esc_style(array(
								'font-size' => (empty($settings['text-size']) || $settings['text-size'] == '15px')? '': $settings['text-size']
							)) . ' >' . $social_title . '</span>';
						}
						$ret .= '</a>';

						$icon_space_count++;
					}
				}

				$ret .= '</div>';
				
				return $ret;
			}
			
		} // gdlr_core_pb_element_social_share
	} // class_exists	

	add_shortcode('gdlr_core_social_network', 'gdlr_core_social_network_shortcode');
	if( !function_exists('gdlr_core_social_network_shortcode') ){
		function gdlr_core_social_network_shortcode($atts){
			$atts = wp_parse_args($atts, array(
				'no-pdlr' => true,
				'padding-bottom' => '0px',
				'text-align' => 'none',
				'icon-size' => ''
			));

			return gdlr_core_pb_element_social_network::get_content($atts);
		}
	}
