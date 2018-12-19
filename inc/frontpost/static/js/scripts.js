var hasChanged = false;

function confirmExit() {
	var mce = typeof(tinyMCE) != 'undefined' ? tinyMCE.activeEditor : false;
	if (hasChanged || (mce && !mce.isHidden() && mce.isDirty() ))
		return fep_messages.unsaved_changes_warning;
}
window.onbeforeunload = confirmExit;

function substr_count(mainString, subString) {
	var re = new RegExp(subString, 'g');
	if (!mainString.match(re) || !mainString || !subString)
		return 0;
	var count = mainString.match(re);
	return count.length;
}

function str_word_count(s) {
	if (!s.length)
		return 0;
	s = s.replace(/(^\s*)|(\s*$)/gi, "");
	s = s.replace(/[ ]{2,}/gi, " ");
	s = s.replace(/\n /, "\n");
	return s.split(' ').length;
}

function countTags(s) {
	if (!s.length)
		return 0;
	return s.split(',').length;
}

function post_has_errors(title, content, category, tags, fimg) {
	var error_string = '';
	if (fep_rules.check_required == false)
		return false;

	if ((fep_rules.min_words_title != 0 && title === '') || (fep_rules.min_words_content != 0 && content === '') || category == -1 || (fep_rules.min_tags != 0 && tags === ''))
		error_string = fep_messages.required_field_error + '<br/>';

	var stripped_content = content.replace(/(<([^>]+)>)/ig, "");

	if (title != '' && str_word_count(title) < fep_rules.min_words_title)
		error_string += fep_messages.title_short_error + '<br/>';
	if (content != '' && str_word_count(title) > fep_rules.max_words_title)
		error_string += fep_messages.title_long_error + '<br/>';
	if (content != '' && str_word_count(stripped_content) < fep_rules.min_words_content)
		error_string += fep_messages.article_short_error + '<br/>';
	if (str_word_count(stripped_content) > fep_rules.max_words_content)
		error_string += fep_messages.article_long_error + '<br/>';
	if (substr_count(content, '</a>') > fep_rules.max_links)
		error_string += fep_messages.too_many_article_links_error + '<br/>';
	if (tags != '' && countTags(tags) < fep_rules.min_tags)
		error_string += fep_messages.too_few_tags_error + '<br/>';
	if (countTags(tags) > fep_rules.max_tags)
		error_string += fep_messages.too_many_tags_error + '<br/>';
	if (fep_rules.thumbnail_required && fep_rules.thumbnail_required == 'true' && fimg == -1)
		error_string += fep_messages.featured_image_error + '<br/>';

	if (error_string == '')
		return false;
	else
		return '<strong>' + fep_messages.general_form_error + '</strong><br/>' + error_string;
}

jQuery(document).ready(function ($) {
	$("input, textarea, #fep-post-content").keydown(function () {
		hasChanged = true;
	});
	$("select").change(function () {
		hasChanged = true;
	});
	$("td.post-delete a").click(function (event) {
		var id = $(this).siblings('.post-id').first().val();
		var nonce = $('#fepnonce_delete').val();
		var loadimg = $(this).siblings('.fep-loading-img').first();
		var row = $(this).closest('.fep-row');
		var message_box = $('#fep-message');
		var post_count = $('#fep-posts .count');
		var confirmation = confirm(fep_messages.confirmation_message);
		if (!confirmation)
			return;
		$(this).hide();
		loadimg.show().css({'float': 'none', 'box-shadow': 'none'});
		$.ajax({
			type: 'POST',
			url: fepajaxhandler.ajaxurl,
			data: {
				action: 'fep_delete_posts',
				post_id: id,
				delete_nonce: nonce
			},
			success: function (data, textStatus, XMLHttpRequest) {
				var arr = $.parseJSON(data);
				message_box.html('');
				if (arr.success) {
					row.hide();
					message_box.show().addClass('success').append(arr.message);
					post_count.html(Number(post_count.html()) - 1);
				}
				else {
					message_box.show().addClass('warning').append(arr.message);
				}
				if (message_box.offset().top < $(window).scrollTop()) {
					$('html, body').animate({scrollTop: message_box.offset().top - 10}, 'slow');
				}
			},
			error: function (MLHttpRequest, textStatus, errorThrown) {
				alert(errorThrown);
			}
		});
		event.preventDefault();
	});
	$("#fep-submit-post.active-btn").on('click', function () {
		tinyMCE.triggerSave();
		var title = $("#fep-post-title").val();
		var content = $("#fep-post-content").val();
		var category = $("#fep-category").val();
		var tags = $("#fep-tags").val();
		var pid = $("#fep-post-id").val();
		var fimg = $("#fep-featured-image-id").val();
		var nonce = $("#fepnonce").val();
		var message_box = $('#fep-message');
		var form_container = $('#fep-new-post');
		var submit_btn = $('#fep-submit-post');
		var load_img = $("img.fep-loading-img");
		var submission_form = $('#fep-submission-form');
		var post_id_input = $("#fep-post-id");
		var errors = post_has_errors(title, content, category, tags, fimg);
		if (errors) {
			if (form_container.offset().top < $(window).scrollTop()) {
				$('html, body').animate({scrollTop: form_container.offset().top - 10}, 'slow');
			}
			message_box.removeClass('success').addClass('warning').html('').show().append(errors);
			return;
		}
		load_img.show();
		submit_btn.attr("disabled", true).removeClass('active-btn').addClass('passive-btn');
		$.ajaxSetup({cache: false});
		$.ajax({
			type: 'POST',
			url: fepajaxhandler.ajaxurl,
			data: {
				action: 'fep_process_form_input',
				post_title: title,
				post_content: content,
				post_category: category,
				post_tags: tags,
				post_id: pid,
				featured_img: fimg,
				post_nonce: nonce
			},
			success: function (data, textStatus, XMLHttpRequest) {
				hasChanged = false;
				var arr = $.parseJSON(data);
				if (arr.success) {
					submission_form.hide();
					post_id_input.val(arr.post_id);
					message_box.removeClass('warning').addClass('success');
				}
				else
					message_box.removeClass('success').addClass('warning');
				message_box.html('').append(arr.message).show();
				if (form_container.offset().top < $(window).scrollTop()) {
					$('html, body').animate({scrollTop: form_container.offset().top - 10}, 'slow');
				}
				load_img.hide();
				submit_btn.attr("disabled", false).removeClass('passive-btn').addClass('active-btn');
			},
			error: function (MLHttpRequest, textStatus, errorThrown) {
				alert(errorThrown);
			}
		});
	});
	$('body').on('click', '#fep-continue-editing', function (e) {
		$('#fep-message').hide();
		$('#fep-submission-form').show();
		e.preventDefault();
	});
	$('#fep-featured-image a#fep-featured-image-link').click(function (e) {
		e.preventDefault();
		custom_uploader = wp.media.frames.file_frame = wp.media({
			title: fep_messages.media_lib_string,
			button: {
				text: fep_messages.media_lib_string
			},
			multiple: false
		});
		custom_uploader.on('select', function () {
			attachment = custom_uploader.state().get('selection').first().toJSON();
			jQuery('#fep-featured-image input#fep-featured-image-id').val(attachment.id);
			$.ajax({
				type: 'POST',
				url: fepajaxhandler.ajaxurl,
				data: {
					action: 'fep_fetch_featured_image',
					img: attachment.id
				},
				success: function (data, textStatus, XMLHttpRequest) {
					$('#fep-featured-image-container').html(data);
					hasChanged = true;
				},
				error: function (MLHttpRequest, textStatus, errorThrown) {
					alert(errorThrown);
				}
			});
		});
		custom_uploader.open();
	});
});