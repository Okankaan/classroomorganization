<?php
// Returns: ["Apple","Banana","Pear"]
json_encode(array("Apple", "Banana", "Pear"));

// Returns: {"4":"four","8":"eight"}
json_encode(array(4 => "four", 8 => "eight"));

// Returns: {"apples":true,"bananas":null}
json_encode(array("apples" => true, "bananas" => null));
?>