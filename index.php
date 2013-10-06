<?php

require_once('core.php');


$decoded_responce = action_controller('getlanguages');
echo "<pre>";
print_r($decoded_responce);
echo "</pre>";

?>
