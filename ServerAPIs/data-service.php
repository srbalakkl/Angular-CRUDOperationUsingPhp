<?php

require_once ('Orders/WorkOrders.php');
use Orders\WorkOrders;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$data = file_get_contents("php://input");

if (isset($_GET['saveWorkOrder']) && $_GET['saveWorkOrder']) {
  $postData = file_get_contents("php://input");
  $request = json_decode($postData);

  $wo = new WorkOrders();
  echo json_encode($wo->saveOrder($request));
}
