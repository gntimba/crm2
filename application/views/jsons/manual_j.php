<?php
header('Content-Type: application/json');
$message='<div id="success" class="alert alert-success">'.$customer.' Has been added</div>';
echo json_encode(array("message"=>$message));
?>
