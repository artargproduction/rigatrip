<?php 
	/*	
	*	Goodlayers Maintenance File
	*	---------------------------------------------------------------------
	*	This file contains the script that handles the maintenance mode
	*	---------------------------------------------------------------------
	*/

	// modify front page query
	add_action('pre_get_posts', 'traveltour_maintenance_query');
	if( !function_exists('traveltour_maintenance_query') ){
		function traveltour_maintenance_query( $query ){

			if( !$query->is_main_query() ) return $query; 

			global $pagenow;

			$maintenance = traveltour_get_option('plugin', 'enable-maintenance', 'disable');
			if( $maintenance == 'disable' || is_user_logged_in() || $pagenow == 'wp-login.php' || is_admin() ) return;

			// if at front page
			if( is_home() || (get_option('show_on_front') == 'page' && $query->get('page_id') == get_option('page_on_front')) ){
				$maintenance_page = traveltour_get_option('plugin', 'maintenance-page', '');
				
				if( !empty($maintenance_page) ){
					
					$query->set('page_id', $maintenance_page);
					$query->set('post_type', 'page');
					$query->is_home = 0;
					$query->is_page = 1;
					$query->is_singular = 1;

					add_filter('template_include', 'traveltour_maintenance_template', 99999);
				}
			}else{
				wp_redirect(home_url('/'));
				exit;
			}

			return $query;
		}
	}

	// set maintenance page template
	if( !function_exists('traveltour_maintenance_template') ){
		function traveltour_maintenance_template( $template ){
			return get_page_template();
		}
	}