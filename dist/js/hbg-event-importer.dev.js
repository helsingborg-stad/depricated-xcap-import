jQuery(document).ready(function ($) {

    $('.acf-field[data-name="event-sync"] input[type="checkbox"]').on('change', function () {

        if ($('.acf-field[data-name="event-sync"] input[type="checkbox"]').is(':checked')) {
            $('body').addClass('no-sync');
        } else {
            $('body').removeClass('no-sync');
        }

    }).trigger('change');

});
