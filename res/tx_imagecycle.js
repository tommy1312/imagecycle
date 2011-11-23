
<!-- ###TEMPLATE_JS### begin -->
jQuery(document).ready(function() {
	<!-- ###CONTROL### -->
	play_class = 'play';
	jQuery('####KEY###').after('<div class="imagecycle-controller" id="###KEY###_controller"><ul><li class="first"><a id="###KEY###_first"></a></li><li class="prev"><a id="###KEY###_prev"></a></li><li class="pause<!-- ###PAUSED### --> '+play_class+'<!-- ###PAUSED### -->"><a id="###KEY###_pause"></a></li><li class="next"><a id="###KEY###_next"></a></li><li class="last"><a id="###KEY###_last"></a></li></ul></div>');
	jQuery('####KEY###_pause').click(function() {
		_parent = jQuery(this).parent();
		if(_parent.hasClass(play_class)) {
			_parent.removeClass(play_class);
			jQuery('####KEY###').cycle('resume');
		} else {
			_parent.addClass(play_class);
			jQuery('####KEY###').cycle('pause');
		}
	});
	jQuery('####KEY###_first').click(function() {
		jQuery('####KEY###').cycle(0);
	});
	jQuery('####KEY###_last').click(function() {
		options = jQuery('####KEY###').data('cycle.opts');
		jQuery('####KEY###').cycle(options.elements.length - 1);
	});
	<!-- ###CONTROL### -->
	<!-- ###SLOW_CONNECTION_BEFORE### -->jQuery(window).load(function() {<!-- ###SLOW_CONNECTION_BEFORE### -->
	jQuery('####KEY###').show().cycle({
		###OPTIONS###
		<!-- ###CONTROL_OPTIONS### -->
		next: '####KEY###_next',
		prev: '####KEY###_prev'
		<!-- ###CONTROL_OPTIONS### -->
	});
	<!-- ###PAUSED_BEGIN### -->
	jQuery('####KEY###').cycle('pause');
	<!-- ###PAUSED_BEGIN### -->
	<!-- ###ONLY_ONE_IMAGE### -->
	jQuery('####KEY###').css('width', jQuery('####KEY### img').css('width'));
	jQuery('####KEY### ###CAPTION_TAG###').show();
	<!-- ###ONLY_ONE_IMAGE### -->
	jQuery('####KEY###').parent().css('width', jQuery('####KEY###').css('width'));
	<!-- ###PAGER### -->
	jQuery('####KEY###_pager a').each(function() {
		jQuery(this).click(function() {
			jQuery('####KEY###').cycle(parseInt(jQuery(this).attr('rev')));
			return false;
		});
	});
	options = jQuery('####KEY###').data('cycle.opts');
	jQuery('####KEY###_pager a[rev='+(options.currSlide)+']').addClass('activeSlide');
	<!-- ###PAGER### -->
	<!-- ###SLOW_CONNECTION_AFTER### -->});<!-- ###SLOW_CONNECTION_AFTER### -->
	<!-- ###CONTROL_AFTER### -->
	jQuery('####KEY###').parent().hover(function(){
		jQuery('####KEY###_controller').stop(true,true).fadeIn('fast');
	}, function(){
		jQuery('####KEY###_controller').stop(true,true).fadeOut('fast');
	});
	<!-- ###CONTROL_AFTER### -->
	<!-- ###SHOW_CAPTION_AT_START### -->
	jQuery('###CAPTION_TAG###', jQuery('####KEY###')).show();
	<!-- ###SHOW_CAPTION_AT_START### -->
});
<!-- ###TEMPLATE_JS### end -->


<!-- ###TEMPLATE_ACTIVATE_PAGER_JS### end -->
jQuery('####KEY###_pager a').removeClass('activeSlide');jQuery('####KEY###_pager a[rev='+(o.currSlide)+']').addClass('activeSlide');
<!-- ###TEMPLATE_ACTIVATE_PAGER_JS### end -->




<!-- ###TEMPLATE_COINSLIDER_JS### begin -->
jQuery(document).ready(function() {
	jQuery('####KEY###').show().coinslider({
		###OPTIONS###
	});
});
<!-- ###TEMPLATE_COINSLIDER_JS### end -->




<!-- ###TEMPLATE_NIVOSLIDER_JS### begin -->
jQuery(document).ready(function() {
	jQuery('####KEY###').parent().show();
	jQuery('####KEY###').nivoSlider({
		###OPTIONS###
	});
});
<!-- ###TEMPLATE_NIVOSLIDER_JS### end -->




<!-- ###TEMPLATE_CROSSSLIDER_JS### begin -->
jQuery(document).ready(function() {
	jQuery('####KEY###').show().crossSlide({
		###OPTIONS###
	}, ###IMAGES###, function(idx, img, idxOut, imgOut) {
		var $caption = jQuery('.tx-imagecycle-pi4 .caption');
		if (idxOut == undefined && img.alt) {
			$caption.css({
				display: 'block',
				opacity: 0
			});
			$caption.html(img.alt).fadeTo('slow', 0.7);
		} else {
			$caption.fadeOut();
		}
	});
	jQuery('####KEY###').parent().css({
		'width': jQuery('####KEY###').width(),
		'height': jQuery('####KEY###').height()
	});
});
<!-- ###TEMPLATE_CROSSSLIDER_JS### end -->




<!-- ###TEMPLATE_SLICEBOX_JS### begin -->
jQuery(document).ready(function() {
	jQuery('####KEY###').slicebox({
		###OPTIONS###
	});
});
<!-- ###TEMPLATE_SLICEBOX_JS### end -->

