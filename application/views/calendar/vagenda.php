<?php
//    console('No direct script access allowed');
//    $this->load->library("html/Lib_html_calendar");
//
//    $html_calendar = new Lib_html_calendar();
//    $html_calendar->display();
    

$client = new Google_Client([
    'client_id' => '531432974188-m04j7udtnli16fe8fu53qq9j0c698r21.apps.googleusercontent.com',
    'client_secret' => 'C4IaT5pQQmnMypo7oNEwosBF',
]);

$client->setHttpClient(new \GuzzleHttp\Client(array(
    'verify' => false,
)));

$service = new Google_Service_Calendar($client);
$calendar = $service->calendars->get('primary');
console($calendar->getSummary());
