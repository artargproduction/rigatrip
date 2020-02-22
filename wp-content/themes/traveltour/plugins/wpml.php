<?php 
	/*	
	*	Goodlayers File For WPML Support
	*/
	
	if( !function_exists('traveltour_get_wpml_flag') ){
		function traveltour_get_wpml_flag( $style = 'icon' ){
			$ret = '';
			
			if( function_exists('icl_get_languages') ){
				$languages = icl_get_languages('skip_missing=1');
				
				if( !empty($languages) ){
					if( $style == 'icon' ){
						$ret .= '<span class="traveltour-custom-wpml-flag" >';
						foreach($languages as $language_slug => $language){
							$ret .= '<span class="traveltour-custom-wpml-flag-item traveltour-language-code-' . esc_attr($language_slug) . '" >';
							$ret .= '<a href="' . esc_url($language['url']) . '" >';
							if( !empty($language['country_flag_url']) ){
								$ret .= '<img src="' . esc_url($language['country_flag_url']) . '" alt="' . esc_attr($language_slug) . '" width="18" height="12" />';
							}else{
								$ret .= '<span class="traveltour-head">' . gdlr_core_escape_content($language['native_name']) . '</span>';
							}
							$ret .= '</a>';
							$ret .= '</span>';
						}
						$ret .= '</span>';
					}else if( $style == 'dropdown' ){
						$ret .= '<span class="traveltour-dropdown-wpml-flag" id="traveltour-dropdown-wpml-flag" >';
						$ret .= '<span class="traveltour-dropdown-wpml-flag-background" ></span>';
						$ret .= '<span class="traveltour-dropdown-wpml-current-language" >' . ICL_LANGUAGE_NAME .  '</span>';
						$ret .= '<span class="traveltour-dropdown-wpml-list" >';
						foreach($languages as $language_slug => $language){
							if( $language['language_code'] != ICL_LANGUAGE_CODE ){
								$ret .= '<span class="traveltour-dropdown-wpml-item" >';
								$ret .= '<a href="' . esc_url($language['url']) . '" >';
								$ret .= $language['native_name'];
								$ret .= '</a>';
								$ret .= '</span>';
							}
						}
						$ret .= '</span>';
						$ret .= '</span>';
					}
				}
			}
			
			return $ret;
		}
	}