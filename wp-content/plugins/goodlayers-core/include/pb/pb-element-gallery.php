<?php
	/*	
	*	Goodlayers Item For Page Builder
	*/
	
	gdlr_core_page_builder_element::add_element('gallery', 'gdlr_core_pb_element_gallery'); 
	
	if( !class_exists('gdlr_core_pb_element_gallery') ){
		class gdlr_core_pb_element_gallery{
			
			// get the element settings
			static function get_settings(){
				return array(
					'icon' => 'icon_images',
					'title' => esc_html__('Gallery', 'goodlayers-core')
				);
			}
			
			// return the element options
			static function get_options(){
				global $gdlr_core_item_pdb;
				
				return array(
					'gallery' => array(
						'title' => esc_html__('Gallery', 'goodlayers-core'),
						'options' => array(
							'gallery' => array(
								'type' => 'custom',
								'item-type' => 'gallery',
								'wrapper-class' => 'gdlr-core-fullsize',
								'options' => array(
									'link-to' => array(
										'title' => esc_html__('Link To', 'goodlayers-core'),
										'type' => 'combobox',
										'options' => array(
											'lb-full-image' => esc_html__('Lightbox with full image', 'goodlayers-core'),
											'lb-custom-image' => esc_html__('Lightbox with custom image', 'goodlayers-core'),
											'lb-video' => esc_html__('Video Lightbox', 'goodlayers-core'),
											'page-url' => esc_html__('Specific Page', 'goodlayers-core'),
											'custom-url' => esc_html__('Custom Url', 'goodlayers-core'),
											'none' => esc_html__('None', 'goodlayers-core')
										)
									),
									'custom-image' => array(
										'title' => esc_html__('Upload Custom Image', 'goodlayers-core'),
										'type' => 'upload',
										'condition' => array(
											'link-to' => 'lb-custom-image'
										)
									),
									'video-url' => array(
										'title' => esc_html__('Video Url ( Youtube / Vimeo )', 'goodlayers-core'),
										'type' => 'text',
										'condition' => array(
											'link-to' => 'lb-video'
										)
									),
									'page-id' => array(
										'title' => esc_html__('Page Id', 'goodlayers-core'),
										'type' => 'combobox',
										'options' => gdlr_core_get_post_list('page'),
										'condition' => array(
											'link-to' => 'page-url'
										)
									),
									'custom-url' => array(
										'title' => esc_html__('Custom Url', 'goodlayers-core'),
										'type' => 'text',
										'condition' => array(
											'link-to' => 'custom-url'
										)
									),
									'custom-link-target' => array(
										'title' => esc_html__('Custom Link Target', 'goodlayers-core'),
										'type' => 'combobox',
										'options' => array(
											'_self' => esc_html__('Current Screen', 'goodlayers-core'),
											'_blank' => esc_html__('New Window', 'goodlayers-core'),
										),
									)
								)
							), // gallery
							'random' => array(
								'title' => esc_html__('Random Order', 'goodlayers-core'),
								'type' => 'checkbox',
								'default' => 'disable'
							),
							'pagination' => array(
								'title' => esc_html__('Pagination', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'none'=>esc_html__('None', 'goodlayers-core'), 
									'page'=>esc_html__('Page', 'goodlayers-core'), 
									// 'load-more'=>esc_html__('Load More', 'goodlayers-core'), 
								),
								'condition' => array( 'random' => 'disable' ),
								'description' => esc_html__('Pagination is not supported and will be automatically disabled on carousel/slider/scroll style.', 'goodlayers-core'),
							),
							'show-amount' => array(
								'title' => esc_html__('Show Amount ( Per Pages )', 'goodlayers-core'),
								'type' => 'text',
								'default' => '20',
								'condition' => array( 'random' => 'disable', 'pagination' => array('page', 'load-more') )
							),
							'pagination-style' => array(
								'title' => esc_html__('Pagination Style', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'default' => esc_html__('Default', 'goodlayers-core'),
									'plain' => esc_html__('Plain', 'goodlayers-core'),
									'rectangle' => esc_html__('Rectangle', 'goodlayers-core'),
									'rectangle-border' => esc_html__('Rectangle Border', 'goodlayers-core'),
									'round' => esc_html__('Round', 'goodlayers-core'),
									'round-border' => esc_html__('Round Border', 'goodlayers-core'),
									'circle' => esc_html__('Circle', 'goodlayers-core'),
									'circle-border' => esc_html__('Circle Border', 'goodlayers-core'),
								),
								'default' => 'default',
								'condition' => array( 'random' => 'disable', 'pagination' => 'page' )
							),
							'pagination-align' => array(
								'title' => esc_html__('Pagination Alignment', 'goodlayers-core'),
								'type' => 'radioimage',
								'options' => 'text-align',
								'with-default' => true,
								'default' => 'default',
								'condition' => array( 'random' => 'disable', 'pagination' => 'page' )
							),
						),
					),
					'style' => array(
						'title' => esc_html__('Style', 'goodlayers-core'),
						'options' => array(
							'style'  => array(
								'title' => esc_html__('Style', 'goodlayers-core'),
								'type' => 'radioimage',
								'options' => array(
									'grid' => GDLR_CORE_URL . '/include/images/gallery/grid.png',
									'grid-no-space' => GDLR_CORE_URL . '/include/images/gallery/grid-no-space.png',
									'scroll' => GDLR_CORE_URL . '/include/images/gallery/scroll.png',
									'slider' => GDLR_CORE_URL . '/include/images/gallery/slider.png',
									'stack-image' => GDLR_CORE_URL . '/include/images/gallery/stack-image.png',
									'thumbnail' => GDLR_CORE_URL . '/include/images/gallery/thumbnail.png',
								),
								'wrapper-class' => 'gdlr-core-fullsize'
							),
							'max-slider-height' => array(
								'title' => esc_html__('Max Image Height', 'goodlayers-core'),
								'type' => 'text',
								'default' => '500px',
								'condition' => array( 'style' => 'scroll' )
							),
							'overlay'  => array(
								'title' => esc_html__('Overlay', 'goodlayers-core'),
								'type' => 'radioimage',
								'options' => array(
									'left-title-caption' => GDLR_CORE_URL . '/include/images/gallery/overlay/left-title-caption.png',
									'left-title' => GDLR_CORE_URL . '/include/images/gallery/overlay/left-title.png',
									'left-caption' => GDLR_CORE_URL . '/include/images/gallery/overlay/left-caption.png',
									'center-title-caption' => GDLR_CORE_URL . '/include/images/gallery/overlay/center-title-caption.png',
									'center-title' => GDLR_CORE_URL . '/include/images/gallery/overlay/center-title.png',
									'center-caption' => GDLR_CORE_URL . '/include/images/gallery/overlay/center-caption.png',
									'right-title-caption' => GDLR_CORE_URL . '/include/images/gallery/overlay/right-title-caption.png',
									'right-title' => GDLR_CORE_URL . '/include/images/gallery/overlay/right-title.png',
									'right-caption' => GDLR_CORE_URL . '/include/images/gallery/overlay/right-caption.png',
									'icon-hover' => GDLR_CORE_URL . '/include/images/gallery/overlay/icon-hover.png',
									'none' => GDLR_CORE_URL . '/include/images/gallery/overlay/none.png',
								),
								'default' => 'none',
								'max-width' => '100px',
								'condition' => array( 'style' => array('grid', 'grid-no-space', 'scroll', 'slider', 'stack-image') ),
								'wrapper-class' => 'gdlr-core-fullsize'
							),
							'show-caption' => array(
								'title' => esc_html__('Show Caption ( Under Images )', 'goodlayers-core'),
								'type' => 'checkbox',
								'default' => 'disable',
								'condition' => array( 'style' => array('grid', 'grid-no-space', 'stack-image', 'scroll') )
							),
							'overlay-on-hover' => array(
								'title' => esc_html__('Show Overlay Info On Hover', 'goodlayers-core'),
								'type' => 'checkbox',
								'default' => 'disable',
								'description' => esc_html__('Disable this option to always show the overlay info', 'goodlayers-core'),
							),
							'column' => array(
								'title' => esc_html__('Column Number', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array( 1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6),
								'default' => 3,
								'condition' => array( 'style' => array('grid', 'grid-no-space') )
							),
							'layout' => array(
								'title' => esc_html__('Layout', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array( 
									'fitrows' => esc_html__('Fit Rows', 'goodlayers-core'),
									'carousel' => esc_html__('Carousel', 'goodlayers-core'),
									'masonry' => esc_html__('Masonry', 'goodlayers-core'),
								),
								'default' => 'fitrows',
								'condition' => array( 'style' => array('grid', 'grid-no-space') )
							),
							'slider-navigation' => array(
								'title' => esc_html__('Slider Navigation', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'none' => esc_html__('None', 'goodlayers-core'),
									'navigation' => esc_html__('Only Navigation', 'goodlayers-core'),
									'navigation-outer' => esc_html__('Only ( Outer ) Navigation', 'goodlayers-core'),
									'navigation-round' => esc_html__('Only ( Top Round ) Navigation', 'goodlayers-core'),
									'bullet' => esc_html__('Only Bullet', 'goodlayers-core'),
									'both' => esc_html__('Both Navigation and Bullet', 'goodlayers-core'),
								),
								'default' => 'navigation',
								'condition' => array( 'style' => 'slider' )
							),
							'slider-bullet-style' => array(
								'title' => esc_html__('Carousel Bullet Style', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => (function_exists('gdlr_core_get_flexslider_bullet_types')? gdlr_core_get_flexslider_bullet_types(): array()),
								'condition' => array( 'style' => 'slider', 'slider-navigation' => array('bullet','both') )
							),
							'slider-effects' => array(
								'title' => esc_html__('Slider Effects', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'default' => esc_html__('Default', 'goodlayers-core'),
									'kenburn' => esc_html__('Kenburn', 'goodlayers-core'),
								),
								'default' => 'default',
								'condition' => array( 'style' => 'slider' )
							),
							'enable-direction-navigation' => array(
								'title' => esc_html__('Enable Direction Navigation', 'goodlayers-core'),
								'type' => 'checkbox',
								'default' => 'disable',
								'condition' => array( 'style' => 'thumbnail' )
							), 
							'thumbnail-navigation' => array(
								'title' => esc_html__('Thumbnail Navigation Style', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'below-slider' => esc_html__('Below Slider', 'goodlayers-core'),
									'inside-slider' => esc_html__('Inside Slider', 'goodlayers-core'),
								),
								'default' => 'below-slider',
								'condition' => array( 'style' => 'thumbnail' )
							),
							'carousel-autoslide' => array(
								'title' => esc_html__('Autoslide Carousel', 'goodlayers-core'),
								'type' => 'checkbox',
								'default' => 'enable',
								'condition' => array( 'style' => array('grid', 'grid-no-space'), 'layout' => 'carousel' )
							),
							'carousel-scrolling-item-amount' => array(
								'title' => esc_html__('Carousel Scrolling Item Amount', 'goodlayers-core'),
								'type' => 'text',
								'default' => '1',
								'condition' => array( 'style' => array('grid', 'grid-no-space'), 'layout' => 'carousel' )
							),
							'grid-slider-navigation' => array(
								'title' => esc_html__('Slider Navigation', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'none' => esc_html__('None', 'goodlayers-core'),
									'navigation' => esc_html__('Only Navigation', 'goodlayers-core'),
									'navigation-outer' => esc_html__('Only ( Outer ) Navigation', 'goodlayers-core'),
									'navigation-round' => esc_html__('Only ( Top Round ) Navigation', 'goodlayers-core'),
									'bullet' => esc_html__('Only Bullet', 'goodlayers-core'),
									'both' => esc_html__('Both Navigation and Bullet', 'goodlayers-core'),
								),
								'default' => 'navigation',
								'condition' => array( 'style' => array('grid', 'grid-no-space'), 'layout' => 'carousel' )
							),
							'carousel-bullet-style' => array(
								'title' => esc_html__('Carousel Bullet Style', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => (function_exists('gdlr_core_get_flexslider_bullet_types')? gdlr_core_get_flexslider_bullet_types(): array()),
								'condition' => array( 'style' => array('grid', 'grid-no-space'), 'layout' => 'carousel', 'grid-slider-navigation' => array('bullet','both') )
							),
							'thumbnail-size' => array(
								'title' => esc_html__('Thumbnail Size', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => 'thumbnail-size'
							),	
							'slider-thumbnail-size' => array(
								'title' => esc_html__('Slider ( Small ) Thumbnail Size', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => 'thumbnail-size',
								'default' => 'medium',
								'condition' => array( 'style' => 'thumbnail' )
							),	
						),
					),
					'color' => array(
						'title' => esc_html('Color', 'goodlayers-core'),
						'options' => array(
							'overlay-color' => array(
								'title' => esc_html__('Image Overlay Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'overlay-opacity' => array(
								'title' => esc_html__('Image Overlay Opacity', 'goodlayers-core'),
								'type' => 'text',
								'description' =>  esc_html__('Fill the number between 0.01 to 1', 'goodlayers-core') . '. ' .
									esc_html__('You need to specify the "Image Overlay Color" to use this option', 'goodlayers-core')
							)
						)
					),
					'spacing' => array(
						'title' => esc_html__('Spacing', 'goodlayers-core'),
						'options' => array(
							'border-radius' => array(
								'title' => esc_html__('Border Radius', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
							),
							'image-bottom-margin' => array(
								'title' => esc_html__('Image Bottom Margin', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
								'description' => esc_html__('Only for "Grid" and "Stack Images" style.', 'goodlayers-core')
							),
							'padding-bottom' => array(
								'title' => esc_html__('Padding Bottom ( Item )', 'goodlayers-core'),
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
				$content  = self::get_content($settings);
				$id = mt_rand(0, 9999);
				
				ob_start();
?><script id="gdlr-core-preview-gallery-<?php echo esc_attr($id); ?>" >
if( document.readyState == 'complete' ){
	jQuery(document).ready(function(){
		jQuery('#gdlr-core-preview-gallery-<?php echo esc_attr($id); ?>').parent().gdlr_core_flexslider().gdlr_core_sly().gdlr_core_isotope();
	});
}else{
	jQuery(window).load(function(){
		jQuery('#gdlr-core-preview-gallery-<?php echo esc_attr($id); ?>').parent().gdlr_core_flexslider().gdlr_core_sly().gdlr_core_isotope();
	});
}
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
						'padding-bottom' => $gdlr_core_item_pdb
					);
				}
				
				// default value
				$settings['column'] = empty($settings['column'])? '3': $settings['column'];
				$settings['thumbnail-size'] = empty($settings['thumbnail-size'])? 'full': $settings['thumbnail-size'];
				$settings['style'] = empty($settings['style'])? 'grid': $settings['style'];
				$settings['overlay'] = empty($settings['overlay'])? 'none': $settings['overlay'];
				$settings['overlay-on-hover'] = empty($settings['overlay-on-hover'])? 'disable': $settings['overlay-on-hover'];
				$settings['layout'] = empty($settings['layout'])? 'fitrows': $settings['layout'];
				$settings['show-caption'] = empty($settings['show-caption'])? 'disable': $settings['show-caption'];
				$settings['pagination-class'] = '';

				if( !empty($settings['random']) && $settings['random'] == 'enable' ){
					shuffle($settings['gallery']);
					$settings['pagination'] = 'none';
				}

				if( empty($settings['pagination']) || empty($settings['show-amount']) ){
					$settings['pagination'] = 'none';
				}else if( $settings['pagination'] != 'none' ){
					if( (in_array($settings['style'], array('grid', 'grid-no-space')) && $settings['layout'] != 'carousel') || $settings['style'] == 'stack-image' ){
						$settings['paged'] = (get_query_var('paged'))? get_query_var('paged') : get_query_var('page');
						$settings['paged'] = empty($settings['paged'])? 1: intval($settings['paged']);

						$show_amount = intval($settings['show-amount']);
						$settings['max_num_pages'] = ceil(sizeof($settings['gallery']) / $show_amount);
						
						$full_gallery = $settings['gallery'];
						$start = ($settings['paged'] - 1) * $show_amount;
						$settings['gallery'] = array_slice($settings['gallery'], $start, $show_amount);

					}else{
						$settings['pagination'] = 'none';
					}
				}

				// start printing item
				$extra_class  = ' gdlr-core-gallery-item-style-' . $settings['style'];
				if( $settings['style'] != 'grid' || $settings['layout'] == 'carousel' ){
					if( empty($settings['no-pdlr']) ){
						$extra_class .= ' gdlr-core-item-pdlr ';
					}
				}else{
					$settings['pagination-class'] .= ' gdlr-core-item-pdlr';
				}
				$extra_class .= empty($settings['class'])? '': ' ' . $settings['class'];

				$ret  = '<div class="gdlr-core-gallery-item gdlr-core-item-pdb clearfix ' . esc_attr($extra_class) . '" ';
				if( !empty($settings['padding-bottom']) && $settings['padding-bottom'] != $gdlr_core_item_pdb ){
					$ret .= gdlr_core_esc_style(array('padding-bottom'=>$settings['padding-bottom']));
				}
				if( !empty($settings['id']) ){
					$ret .= ' id="' . esc_attr($settings['id']) . '" ';
				}
				$ret .= ' >';

				if( !empty($settings['gallery']) ){

					$lightbox_group = gdlr_core_image_group_id();

					if( $settings['style'] == 'grid' || $settings['style'] == 'grid-no-space' ){

						if( $settings['layout'] == 'carousel' ){

							$slides = array();
							$flex_atts = array(
								'carousel' => true,
								'column' => $settings['column'],
								'navigation' => empty($settings['grid-slider-navigation'])? 'navigation': $settings['grid-slider-navigation'],
								'navigation-old' => true,
								'bullet-style' => empty($settings['carousel-bullet-style'])? '': $settings['carousel-bullet-style'],
								'move' => empty($settings['carousel-scrolling-item-amount'])? '': $settings['carousel-scrolling-item-amount'],
								'disable-autoslide' => (empty($settings['carousel-autoslide']) || $settings['carousel-autoslide'] == 'enable')? '': true,
								'mglr' => (($settings['style'] == 'grid')? true: false)
							);
							foreach( $settings['gallery'] as $image ){

								$slide  = '<div class="gdlr-core-gallery-list gdlr-core-media-image" ' . gdlr_core_esc_style(array(
									'border-radius' => empty($settings['border-radius'])? '': $settings['border-radius']
								)) . ' >';
								$slide .= self::get_gallery_image($image, $settings, $lightbox_group);
								$slide .= '</div>'; // gdlr-core-gallery-list
								if( $settings['show-caption'] == 'enable' ){
									$caption = gdlr_core_get_image_info($image['id'], 'caption');
									if( !empty($caption) ){
										$slide .= '<div class="gdlr-core-gallery-caption gdlr-core-info-font" >' . gdlr_core_text_filter($caption) . '</div>';
									}
								}

								$slides[] = $slide;
							}

							if( $flex_atts['navigation'] == 'navigation-round' ){
								$ret .= '<div class="gdlr-core-flexslider-nav gdlr-core-round-style gdlr-core-small gdlr-core-center-align" ></div>';

								$flex_atts['nav-parent'] = 'gdlr-core-gallery-item';
								$flex_atts['navigation'] = 'navigation';
							}

							$ret .= gdlr_core_get_flexslider($slides, $flex_atts);

						}else{

							$g_column_count = 0;
							$g_column = 60 / intval($settings['column']);

							$ret .= '<div class="gdlr-core-gallery-item-holder gdlr-core-js-2 clearfix" data-layout="' . $settings['layout'] . '" >';
							foreach( $settings['gallery'] as $image ){
								$column_class  = ' gdlr-core-column-' . $g_column;
								$column_class .= ($g_column_count % 60 == 0)? ' gdlr-core-column-first': '';
								$column_class .= ($settings['style'] == 'grid')? ' gdlr-core-item-pdlr gdlr-core-item-mgb': '';

								$ret .= '<div class="gdlr-core-item-list gdlr-core-gallery-column ' . esc_attr($column_class) . '" ' . (($settings['style'] == 'grid')? gdlr_core_esc_style(array(
									'margin-bottom' => empty($settings['image-bottom-margin'])? '': $settings['image-bottom-margin']
								)): '') . ' >';
								$ret .= '<div class="gdlr-core-gallery-list gdlr-core-media-image" ' . gdlr_core_esc_style(array(
									'border-radius' => empty($settings['border-radius'])? '': $settings['border-radius']
								)) . ' >';
								$ret .= self::get_gallery_image($image, $settings, $lightbox_group);
								$ret .= '</div>'; // gdlr-core-gallery-list
								if( $settings['show-caption'] == 'enable' ){
									$caption = gdlr_core_get_image_info($image['id'], 'caption');
									if( !empty($caption) ){
										$ret .= '<div class="gdlr-core-gallery-caption gdlr-core-info-font" >' . gdlr_core_text_filter($caption) . '</div>';
									}
								}
								$ret .= '</div>'; // gdlr-core-gallery-column

								$g_column_count += $g_column;
							}
							$ret .= '</div>';
						}
					}else if( $settings['style'] == 'slider' ){

						$ret .= self::get_flexslider_slider($settings['gallery'], $settings, $lightbox_group);

					}else if( $settings['style'] == 'stack-image' ){

						$ret .= '<div class="gdlr-core-gallery-item-holder gdlr-core-js-2" >'; 
						foreach( $settings['gallery'] as $image ){

							$ret .= '<div class="gdlr-core-item-list gdlr-core-item-mgb" ' . gdlr_core_esc_style(array(
								'margin-bottom' => empty($settings['image-bottom-margin'])? '': $settings['image-bottom-margin']
							)) . ' >';
							$ret .= '<div class="gdlr-core-gallery-list gdlr-core-media-image" ' . gdlr_core_esc_style(array(
								'border-radius' => empty($settings['border-radius'])? '': $settings['border-radius']
							)) . ' >';
							$ret .= self::get_gallery_image($image, $settings, $lightbox_group);
							$ret .= '</div>';	
							if( $settings['show-caption'] == 'enable' ){
								$caption = gdlr_core_get_image_info($image['id'], 'caption');
								if( !empty($caption) ){
									$ret .= '<div class="gdlr-core-gallery-caption gdlr-core-info-font" >' . gdlr_core_text_filter($caption) . '</div>';
								}
							}
							$ret .= '</div>';	
						}
						$ret .= '</div>';

					}else if( $settings['style'] == 'scroll' ){

						$ret .= self::get_sly_slider($settings['gallery'], $settings, $lightbox_group);

					}else if( $settings['style'] == 'thumbnail' ){

						$settings['overlay'] = 'center-title-caption';
						$settings['thumbnail-navigation'] = empty($settings['thumbnail-navigation'])? 'below-slider': $settings['thumbnail-navigation'];
						$gallery_thumbnail_class  = 'gdlr-core-' . $settings['thumbnail-navigation'];
						$gallery_thumbnail_class .= (empty($settings['overlay-on-hover']) || $settings['overlay-on-hover'] == 'disable')? ' gdlr-core-disable-hover': '';

						$ret .= '<div class="gdlr-core-gallery-with-thumbnail-wrap ' . esc_attr($gallery_thumbnail_class) . '" >';
						$settings['with-thumbnail'] = '1';
						$settings['slider-navigation'] = (empty($settings['enable-direction-navigation']) || $settings['enable-direction-navigation'] == 'disable')? 'none': 'navigation';
						$ret .= self::get_flexslider_slider($settings['gallery'], $settings, $lightbox_group);

						$settings['max-slider-height'] = '';
						$settings['show-caption'] = 'disable';
						$settings['overlay'] = 'none';
						$settings['only-image'] = true;
						$settings['disable-scroll'] = true;
						$settings['thumbnail-size'] = empty($settings['slider-thumbnail-size'])? 'medium': $settings['slider-thumbnail-size'];
						$ret .= self::get_sly_slider($settings['gallery'], $settings, $lightbox_group);
						$ret .= '</div>';

					}

					// pagination
					if( $settings['pagination'] != 'none' ){
						if( $settings['pagination'] == 'page' ){
							$ret .= gdlr_core_get_pagination($settings['max_num_pages'], $settings, $settings['pagination-class']);
						}else if( $settings['pagination'] == 'load-more' ){
							$settings['gallery'] = $full_gallery;
							$paged = empty($settings['paged'])? 2: intval($settings['paged']) + 1;
							$ret .= gdlr_core_get_ajax_load_more('gallery', $settings, $paged, $settings['max_num_pages'], 'gdlr-core-gallery-item-holder', $settings['pagination-class']);
						}
					}

				}else{
					$ret .= '<div class="gdlr-core-external-plugin-message">' . esc_html__('No image available. Please edit this item to select images.', 'goodlayers-core') . '</div>';
				}

				$ret .= '</div>'; // gdlr-core-gallery-item
				
				return $ret;
			}

			static function get_flexslider_slider($gallery, $settings = array(), $group = ''){

				$slides = array();
				$flex_atts = array(
					'navigation' => empty($settings['slider-navigation'])? 'navigation': $settings['slider-navigation'],
					'navigation-old' => true,
					'bullet-style' => empty($settings['slider-bullet-style'])? '': $settings['slider-bullet-style'],
					'effect' => empty($settings['slider-effects'])? '': $settings['slider-effects'],
					'with-thumbnail' => empty($settings['with-thumbnail'])? '': $settings['with-thumbnail'],
				);

				// slides
				foreach( $gallery as $image ){
					$slide  = '<div class="gdlr-core-gallery-list gdlr-core-media-image" ' . gdlr_core_esc_style(array(
						'border-radius' => empty($settings['border-radius'])? '': $settings['border-radius']
					)) . ' >';
					$slide .= self::get_gallery_image($image, $settings, $group);
					$slide .= '</div>';	
					$slides[] = $slide;
				}

				return gdlr_core_get_flexslider($slides, $flex_atts);
			}

			static function get_sly_slider($gallery, $settings = array(), $group = ''){

				$max_height = gdlr_core_esc_style(array(
					'height' => empty($settings['max-slider-height'])? '': $settings['max-slider-height']
				));

				$ret  = '<div class="gdlr-core-sly-slider gdlr-core-js-2" >';
				$ret .= '<ul class="slides" >';
				foreach( $gallery as $image ){
					$ret .= '<li class="gdlr-core-gallery-list gdlr-core-item-mglr" ' . gdlr_core_esc_style(array(
						'border-radius' => empty($settings['border-radius'])? '': $settings['border-radius']
					)) . ' >';
					$ret .= '<div class="gdlr-core-media-image" ' . $max_height . ' >';
					if( empty($settings['only-image']) ){
						$ret .= self::get_gallery_image($image, $settings, $group);
					}else{
						$ret .= gdlr_core_get_image($image['id'], $settings['thumbnail-size']);
					}
					$ret .= '</div>';

					if( $settings['show-caption'] == 'enable' ){
						$caption = gdlr_core_get_image_info($image['id'], 'caption');
						if( !empty($caption) ){
							$ret .= '<div class="gdlr-core-gallery-caption gdlr-core-info-font" >' . gdlr_core_text_filter($caption) . '</div>';
						}
					}
					$ret .= '</li>';	
				}
				$ret .= '</ul>';
				$ret .= '</div>'; // gdlr-core-sly-slider

				if( empty($settings['disable-scroll']) ){
					$ret .= '<div class="gdlr-core-sly-scroll" ><div class="gdlr-core-sly-scroll-handle" ></div></div>';
				}

				return $ret;
			}

			static function get_gallery_image($image, $settings = array(), $group = ''){

				$image_atts = array(
					'lightbox-group' => $group
				);

				// image link section
				if( empty($image['link-to']) || $image['link-to'] != 'none' ){

					if( empty($image['link-to']) || $image['link-to'] == 'lb-full-image' ){
						$image_atts['lightbox'] = true;
					}else if( $image['link-to'] == 'lb-custom-image' ){
						if( !empty($image['custom-image']) ){
							$image_atts['lightbox'] = 'image';
							$image_atts['lightbox-image'] = $image['custom-image'];
						}
					}else if( $image['link-to'] == 'lb-video' ){
						if( !empty($image['video-url']) ){
							$image_atts['lightbox'] = 'video';
							$image_atts['lightbox-video'] = $image['video-url'];
						}
					}else if( $image['link-to'] == 'page-url' ){
						if( !empty($image['page-id']) ){
							$image_atts['link'] = get_permalink($image['page-id']);
						}
					}else if( $image['link-to'] == 'custom-url' ){
						if( !empty($image['custom-url']) ){
							$image_atts['link'] = $image['custom-url'];
							$image_atts['link-target'] = empty($image['custom-link-target'])? '': $image['custom-link-target'];
						}
					}
				}

				// image overlay section
				$image_info = gdlr_core_get_image_info($image['id']);
				
				if( !empty($settings['overlay']) && $settings['overlay'] != 'none' ){
					$image_atts['image-overlay'] = true;

					if( $settings['overlay'] != 'icon-hover' ){
						$image_atts['image-overlay-content']  = '';
						if( strpos($settings['overlay'], 'title') !== false && !empty($image_info['title']) ){
							$image_atts['image-overlay-content'] .= '<span class="gdlr-core-image-overlay-title gdlr-core-title-font" >' . gdlr_core_text_filter($image_info['title']) . '</span>';
						}
						if( strpos($settings['overlay'], 'caption') !== false && !empty($image_info['caption']) ){
							$image_atts['image-overlay-content'] .= '<span class="gdlr-core-image-overlay-caption gdlr-core-info-font" >' . gdlr_core_text_filter($image_info['caption']) . '</span>';
						}

						$alignment = substr($settings['overlay'], 0, strpos($settings['overlay'], '-'));
						$image_atts['image-overlay-class']  = ' gdlr-core-gallery-image-overlay gdlr-core-' . $alignment . '-align';
						$image_atts['image-overlay-class'] .= (!empty($settings['overlay-on-hover']) && $settings['overlay-on-hover'] == 'disable')? ' gdlr-core-no-hover': '';
					}

					if( !empty($settings['overlay-color']) ){
						if( empty($settings['overlay-opacity']) ){
							$settings['overlay-opacity'] = 1;
						}
						$image_atts['image-overlay-background'] = array($settings['overlay-color'], $settings['overlay-opacity']);
					}
				}

				return gdlr_core_get_image($image['id'], $settings['thumbnail-size'], $image_atts);

			}
			
		} // gdlr_core_pb_element_gallery
	} // class_exists	

	add_action('wp_ajax_gdlr_core_gallery_ajax', 'gdlr_core_gallery_ajax');
	add_action('wp_ajax_nopriv_gdlr_core_gallery_ajax', 'gdlr_core_gallery_ajax');
	if( !function_exists('gdlr_core_gallery_ajax') ){
		function gdlr_core_gallery_ajax(){

			if( !empty($_POST['settings']) ){

				$settings = $_POST['settings'];
				if( !empty($_POST['option']) ){	
					$settings[$_POST['option']['name']] = $_POST['option']['value'];
				}

				// print gallery content
				$paged = intval($settings['paged']);
				$show_amount = intval($settings['show-amount']);
				$start = ($paged - 1) * $show_amount;
				$galleries = array_slice($settings['gallery'], $start, $show_amount);

				$content = '';
				$g_column_count = 0;
				$g_column = 60 / intval($settings['column']);
				$lightbox_group = gdlr_core_image_group_id(); 

				foreach( $galleries as $image ){
					if( $settings['style'] == 'stack-image' ){
						$content .= '<div class="gdlr-core-item-list gdlr-core-item-mgb" >';
					}else{
						$column_class  = ' gdlr-core-column-' . $g_column;
						$column_class .= ($g_column_count % 60 == 0)? ' gdlr-core-column-first': '';
						$column_class .= ($settings['style'] == 'grid')? ' gdlr-core-item-pdlr gdlr-core-item-mgb': '';

						$content .= '<div class="gdlr-core-item-list gdlr-core-gallery-column ' . esc_attr($column_class) . '" >';

						$g_column_count += $g_column;
					}

					$content .= '<div class="gdlr-core-gallery-list gdlr-core-media-image" ' . gdlr_core_esc_style(array(
						'border-radius' => empty($settings['border-radius'])? '': $settings['border-radius']
					)) . ' >';
					$content .= gdlr_core_pb_element_gallery::get_gallery_image($image, $settings, $lightbox_group);
					$content .= '</div>'; // gdlr-core-gallery-list
					if( $settings['show-caption'] == 'enable' ){
						$caption = gdlr_core_get_image_info($image['id'], 'caption');
						if( !empty($caption) ){
							$content .= '<div class="gdlr-core-gallery-caption gdlr-core-info-font" >' . gdlr_core_text_filter($caption) . '</div>';
						}
					}
					$content .= '</div>'; // gdlr-core-gallery-column
				}

				$ret = array(
					'status'=> 'success',
					'content'=> $content
				);
				if( !empty($settings['pagination']) && $settings['pagination'] != 'none' ){
					if( $settings['pagination'] == 'load-more' ){
						$paged = $paged + 1;
						$ret['load_more'] = gdlr_core_get_ajax_load_more('gallery', $settings, $paged, $settings['max_num_pages'], 'gdlr-core-gallery-item-holder', $settings['pagination-class']);
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

		} // gdlr_core_post_load_more
	} // function_exists	

	// [gallery ids="875,874,873,876,877" orderby="rand" source="gdlr-core" style="slider" slider-navigation="bullet" ]
	add_filter('post_gallery', 'gdlr_core_gallery_shortcode', 11, 2);
	if( !function_exists('gdlr_core_gallery_shortcode') ){
		function gdlr_core_gallery_shortcode($string, $atts){
			if( empty($atts['source']) || $atts['source'] != 'gdlr-core' ) return;

			$atts = wp_parse_args($atts, array());

			$ids = explode(',', $atts['ids']);
			$lightbox_group = gdlr_core_image_group_id();

			if( $atts['style'] == 'grid-fixed' ){
				$item_class = ' gdlr-core-gallery-shortcode-item gdlr-core-media-image ';

				$ret  = '<div class="gdlr-core-gallery-shortcode-grid-fixed clearfix" >';
				for( $i = 0; $i < sizeOf($ids); $i += 4 ) {
					if( !empty($ids[$i]) ){
						$ret .= '<div class="' . esc_attr($item_class) . ' gdlr-core-first" >';
						$ret .= '<a ' . gdlr_core_get_lightbox_atts(array('url' => wp_get_attachment_image_url($ids[$i], 'full'), 'group' => $lightbox_group)) . ' >';
						$ret .= gdlr_core_get_cropped_image($ids[$i], 500, 692);
						$ret .= '</a>';
						$ret .= '</div>';
					}
					if( !empty($ids[$i + 1]) ){
						$ret .= '<div class="gdlr-core-gallery-shortcode-item-right" >';
						$ret .= '<div class="' . esc_attr($item_class) . ' gdlr-core-second" >';
						$ret .= '<a ' . gdlr_core_get_lightbox_atts(array('url' => wp_get_attachment_image_url($ids[$i + 1], 'full'), 'group' => $lightbox_group)) . ' >';
						$ret .= gdlr_core_get_cropped_image($ids[$i + 1], 500, 346);
						$ret .= '</a>';
						$ret .= '</div>';
						if( !empty($ids[$i + 2]) ){
							$ret .= '<div class="' . esc_attr($item_class) . ' gdlr-core-third" >';
							$ret .= '<a ' . gdlr_core_get_lightbox_atts(array('url' => wp_get_attachment_image_url($ids[$i + 2], 'full'), 'group' => $lightbox_group)) . ' >';
							$ret .= gdlr_core_get_cropped_image($ids[$i + 2], 500, 346);
							$ret .= '</a>';
							$ret .= '</div>';
						}
						if( !empty($ids[$i + 3]) ){
							$ret .= '<div class="' . esc_attr($item_class) . ' gdlr-core-fourth" >';
							$ret .= '<a ' . gdlr_core_get_lightbox_atts(array('url' => wp_get_attachment_image_url($ids[$i + 3], 'full'), 'group' => $lightbox_group)) . ' >';
							$ret .= gdlr_core_get_cropped_image($ids[$i + 3], 1000, 346);
							$ret .= '</a>';
							$ret .= '</div>';
						}
						$ret .= '</div>';
					}
				} 
				$ret .= '</div>'; // gdlr-core-gallery-shortcode-grid-fixed

			}else{
				
				$gallery = array();
				foreach( $ids as $id ){
					$gallery[] = array( 'id' => $id );
				}

				$atts['gallery'] = $gallery;
				$atts['padding-bottom'] = '0px';
	 
				$ret  = '<div class="gdlr-core-gallery-shortcode-wrap gdlr-core-item-rvpdlr" >';
				$ret .= gdlr_core_pb_element_gallery::get_content($atts);
				$ret .= '</div>';
			}
			return $ret;
		}
	}