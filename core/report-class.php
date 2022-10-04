<?php 

class Report  
{
    private $conn;
    private $table_name = 'reports';

    public $id;
    public $post_id;
    public $body;

    
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    { 
        $query = 'SELECT * FROM ' . $this -> table_name;
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

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table_name . ' (post_id, body) VALUES (?,?)';
        $stmt = $this->conn->prepare($query);
        $this->post_id = htmlspecialchars(strip_tags($this->post_id));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $stmt->bind_param('ss',
                           $this->post_id,
                           $this->body);
        if ( $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    
}



?>