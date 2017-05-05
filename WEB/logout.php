<?php
session_start();
session_destroy();
$json = '{"success": 1}';
echo $json;
?>