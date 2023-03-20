<?php
    class Author {
        // DB stuff
        private $conn;
        private $table = 'authors';
        
        // Author Properties
        public $id;
        public $author;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        //Get Author
        public function read() {
            //Create query
            $query = 'SELECT 
                id, 
                author
            FROM
                ' . $this->table . '
            ORDER BY id';

            //Prepare statement
            $stmt = $this->conn->prepare($query);
            
            try { 
                $stmt->execute();
                return $stmt;
              }
              // Execution of query fails
              catch(PDOException $e) {
                echo json_encode(array('message :' . $e->getMessage()));
              }
        }
        // Get single author
        public function read_single(){
            //Create query
            $query = 'SELECT 
                id, 
                author
                
            FROM
                ' . $this->table . '
                WHERE
                id = :id
                LIMIT 1';
            
            //Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(1, $this->id);
            
            try { 
                $stmt->execute();
                // Fetch one associative array
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                // Check if row returns array
                if(is_array($row)){
                  // Set properties
                  $this->id = $row['id'];
                  $this->author = $row['author'];
                }
                return $stmt;
                }
                // Execution of query fails
                catch(PDOException $e) {
                        echo json_encode(array('message :' . $e->getMessage()));
                }
        }

        public function create() {

            // Create query
            $query = 'INSERT INTO ' . 
                $this->table . '
                (id, author)
                VALUES(:id, :author)';
            
            // Prepare statement        
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->author = htmlspecialchars(strip_tags($this->author));

            // Bind data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':author', $this->author);

            // Execute query
            if($stmt->execute()) {
                return true;
            }
             // Print error if something goes wrong
             printf("Error: %s.\n", $stmt->error);

            return false;
            }

            //Update Author
            public function update() {

                // Create query
                $query = 'UPDATE  ' . 
                    $this->table . '
                    SET author =:author
                    WHERE 
                    id = :id';
                
                // Prepare statement        
                $stmt = $this->conn->prepare($query);
    
                // Clean data
                $this->id = htmlspecialchars(strip_tags($this->id));
                $this->author = htmlspecialchars(strip_tags($this->author));
    
                // Bind data
                $stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':author', $this->author);
    
                // Execute query
                if($stmt->execute()) {
                    return true;
                }
                 // Print error if something goes wrong
                 printf("Error: %s.\n", $stmt->error);
    
                return false;
                }

                //Delete Post
                public function delete() {

                    // Create query
                    $query = 'DELETE FROM ' . 
                        $this->table . '
                        WHERE 
                        id = :id';
                    
                    // Prepare statement        
                    $stmt = $this->conn->prepare($query);
        
                    // Clean data
                    $this->id = htmlspecialchars(strip_tags($this->id));
        
                    // Bind data
                    $stmt->bindParam(':id', $this->id);
        
                    // Execute query
                    if($stmt->execute()) {
                        return true;
                    }
                     // Print error if something goes wrong
                     printf("Error: %s.\n", $stmt->error);
        
                    return false;
                    }
    }