$.ajaxSetup({
	headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
});

$('.js-select').select2();

$('.datepicker').datepicker({
    language: 'sk',
    format: 'dd. mm. yyyy',
});
