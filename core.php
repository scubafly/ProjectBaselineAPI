<?php

require_once('../ProjectBaselineSettings/settings.php');
// this is set in settings:
// define("BASE_URL", '');
// define("USER_ID", '');
// define("USER_PASS", '');
// define("DEFAULT_LANGUAGE", 'en');

/**
 * action_controller wil generate the url to connect to on given action
 * @param  string $action what the action is that needs to be done.
 * @param  array $params parameters needed to create the get / post url
 * @return connect_api response.
 */
function action_controller($action, $params = array()) {
  $vars = array( "userID" => USER_ID, "userPass" => USER_PASS, "language" => DEFAULT_LANGUAGE );
  switch ($action) {
    case 'getlanguage':
      $url = '/table/languages/'.$params[0];
      break;

    case 'getlanguages':
      $url = '/table/languages/0';
      break;

    case 'query':
      $url = '/query';
      $params['userID'] = USER_ID;
      $params['userPass'] = USER_PASS;
      $params['language'] = DEFAULT_LANGUAGE;
      $params['unitSystemID'] = 1;
      $vars = $params;
      break;

    case 'get_sites_by_country_id':
      $url = '/sites/country/159';
      break;

    default:
      // there is no default.
      break;
  }
  if($url AND $vars) {
    return connect_api( BASE_URL . $url . '.json', $vars );
  }
  die('Error: could not create url or got wrong response from connect_api function. Make sure $action isset correctly.');

}

/**
 * using curl to connect to the api
 * @param  string $service_url url to connect to
 * @return api response
 */
function connect_api($service_url, $vars ) {

  // initialice curl
  $curl = curl_init($service_url.'?'.$vars);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  // get curl response
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
