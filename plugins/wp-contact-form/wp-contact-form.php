<?php
/*
Plugin Name: Form and Function Wordpress Contact Form Plugin
Description: This plugin will display a contact form that will send and email to a specified address in the shortcode
Version: 1.0.0
Author: David Jarrin
License: GPL2
*/


//namespace dmjContactForm;
include 'classes/BuildForm.php';
//use dmjContactForm;


class wpContactForm
{
    private $sendEmail;
    private $replyEmail;
    private $subject;
    private $emailContent;

    public function __construct()
    {
        // Register shortcode for youtube embed
        add_shortcode('contact', array($this, 'contact_form_embed'));

        // Register scripts
        add_action('wp_footer', array($this, 'contactFormScripts' ) );

        // Register styles
        add_action('wp_enqueue_scripts', array($this, 'contactFormStyles'));
    }


    /**
     * Shortcode display function
     * @param $atts
     */
    public function contact_form_embed($atts)
    {
        $a = shortcode_atts( array(
            'send_email_to'       => null
        ), $atts);

        $this->sendEmail = $this->validateEmail($a['send_email_to']);

        if(!$this->sendEmail) {
            return '';
        }

        $formOutput = new BuildForm($this->sendEmail);

        return $formOutput;
    }

    /**
     * Simply returns if an email is valid or not
     * @param $email
     * @return bool
     */
    public function validateEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        } else {
            return false;
        }
    }


    public function contactFormScripts()
    {
        wp_register_script(
            'contact-form-js',
            plugins_url('js/wp-contact-form.js', __FILE__),
            array('jquery'),
            null,
            true);


        wp_enqueue_script('contact-form-js');
    }

    public function contactFormStyles()
    {
        wp_register_style(
            'contact-form-css',
            plugins_url('css/wp-contact-form.css', __FILE__)

        );
        wp_enqueue_style('contact-form-css');
    }
}
//instantiate the plugin
new wpContactForm();