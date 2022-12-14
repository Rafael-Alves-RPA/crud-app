<?php
class conn
{
     //private \PDO $pdo;
     //private \PDOStatement $stmt;

     private $host = 'us-cdbr-east-06.cleardb.net';
     //private $port = '3307';
     private $dbname = 'heroku_c6d76a1a0db8ac9';
     private $user = 'bf87fbf69295b7';
     private $pass = '64613672';

     private $dbh;
     private $stmt;


     public function __construct()
     {
          $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

          $options = array(
               PDO::ATTR_PERSISTENT         => true, // turn on persistent connection
               PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
               PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
               PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
          );

          try {
               $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
          } catch (\PDOException $e) {
               echo "Error! Message: " . $e->getMessage() . "Code: " . $e->getCode();
               exit;
          }
     }

     public function query($query)
     {
          $this->stmt = $this->dbh->prepare($query);
          return $this;
     }

     public function execute()
     {
          $this->stmt->execute();
          return $this->stmt;
     }

     public function result()
     {
          $this->execute();
          return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
     }
}
