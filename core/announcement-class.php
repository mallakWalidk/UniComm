<?php 

class Announcement  
{
    private $conn;
    private $table_name = 'announcements';

    public $id;
    public $author_id;
    public $body;
    public $timestamp;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT a.body, a.timestamp, u.name, a.id FROM ' . $this->table_name . ' AS a
                  INNER JOIN users AS u
                  ON a.author_id = u.id
                  ORDER BY timestamp desc';
        $result = $this->conn->query($query);
        $rows = $result -> fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    public function read_single()
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' WHERE id = ?';
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
                  body = ?
                  WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->body = htmlspecialchars(strip_tags($this->body));
      
        $stmt->bind_param('ss',
                           $this->body,
                           $this->id );
        return $stmt->execute();
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table_name . ' (author_id, body) VALUES (?,?)';
        $stmt = $this->conn->prepare($query);
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $stmt->bind_param('ss',
                           $this->author_id,
                           $this->body
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