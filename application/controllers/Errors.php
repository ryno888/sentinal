<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {
    
    
    public function xclear_error() {
        if(file_exists(DIR_DEBUG."/console.txt")){
            unlink(DIR_DEBUG."/console.txt");
        }
    }
}
