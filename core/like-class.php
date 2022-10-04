<?php 

class Like  
{
    private $conn;
    private $table_name = 'likes';

    public $id;
    public $user_id;
    public $post_id;
    
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    { 
        $query = 'SELECT l.post_id, l.user_id, u.name, u.profile_pic FROM ' . $this->table_name . ' as l 
        INNER JOIN users as u
        ON u.id = l.user_id
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
        $query = 'INSERT INTO ' . $this->table_name . ' (user_id, post_id) VALUES (?,?)';
        $stmt = $this->conn->prepare($query);
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->post_id = htmlspecialchars(strip_tags($this->post_id));
        $stmt->bind_param('ss',
                           $this->user_id,
                           $this->post_id);
        if ( $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table_name . ' WHERE user_id = ? AND post_id = ?';
        $stmt = $this->conn->prepare($query);
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->post_id = htmlspecialchars(strip_tags($this->post_id));
        $stmt->bind_param('ss',
                           $this->user_id,
                           $this->post_id);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    
}



?>