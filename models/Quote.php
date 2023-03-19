<?php
    class Quote {
        //DB stuff
        private $conn;
        private $table = 'quotes';
        
        //Post Properties
        public $id;
        public $quote;
        public $author_id;
        public $category_id;

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
        
        }

        // SQL query
        // SELECT q.id, q.quote, a.author, c.category
        // FROM quotes q INNER JOIN authors a
        // ON q.author_id = a.id
        // INNER JOIN categories c
        // ON q.category_id = c.id;