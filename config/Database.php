<?php
    class Database {
        //DB Params postgres://hyojinpark:twKwhz3Z4KT9SaLmCHSYNu3x5PZGTzn2@dpg-cg38qopmbg5fch3he0a0-a.ohio-postgres.render.com/quotesdb_z9hk
        // private $host='dpg-cg38qopmbg5fch3he0a0-a.ohio-postgres.render.com';
        // private $port='5432';
        // private $dbname='quotesdb_z9hk';
        // private $username= 'hyojinpark';
        // private $password='twKwhz3Z4KT9SaLmCHSYNu3x5PZGTzn2';
        // private $conn;
        
        private $conn;
        private $host;
        private $port;
        private $dbname;
        private $username;
        private $password;

        public function __construct(){
            $this->username = getenv('USERNAME');
            $this->password = getenv('PASSWORD');
            $this->dbname = getenv('DBNAME');
            $this->host = getenv('HOST');
            $this->port = getenv('PORT');
        }

        //DB Connect
        public function connect() {
            //$this->conn = null;
            if($this->conn){
                //conection already exists, return it
                return $this->conn;
            }
            else{
                $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}";
            try {
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->conn;
            } catch(PDOException $e) {
                echo 'Connection Error: '. $e->getMessage();

            }
        }
        }

        //}
        // public function connect() {
        //     $this->conn = null;
        //     $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}";

        //     try {
        //         $this->conn = new PDO($dsn, $this->username, $this->password);
                
        //         $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //     } catch(PDOException $e) {
        //         echo 'Connection Error: '. $e->getMessage();
        //     }
        //     return $this->conn;
        // }



    }
    ?>