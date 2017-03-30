<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lib_tinypng
 *
 * @author Ryno Laptop
 */
require_once(DIR_THIRD_PARTY."/tinify-php-master/lib/Tinify/Exception.php");
require_once(DIR_THIRD_PARTY."/tinify-php-master/lib/Tinify/ResultMeta.php");
require_once(DIR_THIRD_PARTY."/tinify-php-master/lib/Tinify/Result.php");
require_once(DIR_THIRD_PARTY."/tinify-php-master/lib/Tinify/Source.php");
require_once(DIR_THIRD_PARTY."/tinify-php-master/lib/Tinify/Client.php");
require_once(DIR_THIRD_PARTY."/tinify-php-master/lib/Tinify.php");

class lib_tinypng {
    private $source = false;
    private $destination = false;
    private $thumbnail_method = "fit"; // fit / cover / scale
    private $thumbnail_width = 150;
    private $thumbnail_height = 150;
    
    //--------------------------------------------------------------------------
    public function __construct() {
        \Tinify\setKey(CR_TINYPNG_KEY);
    }
    //--------------------------------------------------------------------------
    /**
     * Scale: Scales the image down proportionally. You must provide either a target width or a target height, but not both. The scaled image will have exactly the provided width or height.
     * Fit: Scales the image down proportionally so that it fits within the given dimensions. You must provide both a width and a height. The scaled image will not exceed either of these dimensions.
     * Cover: Scales the image proportionally and crops it if necessary so that the result has exactly the given dimensions. You must provide both a width and a height. Which parts of the image are cropped away is determined automatically. An intelligent algorithm determines the most important areas and leaves these intact.
     * @param type $thumbnail_method
     */
    function set_thumbnail_method($thumbnail_method) {
        $this->thumbnail_method = $thumbnail_method;
    }
    //--------------------------------------------------------------------------

    function set_thumbnail_width($thumbnail_width) {
        $this->thumbnail_width = $thumbnail_width;
    }
    //--------------------------------------------------------------------------

    function set_thumbnail_height($thumbnail_height) {
        $this->thumbnail_height = $thumbnail_height;
    }
    //--------------------------------------------------------------------------
    
    public function set_source($source) {
        $this->source = $source;
    }
    //--------------------------------------------------------------------------
    public function set_destination($destination) {
        $this->destination = $destination;
    }
    //--------------------------------------------------------------------------
    function get_source() {
        return $this->source;
    }
    //--------------------------------------------------------------------------
    function get_destination() {
        return $this->destination;
    }
    //--------------------------------------------------------------------------
    function get_thumbnail_method() {
        return $this->thumbnail_method;
    }
    //--------------------------------------------------------------------------
    function get_thumbnail_width() {
        return $this->thumbnail_width;
    }
    //--------------------------------------------------------------------------
    function get_thumbnail_height() {
        return $this->thumbnail_height;
    }
    //--------------------------------------------------------------------------
    public function run() {
        
        if(!$this->source){ 
            error_helper::log("Source is not set");
            return;
        }
        if(!$this->destination){ 
            error_helper::log("Destination is not set");
            return;
        }
        switch ($this->source) {
            case filter_var($this->source, FILTER_VALIDATE_URL):
                $this->compress_url($this->source, $this->destination);
                break;
            case is_resource($this->source):
                $this->compress_buffer($this->source, $this->destination);
                break;
            default:
                $this->compress($this->source, $this->destination);
                break;
        }
    }
    //--------------------------------------------------------------------------
    private function compress($source, $destination) {
        $scr = \Tinify\fromFile($source);
        $scr->toFile($destination);
    }
    //--------------------------------------------------------------------------
    private function compress_buffer($filename, $destination) {
        $sourceData = file_get_contents($filename);
        $resultData = \Tinify\fromBuffer($sourceData)->toBuffer();
        file_put_contents($destination, $resultData);
    }
    //--------------------------------------------------------------------------
    private function compress_url($url, $destination) {
        $source = \Tinify\fromUrl($url);
        $source->toFile($destination);
    }
    //--------------------------------------------------------------------------
    public function to_thumbnail($filename = false) {
        
        $path = dirname($this->destination);
        $fil_name = strtolower(basename($this->destination));
        
        $source = \Tinify\fromFile($this->destination);
        $resized = $source->resize(array(
            "method" => $this->thumbnail_method,
            "width" => $this->thumbnail_width,
            "height" => $this->thumbnail_method != "scale" ? $this->thumbnail_height : false
        ));
        
        $resized->toFile($filename ? $filename : "$path/thumbnail_$fil_name");
    }
    //--------------------------------------------------------------------------
    public function show_usage() {
        view('
        $lib_tinypng = lib_core::load("lib_tinypng");
        $lib_tinypng->set_source(DIR_FILES."Eon.png");
        $lib_tinypng->set_destination(DIR_FILES."Eon2.png");
        $lib_tinypng->run();
        $lib_tinypng->set_thumbnail_method("cover");
        $lib_tinypng->to_thumbnail();');
    }
    //--------------------------------------------------------------------------
}
