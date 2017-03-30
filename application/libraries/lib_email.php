<?php

/*
 * Class 
 * @filename lib_email 
 * @encoding UTF-8
 * @author Liquid Edge Solutions  * 
 * @copyright Copyright Liquid Edge Solutions. All rights reserved. * 
 * @programmer Ryno van Zyl * 
 * @date 30 Mar 2017 * 
 */

/**
 * Description of lib_email
 *
 * @author Ryno
 */
class lib_email extends lib_core{
    
    //smtp setup
    private $protocol = EMAIL_PROTOCOL;
    private $smtp_host = EMAIL_HOST;
    private $smtp_port = EMAIL_PORT;
    private $smtp_timeout = '7';
    private $smtp_user = EMAIL_USERNAME;
    private $smtp_pass = EMAIL_PASSWORD;
    private $charset = 'utf-8';
    private $newline = "\r\n";
    private $mailtype = 'html';
    private $validation = true;
    
    //--------------------------------------------------------------------------
    public function __construct($options = []){
        
        parent::__construct();
        $this->ci->load->library('email');
        $config['protocol'] = $this->protocol;
        $config['smtp_host'] = $this->smtp_host;
        $config['smtp_port'] = $this->smtp_port;
        $config['smtp_timeout'] = $this->smtp_timeout;
        $config['smtp_user'] = $this->smtp_user;
        $config['smtp_pass'] = $this->smtp_pass;
        $config['charset'] = $this->charset;
        $config['newline'] = $this->newline;
        $config['mailtype'] = $this->mailtype; // or html
        $config['validation'] = $this->validation; // bool whether to validate email or not      
        $this->ci->email->initialize($config);
        
        $this->ci->email->from(EMAIL_FROM, CI_NAME);
    }
    //--------------------------------------------------------------------------
    public function set_from($from_email, $from_name){
        $this->ci->email->from($from_email, $from_name);
    }
    //--------------------------------------------------------------------------
    public function set_attachmemt($filename, $cid){
        $this->ci->email->attach($filename);
        $this->ci->email->attachment_cid($cid);
    }
    //--------------------------------------------------------------------------
    /**
     * Comma-delimited string or an array of e-mail addresses
     * @param type $mixed
     */
    public function set_cc($mixed){
        $this->email->cc($mixed);
    }
    //--------------------------------------------------------------------------
    /**
     * Comma-delimited string or an array of e-mail addresses
     * @param type $mixed
     */
    public function set_bcc($mixed){
        $this->email->bcc($mixed);
    }
    //--------------------------------------------------------------------------
    /**
     * Comma-delimited string or an array of e-mail addresses
     * @param type $mixed
     */
    public function set_to($mixed){
        $this->ci->email->to($mixed);
    }
    //--------------------------------------------------------------------------
    public function set_body($body){
        $this->ci->email->message($body);
    }
    //--------------------------------------------------------------------------
    public function set_subject($subject){
        $this->ci->email->subject($subject);
    }
    //--------------------------------------------------------------------------
    public function send($options = []){
        $this->ci->email->send();
    }
    //--------------------------------------------------------------------------
}
