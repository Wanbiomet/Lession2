<?php
class Category {
    private $id;
    private $name;
    private $parent_id;
    
    public function __construct($id, $name, $parent_id) {
        $this->id = $id;
        $this->name = $name;
        $this->parent_id = $parent_id;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getParentCategoryId() {
        return $this->parent_id;
    }
}
