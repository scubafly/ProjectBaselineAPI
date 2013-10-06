<?php

require_once('../ProjectBaselineSettings/settings.php');

function action_controller($action) {
  switch ($action) {
    case 'getlanguages':
      $url = '/table/languages/0';
      break;

    default:
      // there is no default.
      break;
  }
  if($url) {
    return connect_api( BASE_URL . $url . '.json' );
  }
  die('Error: could not create url or got wrong responce from connect_api function. Make sure $action isset correctly.');

}

function connect_api($service_url) {

  $vars = array("userID" => USER_ID, "userPass" => USER_PASS, "language" => "en");
  // initialice curl
  $curl = curl_init($service_url.'?'.$vars);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  // get curl responce
  $curl_response = curl_exec($curl);

  // error catch
  if($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error'. var_export($info));
  }

  // close curl
  curl_close($curl);

  $decoded = json_decode($curl_response);

  // catch response status error
  if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
      die('error occured: ' . $decoded->response->errormessage);
  }

  return $decoded;
}

?>
