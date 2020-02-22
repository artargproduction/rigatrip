<?php

	// [gdlr_widget_list]
	// <ul>
 	// <li></li>
	// </ul>
	// [/gdlr_widget_list]
	add_shortcode('gdlr_widget_list', 'gdlr_core_widget_list_shortcode');
	if( !function_exists('gdlr_core_widget_list_shortcode') ){
		function gdlr_core_widget_list_shortcode($atts, $content = ''){			 
			$atts = shortcode_atts(array(
				'title' => '',
				'color' => '',
				'background-color' => '',
				'border-color' => '',
				'title-color' => '',
			), $atts, 'gdlr_widget_list');

			global $gdlr_widget_list_count;
			$gdlr_widget_list_count = empty($gdlr_widget_list_count)? 0: $gdlr_widget_list_count++;

			$ret  = '<div class="gdlr-core-widget-list-shortcode" id="gdlr-core-widget-list-' . esc_attr($gdlr_widget_list_count) . '" ' . gdlr_core_esc_style(array(
				'color' => $atts['color'],
				'background-color' => $atts['background-color']
			)) . ' >';
			if( !empty($atts['title']) ){
				$ret .= '<h3 class="gdlr-core-widget-list-shortcode-title" ' . gdlr_core_esc_style(array(
					'color' => $atts['title-color']
				)) . ' >' . $atts['title'] . '</h3>';
			}
			$ret .= do_shortcode($content);
			$ret .= '</div>';

			if( !empty($atts['border-color']) ){
				$ret .= '<style type="text/stylesheet" >';

				$ret .= '</style>';
			}

			return $ret;
		}
	}

	// [gdlr_widget_box]
	// 
	// [/gdlr_widget_box]
	add_shortcode('gdlr_widget_box', 'gdlr_core_widget_box_shortcode');
	if( !function_exists('gdlr_core_widget_box_shortcode') ){
		function gdlr_core_widget_box_shortcode($atts, $content = ''){
			$atts = shortcode_atts(array(
				'title' => '',
				'title-color' => '',
				'background' => '',
				'color' => '',
				'left-icon' => '',
				'left-icon-color' => '',
				'border-color' => '',
				'border-width' => '',
				'border-radius' => '',
				'padding' => '',
				'link' => '',
				'link-target' => '',
				'text-align' => '',
				'shadow-size' => '',
				'shadow-color' => '',
				'shadow-opacity' => ''
			), $atts, 'gdlr_widget_box');

			$widget_box_atts = array(
				'color' => $atts['color'],	
				'padding' => $atts['padding'],
				'border-radius' => $atts['border-radius'],
				'background-shadow-size' => array('x' => 0, 'y' => 0, 'size' => $atts['shadow-size']),
				'background-shadow-color' => $atts['shadow-color'],
				'background-shadow-opacity' => $atts['shadow-opacity'],
			);

			if( !empty($atts['background']) ){
				if( strlen($atts['background']) > 7 ){
					$widget_box_atts['background-image'] = $atts['background'];
				}else{
					$widget_box_atts['background-color'] = $atts['background'];
				}
			}
			if( !empty($atts['border-color']) ){
				$atts['border-width'] = empty($atts['border-width'])? '3px': $atts['border-width'];
				$widget_box_atts['border'] = $atts['border-width'] . ' solid ' . $atts['border-color']; 
			}

			$extra_class = '';
			if( !empty($atts['text-align']) ){
				$extra_class .= ' gdlr-core-' . $atts['text-align'] . '-align';
			}

			$ret  = '<div class="gdlr-core-widget-box-shortcode ' . esc_attr($extra_class) . '" ' . gdlr_core_esc_style($widget_box_atts) . ' >';
			if( !empty($atts['title']) ){
				$ret .= '<h3 class="gdlr-core-widget-box-shortcode-title" ' . gdlr_core_esc_style(array(
					'color' => $atts['title-color']
				)) . ' >' . $atts['title'] . '</h3>';
			}
			if( !empty($atts['left-icon']) ){
				$ret .= '<i class="gdlr-core-widget-box-shortcode-icon ' . esc_attr($atts['left-icon']) . '" ' . gdlr_core_esc_style(array(
					'color' => $atts['left-icon-color']
				)) . ' ></i>';
			}
			$ret .= '<div class="gdlr-core-widget-box-shortcode-content" >';
			$ret .= gdlr_core_content_filter($content);
			$ret .= '</div>'; // gdlr-core-widget-box-content

			if( !empty($atts['link']) ){
				$ret .= '<a class="gdlr-core-widget-box-shortcode-link" href="' . esc_url($atts['link']) . '" ';
				$ret .= empty($atts['link-target'])? '': 'target="' . esc_attr($atts['link-target']) . '" ';
				$ret .= ' ></a>';
			}
			$ret .= '</div>'; // gdlr-core-widget-box-shortcode

			return $ret;
		}
	}