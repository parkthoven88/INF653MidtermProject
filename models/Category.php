<?php
    class Category {
        // DB stuff
        private $conn;
        private $table = 'categories';
        
        // category Properties
        public $id;
        public $category;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        //Get category
        public function read() {
            //Create query
            $query = 'SELECT 
                id, category
            FROM
                ' . $this->table . '
                ORDER BY id';

            //Prepare statement
            $stmt = $this->conn->prepare($query);
            
            //Execute Query
            $stmt->execute();
            return $stmt;
              
        }

        // Get single category
        public function read_single(){
            //Create query
            $query = 'SELECT 
                category
            FROM
                ' .$this->table . '
                WHERE
                id = ?';
                
            //Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(1, $this->id);
            
            //Excecute query
            $stmt->execute();
                
            // Fetch one associative array
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
            //Set properties    
            if(is_array($row)){
                $this->category = $row['category'];
            } 
        }

        // Create category
        public function create(){
            //Create query
            $query = 'INSERT INTO ' .
            $this->table. '
            (category)
            VALUES (:category)';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->category = htmlspecialchars(strip_tags($this->category));

            //Bind parameter
            $stmt->bindParam(':category', $this->category);
            
            if($stmt->execute()){
                $lastId = $this->conn->lastInsertId();
                return true;
            }
            else{
                // Print error if something goes wrong
                printf("Error: %s.\n", $stmt->error);
                return false;
            }
        }

        //Update category
        public function update() {

            // Update query
            $query = 'UPDATE  ' . 
                $this->table . '
                SET category =:category
                WHERE 
                id = :id';
            
            // Prepare statement        
            $stmt = $this->conn->prepare($query);
            // Clean data
            $this->category = htmlspecialchars(strip_tags($this->category));
    
            //Bind parameter
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':category', $this->category);

            // Execute query
            if($stmt->execute()) {
                return true;
            }
            else{
                // Print error if something goes wrong
                printf("Error: %s.\n", $stmt->error);
                return false;
            }
        }

        //Delete Post
        public function delete() {

            // Delete query
            $query = 'DELETE FROM ' . 
                $this->table . '
                WHERE 
                id = :id';
            
            // Prepare statement        
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind parameter
            $stmt->bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }
            else{
                // Print error if something goes wrong
                printf("Error: %s.\n", $stmt->error);
                return false;
            }
        }
    }
?>