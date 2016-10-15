<?php
/*
Plugin Name: Wordpress Youtube Video Plugin
Description: This plugin will display a youtube video by laying a shortcode in the content
Version: 1.1.0
Author: David Jarrin
License: GPL2
*/

class youTubeVideo
{

    private $showViewCount;
    private $showVideoTitle;
    private $showControls;
    private $showSuggestedVideos;


    public function __construct()
    {
        // Register shortcode for youtube embed
        add_shortcode('youtube', array($this, 'youtube_embed'));
    }

    /**
     * Shortcode display function
     * @param $atts
     * @return string
     */
    public function youtube_embed($atts)
    {
        $a = shortcode_atts( array(
            'show_view_count'       => false,
            'size'                  => 'large',
            'share_url'             => null,
            'show_video_title'      => true,
            'show_controls'         => true,
            'show_suggested_videos' => true
        ), $atts);

        //will set class arguments (basically turn strings to booleans);
        $this->setParameters($a["show_view_count"], $a["show_video_title"], $a["show_controls"], $a["show_suggested_videos"]);

        $embedURL = $this->urlProcessor($a["share_url"], $this->showVideoTitle, $this->showControls, $this->showSuggestedVideos);

        $output = '<div class="youtube_container">';
        $output .= '<iframe ';

        //determines the videos size
        switch ($a["size"]) {
            case 'small' :
                $output .= 'style="width: 50%; height: 25%; text-align: center;" ';
                break;
            case 'medium' :
                $output .= 'style="width: 75%; height: 35%; text-align: center;" ';
                break;
            case 'large' :
                $output .= 'style="width: 100%; height: 50%; text-align: center;" ';
                break;
            default:
                $output .= 'style="width: 100%; height: 50%; text-align: center;" ';
        }

        $output .= 'src="'. $embedURL .'"  frameborder="0" allowfullscreen></iframe>';

        $output .= '</div>'; //youtube_container

        return $output;
    }

    /**
     * Processes the share url along with shortcode options to put together the iframe url
     * @param $shareURL
     * @param bool $showVideoTitle
     * @param bool $showControls
     * @param bool $showSuggestedVideos
     * @return string
     */
    public function urlProcessor($shareURL, $showVideoTitle = true, $showControls = true, $showSuggestedVideos = true)
    {
        $urlPieces = parse_url($shareURL);
        $urlPieces['host'] = str_replace('.', '', $urlPieces['host']);
        $urlPieces['path'] = '/embed' . $urlPieces['path'];

        $url = $urlPieces['scheme'] .'://' . 'www.' . $urlPieces['host'] .'.com' .  $urlPieces['path'];

        if(!$showVideoTitle) {
            $url = add_query_arg('showinfo', 0, $url);
        }
        if(!$showControls) {
            $url = add_query_arg('controls', 0, $url);
        }
        if(!$showSuggestedVideos) {
            $url = add_query_arg('rel', 0, $url);
        }

        return $url;
    }

    /**
     * Validates the shortcode parameters
     * @param $showViewCount
     * @param $showVideoTitle
     * @param $showControls
     * @param $showSuggestedVideo
     */
    public function setParameters($showViewCount, $showVideoTitle, $showControls, $showSuggestedVideo)
    {
        if(is_string($showViewCount)) {
            $showViewCount = strtolower($showViewCount);
        }
        if(is_string($showVideoTitle)) {
            $showVideoTitle = strtolower($showVideoTitle);
        }
        if(is_string($showControls)) {
            $showControls = strtolower($showControls);
        }
        if(is_string($showSuggestedVideo)) {
            $showSuggestedVideo = strtolower($showSuggestedVideo);
        }


        if($showViewCount == 'true') {
            $this->showViewCount = true;
        } elseif($showViewCount == 'false' OR !$showViewCount) {
            $this->showViewCount = false;
        } else {
            $this->showViewCount = false;
        }

        if($showVideoTitle == 'true') {
            $this->showVideoTitle = true;
        } elseif($showVideoTitle == 'false' OR !$showVideoTitle) {
            $this->showVideoTitle = false;
        } else {
            $this->showVideoTitle = false;
        }

        if($showControls == 'true') {
            $this->showControls = true;
        } elseif($showControls == 'false' OR !$showControls) {
            $this->showControls = false;
        } else {
            $this->showControls = false;
        }

        if($showSuggestedVideo == 'true') {
            $this->showSuggestedVideos = true;
        } elseif($showSuggestedVideo == 'false' OR !$showSuggestedVideo) {
            $this->showSuggestedVideos = false;
        } else {
            $this->showSuggestedVideos = false;
        }

    }

}
//instantiate the shortcode
new youTubeVideo();