(function($){
	$(document).ready(function(){
		RankMathApp.registerPlugin('goodlayers-core');
		wp.hooks.addFilter('rank_math_content', 'goodlayers-core', function(content){
			$('#gdlr-core-page-builder').find('.gdlr-core-page-builder-item-container-preview').each(function(){
				content += $(this).children().not('script, style').html();
			});

			return content;
		});
	});
})(jQuery);