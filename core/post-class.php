<?php 

class Post  
{
    private $conn;
    private $table_name = 'posts';

    public $id;
    public $author_id;
    public $body;
    public $timestamp;
    public $image;
    public $dep_name;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT u.id as uid, p.id, p.body, p.timestamp, u.name, u.profile_pic, p.image FROM ' . $this->table_name . ' AS p
                  INNER JOIN users AS u
                  ON p.author_id = u.id
                  ORDER BY timestamp desc';
        $result = $this->conn->query($query);
        $rows = $result -> fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    public function read_by_dep()
    {
        $query = 'SELECT u.id as uid, p.id, p.body, p.timestamp, u.name, u.profile_pic, p.image, u.department FROM ' . $this->table_name . ' AS p
                  INNER JOIN users AS u
                  ON p.author_id = u.id
                  WHERE u.department = ?
                  ORDER BY timestamp desc';
                  $stmt = $this->conn->prepare($query);
                  $this->dep_name = htmlspecialchars(strip_tags($this->dep_name));
                  $stmt->bind_param('s', $this->dep_name);
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $rows = $result -> fetch_all(MYSQLI_ASSOC);
                  return $rows;
    }

    public function read_single()
    {
        $query = 'SELECT u.id as uid, p.id, p.body, p.timestamp, u.name, u.profile_pic, p.image FROM ' . $this->table_name . ' AS p
        INNER JOIN users AS u
        ON p.author_id = u.id
        WHERE p.id = ?';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bind_param('s', $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result -> fetch_assoc();
        return $row;
    }

    public function update()
    {
        $query = 'UPDATE ' . $this->table_name . ' SET 
                  author_id = ?,
                  body = ?,
                  image = ?
                  WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->timestamp = htmlspecialchars(strip_tags($this->timestamp));
      
        $stmt->bind_param('ssss',
                           $this->author_id,
                           $this->body,
                           $this->image,
                           $this->id );
        return $stmt->execute();
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table_name . ' (author_id, body, image) VALUES (?,?,?)';
        $stmt = $this->conn->prepare($query);
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $stmt->bind_param('sss',
                           $this->author_id,
                           $this->body,
                           $this->image
                        );
        if ( $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table_name . ' WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bind_param('s', $this->id);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    
}



?>