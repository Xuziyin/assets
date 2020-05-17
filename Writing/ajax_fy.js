var isbool = true;
function ajaxnext() {
	$('.ajaxload li[class!="next"]').remove();
	$(".ajaxload .next a").text("加载更多文章");
	$('.ajaxload .next a').click(function() {
		if (isbool) {
			ajaxpost();
		}
		return false
	})
}
ajaxnext();
function ajaxpost() {
	var a = '.ajaxload .next a',
		b = $(a).attr("href");
	$(a).addClass('loading').text("正在加载");
	if (b) {
		$.ajax({
			url: b,
			error: function() {
				alert('请求失败，请检查网络并重试或者联系管理员');
				$(a).removeAttr("class").text("查看更多");
				return false
			},
			success: function(d) {
				var c = $(d).find("#main .post"),
					e = $(d).find(a).attr("href");
				if (c) {
					$('.ajaxload').before(c)
				};
				$(a).removeAttr("class");
				if (e) {
					$(a).text("查看更多").attr("href", e)
				} else {
					$(a).remove();
					$('.ajaxload .next').text('没有更多文章了')
				}
				if ($('.protected', d).length) {
					$('.protected *').unbind();
					ap()
				}
				isbool = true;
				return false
			}
		})
	}
} 