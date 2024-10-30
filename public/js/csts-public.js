(function($) {
	"use strict";

	/*=================== Countdown ===================*/
	$('[data-countdown]').each(function () {
		var $this = $(this),
			finalDate = $(this).data('countdown');
		$this.countdown(finalDate, function (event) {
			$this.html(event.strftime('<div class="countdown-container"><div class="countdown-box day"><span>Day%!d</span><div class="box-r"><div class="countdown-content"><div class="number">%-D</div></div></div></div>' + '<div class="countdown-box hour"><span>Hours</span><div class="box-r"><div class="countdown-content"><div class="number">%H</div></div></div></div>' + '<div class="countdown-box min"><div class="box-r"><div class="countdown-content"><div class="number">%M</div></div></div><span>Minutes</span></div>' + '<div class="countdown-box sec"><div class="box-r"><div class="countdown-content"><div class="number">%S</div></div></div><span>Seconds</span></div>'));
		});
	});

	/*=================== One Page Scrolling ===================*/
	$(".navbar-nav a.nav-link").click(function(){
		var $anchor = $(this);
		$anchor.parent().addClass("active").siblings().removeClass("active");
		$($anchor.attr('href')).addClass("show").siblings().removeClass("show");
	});

	/*=================== Load image ===================*/
	$('[data-bg]').each(function () {
		var imgUrl = $(this).data('bg');
		$(this).css({
			'background': 'url("' + imgUrl + '")'
		});
	});

	/*=================== Load blog content in popup box ===================*/
	$(".close-button").click(function(){
		$(".single-blog-popup-wrapper").removeClass('active');
	});

	$(".csts-page-wrapper .blog-post, .overlay-btn a").click(function () {
		$(".single-blog-popup-wrapper").addClass('active');

		var id = $(this).data('id');

		$.ajax({
			type: 'POST',
			url: csts_content.ajaxurl,
			data: {
				'action' : csts_content.action,
				'nonce': csts_content.nonce,
				'id': id
			},
			dataType: 'json',
			beforeSend: function() {
				$(".loading").fadeIn('fast');
				$(".single-blog-content").fadeOut('fast');
			},
			success: function(data) {
				if(data['success']) {
					$(".single-blog-content .title span").html(new Date(data['post'].post_date).toLocaleString());
					$(".single-blog-content .title h1").html(data['post'].post_title);
					$(".single-blog-content p").html(data['post'].post_content);

					$(".loading").fadeOut('slow');
					$(".single-blog-content").fadeIn('fast');
				} else {
					alert("Something went wrong, please try again later");
				}

			}
		});
	});
})(jQuery);