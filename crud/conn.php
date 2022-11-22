<?php
class conn implements iconn
{

     private \PDO $pdo;
     private \PDOStatement $stm;

     public function __construct()
     {
          $this->pdo = new \PDO(
               "mysql:host=us-cdbr-east-06.cleardb.net;port=3306;dbname=heroku_c6d76a1a0db8ac9",
               'bf87fbf69295b7',
               '64613672'
          );
     }
     public function connect()
     {
          try {
               return new \PDO(
                    "mysql:host=us-cdbr-east-06.cleardb.net;port=3306;dbname=heroku_c6d76a1a0db8ac9",
                    'bf87fbf69295b7',
                    '64613672'
               );
          } catch (\PDOException $e) {
               echo "Error! Message: " . $e->getMessage() . "Code: " . $e->getCode();
               exit;
          }
     }

     public function query($sql)
     {
          $this->stm = $this->pdo->query($sql);
          return $this;
     }

     public function fetch_assoc()
     {
          return $this->stm->fetch(\PDO::FETCH_ASSOC);
     }
}
/*
{
     
     private \PDO $pdo;
     private \PDOStatement $stm;

     public function __construct()
     {
          $this->pdo = new \PDO(
               "mysql:host=localhost;port=3307;dbname=crud2",
               'root',
               ''
          );
     }

     public function connect()
     {
          try {
               return new \PDO(
                    "mysql:host=localhost;port=3307;dbname=crud2",
                    'root',
                    ''
               );
          } catch (\PDOException $e) {
               echo "Error! Message: " . $e->getMessage() . "Code: " . $e->getCode();
               exit;
          }
     }

     public function query($sql)
     {
          $this->stm = $this->pdo->query($sql);
          return $this;
     }

     public function fetch_assoc()
     {
          return $this->stm->fetch(\PDO::FETCH_ASSOC);
     }
}
*/