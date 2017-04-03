<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {
    //--------------------------------------------------------------------------
	public function page_not_found() {
        $this->load_view('errors/cli/error_404', "web");
    }
    //--------------------------------------------------------------------------
    public function vagenda() {
        $this->load->library("addons/Lib_google");
        $this->load_view('calendar/vagenda', "system");
        $this->run();
    }
    //--------------------------------------------------------------------------
    public function run() {
//        $client = getClient();
//        $google_client = new Google_Client([
//            'client_id' => '531432974188-m04j7udtnli16fe8fu53qq9j0c698r21.apps.googleusercontent.com',
//            'client_secret' => 'C4IaT5pQQmnMypo7oNEwosBF',
//        ]);
//        $Google_Service_Calendar = new Google_Service_Calendar($google_client);
//        console($Google_Service_Calendar->);
        // Get the API client and construct the service object.
        // Get the API client and construct the service object.
//        $client = getClient();
//        $service = new Google_Service_Calendar($client);
//
//        // Print the next 10 events on the user's calendar.
//        $calendarId = 'primary';
//        $optParams = array(
//          'maxResults' => 10,
//          'orderBy' => 'startTime',
//          'singleEvents' => TRUE,
//          'timeMin' => date('c'),
//        );
//        $results = $service->events->listEvents($calendarId, $optParams);
//
//        if (count($results->getItems()) == 0) {
//          print "No upcoming events found.\n";
//        } else {
//          print "Upcoming events:\n";
//          foreach ($results->getItems() as $event) {
//            $start = $event->start->dateTime;
//            if (empty($start)) {
//              $start = $event->start->date;
//            }
//            printf("%s (%s)\n", $event->getSummary(), $start);
//          }
//        }
    }
    //--------------------------------------------------------------------------
}
