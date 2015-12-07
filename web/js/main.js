$(document).ready(function() {

	/* initialize the external events
	-----------------------------------------------------------------*/

	$('#external-events .fc-event').each(function() {

		// store data so the calendar knows to render an event upon drop
		$(this).data('event', {
			title: $.trim($(this).text()), // use the element's text as the event title
			stick: true // maintain when user navigates (see docs on the renderEvent method)
		});

		// make the event draggable using jQuery UI
		$(this).draggable({
			zIndex: 999,
			revert: true,      // will cause the event to go back to its
			revertDuration: 0  //  original position after the drag
		});

	});

	$('#bota').click(function(){
		things = $('#calendarItemProgramacao').fullCalendar('clientEvents');
		for (var i = things.length - 1; i >= 0; i--) {
			if(!things[i].id)
				alert("Item de Programação ainda pendente "+things[i].title+" no dia "+(new Date(things[i].start)).toISOString().slice(0, 10));
		};
	});

});

var TIPO;

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}