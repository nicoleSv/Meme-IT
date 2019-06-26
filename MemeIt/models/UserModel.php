<?php 
class UserModel extends BaseModel {
    private $table;

    public $id;
    public $email;
    public $name;
    public $fn;
    public $topic_id;
    public $password;

    public function __construct(){
      parent::__construct();
      $this->table = "user";
    }

    public function addUser() {
      $sql = "INSERT INTO $this->table (email, name, fn, topic_id, password) VALUES (:email, :name, :fn, :topic_id, :password);";

      $query = $this->connection->prepare($sql);

      $pass = password_hash($this->password, PASSWORD_DEFAULT);

      $query->bindParam(":email", $this->email);
      $query->bindParam(":name", $this->name);
      $query->bindParam(":fn", $this->fn);
      $query->bindParam(":topic_id", $this->topic_id);
      $query->bindParam(":password", $pass);

      $query->execute();
    }

    public function getUser() {
      $sql = "SELECT id, email, name, fn, topic_id, password FROM $this->table WHERE email LIKE :email;";
      $query = $this->connection->prepare($sql);
      $query->bindParam(":email", $this->email);

      $query->execute();
      $userData = $query->fetch(PDO::FETCH_ASSOC);
      return $userData;
    }

    public function getTopicId() {
      $sql = "SELECT topic_id FROM $this->table WHERE id LIKE :id;";
      $query = $this->connection->prepare($sql);
      $query->bindParam(":id", $this->id);

      $query->execute();
      $data = $query->fetch(PDO::FETCH_ASSOC);
  
      return $data['topic_id'];
    }

    public function checkForFn() {
      $sql = "SELECT id FROM $this->table WHERE fn LIKE :fn;";
      $query = $this->connection->prepare($sql);
      $query->bindParam(":fn", $this->fn);
      $query->execute();
  
      return $query->rowCount();
    }

    public function checkForTopic() {
      $sql = "SELECT id FROM $this->table WHERE topic_id LIKE :topic_id;";
      $query = $this->connection->prepare($sql);
      $query->bindParam(":topic_id", $this->topic_id);
      $query->execute();
  
      return $query->rowCount();
    }

    public function getName() {
      $sql = "SELECT name FROM $this->table WHERE id LIKE :id;";
      $query = $this->connection->prepare($sql);
      $query->bindParam(":id", $this->id);

      $query->execute();
      $data = $query->fetch(PDO::FETCH_ASSOC);
  
      return $data['name'];
    }

    public function getNameByTopic() {
      $sql = "SELECT name FROM $this->table WHERE topic_id LIKE :topic_id;";
      $query = $this->connection->prepare($sql);
      $query->bindParam(":topic_id", $this->topic_id);

      $query->execute();
      $data = $query->fetch(PDO::FETCH_ASSOC);
  
      return $data['name'];
    }
}

?>