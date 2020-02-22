<?php

	// use to clear an option for customize page
	if( !function_exists('traveltour_clear_option') ){
		function traveltour_clear_option(){
			$options = array('general', 'typography', 'color', 'plugin');

			foreach( $options as $option ){
				unset($GLOBALS['traveltour_' . $option]);
			}
			
		}
	}