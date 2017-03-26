<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mod_person
 *
 * @author Ryno Laptop
 */
class mod_pdf {
    
    private $ci;
    private $person;
    private $pdf;
    private $border_color = "#5f5f5f";
    
    public function __construct() {
        $this->ci = &get_instance();
        $this->ci->load->library("lib_pdf");
        
        $this->pdf = new lib_pdf([
            "enable_header" => false,   
            "enable_footer" => false,   
        ]);
        $this->set_css();
    }
    //--------------------------------------------------------------------------
    function set_person($person) {
        $this->person = $person;
    }
    //--------------------------------------------------------------------------
    function get_previous_grade_html() {
        $html =" <td class='no-border width-40-perc'>PREV. GRADE</td>";
        $per_grade = $this->person->get("per_grade");
        $grade_arr = [
            -2 => "PP",
            -1 => "R",
            1 => "1",
            2 => "2",
            3 => "3",
        ];
        
        foreach ($grade_arr as $key => $value) {
            if($per_grade == $key){
                $html .= "<td class='no-border width-12-perc text-bold color-black'>$value</td>";
            }else{
                $html .= "<td class='no-border width-12-perc color-grey'>$value</td>";
            }
        }
        
        return $html;
    }
    //--------------------------------------------------------------------------
    function get_grade_repeated_html() {
        $html =" <td class='no-border width-64-perc'>GRADE REPEATED</td>";
        $per_grade = $this->person->get("per_grade_repeated");
        $grade_arr = [
            1 => "1",
            2 => "2",
            3 => "3",
        ];
        
        foreach ($grade_arr as $key => $value) {
            if($per_grade == $key){
                $html .= "<td class='no-border width-12-perc text-bold color-black'>$value</td>";
            }else{
                $html .= "<td class='no-border width-12-perc color-grey'>$value</td>";
            }
        }
        
        return $html;
    }
    //--------------------------------------------------------------------------
    private function set_css($css = false){
        $this->pdf->add_css("
            <style>
                table { border-collapse:collapse; }
                th{ font-size:12px }
                td, th {
                    border: 1px solid $this->border_color;
                    text-align: left;
                    font-size:8px;
                    padding: 8px;
                    vertical-align:middle;
                }
                
                .no-border-left{border-left: none !important;}
                .no-border-right{border-right: none !important;}
                .no-border{border: none;}
                .no-border-bottom{border-bottom: none;}
                
                .font12{ font-size: 12px; }
                .font8{ font-size: 8px; }
                .text-center{ text-align: center; }
                .{ line-height: 16px; }
                .line-heght-14{ line-height: 14px; }
                
                .width-64-perc{ width:64%; }
                .width-40-perc{ width:40%; }
                .width-30-perc{ width:30%; }
                .width-25-perc{ width:25%; }
                .width-20-perc{ width:20%; }
                .width-15-perc{ width:15%; }
                .width-12-perc{ width:12%; }
                .width-10-perc{ width:10%; }
                .width-5-perc{ width:5%; }
                
                .border-black {border: 1px solid black;}
                .color-grey {color:#cccccc;}
                .color-green {color:#52da34;}
                .color-red { color: #d40202;}
                .color-black { color: black;}
                
                .text-bold{ font-weight: bold;}
                
                .table-border{ border: 1px solid $this->border_color; }
                .td-border{ border: 1px solid $this->border_color; }
                .td-color-grey{ background-color:$this->border_color; }
                .td-border-left{border-left: 1px solid $this->border_color;}
                .td-border-right{border-right: 1px solid $this->border_color;}
                .td-border-bottom{border-bottom: 1px solid $this->border_color;}
                .td-border-top{border-top: 1px solid $this->border_color;}
            </style>
        ");
    }
    //--------------------------------------------------------------------------
    //put your code here
    public function generate_observation_sheet(){
        
        $tick = DIR_ASSETS."img/accept_small.png";
        $cross = DIR_ASSETS."img/delete_small.png";
        $dot = DIR_ASSETS."img/dot_small.png";
        
        //header
        $this->pdf->add_html("
            <table cellspacing='0' class='table-border'>
                <tr>
                    <td class='font12 text-center' >OBSERVATION SHEET</td>
                </tr>
            </table>
        ");
        
        // body
        $this->pdf->add_html("
            <table cellspacing='0' cellpadding='2'>
                <tr>
                    <td colspan='6' class='' >NAME<br/>{$this->person->format_name()}</td>
                    <td colspan='1' class='' >GRADE<br/>Grade {$this->person->get("per_grade")}</td>
                    <td colspan='1' class='' >YEAR<br/>{$this->person->get("per_year_in_class")}</td>
                    <td colspan='3' class=''></td>
                </tr>
                <tr>
                    <td colspan='4' class='' >BIRTH DATE</td>
                    <td colspan='4' class=''>
                        <table style='width:100%'>
                            <tr>
                                {$this->get_previous_grade_html()}
                            </tr>
                        </table>
                    </td>
                    <td colspan='3' class='' >PREVIOUS SCHOOL</td>
                </tr>
                <tr>
                    <td colspan='4' class='' >".lib_date::strtodate($this->person->get("per_birthday"), lib_date::$DATE_FORMAT_12)."</td>
                    <td colspan='4' class=''>
                        <table style='width:100%'>
                            <tr>
                                {$this->get_grade_repeated_html()}
                            </tr>
                        </table>
                    </td>
                    <td colspan='3' class='' >{$this->person->get("per_prev_school")}</td>
                </tr>
            </table>
        ");
        
        $this->pdf->add_html("
            <br/><br/>
            <table cellspacing='0' cellpadding='2' class='table-border'>
                <tr>
                    <td class='no-border td-border-left'>INTERVENTION hist.</td>
                    <td class='no-border'>YR/GR</td>
                    <td class='no-border'>REMARK</td>
                    <td colspan='2' class=''>Current Year/Remark</td>
                </tr>
                <tr>
                    <td class='width-20-perc'>CLASS TUTORING</td>
                    <td class='width-10-perc'></td>
                    <td class='width-30-perc'></td>
                    <td class='width-10-perc'></td>
                    <td class='width-30-perc'></td>
                </tr>
                <tr>
                    <td class='width-20-perc'>OT</td>
                    <td class='width-10-perc'></td>
                    <td class='width-30-perc'></td>
                    <td class='width-10-perc'></td>
                    <td class='width-30-perc'></td>
                </tr>
                <tr>
                    <td class='width-20-perc'>REM</td>
                    <td class='width-10-perc'></td>
                    <td class='width-30-perc'></td>
                    <td class='width-10-perc'></td>
                    <td class='width-30-perc'></td>
                </tr>
                <tr>
                    <td class='width-20-perc'>LANGUAGE/SPEECH</td>
                    <td class='width-10-perc'></td>
                    <td class='width-30-perc'></td>
                    <td class='width-10-perc'></td>
                    <td class='width-30-perc'></td>
                </tr>
                <tr>
                    <td class='width-20-perc'>PSYCHOLOGIST</td>
                    <td class='width-10-perc'></td>
                    <td class='width-30-perc'></td>
                    <td class='width-10-perc'></td>
                    <td class='width-30-perc'></td>
                </tr>
                <tr>
                    <td class='width-20-perc'>SOCIAL/WELFARE</td>
                    <td class='width-10-perc'></td>
                    <td class='width-30-perc'></td>
                    <td class='width-10-perc'></td>
                    <td class='width-30-perc'></td>
                </tr>
                <tr>
                    <td class='width-20-perc'>MEDICAL</td>
                    <td class='width-10-perc'></td>
                    <td class='width-30-perc'></td>
                    <td class='width-10-perc'></td>
                    <td class='width-30-perc'></td>
                </tr>
                <tr>
                    <td class='width-20-perc'>OTHER</td>
                    <td class='width-10-perc'></td>
                    <td class='width-30-perc'></td>
                    <td class='width-10-perc'></td>
                    <td class='width-30-perc'></td>
                </tr>
                <tr>
                    <td class='width-20-perc'></td>
                    <td class='width-10-perc'></td>
                    <td class='width-30-perc'></td>
                    <td class='width-10-perc'></td>
                    <td class='width-30-perc'></td>
                </tr>
                <tr>
                    <td class='width-20-perc'>LEARNSUPP. TEAM</td>
                    <td class='width-10-perc'></td>
                    <td class='width-30-perc'></td>
                    <td class='width-10-perc'></td>
                    <td class='width-30-perc'></td>
                </tr>
            </table>
        ");
        
        $this->pdf->add_html("
            <br/><br/>
            <table cellspacing='0' cellpadding='2' class='table-border'>
                <tr>
                    <td colspan='10' class='no-border'>TICK CODE</td>
                </tr>
                <tr>
                    <td class='width-10-perc no-border'>Yes/Good</td>
                    <td class='width-10-perc text-center'><img src='$tick' width='7px'/></td>
                    <td class='width-10-perc no-border'>Weak/no</td>
                    <td class='width-10-perc text-center'><img src='$cross' width='7px'/></td>
                    <td class='width-10-perc no-border'>Satisfactory</td>
                    <td class='width-10-perc text-center'><img src='$dot' width='7px'/></td>
                    <td class='width-10-perc no-border'></td>
                    <td class='width-10-perc'></td>
                    <td class='width-10-perc no-border'></td>
                    <td class='width-10-perc'></td>
                </tr>
                <tr>
                    <td colspan='2' class='width-20-perc no-border td-border-top'>PARENT INVOLVE</td>
                    <td colspan='2' class='width-20-perc no-border td-border-top'>TERM 1</td>
                    <td colspan='2' class='width-20-perc no-border td-border-top'>TERM 2</td>
                    <td colspan='2' class='width-20-perc no-border td-border-top'>TERM 3</td>
                    <td colspan='2' class='width-20-perc no-border td-border-top'>TERM 4</td>
                </tr>
                <tr>
                    <td colspan='2' class='width-20-perc'>INFO EVENING</td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc td-color-grey'></td>
                    <td colspan='2' class='width-20-perc td-color-grey'></td>
                    <td colspan='2' class='width-20-perc td-color-grey'></td>
                </tr>
                <tr>
                    <td colspan='2' class='width-20-perc'>REPORT DISCUSS</td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                </tr>
                <tr>
                    <td colspan='2' class='width-20-perc'>OTHER MEETINGS</td>
                    <td class='width-10-perc'></td>
                    <td class='width-10-perc'></td>
                    <td class='width-10-perc'></td>
                    <td class='width-10-perc'></td>
                    <td class='width-10-perc'></td>
                    <td class='width-10-perc'></td>
                    <td class='width-10-perc'></td>
                    <td class='width-10-perc'></td>
                </tr>
                <tr>
                    <td colspan='2' class='width-20-perc'>MESSAGE BOOK SIGNED</td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                </tr>
                <tr>
                    <td colspan='2' class='width-20-perc'>WORK BOOK SIGNED</td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                </tr>
                <tr>
                    <td colspan='2' class='width-20-perc'>HOMEWORK</td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                </tr>
                <tr>
                    <td colspan='2' class='width-20-perc'>OTHER INFO</td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                </tr>
                <tr>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                </tr>
                <tr>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                    <td colspan='2' class='width-20-perc'></td>
                </tr>
            </table>
        ");
        $this->pdf->add_html("
            <br/><br/>
            <table cellspacing='0' cellpadding='2' class='table-border'>
                <tr>
                    <td class='width-20-perc no-border'>DISCIPLINE</td>
                    <td class='width-20-perc no-border'>TERM 1</td>
                    <td class='width-20-perc no-border'>TERM 2</td>
                    <td class='width-20-perc no-border'>TERM 3</td>
                    <td class='width-20-perc no-border'>TERM 4</td>
                </tr>
                <tr>
                    <td class='width-20-perc'>GOOD</td>
                    <td class='width-20-perc'></td>
                    <td class='width-20-perc'></td>
                    <td class='width-20-perc'></td>
                    <td class='width-20-perc'></td>
                </tr>
                <tr>
                    <td class='width-20-perc'>SATISFACTORY</td>
                    <td class='width-20-perc'></td>
                    <td class='width-20-perc'></td>
                    <td class='width-20-perc'></td>
                    <td class='width-20-perc'></td>
                </tr>
                <tr>
                    <td class='width-20-perc'>WEAK</td>
                    <td class='width-20-perc'></td>
                    <td class='width-20-perc'></td>
                    <td class='width-20-perc'></td>
                    <td class='width-20-perc'></td>
                </tr>
                <tr>
                    <td class='width-20-perc'>ADSEMT(Days)</td>
                    <td class='width-20-perc'></td>
                    <td class='width-20-perc'></td>
                    <td class='width-20-perc'></td>
                    <td class='width-20-perc'></td>
                </tr>
            </table>
        ");
        $this->pdf->add_html("
            <br/><br/>
            <table cellspacing='0' cellpadding='2' class='table-border'>
                <tr>
                    <td class='width-12-perc'>DISCIPLINE</td>
                    <td colspan='7' class=''>TERM 1</td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td class='no-border td-border-top'>ADJUSTMENT:</td>
                    <td class='no-border td-border-top'>Good</td>
                    <td class='no-border td-border-top'>Satisfact</td>
                    <td class='no-border td-border-top'>Emotion</td>
                    <td class='no-border td-border-top'>Active</td>
                    <td class='no-border td-border-top'>Talkative</td>
                    <td class='no-border td-border-top'>Quite/Reserved</td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td class='no-border td-border-top'>Neatness/Care</td>
                    <td class='no-border td-border-top'>Good</td>
                    <td class='no-border td-border-top'>Satisfact</td>
                    <td class='no-border td-border-top'>Weak</td>
                    <td class='no-border td-border-top'></td>
                    <td class='no-border td-border-top'></td>
                    <td class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='7' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='7' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='7' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='7' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='7' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='7' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='7' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='7' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='7' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='7' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='7' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='7' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='7' class='no-border td-border-top'></td>
                </tr>
            </table>
        ");
        
        $this->pdf->add_html("
            <br/><br/>
            <table cellspacing='0' cellpadding='2' class='table-border'>
                <tr>
                    <td class='width-12-perc'>Intervention</td>
                    <td class='no-border'>No</td>
                    <td class='no-border'>Yes</td>
                    <td colspan='7' class='no-border'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'>Progress</td>
                    <td class='no-border td-border-top td-border-right'>Good</td>
                    <td class='no-border td-border-top td-border-right'>Satisfactory</td>
                    <td class='no-border td-border-top td-border-right'></td>
                    <td class='no-border td-border-top td-border-right'>Weak</td>
                    <td class='no-border td-border-top td-border-right'>Literacy</td>
                    <td class='no-border td-border-top td-border-right'>Numeracy</td>
                    <td class='no-border td-border-top td-border-right'>LS</td>
                    <td colspan='2' class='no-border td-border-top'>FAL:</td>
                </tr>
            </table>
        ");
        $this->pdf->add_html("
            <br/><br/>
            <table cellspacing='0' cellpadding='2' class='table-border'>
                <tr>
                    <td class='width-12-perc'>Intervention</td>
                    <td class='no-border'>No</td>
                    <td class='no-border'>Yes</td>
                    <td colspan='7' class='no-border'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'>Progress</td>
                    <td class='no-border td-border-top td-border-right'>Good</td>
                    <td class='no-border td-border-top td-border-right'>Satisfactory</td>
                    <td class='no-border td-border-top td-border-right'></td>
                    <td class='no-border td-border-top td-border-right'>Weak</td>
                    <td class='no-border td-border-top td-border-right'>Literacy</td>
                    <td class='no-border td-border-top td-border-right'>Numeracy</td>
                    <td class='no-border td-border-top td-border-right'>LS</td>
                    <td colspan='2' class='no-border td-border-top'>FAL:</td>
                </tr>
            </table>
        ");
        $this->pdf->add_html("
            <br/><br/>
            <table cellspacing='0' cellpadding='2' class='table-border'>
                <tr>
                    <td class='width-12-perc'>Intervention</td>
                    <td class='no-border'>No</td>
                    <td class='no-border'>Yes</td>
                    <td colspan='7' class='no-border'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'>Progress</td>
                    <td class='no-border td-border-top td-border-right'>Good</td>
                    <td class='no-border td-border-top td-border-right'>Satisfactory</td>
                    <td class='no-border td-border-top td-border-right'></td>
                    <td class='no-border td-border-top td-border-right'>Weak</td>
                    <td class='no-border td-border-top td-border-right'>Literacy</td>
                    <td class='no-border td-border-top td-border-right'>Numeracy</td>
                    <td class='no-border td-border-top td-border-right'>LS</td>
                    <td colspan='2' class='no-border td-border-top'>FAL:</td>
                </tr>
            </table>
        ");
        $this->pdf->add_html("
            <br/><br/>
            <table cellspacing='0' cellpadding='2' class='table-border'>
                <tr>
                    <td class='width-12-perc'>Intervention</td>
                    <td class='no-border'>No</td>
                    <td class='no-border'>Yes</td>
                    <td colspan='7' class='no-border'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'></td>
                    <td colspan='9' class='no-border td-border-top'></td>
                </tr>
                <tr>
                    <td class='width-12-perc'>Progress</td>
                    <td class='no-border td-border-top td-border-right'>Good</td>
                    <td class='no-border td-border-top td-border-right'>Satisfactory</td>
                    <td class='no-border td-border-top td-border-right'></td>
                    <td class='no-border td-border-top td-border-right'>Weak</td>
                    <td class='no-border td-border-top td-border-right'>Literacy</td>
                    <td class='no-border td-border-top td-border-right'>Numeracy</td>
                    <td class='no-border td-border-top td-border-right'>LS</td>
                    <td colspan='2' class='no-border td-border-top'>FAL:</td>
                </tr>
            </table>
        ");
        
        $this->pdf->stream();
    }
}
