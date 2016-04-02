function appendAddEditForm(e) {
	e.preventDefault();
	var elem = $(e.target);
	var form = $('#formAddHour');
	elem.parents('td').append(form);
	form.slideDown('fast');
	form.find('.submit').prop({
		disabled: 'true',
	});
	var method = elem.hasClass('add') ? 'POST' : 'PATCH';
	form.find('[name=_method]').val(method);
	form.find('[name=drive_id]').val(elem.closest('tr').data('did'));
	var week = elem.closest('tr').data('week');
	if(!form.find('select').hasClass('canDriveList-'+week)){
		form.find('.canDriveList').html($('.canDriveList-'+week).clone());
	}

}
$('a.add').click(function(e) {
	appendAddEditForm(e);
	$('#student_id').val( '' );
});

$('body').on('change', '#student_id', function(e) {
	var elem = $(this); 
	var val = elem.val();
	var form = elem.parents('form');
	if (val == '') {
		form.find('.submit').prop('disabled', true);
	} else {
		form.find('.submit').prop('disabled', false);
		var td = form.closest('td');
		var action = td.find('.add,.change').hasClass('add') ? '/admin/student/' + val + '/hours' : '/admin/student/' + val + '/hours/' + td.data('hid');
		form.prop('action', action );
	}
});
$('a.change').click(function(e) {
	appendAddEditForm(e);
	$('#student_id').val( $( e.target ).closest('a').data('sid') );

});
$('.deleteStudent').click(function(e) {
	e.preventDefault();
	if( confirm('Czy na pewno chcesz usunąć') ){
		var elem = $(this);
		var form = elem.parents('form');
		form.submit();
	}
});
$('.btnCancel').click(function(e) {
	e.preventDefault();
	elem = $(this);
	elem.closest('form').slideUp('fast');
});
