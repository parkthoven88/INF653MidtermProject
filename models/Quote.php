<?php
    class Quote {
        //DB stuff
        private $conn;
        private $table = 'quotes';
        
        //Quote Properties
        public $id;
        public $quote;
        public $author_id;
        public $category_id;

        public $author;
        public $category;

        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        //Get quotes
        public function read() {
            //Create query
            $query = 'SELECT 
                q.id, 
                q.quote, 
                a.author, 
                c.category
            FROM 
            ' . $this->table . ' q 
            INNER JOIN authors a
                ON q.author_id = a.id
            INNER JOIN categories c
                ON q.category_id = c.id';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute query
            $stmt->execute();

            return $stmt;
        }

        //Get quotes
        public function read_single() {
            //Create query
            $query = 'SELECT 
                q.id, 
                q.quote, 
                a.author, 
                c.category
            FROM 
            ' . $this->table . ' q 
            INNER JOIN authors a
                ON q.author_id = a.id
            INNER JOIN categories c
                ON q.category_id = c.id
            WHERE
            q.id = :id';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            
            $stmt->bindParam(1, $this->id);

            //Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->id = $row['id'];
            $this->quote = $row['category'];
            $this->author = $row['author'];
            $this->category = $row['category'];

        }
    }

        // SQL query
        // SELECT q.id, q.quote, a.author, c.category
        // FROM quotes q INNER JOIN authors a
        // ON q.author_id = a.id
        // INNER JOIN categories c
        // ON q.category_id = c.id;