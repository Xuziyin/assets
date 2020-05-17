	function ac() {
		$body = $('html,body');
		var g = '.comment-list',
			h = '.comment-num',
			i = '.comment-reply a',
			wi = '.whisper-reply',
			j = '#textarea',
			k = '',
			l = '';
		c();
		$('#comment-form').submit(function() {
			$.ajax({
				url: $(this).attr('action'),
				type: 'post',
				data: $(this).serializeArray(),
				error: function() {
					alert("提交失败，请检查网络并重试或者联系管理员。");
					return false
				},
				success: function(d) {
					if (!$(g, d).length) {
						alert("您输入的内容不符合规则或者回复太频繁，请修改内容或者稍等片刻。");
						return false
					} else {
						k = $(g, d).html().match(/id=\"?comment-\d+/g).join().match(/\d+/g).sort(function(a, b) {
							return a - b
						}).pop();
						if ($('.page-navigator .prev').length && l == "") {
							k = ''
						}
						if (l) {
							d = $('#li-comment-' + k, d).hide();
							if ($('#' + l).find(".comment-children").length <= 0) {
								$('#' + l).append("<div class='comment-children'><ol class='comment-list'><\/ol><\/div>")
							}
							if (k) $('#' + l + " .comment-children .comment-list").prepend(d);
							l = ''
						} else {
							d = $('#li-comment-' + k, d).hide();
							if (!$(g).length) $('#comments').prepend(
								"<h3>已有 <span class='comment-num'>0<\/span> 条评论<\/h3><ol class='comment-list'><\/ol>");
							$(g).prepend(d)
						}
						$('#li-comment-' + k).fadeIn();
						var f;
						$(h).length ? (f = parseInt($(h).text().match(/\d+/)), $(h).html($(h).html().replace(f, f + 1))) : 0;
						TypechoComment.cancelReply();
						$(j).val('');
						$(i + ',' + wi + ', #cancel-comment-reply-link').unbind('click');
						c();
						if (k) {
							$body.animate({
								scrollTop: $('#li-comment-' + k).offset().top - 50
							}, 300)
						} else {
							$body.animate({
								scrollTop: $('#comments').offset().top - 50
							}, 300)
						}
					}
				}
			});
			return false
		});
	
		function c() {
			$(i + ',' + wi).click(function() {
				l = $(this).parent().parent().parent().attr("id")
			});
			$('#cancel-comment-reply-link').click(function() {
				l = ''
			})
		}
	};
ac();