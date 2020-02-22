<?php
	/*	
	*	Goodlayers Product Item
	*/
	
	if( !class_exists('gdlr_core_product_item') ){
		class gdlr_core_product_item{
			
			var $settings = '';
			
			// init the variable
			function __construct( $settings = array() ){
				
				$this->settings = wp_parse_args($settings, array(
					'category' => '', 
					'tag' => '', 
					'stock-status' => 'all', 
					'num-fetch' => '9', 
					'layout' => 'fitrows',
					'thumbnail-size' => 'full', 
					'orderby' => 'date', 
					'order' => 'desc',
					'product-style' => 'grid', 
					'has-column' => 'no',
					'no-space' => 'no',
					'column-size' => 20,
					'pagination' => 'none'
				));

				if( $this->settings['orderby'] == 'rand' ){
					$this->settings['orderby'] = 'RAND(' . rand(1, 1000) . ')';
				} 
			}
			
			// get the content of the product item
			function get_content(){
				
				if( !empty($this->settings['column-size']) ){
					gdlr_core_set_container_multiplier(intval($this->settings['column-size']) / 60, false);
				}

				$ret = '';
				if( empty($this->settings['query']) ){
					$query = $this->get_product_query();
				}else{
					$query = $this->settings['query'];
				}
				
				// carousel style
				if( $this->settings['layout'] == 'carousel' ){
					$slides = array();
					$column_no = 60 / intval($this->settings['column-size']);

					$flex_atts = array(
						'carousel' => true,
						'column' => $column_no,
						'move' => empty($this->settings['carousel-scrolling-item-amount'])? '': $this->settings['carousel-scrolling-item-amount'],
						'navigation' => empty($this->settings['carousel-navigation'])? 'navigation': $this->settings['carousel-navigation'],
						'bullet-style' => empty($this->settings['carousel-bullet-style'])? '': $this->settings['carousel-bullet-style'],
						'nav-parent' => 'gdlr-core-product-item',
						'disable-autoslide' => (empty($this->settings['carousel-autoslide']) || $this->settings['carousel-autoslide'] == 'enable')? '': true,
						'mglr' => ($this->settings['no-space'] == 'yes'? false: true)
					);

					gdlr_core_setup_admin_postdata();

					$product_style = new gdlr_core_product_style();
					if( function_exists('woocommerce_product_loop_start') ){
						woocommerce_product_loop_start(false);
					}
					while($query->have_posts()){ $query->the_post();
						$slides[] = $product_style->get_content( $this->settings );
					} // while
					if( function_exists('woocommerce_product_loop_end') ){
						woocommerce_product_loop_end(false);
					}

					$ret .= gdlr_core_get_flexslider($slides, $flex_atts);

					wp_reset_postdata();
					gdlr_core_reset_admin_postdata();
					
				// fitrows style
				}else{

					gdlr_core_setup_admin_postdata();
					
					$ret .= '<div class="gdlr-core-product-item-holder gdlr-core-js-2 clearfix" data-layout="' . $this->settings['layout'] . '" >';
					$ret .= $this->get_product_grid_content($query);
					$ret .= '</div>';

					wp_reset_postdata();
					gdlr_core_reset_admin_postdata();

					// pagination
					if( $this->settings['pagination'] != 'none' ){
						$extra_class = '';
						if( $this->settings['no-space'] == 'no' ){
							$extra_class = 'gdlr-core-item-pdlr';
						}

						if( $this->settings['pagination'] == 'page' ){
							$ret .= gdlr_core_get_pagination($query->max_num_pages, $this->settings, $extra_class);
						}else if( $this->settings['pagination'] == 'load-more' ){
							$paged = empty($query->query['paged'])? 2: intval($query->query['paged']) + 1;
							$ret .= gdlr_core_get_ajax_load_more('product', $this->settings, $paged, $query->max_num_pages, 'gdlr-core-product-item-holder', $extra_class);
						}
					}
				}

				gdlr_core_set_container_multiplier(1, false);

				return $ret;
			}

			// get content of non carousel product item
			function get_product_grid_content( $query ){

				$ret = '';
				$column_sum = 0;
				$product_style = new gdlr_core_product_style();

				if( function_exists('woocommerce_product_loop_start') ){
					$ret .= woocommerce_product_loop_start(false);
				}
				if( is_archive() ){
					ob_start();
					woocommerce_product_subcategories();
					$sub_cat_content = ob_get_contents();
					ob_end_clean();

					if( !empty($sub_cat_content) ){
						echo '<ul class="gdlr-core-product-sub-category clearfix" >' . $sub_cat_content . '</ul>';
					}
				}
				while($query->have_posts()){ $query->the_post();

					$args = $this->settings;

					if( $this->settings['has-column'] == 'yes' ){
						$additional_class  = ($this->settings['no-space'] == 'yes')? '': ' gdlr-core-item-pdlr';
						$additional_class .= empty($this->settings['column-size'])? '': ' gdlr-core-column-' . $this->settings['column-size'];

						if( $column_sum == 0 || $column_sum + intval($this->settings['column-size']) > 60 ){
							$column_sum = intval($this->settings['column-size']);
							$additional_class .= ' gdlr-core-column-first';
						}else{
							$column_sum += intval($this->settings['column-size']);
						}

						$ret .= '<div class="gdlr-core-item-list ' . esc_attr($additional_class) . '" >';
					}

					$ret .= $product_style->get_content($args);

					if( $this->settings['has-column'] == 'yes' ){
						$ret .= '</div>';
					}
				} // while
				if( function_exists('woocommerce_product_loop_end') ){
					$ret .= woocommerce_product_loop_end(false);
				}

				return $ret;
			}
			
			// query the post
			function get_product_query(){
				
				$args = array( 'post_type' => 'product', 'post_status' => 'publish', 'suppress_filters' => false );
				
				// category - tag selection
				if( !empty($this->settings['category']) || !empty($this->settings['tag']) ){
					$args['tax_query'] = array('relation' => 'OR');
					
					if( !empty($this->settings['category']) ){
						array_push($args['tax_query'], array('terms'=>$this->settings['category'], 'taxonomy'=>'product_cat', 'field'=>'slug'));
					}
					if( !empty($this->settings['tag']) ){
						array_push($args['tax_query'], array('terms'=>$this->settings['tag'], 'taxonomy'=>'product_tag', 'field'=>'slug'));
					}
				}

				// pagination
				if( empty($this->settings['paged']) ){
					$args['paged'] = (get_query_var('paged'))? get_query_var('paged') : get_query_var('page');
					$args['paged'] = empty($args['paged'])? 1: $args['paged'];
				}else{
					$args['paged'] = $this->settings['paged'];
				}
				$this->settings['paged'] = $args['paged'];				

				if( !empty($this->settings['stock-status']) && $this->settings['stock-status'] != 'all' ){
					 $args['meta_query'] = array(
				        array(
				            'key' => '_stock_status',
				            'value' => $this->settings['stock-status']
				        )
				    );
				}

				// variable
				$args['posts_per_page'] = $this->settings['num-fetch'];
				$args['orderby'] = $this->settings['orderby'];
				$args['order'] = $this->settings['order'];
				
				$query = new WP_Query( $args );

				return $query;
			}
			
		} // gdlr_core_product_item
	} // class_exists
	
	add_action('wp_ajax_gdlr_core_product_ajax', 'gdlr_core_product_ajax');
	add_action('wp_ajax_nopriv_gdlr_core_product_ajax', 'gdlr_core_product_ajax');
	if( !function_exists('gdlr_core_product_ajax') ){
		function gdlr_core_product_ajax(){

			if( !empty($_POST['settings']) ){

				$settings = $_POST['settings'];
				if( !empty($_POST['option']) ){	
					$settings[$_POST['option']['name']] = $_POST['option']['value'];
				}

				$product_item = new gdlr_core_product_item($settings);
				$query = $product_item->get_product_query();	

				$ret = array(
					'status'=> 'success',
					'content'=> $product_item->get_product_grid_content($query)
				);
				if( !empty($settings['pagination']) && $settings['pagination'] != 'none' ){
					if( $settings['pagination'] == 'load-more' ){
						$paged = empty($query->query['paged'])? 2: intval($query->query['paged']) + 1;
						$extra_class = ($settings['no-space'] == 'yes')? '': 'gdlr-core-item-pdlr';

						$ret['load_more'] = gdlr_core_get_ajax_load_more('product', $settings, $paged, $query->max_num_pages, 'gdlr-core-product-item-holder', $extra_class);
						$ret['load_more'] = empty($ret['load_more'])? 'none': $ret['load_more'];
					}
				} 

				die(json_encode($ret));
			}else{
				die(json_encode(array(
					'status'=> 'failed',
					'message'=> esc_html__('Settings variable is not defined.', 'goodlayers-core')
				)));
			}

		} // gdlr_core_product_load_more
	} // function_exists

	