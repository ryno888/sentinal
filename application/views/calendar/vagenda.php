<?php
//    console('No direct script access allowed');
//    $this->load->library("html/Lib_html_calendar");
    
//    $this->load->library("html/Lib_html_calendar", NULL, 'my_calendar');

    // Calendar class is now accessed using:

    $html_calendar = new Lib_html_calendar();
    $html_calendar->set_selected_date();
    $html_calendar->add_event(Lib_date::strtodate(), "test", []);
    $html_calendar->add_event(Lib_date::strtodate(), "test2", []);
    $html_calendar->display();
?>

<!--<div class="container-fluid">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div id="calendar-wrap">
                <header>
                    <h3>
                        <i class="fa fa-arrow-circle-o-left fl padding-right-30" aria-hidden="true"></i>
                        August 2014
                        <i class="fa fa-arrow-circle-o-right fr padding-left-30" aria-hidden="true"></i>
                    </h3>
                    
                </header>
                <div id="calendar">
                    <ul class="weekdays">
                        <li>Sunday</li>
                        <li>Monday</li>
                        <li>Tuesday</li>
                        <li>Wednesday</li>
                        <li>Thursday</li>
                        <li>Friday</li>
                        <li>Saturday</li>
                    </ul>

                     Days from previous month 

                    <ul class="days">
                        <li class="day other-month">
                            <div class="date">27</div>                      
                        </li>
                        <li class="day other-month">
                            <div class="date">28</div>
                            <div class="event">
                                <div class="event-desc">
                                    HTML 5 lecture with Brad Traversy from Eduonix
                                </div>
                                <div class="event-time">
                                    1:00pm to 3:00pm
                                </div>
                            </div>                      
                        </li>
                        <li class="day other-month">
                            <div class="date">29</div>                      
                        </li>
                        <li class="day other-month">
                            <div class="date">30</div>                      
                        </li>
                        <li class="day other-month">
                            <div class="date">31</div>                      
                        </li>

                         Days in current month 

                        <li class="day">
                            <div class="date">1</div>                       
                        </li>
                        <li class="day">
                            <div class="date">2</div>
                            <div class="event">
                                <div class="event-desc">
                                    Career development @ Community College room #402
                                </div>
                                <div class="event-time">
                                    2:00pm to 5:00pm
                                </div>
                            </div>                      
                        </li>
                    </ul>

                     Row #2 

                    <ul class="days">
                        <li class="day">
                            <div class="date">3</div>                       
                        </li>
                        <li class="day">
                            <div class="date">4</div>                       
                        </li>
                        <li class="day">
                            <div class="date">5</div>                       
                        </li>
                        <li class="day">
                            <div class="date">6</div>                       
                        </li>
                        <li class="day">
                            <div class="date">7</div>
                            <div class="event">
                                <div class="event-desc">
                                    Group Project meetup
                                </div>
                                <div class="event-time">
                                    6:00pm to 8:30pm
                                </div>
                            </div>                      
                        </li>
                        <li class="day">
                            <div class="date">8</div>                       
                        </li>
                        <li class="day">
                            <div class="date">9</div>                       
                        </li>
                    </ul>

                     Row #3 

                    <ul class="days">
                        <li class="day">
                            <div class="date">10</div>                      
                        </li>
                        <li class="day">
                            <div class="date">11</div>                      
                        </li>
                        <li class="day">
                            <div class="date">12</div>                      
                        </li>
                        <li class="day">
                            <div class="date">13</div>                      
                        </li>
                        <li class="day">
                            <div class="date">14</div><div class="event">
                                <div class="event-desc">
                                    Board Meeting
                                </div>
                                <div class="event-time">
                                    1:00pm to 3:00pm
                                </div>
                            </div>                      
                        </li>
                        <li class="day">
                            <div class="date">15</div>                      
                        </li>
                        <li class="day">
                            <div class="date">16</div>                      
                        </li>
                    </ul>

                     Row #4 

                    <ul class="days">
                        <li class="day">
                            <div class="date">17</div>                      
                        </li>
                        <li class="day">
                            <div class="date">18</div>                      
                        </li>
                        <li class="day">
                            <div class="date">19</div>                      
                        </li>
                        <li class="day">
                            <div class="date">20</div>                      
                        </li>
                        <li class="day">
                            <div class="date">21</div>                      
                        </li>
                        <li class="day">
                            <div class="date">22</div>
                            <div class="event">
                                <div class="event-desc">
                                    Conference call
                                </div>
                                <div class="event-time">
                                    9:00am to 12:00pm
                                </div>
                            </div>                      
                        </li>
                        <li class="day">
                            <div class="date">23</div>                      
                        </li>
                    </ul>

                     Row #5 

                    <ul class="days">
                        <li class="day">
                            <div class="date">24</div>                      
                        </li>
                        <li class="day">
                            <div class="date">25</div>
                            <div class="event">
                                <div class="event-desc">
                                    Conference Call
                                </div>
                                <div class="event-time">
                                    1:00pm to 3:00pm
                                </div>
                            </div>                      
                        </li>
                        <li class="day">
                            <div class="date">26</div>                      
                        </li>
                        <li class="day">
                            <div class="date">27</div>                      
                        </li>
                        <li class="day">
                            <div class="date">28</div>                      
                        </li>
                        <li class="day">
                            <div class="date">29</div>                      
                        </li>
                        <li class="day">
                            <div class="date">30</div>                      
                        </li>
                    </ul>

                     Row #6 

                    <ul class="days">
                        <li class="day">
                            <div class="date">31</div>                      
                        </li>
                        <li class="day other-month">
                            <div class="date">1</div>  Next Month                        
                        </li>
                        <li class="day other-month">
                            <div class="date">2</div>                       
                        </li>
                        <li class="day other-month">
                            <div class="date">3</div>                       
                        </li>
                        <li class="day other-month">
                            <div class="date">4</div>                       
                        </li>
                        <li class="day other-month">
                            <div class="date">5</div>                       
                        </li>
                        <li class="day other-month">
                            <div class="date">6</div>                       
                        </li>
                    </ul>

                </div> /. calendar 
            </div> /. wrap 


        </div>
        <div class="col-md-1"></div>
    </div>
</div>-->
<?php 
    $lib_modal = new Lib_modal();
    $lib_modal->set_id("modalAddEvent");
    $lib_modal->add_column("half");
        $lib_modal->itext("Event Name", "test");
        $lib_modal->idatetime("date1", "date1");
    $lib_modal->end_column();
    $lib_modal->add_column("half");
        $lib_modal->itext("test", "test");
        $lib_modal->idatetime("date2", "date2");
    $lib_modal->end_column();
    $lib_modal->display();
            
?>


<script>
$(document).ready(function(){
    
    $('body').on("dblclick",".day", function(e){
        e.preventDefault();
        $('#modalAddEvent').modal('show');
    })
    
});

</script>