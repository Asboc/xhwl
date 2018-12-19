	</div><!-- .site-content -->
	<div class="clear"></div>
	<?php if (zm_get_option('footer_link')) { ?>
		<?php get_template_part( 'template/footer-links' ); ?>
	<?php } ?>
	<?php get_template_part( 'template/footer-widget' ); ?>
	<p style="text-align:center;color:green">查询次数 <?php echo get_num_queries();?> 次，总耗时 <?php timer_stop(1); ?> 秒。</p>
<div id="chakhsu"  style="text-align:center;color:green"></div> <script>var chakhsu = function (r) {
        function t() {
            return b[Math.floor(Math.random() * b.length)]
        }
        function e() {
            return String.fromCharCode(94 * Math.random() + 33)
        }
        function n(r) {
            for (var n = document.createDocumentFragment(), i = 0; r > i; i++) {
                var l = document.createElement("span");
                l.textContent = e(), l.style.color = t(), n.appendChild(l)
            }
            return n
        }
        function i() {
            var t = o[c.skillI];
            c.step ? c.step-- : (c.step = g, c.prefixP < l.length ? (c.prefixP >= 0 && (c.text += l[c.prefixP]), c.prefixP++) : "forward" === c.direction ? c.skillP < t.length ? (c.text += t[c.skillP], c.skillP++) : c.delay ? c.delay-- : (c.direction = "backward", c.delay = a) : c.skillP > 0 ? (c.text = c.text.slice(0, -1), c.skillP--) : (c.skillI = (c.skillI + 1) % o.length, c.direction = "forward")), r.textContent = c.text, r.appendChild(n(c.prefixP < l.length ? Math.min(s, s + c.prefixP) : Math.min(s, t.length - c.skillP))), setTimeout(i, d)
        }
        /*以下内容自定义修改*/
        var l = "生命",
            o = ["不会带给你什么，而是你留给你的生命什么！", ].map(function (r) {
                return r + ""
            }), a = 2, g = 1, s = 5, d = 75,
            b = ["rgb(110,64,170)", "rgb(150,61,179)", "rgb(191,60,175)", "rgb(228,65,157)", "rgb(254,75,131)", "rgb(255,94,99)", "rgb(255,120,71)", "rgb(251,150,51)", "rgb(226,183,47)", "rgb(198,214,60)", "rgb(175,240,91)", "rgb(127,246,88)", "rgb(82,246,103)", "rgb(48,239,130)", "rgb(29,223,163)", "rgb(26,199,194)", "rgb(35,171,216)", "rgb(54,140,225)", "rgb(76,110,219)", "rgb(96,84,200)"],
            c = {text: "", prefixP: -s, skillI: 0, skillP: 0, direction: "forward", delay: a, step: g};
        i()
    };
    chakhsu(document.getElementById('chakhsu'));</script>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php echo zm_get_option('footer_inf_t'); ?>
			<span class="add-info">
				<?php echo zm_get_option('footer_inf_b'); ?>
				<?php echo zm_get_option('tongji_f'); ?>
			</span>
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->
<?php if (zm_get_option('login')) { ?>
<?php get_template_part( 'template/login' ); ?>
<?php } ?>
<?php get_template_part( 'template/scroll' ); ?>
<?php get_template_part( 'template/the-blank' ); ?>
<?php if (zm_get_option('weibo_t')) { ?>
	<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
	<html xmlns:wb="http://open.weibo.com/wb">
<?php } ?>
</div><!-- .site -->
<?php wp_footer(); ?>
</body>
</html>