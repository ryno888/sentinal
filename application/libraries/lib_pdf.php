<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once(DIR_THIRD_PARTY.'TCPDF-master/tcpdf.php');

class Lib_pdf extends TCPDF {
    
    private $pdf = false;
    private $footer = false;
    private $options = [];
    private $html = "";
    
    //--------------------------------------------------------------------------
    public function __construct($options = []) {
        
        $this->options = array_merge([
            "author" => CI_NAME,                    
            "subject" => false,                    
            "keywords" => false,                    
            "title" => false,                    
            "stream" => "D",                    
            "filename" => strtolower(CI_NAME)."_".time().".pdf",                    
            "orientation" => PDF_PAGE_ORIENTATION,  //P
            "format" => PDF_PAGE_FORMAT,            //A4
            "unit" => PDF_UNIT,                     //mm
            
            "enable_header" => true,   
            "enable_footer" => true,   
        ], $options);
        
        parent::__construct($this->options['orientation'], $this->options['unit'], $this->options['format'], true, 'UTF-8', false);
        
        // set document information
        $this->SetCreator(PDF_CREATOR);
        $this->SetAuthor($this->options['author']);
        $this->SetTitle($this->options['title']);
        $this->SetSubject($this->options['subject']);
        $this->SetKeywords($this->options['keywords']);
        
        // remove default header/footer
        $this->setPrintHeader($this->options['enable_header']);
        $this->setPrintFooter($this->options['enable_footer']);

        // set default monospaced font
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT, PDF_MARGIN_RIGHT);

        // set auto page breaks
        $this->SetAutoPageBreak(TRUE, 15);

        // set font
        $this->SetFont('times', 'BI', 12);

        // add a page
        $this->AddPage();
        
    }
    //--------------------------------------------------------------------------
    public function stream($filename = false, $stream = "D"){
        //Close and output PDF document
        $this->writeHTML($this->html);
        $this->Output($filename ? $filename : $this->options['filename'], $stream);
    }
    //--------------------------------------------------------------------------
    public function add_html($html){
        $this->html .= str_replace("'", '"', $html);
    }
    //--------------------------------------------------------------------------
    public function add_space($amount = 1){
        
        $html = "";
        for ($index = 0; $index < count($amount); $index++) {
            $html .= "<table><tr><td></td></tr></table>";
        }
        
        $this->html .= str_replace("'", '"', $html);
    }
    //--------------------------------------------------------------------------
    public function add_css($css = false){
        $this->add_html($css);
    }
    //--------------------------------------------------------------------------
}