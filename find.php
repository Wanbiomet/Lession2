<?php
require_once "./Model/DBConfig.php";
require_once "./Controller/CategoryController.php";
if (isset($_GET['searchVal'])) {
    $searchVal = $_GET['searchVal'];
    $db = new DB();
    $categoryCL = new CategoryController($db->getConnection());
    $result =  $categoryCL->findCategory($searchVal);
    
    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}