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
                id, author
            FROM
                ' . $this->table . '
                ORDER BY id';

            //Prepare statement
            $stmt = $this->conn->prepare($query);
            
            //Execute Query
            $stmt->execute();
            return $stmt;
              
        }
        // Get single author
        public function read_single(){
            //Create query
            $query = 'SELECT 
                author
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
                $this->author = $row['author'];
            } 
        }

        // Create author
        public function create(){
            //Create query
            $query = 'INSERT INTO ' .
            $this->table. '
            (author)
            VALUES (:author)';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->author = htmlspecialchars(strip_tags($this->author));

            //Bind parameter
            $stmt->bindParam(':author', $this->author);
            
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


            //Update Author
            public function update() {

                // Update query
                $query = 'UPDATE  ' . 
                    $this->table . '
                    SET author =:author
                    WHERE 
                    id = :id';
                
                // Prepare statement        
                $stmt = $this->conn->prepare($query);
    
                // Clean data
                $this->author = htmlspecialchars(strip_tags($this->author));
    
                //Bind parameter
                $stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':author', $this->author);
    
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