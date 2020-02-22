<?php
/**
 * The main template file
 */

	get_header();

	echo '<div class="traveltour-content-container traveltour-container">';
	echo '<div class="traveltour-sidebar-style-none" >'; // for max width

	get_template_part('content/archive', 'default');

	echo '</div>'; // traveltour-content-area
	echo '</div>'; // traveltour-content-container

	get_footer(); 
