jQuery(document).ready(function($) {


    //is responsible for loading more insights
    $('body').on('click', '#load_more_insights', function () {
        var offset = $('ul.insights_list li.insights_container').length;

        $('.loader-container').slideDown('slow');

        $.ajax({
            url: insightsloaderaddress.ajaxurl,
            type: 'post',
            data: {
                action: 'insightsLoader',
                offset: offset
            },
            success: function ( data ) {
                $('ul.insights_list').append( data );
                $('.loader-container').slideUp('slow');
                $('li.insights_container.loaded').slideDown('slow');
            },
            error: function () {

            }

        });
    });
});