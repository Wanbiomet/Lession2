<?php
require_once "./Model/DBConfig.php";
require_once "./Controller/CategoryController.php";
if (isset($_GET['categoryId'])) {
    $cateId = $_GET['categoryId'];
    $db = new DB();
    $categoryCL = new CategoryController($db->getConnection());
    $categoryCL->removeCategory($cateId);
    header('Location: ./index.php');
    exit();
}