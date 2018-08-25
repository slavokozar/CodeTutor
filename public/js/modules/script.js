$.ajaxSetup({
	headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
});


$('.js-select').select2();


setTimeout(function () {
	$('#flash div.alert').not('.alert-important').hide("slide", { direction: "right" }, 1000);
},3000);

$(window).scroll(function () {
	var scroll   = $(window).scrollTop();
	var $sidebar = $('.sidebar-wrapper');

	if (scroll > 20) {
		$('.navbar').addClass('navbar-bg');
	}
	else {
		$('.navbar').removeClass('navbar-bg');
	}

});
$(window).load(function () {
	var scroll = $(window).scrollTop();
	if (scroll > 20) {
		$('.navbar').addClass('navbar-bg');
	}
	else {
		$('.navbar').removeClass('navbar-bg');
	}

});

$(document).on('click', '.link-modal', function (e) {
	e.preventDefault();
	e.stopPropagation();
	
	var $link = $(e.target).closest('a');
	console.log('ferinko');
	
	$.ajax({
		url: $link.attr('href')
	}).done(function (data) {
		var $modal = $(data);
		
		$('body').append($modal);
		$modal.modal();
		
		$modal.find('.btn.cancel').click(function () {
			if (typeof (options.cancel.callback) === 'function') {
				options.cancel.callback();
			}
		});
		
		$modal.find('.btn.success').click(function () {
			if (typeof (options.success.callback) === 'function') {
				options.success.callback();
			}

			$modal.modal('hide');
		});
		
		$modal.on('hidden.bs.modal', function (e) {
			$modal.remove();
			$('.modal-backdrop').remove();
		})
	}).error(function () {
		
	});
	
	
})


function alert(options) {
	var $modal =
			$('<div class="modal fade" tabindex="-1" role="dialog">' +
				'<div class="modal-dialog" role="document">' +
				'<div class="modal-content">' +
				'<div class="modal-header">' +
				'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
				'<h4 class="modal-title">' + options.title + '</h4>' +
				'</div>' +
				'<div class="modal-body">' + options.body + '</div>' +
				'<div class="modal-footer">' +
				'<button type="button" class="btn cancel btn-' + options.cancel.class + '" data-dismiss="modal">' + options.cancel.title + '</button>' +
				'<button type="button" class="btn success btn-' + options.success.class + '">' + options.success.title + '</button>' +
				'</div>' +
				'</div>' +
				'</div>' +
				'</div>');
	
	
	$('body').append($modal);
	$modal.modal();
	
	$modal.find('.btn.cancel').click(function () {
		if (typeof (options.cancel.callback) === 'function') {
			options.cancel.callback();
		}
		;
		
	});
	
	$modal.find('.btn.success').click(function () {
		if (typeof (options.success.callback) === 'function') {
			options.success.callback();
		}
		;
		$modal.modal('hide');
	});
	
	$modal.on('hidden.bs.modal', function (e) {
		$modal.remove();
	})
}

function modal(options) {
	$.ajax({
		url: options.url,
	}).done(function (data) {
		var $modal = $(data);
		
		$('body').append($modal);
		$modal.modal('show');

        if (typeof (options.init) === 'function') {
            options.init();
        }

		$modal.find('.btn.cancel').click(function () {
			if (typeof (options.cancel.callback) === 'function') {
				options.cancel.callback();
			}
			;
			
		});
		
		$modal.find('.btn.success').click(function () {
			if (typeof (options.success.callback) === 'function') {
				options.success.callback();
			}
			;
			$modal.modal('hide');
		});
		
		$modal.on('hidden.bs.modal', function (e) {
			$modal.remove();
			$('.modal-backdrop').remove();
		})
	}).error(function () {
		
	});
	
	
}