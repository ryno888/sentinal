<?php

/*
 * Class 
 * @filename lib 
 * @encoding UTF-8
 * @author Liquid Edge Solutions  * 
 * @copyright Copyright Liquid Edge Solutions. All rights reserved. * 
 * @programmer Ryno van Zyl * 
 * @date 14 Feb 2017 * 
 */

/**
 * Description of lib
 *
 * http://bootsnipp.com/snippets/featured/calendar-design
 * 
 * @author Ryno
 */
class Lib_html_calendar extends Lib_core{
    
    private $month_days_arr = []; 
    private $week_html_arr = []; 
    private $event_arr = [];
    private $first_day = false; 
    private $last_day = false; 
    private $days_start = false; 
    private $days_end = false;

    private $selected_date = false;
    private $current_date = false;
    private $current_day = false;
    private $current_month = false;
    private $current_month_display = false;
    private $current_year = false;
    private $new_event_modal = [];
    
    //--------------------------------------------------------------------------
    public function __construct($date = "NOW") {
        parent::__construct();
        $this->current_date = Lib_date::strtodate($date);
        $this->current_day = Lib_date::strtodate($this->current_date, "d");
        $this->current_month = Lib_date::strtodate($this->current_date, "m");
        $this->current_month_display = Lib_date::strtodate($this->current_date, "F");
        $this->current_year = Lib_date::strtodate($this->current_date, "Y");
        $this->set_month();
    }
    //--------------------------------------------------------------------------
    public function add_modal($html = false) {
        $this->new_event_modal[] = $html;
    }
    //--------------------------------------------------------------------------
    public function set_selected_date($date = "NOW") {
        $this->selected_date = Lib_date::strtodate($date);
    }
    //--------------------------------------------------------------------------
    public function add_event($id, $date, $title, $options = []) {
        $options_arr = array_merge([
            "id" => $id,
            "all_day_event" => false,
            "start" => false,
            "end" => false,
            "class" => false,
        ], $options);
        
//        id: 999,
//        title: 'Repeating Event',
//        start: new Date(y, m, d-3, 16, 0),
//        allDay: false,
//        className: 'info'
        $this->event_arr[Lib_date::strtodate($date)][] = [
            "id" => $options_arr["id"],
            "title" => $title,
            "start" => "new Date($date)",
        ];
    }
    //--------------------------------------------------------------------------
    public function set_month() {
        $this->first_day = Lib_date::strtodate("first day of $this->current_month_display");
        $this->last_day = Lib_date::strtodate("last day of $this->current_month_display");
        $this->days_start = Lib_date::get_start_of_week($this->first_day);
        $this->days_end = Lib_date::get_end_of_week($this->last_day);
        $month_days_arr = Lib_date::get_datetime_range_arr($this->days_start, $this->days_end, " + 1 day ", CI_DATE);
        foreach ($month_days_arr as $date) {
            $this->month_days_arr[] = [
                "date" => $date,
                "weekday" => Lib_date::strtodate($date, "l"),
            ];
        }
    }
    //--------------------------------------------------------------------------
    public function add_event_modal($options = [], $modal = false) {
        
        if($modal){
            $this->add_modal($modal);
        }else{
            $options_arr = array_merge([
                "id" => "modalAddEvent",
                "header" => "Add Event",
            ], $options);
            
            $lib_modal = new Lib_modal($options_arr["header"]);
            $lib_modal->form("calendar/xadd_event", "form_{$options_arr["id"]}");
            $lib_modal->add_menu_submitbutton("Save Changes");
            $lib_modal->add_menu_button("Cancel", "javascript:;", ["@data-dismiss" => "modal"]);
            $lib_modal->set_id($options_arr["id"]);
            $lib_modal->add_column("half");
                $lib_modal->itext("Event Name", "add_cal_name", false, ["required" => true]);
                $lib_modal->icheckbox("All day event", "add_event_all_day", false, ["onclick" => "
                    if($('#add_event_all_day').is(':checked')){
                        $('.add_cal_starttime_wrapper').addClass('hidden');
                        $('.add_cal_endtime_wrapper').addClass('hidden');
                        $('#add_all_day_date_input_wrapper').removeClass('hidden');
                    }else{
                        $('.add_cal_starttime_wrapper').removeClass('hidden');
                        $('.add_cal_endtime_wrapper').removeClass('hidden');
                        $('#add_all_day_date_input_wrapper').addClass('hidden');
                    }
                "]);
//                $lib_modal->idate("Date", "add_all_day_date", false, ["hidden" => true, "required" => true]);
                $lib_modal->idatetime("Start Time", "add_cal_starttime", Lib_date::strtodatetime("NOW"), ["start_view" => 1, "required" => true]);
                $lib_modal->idatetime("End Time", "add_cal_endtime", Lib_date::strtodatetime("+ 1 hour"), ["start_view" => 1, "required" => true]);
            $lib_modal->end_column();
            $lib_modal->add_column("half");
                $lib_modal->itextarea("Details", "add_cal_description");
            $lib_modal->end_column();
            $lib_modal->add_script("
                $('body').on('dblclick','.day', function(e){
                    e.preventDefault();
                    $('#{$options_arr["id"]}').modal('show');
                });
            ");
            $lib_modal->end_form();
            $this->add_modal($lib_modal->display(true));
        }
    }
    //--------------------------------------------------------------------------
    public function edit_event_modal($options = [], $modal = false) {
        
        if($modal){
            $this->add_modal($modal);
        }else{
            $options_arr = array_merge([
                "id" => "modalEditEvent",
                "header" => "Edit Event",
                "form_action" => false,
            ], $options);

            $lib_modal_edit = new Lib_modal($options_arr["header"]);
            $lib_modal_edit->set_id($options_arr["id"]);
            $lib_modal_edit->ok_btn_label = "Save";
            
            $lib_modal_edit->form($options_arr["form_action"], "form_{$options_arr["id"]}");
            $lib_modal_edit->add_menu_submitbutton("Save Changes");
            $lib_modal_edit->add_menu_button("Cancel", "javascript:;", ["@data-dismiss" => "modal"]);
            $lib_modal_edit->add_column("half");
                $lib_modal_edit->ihidden("event_id", false);
                $lib_modal_edit->itext("Event Name", "event_title");
                $lib_modal_edit->icheckbox("All day event", "event_all_day", false, ["onclick" => "
                    if($('#event_all_day').is(':checked')){
                        $('.start_time_wrapper').addClass('hidden');
                        $('.end_time_wrapper').addClass('hidden');
                        $('#all_day_date_input_wrapper').removeClass('hidden');
                    }else{
                        $('.start_time_wrapper').removeClass('hidden');
                        $('.end_time_wrapper').removeClass('hidden');
                        $('#all_day_date_input_wrapper').addClass('hidden');
                    }
                "]);
//                $lib_modal_edit->idate("Date", "all_day_date", false, ["hidden" => true]);
                $lib_modal_edit->idatetime("Start Time", "start_time", false, ["start_view" => 0]);
                $lib_modal_edit->idatetime("End Time", "end_time", false, ["start_view" => 0]);
            $lib_modal_edit->end_column();
            $lib_modal_edit->add_column("half");
                $lib_modal_edit->itextarea("Details", "details");
            $lib_modal_edit->end_column();
            $lib_modal_edit->add_script("
                $('body').on('click','.eventItem', function(e){
                    e.preventDefault();
                    var self = $(this);
                    system.ajax.requestFunction('calendar/xget_event', function(response){
                        if(response.code == 1){
                            $('#{$options_arr["id"]}').modal('show');
                            $('#{$options_arr["id"]} #event_id').val(response.event_id);
                            $('#{$options_arr["id"]} #event_title').val(response.event_title);
                            $('#{$options_arr["id"]} #all_day_date').val(response.all_day_date);
                            $('#{$options_arr["id"]} #start_time').val(response.start_time);
                            $('#{$options_arr["id"]} #end_time').val(response.end_time);
                            $('#{$options_arr["id"]} #details').val(response.details);
                        }
                    }, {data:{event_id:self.attr('data-id')}});

                });
            ");
            $lib_modal_edit->end_form();
            $this->add_modal($lib_modal_edit->display(true));
        }
        
    }
    //--------------------------------------------------------------------------
    public function render() {
        $counter = 0;
        $html = "";
        foreach ($this->month_days_arr as $key => $value) {
            $other_month = intval(Lib_date::strtodate($value["date"], "m")) != intval($this->current_month) ? "other-month" : "";
            $counter++;
            $selected = $this->selected_date == $value["date"] ? "selected" : "";
            $event_html = false;
            if(array_key_exists($value["date"], $this->event_arr)){
                foreach ($this->event_arr[$value["date"]] as $event) {
                    $event_html .= "<a class='eventItem' data-id='{$event["id"]}' title='{$event["title"]}'>".Lib_string::limit_string_by_length($event["title"], 17)."</a><br>";
                }
            }
            $event_html = $event_html ? "<div class='event nano'><div class='event-desc nano-content'>$event_html</div></div>" : "";
            $html .= "<li class='day $other_month $selected'><i class='fa fa-plus pull-right add-event-icon' aria-hidden='true' data-date='{$value["date"]}'></i><div class='date pull-left'>".Lib_date::strtodate($value["date"], "d")."</div>$event_html</li>";
            
            if($counter == 7){
                $this->week_html_arr[] = "
                    <ul title='Double click to add an event' class='days'>$html</ul>
                ";
                $counter = 0;
                $html = "";
            }
//            $this->week_html_arr [] = "
//                <ul class='days'>
//                    <li class='day other-month'>
//                        <div class='date'>27</div>                      
//                    </li>
//                    <li class='day other-month'>
//                        <div class='date'>28</div>
//                        <div class='event'>
//                            <div class='event-desc'>
//                                HTML 5 lecture with Brad Traversy from Eduonix
//                            </div>
//                            <div class='event-time'>
//                                1:00pm to 3:00pm
//                            </div>
//                        </div>                      
//                    </li>
//                    <li class='day other-month'>
//                        <div class='date'>29</div>                      
//                    </li>
//                    <li class='day other-month'>
//                        <div class='date'>30</div>                      
//                    </li>
//                    <li class='day other-month'>
//                        <div class='date'>31</div>                      
//                    </li>
//
//                    <!-- Days in current month -->
//
//                    <li class='day'>
//                        <div class='date'>1</div>                       
//                    </li>
//                    <li class='day'>
//                        <div class='date'>2</div>
//                        <div class='event'>
//                            <div class='event-desc'>
//                                Career development @ Community College room #402
//                            </div>
//                            <div class='event-time'>
//                                2:00pm to 5:00pm
//                            </div>
//                        </div>                      
//                    </li>
//                </ul>
//            ";
            
        }
    }
    //--------------------------------------------------------------------------
    public function display($return = false) {
        $this->render();
        $previous_month = strtolower(Lib_date::strtodate("$this->current_date - 1 month", "F Y"));
        $next_month = strtolower(Lib_date::strtodate("$this->current_date + 1 month", "F Y"));
        $current_month_display = Lib_date::strtodate($this->current_date, "F Y");
        
        
        $result = "
            <div id='calendar-wrap' class='container-fluid'>
                <div class='row'>
                    <div class='col-md-1'></div>
                    <div class='col-md-10'>
                        <div id='calendar-wrap'>
                            <header>
                                <h3>
                                    <i class='fa fa-arrow-circle-o-left fl padding-right-30 go-to-month cursor-pointer' month='$previous_month' aria-hidden='true'></i>
                                        <a href='#' class='btn small calendar-header' id='goToDate' data-date-format='yyyy-mm-dd' data-date='$this->current_date'>$current_month_display</a>
                                    <i class='fa fa-arrow-circle-o-right fr padding-left-30 go-to-month cursor-pointer' month='$next_month' aria-hidden='true'></i>
                                </h3>

                            </header>
                            <div id='calendar'>
                                <ul class='weekdays'>
                                    <li>Sunday</li>
                                    <li>Monday</li>
                                    <li>Tuesday</li>
                                    <li>Wednesday</li>
                                    <li>Thursday</li>
                                    <li>Friday</li>
                                    <li>Saturday</li>
                                </ul>
                                ".implode(" ", $this->week_html_arr)."

                            </div>
                        </div>
                    </div>
                    <div class='col-md-1'></div>
                </div>
            </div>
            
            ".  implode(" ", $this->new_event_modal)."

            <script>
                $(document).ready(function(){
                    $('.nano').nanoScroller();

                    $('.go-to-month').click(function(){
                        system.ajax.requestFunction('system/xget_calendar', function(response){
                            $('#calendar-wrap').replaceWith(response);
                        }, {data:'date='+$(this).attr('month')});
                    });
                    
                    
                    $('.add-event-icon').click(function(e){
                        e.preventDefault();
                        $('#modalAddEvent').modal('show');
                    });
                });
                
                $.fn.disableSelection = function() {

                return this.attr('unselectable', 'on')
                  .css({
                    '-moz-user-select': '-moz-none',
                    '-moz-user-select': 'none',
                    '-o-user-select': 'none',
                    '-khtml-user-select': 'none',
                    '-webkit-user-select': 'none',
                    '-ms-user-select': 'none',
                    'user-select': 'none'
                  })
                  .bind('selectstart', false);
              };

              // an example
              $('#calendar').disableSelection();
                
            </script>
        ";
//        $result = "
//            <div id='calendar-wrap' class='container-fluid'>
//                <div class='row'>
//                    <div class='col-md-1'></div>
//                    <div class='col-md-10'>
//                        <div id='calendar-wrap'>
//                            <header>
//                                <h3>
//                                    <i class='fa fa-arrow-circle-o-left fl padding-right-30 go-to-month cursor-pointer' month='$previous_month' aria-hidden='true'></i>
//                                        <a href='#' class='btn small calendar-header' id='goToDate' data-date-format='yyyy-mm-dd' data-date='$this->current_date'>$current_month_display</a>
//                                    <i class='fa fa-arrow-circle-o-right fr padding-left-30 go-to-month cursor-pointer' month='$next_month' aria-hidden='true'></i>
//                                </h3>
//
//                            </header>
//                            <div id='calendar'>
//                                <ul class='weekdays'>
//                                    <li>Sunday</li>
//                                    <li>Monday</li>
//                                    <li>Tuesday</li>
//                                    <li>Wednesday</li>
//                                    <li>Thursday</li>
//                                    <li>Friday</li>
//                                    <li>Saturday</li>
//                                </ul>
//                                ".implode(" ", $this->week_html_arr)."
//
//                            </div>
//                        </div>
//                    </div>
//                    <div class='col-md-1'></div>
//                </div>
//            </div>
//            
//            ".  implode(" ", $this->new_event_modal)."
//
//            <script>
//                $(document).ready(function(){
//                    $('.nano').nanoScroller();
//
//                    $('.go-to-month').click(function(){
//                        system.ajax.requestFunction('system/xget_calendar', function(response){
//                            $('#calendar-wrap').replaceWith(response);
//                        }, {data:'date='+$(this).attr('month')});
//                    });
//                    
//                    $('#goToDate').datepicker({
//                        todayBtn: 'linked',
//                    }).on('changeDate', function(ev){
//                        var d = system.data.formatDate(ev.date);
//                        system.ajax.requestFunction('system/xget_calendar', function(response){
//                            $('#calendar-wrap').replaceWith(response);
//                        }, {data:{date:d,selected_date:d}});
//                        $('#goToDate').datepicker('hide');
//                    });
//                    
//                    $('.add-event-icon').click(function(e){
//                        e.preventDefault();
//                        $('#modalAddEvent').modal('show');
//                    });
//                });
//                
//                $.fn.disableSelection = function() {
//
//                return this.attr('unselectable', 'on')
//                  .css({
//                    '-moz-user-select': '-moz-none',
//                    '-moz-user-select': 'none',
//                    '-o-user-select': 'none',
//                    '-khtml-user-select': 'none',
//                    '-webkit-user-select': 'none',
//                    '-ms-user-select': 'none',
//                    'user-select': 'none'
//                  })
//                  .bind('selectstart', false);
//              };
//
//              // an example
//              $('#calendar').disableSelection();
//                
//            </script>
//        ";
        
        if($return){
            return $result;
        }
        echo $result;
//        echo "
//            <div class='container-fluid'>
//                <div class='row'>
//                    <div class='col-md-1'></div>
//                    <div class='col-md-10'>
//                        <div id='calendar-wrap'>
//                            <header>
//                                <h3>
//                                    <i class='fa fa-arrow-circle-o-left fl padding-right-30' aria-hidden='true'></i>
//                                    August 2014
//                                    <i class='fa fa-arrow-circle-o-right fr padding-left-30' aria-hidden='true'></i>
//                                </h3>
//
//                            </header>
//                            <div id='calendar'>
//                                <ul class='weekdays'>
//                                    <li>Sunday</li>
//                                    <li>Monday</li>
//                                    <li>Tuesday</li>
//                                    <li>Wednesday</li>
//                                    <li>Thursday</li>
//                                    <li>Friday</li>
//                                    <li>Saturday</li>
//                                </ul>
//
//                                <!-- Days from previous month -->
//
//                                <ul class='days'>
//                                    <li class='day other-month'>
//                                        <div class='date'>27</div>                      
//                                    </li>
//                                    <li class='day other-month'>
//                                        <div class='date'>28</div>
//                                        <div class='event'>
//                                            <div class='event-desc'>
//                                                HTML 5 lecture with Brad Traversy from Eduonix
//                                            </div>
//                                            <div class='event-time'>
//                                                1:00pm to 3:00pm
//                                            </div>
//                                        </div>                      
//                                    </li>
//                                    <li class='day other-month'>
//                                        <div class='date'>29</div>                      
//                                    </li>
//                                    <li class='day other-month'>
//                                        <div class='date'>30</div>                      
//                                    </li>
//                                    <li class='day other-month'>
//                                        <div class='date'>31</div>                      
//                                    </li>
//
//                                    <!-- Days in current month -->
//
//                                    <li class='day'>
//                                        <div class='date'>1</div>                       
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>2</div>
//                                        <div class='event'>
//                                            <div class='event-desc'>
//                                                Career development @ Community College room #402
//                                            </div>
//                                            <div class='event-time'>
//                                                2:00pm to 5:00pm
//                                            </div>
//                                        </div>                      
//                                    </li>
//                                </ul>
//
//                                <!-- Row #2 -->
//
//                                <ul class='days'>
//                                    <li class='day'>
//                                        <div class='date'>3</div>                       
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>4</div>                       
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>5</div>                       
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>6</div>                       
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>7</div>
//                                        <div class='event'>
//                                            <div class='event-desc'>
//                                                Group Project meetup
//                                            </div>
//                                            <div class='event-time'>
//                                                6:00pm to 8:30pm
//                                            </div>
//                                        </div>                      
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>8</div>                       
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>9</div>                       
//                                    </li>
//                                </ul>
//
//                                <!-- Row #3 -->
//
//                                <ul class='days'>
//                                    <li class='day'>
//                                        <div class='date'>10</div>                      
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>11</div>                      
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>12</div>                      
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>13</div>                      
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>14</div><div class='event'>
//                                            <div class='event-desc'>
//                                                Board Meeting
//                                            </div>
//                                            <div class='event-time'>
//                                                1:00pm to 3:00pm
//                                            </div>
//                                        </div>                      
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>15</div>                      
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>16</div>                      
//                                    </li>
//                                </ul>
//
//                                <!-- Row #4 -->
//
//                                <ul class='days'>
//                                    <li class='day'>
//                                        <div class='date'>17</div>                      
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>18</div>                      
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>19</div>                      
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>20</div>                      
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>21</div>                      
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>22</div>
//                                        <div class='event'>
//                                            <div class='event-desc'>
//                                                Conference call
//                                            </div>
//                                            <div class='event-time'>
//                                                9:00am to 12:00pm
//                                            </div>
//                                        </div>                      
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>23</div>                      
//                                    </li>
//                                </ul>
//
//                                <!-- Row #5 -->
//
//                                <ul class='days'>
//                                    <li class='day'>
//                                        <div class='date'>24</div>                      
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>25</div>
//                                        <div class='event'>
//                                            <div class='event-desc'>
//                                                Conference Call
//                                            </div>
//                                            <div class='event-time'>
//                                                1:00pm to 3:00pm
//                                            </div>
//                                        </div>                      
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>26</div>                      
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>27</div>                      
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>28</div>                      
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>29</div>                      
//                                    </li>
//                                    <li class='day'>
//                                        <div class='date'>30</div>                      
//                                    </li>
//                                </ul>
//
//                                <!-- Row #6 -->
//
//                                <ul class='days'>
//                                    <li class='day'>
//                                        <div class='date'>31</div>                      
//                                    </li>
//                                    <li class='day other-month'>
//                                        <div class='date'>1</div> <!-- Next Month -->                       
//                                    </li>
//                                    <li class='day other-month'>
//                                        <div class='date'>2</div>                       
//                                    </li>
//                                    <li class='day other-month'>
//                                        <div class='date'>3</div>                       
//                                    </li>
//                                    <li class='day other-month'>
//                                        <div class='date'>4</div>                       
//                                    </li>
//                                    <li class='day other-month'>
//                                        <div class='date'>5</div>                       
//                                    </li>
//                                    <li class='day other-month'>
//                                        <div class='date'>6</div>                       
//                                    </li>
//                                </ul>
//
//                            </div><!-- /. calendar -->
//                        </div><!-- /. wrap -->
//
//
//                    </div>
//                    <div class='col-md-1'></div>
//                </div>
//            </div>
//            
//        ";
    }
    //--------------------------------------------------------------------------
}