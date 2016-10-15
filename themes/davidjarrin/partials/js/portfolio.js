jQuery(document).ready(function($){

    //simply responsible for the slide display for the stories
    $('body').on('click', '#more-projects', function () {

        var catNumber = $(this).attr('class').split(' ')[0];
        var hiddenProjects = $('.hidden_projects.' + catNumber);

        hiddenProjects.slideToggle('slow');
        $('#load-more-projects.' + catNumber).slideToggle('slow');
        $(this).toggleClass('less');


        if($(this).hasClass('less')) {
            $(this).text('Show Less Projects?');
        } else {
            $(this).text('See More Projects?');
        }
    });


    //will trigger the load more projects ajax call
    $('body').on('click', '#load-more-projects', function () {


        var catNumber = $(this).attr('class').split(' ')[0];
        var category = $(this).attr('class').split(' ')[1];
        $('.loader-container.' + catNumber).slideDown('slow');

        console.log(catNumber);
        var offset = $('.project_category_container.' + catNumber + ' li.project_container').length;

        $.ajax({
            url: projectloaderaddress.ajaxurl,
            type: 'post',
            data: {
                action: 'projectsLoader',
                offset: offset,
                category: category,
                categoryNumber: catNumber
            },
            success: function ( data ) {

                $('ul.projects_category_list.' + catNumber).append( data );
                $('.loader-container.' + catNumber).slideUp('slow');
                $('li.hidden_projects.' + catNumber).slideDown('slow');
            },
            error: function () {

            }

        });

    });
});

