<?php
	/*	
	*	Goodlayers Product Item Style
	*/
	
	if( !class_exists('gdlr_core_product_style') ){
		class gdlr_core_product_style{

			// get the content of the product item
			function get_content( $args ){

				$ret = apply_filters('gdlr_core_product_style_content', '', $args, $this);
				if( !empty($ret) ) return $ret;

				switch( $args['product-style'] ){
					case 'grid': 
						return $this->product_grid( $args ); 
					case 'grid-2': 
						return $this->product_grid_style_2( $args ); 
					case 'grid-3': 
						return $this->product_grid_style_3( $args ); 
					case 'grid-4': 
						return $this->product_grid_style_4( $args ); 
					break;
				}
				
			}

			// get product thumbnail
			function product_thumbnail( $args = array() ){
				$ret = '';
				$feature_image = get_post_thumbnail_id();

				if( !empty($feature_image) ){
					$additional_class = '';
					if( empty($args['enable-thumbnail-zoom-on-hover']) || $args['enable-thumbnail-zoom-on-hover'] == 'enable' ){
						$additional_class .= ' gdlr-core-zoom-on-hover';
					}
					if( !empty($args['enable-thumbnail-grayscale-effect']) && $args['enable-thumbnail-grayscale-effect'] == 'enable' ){
						$additional_class .= ' gdlr-core-grayscale-effect';
					}


					$ret .= '<div class="gdlr-core-product-thumbnail gdlr-core-media-image ' . esc_attr($additional_class) . '" ';
					if( $args['product-style'] != 'grid-3' ){
						if( !empty($args['frame-shadow-size']['size']) && !empty($args['frame-shadow-color']) && !empty($args['frame-shadow-opacity']) ){
							$ret .= gdlr_core_esc_style(array(
								'background-shadow-size' => $args['frame-shadow-size'],
								'background-shadow-color' => $args['frame-shadow-color'],
								'background-shadow-opacity' => $args['frame-shadow-opacity'],
							));
						}
					}
					$ret .= ' >';

					if( !in_array($args['product-style'], array('grid', 'grid-2')) ){
						$ret .= '<a href="' . get_permalink() . '" >';
					}
					$ret .= gdlr_core_get_image($feature_image, $args['thumbnail-size'], array('placeholder' => false));
					
					if( $args['product-style'] == 'grid' ){
						$ret .= '<div class="gdlr-core-product-thumbnail-info" >';
						$ret .= '<a href="' . get_permalink() . '" class="gdlr-core-product-view-detail" >';
						$ret .= '<i class="fa fa-eye" ></i>';
						$ret .= '<span>' . esc_html__('View Details', 'goodlayers-core') . '</span>';
						$ret .= '</a>';					
						$ret .= $this->product_add_to_cart();
						$ret .= '</div>';
					}else if( $args['product-style'] == 'grid-2' ){
						$ret .= $this->product_onsale();	
						$ret .= '<div class="gdlr-core-product-thumbnail-info" >';
						$ret .= $this->product_add_to_cart();
						$ret .= '</div>';
					}else{
						$ret .= '</a>';
					}

					$ret .= '</div>';
				}

				return $ret;
			}

			// get product add to cart button
			function product_add_to_cart( $start = '<i class="icon_cart_alt" ></i><span>', $end = '</span>' ){

				add_filter('woocommerce_loop_add_to_cart_args', array($this, 'product_add_to_cart_args'));
				add_filter('woocommerce_product_add_to_cart_text', array($this, 'product_add_to_cart_text'));

				ob_start();
				woocommerce_template_loop_add_to_cart();
				$ret = ob_get_contents();
				ob_end_clean();

				remove_filter('woocommerce_loop_add_to_cart_args', array($this, 'product_add_to_cart_args'));
				remove_filter('woocommerce_product_add_to_cart_text', array($this, 'product_add_to_cart_text'));

				// replace the text
				$ret = str_replace('#gdlr-core-product-add-to-cart#', $start, $ret);
				$ret = str_replace('#gdlr-core-product-add-to-cart-end#', $end, $ret);

				return $ret;
			}
			function product_add_to_cart_args( $args ){

				$args['class'] = preg_replace('/^button\s/', '', $args['class']);
				$args['class'] .= ' gdlr-core-product-add-to-cart';

				return $args;
			}
			function product_add_to_cart_text( $text ){
				return '#gdlr-core-product-add-to-cart#' . $text . '#gdlr-core-product-add-to-cart-end#';
			}

			// get product price
			function product_price(){
				global $product;

				$ret = '';
				if( !empty($product) ){
					$ret  = '<div class="gdlr-core-product-price gdlr-core-title-font">';
					$ret .= $product->get_price_html();
					$ret .= '</div>';
				}

				return $ret;
			}
			function product_rating(){
				global $product;

				$ret = '';
				if( !empty($product) ){
					$average = $product->get_average_rating();
					$rating_count = $product->get_rating_count();
					$ret .= wc_get_rating_html($average, $rating_count);
				}

				return $ret;
			}
			function product_onsale(){
				global $product;

				$ret = '';
				if( !empty($product) ){
					ob_start();
					woocommerce_show_product_loop_sale_flash();
					$ret = ob_get_contents();
					ob_end_clean();

					if( !empty($ret) ){
						$ret .= '<span class="gdlr-core-outer-frame-element" ></span>';
					}
				}
				
				return $ret;
			}

			// product title
			function product_title( $args, $permalink = '' ){

				$ret  = '<h3 class="gdlr-core-product-title gdlr-core-skin-title" ' . gdlr_core_esc_style(array(
					'font-size' => empty($args['product-title-font-size'])? '': $args['product-title-font-size'],
					'font-weight' => empty($args['product-title-font-weight'])? '': $args['product-title-font-weight'],
					'letter-spacing' => empty($args['product-title-letter-spacing'])? '': $args['product-title-letter-spacing'],
					'text-transform' => (empty($args['product-title-text-transform']) || $args['product-title-text-transform'] == 'none')? '': $args['product-title-text-transform']
				)) . ' >';
				if( empty($permalink) ){
					$ret .= '<a href="' . get_permalink() . '" >';
				}else{
					$ret .= '<a href="' . esc_attr($permalink) . '" target="_blank" >';
				}
				$ret .= get_the_title();
				$ret .= '</a>';
				$ret .= '</h3>';

				return  $ret;
			}

			// product column
			function product_grid( $args ){

				$ret  = '<div class="gdlr-core-product-grid" >';
				$ret .= $this->product_thumbnail($args);
				
				$ret .= '<div class="gdlr-core-product-grid-content-wrap">';
				$ret .= $this->product_onsale();

				$ret .= '<div class="gdlr-core-product-grid-content">';
				$ret .= $this->product_title($args);

				$ret .= $this->product_price();
				$ret .= '</div>'; // gdlr-core-product-grid-content
				$ret .= '</div>'; // gdlr-core-product-grid-content-wrap
				$ret .= '</div>'; // gdlr-core-product-grid
				
				return $ret;
			} 	

			function product_grid_style_2( $args ){

				$ret  = '<div class="gdlr-core-product-grid-2" >';
				$ret .= $this->product_thumbnail($args);
				
				$ret .= '<div class="gdlr-core-product-grid-content-wrap">';
				$ret .= '<div class="gdlr-core-product-grid-content">';
				$ret .= $this->product_title($args);

				$ret .= $this->product_price();
				$ret .= '</div>'; // gdlr-core-product-grid-content
				$ret .= '</div>'; // gdlr-core-product-grid-content-wrap
				$ret .= '</div>'; // gdlr-core-product-grid
				
				return $ret;
			} 	

			function product_grid_style_3( $args ){
				$extra_class  = ' gdlr-core-button-style-' . (empty($args['button-style'])? 'plain': $args['button-style']);
				$extra_class .= (!empty($args['enable-move-up-shadow-effect']) && $args['enable-move-up-shadow-effect'] == 'enable')? ' gdlr-core-move-up-with-shadow gdlr-core-outer-frame-element': '';

				$frame_atts = array();
				if( !empty($args['frame-shadow-size']['size']) && !empty($args['frame-shadow-color']) && !empty($args['frame-shadow-opacity']) ){
					$frame_atts['background-shadow-size'] = $args['frame-shadow-size'];
					$frame_atts['background-shadow-color'] = $args['frame-shadow-color'];
					$frame_atts['background-shadow-opacity'] = $args['frame-shadow-opacity'];
				}

				$border_size = empty($args['frame-border-size'])? '': $args['frame-border-size'];

				$ret  = '<div class="gdlr-core-product-grid-3 gdlr-core-item-mgb ' . esc_attr($extra_class) . '" ' . gdlr_core_esc_style($frame_atts) . ' >';
				$ret .= $this->product_thumbnail($args);
				
				$ret .= '<div class="gdlr-core-product-grid-content gdlr-core-skin-e-background" ' . gdlr_core_esc_style(array(
					'border-width' => empty($border_size)? '': "0px {$border_size} {$border_size}",
					'border-color' => empty($args['frame-border-color'])? '': $args['frame-border-color']
				)) . '>';
				$ret .= '<div class="gdlr-core-product-grid-info clearfix" >';
				$ret .= $this->product_price();
				$ret .= $this->product_rating();
				$ret .= '</div>';

				$ret .= $this->product_title($args);

				$ret .= $this->product_add_to_cart();
				$ret .= '</div>'; // gdlr-core-product-grid-content
				$ret .= '</div>'; // gdlr-core-product-grid
				
				return $ret;
			} 

			function product_grid_style_4( $args ){

				$ret  = '<div class="gdlr-core-product-grid-4" >';
				$ret .= $this->product_thumbnail($args);
				
				$ret .= '<div class="gdlr-core-product-grid-content">';
				$ret .= $this->product_title($args);

				$ret .= '</div>'; // gdlr-core-product-grid-content
				$ret .= '</div>'; // gdlr-core-product-grid
				
				return $ret;
			} 	
			
		} // gdlr_core_product_item
	} // class_exists
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	