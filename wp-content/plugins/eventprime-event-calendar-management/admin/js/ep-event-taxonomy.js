jQuery(document).ready(function($) {
    var eventTypeSelector = $('ul#em_event_typechecklist input[type="checkbox"]');
    
    var venueSelector = $('ul#em_venuechecklist input[type="checkbox"]');


    eventTypeSelector.on( 'change', function() {
        if ($(this).is(':checked')) {
            eventTypeSelector.not(this).prop('checked', false); // Uncheck other options
        }
    });
    
    venueSelector.on( 'change', function() {
        if ($(this).is(':checked')) {
            venueSelector.not(this).prop('checked', false); // Uncheck other options
        }
    });
});
