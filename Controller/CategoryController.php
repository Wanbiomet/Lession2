<?php
require_once './Model/CategoryModel.php';

class CategoryController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllCategories() {
        $query = "SELECT * FROM category";
        $result = $this->conn->prepare($query);
        $result->execute();

        $categories = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = new Category($row['id'], $row['name'], $row['parent_id']);
        }

        return $categories;
    }
    public function getCategoriesByPage($start, $limit) {
        $query = "SELECT * FROM category LIMIT ?, ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $start, PDO::PARAM_INT);
        $stmt->bindParam(2, $limit, PDO::PARAM_INT);
        $stmt->execute();
        $categories = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $category = new Category($row['id'], $row['name'], $row['parent_id']);
            $categories[] = $category;
        }

        return $categories;
    }
    public function getCategoriesByParentId($parentId) {
        $query = "SELECT * FROM category WHERE parent_id = :parentId";
        $result = $this->conn->prepare($query);
        $result->bindValue(':parentId', $parentId, PDO::PARAM_INT);
        $result->execute();

        $categories = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = new Category($row['id'], $row['name'], $row['parent_id']);
        }

        return $categories;
    }
    public function addCategory($categoryName, $parentCategory){
        $query = "INSERT INTO category (name, parent_id) VALUES (:name, :parent_id)";
        $result = $this->conn->prepare($query);
        $result->bindParam(':name', $categoryName, PDO::PARAM_STR);
        $result->bindParam(':parent_id', $parentCategory, PDO::PARAM_INT);
        $result->execute();
    }
    public function editCategory($cateId, $categoryName, $parentCategory){
        $query = "Update category set name= :categoryName, parent_id= :parent_id WHERE id = :cateId";
        $result = $this->conn->prepare($query);
        $result->bindParam(':categoryName', $categoryName, PDO::PARAM_STR);
        $result->bindParam(':parent_id', $parentCategory, PDO::PARAM_INT);
        $result->bindParam(':cateId', $cateId, PDO::PARAM_INT);
        $result->execute();
    }

    public function removeCategory($cateId){
        $query = "DELETE FROM category WHERE id = :cateId";
        $result = $this->conn->prepare($query);
        $result->bindParam(':cateId', $cateId, PDO::PARAM_INT);
        $result->execute();
    }

    public function findCategory($searchVal) {
        $query = "SELECT * FROM category WHERE name LIKE :name";
        $result = $this->conn->prepare($query);
        $result->bindParam(':name', $searchVal, PDO::PARAM_STR);
        $result->execute();


        
        $category = array($result->fetch(PDO::FETCH_ASSOC));

        return $category;
    }
    
}

?>
