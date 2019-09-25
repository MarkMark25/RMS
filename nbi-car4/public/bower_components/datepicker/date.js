/*
$(function() {
  $( "#datepicker" ).datepicker({
      dateFormat : 'yy-mm-dd',
      changeMonth : true,
      changeYear : true,
      yearRange: '-100y:c+nn',
      maxDate: '-1d'
  });
  $( "#datepickers" ).datepicker({
    dateFormat : 'yy-mm-dd',
    changeMonth : true,
    changeYear : true,
    yearRange: '-100y:c+nn',
    maxDate: '-1d'
});
});
*/
$(function() {
    $( "#datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        minDate: new Date(1980, 2 - 1, 2),
        onSelect: function( selectedDate ) {
            $( "#datepickers" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( ".datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        minDate: new Date(1980, 2 - 1, 2),
        onSelect: function( selectedDate ) {
            $( "#datepickers" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#datepickers" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        minDate: new Date(1980, 2 - 1, 2),
        onSelect: function( selectedDate ) {
            $( "#datepicker" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
});
$(function() {
	$('.monthYearPicker').datepicker({
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		dateFormat: 'MM yy'
	}).focus(function() {
		var thisCalendar = $(this);
		$('.ui-datepicker-calendar').detach();
		$('.ui-datepicker-close').click(function() {
var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
thisCalendar.datepicker('setDate', new Date(year, month, 1));
		});
	});
});
