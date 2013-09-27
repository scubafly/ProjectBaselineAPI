<?php

require_once('../ProjectBaselineSettings/settings.php');

echo $url;

// initialice curl
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// get curl responce
$curl_responce = curl_exec($curl);

// error catch
if($curl_responce === false) {
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

// if ok, echo ok.
echo 'response ok!';
var_export($decoded->response);


?>
