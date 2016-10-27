<?php

//namespace dmjContactForm;


class BuildForm
{
    public $email;
    private $output;
    private $bigNumber;

    public function __construct($email)
    {
        $this->formMarkUp($email);
        return $this->__toString();
    }

    public function formMarkUp($email)
    {
        $output = '';

        $output .= '<form class="contact-form">';

        $output .= '<div class="form_container">';

        $output .= '<div class="name_container form_field_container">';
        $output .= '<input type="text" class="form_field" id="name" placeholder="Your Name" required>';
        $output .= '</div>'; //name_container

        $output .= '<div class="email_container form_field_container">';
        $output .= '<input type="email" class="form_field" id="email" placeholder="Email" required>';
        $output .= '</div>'; //email_container

        $output .= '<div class="purpose_container form_field_container">';
        $output .= '<select class="form_field" id="purpose_of_contact" required>';
        $output .= '<option value="">Why would you like to talk?</option>';
        $output .= '<option value="free_lance_job">Free Lance Position</option>';
        $output .= '<option value="full_time_position">Full Time Position</option>';
        $output .= '<option value="topic_discussion">Topic Discussion</option>';
        $output .= '</select>';
        $output .= '</div>'; //purpose_container

        $output .= '<div class="message_container form_field_container">';
        $output .= '<label for="message">What would you like to say?</label>';
        $output .= '<textarea name="message" class="form_field" id="message" row="4" cols"50" required></textarea>';
        $output .= '</div>'; //message_container

        $output .= $this->captcha();

        $output .= '</div>'; //form_field_container

        $output .= '<div class="form_overlay"></div>';

        $output .= '</form>';

        $this->output = $output;
    }

    public function captcha()
    {
        $randCaptchaNumber = rand(1,4);

        $this->setBigNumber($randCaptchaNumber);

        $output = '';

        $output .= '<input type="submit" class="contact_form_submit" value="Send Email" key_value="'. $this->bigNumber .'"/>';



        $output .= '<div class="captcha-container">';
        $output .= $this->getCaptchaConfig();

        $output .= '</div>';

        return $output;
    }

    public function getCaptchaConfig()
    {
        $output = '';

        switch ($this->bigNumber) {
            case 974113 :
                $output .= '<p>Which one is LeBron?</p>';
                break;
            case 957126 :
                $output .= '<p>Which one is Einstein?</p>';
                break;
            case 561943 :
                $output .= '<p>Which one is Steve Jobs?</p>';
                break;
            case 458848 :
                $output .= '<p>Which one is the pig?</p>';
                break;
        }

        $output .= '<div class="row">';
        $output .= '<div class="lg-12 xs-12">';
        $output .= '<img src="'. plugins_url('../img/lebron.jpg', __FILE__) .'" class="captcha_photo" key_value="974113">';
        $output .= '<img src="'. plugins_url('../img/einstein.png', __FILE__) .'" class="captcha_photo" key_value="957126">';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '<div class="row">';
        $output .= '<div class="lg-12 xs-12">';
        $output .= '<img src="'. plugins_url('../img/pig.jpg', __FILE__) .'" class="captcha_photo" key_value="458848">';
        $output .= '<img src="'. plugins_url('../img/steve-jobs.jpg', __FILE__) .'" class="captcha_photo" key_value="561943">';
        $output .= '</div>';
        $output .= '<div id="rightAnswerShow">';
        $output .= '<p>That\'s right! Your email has been sent.</p>';
        $output .= '</div>'; //rightAnswerShow
        $output .= '<div id="wrongAnswer">';
        $output .= '<p>Nope! You need to study up on my idols...... And favorite animal. Please try again after the page refreshes.</p>';
        $output .= '</div>'; //wrongAnswer
        $output .= '<div id="contactError">';
        $output .= '<p>Oooops! Something went wrong, try again later or contact me on <a href="https://www.linkedin.com/in/david-jarrin-612677a2" target="_blank">my Linkedin</a></p>';
        $output .= '</div>'; //contactError
        $output .= '<i class="fa fa-refresh fa-spin fa-5x" aria-hidden="true"></i>';
        $output .= '<div id="captcha_overlay"></div>';
        $output .= '</div>';


        return $output;

    }

    public function setBigNumber($randomNumber)
    {
        switch ($randomNumber) {
            case 1 :
                $this->bigNumber = 974113;
                break;
            case 2 :
                $this->bigNumber = 957126;
                break;
            case 3 :
                $this->bigNumber = 561943;
                break;
            case 4 :
                $this->bigNumber = 458848;
        }
    }

    public function __toString() {
        return $this->output;
    }
}