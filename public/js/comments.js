$(document).on('click', '.comment-reply', function (e) {
	e.stopPropagation();
	e.preventDefault();
	
	var $link    = $(this);
    var $comment = $link.closest('.comment-wrapper');

    var reply = '';

    if($comment.parent().hasClass('comment-replies')){
    	reply = '@' + $comment.find('.comment-name').text() + ' ';
		$comment = $comment.parent().closest('.comment-wrapper');
	}

	$.ajax({
		url   : $link.attr('href'),
		method: 'get'
	}).done(function (data) {
		$comment.find('.comment-response').remove();

		var $reply = $(data);
		$comment.find('.comment-replies').append($reply);


        $reply.find('textarea').val(reply).focus();

        var container = $('body');

        container.animate({
            scrollTop: $reply.offset().top
        });

	}).error(function () {
		
	});
});


$(document).on('click', '.comment-tool a', function (e) {
	e.preventDefault();
	e.stopPropagation();

	var $button = $(this);

	var url      = $button.attr('href');
	var $comment = $button.closest('.comment-wrapper');
	var comment  = $button.closest('.comment-wrapper').data('comment');

	if ($button.hasClass('comment-remove')) {
		alert({
			title  : 'Vymazanie komentára',
			body   : 'Naozaj chcete vymazať tento komentár?',
			cancel : {
				class: 'default',
				title: 'Zrušiť',
			},
			success: {
				class   : 'danger',
				title   : 'Vymazať',
				callback: function () {
					$.ajax({
						url   : url,
						method: 'delete'
					}).done(function (data) {
						$comment.remove();
					});
				}
			}
		})
	} else if ($(this).hasClass('comment-edit')) {
		$.ajax({
			url   : url,
			method: 'get'
		}).done(function (data) {
			$comment.addClass('hidden');
			$comment.after(data);
		});
	}
});

$(document).on('click', '.comment-response .btn-cancel', function (e) {
	e.preventDefault();
	e.stopPropagation();
	
	var $wrapper = $(e.target).closest('.comment-wrapper');
	
	$wrapper.prev('.comment').find('.comment-reply').removeClass('hidden').removeAttr('disabled');
	$wrapper.remove();
});

$(document).on('submit', '.comment-response form', function (e) {
	e.preventDefault();
	e.stopPropagation();

	var $form = $(e.target).closest('form');
	var $response = $form.closest('.comment-response');
	var $wrapper = $response.closest('.comment-wrapper');

	if ($form.find('[name="comment"]').val() == "") {
		$wrapper.prev('.comment').find('.comment-reply').removeClass('hidden').removeAttr('disabled');
		$wrapper.remove();
	} else {
		$.ajax({
			url   : $form.attr('action'),
			method: $form.attr('method'),
			data  : $form.serialize()
		}).done(function (data) {
            $wrapper.find('.comment-reply').removeClass('hidden').removeAttr('disabled');
			$response.replaceWith(data);
		});
	}
});

$(document).on('click', '.comment-edit .btn-cancel', function (e) {
	e.preventDefault();
	e.stopPropagation();
	
	var $edit    = $(e.target).closest('.comment-wrapper');
	var $comment = $form.prev('.comment-wrapper.hidden');

    $form.remove();
	$comment.removeClass('hidden');
});

$(document).on('submit', '.comment-edit form', function (e) {
	e.preventDefault();
	e.stopPropagation();

	console.log('ferko');

	var $form    = $(e.target);
    var $edit    = $form.closest('.comment-edit');
    var $comment = $edit.prev('.comment-wrapper.hidden');


	$.ajax({
		url   : $form.attr('action'),
		method: $form.attr('method'),
		data  : $form.serialize()
	}).done(function (data) {
        $edit.remove();
		$comment.replaceWith(data)
	});
});

$(document).on('submit', '#comment-add', function (e) {
	e.preventDefault();
	e.stopPropagation();
	
	$form = $(e.target);

	$wrapper = $(e.target).closest('.comment-wrapper');
	
	$.ajax({
		url   : $form.attr('action'),
		method: $form.attr('method'),
		data  : $form.serialize()
	}).done(function (data) {
		$form.find('textarea').val('').text('').trigger('blur');
        $wrapper.after(data);

	}).error(function () {
	});
})


$('#comments textarea').focus(function () {
	$input = $(this);
	
	$input.attr('rows', 3);
	$input.closest('form').find('button').removeClass('hidden');
})

$('#comments textarea').blur(function () {
	$input = $(this);
	
	if ($input.val().length == 0) {
		$input.attr('rows', 1);
		$input.closest('form').find('button').addClass('hidden');
	}
})