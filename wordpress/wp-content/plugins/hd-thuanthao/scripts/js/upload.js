(function($) {
    "use strict";
    var custom_uploader;
    $('#registration_button').click(function(e) {

        var img_input = $(this).parents('.row').find('input');
        var label_form = $(this).parents('.row').find('label.label_form');
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose File',
            button: {
                text: 'Choose File'
            },
            multiple: true
        });
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {

            var selection = custom_uploader.state().get('selection');
            selection.map( function( attachment ) {
                attachment = attachment.toJSON();
                var url = attachment.url;
                img_input.val(url);
                label_form.html(url.split('/').pop());
            });

        });
        //Open the uploader dialog
        custom_uploader.open();


        return false;

    });
})(jQuery);