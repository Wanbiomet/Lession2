<?php
require_once "./Model/DBConfig.php";
require_once "./Controller/CategoryController.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cateId = $_POST['categoryId'];
    $categoryName = $_POST['cateName'];
    $parentCategory = $_POST['parentcateName'];

    $db = new DB();
    $categoryCL = new CategoryController($db->getConnection());
    $categoryCL->editCategory($cateId, $categoryName, $parentCategory);
    
}