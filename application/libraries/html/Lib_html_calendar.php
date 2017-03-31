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
    
    private $event_arr = [];
    
    //--------------------------------------------------------------------------
    public function __construct() {
        parent::__construct();
        $this->ci->load->library("html/Lib_html_tags");
    }
    //--------------------------------------------------------------------------
    public function add_event($title, $date, $options = []) {
        $options_arr = array_merge([
            "id" => false,
            "all_day_event" => false,
            "class" => false,
        ], $options);
//        id: 999,
//        title: 'Repeating Event',
//        start: new Date(y, m, d-3, 16, 0),
//        allDay: false,
//        className: 'info'
        $this->event_arr[] = [
            "id" => $options_arr["id"],
            "title" => $title,
            "y" => Lib_date::strtodate($date, "Y"),
        ];
    }
    //--------------------------------------------------------------------------
    public function display() {
        
        echo "
            <link rel='stylesheet' type='text/css' href='".CI_BASE_URL."assets/css/calendar.css'>
            <script>

                $(document).ready(function() {
                    var date = new Date();
                    var d = date.getDate();
                    var m = date.getMonth();
                    var y = date.getFullYear();

                    /*  className colors

                    className: default(transparent), important(red), chill(pink), success(green), info(blue)

                    */		


                    /* initialize the external events
                    -----------------------------------------------------------------*/

                    $('#external-events div.external-event').each(function() {

                        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                        // it doesn't need to have a start or end
                        var eventObject = {
                            title: $.trim($(this).text()) // use the element's text as the event title
                        };

                        // store the Event Object in the DOM element so we can get to it later
                        $(this).data('eventObject', eventObject);

                        // make the event draggable using jQuery UI
                        $(this).draggable({
                            zIndex: 999,
                            revert: true,      // will cause the event to go back to its
                            revertDuration: 0  //  original position after the drag
                        });

                    });


                    /* initialize the calendar
                    -----------------------------------------------------------------*/

                    var calendar =  $('#calendar').fullCalendar({
                        header: {
                            left: 'title',
                            center: 'agendaDay,agendaWeek,month',
                            right: 'prev,next today'
                        },
                        editable: true,
                        firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
                        selectable: true,
                        isEventDraggable: false,
                        defaultView: 'month',

                        axisFormat: 'h:mm',
                        columnFormat: {
                            month: 'ddd',    // Mon
                            week: 'ddd d', // Mon 7
                            day: 'dddd M/d',  // Monday 9/7
                            agendaDay: 'dddd d'
                        },
                        titleFormat: {
                            month: 'MMMM yyyy', // September 2009
                            week: 'MMMM yyyy', // September 2009
                            day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
                        },
                        allDaySlot: false,
                        selectHelper: true,
                        select: function(start, end, allDay) {
                            var title = prompt('Event Title:');
                            if (title) {
                                calendar.fullCalendar('renderEvent',
                                    {
                                        title: title,
                                        start: start,
                                        end: end,
                                        allDay: allDay
                                    },
                                    true // make the event 'stick'
                                );
                            }
                            calendar.fullCalendar('unselect');
                        },

                        events: [
                            {
                                title: 'All Day Event',
                                start: new Date(y, m, 1)
                            },
                            {
                                id: 999,
                                title: 'Repeating Event',
                                start: new Date(y, m, d-3, 16, 0),
                                allDay: false,
                                className: 'info'
                            },
                            {
                                id: 999,
                                title: 'Repeating Event',
                                start: new Date(y, m, d+4, 16, 0),
                                allDay: false,
                                className: 'info'
                            },
                            {
                                title: 'Meeting',
                                start: new Date(y, m, d, 10, 30),
                                allDay: false,
                                className: 'important'
                            },
                            {
                                title: 'Lunch',
                                start: new Date(y, m, d, 12, 0),
                                end: new Date(y, m, d, 14, 0),
                                allDay: false,
                                className: 'important'
                            },
                            {
                                title: 'Birthday Party',
                                start: new Date(y, m, d+1, 19, 0),
                                end: new Date(y, m, d+1, 22, 30),
                                allDay: false,
                            },
                            {
                                title: 'Click for Google',
                                start: new Date(y, m, 28),
                                end: new Date(y, m, 29),
                                url: 'http://google.com/',
                                className: 'success'
                            }
                        ],			
                    });


                });

            </script>
                <style>

                    body {
                        text-align: center;
                        font-size: 14px;
                        font-family: 'Roboto', sans-serif;
                        }

                    #wrap {
                        width: 1100px;
                        margin: 0 auto;
                        padding-top: 30px;
                        }

                    #external-events {
                        float: left;
                        width: 150px;
                        padding: 0 10px;
                        text-align: left;
                        }

                    #external-events h4 {
                        font-size: 16px;
                        margin-top: 0;
                        padding-top: 1em;
                        }

                    .external-event { /* try to mimick the look of a real event */
                        margin: 10px 0;
                        padding: 2px 4px;
                        background: #3366CC;
                        color: #fff;
                        font-size: .85em;
                        cursor: pointer;
                        }

                    #external-events p {
                        margin: 1.5em 0;
                        font-size: 11px;
                        color: #666;
                        }

                    #external-events p input {
                        margin: 0;
                        vertical-align: middle;
                        }

                    #calendar {
                /* 		float: right; */
                        margin: 0 auto;
                        width: 900px;
                        background-color: #FFFFFF;
                          border-radius: 6px;
                        box-shadow: 0 1px 2px #C3C3C3;
                        -webkit-box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
                -moz-box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
                box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
                        }

                </style>
                <div id='wrap'>
                    <div id='calendar'></div>

                    <div style='clear:both'></div>
                </div>
                <script type='text/javascript' src='".CI_BASE_URL."assets/js/calendar.js'></script>
            ";
    }
    //--------------------------------------------------------------------------
}