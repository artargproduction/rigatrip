<?php
	/*	
	*	Goodlayers Item For Page Builder
	*/
	
	gdlr_core_page_builder_element::add_element('newsletter', 'gdlr_core_pb_element_newsletter'); 
	
	if( !class_exists('gdlr_core_pb_element_newsletter') ){
		class gdlr_core_pb_element_newsletter{
			
			// get the element settings
			static function get_settings(){
				return array(
					'icon' => 'icon_documents',
					'title' => esc_html__('Newsletter', 'goodlayers-core')
				);
			}
			
			// return the element options
			static function get_options(){
				global $gdlr_core_item_pdb;
				
				return array(
					'general' => array(
						'title' => esc_html__('General', 'goodlayers-core'),
						'options' => array(
							'style' => array(
								'title' => esc_html__('Style', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'rectangle' => esc_html__('Rectangle', 'goodlayers-core'),
									'rectangle-full' => esc_html__('Rectangle Full', 'goodlayers-core'),
									'round' => esc_html__('Round', 'goodlayers-core'),
									'round2' => esc_html__('Round2', 'goodlayers-core'),
									'curve' => esc_html__('Curve', 'goodlayers-core'),
									'curve2' => esc_html__('Curve2', 'goodlayers-core'),
									'transparent-bottom-border' => esc_html__('Transparent Bottom Border', 'goodlayers-core'),
								)
							),
							'shadow-size' => array(
								'title' => esc_html__('Shadow Size', 'goodlayers-core'),
								'type' => 'custom',
								'item-type' => 'padding',
								'options' => array('x', 'y', 'size'),
								'data-input-type' => 'pixel',
								'condition' => array( 'style' => array('rectangle', 'round2', 'curve') )
							),
							'shadow-color' => array(
								'title' => esc_html__('Shadow Color', 'goodlayers-core'),
								'type' => 'colorpicker',
								'condition' => array( 'style' => array('rectangle', 'round2', 'curve') )
							),
							'shadow-opacity' => array(
								'title' => esc_html__('Shadow Opacity', 'goodlayers-core'),
								'type' => 'text',
								'default' => '0.2',
								'description' => esc_html__('Fill the number between 0.01 to 1', 'goodlayers-core'),
								'condition' => array( 'style' => array('rectangle', 'round2', 'curve') )
							),
						)
					),
					'spacing' => array(
						'title' => esc_html__('Spacing', 'goodlayers-core'),
						'options' => array(
							'padding-bottom' => array(
								'title' => esc_html__('Padding Bottom', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
								'default' => $gdlr_core_item_pdb
							),					
						)
					),
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
						'padding-bottom' => $gdlr_core_item_pdb,
					);
				}
				
				if( !is_admin() ){
					$custom_css = gdlr_core_esc_style(array(
						'background-shadow-size' => empty($settings['shadow-size'])? '': $settings['shadow-size'],
						'background-shadow-color' => empty($settings['shadow-color'])? '': $settings['shadow-color'],
						'background-shadow-opacity' => empty($settings['shadow-opacity'])? '': $settings['shadow-opacity']
					), false);
					if( !empty($custom_css) ){
						if( empty($settings['id']) ){
							global $gdlr_core_newsletter_id; 
							$gdlr_core_newsletter_id = empty($gdlr_core_newsletter_id)? 1: $gdlr_core_newsletter_id + 1;
							$settings['id'] = 'gdlr-core-newsletter-' . $gdlr_core_newsletter_id;
						}

						$custom_css = '#' . $settings['id'] . '.gdlr-core-style-rectangle form, ' .
									  '#' . $settings['id'] . '.gdlr-core-style-round2 form, ' .
									  '#' . $settings['id'] . '.gdlr-core-style-curve form{' . $custom_css . '}';

						gdlr_core_add_inline_style($custom_css);
					}


				}
				

				$settings['style'] = empty($settings['style'])? 'rectangle': $settings['style'];

				// start printing item
				$extra_class  = empty($settings['class'])? '': $settings['class'];
				$extra_class .= ' gdlr-core-style-' . $settings['style'];

				$ret  = '<div class="gdlr-core-newsletter-item gdlr-core-item-pdlr gdlr-core-item-pdb ' . esc_attr($extra_class) . '" ';
				if( !empty($settings['padding-bottom']) && $settings['padding-bottom'] != $gdlr_core_item_pdb ){
					$ret .= gdlr_core_esc_style(array('padding-bottom'=>$settings['padding-bottom']));
				}
				if( !empty($settings['id']) ){
					$ret .= ' id="' . esc_attr($settings['id']) . '" ';
				}
				$ret .= ' >';
				
				// display
				if( !class_exists('NewsletterSubscription') ){
					$message = wp_kses(__('Please install and activate the "<a target="_blank" href="https://wordpress.org/plugins/newsletter/" >Newsletter</a>" plugin to show the form.', 'goodlayers-core'), 
						array( 'a' => array('target'=>array(), 'href'=>array()) ));
				}else if( $preview ){
					$message = '[newsletter_form]';
				}else{
					$ret .= gdlr_core_get_subscription_form($settings);
				}
				if( !empty($message) ){
					$ret .= '<div class="gdlr-core-external-plugin-message">' . gdlr_core_escape_content($message) . '</div>';
				}
				
				$ret .= '</div>';
				
				return $ret;
			}
			
		} // gdlr_core_pb_element_newsletter
	} // class_exists		

	// from newsletter/subscription/subscription.php
	if( !function_exists('gdlr_core_get_subscription_form') ){
		function gdlr_core_get_subscription_form($settings){

			$attrs = array();
	        $action = esc_attr(home_url('/') . '?na=s');
	        $options_profile = get_option('newsletter_profile');

	        $newsletter = NewsletterSubscription::instance();

	        $buffer  = $newsletter->get_form_javascript();

	        $buffer .= '<div class="newsletter newsletter-subscription">';
	        $buffer .= '<form class="gdlr-core-newsletter-form clearfix" method="post" action="' . esc_url($action) . '" onsubmit="return newsletter_check(this)">';
	        $buffer .= '<div class="gdlr-core-newsletter-email">';
	        $buffer .= '<input class="newsletter-email gdlr-core-skin-e-background gdlr-core-skin-e-content" placeholder="' . esc_html__('Your Email Address', 'goodlayers-core') . '" type="email" name="ne" size="30" required />';
	        $buffer .= '</div>'; // gdlr-core-newsletter-email
	        $buffer .= '<div class="gdlr-core-newsletter-submit">';
	       	$buffer .= '<input class="newsletter-submit" type="submit" value="' . esc_html__('Subscribe', 'goodlayers-core') . '" ' . gdlr_core_esc_style(array(
	       		'color' => empty($settings['button-text'])? '': $settings['button-text'],
	       		'background-color' => empty($settings['button-background'])? '': $settings['button-background'],
	       	)) . ' />';
	        $buffer .= '</div>'; // gdlr-core-newsletter-submit
	        $buffer .= '</form>';
	        $buffer .= '</div>'; // newsletter

	        return $buffer;
	    }
    }

    add_shortcode('gdlr_core_newsletter', 'gdlr_core_newsletter_shortcode');
	if( !function_exists('gdlr_core_newsletter_shortcode') ){
		function gdlr_core_newsletter_shortcode($atts){
			$atts = wp_parse_args($atts, array(
				'style' => 'rectangle-full',
				'padding-bottom' => '0px',
				'button-background' => '',
				'button-text' => ''
			));

			$ret  = '<div class="gdlr-core-newsletter-shortcode clearfix gdlr-core-rvpdlr" >';
			$ret .= gdlr_core_pb_element_newsletter::get_content($atts);
			$ret .= '</div>';

			return $ret;
		}
	}