<?php

require_once('core.php');

// Netherlands = 159

// $decoded_responce = action_controller('getlanguages', array(1));


function get_sites_of_country($countryName = NULL) {
  $sql = 'SELECT DISTINCT countries.countryName, countries.countryID, countries.countryIso2 FROM countries';
  // if($countryName) {
  //   $sql .= ' WHERE countries.countryName = "'. $countryName .'"';
  // }
  $vars = array( 'sql' => $sql );
  return action_controller('query', $vars);
}

$decoded_responce = get_sites_of_country();
// $decoded_responce = action_controller('getlanguage', array(3));
// $decoded_responce = action_controller('get_sites_by_country_id');
echo "<pre>";
print_r($decoded_responce);
echo "</pre>";

?>
