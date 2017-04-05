<?php
//    console('No direct script access allowed');
//    $this->load->library("html/Lib_html_calendar");
//
//    $html_calendar = new Lib_html_calendar();
//    $html_calendar->display();
    

$client = new Google_Client([
    'application_name' => CI_NAME,
    'client_id' => '531432974188-u3iujp6045b1k0a2ll82egj3p1ts1uc0.apps.googleusercontent.com',
    'client_secret' => 'Cno6s2f5jTG5CYzwtCwC5yI-',
    'developer_key' => '1e50a8651772bf3b384dfb350e7509d05df11e20',
]);

$client->setHttpClient(new \GuzzleHttp\Client(array(
    'verify' => false,
)));

//$service = new Google_Service_Calendar($client);
//$calendar = $service->calendars->get('primary');
//console($calendar->getSummary());

//$client = new Google_Client();
//$client->setAuthConfig('client_secrets.json');
//$client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
  $drive = new Google_Service_Drive($client);
  $files = $drive->files->listFiles(array())->getItems();
  echo json_encode($files);
} else {
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}