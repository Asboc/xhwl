!function(a,b){"use strict";"function"==typeof define&&define.amd?define([],b):"object"==typeof exports?module.exports=b():a.Headroom=b()}(this,function(){"use strict";function a(a){this.callback=a,this.ticking=!1}function b(a){return a&&"undefined"!=typeof window&&(a===window||a.nodeType)}function c(a){if(arguments.length<=0)throw new Error("Missing arguments in extend function");var d,e,f=a||{};for(e=1;e<arguments.length;e++){var g=arguments[e]||{};for(d in g)"object"!=typeof f[d]||b(f[d])?f[d]=f[d]||g[d]:f[d]=c(f[d],g[d])}return f}function d(a){return a===Object(a)?a:{down:a,up:a}}function e(a,b){b=c(b,e.options),this.lastKnownScrollY=0,this.elem=a,this.tolerance=d(b.tolerance),this.classes=b.classes,this.offset=b.offset,this.scroller=b.scroller,this.initialised=!1,this.onPin=b.onPin,this.onUnpin=b.onUnpin,this.onTop=b.onTop,this.onNotTop=b.onNotTop,this.onBottom=b.onBottom,this.onNotBottom=b.onNotBottom}var f={bind:!!function(){}.bind,classList:"classList"in document.documentElement,rAF:!!(window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame)};return window.requestAnimationFrame=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame,a.prototype={constructor:a,update:function(){this.callback&&this.callback(),this.ticking=!1},requestTick:function(){this.ticking||(requestAnimationFrame(this.rafCallback||(this.rafCallback=this.update.bind(this))),this.ticking=!0)},handleEvent:function(){this.requestTick()}},e.prototype={constructor:e,init:function(){return e.cutsTheMustard?(this.debouncer=new a(this.update.bind(this)),this.elem.classList.add(this.classes.initial),setTimeout(this.attachEvent.bind(this),100),this):void 0},destroy:function(){var a=this.classes;this.initialised=!1,this.elem.classList.remove(a.unpinned,a.pinned,a.top,a.notTop,a.initial),this.scroller.removeEventListener("scroll",this.debouncer,!1)},attachEvent:function(){this.initialised||(this.lastKnownScrollY=this.getScrollY(),this.initialised=!0,this.scroller.addEventListener("scroll",this.debouncer,!1),this.debouncer.handleEvent())},unpin:function(){var a=this.elem.classList,b=this.classes;!a.contains(b.pinned)&&a.contains(b.unpinned)||(a.add(b.unpinned),a.remove(b.pinned),this.onUnpin&&this.onUnpin.call(this))},pin:function(){var a=this.elem.classList,b=this.classes;a.contains(b.unpinned)&&(a.remove(b.unpinned),a.add(b.pinned),this.onPin&&this.onPin.call(this))},top:function(){var a=this.elem.classList,b=this.classes;a.contains(b.top)||(a.add(b.top),a.remove(b.notTop),this.onTop&&this.onTop.call(this))},notTop:function(){var a=this.elem.classList,b=this.classes;a.contains(b.notTop)||(a.add(b.notTop),a.remove(b.top),this.onNotTop&&this.onNotTop.call(this))},bottom:function(){var a=this.elem.classList,b=this.classes;a.contains(b.bottom)||(a.add(b.bottom),a.remove(b.notBottom),this.onBottom&&this.onBottom.call(this))},notBottom:function(){var a=this.elem.classList,b=this.classes;a.contains(b.notBottom)||(a.add(b.notBottom),a.remove(b.bottom),this.onNotBottom&&this.onNotBottom.call(this))},getScrollY:function(){return void 0!==this.scroller.pageYOffset?this.scroller.pageYOffset:void 0!==this.scroller.scrollTop?this.scroller.scrollTop:(document.documentElement||document.body.parentNode||document.body).scrollTop},getViewportHeight:function(){return window.innerHeight||document.documentElement.clientHeight||document.body.clientHeight},getElementPhysicalHeight:function(a){return Math.max(a.offsetHeight,a.clientHeight)},getScrollerPhysicalHeight:function(){return this.scroller===window||this.scroller===document.body?this.getViewportHeight():this.getElementPhysicalHeight(this.scroller)},getDocumentHeight:function(){var a=document.body,b=document.documentElement;return Math.max(a.scrollHeight,b.scrollHeight,a.offsetHeight,b.offsetHeight,a.clientHeight,b.clientHeight)},getElementHeight:function(a){return Math.max(a.scrollHeight,a.offsetHeight,a.clientHeight)},getScrollerHeight:function(){return this.scroller===window||this.scroller===document.body?this.getDocumentHeight():this.getElementHeight(this.scroller)},isOutOfBounds:function(a){var b=0>a,c=a+this.getScrollerPhysicalHeight()>this.getScrollerHeight();return b||c},toleranceExceeded:function(a,b){return Math.abs(a-this.lastKnownScrollY)>=this.tolerance[b]},shouldUnpin:function(a,b){var c=a>this.lastKnownScrollY,d=a>=this.offset;return c&&d&&b},shouldPin:function(a,b){var c=a<this.lastKnownScrollY,d=a<=this.offset;return c&&b||d},update:function(){var a=this.getScrollY(),b=a>this.lastKnownScrollY?"down":"up",c=this.toleranceExceeded(a,b);this.isOutOfBounds(a)||(a<=this.offset?this.top():this.notTop(),a+this.getViewportHeight()>=this.getScrollerHeight()?this.bottom():this.notBottom(),this.shouldUnpin(a,c)?this.unpin():this.shouldPin(a,c)&&this.pin(),this.lastKnownScrollY=a)}},e.options={tolerance:{up:0,down:0},offset:0,scroller:window,classes:{pinned:"headroom--pinned",unpinned:"headroom--unpinned",top:"headroom--top",notTop:"headroom--not-top",bottom:"headroom--bottom",notBottom:"headroom--not-bottom",initial:"headroom",use:"y529"}},e.cutsTheMustard="undefined"!=typeof f&&f.rAF&&f.bind&&f.classList,e});
(function($){if(!$){return}$.fn.headroom=function(option){return this.each(function(){var $this=$(this),data=$this.data("headroom"),options=typeof option==="object"&&option;options=$.extend(true,{},Headroom.options,options);if(!data){data=new Headroom(this,options);data.init();$this.data("headroom",data)}if(typeof option==="string"){data[option]();if(option==="destroy"){$this.removeData("headroom")}}})}}(window.jQuery));

$(document).ready(function(){
$("#header-main").headroom({
	"tolerance": 10,
	"offset": 89,
	"classes": {
		"initial": "sliding",
		"pinned": "slideDown",
		"unpinned": "slideUp"
	}
});

$("#group-tab span:first").addClass("group-current");
$("#group-tab .tab-bd-con:gt(0)").hide();
$("#group-tab span").mouseover(function(){
$(this).addClass("group-current").siblings("span").removeClass("group-current");
$("#group-tab .group-tab-bd-con:eq("+$(this).index()+")").show().siblings(".group-tab-bd-con").hide().addClass("group-current");
});

$("#layout-tab span:first").addClass("current");
$("#layout-tab .tab-bd-con:gt(0)").hide();
$("#layout-tab span").mouseover(function(){
$(this).addClass("current").siblings("span").removeClass("current");
$("#layout-tab .tab-bd-con:eq("+$(this).index()+")").show().siblings(".tab-bd-con").hide().addClass("current");
});

$("#img-tab span:first").addClass("img-current");
$("#img-tab .tab-bd-con:gt(0)").hide();
$("#img-tab span").mouseover(function(){
$(this).addClass("img-current").siblings("span").removeClass("img-current");
$("#img-tab .img-tab-bd-con:eq("+$(this).index()+")").show().siblings(".img-tab-bd-con").hide().addClass("img-current");
});

$("#login-tab span:first").addClass("login-current");
$("#login-tab .login-tab-bd-con:gt(0)").hide();
$("#login-tab span").click(function(){
$(this).addClass("login-current").siblings("span").removeClass("login-current");
$("#login-tab .login-tab-bd-con:eq("+$(this).index()+")").show().siblings(".login-tab-bd-con").hide().addClass("login-current");
});

// 位置调整
var divTestJQ = $("#below-main");
var divJQ = $(".sort", divTestJQ);
var EntityList = [];
divJQ.each(function () {
	var thisJQ = $(this);
	EntityList.push({ Name: parseInt(thisJQ.attr("name"), 10), JQ: thisJQ });
});
EntityList.sort(function (a, b) { 
	return a.Name - b.Name;
});
for (var i = 0; i < EntityList.length; i++) {
	EntityList[i].JQ.appendTo(divTestJQ);
};

var divTestJQ = $("#main");
var divJQ = $(".sort", divTestJQ);
var EntityList = [];
divJQ.each(function () {
	var thisJQ = $(this);
	EntityList.push({ Name: parseInt(thisJQ.attr("name"), 10), JQ: thisJQ });
});
EntityList.sort(function (a, b) { 
	return a.Name - b.Name;
});
for (var i = 0; i < EntityList.length; i++) {
	EntityList[i].JQ.appendTo(divTestJQ);
};

var divTestJQ = $("#group-section");
var divJQ = $(".sort", divTestJQ);
var EntityList = [];
divJQ.each(function () {
	var thisJQ = $(this);
	EntityList.push({ Name: parseInt(thisJQ.attr("name"), 10), JQ: thisJQ });
});
EntityList.sort(function (a, b) {
	//return b.Name - a.Name;
	return a.Name - b.Name;
});
for (var i = 0; i < EntityList.length; i++) {
	EntityList[i].JQ.appendTo(divTestJQ);
};

// 搜索
$(".nav-search").click(function() {
	$ (this).toggleClass ("off-search");
	$("#search-main").fadeToggle(300);
});


// 菜单
$(".nav-mobile").click(function() {
	$("#mobile-nav").slideToggle(500);
});

// 引用
$(".backs").click(function() {
	$(".track").slideToggle("slow");
	return false;
});

// 弹出层
$(".qr").mouseover(function() {
	$(this).children(".qr-img").show();
});
$(".qr").mouseout(function() {
	$(this).children(".qr-img").hide();
});

$(".qqonline").mouseover(function() {
	$(this).children(".qqonline-box").show();
})
$(".qqonline").mouseout(function() {
	$(this).children(".qqonline-box").hide();
});

$(".orderby").mouseover(function() {
	$(this).children(".order-box").show();
})
$(".orderby").mouseout(function() {
	$(this).children(".order-box").hide();
});

$(".user-box").mouseover(function() {
	$(this).children(".user-info").show();
})
$(".user-box").mouseout(function() {
	$(this).children(".user-info").hide();
});

// 分享
if(/iphone|ipod|ipad|ipad|mobile/i.test(navigator.userAgent.toLowerCase())){	
	$('.share-sd').click(function() {
		$('#share').animate({
			opacity: 'toggle',
			top: '-80px'
		},
			500).animate({
			top: '-60px'
		},
		'fast');
		return false;
	});
} else {
	$(".share-sd").mouseover(function() {
		$(this).children("#share").show();
	});
	$(".share-sd").mouseout(function() {
		$(this).children("#share").hide();
	});
}

// 关闭
$('.shut-error').click(function() {
	$('.user_error').animate({
		opacity: 'toggle'
	},
	100);
	return false;
});

// 文字展开
$(".show-more span").click(function(e) {
	$(this).html(["<i class='be be-squareplus'></i>展开", "<i class='be be-squareminus'></i>折叠"][this.hutia ^= 1]);
	$(this.parentNode.parentNode).next().slideToggle();
	e.preventDefault();
});

// 滚屏
$('.scroll-h').click(function() {
	$('html,body').animate({
		scrollTop: '0px'
	},
	800);
});
$('.scroll-c').click(function() {
	$('html,body').animate({
		scrollTop: $('.scroll-comments').offset().top
	},
	800);
});
$('.scroll-b').click(function() {
	$('html,body').animate({
		scrollTop: $('.site-info').offset().top
	},
	800);
});

// 去边线
$(".message-widget li:last, .message-page li:last, .hot_commend li:last, .search-page li:last, .my-comment li:last, .message-tab li:last").css("border", "none");

// 表情
$('.emoji').click(function() {
	$('.emoji-box').animate({
		opacity: 'toggle',
		left: '50px'
	},
	1000).animate({
		left: '10px'
	},
	'fast');
	return false;
});

// 登录
$('#login-main, #login-mobile, #login-see').leanModal({
	top: 110,
	overlay: 0.6,
	closeButton: '.hidemodal'
});

// 字号
$("#fontsize").click(function() {
	var _this = $(this);
	var _t = $(".single-content");
	var _c = _this.attr("class");
	if (_c == "size_s") {
		_this.removeClass("size_s").addClass("size_l");
		_this.text("A+");
		_t.removeClass("fontsmall").addClass("fontlarge");
	} else {
		_this.removeClass("size_l").addClass("size_s");
		_this.text("A-");
		_t.removeClass("fontlarge").addClass("fontsmall");
	};
});

// 目录
if (document.body.clientWidth > 1024) {
	$(function() {
		$(window).scroll(function() {
			if ($("#log-box").html() != undefined) {
				var h = $("#title-2").offset().top;
				if ($(this).scrollTop() > h && $(this).scrollTop() < h + 50) {
					$("#log-box").show();
				}
				var h = $("#title-1").offset().top;
				if ($(this).scrollTop() > h && $(this).scrollTop() < h + 50) {
					$("#log-box").hide();
				}
			}
		});
	})
}

$(".log-button, .log-close").click(function() {
	$("#log-box").fadeToggle(300);
});

if ($("#log-box").length > 0) {
	$(".log").removeClass("log-no");
}
$('.log-prompt').show().delay(5000).fadeOut();

// 图片延迟
$(".load img, .single-content img,.avatar").lazyload({
	effect: "fadeIn",
	threshold: 100,
	failure_limit: 70
});
$("#gallery img").lazyload({
	event: "mouseover"
});

// 锚链接
$('#catalog a[href*=#],area[href*=#]').click(function() {
	if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
		var $target = $(this.hash);
		$target = $target.length && $target || $('[name=' + this.hash.slice(1) + ']');
		if ($target.length) {
			var targetOffset = $target.offset().top;
			$('html,body').animate({
				scrollTop: targetOffset
			},
			800);
			return false;
		}
	}
});

// 图片数量
var i = $('.slide-h .fancybox').size();
$('.myimg').html(' ' + i + ' 张图片');

var i = $('.slides-h .fancybox').size();
$('.mimg').html(' ' + i + ' 张图片');

// 标签背景
box_width=$(".single-tag").width();
len=$(".single-tag ul li a").length-1;
$(".single-tag ul li a").each(function(i){
	var let = new Array('c3010a','31ac76','ea4563','31a6a0','8e7daa','4fad7b','f99f13','f85200','666666');
	var random1 = Math.floor(Math.random()*9)+0;
	var  num=Math.floor(Math.random()*6+9);
	$(this).attr('style','background:#'+let[random1]+'');
	if($(this).next().length>0){last=$(this).next().position().left;}
});

// 按钮clear
$(".single-content").find(".down-line:last").css({clear:"both"});

// tab
var $li = $('.zm-tabs-nav span');
var $ul = $('.zm-tabs-container ul');
$li.mouseover(function(){
	var $this = $(this);
	var $t = $this.index();
	$li.removeClass();
	$this.addClass('current');
	$ul.css('display','none');
	$ul.eq($t).css('display','block');
})

// 侧边
$ (".off-side").mouseover (function () {
	$ (this).toggleClass ("on-side");
	$("#sidebar").toggleClass ("sidebar");
	$("#primary").toggleClass ("primary");
})

// 超链接
$(".entry-content p a").each(function() {
    if ($(this).children('img').length <= 0) {
        $(this).append('<sup><i class="be be-anchor"></i></sup>');
    }
});
// 结束
});

$(document).ready(function() {
	$('#tip-w').tipso({
		useTitle: false,
		background: '#f1f1f1'
	});
	$('#tip-w-j').tipso({
		useTitle: false,
		background: '#f1f1f1'
	});
	$('#tip-p').tipso({
		useTitle: false,
		background: '#f1f1f1',
		width: '300px',
		color: '#444'
	});
});

// 评论贴图
function embedImage() {
	var URL = prompt('请输入图片 URL 地址:', 'http://');
	if (URL) {
		document.getElementById('comment').value = document.getElementById('comment').value + '' + URL + '';
	}
};
// 文字滚动
(function($) {
	$.fn.textSlider = function(settings) {
		settings = jQuery.extend({
			speed: "normal",
			line: 2,
			timer: 1000
		},
		settings);
		return this.each(function() {
			$.fn.textSlider.scllor($(this), settings)
		})
	};
	$.fn.textSlider.scllor = function($this, settings) {
		var ul = $("ul:eq(0)", $this);
		var timerID;
		var li = ul.children();
		var _btnUp = $(".up:eq(0)", $this);
		var _btnDown = $(".down:eq(0)", $this);
		var liHight = $(li[0]).height();
		var upHeight = 0 - settings.line * liHight;
		var scrollUp = function() {
			_btnUp.unbind("click", scrollUp);
			ul.animate({
				marginTop: upHeight
			},
			settings.speed,
			function() {
				for (i = 0; i < settings.line; i++) {
					ul.find("li:first").appendTo(ul)
				}
				ul.css({
					marginTop: 0
				});
				_btnUp.bind("click", scrollUp)
			})
		};
		var scrollDown = function() {
			_btnDown.unbind("click", scrollDown);
			ul.css({
				marginTop: upHeight
			});
			for (i = 0; i < settings.line; i++) {
				ul.find("li:last").prependTo(ul)
			}
			ul.animate({
				marginTop: 0
			},
			settings.speed,
			function() {
				_btnDown.bind("click", scrollDown)
			})
		};
		var autoPlay = function() {
			timerID = window.setInterval(scrollUp, settings.timer)
		};
		var autoStop = function() {
			window.clearInterval(timerID)
		};
		ul.hover(autoStop, autoPlay).mouseout();
		_btnUp.css("cursor", "pointer").click(scrollUp);
		_btnUp.hover(autoStop, autoPlay);
		_btnDown.css("cursor", "pointer").click(scrollDown);
		_btnDown.hover(autoStop, autoPlay)
	}
})(jQuery);

// 表情
function grin(a) {
	var d;
	a = " " + a + " ";
	if (document.getElementById("comment") && document.getElementById("comment").type == "textarea") {
		d = document.getElementById("comment")
	} else {
		return false
	}
	if (document.selection) {
		d.focus();
		sel = document.selection.createRange();
		sel.text = a;
		d.focus()
	} else {
		if (d.selectionStart || d.selectionStart == "0") {
			var c = d.selectionStart;
			var b = d.selectionEnd;
			var e = b;
			d.value = d.value.substring(0, c) + a + d.value.substring(b, d.value.length);
			e += a.length;
			d.focus();
			d.selectionStart = e;
			d.selectionEnd = e
		} else {
			d.value += a;
			d.focus()
		}
	}
};

// 弹窗
(function(a) {
	a.fn.extend({
		leanModal: function(d) {
			var e = {
				top: 100,
				overlay: 0.5,
				closeButton: null
			};
			var c = a("<div id='overlay'></div>");
			a("body").append(c);
			d = a.extend(e, d);
			return this.each(function() {
				var f = d;
				a(this).click(function(j) {
					var i = a(this).attr("href");
					a("#overlay").click(function() {
						b(i)
					});
					a(f.closeButton).click(function() {
						b(i)
					});
					var h = a(i).outerHeight();
					var g = a(i).outerWidth();
					a("#overlay").css({
						"display": "block",
						opacity: 0
					});
					a("#overlay").fadeTo(200, f.overlay);
					a(i).css({
						"display": "block",
						"position": "fixed",
						"opacity": 0,
						"z-index": 11000,
						"left": 50 + "%",
						"margin-left": -(g / 2) + "px",
						"top": "40px"
					});
					a(i).fadeTo(200, 1);
					j.preventDefault()
				})
			});
			function b(f) {
				a("#overlay").fadeOut(200);
				a(f).css({
					"display": "none"
				})
			}
		}
	})
})(jQuery);

// 喜欢
$.fn.postLike = function() {
	if (jQuery(this).hasClass("done")) {
		alert('您已赞过啦！');
		return false;
	} else {
		$(this).addClass("done");
		var d = $(this).data("id"),
		c = $(this).data("action"),
		b = jQuery(this).children(".count");
		var a = {
			action: "zm_ding",
			um_id: d,
			um_action: c
		};
		$.post(wpl_ajax_url, a,
		function(e) {
			jQuery(b).html(e)
		});
		return false
	}
};
$(document).on("click", ".dingzan",
function() {
	$(this).postLike()
});

// 打印
var global_Html = "";
function printme() {
	global_Html = document.body.innerHTML;
	document.body.innerHTML = document.getElementById('primary').innerHTML;　　　　　　　　　　　　　　
	window.print();
	window.setTimeout(function() {
		document.body.innerHTML = global_Html;
	}, 500);
}