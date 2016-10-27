jQuery(document).ready(function($){
    $('form.contact-form').on('submit', function (e) {
        e.preventDefault();
        var keyValue = $('.contact_form_submit').attr('key_value');
        var name = $('#name').val();
        var email = $('#email').val();
        var purposeOfContact = $('#purpose_of_contact option:selected').val();
        var message = $('#message').val();
        $('.captcha-container, .form_overlay').show('fast');

        $('.captcha_photo').on( 'click', function () {
            $('#captcha_overlay').fadeIn('fast');
            $('.fa-refresh').fadeIn('fast');
            var choosenValue = $(this).attr('key_value');
            $.ajax({
                url: contactformaddress.ajaxurl,
                type: 'post',
                data: {
                    action: 'processAndSendContactForm',
                    choosenValue: choosenValue,
                    key: keyValue,
                    name: name,
                    email: email,
                    purposeOfContact: purposeOfContact,
                    message: message
                },
                success: function ( data ) {
                    if('FALSE' == data) {
                        $('.fa-refresh').fadeOut('fast');
                        $('#wrongAnswer').fadeIn('slow');
                        setTimeout( function () {
                            window.location.reload();
                        },5000)
                    } else if('TRUE' == data) {
                        $('.fa-refresh').fadeOut('fast');
                        $('#rightAnswerShow').fadeIn('slow');
                    }

                },
                error: function () {
                    $('.fa-refresh').fadeOut('fast');
                    $('#contactError').fadeIn('slow');
                }

            });
        });
    });


    function contactFormCorrectAnswer(choosenValue) {

    }

    function contactFormWrongAnswer(choosenValue) {

    }
});
