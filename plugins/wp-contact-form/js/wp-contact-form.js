jQuery(document).ready(function($){
    $('form.contact-form').on('submit', function (e) {
        e.preventDefault();
        $('.captcha-container, .form_overlay').show('fast');
    });
});
