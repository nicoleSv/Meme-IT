<?php 
class TopicModel extends BaseModel {
    private $table;

    public $id;
    public $title;
    public $meme;
    public $visible;

    public function __construct(){
      parent::__construct();
      $this->table = "topic";
    }

    public function addMeme() {
        $this->meme = str_replace('data:image/png;base64,', '', $this->meme);
        $this->meme = str_replace(' ', '+', $this->meme);
        $this->meme = base64_decode($this->meme);

        $sql = "UPDATE $this->table SET meme=:meme WHERE id=:id;";
        $query =  $this->connection->prepare($sql);
        $query->bindParam(":meme", $this->meme);
        $query->bindParam(":id", $this->id);
  
        $query->execute();

        return $query->rowCount();
    }

    public function isMemeAvailable() {
      $sql = "SELECT meme FROM $this->table WHERE id=:id;";
      $query =  $this->connection->prepare($sql);
      $query->bindParam(":id", $this->id);

      $query->execute();
      $data =$query->fetch(PDO::FETCH_ASSOC);
  
      return $data['meme'];
    }

    public function getMeme() {
      $sql = "SELECT meme FROM $this->table WHERE id=:id;";
      $query = $this->connection->prepare($sql);
      $query->bindParam(":id", $this->id);

      $query->execute();
      $data = $query->fetch(PDO::FETCH_ASSOC);
  
      return $data['meme'];
    }

    public function updateVisible() {
      $sql = "UPDATE $this->table SET visible=:visible WHERE id=:id;";
      $query =  $this->connection->prepare($sql);
      $query->bindParam(":visible", $this->visible);
      $query->bindParam(":id", $this->id);

      $query->execute();
      return $query->rowCount();
    }

    public function getTitle() {
      $sql = "SELECT title FROM $this->table WHERE id=:id;";
      $query = $this->connection->prepare($sql);
      $query->bindParam(":id", $this->id);

      $query->execute();
      $data = $query->fetch(PDO::FETCH_ASSOC);
  
      return $data['title'];
    }

    public function getVisibleMemes() {
      $sql = "SELECT id, title, meme FROM $this->table WHERE visible=1";
      $query = $this->connection->prepare($sql);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_ASSOC);

      return $results;
    }

    public function getVisibility() {
      $sql = "SELECT visible FROM $this->table WHERE id=:id;";
      $query = $this->connection->prepare($sql);
      $query->bindParam(":id", $this->id);

      $query->execute();
      $data = $query->fetch(PDO::FETCH_ASSOC);
  
      return $data['visible'];
    }
}

?>