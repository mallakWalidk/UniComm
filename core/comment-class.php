<?php 

class Comment  
{
    private $conn;
    private $table_name = 'comments';

    public $id;
    public $author_id;
    public $post_id;
    public $body;

    
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    { 
        $query = 'SELECT c.id, c.body, c.author_id, u.name, u.profile_pic FROM ' . $this->table_name . ' AS c
        INNER JOIN users AS u
        ON c.author_id = u.id
        WHERE post_id = ?';
        $stmt = $this->conn->prepare($query);
        $this->post_id = htmlspecialchars(strip_tags($this->post_id));
        $stmt->bind_param('s', $this->post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result -> fetch_all(MYSQLI_ASSOC);
        return $row;
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table_name . ' (author_id, post_id, body) VALUES (?,?,?)';
        $stmt = $this->conn->prepare($query);
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->post_id = htmlspecialchars(strip_tags($this->post_id));
        $stmt->bind_param('sss',
                           $this->author_id,
                           $this->post_id,
                           $this->body);
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