<?php
/**
 * The template part for displaying blog archive
 */

	global $wp_query;



	$settings = array(
		'query' => $wp_query,
		'thumbnail-size' => traveltour_get_option('general', 'woocommerce-archive-thumbnail', 'full'),
		'column-size' => traveltour_get_option('general', 'woocommerce-archive-column-size', '20'),

		'paged' => (get_query_var('paged'))? get_query_var('paged') : 1,
		'pagination' => 'page',
		'pagination-style' => traveltour_get_option('general', 'pagination-style', 'round'),
		'pagination-align' => traveltour_get_option('general', 'pagination-align', 'right'),

	);

	echo '<div class="traveltour-content-area" >';
	if( is_tax('product_cat') ){
		$tax_description = term_description(NULL, 'product_cat');
		if( !empty($tax_description) ){
			echo '<div class="traveltour-archive-taxonomy-description traveltour-item-pdlr" >' . $tax_description . '</div>';
		}
	}else if( is_tax('product_tag') ){
		$tax_description = term_description(NULL, 'product_tag');
		if( !empty($tax_description) ){
			echo '<div class="traveltour-archive-taxonomy-description traveltour-item-pdlr" >' . $tax_description . '</div>';
		}
	}

	echo gdlr_core_pb_element_product::get_content($settings);
	echo '</div>'; // traveltour-content-area