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


        add_action("wp_ajax_processAndSendContactForm", array($this, "processAndSendContactForm" ) );
        add_action("wp_ajax_nopriv_processAndSendContactForm", array( $this, "processAndSendContactForm" ) );
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

    public function processAndSendContactForm()
    {
        if(!isset($_POST['choosenValue'])
            OR empty($_POST['choosenValue'])
            OR !isset($_POST['key'])
            OR empty($_POST['key'])
            OR empty($_POST['name'])
            OR !isset($_POST['name'])
            OR !isset($_POST['email'])
            OR empty($_POST['email'])
            OR !isset($_POST['message'])
            OR empty($_POST['message'])
        ) {
            header("HTTP/1.0 404 Not Found");
        }

        switch ($_POST['purposeOfContact']) {
            case 'topic_discussion' :
                $subject = 'Topic Discussion';
                break;
            case 'free_lance_job' :
                $subject = 'Free Lance Position Available';
                break;
            case 'full_time_position' :
                $subject = 'Full Time Position';
                break;
            default :
                $subject = 'No Subject Email From davidjarrin.com';
        }
        if($_POST['key'] === $_POST['choosenValue']) {
            $headers[] = 'From: '. $_POST['name'] .' <'. $_POST['email'] .'>';
            wp_mail('dmjarrin@gmail.com', $subject, $_POST['message'], $headers);
            echo 'TRUE';
        } else {
            echo 'FALSE';
        }

        wp_die();
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
        wp_localize_script( 'contact-form-js', 'contactformaddress', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ));
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