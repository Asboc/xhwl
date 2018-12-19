(function() {
	tinymce.create('tinymce.plugins.MyButtons', {
		init : function(ed, url) {

			ed.addButton( 'down', {
				title : '弹窗下载链接',
				image : '', 
				text: '',
				icon: 'nonbreaking',
				onclick : function() {
					ed.selection.setContent('[button]' + ed.selection.getContent() + '按钮名称[/button]');
				}
			});
		
			ed.addButton( 'url', {
				title : '链接按钮',
				icon: 'newtab',
				onclick : function() {
					ed.selection.setContent('[url href=' + ed.selection.getContent() + '链接地址]按钮名称[/url]');
				}
			});

			ed.addButton( 'videos', {
				title : '添加视频',
				icon: 'media',
				onclick : function() {
					ed.selection.setContent('[videos href=视频代码]图片链接' + ed.selection.getContent() + '[/videos]');
				}
			});

			ed.addButton( 'img', {
				title : '添加相册',
				icon: 'image',
				onclick : function() {
					ed.selection.setContent('[img]插入图片' + ed.selection.getContent() + '[/img]');
				}
			});

			ed.addButton( 'slide', {
				title : '添加幻灯(可自定义高度)',
				icon: 'image',
				onclick : function() {
					ed.selection.setContent('[slide h=高度]插入图片' + ed.selection.getContent() + '[/slide]');
				}
			});


			ed.addButton( 'reply', {
				title : '回复可见',
				icon: 'bubble',
				onclick : function() {
					ed.selection.setContent('[reply]隐藏的内容' + ed.selection.getContent() + '[/reply]');
				}
			});

			ed.addButton( 'login', {
				title : '登录可见',
				icon: 'user',
				onclick : function() {
					ed.selection.setContent('[login]隐藏的内容' + ed.selection.getContent() + '[/login]');
				}
			});

			ed.addButton( 'password', {
				title : '密码保护',
				icon: 'lock',
				onclick : function() {
					ed.selection.setContent('[password key=密码]' + ed.selection.getContent() + '加密的内容[/password]');
				}
			});

			ed.addButton( 'addcode', {
				title : '添加代码',
				icon: 'code',
				onclick : function() {
					ed.selection.setContent('[code]' + ed.selection.getContent() + '[/code]');
				}
			});

			ed.addButton( 'addfolding', {
				title : '文字折叠',
				icon: 'pluscircle',
				onclick : function() {
					ed.selection.setContent('[s][p]<p>隐藏的文字</p>' + ed.selection.getContent() + '<p>[/p]</p>');
				}
			});

			ed.addButton( 'field', {
				title : 'fieldset标签',
				icon: 'template',
				onclick : function() {
					ed.selection.setContent('<fieldset><legend>我是标题</legend>这里是内容</fieldset>' + ed.selection.getContent() + '');
				}
			});

			ed.addButton( 'ad', {
				title : '插入广告',
				icon: 'fill',
				onclick : function() {
					ed.selection.setContent('[ad]' + ed.selection.getContent() + '');
				}
			});

		},
		createControl : function(n, cm) {
			return null;
		},
	});

	tinymce.PluginManager.add( 'begin_button_script', tinymce.plugins.MyButtons );
})();